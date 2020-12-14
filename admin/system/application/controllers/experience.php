<?php

class Experience extends Controller
{

    var $title = "";
    var $session_keyword = "experience_menu";
    var $image_width = 800;
    var $image_height = 450;

    function Experience()
    {
        parent::Controller();
        $this->load->library('DX_Auth');
        $this->load->library('Form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('experience_model');
        $this->dx_auth->check_uri_permissions();
        if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))) {
            redirect('', 'refresh');
        }
    }

    function index()
    {

        $data['title'] = 'Experience';
        $data['session_keyword'] = $this->session_keyword;
        $offset = (int)$this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;


        $data['experience_details'] = $this->experience_model->get_data($offset, $row_count, $data['session_keyword'])->result();
        $p_config['base_url'] = base_url() . 'index.php/experience/index';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->experience_model->get_data($offset, $row_count, $data['session_keyword'])->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();
        $data['main'] = 'experience/index';
        $this->load->view('template', $data);
    }

    function add_experience()
    {
        $this->title = "Add Experience";
        $this->create_edit_experience();
    }

    function edit_experience($id)
    {

        $this->title = "Update Experience";
        $this->load->helper('ckeditor');

        $data['title'] = $this->title;
        $data['task'] = 'edit';
        $data['session_keyword'] = $this->session_keyword;
        $data['image_width'] = $this->image_width;
        $data['image_height'] = $this->image_height;
        $data['experience_data'] = array();


        $img_data = array();


        $data['experience_data'] = $this->experience_model->getExpDetailsByID($id)->result();


        $this->form_validation->set_rules('experience_type', 'Experience Type', 'required');
        $this->form_validation->set_rules('description', 'Experience Description', 'required');

        if (isset($_POST['update'])) {

            $config['upload_path'] = 'icons/EXP/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;

            $config['max_width'] = $data['image_width'];
            $config['max_height'] = $data['image_height'];

            $this->load->library('upload', $config);

            $files = $_FILES['image_experience'];
            $fileName = '';
            $img_data = '';

            $upload = $files['name'][0] != '';

            if (!$upload) {
                if ($this->input->post('exp_img_current')) {
                    $img_data = $this->input->post('exp_img_current');
                } else {
                    $data['upload_file_error'] = $this->upload->display_errors();
                }
            } else {
                foreach ($files['name'] as $key => $image) {
                    $_FILES['image_experience[]']['name'] = $files['name'][$key];
                    $_FILES['image_experience[]']['type'] = $files['type'][$key];
                    $_FILES['image_experience[]']['tmp_name'] = $files['tmp_name'][$key];
                    $_FILES['image_experience[]']['error'] = $files['error'][$key];
                    $_FILES['image_experience[]']['size'] = $files['size'][$key];
//                    $newfilename = str_replace(" ", "_", $temp[0]) . date('_m-d-Y_Hi') . '.' . end($temp);
                    $fileName .= $image . "|";
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('image_experience[]')) {
                        $this->upload->data();
                    } else {
                        $is_error = 1;
                        $error = $this->upload->display_errors();
                        $data['upload_file_error'] = $error;
                    }
                }
                $img_data = substr($fileName, 0, -1);
            }
            if ($this->form_validation->run() == TRUE && !isset($data['upload_file_error'])) {
                $this->experience_model->update_experience($img_data, $id);
                $this->session->set_flashdata('movie_c', "Experience created");
                redirect('experience/index', 'location');
            } else {

            }
        }


        $data['main'] = 'experience/create_edit_experience';
        $this->load->view('template', $data);
    }

    function delete($id)
    {

        $this->experience_model->delete_experience($id);
        redirect('experience/index', 'location');
    }

    function create_edit_experience()
    {
        $this->load->helper('ckeditor');

        $data['title'] = $this->title;
        $data['task'] = 'add';
        $data['session_keyword'] = $this->session_keyword;
        $data['image_width'] = $this->image_width;
        $data['image_height'] = $this->image_height;
        $data['experience_data'] = array();


        $img_data = array();

        $this->form_validation->set_rules('experience_type', 'Experience Type', 'required');
        $this->form_validation->set_rules('description', 'Experience Description', 'required');

        if (isset($_POST['submit'])) {

            $config['upload_path'] = 'icons/EXP/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;

            $config['max_width'] = $data['image_width'];
            $config['max_height'] = $data['image_height'];

            $this->load->library('upload', $config);

            $files = $_FILES['image_experience'];
            $fileName = '';
            foreach ($files['name'] as $key => $image) {
                $_FILES['image_experience[]']['name'] = $files['name'][$key];
                $_FILES['image_experience[]']['type'] = $files['type'][$key];
                $_FILES['image_experience[]']['tmp_name'] = $files['tmp_name'][$key];
                $_FILES['image_experience[]']['error'] = $files['error'][$key];
                $_FILES['image_experience[]']['size'] = $files['size'][$key];
//                    $newfilename = str_replace(" ", "_", $temp[0]) . date('_m-d-Y_Hi') . '.' . end($temp);
                $fileName .= $image . "|";
                $this->upload->initialize($config);
                if ($this->upload->do_upload('image_experience[]')) {
                    $this->upload->data();
                } else {
                    $is_error = 1;
                    $error = $this->upload->display_errors();
                    $data['upload_file_error'] = $error;
                }
            }

            $img_data = substr($fileName, 0, -1);

//            $upload = $this->upload->do_upload('image_experience');
//            if (!$upload) {
//                $data['img_error'] = $this->upload->display_errors();
//            } else {
//                $img_data = $this->upload->data();
//            }
//
            if ($this->form_validation->run() == TRUE && !isset($data['upload_file_error'])) {
                $this->experience_model->add($img_data);
                $this->session->set_flashdata('movie_c', "Experience created");
                redirect('experience/index', 'location');
            } else {

            }
        }


        $data['main'] = 'experience/create_edit_experience';
        $this->load->view('template', $data);
    }

}
