<?php

class Promotions extends Controller {

    var $title = "";
    var $session_keyword = "promotion_menu";
    var $image_width = 560;
    var $image_height = 345;

    function Promotions() {
        parent::Controller();
        $this->load->library('DX_Auth');
        $this->load->library('Form_validation');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('promotions/Promotions_model');
        $this->dx_auth->check_uri_permissions();
        if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))) {
            redirect('', 'refresh');
        }
    }

    function add() {
        $this->title = "Add Promotions";
        $this->create_promotions();
    }

    function edit($id = false) {
        $this->title = "Edit Promotions";
        $this->edit_promotions($id);
    }

    function delete($id = false) {
        $this->Promotions_model->delete_data($id);
        $this->session->set_flashdata('promotion_message', "Promotion Deleted");
        redirect('promotions', 'location');
    }

    function index() {
        $data['title'] = 'Promotions';
        $data['session_keyword'] = $this->session_keyword;

        $offset = (int) $this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;

        $data['promotions'] = $this->Promotions_model->getAllPromotions($offset, $row_count, $data['session_keyword'])->result();
        $p_config['base_url'] = base_url() . 'index.php/promotions/index/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Promotions_model->getAllPromotions(false, false, $data['session_keyword'])->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();
        $data['main'] = 'promotions/index';
        $this->load->view('template', $data);
    }

    function create_promotions() {
        $data['title'] = $this->title;
        $data['task'] = 'add';
        $data['session_keyword'] = $this->session_keyword;
        $data['image_width'] = $this->image_width;
        $data['image_height'] = $this->image_height;

        $img_data = array();

        $this->form_validation->set_rules('pr_type', 'Type', 'required');
        if ($this->input->post('pr_type') == "video") {
            $this->form_validation->set_rules('pr_url', 'URL', 'required');
            $this->form_validation->set_rules('pr_duration', 'Duration', 'required');
        }

        if (isset($_POST['submit']) && $this->input->post('pr_type') == "image") {

            $config['upload_path'] = 'icons/PROMOTIONS/';
            $config['allowed_types'] = 'gif|jpg|png';
            //$config['max_size'] = '1024';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;

            $config['max_width'] = $data['image_width'];
            $config['max_height'] = $data['image_height'];

            $this->load->library('upload', $config);

            $upload = $this->upload->do_upload('image_pro');

            if (!$upload) {
                $data['img_error'] = $this->upload->display_errors();
            } else {
                $img_data = $this->upload->data();
            }
        }
        if ($this->form_validation->run() == TRUE && !isset($data['img_error'])) {
            $this->Promotions_model->add($img_data);
            $this->session->set_flashdata('movie_c', "Promotions created");
            redirect('promotions', 'location');
        }

        $data['main'] = 'promotions/create_edit_promotions';
        $this->load->view('template', $data);
    }

    function edit_promotions($id = false) {
        $data['title'] = $this->title;
        $data['task'] = 'update';
        $data['session_keyword'] = $this->session_keyword;
        $data['image_width'] = $this->image_width;
        $data['image_height'] = $this->image_height;
        $img_data = array();

        if (isset($_POST['update'])) {

            $this->form_validation->set_rules('pr_type', 'Type', 'required');
            if ($this->input->post('pr_type') == "video") {
                $this->form_validation->set_rules('pr_url', 'URL', 'required');
                $this->form_validation->set_rules('pr_duration', 'Duration', 'required');
            }

            if (!empty($_FILES['image_pro']['name']) || (!isset($_POST['file_img_name1']) && isset($_POST['pr_type']) && $_POST['pr_type'] == "image")) {
                $config['upload_path'] = 'icons/PROMOTIONS/';
                $config['allowed_types'] = 'gif|jpg|png';
                //$config['max_size'] = '1024';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;

                $config['max_width'] = $data['image_width'];
                $config['max_height'] = $data['image_height'];
                $this->load->library('upload', $config);

                $upload = $this->upload->do_upload('image_pro');

                if (!$upload) {
                    $data['img_error'] = $this->upload->display_errors();
                    //$this->form_validation->run()==false;
                } else {
                    $filename = $this->input->post('file_img_name1');
                    if (isset($_POST['file_img_name1'])) {
                        $img_name = basename($filename);
                        $file_path = 'icons/PROMOTIONS/';
                        if (file_exists($file_path . $img_name)) {
                            unlink($file_path . $img_name);
                        }
                    }
                    $img_data = $this->upload->data();
                }
            }

            if ($this->form_validation->run() == TRUE && !isset($data['img_error'])) {
                if ($this->input->post('pr_type') == "video") {
                    $filename = $this->input->post('file_img_name1');
                    if (isset($_POST['file_img_name1'])) { // when you change a image to video then image sholud be removed. Bellow function will do it.
                        $img_name = basename($filename);
                        $file_path = 'icons/PROMOTIONS/';
                        if (file_exists($file_path . $img_name)) {
                            unlink($file_path . $img_name);
                        }
                    }
                }

                $this->Promotions_model->update($img_data, $id);
                $this->session->set_flashdata('promotion_message', "Promotions updated");
                redirect('promotions', 'location');
            }
        }
        if ($id == true) {
            $data['promotions'] = $this->Promotions_model->getPromotions($id);
        }
        $data['main'] = 'promotions/create_edit_promotions';
        $this->load->view('template', $data);
    }

    function delete_promotions($id) {
        $get_data = $this->Promotions_model->getPromotions($id);
        $img_name = basename($get_data['pr_url']);
        $file_path = 'icons/PROMOTIONS/';
        if (file_exists($file_path . $img_name)) {
            unlink($file_path . $img_name);
        }
        $this->Promotions_model->deletePromotions($id);
        $this->session->set_flashdata('movie_c', "Promotions deleted");
        redirect('promotions', 'location');
    }

    function add_ticker_promo() {
        $this->title = "Add Promotions";
        $this->create_edit__ticker_promo();
    }

    function edit_ticker_promo($ticker_promoId = false) {
        $this->title = "Edit Promotions";
        $this->create_edit__ticker_promo($ticker_promoId);
    }

    function delete_ticker_promo($ticker_promoId = false) {
        $this->Promotions_model->delete_ticker_promo($ticker_promoId);
        $this->session->set_flashdata('promotion_message', "Promotion Deleted");
        redirect('promotions/ticker_promo', 'location');
    }

    function ticker_promo() {
        $this->load->model('Restaurant'); //Edit by Yesh 
        $data['title'] = 'Promotions';
        $data['session_keyword'] = $this->session_keyword;

        $offset = (int) $this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;

        $data['ticker_promos'] = $this->Promotions_model->getAllTickerPromo($offset, $row_count)->result();
        $data['restaurants'] = $this->Restaurant->getAllRestaurant($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/promotions/ticker_promo_index/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Promotions_model->getAllTickerPromo(false, false)->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();
        $data['main'] = 'promotions/ticker_promo_index';
        $this->load->view('template', $data);
    }

    function create_edit__ticker_promo($ticker_promoId = false) {
        $this->load->model('Restaurant'); //Edit by Yesh 
        $data['restaurants'] = $this->Restaurant->getAllRestaurant($offset, $row_count)->result();
        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('restaurant_id', 'Restaurant Id', 'trim|required|xss_clean');
            $this->form_validation->set_rules('ticker_promo_txt', 'Ticker Promo Text', 'trim|required|xss_clean');
        }
        if ($this->form_validation->run() == TRUE && isset($_POST['submit'])) {
            $this->Promotions_model->insert_ticker_promo();
            $this->session->set_flashdata('promotion_message', "Promotions created");
            redirect('promotions/ticker_promo', 'location');
        }
        if ($this->form_validation->run() == TRUE && isset($_POST['update'])) {
            $this->Promotions_model->update_ticker_promo($ticker_promoId);
            $this->session->set_flashdata('promotion_message', "Promotions updated");
            redirect('promotions/ticker_promo', 'location');
        }
        if ($ticker_promoId == true) {
            $data['edit_data'] = $this->Promotions_model->getTickerPromoById($ticker_promoId);
        }
        $data['main'] = 'promotions/ticker_promo_create_edit';
        $this->load->view('template', $data);
    }

}
