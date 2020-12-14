<?php

class Room extends Controller {

    var $title = "";

    function Room() {
        parent::Controller();

        $this->load->library('Table');
        $this->load->library('Pagination');
        $this->load->library('DX_Auth');
        $this->load->library('Form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->model('Rooms');

        // Protect entire controller so only admin, 
        // and users that have granted role in permissions table can access it.
        if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))) {
            redirect('', 'refresh');
        }
        $this->dx_auth->check_uri_permissions();
    }

    function index() {
        $this->filter();
    }

    function filter($flag = false, $delete_room_numer = false) {
        //print $flag;
        if ($delete_room_numer == true && intval($delete_room_numer)) {
            $this->Rooms->delete_roomstatus($delete_room_numer);
        }
        $flag = ($flag) ? $flag : "occupancy";
        if ($flag) {
            switch ($flag) {
                case "occupancy" :
                    $data['column1'] = "Occupied";
                    $data['column2'] = "Date/Time";
                    $data['column3'] = "Guests";
                    break;
                case "vacantstatus" :
                    $data['column1'] = "Vacant Status";
                    $data['column2'] = "Date/Time";
                    $data['column3'] = "User";

                    break;
                case "maintenancerequired" :
                    $data['column1'] = "Status";
                    $data['column2'] = "Date/Time";
                    $data['column3'] = "User";

                    break;
                case "extrabed" :
                    $data['column1'] = "Status";
                    $data['column2'] = "Date/Time";
                    $data['column3'] = "User";

                    break;
                case "babycot" :
                    $data['column1'] = "Status";
                    $data['column2'] = "Date/Time";
                    $data['column3'] = "User";

                    break;
                case "cleaningrequired" :
                    $data['column1'] = "Room Cleaning";
                    $data['column2'] = "Date/Time";
                    $data['column3'] = "User";

                    break;
                case "turndown" :
                    $data['column1'] = "Status";
                    $data['column2'] = "Date/Time";
                    $data['column3'] = "User";

                    break;
                case "undermaintenance" :
                    $data['column1'] = "Status";
                    $data['column2'] = "Date/Time";
                    $data['column3'] = "User";

                    break;
            }
        }
        $data['title'] = "Rooms";
        $data['flag'] = $flag;
        $offset = (int) $this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;
        $data['subscribers'] = $this->Rooms->get_roomsts_filter($offset, $row_count, $flag)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/language/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Rooms->get_roomsts_filter(false, false, $flag)->num_rows();
        $p_config['per_page'] = $row_count;
        $this->pagination->initialize($p_config);
        $data['pagination'] = $this->pagination->create_links();
        $data['main'] = 'backend/roomstatus';
        $this->load->view('template', $data);
    }

    function editroom($sub_id = false, $delete_room_guest = false) {
        if ($delete_room_guest == true && intval($delete_room_guest)) {
            $this->Rooms->delete_room_guest($delete_room_guest);
        }
        $this->title = "Update Room Status";
        $this->create_edit_room($sub_id);
    }

    function deleteguest($sub_id = false) {
        $this->Subscribers->delete_subscribers($sub_id);
        redirect('guest', 'location');
    }

    function create_edit_room($sub_id = false) {
        $data['title'] = $this->title;

        if (isset($_POST['submit'])) {
            //$this->Rooms->insert_data();
            redirect('guest', 'location');
        } else if (isset($_POST['update'])) {
            $this->Rooms->update_roomstatus($sub_id);
            redirect('room', 'location');
        }

        if ($sub_id == true) {
            $data['record'] = $this->Rooms->get_roomstatus_byid($sub_id);
            $data['room_guest'] = $this->Rooms->room_guest($sub_id)->result();
        }
        $data['main'] = 'backend/create_edit_roomstatus';
        $this->load->view('template', $data);
    }

    /**
      function delete_room_status($room_number){
      $this->Rooms->delete_roomstatus($room_number);
      redirect('room/filter/'.$this->flag);
      }
     * */

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
            $this->form_validation->set_rules('description', 'Description', 'trim|required|xss_clean');
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

}

?>