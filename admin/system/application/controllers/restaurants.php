<?php

class Restaurants extends Controller {

    var $title = "";
    var $session_keyword = "resturant";
    var $image_width = 760;
    var $image_height = 400;
    var $image_width_menu = 331;
    var $image_height_menu = 400;

    function Restaurants() {
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
        $this->dx_auth->check_uri_permissions();
        if (in_array($this->uri->segment(1), unserialize(BLOCKED_MODULES))) {
            redirect('', 'refresh');
        }
    }

    function index() {
        $data['title'] = "Restaurant";
        $data['session_keyword'] = $this->session_keyword;

        $offset = (int) $this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['restaurant'] = $this->restaurant->getAllRestaurant($offset, $row_count, $data['session_keyword'])->result();
        $p_config['base_url'] = base_url() . 'index.php/restaurants/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->restaurant->getAllRestaurant(false, false, $data['session_keyword'])->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/restaurant';
        $this->load->view('template', $data);
    }

    function addrestaurant() {
        $this->title = "Add Restaurant";
        $this->create_restaurant();
    }

    function editrestaurant($id = false) {
        $this->title = "Edit Restaurant";
        $this->edit_restaurant($id);
    }

    function deletrestaurant($id = false) {
        $this->restaurant->deleteRestaurant($id);
        redirect('restaurants', 'location');
    }

    function create_restaurant() {
        $data['title'] = $this->title;
        $data['session_keyword'] = $this->session_keyword;
        $data['task'] = 'add';
        $is_error = 0;
        $data['image_width'] = $this->image_width;
        $data['image_height'] = $this->image_height;

        $this->load->helper('ckeditor');

        $fileName = "";

        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            $config['upload_path'] = RESTAURANT_PATH;
            $config['allowed_types'] = 'gif|jpg|png';
            //$config['max_size'] = '1024';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;

            $config['max_width'] = $data['image_width'];
            $config['max_height'] = $data['image_height'];
            $this->load->library('upload', $config);

            $files = $_FILES['icon1'];

            foreach ($files['name'] as $key => $image) {
                $_FILES['icon1[]']['name'] = $files['name'][$key];
                $_FILES['icon1[]']['type'] = $files['type'][$key];
                $_FILES['icon1[]']['tmp_name'] = $files['tmp_name'][$key];
                $_FILES['icon1[]']['error'] = $files['error'][$key];
                $_FILES['icon1[]']['size'] = $files['size'][$key];
//                    $newfilename = str_replace(" ", "_", $temp[0]) . date('_m-d-Y_Hi') . '.' . end($temp);
                $fileName .= $image . "|";
                $this->upload->initialize($config);
                if ($this->upload->do_upload('icon1[]')) {
                    $this->upload->data();
                } else {
                    $is_error = 1;
                    $error = $this->upload->display_errors();
                    $data['upload_file_error'] = $error;
                }
            }




//            $upload = $this->upload->do_upload('icon1');
//            if ($upload === FALSE) {
//                $is_error = 1;
//                $error = $this->upload->display_errors();
//                $data['upload_file_error'] = $error;
//            }
//            if ($upload === TRUE) {
//                $uploadedFiles = $this->upload->data();
//            }
            $fileName = substr($fileName, 0, -1);
            if ($this->form_validation->run() == TRUE && $is_error == 0) {
                $img_data = $this->upload->data();
                $this->restaurant->add($fileName);
                $this->session->set_flashdata('movie_c', "Restaurant created");
                redirect('restaurants', 'location');
            }

            /**
              if (!$this->upload->do_upload('icon') || !$this->upload->do_upload('menu_icon')) {
              $error = $this->upload->display_errors();
              $data['upload_file_error'] = $error;
              $is_error = 1;
              } else {
              $is_error = 0;
              }

              if ($this->form_validation->run() == TRUE || $is_error == 0) {
              $img_data = $this->upload->data();
              $this->restaurant->add($img_data);
              $this->session->set_flashdata('movie_c', "Restaurant created");
              redirect('backend/restaurant', 'location');
              }
             * */
        }
        $data['main'] = 'backend/create_edit_restaurant';
        $this->load->view('template', $data);
    }

    function edit_restaurant($id = false) {
        $data['title'] = $this->title;
        $data['session_keyword'] = $this->session_keyword;
        $data['task'] = 'update';
        $is_error = 0;
        $data['image_width'] = $this->image_width;
        $data['image_height'] = $this->image_height;
        $this->load->helper('ckeditor');

        if (isset($_POST['update'])) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            $uploadedFiles = array();
            $fileName = '';
            $update_img_name = '';
            if (!empty($_FILES['icon1']['name'])) {
                $config['upload_path'] = RESTAURANT_PATH;
                $config['allowed_types'] = 'gif|jpg|png';
                //$config['max_size'] = '1024';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                $config['max_width'] = $data['image_width'];
                $config['max_height'] = $data['image_height'];

                $this->load->library('upload', $config);
                $files = $_FILES['icon1'];

                $upload = $files['name'][0] != '';
                if (!$upload) {
                    if ($this->input->post('rest_current_imgs')) {
                        $update_img_name = $this->input->post('rest_current_imgs');
                    } else {
                        $data['upload_file_error'] = $this->upload->display_errors();
                    }
                } else {
                    //1.png|2.png|3.png|4.jpg|5.jpg|6.jpg|7.jpg
                    foreach ($files['name'] as $key => $image) {
                        $_FILES['icon1[]']['name'] = $files['name'][$key];
                        $_FILES['icon1[]']['type'] = $files['type'][$key];
                        $_FILES['icon1[]']['tmp_name'] = $files['tmp_name'][$key];
                        $_FILES['icon1[]']['error'] = $files['error'][$key];
                        $_FILES['icon1[]']['size'] = $files['size'][$key];
//                    $newfilename = str_replace(" ", "_", $temp[0]) . date('_m-d-Y_Hi') . '.' . end($temp);
                        $fileName .= $image . "|";
                        $this->upload->initialize($config);
                        if ($this->upload->do_upload('icon1[]')) {
                            $this->upload->data();
                        } else {
                            $is_error = 1;
                            $error = $this->upload->display_errors();
                            $data['upload_file_error'] = $error;
                        }
                    }
                }
            }
            /**
              if (!empty($_FILES['icon']['name'])) {

              $config['upload_path'] = RESTAURANT_PATH;
              $config['allowed_types'] = 'gif|jpg|png';
              $config['max_size'] = '1024';
              $config['remove_spaces'] = true;
              $config['overwrite'] = false;

              $config['max_width'] = '1024';
              $config['max_height'] = '768';
              $this->load->library('upload', $config);

              if (!$this->upload->do_upload('icon')) {
              $error = $this->upload->display_errors();
              $data['upload_file_error'] = $error;
              $is_error = 1;
              } else {
              $is_error = 0;
              }
              }
             * */
            $imgData = substr($fileName, 0, -1);
            if ($this->form_validation->run() == TRUE && $is_error == 0) {


//                if (!empty($_FILES['icon1']['name'])) {
//                    if (!empty($_FILES['icon1']['name'])) {
//                        $filename = RESTAURANT_PATH . basename($this->input->post('file_img_name1'));
//                        if (file_exists($filename)) {
//                            unlink($filename);
//                        }
//                    }
//                    $get_data = $this->upload->data();
//                    //$get_data = $uploadedFiles;
//                    //$img_data = array('file_name'=>$this->TVclass->set_image_path("RESTAURANT",$get_data['file_name']));
//                    $img_data = array('file_name1' => $imgData);
//                } else {
////                    $set_img_array = array('file_name1' => $this->input->post('file_img_name1
//                    $set_img_array = array('file_name1' => $imgData);
//                    $img_data = $set_img_array;
//                }
                
                if ($update_img_name != '') {
                    $imgData = $update_img_name;
                }
                
                $this->restaurant->update($imgData, $id);


                $this->session->set_flashdata('movie_c', "Restaurant updated");
                redirect('restaurants', 'location');
            }
        }

        if ($id == true) {
            $data['restaurant'] = $this->restaurant->getRestaurant($id);
            $data['time_tracker'] = $this->restaurant->get_time_tracker($id)->row_array();
        }
        $data['main'] = 'backend/create_edit_restaurant';
        $this->load->view('template', $data);
    }

    /** Restaturant Menu * */
    function addrestaurantmenu() {
        $this->title = "Add Restaurant Menu";
        $this->create_restaurant_menu();
    }

    function editrestaurantmenu($id = false) {
        $this->title = "Edit Restaurant Menu";
        $this->edit_restaurant_menu($id);
    }

    function deletrestaurantmenu($id = false) {
        $this->restaurant->deleteRestaurant_menu($id);
        $this->session->set_flashdata('rm_m', "Restaurant Menu Deleted");
        redirect('restaurants/restaurantmenu', 'location');
    }

    function restaurantmenu() {
        $data['title'] = "Restaurant Menu";

        $offset = (int) $this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['rest_menu'] = $this->restaurant->getAllResMenu($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/restaurants/restaurantmenu/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->restaurant->getAllResMenu()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/restaurant_menu';
        $this->load->view('template', $data);
    }

    function create_restaurant_menu() {
        $data['title'] = $this->title;
        $data['task'] = 'add';
        $is_error = 0;
        $data['image_width_menu'] = $this->image_width_menu;
        $data['image_height_menu'] = $this->image_height_menu;
        $this->load->helper('ckeditor');

        if (isset($_POST['submit'])) {

            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('type', 'Type', 'trim|required');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|is_numeric');
            $this->form_validation->set_rules('restaurant', 'Restaurant', 'trim|required|is_numeric');
            $this->form_validation->set_rules('to_date', 'To Date', 'trim|required|valid_date[Y-m-d,-]');
            $this->form_validation->set_rules('menu_order', 'Menu order', 'trim|required|integer');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');

            $config['upload_path'] = RESTAURANT_PATH;
            $config['allowed_types'] = 'gif|jpg|png';
            //$config['max_size'] = '1024';
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;

            $config['max_width'] = $data['image_width_menu'];
            $config['max_height'] = $data['image_height_menu'];
            $this->load->library('upload', $config);

            if ($this->form_validation->run() == TRUE) {
                if (!$this->upload->do_upload('image')) {
                    $error = $this->upload->display_errors();
                    $data['upload_file_error'] = $error;
                    $is_error = 1;
                } else {
                    $img_data = $this->upload->data();
                }
            }
        }

        if ($this->form_validation->run() == TRUE && $is_error == 0) {
            $this->restaurant->add_menu($img_data);
            $this->session->set_flashdata('rm_m', "Restaurant menu created");
            redirect('restaurants/restaurantmenu', 'location');
        }

        $data['menu_type'] = $this->restaurant->getAllResMenutype()->result();
        $data['restaurant'] = $this->restaurant->getAllRestaurant()->result();

        $data['main'] = 'backend/create_edit_resturant_menu';
        $this->load->view('template', $data);
    }

    function edit_restaurant_menu($id = false) {
        $data['title'] = $this->title;
        $data['task'] = 'update';
        $is_error = 0;
        $data['image_width_menu'] = $this->image_width_menu;
        $data['image_height_menu'] = $this->image_height_menu;
        $this->load->helper('ckeditor');

        if (isset($_POST['update'])) {

            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('type', 'Type', 'trim|required');
            $this->form_validation->set_rules('price', 'Price', 'trim|required|is_numeric');
            $this->form_validation->set_rules('restaurant', 'Restaurant', 'trim|required|is_numeric');
            $this->form_validation->set_rules('to_date', 'To Date', 'trim|required|valid_date[Y-m-d,-]');
            $this->form_validation->set_rules('menu_order', 'Menu order', 'trim|required|integer');
            $this->form_validation->set_rules('description', 'Description', 'trim|required');


            if (!empty($_FILES['image']['name'])) {
                $config['upload_path'] = RESTAURANT_PATH;
                $config['allowed_types'] = 'gif|jpg|png';
                //$config['max_size'] = '1024';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;

                $config['max_width'] = $data['image_width_menu'];
                $config['max_height'] = $data['image_height_menu'];

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('image')) {
                    $error = $this->upload->display_errors();
                    $data['upload_file_error'] = $error;
                    $is_error = 1;
                } else {
                    $img_data = $this->upload->data();
                }
            }

            if ($this->form_validation->run() == TRUE && !isset($error)) {
                if (!empty($_FILES['image']['name'])) {
                    $filename = RESTAURANT_PATH . "\\" . basename($this->input->post('file_img_name'));
                    if (file_exists($filename)) {
                        unlink($filename);
                    }
                    $get_data = $this->upload->data();
                    $img_data = array('file_name' => $get_data['file_name']);
                } else {
                    $img_data = array('file_name' => $this->input->post('file_img_name'));
                }
                $this->restaurant->update_menu($img_data, $id);
                $this->session->set_flashdata('rm_m', "Restaurant menu updated");
                redirect('restaurants/restaurantmenu', 'location');
            }
        }

        if ($id == true) {
            $data['rest_menu'] = $this->restaurant->getAllResMenu_byid($id);
        }
        $data['menu_type'] = $this->restaurant->getAllResMenutype()->result();
        $data['restaurant'] = $this->restaurant->getAllRestaurant()->result();

        $data['main'] = 'backend/create_edit_resturant_menu';
        $this->load->view('template', $data);
    }

    /** Restaturant Menu Type * */
    function addrestaurantmenutype() {
        $this->title = "Add Restaurant Menu Type";
        $this->create_restaurant_menutype();
    }

    function editrestaurantmenutype($id = false) {
        $this->title = "Edit Restaurant Menu Type";
        $this->edit_restaurant_menutype($id);
    }

    function deletrestaurantmenutype($id = false) {
        $this->restaurant->deleteRestaurant_menutype($id);
        $this->session->set_flashdata('rmt_m', "Restaurant Menu Type Deleted");
        redirect('restaurants/restaurantmenutype', 'location');
    }

    function restaurantmenutype() {
        $data['title'] = "Restaurant Menu Type";

        $offset = (int) $this->uri->segment(3);

        $row_count = RECORDS_PERPAGE;

        $data['rest_menutype'] = $this->restaurant->getAllResMenutype($offset, $row_count)->result();
        $p_config['base_url'] = base_url() . 'index.php/restaurants/restaurantmenutype/';
        $p_config['uri_segment'] = 3;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->restaurant->getAllResMenutype()->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/restaurant_menutype';
        $this->load->view('template', $data);
    }

    function create_restaurant_menutype() {
        $data['title'] = $this->title;
        $data['task'] = 'add';
        $is_error = 0;

        $uploadedFiles = array();

        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('code', 'Code', 'required');

            if ($this->form_validation->run() == TRUE) {
                $this->restaurant->add_menu_type();
                $this->session->set_flashdata('rmt_m', "Restaurant Menu Created");
                redirect('restaurants/restaurantmenutype', 'location');
            }
        }

        $data['main'] = 'backend/create_edit_resturant_menutype';
        $this->load->view('template', $data);
    }

    function edit_restaurant_menutype($id = false) {
        $data['title'] = $this->title;
        $data['task'] = 'update';
        $is_error = 0;

        if (isset($_POST['update'])) {
            $this->form_validation->set_rules('name', 'Name', 'required');
            $this->form_validation->set_rules('code', 'Code', 'required');

            if ($this->form_validation->run() == TRUE) {
                $this->restaurant->update_menu_type($id);
                $this->session->set_flashdata('rmt_m', "Restaurant Menu Updated");
                redirect('restaurants/restaurantmenutype', 'location');
            }
        }

        $data['rest_menutype'] = $this->restaurant->getAllResMenutype_byid($id);

        $data['main'] = 'backend/create_edit_resturant_menutype';
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
        $this->restaurant->delete_otherlanguage($language);
        redirect('restaurants/otherlanguage/' . $id, 'location');
    }

    function otherlanguage($id) {
        $data['title'] = "Other Languages ";
        $data['rest_mtype_id'] = $id;

        $offset = (int) $this->uri->segment(4);
        $row_count = RECORDS_PERPAGE;

        $data['otherlanguage'] = $this->restaurant->get_all_otherlanguage($offset, $row_count, $id)->result();
        $p_config['base_url'] = base_url() . 'index.php/restaurants/otherlanguage/' . $id . '/';
        $p_config['uri_segment'] = 4;
        $p_config['num_links'] = 2;
        $p_config['total_rows'] = $this->restaurant->get_all_otherlanguage(false, false, $id)->num_rows();
        $p_config['per_page'] = $row_count;

        $this->pagination->initialize($p_config);

        $data['pagination'] = $this->pagination->create_links();

        $data['main'] = 'backend/restaurant_otherlanguage';
        $this->load->view('template', $data);
    }

    function create_edit_otherlanguage($id, $language = false) {
        $data['title'] = $this->title;
        $data['rest_mtype_id'] = $id;
        if (isset($_POST['submit']) || isset($_POST['update'])) {
            $this->form_validation->set_rules('rest_mtype_language', 'Language', 'trim|required|xss_clean');
            $this->form_validation->set_rules('rest_mtype_desc', 'Name', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == TRUE) {
            if (isset($_POST['submit'])) {
                $this->restaurant->insert_otherlanguage_data();
                redirect('restaurants/otherlanguage/' . $id, 'location');
            } else if (isset($_POST['update'])) {
                $this->restaurant->update_otherlanguage_data($language);
                redirect('restaurants/otherlanguage/' . $id, 'location');
            }
        }

        if ($language == true) {
            $data['otherlanguage'] = $this->restaurant->get_record_otherlanguage_byid($language);
        }

        $data['main'] = 'backend/create_edit_rest_otherlanguage';
        $this->load->view('template', $data);
    }

    function ajax_menutype() {
        $language = isset($_POST['language']) ? $_POST['language'] : '';
        $selected = isset($_POST['selected']) ? $_POST['selected'] : '';
        $data = $this->restaurant->get_record_otherlanguage_bylang($language)->result();
        $opt_restaurant[''] = 'Select';
        if (count($data) > 0) {
            foreach ($data as $rt) {
                $opt_restaurant[$rt->rest_detail_id] = $rt->rest_mtype_desc;
            }
        }
        print form_dropdown('type', $opt_restaurant, $selected);
    }

}

?>