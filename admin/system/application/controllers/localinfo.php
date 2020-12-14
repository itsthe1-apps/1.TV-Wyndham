<?php

class Localinfo extends Controller {

    var $title = "";
	var $session_keyword = "localinfo";
	var $image_width = 760;
	var $image_height = 400;
	var $image_width_menu = 331;
	var $image_height_menu = 400;
	
    function Localinfo() {
        parent::Controller();
        $this->load->library('DX_Auth');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('Form_validation');
        $this->load->model('localinfo/Localinfo_model');
        $this->load->helper('ckeditor');
        $this->dx_auth->check_uri_permissions();
        if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))) {
            redirect('', 'refresh');
        }
    }

    function index() {
        $data['title'] = 'Local Information';
		$data['session_keyword'] = $this->session_keyword;
					
        $offset = (int) $this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;

        $data['localinfo'] = $this->Localinfo_model->get_data($offset, $row_count, $data['session_keyword'])->result();
        $p_config['base_url'] = base_url() . 'index.php/localinfo/index/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Localinfo_model->get_data(false, false, $data['session_keyword'])->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'localinfo/index';
        $this->load->view('template', $data);
    }

    function add() {
        $this->title = "Add Local Information";
        $this->add_edit();
    }

    function edit($id = false) {
        $this->title = "Edit Local Information";
        $this->add_edit($id);
    }

    function delete($id) {
        $this->Localinfo_model->delete_data($id);
        $this->session->set_flashdata('radio_message', "Radio Deleted");
        redirect('localinfo', 'location');
    }

    function add_edit($id = false) {
        $data['title'] = $this->title;
		$data['session_keyword'] = $this->session_keyword;
		$data['image_width'] = $this->image_width;
		$data['image_height'] = $this->image_height;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            //$this->form_validation->set_rules('description', 'Description', 'trim|required');

            $config['upload_path'] = './icons/LOCALINFO/';
            $config['allowed_types'] = 'gif|jpg|png';
            //$config['max_size'] = '1024';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;

			$config['max_width'] = $data['image_width'];
            $config['max_height'] = $data['image_height'];
            $this->load->library('upload', $config);

            if ($id == true) {
                if (!empty($_FILES['image']['name'])) {
                    if (!$this->upload->do_upload('image')) {
                        $error = $this->upload->display_errors();
                        $data['image_error'] = $error;
                    } else {
                        $img_data = $this->upload->data();
                    }
                }
            } else {
                if (!$this->upload->do_upload('image')) {
                    $error = $this->upload->display_errors();
                    $data['image_error'] = $error;
                } else {
                    $img_data = $this->upload->data();
                }
            }

            if ($this->form_validation->run() == TRUE && !isset($error)) {
                if ($id == true) {
                    if (!empty($_FILES['image']['name'])) {
                        $filename = './icons/LOCALINFO/' . basename($this->input->post('edit_image'));
                        if (file_exists($filename)) {
                            unlink($filename);
                        }
                        $get_img_data = array('file_name' => $img_data['file_name']);
                    } else {
                        $get_img_data = array('file_name' => $this->input->post('edit_image'));
                        $this->session->set_flashdata('localinfo_message', "Local info updated");
                    }
                    $this->Localinfo_model->update_data($get_img_data, $id);
                } else {
                    $this->Localinfo_model->insert_data($img_data);
                    $this->session->set_flashdata('localinfo_message', "Local info created");
                }
                redirect('localinfo', 'location');
            }
        }

        if ($id == true) {
            $data['edit_data'] = $this->Localinfo_model->get_data_byid($id)->row_array();
        }

        $data['main'] = 'localinfo/add_edit';
        $this->load->view('template', $data);
    }

    function menu($task = false, $id = false) {
        if ($task == "add" || $task == "edit") {
            $this->title = $task == "edit" ? 'Edit Menu' : 'Add Menu';
            $this->menu_add_edit($id);
        } else if ($task == "delete") {
            $this->menu_delete($id);
        } else {
            $data['title'] = 'Local Information Menu';
			
            $offset = (int) $this->uri->segment(3);
            $row_count = RECORDS_PERPAGE;

            $data['localinfo_menu'] = $this->Localinfo_model->get_data_menu($offset, $row_count)->result();
            $p_config['base_url'] = base_url() . 'index.php/localinfo/menu/';
            $p_config['uri_segment'] = 3;
            $p_config['num_links'] = 2;
            $p_config['total_rows'] = $this->Localinfo_model->get_data_menu(false, false)->num_rows();
            $p_config['per_page'] = $row_count;

            $this->pagination->initialize($p_config);

            $data['pagination'] = $this->pagination->create_links();

            $data['main'] = 'localinfo/menu';
            $this->load->view('template', $data);
        }
    }

    function menu_add_edit($id = false) {
        $data['title'] = $this->title;
		$data['image_width_menu'] = $this->image_width_menu;
		$data['image_height_menu'] = $this->image_height_menu;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('localinfo', 'Local Information', 'trim|required');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');

            $config['upload_path'] = './icons/LOCALINFO/';
            $config['allowed_types'] = 'gif|jpg|png';
            //$config['max_size'] = '1024';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;

            $config['max_width'] = $data['image_width_menu'];
            $config['max_height'] = $data['image_height_menu'];
            $this->load->library('upload', $config);

            if ($id == true) {
                if (!empty($_FILES['image']['name'])) {
                    if (!$this->upload->do_upload('image')) {
                        $error = $this->upload->display_errors();
                        $data['image_error'] = $error;
                    } else {
                        $img_data = $this->upload->data();
                    }
                }
            } else {
                if (!$this->upload->do_upload('image')) {
                    $error = $this->upload->display_errors();
                    $data['image_error'] = $error;
                } else {
                    $img_data = $this->upload->data();
                }
            }

            if ($this->form_validation->run() == TRUE && !isset($error)) {
                if ($id == true) {
                    if (!empty($_FILES['image']['name'])) {
                        $filename = './icons/LOCALINFO/' . basename($this->input->post('edit_image'));
                        if (file_exists($filename)) {
                            unlink($filename);
                        }
                        $get_img_data = array('file_name' => $img_data['file_name']);
                    } else {
                        $get_img_data = array('file_name' => $this->input->post('edit_image'));
                        $this->session->set_flashdata('localinfo_message', "Local info menu updated");
                    }
                    $this->Localinfo_model->update_data_menu($get_img_data, $id);
                } else {
                    $this->Localinfo_model->insert_data_menu($img_data);
                    $this->session->set_flashdata('localinfo_message', "Local info menu created");
                }
                redirect('localinfo/menu', 'location');
            }
        }

        if ($id == true) {
            $data['edit_data'] = $this->Localinfo_model->get_data_by_menuid($id)->row_array();
        }

        $data['localinfo'] = $this->Localinfo_model->get_data(false, false, 'dp')->result();

        $data['main'] = 'localinfo/menu_add_edit';
        $this->load->view('template', $data);
    }

    function menu_delete($id) {
        $this->Localinfo_model->delete_data_menu($id);
        $this->session->set_flashdata('localinfo_message', "Local info menu deleted");
        redirect('localinfo/menu', 'location');
    }

}

?>