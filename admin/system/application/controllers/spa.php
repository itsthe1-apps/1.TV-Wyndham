<?php

class Spa extends Controller
{

    var $title = "";
    var $session_keyword = "spa_menu";
    var $image_width = 800;
    var $image_height = 450;

    function Spa()
    {
        parent::Controller();
        $this->load->library('DX_Auth');
        $this->load->library('Form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('spa_model');
        $this->dx_auth->check_uri_permissions();
        if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))) {
            redirect('', 'refresh');
        }
    }

    function index()
    {
        $data['title'] = 'Spa';
        $data['session_keyword'] = $this->session_keyword;
        $offset = (int)$this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;

        $data['spa_details'] = $this->spa_model->get_data($offset, $row_count, $data['session_keyword'])->result();
        $p_config['base_url'] = base_url() . 'index.php/spa/index';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->spa_model->get_data($offset, $row_count, $data['session_keyword'])->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();
        $data['main'] = 'spa/index';
        $this->load->view('template', $data);
    }

    function add_spa()
    {
        $this->title = "Add Spa";
        $this->create_edit_spa();
    }

    function edit_spa($id)
    {

        $this->title = "Update Spa";
        $this->load->helper('ckeditor');

        $data['title'] = $this->title;
        $data['task'] = 'edit';
        $data['session_keyword'] = $this->session_keyword;
        $data['image_width'] = $this->image_width;
        $data['image_height'] = $this->image_height;
        $data['spa_data'] = array();


        $img_data = array();


        $data['spa_data'] = $this->spa_model->getSpaDetailsByID($id)->result();


        $this->form_validation->set_rules('spa_type', 'Spa Type', 'required');
        $this->form_validation->set_rules('description', 'Spa Description', 'required');

        if (isset($_POST['update'])) {

            $config['upload_path'] = 'icons/SPA/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;

            $config['max_width'] = $data['image_width'];
            $config['max_height'] = $data['image_height'];

            $this->load->library('upload', $config);

            $files = $_FILES['image_spa'];
            $fileName = '';
            $img_data = '';


            $upload = $files['name'][0] != '';

            if (!$upload) {
                if ($this->input->post('spa_img_current')) {
                    $img_data = $this->input->post('spa_img_current');
                } else {
                    $data['upload_file_error'] = $this->upload->display_errors();
                }
            } else {

                foreach ($files['name'] as $key => $image) {
                    $_FILES['image_spa[]']['name'] = $files['name'][$key];
                    $_FILES['image_spa[]']['type'] = $files['type'][$key];
                    $_FILES['image_spa[]']['tmp_name'] = $files['tmp_name'][$key];
                    $_FILES['image_spa[]']['error'] = $files['error'][$key];
                    $_FILES['image_spa[]']['size'] = $files['size'][$key];
//                    $newfilename = str_replace(" ", "_", $temp[0]) . date('_m-d-Y_Hi') . '.' . end($temp);
                    $fileName .= $image . "|";
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('image_spa[]')) {
                        $this->upload->data();
                    } else {
                        $is_error = 1;
                        $error = $this->upload->display_errors();
                        $data['upload_file_error'] = $error;
                    }
                }
                $img_data = substr($fileName, 0, -1);
            }
            $this->input->post('spa_img_current');
            if ($this->form_validation->run() == TRUE && !isset($data['upload_file_error'])) {
                $this->spa_model->update_spa($img_data, $id);
                $this->session->set_flashdata('movie_c', "Spa created");
                redirect('spa/index', 'location');
            } else {

            }
        }


        $data['main'] = 'spa/create_edit_spa';
        $this->load->view('template', $data);
    }

    function delete($id)
    {

        $this->spa_model->delete_spa($id);
        redirect('spa/index', 'location');
    }

    function create_edit_spa()
    {
        $this->load->helper('ckeditor');

        $data['title'] = $this->title;
        $data['task'] = 'add';
        $data['session_keyword'] = $this->session_keyword;
        $data['image_width'] = $this->image_width;
        $data['image_height'] = $this->image_height;
        $data['spa_data'] = array();


        $img_data = array();

        $this->form_validation->set_rules('spa_type', 'Spa Type', 'required');
        $this->form_validation->set_rules('description', 'Spa Description', 'required');

        if (isset($_POST['submit'])) {

            $config['upload_path'] = 'icons/SPA/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;

            $config['max_width'] = $data['image_width'];
            $config['max_height'] = $data['image_height'];

            $this->load->library('upload', $config);

            $files = $_FILES['image_spa'];
            $fileName = '';
            foreach ($files['name'] as $key => $image) {
                $_FILES['image_spa[]']['name'] = $files['name'][$key];
                $_FILES['image_spa[]']['type'] = $files['type'][$key];
                $_FILES['image_spa[]']['tmp_name'] = $files['tmp_name'][$key];
                $_FILES['image_spa[]']['error'] = $files['error'][$key];
                $_FILES['image_spa[]']['size'] = $files['size'][$key];
//                    $newfilename = str_replace(" ", "_", $temp[0]) . date('_m-d-Y_Hi') . '.' . end($temp);
                $fileName .= $image . "|";
                $this->upload->initialize($config);
                if ($this->upload->do_upload('image_spa[]')) {
                    $this->upload->data();
                } else {
                    $is_error = 1;
                    $error = $this->upload->display_errors();
                    $data['upload_file_error'] = $error;
                }
            }

            $img_data = substr($fileName, 0, -1);

//            foreach ($files['name'] as $key => $image) {
//                $_FILES['icon1[]']['name'] = $files['name'][$key];
//                $_FILES['icon1[]']['type'] = $files['type'][$key];
//                $_FILES['icon1[]']['tmp_name'] = $files['tmp_name'][$key];
//                $_FILES['icon1[]']['error'] = $files['error'][$key];
//                $_FILES['icon1[]']['size'] = $files['size'][$key];
////                    $newfilename = str_replace(" ", "_", $temp[0]) . date('_m-d-Y_Hi') . '.' . end($temp);
//                $fileName .= $image . "|";
//                $this->upload->initialize($config);
//                if ($this->upload->do_upload('icon1[]')) {
//                    $this->upload->data();
//                } else {
//                    $is_error = 1;
//                    $error = $this->upload->display_errors();
//                    $data['upload_file_error'] = $error;
//                }
//            }
//            
//            $upload = $this->upload->do_upload('image_spa');
//            if (!$upload) {
//                $data['img_error'] = $this->upload->display_errors();
//            } else {
//                $img_data = $this->upload->data();
//            }
            if ($this->form_validation->run() == TRUE && !isset($data['upload_file_error'])) {
                $this->spa_model->add($img_data);
                $this->session->set_flashdata('movie_c', "Spa created");
                redirect('spa/index', 'location');
            } else {

            }
        }


        $data['main'] = 'spa/create_edit_spa';
        $this->load->view('template', $data);
    }

}
