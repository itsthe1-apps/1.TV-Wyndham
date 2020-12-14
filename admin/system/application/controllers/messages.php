<?php

class Messages extends Controller {

    var $title = "";

    function Messages() {
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
        // $this->dx_auth->check_uri_permissions();
        // if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))) {
        //     redirect('', 'refresh');
        // }
    }

    function index() {
        $data['title'] = "Message ";

        $offset = (int) $this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['message'] = $this->message->get_all($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/language/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->message->get_all()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/message_view';
        $this->load->view('template', $data);
    }

    //subscribers = guest
    //message
    //////////////////
    function addmessage() {
        $this->title = "Add Message";
        $this->create_edit_message();
    }

    function editmessage($sub_id = false) {
        $this->title = "Update Message	";
        $this->create_edit_message($sub_id);
    }

    function deletemessage($sub_id = false) {
        $this->message->delete_message($sub_id);
        redirect('messages', 'location');
    }

    function create_edit_message($sub_id = false) {
        $data['title'] = $this->title;
        $data['msg_id'] = $sub_id;

        if (isset($_POST['submit'])) {
            $this->message->insert_data();
            redirect('messages', 'location');
        } else if (isset($_POST['update'])) {
            $this->message->update_data($sub_id);
            redirect('messages', 'location');
        }

        if ($sub_id == true) {
            $data['message'] = $this->message->get_record_byid($sub_id);
        }

        $data['guest_list'] = $this->message->get_guest_list($sub_id)->result();
        $data['main'] = 'backend/message';
        $this->load->view('template', $data);
    }

}

?>
