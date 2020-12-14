<?php

class Guest extends Controller {

    var $title = "";
    var $session_keyword = "status_text";

    function Guest() {
        parent::Controller();

        $this->load->library('Table');
        $this->load->library('Pagination');
        $this->load->library('DX_Auth');
        $this->load->library('Form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('Skins');
        $this->load->model('Language');
        $this->load->model('Subscribers');
        $this->load->model('mgenre');
        $this->load->model('Occation');
        $this->load->model('greeting');
        $this->load->model('rooms');
        $this->load->model('message');
        $this->load->model('Devices');
        $this->load->model('dx_auth/users');
        $this->load->model('restaurant');
        $this->load->model('themes/Themes_model');

        // Protect entire controller so only admin, 
        // and users that have granted role in permissions table can access it.
        if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))) {
            redirect('', 'refresh');
        }
        $this->dx_auth->check_uri_permissions();
    }

    function index() {
        $data['title'] = "Guest";
        $data['session_keyword'] = $this->session_keyword;

        $offset = (int) $this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['subscribers'] = $this->Subscribers->get_all($offset, $row_count, $data['session_keyword'])->result();
        //print_r($data);
        $p_config['base_url'] = base_url() . 'index.php/guest';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Subscribers->get_all(false, false, $data['session_keyword'])->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();
        $data['status_text'] = $this->rooms->room_status_text()->result();
        $data['main'] = 'backend/subscribers';
        //$this->load->view('template',$data);
        $this->load->view('template', $data);
    }

    //subscribers = guest 
    function addguest() {
        $this->title = "Add Guest";
        $this->create_edit_sub();
    }

    function editguest($sub_id = false) {
        $this->title = "Update Guest";
        $this->create_edit_sub($sub_id);
    }

    function deleteguest($sub_id = false) {
        $this->Subscribers->delete_subscribers($sub_id);

        redirect('guest', 'location');
    }

    function create_edit_sub($sub_id = false) {
        $data['title'] = $this->title;
        $data['guest_id'] = $sub_id;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        }
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('room_number', 'Room Number', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $this->Subscribers->insert_data();
                redirect('guest', 'location');
            } else if (isset($_POST['update'])) {
                $this->Subscribers->update_data($sub_id);
                redirect('guest', 'location');
            }
        }

        if ($sub_id == true) {
            $data['message'] = $this->Subscribers->get_record_byid($sub_id);
        }

        $data['status_text'] = $this->rooms->room_status_text()->result();
        $data['packages'] = $this->Subscribers->packages()->result();
        $data['skin'] = $this->Subscribers->skin()->result();
        $data['rooms'] = $this->rooms->get_all(false, false, true)->result();
        $data['greeting'] = $this->greeting->get_all(false, false, true)->result();
        $data['themes'] = $this->Themes_model->get_data(false, false)->result();
        $data['language'] = $this->Language->get_all(false, false)->result();

        $data['main'] = 'backend/create_edit_sub';
        $this->load->view('template', $data);
    }

    /** greeting */
    function addgreeting() {
        $this->title = "Add Greeting";
        $this->create_edit_greeting();
    }

    function editgreeting($sub_id = false) {
        $this->title = "Update Greeting	";
        $this->create_edit_greeting($sub_id);
    }

    function deletegreeting($sub_id = false) {
        $this->greeting->delete_greeting($sub_id);
        redirect('guest/greeting', 'location');
    }

    function greeting() {
        $data['title'] = "greeting ";

        $offset = (int) $this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['greeting'] = $this->greeting->get_all($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/language/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->greeting->get_all()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/greeting';
        $this->load->view('template', $data);
    }

    function create_edit_greeting($sub_id = false) {
        $data['title'] = $this->title;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('title', 'Greeting title', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $this->greeting->insert_data();
                redirect('guest/greeting', 'location');
            } else if (isset($_POST['update'])) {
                $this->greeting->update_data($sub_id);
                redirect('guest/greeting', 'location');
            }
        }

        if ($sub_id == true) {
            $data['greeting'] = $this->greeting->get_record_byid($sub_id);
        }

        $data['main'] = 'backend/create_edit_greeting';
        $this->load->view('template', $data);
    }

    function addotherlanguage($id) {
        $this->title = "Add Other Language";
        $this->create_edit_otherlanguage($id);
    }

    function editotherlanguage($id, $language = false) {
        $this->title = "Update Greeting	";
        $this->create_edit_otherlanguage($id, $language);
    }

    function delete_otherlanguage($id, $language) {
        $this->greeting->delete_otherlanguage($language);
        redirect('guest/otherlanguage/' . $id, 'location');
    }

    function otherlanguage($id) {
        $data['title'] = "Other Languages ";
        $data['greeting_id'] = $id;

        $offset = (int) $this->uri->segment(4);
        $row_count = RECORDS_PERPAGE;

        $data['otherlanguage'] = $this->greeting->get_all_otherlanguage($offset, $row_count, $id)->result();
        $p_config['base_url'] = base_url() . 'index.php/guest/otherlanguage/' . $id . '/';
        $p_config['uri_segment'] = 4;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->greeting->get_all_otherlanguage(false, false, $id)->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/otherlanguage';
        $this->load->view('template', $data);
    }

    function create_edit_otherlanguage($id, $language = false) {
        $data['title'] = $this->title;
        $data['greeting_id'] = $id;
        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('greeting_language', 'Language', 'trim|required|xss_clean');
            $this->form_validation->set_rules('greeting_desc', 'Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('greeting_title', 'Greeting Title', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $this->greeting->insert_otherlanguage_data();
                redirect('guest/otherlanguage/' . $id, 'location');
            } else if (isset($_POST['update'])) {
                $this->greeting->update_otherlanguage_data($language);
                redirect('guest/otherlanguage/' . $id, 'location');
            }
        }

        if ($language == true) {
            $data['otherlanguage'] = $this->greeting->get_record_otherlanguage_byid($language);
        }

        $data['main'] = 'backend/create_edit_otherlanguage';
        $this->load->view('template', $data);
    }

    function guest_restart() {
        $room_id = isset($_POST['room_id']) ? $_POST['room_id'] : '';
        $this->Subscribers->setRoomDevicesToRestart($room_id, 1, $this->TVclass->current_date());
    }

    function device_restart() {
        $device_id = isset($_POST['device_id']) ? $_POST['device_id'] : '';
        $date_modified = $this->TVclass->current_date();
        $need_restart = 1;
        $query = "UPDATE mw_guest_stb SET need_restart=" . $need_restart . ",date_modified='" . $date_modified . "' WHERE device_id = '" . $device_id . "'";
        $this->db->query($query);
    }

    function checked_devices() {

        $device_id = $_POST['dataString'];
        $dataValues = substr($device_id, 0, -1);
        $elements = explode(",", $dataValues);
        for ($index = 0; $index < count($elements); $index++) {
            $date_modified = $this->TVclass->current_date();
            $need_restart = 1;
            $query = "UPDATE mw_guest_stb SET need_restart=" . $need_restart . ",date_modified='" . $date_modified . "' WHERE device_id = '" .$elements[$index]. "'";
            $this->db->query($query);
        }
    }

    function name_language($id) {
        if (intval($id)) {
            $data['title'] = "Name In Other Languages";
            $data['guest_id'] = $id;

            $offset = (int) $this->uri->segment(4);
            $row_count = RECORDS_PERPAGE;

            $data['otherlanguage'] = $this->Subscribers->name_otherlanguages($offset, $row_count, $id)->result();
            $p_config['base_url'] = base_url() . 'index.php/guest/name_language/' . $id . '/';
            $p_config['uri_segment'] = 4;
            $p_config['num_links'] = 2;
            $p_config['total_rows'] = $this->Subscribers->name_otherlanguages(false, false, $id)->num_rows();
            $p_config['per_page'] = $row_count;

            $this->pagination->initialize($p_config);

            $data['pagination'] = $this->pagination->create_links();

            $data['main'] = 'backend/name_otherlanguage';
            $this->load->view('template', $data);
        } else {
            redirect($this->uri->uri_string());
        }
    }

    function addnamelanguage($id) {
        $this->title = "Add Name";
        $this->create_edit_namelanguage($id);
    }

    function editnamelanguage($id, $language = false) {
        $this->title = "Update Name";
        $this->create_edit_namelanguage($id, $language);
    }

    function delete_namelanguage($guest_id, $id) {
        $this->Subscribers->delete_namelanguage($id);
        redirect('guest/name_language/' . $guest_id, 'location');
    }

    function create_edit_namelanguage($guest_id, $id = false) {
        $data['title'] = $this->title;
        $data['guest_id'] = $guest_id;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('language', 'Language', 'trim|required|xss_clean');
            $this->form_validation->set_rules('title', 'Title', 'trim|required|xss_clean');
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $this->Subscribers->insert_namelanguage_data();
                redirect('guest/name_language/' . $data['guest_id'], 'location');
            } else if (isset($_POST['update'])) {
                $this->Subscribers->update_namelanguage_data($id);
                redirect('guest/name_language/' . $data['guest_id'], 'location');
            }
        }

        if ($id == true) {
            $data['otherlanguage'] = $this->Subscribers->get_record_namelanguage_byid($id);
        }

        $data['main'] = 'backend/create_edit_namelanguage';
        $this->load->view('template', $data);
    }

    function guestalarm() {
        $data['title'] = "Guest Alarm";

        if (isset($_POST['request_id']) && $_POST['request_id'] != "") {
            $this->Subscribers->update_alarm_request($_POST['request_id'], 1);
            $alarm_guest_data = $this->Subscribers->get_alarm_request_byid($_POST['request_id'])->row_array();
            $guest_record = $this->Subscribers->get_record_byid($alarm_guest_data['guest']);

            $message_text = 'Your alarm request has been confirmed';

            $this->Subscribers->add_message_log($alarm_guest_data['guest'], $message_text);
        }

        $offset = (int) $this->uri->segment(4);
        $row_count = RECORDS_PERPAGE;

        $data['alerts'] = $this->Subscribers->guest_alarm($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/guest/guestalarm/';
        $p_config['uri_segment'] = 4;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Subscribers->guest_alarm(false, false)->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/guest_alarm';
        $this->load->view('template', $data);
    }

    function delete_alarm_request($id) {
        $this->Subscribers->delete_alarm_request($id);
        $this->session->set_flashdata('guest_alarm', "Request deleted");
        redirect(base_url() . 'index.php/guest/guestalarm/');
    }

}

?>