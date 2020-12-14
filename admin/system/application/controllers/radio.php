<?php

class Radio extends Controller {

    var $title = "";
	var $image_width = 200;
	var $image_height = 200;

    function Radio() {
        parent::Controller();
        $this->load->library('DX_Auth');
        $this->load->library('pagination');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('Form_validation');
        $this->load->model('radio/RMTV');
		$this->load->model('RadioGenre');
		$this->load->model('Leftmenu_radio');

        $this->dx_auth->check_uri_permissions();
        if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))) {
            redirect('', 'refresh');
        }
    }	
	
	function index($var1 = false, $var2 = false, $var3 = false) {
        $base_url = "$var1/$var2";

        // Get offset and limit for page viewing
        $offset = (int) $this->uri->segment(5);

        // Number of record showing per page
        $row_count = RECORDS_PERPAGE;

        // Get all companies
        $data['tv'] = $this->RMTV->getAllTv($offset, $row_count, $var2, $var3)->result();

        // Pagination config
        $p_config['base_url'] = base_url() . 'index.php/radio/index/' . $base_url;
        $p_config['uri_segment'] = 5;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->RMTV->getAllTv(false, false, $var2, $var3)->num_rows();
        $p_config['per_page'] = $row_count;

        // Init pagination
        $this->pagination->initialize($p_config);

        // Create pagination links
        $data['pagination'] = $this->pagination->create_links();

        $data['title'] = 'Radio Channels';
        $data['main'] = 'radio';
        $this->load->vars($data);
        $this->load->view('template');
    }
	
	function addradio(){
		$data['name'] = "";
        $data['ChNum'] = "";
        $data['GndrId'] = "";
        $data['prLevel'] = "";
        $data['prName'] = "";
        $data['eitxml'] = "";
        $data['epgxml'] = "";
        $data['path'] = "";
        $data['description'] = "";
        $data['genreName'] = "";
        $data['LangID'] = "";

		$data['image_width'] = $this->image_width;
		$data['image_height'] = $this->image_height;

        $data['upload_file_error'] = "";
        $is_error = 0;

        if (isset($_POST['submit'])) {

            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('ChNum', 'Channel Number', 'required');
            $this->form_validation->set_rules('GndrId[]', 'Genre', 'required');
            //$this->form_validation->set_rules('eitxml', 'Eit XML', 'valid_url');
            //$this->form_validation->set_rules('epgxml', 'Epg XML', 'valid_url');
            $this->form_validation->set_rules('path', 'Path', 'required');
            //$this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->input->post('ChNum')) {
                $this->form_validation->set_rules('ChNum', 'Channel Number', 'is_numeric');
            }

            if ($this->input->post('prLevel')) {
                $this->form_validation->set_rules('prLevel', 'Parental Number', 'is_numeric');
            }

            //$config['upload_path'] = TV_PATH;
            $config['upload_path'] = './icons/RADIO/';
            $config['allowed_types'] = 'gif|jpg|png';
            //$config['max_size'] = '200';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            //$config['max_size']	= '100';
            $config['max_width'] = $data['image_width'];
            $config['max_height'] = $data['image_height'];
            $this->load->library('upload', $config);


            if (!$this->upload->do_upload('icon')) {
                $error = $this->upload->display_errors();
                $data['upload_file_error'] = $error;
                $is_error = 1;
            } else {
                $is_error = 0;
            }

            if ($this->form_validation->run() == FALSE || $is_error == 1) {
                $data['name'] = $this->TVclass->Unhtmlentities($this->input->post('name'));
                $data['ChNum'] = $this->input->post('ChNum');
                $data['GndrId'] = $this->input->post('GndrId');
                $data['prLevel'] = $this->input->post('prLevel');
                $data['prName'] = $this->input->post('prName');
                //$data['eitxml'] = $this->input->post('eitxml');
                //$data['epgxml'] = $this->input->post('epgxml');
                $data['path'] = $this->input->post('path');
                //$data['description'] = $this->input->post('description');
                $data['genreName'] = $this->input->post('genreName');
                $data['LangID'] = $this->input->post('LangID');
            } else {
                $this->RMTV->addTv();
                $this->session->set_flashdata('tv_c', "Radio created");
                redirect('radio/index/all/0', 'location');
            }
        }

        $data['title'] = "Create Radio";
        $data['main'] = 'radio_create';
        $data['genre'] = $this->RadioGenre->getGenreDropDown();
        $data['pRating'] = $this->RadioGenre->getpRatingDropDown();
        $this->load->view('template', $data);
	}
	
	function radio_edit($id = 0, $id_g = 0) {
        $data['upload_file_error'] = "";
        $is_error = 0;
		//$image = '';
		
		$data['image_width'] = $this->image_width;
		$data['image_height'] = $this->image_height;
		
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('ChNum', 'Channel Number', 'required');
            $this->form_validation->set_rules('GndrId', 'Genre', 'required');
            //$this->form_validation->set_rules('eitxml', 'Eit XML', 'valid_url');
            //$this->form_validation->set_rules('epgxml', 'Epg XML', 'valid_url');
            $this->form_validation->set_rules('path', 'Path', 'required');
            //$this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->input->post('ChNum')) {
                $this->form_validation->set_rules('ChNum', 'Channel Number', 'is_numeric');
            }

            if ($this->input->post('prLevel')) {
                $this->form_validation->set_rules('prLevel', 'Parental Number', 'is_numeric');
            }

            if (!empty($_FILES['icon']['name'])) {
                $config['upload_path'] = './icons/RADIO/';
                $config['allowed_types'] = 'gif|jpg|png';
                //$config['max_size'] = '200';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                //$config['max_size']	= '100';
                $config['max_width'] = $data['image_width'];
            	$config['max_height'] = $data['image_height'];
			
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('icon')) {
                    $error = $this->upload->display_errors();
                    $data['upload_file_error'] = $error;
                    $is_error = 1;
					//$image = '';
                } else {
					//$image = $this->upload->data();
                    $is_error = 0;
                }
            }

            if ($this->form_validation->run() == TRUE && $is_error == 0) {
                $this->RMTV->UpdateTv();
                $this->session->set_flashdata('tv_u', 'Radio updated');
                redirect('radio/radio/index/all/0', 'location');
            }
        }

        $data['genre'] = $this->RadioGenre->getGenreDropDown();
        $data['get_genre_lists'] = $this->RMTV->get_channel_gerne_lists($id);
        $data['pRating'] = $this->RadioGenre->getpRatingDropDown();
        $data['title'] = "Edit Radio";
        $data['main'] = 'radio_edit';
        $data['category'] = $this->RMTV->getTv($id);
        $this->load->view('template', $data);
    }
	
	function deleteradio($id, $id_g) {
        $this->RMTV->deleteTV($id, $id_g);
        $this->session->set_flashdata('tv_d', 'Radio deleted');
        redirect('radio/index/all/0', 'location');
    }

	function addradiofavourites($channel_id) {
        $this->add_favourties($channel_id);
    }
	
	function add_favourties($channel_id = false) {
        $this->load->model('RFavourites');
        $data['title'] = 'Update Favourites';

        if (isset($_POST['fav-submit'])) {
            $data['msg'] = "Data added.";
            $this->RFavourites->insert_data($_POST['users'], $channel_id);
        }

        $this->load->model('Subscribers');
        $data['main'] = 'ae_rfavourites';
        $data['channel_id'] = $channel_id;
        $data['users'] = $this->Subscribers->get_all(false, false)->result();
        $this->load->view('template', $data);
    }
	
	 function radiofavourites($user_id = false, $channel_id = false) {
        $data['title'] = "Favourites";
        $data['user_id'] = $user_id; // for auto submit
        $this->load->model('RFavourites');

        // Uri segment set
        $user_id == false && $channel_id == false ? $num = 3 : "";
        $user_id == true && $channel_id == false ? $num = 4 : "";
        $user_id == true && $channel_id == true ? $num = 5 : "";

        if (isset($_POST['users-changel'])) {

            //$data['fav_array'] = $this->Favourites->get_all(false, false, $user_id)->row_array(); // For fill text box

            $offset = (int) $this->uri->segment($num);
            $row_count = 10;

            $data['favourites'] = $this->RFavourites->get_all_favourites($offset, $row_count)->result();
            $p_config['base_url'] = base_url() . 'index.php/radio/favourites/';
            $p_config['uri_segment'] = $num;
            $p_config['num_links'] = 2;
            $p_config['total_rows'] = $this->RFavourites->get_all_favourites()->num_rows();
            $p_config['per_page'] = $row_count;

            $this->pagination->initialize($p_config);

            $data['pagination'] = $this->pagination->create_links();
        }

        if ($user_id == true) {
            if ($this->RFavourites->check_user_id($user_id)->num_rows > 0) {
                if ($this->RFavourites->get_data_id($user_id)->num_rows > 0) {
                    $this->RFavourites->update_data($user_id, $channel_id);
                } else {
                    $this->RFavourites->insert_data($user_id, $channel_id);
                }
            }
        }

        $this->load->model('Subscribers');
        $data['users'] = $this->Subscribers->get_all(false, false)->result();
        $data['main'] = 'rfavourites';
        $this->load->view('template', $data);
    }
	
	function deleteradiofavourites($user_id, $channel_id) {
        $this->load->model('RFavourites');
        $this->RFavourites->delete_data($user_id, $channel_id);
        $this->session->set_flashdata('ae_fav', 'Data deleted');
        redirect('radio/radiofavourites', 'location');
    }
}

?>