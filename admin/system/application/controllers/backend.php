<?php

class Backend extends Controller
{

    var $title = "";
    var $session_keyword_weather = 'weather';
    var $session_keyword_tickertape = 'tickertape';

    function Backend()
    {
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
        $this->load->model('weather/Weather_model');
        $this->load->model('tickertape/Tickertape_model');
        $this->load->model('exitmsgmodel'); //Edit by Yesh 
        $this->load->model('middleware/Middleware_model'); //Edit by Yesh 
        $this->load->model('televisions/Televisions_model'); //Edit by Yesh 
        // Protect entire controller so only admin, 
        // and users that have granted role in permissions table can access it.
        $this->dx_auth->check_uri_permissions();
        if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))) {
            redirect('', 'refresh');
        }
    }

    function index()
    {
        $this->users();
    }

    /**
     * Begin Exit Emergency Message - Edit by Yesh
     */
    function add_exitmsg()
    {
        $this->title = "Add Emergency Message";
        $this->create_edit_exitmsg();
    }

    function edit_exitmsg($exitmsg_id = false)
    {
        $this->title = "Update Emergency Message";
        $this->create_edit_exitmsg($exitmsg_id);
    }

    function delete_exitmsg($exitmsg_id = false)
    {
        $this->exitmsgmodel->delete_exitmsg($exitmsg_id);
        redirect('backend/exitmsg', 'location');
    }

    function exitmsg()
    {
        $data['title'] = "Emergency Message";

        $offset = (int)$this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['exitmsg'] = $this->exitmsgmodel->exitmsg_all($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/exitmsg/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->exitmsgmodel->exitmsg_all()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();
        $data['main'] = 'backend/exitmsg';
        $this->load->view('template', $data);
    }

    function create_edit_exitmsg($exitmsg_id = false)
    {
        $data['title'] = $this->title;

        // print_r($_FILES);

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('message', 'Message', 'trim|required|xss_clean');
        }


        if (!empty($_FILES['icon']['name'])) {
            $config['upload_path'] = './icons/EXIT/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('icon')) {
                $error = $this->upload->display_errors();
                $data['upload_file_error'] = $error;
                $is_error = 1;
            } else {
                $filename = './icons/EXIT/' . $this->input->post('file_img_name');
                if (file_exists($filename)) {
                    unlink($filename);
                }
                $is_error = 0;
            }
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $this->exitmsgmodel->exitmsg_insert_data();
                redirect('backend/exitmsg', 'location');
            } else if (isset($_POST['update'])) {
                $this->exitmsgmodel->exitmsg_update_data($exitmsg_id);
                redirect('backend/exitmsg', 'location');
            }
        }

        if ($exitmsg_id == true) {
            $data['exitmsg'] = $this->exitmsgmodel->exitmsg_byid($exitmsg_id);
        }

        $data['main'] = 'backend/create_edit_exitmsg';
        $this->load->view('template', $data);
    }

    //*End Exit Emergency Message - Edit by Yesh *//

    /**
     * Begin Config Middleware - Edit by Yesh
     */
    function config_middleware()
    {
        $data['title'] = 'Config Middleware';
        $offset = (int)$this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;
        $data['settings'] = $this->Middleware_model->get_data($offset, $row_count)->result();
        $data['enumval'] = $this->Middleware_model->get_enum_values('se_view_type');
        $p_config['base_url'] = base_url() . 'index.php/backend/middleware/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Middleware_model->get_data(false, false)->num_rows();
        $p_config['per_page'] = $row_count;
        $this->pagination->initialize($p_config);
        $data['pagination'] = $this->pagination->create_links();
        $data['main'] = 'middleware/index';
        $this->load->view('template', $data);
    }

    function update_config_middleware($se_id = false)
    {
        $this->load->model('themes/Themes_model');
        if (isset($_POST['submit'])) {
            $config['upload_path'] = './icons/LOGO/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);

            if ($se_id == true) {
                if (!empty($_FILES['se_logo']['name'])) {
                    if (!$this->upload->do_upload('se_logo')) {
                        $error = $this->upload->display_errors();
                        $data['image_error'] = $error;
                    } else {
                        $img_data = $this->upload->data();
                    }
                }
            } else {
                if (!$this->upload->do_upload('se_logo')) {
                    $error = $this->upload->display_errors();
                    $data['image_error'] = $error;
                } else {
                    $img_data = $this->upload->data();
                }
            }
            if (!isset($error)) {
                if ($se_id == true) {
                    if (!empty($_FILES['se_logo']['name'])) {
                        $filename = './icons/LOGO/' . basename($this->input->post('edit_image'));
                        if (file_exists($filename)) {
                            unlink($filename);
                        }
                        $get_img_data = array('file_name' => $img_data['file_name']);
                    } else {
                        $get_img_data = array('file_name' => $this->input->post('edit_image'));
                        $this->session->set_flashdata('settings_message', "Settings updated");
                    }
                    $this->Middleware_model->update_data($get_img_data, $se_id);
                    redirect('backend/config_middleware', 'location');
                } else {
                    redirect('backend/config_middleware', 'location');
                }
            }
        }
    }

    //* End Config Middleware - Edit by Yesh *//

    /**
     * Television Brands - Edit by Yesh
     */
    function television_brands()
    {
        $data['title'] = 'Television Brands';
        $offset = (int)$this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;
        $data['tvbrands'] = $this->Televisions_model->get_data($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/television_brands/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Televisions_model->get_data(false, false)->num_rows();
        $p_config['per_page'] = $row_count;
        $this->pagination->initialize($p_config);
        $data['pagination'] = $this->pagination->create_links();
        $data['main'] = 'televisions/index';
        $this->load->view('template', $data);
    }

    function add_television_brands()
    {
        $this->title = "Add Television Brands";
        $this->create_edit_television_brands();
    }

    function edit_television_brands($id = false)
    {
        $this->title = "Update Television Brands";
        $this->create_edit_television_brands($id);
    }

    function delete_television_brands($id = false)
    {
        $this->Televisions_model->delete_data($id);
        redirect('backend/television_brands', 'location');
    }

    function create_edit_television_brands($id = false)
    {
        $data['title'] = $this->title;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('brnd_name', 'Brand Name', 'trim|required');
            $this->form_validation->set_rules('brnd_folder', 'Brand Folder', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                if (isset($_POST['submit'])) {
                    $this->Televisions_model->insert_data();
                    redirect('backend/television_brands');
                } else if (isset($_POST['update'])) {
                    $this->Televisions_model->update_data($id);
                    redirect('backend/television_brands');
                }
            }
        }

        if ($id == true) {
            $data['edit_data'] = $this->Televisions_model->get_data_byid($id)->row_array();
        }

        $data['main'] = 'televisions/add_edit';
        $this->load->view('template', $data);
    }

    //* Television Brands - Edit by Yesh *//

    /**
     * channelgroup
     */
    function channelgroup()
    {
        $data['title'] = "CHANNEL GROUP";
        $this->load->model('dx_auth/channelgroup', 'channelgroup');

        /* Database related */

        // If Add role button pressed
        if (isset($_POST['add'])) {
            // Create role
            $this->channelgroup->create_role($this->input->post('role_name'), $this->input->post('role_parent'));
        } else if (isset($_POST['delete'])) {
            // Loop trough $_POST array and delete checked checkbox
            foreach ($_POST as $key => $value) {
                // If checkbox found
                if (substr($key, 0, 9) == 'checkbox_') {
                    // Delete role
                    $this->channelgroup->delete_role($value);
                }
            }
        }

        /* Showing page to user */

        // Get all roles from database
        $data['roles'] = $this->channelgroup->get_all()->result();

        // Load view
        //$this->load->view('backend/roles', $data);
        $data['main'] = 'backend/channelgroup';
        $this->load->vars($data);
        $this->load->view('template', $data);
    }

    function channel_permissions()
    {

        /* function trim_value(&$value) {
          $value = trim($value);
          }
         */
        $this->load->model('dx_auth/channelgroup', 'roles');
        $this->load->model('MTV', 'channels');
        $this->load->model('dx_auth/channel_permissions', 'chpermissions');

        if (isset($_POST['save'])) {
            // Convert back text area into array to be stored in permission data
            //print_r($this->input->post('allowed_uris'));
            //$allowed_uris = explode("\n", $this->input->post('allowed_uris'));
            $allowed_uris = $this->input->post('allowed_uris');
            // Remove white space if available
            //array_walk($allowed_uris, 'trim_value');
            // Set URI permission data
            // IMPORTANT: uri permission data, is saved using 'uri' as key.
            // So this key name is preserved, if you want to use custom permission use other key.
            //$allowed_uris = explode(",", $this->input->post('allowed_uris'));
            $this->chpermissions->set_permission_value($this->input->post('role'), 'uri', $allowed_uris);
        }

        /* Showing page to user */

        // Default role_id that will be showed
        $role_id = $this->input->post('role') ? $this->input->post('role') : 1;
        //Added by Yesh - 25062019
        $data['role_id'] = $role_id;

        // Get all role from database
        $data['roles'] = $this->roles->get_all()->result();
        // Get allowed uri permissions
        //$data['allowed_uris'] = $this->chpermissions->get_permission_value($role_id, 'uri');
        $data['allowed_uris'] = $this->chpermissions->get_permission_valueme($role_id);
        //print_r($data['allowed_uris']);
        $data['all_channels'] = $this->channels->getAllChannels();

        //print_r($data['allowed_uris']);
        // Load view
        //	$this->load->view('backend/uri_permissions', $data);
        $data['main'] = 'backend/channel_permissions';
        $this->load->vars($data);
        $this->load->view('template', $data);
    }

    function roles_channelgroups()
    {
        $this->load->model('dx_auth/roles', 'roles');
        $this->load->model('dx_auth/channelgroup', 'channels');
        $this->load->model('dx_auth/channel_role_permissions', 'chpermissions');

        if (isset($_POST['save'])) {
            // Convert back text area into array to be stored in permission data
            //print_r($this->input->post('allowed_uris'));
            //$allowed_uris = explode("\n", $this->input->post('allowed_uris'));
            $allowed_uris = $this->input->post('allowed_uris');
            //print_r($allowed_uris);
            // Remove white space if available
            //array_walk($allowed_uris, 'trim_value');
            // Set URI permission data
            // IMPORTANT: uri permission data, is saved using 'uri' as key.
            // So this key name is preserved, if you want to use custom permission use other key.
            //$allowed_uris = explode(",", $this->input->post('allowed_uris'));
            $this->chpermissions->set_permission_value($this->input->post('role'), 'uri', $allowed_uris);
        }

        /* Showing page to user */

        // Default role_id that will be showed
        $role_id = $this->input->post('role') ? $this->input->post('role') : 1;
        //Added by Yesh - 25062019
        $data['role_id'] = $role_id;

        // Get all role from database
        $data['roles'] = $this->roles->get_all()->result();
        $data['room_groups'] = $this->rooms->room_groups_all()->result();
        // Get allowed uri permissions
        //$data['allowed_uris'] = $this->chpermissions->get_permission_value($role_id, 'uri');
        $data['allowed_uris'] = $this->chpermissions->get_permission_valueme($role_id);
        //print_r($data['allowed_uris']);
        $data['all_channels'] = $this->channels->get_all_groups();

        //print_r($data['allowed_uris']);
        // Load view
        //	$this->load->view('backend/uri_permissions', $data);
        $data['main'] = 'backend/roles_channel_permissions';
        $this->load->vars($data);
        $this->load->view('template', $data);
    }

    function stb_permissions()
    {

        function trim_value(&$value)
        {
            $value = trim($value);
        }

        $this->load->model('dx_auth/roles', 'roles');
        $this->load->model('dx_auth/stb_permissions', 'stbpermissions');

        if ($this->input->post('save')) {
            // Convert back text area into array to be stored in permission data
            $allowed_uris = explode("\n", $this->input->post('allowed_uris'));

            // Remove white space if available
            array_walk($allowed_uris, 'trim_value');

            // Set URI permission data
            // IMPORTANT: uri permission data, is saved using 'uri' as key.
            // So this key name is preserved, if you want to use custom permission use other key.
            $this->stbpermissions->set_permission_value($this->input->post('role'), 'uri', $allowed_uris);
        }

        /* Showing page to user */

        // Default role_id that will be showed
        $role_id = $this->input->post('role') ? $this->input->post('role') : 1;
        //Added by Yesh - 25062019
        $data['role_id'] = $role_id;

        // Get all role from database
        $data['roles'] = $this->roles->get_all()->result();
        // Get allowed uri permissions
        $data['allowed_uris'] = $this->stbpermissions->get_permission_value($role_id, 'uri');

        // Load view
        //	$this->load->view('backend/uri_permissions', $data);
        $data['main'] = 'backend/stb_permissions';
        $this->load->vars($data);
        $this->load->view('template', $data);
    }

    function addskin()
    {
        $this->title = "Add Skin";
        $this->create_edit_skin();
    }

    function editskin($skin_id = false)
    {
        $this->title = "Update Skin";
        $this->create_edit_skin($skin_id);
    }

    function deleteskin($skin_id = false)
    {
        $this->Skins->delete_skin($skin_id);
        redirect('backend/skins', 'location');
    }

    function skins()
    {
        $data['title'] = 'Skins';

        $offset = (int)$this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['skins'] = $this->Skins->get_all($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/skins/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Skins->get_all()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/skins';
        $this->load->view('template', $data);
    }

    function create_edit_skin($skin_id = false)
    {
        $data['title'] = $this->title;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('sk_name', 'Skin name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('sk_css', 'Skin Css ', 'trim|required|xss_clean');
        }
        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $this->Skins->insert_data();
                redirect('backend/skins', 'location');
            } else if (isset($_POST['update'])) {
                $this->Skins->update_data($skin_id);
                redirect('backend/skins', 'location');
            }
        }

        if ($skin_id == true) {
            $data['skins'] = $this->Skins->get_record_byid($skin_id);
        }

        $data['main'] = 'backend/create_edit_skins';
        $this->load->view('template', $data);
    }

    function addlanguage()
    {
        $this->title = "Add Language";
        $this->create_edit_language();
    }

    function editlanguage($lang_id = false)
    {
        $this->title = "Update Language";
        $this->create_edit_language($lang_id);
    }

    function deletelanguage($lang_id = false)
    {
        $this->Language->delete_language($lang_id);
        redirect('backend/language', 'location');
    }

    function language()
    {
        $data['title'] = "Language";

        $offset = (int)$this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['language'] = $this->Language->get_all($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/language/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Language->get_all()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/language';
        $this->load->view('template', $data);
    }

    function create_edit_language($lang_id = false)
    {
        $data['title'] = $this->title;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('short_label', 'Short label', 'trim|required|xss_clean');
            $this->form_validation->set_rules('desc', 'Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('hotel_lang_tag', 'Hotel language tag', 'trim|required|xss_clean');
            $this->form_validation->set_rules('dateformat', 'Date format', 'trim|required|xss_clean');
            $this->form_validation->set_rules('timeformat', 'Time format', 'trim|required|xss_clean');
            $this->form_validation->set_rules('price_decimals', 'Price decimals', 'trim|required|xss_clean');
            $this->form_validation->set_rules('price_decimal_sign', 'Price decimal sign', 'trim|required|xss_clean');
            $this->form_validation->set_rules('price_thousand_sign', 'Price thousand sign', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $this->Language->insert_data();
                redirect('backend/language', 'location');
            } else if (isset($_POST['update'])) {
                $this->Language->update_data($lang_id);
                redirect('backend/language', 'location');
            }
        }

        if ($lang_id == true) {
            $data['language'] = $this->Language->get_record_byid($lang_id);
        }

        $data['main'] = 'backend/create_edit_language';
        $this->load->view('template', $data);
    }

    /* occation */

    function addoccation()
    {
        $this->title = "Add Occation";
        $this->create_edit_occation();
    }

    function editoccation($sub_id = false)
    {
        $this->title = "Update Occation";
        $this->create_edit_occation($sub_id);
    }

    function deleteoccation($sub_id = false)
    {
        $this->Occation->delete_occation($sub_id);
        redirect('backend/occation', 'location');
    }

    function occation()
    {
        $data['title'] = "Occation";

        $offset = (int)$this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['occation'] = $this->Occation->get_all($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/language/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Occation->get_all()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/occation';
        $this->load->view('template', $data);
    }

    function create_edit_occation($sub_id = false)
    {
        $data['title'] = $this->title;
        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('occation_name', 'Occation', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $this->Occation->insert_data();
                redirect('backend/occation', 'location');
            } else if (isset($_POST['update'])) {
                $this->Occation->update_data($sub_id);
                redirect('backend/occation', 'location');
            }
        }

        if ($sub_id == true) {
            $data['occation'] = $this->Occation->get_record_byid($sub_id);
        }

        //$data['occations']		= $this->Occation->occations()->result();

        $data['main'] = 'backend/create_edit_occation';
        $this->load->view('template', $data);
    }

    /* Rooms */

    function addrooms()
    {
        $this->title = "Add Rooms";
        $this->create_edit_rooms();
    }

    function editrooms($sub_id = false)
    {
        $this->title = "Update Rooms";
        $this->create_edit_rooms($sub_id);
    }

    function deleterooms($sub_id = false)
    {
        $this->rooms->delete_room($sub_id);
        redirect('backend/rooms', 'location');
    }

    function rooms()
    {
        $data['title'] = "Rooms";
        $offset = (int)$this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['rooms'] = $this->rooms->get_all($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/rooms/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->rooms->get_all()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/rooms';
        $this->load->view('template', $data);
    }

    /**
     *
     * Validating form
     */
    function create_edit_rooms($sub_id = false)
    {
        $data['title'] = $this->title;
        $is_error = 0;
        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('room_number', 'Room number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('room_type', 'Room type', 'trim|required|xss_clean');

            $image_data = array();

            $config['upload_path'] = ROOM_PATH;
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 1024;
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $config['max_width'] = 1290;
            $config['max_height'] = 1024;

            $this->load->library('upload', $config);

            $upload = $this->upload->do_upload('emergency_img');

            if ($upload === FALSE) {
                $is_error = 1;
                $error = $this->upload->display_errors();
                $data['upload_file_error'] = $error;
            }
            if ($upload === TRUE) {
                $image_data = $this->upload->data();
            }

            if ($this->form_validation->run() == TRUE) {
                if (isset($_POST['submit'])) {
                    $this->rooms->insert_data($image_data);
                    redirect('backend/rooms', 'location');
                } else if (isset($_POST['update'])) {
                    $this->rooms->update_data($sub_id, $image_data);
                    redirect('backend/rooms', 'location');
                }
            }
        }

        if ($sub_id == true) {
            $data['rooms'] = $this->rooms->get_record_byid($sub_id);
        }

        $data['packages'] = $this->rooms->packages()->result();
        $data['device_type'] = $this->rooms->device_type()->result();
        $data['room_type'] = $this->rooms->get_room_type()->result();

        $data['main'] = 'backend/create_edit_rooms';
        $this->load->view('template', $data);
    }

    /** Devices * */
    function adddevice()
    {
        $this->title = "Add Device";
        if (DEVICE_LIMIT > $this->Devices->device_count()) {
            $this->create_edit_devices();
        } else {
            redirect('backend/devices', 'location');
        }
    }

    function editdevice($device_id = false)
    {
        $this->title = "Update Device";
        $this->create_edit_devices($device_id);
    }

    function deletedevice($device_id = false)
    {
        $this->Devices->deletedevice($device_id);
        redirect('backend/devices', 'location');
    }

    function devices()
    {
        $data['title'] = "Devices";
        $data['total_devices'] = $this->Devices->device_count();
        $offset = (int)$this->uri->segment(3);
        //$orderby = $this->uri->segment(4);
        $orderby = "ASC";
        $attempts = $this->uri->segment(4);
        $data['attempts'] = intval(false);
        if ($attempts == "") {
            $data['attempts'] = intval(true);
            $this->Devices->device_status_update(0, 0);
        }
        $data['offset'] = $offset;
        $row_count = RECORDS_PERPAGE;
        $data['devices'] = $this->Devices->device_all($offset, $row_count, $orderby)->result();
        $base_url = base_url() . 'index.php/backend/devices/';
        $p_config['base_url'] = $base_url;
        $data['base_url'] = $base_url;
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Devices->device_all()->num_rows();
        $p_config['per_page'] = $row_count;
        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();
        $data['main'] = 'backend/devices';
        $this->load->view('template', $data);
    }

    // function devices($attempts = false)
    // {
    //     $data['attempts'] = intval(false);
    //     if (!$attempts) {
    //         $data['attempts'] = intval(true);
    //         $this->Devices->device_status_update(0, 0);
    //         $offset = (int)$this->uri->segment(3);
    //         $orderby = $this->uri->segment(4);
    //     } else {
    //         $offset = (int)$this->uri->segment(5);
    //         $orderby = $this->uri->segment(6);
    //     }
    //     $data['title'] = "Devices";
    //     $data['total_devices'] = $this->Devices->device_count();
    //     $row_count = RECORDS_PERPAGE;
    //     $data['devices'] = $this->Devices->device_all($offset, $row_count, $orderby)->result();
    //     $p_config['base_url'] = base_url() . 'index.php/backend/devices/';
    //     $p_config['uri_segment'] = 3;
    //     $p_config['num_links'] = 2;
    //     $p_config['total_rows'] = $this->Devices->device_all()->num_rows();
    //     $p_config['per_page'] = $row_count;

    //     $this->pagination->initialize($p_config);

    //     $data['pagination'] = $this->pagination->create_links();

    //     $data['main'] = 'backend/devices';
    //     $this->load->view('template', $data);
    // }

    function create_edit_devices($device_id = false)
    {
        $data['title'] = $this->title;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('UID', 'UID', 'trim|required|xss_clean');
            $this->form_validation->set_rules('mac_address', 'Mac Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('device_type', 'Device Type', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $data_exist = $this->Devices->device_bymac($this->input->post('mac_address'));
                //print count($data_exist);exit;
                if (count($data_exist) == 0 && DEVICE_LIMIT > $this->Devices->device_count()) {
                    $this->Devices->device_insert_data();
                }
                redirect('backend/devices', 'location');
            } else if (isset($_POST['update'])) {
                $this->Devices->device_update_data($device_id);
                redirect('backend/devices', 'location');
            }
        }

        if ($device_id == true) {
            $data['devices'] = $this->Devices->device_byid($device_id);
        }

        $data['devicetype'] = $this->Devices->device_types_all()->result();

        $data['main'] = 'backend/create_edit_devices';
        $this->load->view('template', $data);
    }

    /** Device Types * */
    function adddevtypes()
    {
        $this->title = "Add Device Type";
        $this->create_edit_devtypes();
    }

    function editdevtypes($dev_type_id = false)
    {
        $this->title = "Update Device Type";
        $this->create_edit_devtypes($dev_type_id);
    }

    function deletedevtypes($dev_type_id = false)
    {
        $this->Devices->delete_devtype($dev_type_id);
        redirect('backend/devicetypes', 'location');
    }

    function devicetypes()
    {
        $data['title'] = "Device Types";

        $offset = (int)$this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['devicetypes'] = $this->Devices->device_types_all($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/devicetypes/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Devices->device_types_all()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/devicetypes';
        $this->load->view('template', $data);
    }

    function create_edit_devtypes($dev_type_id = false)
    {
        $data['title'] = $this->title;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('device_type', 'Device Type', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $this->Devices->devtype_insert_data();
                redirect('backend/devicetypes', 'location');
            } else if (isset($_POST['update'])) {
                $this->Devices->devtype_update_data($dev_type_id);
                redirect('backend/devicetypes', 'location');
            }
        }

        if ($dev_type_id == true) {
            $data['devicetypes'] = $this->Devices->device_type_byid($dev_type_id);
        }

        $data['main'] = 'backend/create_edit_devtypes';
        $this->load->view('template', $data);
    }

    /** greeting */
    //genre
    function addgenreitv()
    {
        $this->title = "Add Genre";
        $this->create_edit_genre();
    }

    function editgenreitv($sub_id = false)
    {
        $this->title = "Update Genre";
        $this->create_edit_genre($sub_id);
    }

    function deleteGenre($sub_id = false)
    {
        $this->mgenre->deleteGenre2($sub_id);

        redirect('backend/genre_itv', 'location');
    }

    function genre_itv()
    {
        $data['title'] = "Genre";

        $offset = (int)$this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['mgenre'] = $this->mgenre->getAllgenre2($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/language/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->mgenre->getAllgenre2()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/genre_itv';
        //$this->load->view('template',$data);
        $this->load->view('template', $data);
    }

    function create_edit_genre($sub_id = false)
    {
        $data['title'] = $this->title;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $this->mgenre->addgenre2();
                redirect('backend/genre_itv', 'location');
            } else if (isset($_POST['update'])) {
                $this->mgenre->Updategenre2($sub_id);
                redirect('backend/genre_itv', 'location');
            }
        }

        if ($sub_id == true) {
            $data['mgenre'] = $this->mgenre->get_record_byid($sub_id);
        }

        $data['main'] = 'backend/create_edit_genre_vod';
        $this->load->view('template', $data);
    }

    function listapilinks()
    {
        $data['title'] = "API Links";

        $data['main'] = 'backend/listlinks';
        $this->load->view('template', $data);
    }

    function addthemes()
    {
        $this->title = "Add Themes";
        $this->add_edit_themes();
    }

    function editthemes($id = false)
    {
        $this->title = "Update Themes";
        $this->add_edit_themes($id);
    }

    function deletethemes($id = false)
    {
        $this->load->model('themes/Themes_model');
        $this->Themes_model->delete_data($id);
        $this->session->set_flashdata('themes_message', "Themes Deleted");
        redirect('backend/themes', 'location');
    }

    function themes()
    {
        $this->load->model('themes/Themes_model');
        $data['title'] = 'Themes';

        $offset = (int)$this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;

        $data['themes'] = $this->Themes_model->get_data($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/themes/index/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Themes_model->get_data()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'themes/index';
        $this->load->view('template', $data);
    }

    function add_edit_themes($id = false)
    {
        $this->load->model('themes/Themes_model');
        $data['title'] = $this->title;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('th_name', 'Name', 'trim|required');
            $this->form_validation->set_rules('th_folder', 'Folder', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                if ($id == true) {
                    $this->Themes_model->update_data($id);
                    $this->session->set_flashdata('themes_message', "Theme updated");
                } else {
                    $this->Themes_model->insert_data();
                    $this->session->set_flashdata('themes_message', "Theme created");
                }
                redirect('backend/themes', 'location');
            }
        }

        if ($id == true) {
            $data['edit_data'] = $this->Themes_model->get_data_byid($id)->row_array();
        }

        $data['main'] = 'themes/add_edit';
        $this->load->view('template', $data);
    }

    function addsettings_bak()
    {
        $this->title = "Add Settings";
        $this->add_edit_settings();
    }

    function editsettings($id = false)
    {
        $this->title = "Update Settings";
        $this->add_edit_settings($id);
    }

    function deletesettings($id = false)
    {
        $this->load->model('settings/Settings_model');
        $this->Settings_model->delete_data($id);
        $this->session->set_flashdata('settings_message', "Settings Deleted");
        redirect('backend/settings', 'location');
    }

    function settings()
    {
        $this->load->model('settings/Settings_model');
        $data['title'] = 'Settings';

        $offset = (int)$this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;

        $data['radio'] = $this->Settings_model->get_data($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/settings/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Settings_model->get_data()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'settings/index';
        $this->load->view('template', $data);
    }

    /**
     * backgrounds - adding backgrounds to modules
     * Added by Yesh - 2016-08-10
     */
    function backgrounds()
    {
        $this->load->model('backgrounds/Backgrounds_model');
        $data['title'] = 'Backgrounds';
        $offset = (int)$this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;
        $data['result'] = $this->Backgrounds_model->get_all_data($offset, $row_count)->result();
        $data['enumval'] = $this->Backgrounds_model->get_enum_values('background_module');
        $p_config['base_url'] = base_url() . 'index.php/backend/backgrounds/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Backgrounds_model->get_all_data()->num_rows();
        $p_config['per_page'] = $row_count;
        $this->pagination->initialize($p_config);
        $data['pagination'] = $this->pagination->create_links();
        $data['main'] = 'backgrounds/index';
        $this->load->view('template', $data);
    }

    function addbackground()
    {
        $this->title = "Add Background";
        $this->create_edit_background();
    }

    function editbackground($background_id = false)
    {
        $this->title = "Update Background";
        $this->create_edit_background($background_id);
    }

    function deletebackground($background_id = false)
    {
        $this->load->model('backgrounds/Backgrounds_model');
        $this->Backgrounds_model->delete_data($background_id);
        redirect('backend/backgrounds', 'location');
    }

    function create_edit_background($background_id = false)
    {
        $this->load->model('backgrounds/Backgrounds_model');
        $data['title'] = $this->title;
        $data['enumval'] = $this->Backgrounds_model->get_enum_values('background_module');

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('background_module', 'Background Module', 'trim|required|xss_clean');
        }

        if (!empty($_FILES['background_image']['name'])) {
            $config['upload_path'] = './icons/BGS/';
            $config['allowed_types'] = 'jpg|png';
            //$config['max_size'] = '1000';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('background_image')) {
                $error = $this->upload->display_errors();
                $data['upload_file_error'] = $error;
                $is_error = 1;
            } else {
                $img_data = $this->upload->data();
                $filename = $img_data['file_name'];
                $is_error = 0;
            }
        } else {
            $filename = $this->input->post('edit_image');
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $this->Backgrounds_model->insert_data($filename);
                redirect('backend/backgrounds', 'location');
            } else if (isset($_POST['update'])) {
                $this->Backgrounds_model->update_data($filename, $background_id);
                redirect('backend/backgrounds', 'location');
            }
        }

        if ($background_id == true) {
            $data['edit_data'] = $this->Backgrounds_model->get_data_byid($background_id);
        }

        $data['main'] = 'backgrounds/add_edit';
        $this->load->view('template', $data);
    }

    function add_edit_settings($id = false)
    {
        $this->load->model('settings/Settings_model');
        $this->load->model('themes/Themes_model');

        $data['title'] = $this->title;

        if (isset($_POST['submit']) || isset($_POST['update'])) {

            $config['upload_path'] = './icons/LOGO/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = '1024';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;

            $config['max_width'] = '1024';
            $config['max_height'] = '768';
            $this->load->library('upload', $config);

            if ($id == true) {
                if (!empty($_FILES['se_logo']['name'])) {
                    if (!$this->upload->do_upload('se_logo')) {
                        $error = $this->upload->display_errors();
                        $data['image_error'] = $error;
                    } else {
                        $img_data = $this->upload->data();
                    }
                }
            } else {
                if (!$this->upload->do_upload('se_logo')) {
                    $error = $this->upload->display_errors();
                    $data['image_error'] = $error;
                } else {
                    $img_data = $this->upload->data();
                }
            }

            if (!isset($error)) {
                if ($id == true) {
                    if (!empty($_FILES['se_logo']['name'])) {
                        $filename = './icons/LOGO/' . basename($this->input->post('edit_image'));
                        if (file_exists($filename)) {
                            unlink($filename);
                        }
                        $get_img_data = array('file_name' => $img_data['file_name']);
                    } else {
                        $get_img_data = array('file_name' => $this->input->post('edit_image'));
                        $this->session->set_flashdata('settings_message', "Settings updated");
                    }
                    $this->Settings_model->update_data($get_img_data, $id);
                } else {
                    $this->Settings_model->insert_data($img_data);
                    $this->session->set_flashdata('radio_message', "Radio created");
                }
                redirect('backend/settings', 'location');
            }
        }

        if ($id == true) {
            $data['edit_data'] = $this->Settings_model->get_data_byid($id)->row_array();
        }

        $data['current_theme'] = $this->Themes_model->get_data()->result();

        $data['main'] = 'settings/add_edit';
        $this->load->view('template', $data);
    }

    function roomdevice($id)
    {
        $data['room_id'] = $id;
        $data['room'] = $this->rooms->get_record_byid($id);

        if (isset($_POST['add_device'])) {
            $this->rooms->insert_room_device();
        } else if (isset($_POST['delete_id']) && $_POST['delete_id'] != "") {
            $this->rooms->delete_room_device($_POST['delete_id']);
        }

        $data['devices'] = $this->Devices->device_all(false, false, true)->result();
        $data['room_devices'] = $this->rooms->get_room_device($id)->result();
        $this->load->view('backend/room_device', $data);
    }

    /** Room Types * */
    function addroomtypes()
    {
        $this->title = "Add Room Type";
        $this->create_edit_roomtypes();
    }

    function editroomtypes($room_type_id = false)
    {
        $this->title = "Update Room Type";
        $this->create_edit_roomtypes($room_type_id);
    }

    function deleteroomtypes($room_type_id = false)
    {
        $this->rooms->delete_roomtype($room_type_id);
        redirect('backend/roomtypes', 'location');
    }

    function roomtypes()
    {
        $data['title'] = "Room Types";

        $offset = (int)$this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['roomtypes'] = $this->rooms->room_types_all($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/roomtypes/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->rooms->room_types_all()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/roomtypes';
        $this->load->view('template', $data);
    }

    function create_edit_roomtypes($room_type_id = false)
    {
        $data['title'] = $this->title;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('rt_type', 'Room Type', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $this->rooms->roomtype_insert_data();
                redirect('backend/roomtypes', 'location');
            } else if (isset($_POST['update'])) {
                $this->rooms->roomtype_update_data($room_type_id);
                redirect('backend/roomtypes', 'location');
            }
        }

        if ($room_type_id == true) {
            $data['roomtypes'] = $this->rooms->room_type_byid($room_type_id);
        }

        $data['main'] = 'backend/create_edit_roomtypes';
        $this->load->view('template', $data);
    }

    /** Room groups * */
    function addroomgroups()
    {
        $this->title = "Add Room Group";
        $this->create_edit_roomgroups();
    }

    function editroomgroups($room_group_id = false)
    {
        $this->title = "Update Room Group";
        $this->create_edit_roomgroups($room_group_id);
    }

    function deleteroomgroups($room_group_id = false)
    {
        $this->rooms->delete_roomgroup($room_group_id);
        redirect('backend/roomgroups', 'location');
    }

    function roomgroups()
    {
        $data['title'] = "Room Groups";
        $offset = (int)$this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['roomgroups'] = $this->rooms->room_groups_all($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/roomgroups/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->rooms->room_groups_all()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/roomgroups';
        $this->load->view('template', $data);
    }

    function create_edit_roomgroups($room_group_id = false)
    {
        $data['title'] = $this->title;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('rg_name', 'Room Group Name', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $id = $this->rooms->room_group_insert_data();
                redirect('backend/editroomgroups/' . $id, 'location');
            } else if (isset($_POST['update'])) {
                $this->rooms->room_group_update_data($room_group_id);
                redirect('backend/roomgroups', 'location');
            }
        }

        if ($room_group_id == true) {
            $data['roomgroups'] = $this->rooms->room_group_byid($room_group_id);
            $data['rooms'] = $this->rooms->get_all(false, false)->result();
            $data['group_room'] = $this->rooms->get_group_room($room_group_id)->result();
        }

        $data['main'] = 'backend/create_edit_roomgroups';
        $this->load->view('template', $data);
    }

    function weather()
    {
        $data['title'] = 'Weather';
        $data['session_keyword'] = $this->session_keyword_weather;

        $offset = (int)$this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;

        $data['weather'] = $this->Weather_model->get_data($offset, $row_count, $data['session_keyword'])->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/weather/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Weather_model->get_data(false, false, $data['session_keyword'])->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'weather/index';
        $this->load->view('template', $data);
    }

    function addweather()
    {
        $this->title = "Add Weather";
        $this->add_edit_weather();
    }

    function editweather($id = false)
    {
        $this->title = "Update Weather";
        $this->add_edit_weather($id);
    }

    function deleteweather($id)
    {
        $this->Weather_model->delete_data($id);
        $this->session->set_flashdata('weather_message', "Radio Deleted");
        redirect('backend/weather');
    }

    function add_edit_weather($id = false)
    {
        $data['title'] = $this->title;
        $data['session_keyword'] = $this->session_keyword_weather;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('weather_url', 'Weather URL', 'trim|required');
            $this->form_validation->set_rules('language', 'Language', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                if (isset($_POST['submit'])) {
                    $this->Weather_model->insert_data();
                    $this->session->set_flashdata('weather_message', "Weather added");
                    redirect('backend/weather');
                } else if (isset($_POST['update'])) {
                    $this->Weather_model->update_data($id);
                    $this->session->set_flashdata('weather_message', "Weather updated");
                    redirect('backend/weather');
                }
            }
        }

        if ($id == true) {
            $data['edit_data'] = $this->Weather_model->get_data_byid($id)->row_array();
        }

        $data['main'] = 'weather/add_edit';
        $this->load->view('template', $data);
    }

    /** Ticker Tape * */
    function tickertape()
    {
        $data['title'] = 'Ticker Tape';
        $data['session_keyword'] = $this->session_keyword_tickertape;

        $offset = (int)$this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;

        $data['tickertape'] = $this->Tickertape_model->get_data($offset, $row_count, $data['session_keyword'])->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/tickertape/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Tickertape_model->get_data(false, false, $data['session_keyword'])->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'tickertape/index';
        $this->load->view('template', $data);
    }

    function addtickertape()
    {
        $this->title = "Add Ticker Tape";
        $this->add_edit_tickertape();
    }

    function edittickertape($id = false)
    {
        $this->title = "Update Ticker Tape";
        $this->add_edit_tickertape($id);
    }

    function deletetickertape($id)
    {
        $this->Tickertape_model->delete_data($id);
        $this->session->set_flashdata('tickertape_message', "Ticker Tape Deleted");
        redirect('backend/tickertape');
    }

    function add_edit_tickertape($id = false)
    {
        $data['title'] = $this->title;
        $data['session_keyword'] = $this->session_keyword_tickertape;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('tickertape_url', 'Ticker Tape URL', 'trim|required');
            $this->form_validation->set_rules('language', 'Language', 'trim|required');

            if ($this->form_validation->run() == TRUE) {
                if (isset($_POST['submit'])) {
                    $this->Tickertape_model->insert_data();
                    $this->session->set_flashdata('tickertape_message', "Ticker Tape added");
                    redirect('backend/tickertape');
                } else if (isset($_POST['update'])) {
                    $this->Tickertape_model->update_data($id);
                    $this->session->set_flashdata('tickertape_message', "Ticker Tape updated");
                    redirect('backend/tickertape');
                }
            }
        }

        if ($id == true) {
            $data['edit_data'] = $this->Tickertape_model->get_data_byid($id)->row_array();
        }

        $data['main'] = 'tickertape/add_edit';
        $this->load->view('template', $data);
    }

    /**
     * function addvodsettings(){
     * $this->title = "Add VOD Settings";
     * $this->add_edit_vodsettings();
     * }
     * */
    function editvodsettings($id = false)
    {
        $this->title = "Update VOD Settings";
        $this->add_edit_vodsettings($id);
    }

    function deletevodsettings($id = false)
    {
        $this->load->model('MProducts');
        $this->MProducts->delete_data_vodsettings($id);
        $this->session->set_flashdata('vodsettings_message', "Themes Deleted");
        redirect('backend/themes', 'location');
    }

    function vod()
    {
        $this->load->model('MProducts');
        $data['title'] = 'VOD Settings';

        $offset = (int)$this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;

        $data['themes'] = $this->MProducts->get_data_vodsettings($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/backend/vodsettings/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->MProducts->get_data_vodsettings()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'vodsettings/index';
        $this->load->view('template', $data);
    }

    function add_edit_vodsettings($id = false)
    {
        $this->load->model('MProducts');
        $data['title'] = $this->title;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('se_pin_number', 'PIN Number', 'integer|trim|required');
            $this->form_validation->set_rules('se_vod_cost', 'Cost', 'is_numeric|trim|required');

            if ($this->form_validation->run() == TRUE) {
                if ($id == true) {
                    $this->MProducts->update_data_vodsettings($id);
                    $this->session->set_flashdata('vodsettings_message', "VOD settings updated");
                } else {
                    $this->MProducts->insert_data_vodsettings();
                    $this->session->set_flashdata('vodsettings_message', "VOD settings created");
                }
                redirect('backend/vod', 'location');
            }
        }

        if ($id == true) {
            $data['edit_data'] = $this->MProducts->get_data_vodsettings_byid($id)->row_array();
        }

        $data['main'] = 'vodsettings/add_edit';
        $this->load->view('template', $data);
    }

    function addconfig()
    {
        $this->title = "Add Config";
        $this->add_edit_config();
    }

    function editconfig($id = false)
    {
        $this->title = "Mail Configuration";
        $this->add_edit_config($id);
    }

    function configuration()
    {
        $this->load->model('settings/Settings_model');
        $data['title'] = 'Mail Configuration';
        $offset = (int)$this->uri->segment(3);
        $row_count = RECORDS_PERPAGE;

        $data['configuration'] = $this->Settings_model->get_data($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/configuraton/index/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->Settings_model->get_data()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'configuration/index';
        $this->load->view('template', $data);
    }

    function add_edit_config($id = false)
    {
        $this->load->model('settings/Settings_model');
        $data['title'] = $this->title;

        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('se_table_booking', 'Table booking', 'trim|valid_email');
            $this->form_validation->set_rules('se_wakeup_call', 'Wake Up Call', 'trim|valid_email');
            //$this->form_validation->set_rules('se_restaurant_booking', 'Restaurant Booking Call', 'trim|valid_email');
            $this->form_validation->set_rules('se_order_taxi', 'Order Taxi', 'trim|valid_email');
            $this->form_validation->set_rules('se_room_service', 'Room Service Request', 'trim|valid_email');
            $this->form_validation->set_rules('se_laundery_request', 'Laundery Request', 'trim|valid_email');

            if ($this->form_validation->run() == TRUE) {
                if ($id == true) {
                    $this->Settings_model->update_config_data($id);
                    $this->session->set_flashdata('config_message', "Configuration updated");
                } else {
                    //$this->Settings_model->insert_data();
                    //$this->session->set_flashdata('config_message', "Configuration created");
                }
                redirect('backend/configuration', 'location');
            }
        }

        if ($id == true) {
            $data['edit_data'] = $this->Settings_model->get_data_byid($id)->row_array();
        }

        $data['main'] = 'configuration/add_edit';
        $this->load->view('template', $data);
    }

}

?>