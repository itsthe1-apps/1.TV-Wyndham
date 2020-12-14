<?php

class Restaurant extends Model {

    function Restaurant() {
        parent::Model();
        $this->load->helper('url');

        $this->db_prefix = $this->db->dbprefix;
        $this->restaurant = $this->config->item($this->db->dbprefix . 'restaurant');
        $this->restaurant_time = $this->config->item($this->db->dbprefix . 'restaurant_time');
        $this->restaurant_time_tracker = $this->config->item($this->db->dbprefix . 'restaurant_time_tracker');
        $this->rest_menus = $this->config->item($this->db->dbprefix . 'rest_menus');
        $this->rest_menutype = $this->config->item($this->db->dbprefix . 'rest_menutype');
        $this->detail_rest_menutype = $this->db->dbprefix . 'detail_rest_menutype';
    }

    function getAllRestaurant($offset = 0, $row_count = 0, $session_keyword = false) {

        if ($session_keyword == true) {
            if ($this->session->userdata($session_keyword) != "") {
                $this->db->where('language', $this->session->userdata($session_keyword));
            } else {
                $this->db->where('language', $this->config->item('system_lang'));
            }
        }

        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('id', 'asc');
            $query = $this->db->get($this->restaurant, $row_count, $offset);
        } else {
            $this->db->orderby('id', 'asc');
            $query = $this->db->get($this->restaurant);
        }
        return $query;
    }

    function getRestaurant($id) {
        $data = array();

        $this->db->where('id', $id);

        $Q = $this->db->get($this->restaurant);

        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }

        $Q->free_result();

        return $data;
    }

    function add($img_data) {
        $data = array(
            'name' => $this->TVclass->Replacechar($this->input->post('name')),
            'image' => isset($img_data) ? $img_data : "",
            'daliy_time' => $this->input->post('daliy_time'),
            'breakf_time' => $this->input->post('breakf_time'),
            'lunch_time' => $this->input->post('lunch_time'),
            'dinner_time' => $this->input->post('dinner_time'),
            'dress' => $this->input->post('dress'),
            'venue' => $this->input->post('venue'),
            'is_service' => $this->input->post('is_service'),
            //'menu_image'	=> isset($img_data[2]['file_name']) ? $this->TVclass->set_image_path('RESTAURANT',$img_data[2]['file_name']) : "",
            'description' => htmlentities($this->input->post('description'), ENT_QUOTES, "UTF-8"),
            'date_added' => $this->TVclass->current_date(),
            'language' => $this->input->post('language')
        );
        $this->db->insert($this->restaurant, $data);
        $last_id = $this->db->insert_id();

        $total_fields = $this->input->post('total_fields');
        $this->insert_resturant_time($last_id, $total_fields);
        $this->TVclass->update_flag('restaurant');
    }

    function Update($img_data, $id) {
        
        
        $data = array(
            'name' => $this->TVclass->Replacechar($this->input->post('name')),
            'image' => $img_data,
            'daliy_time' => $this->input->post('daliy_time'),
            'breakf_time' => $this->input->post('breakf_time'),
            'lunch_time' => $this->input->post('lunch_time'),
            'dinner_time' => $this->input->post('dinner_time'),
            'dress' => $this->input->post('dress'),
            'venue' => $this->input->post('venue'),
            'is_service' => $this->input->post('is_service'),
            //'menu_image'	=> $img_data['file_name2']!="" ? $img_data['file_name2'] : $this->input->post('file_img_name2'),
            'description' => htmlentities($this->input->post('description'), ENT_QUOTES, "UTF-8"),
            'date_modified' => $this->TVclass->current_date(),
            'language' => $this->input->post('language')
        );
        
        $this->db->where('id', $id);
        $this->db->update($this->restaurant, $data);

        $this->db->where('rt_rest_id', $id);
        $this->db->delete($this->restaurant_time);

        $total_fields = $this->input->post('total_fields');
        $this->insert_resturant_time($id, $total_fields);
        $this->TVclass->update_flag('restaurant');
    }

    function insert_resturant_time($rest_id, $total_fields) {
        $sh = array();
        $sm = array();
        $eh = array();
        $em = array();

        for ($i = 1; $i <= $total_fields; $i++) {
            $start_hours = $this->input->post('start_hours_' . $i);
            $start_minutes = $this->input->post('start_minutes_' . $i);
            $end_hours = $this->input->post('end_hours_' . $i);
            $end_minutes = $this->input->post('end_minutes_' . $i);

            $sh[] = $start_hours;
            $sm[] = $start_minutes;
            $eh[] = $end_hours;
            $em[] = $end_minutes;

            $from_time = strtotime($start_hours . ":" . $start_minutes);
            $end_time = strtotime($end_hours . ":" . $end_minutes);

            $different_minute = round(abs($end_time - $from_time) / 60, 2);

            $interval = $this->input->post('int_minutes');

            $int_depend_diff = $different_minute / $interval;

            $attempts = ceil($int_depend_diff);

            if ($attempts > 0) {
                $set_time = $start_hours . ":" . $start_minutes;

                $this->ins_time($rest_id, $set_time);

                for ($k = 1; $k <= $attempts; $k++) {

                    $date = date('H:i', strtotime($set_time . " +" . $interval . " minutes"));

                    $set_time = $date;

                    //print $set_time.'<br>';

                    $this->ins_time($rest_id, $set_time);
                }
            }
        }
        if (count($sh) > 0 || count($sm) > 0 || count($eh) > 0 || count($em) > 0) {
            $this->delete_time_tracker($rest_id);
            $this->time_tracker($sh, $sm, $eh, $em, $rest_id);
        }
    }

    function time_tracker($start_hours, $start_minutes, $end_hours, $end_minutes, $restaurant_id) {
        $data = array(
            'rtt_rest_id' => $restaurant_id,
            'rtt_sh' => implode(",", $start_hours),
            'rtt_sm' => implode(",", $start_minutes),
            'rtt_eh' => implode(",", $end_hours),
            'rtt_em' => implode(",", $end_minutes),
            'rtt_interval' => $this->input->post('int_hours') . ':' . $this->input->post('int_minutes')
        );
        $this->db->insert($this->restaurant_time_tracker, $data);
    }

    function ins_time($rest_id, $set_time) {
        $data = array('rt_rest_id' => $rest_id, 'rt_rest_time' => $set_time);
        $this->db->insert($this->restaurant_time, $data);
    }

    function deleteRestaurant($id) {
        $get_img = $this->getRestaurant($id);

        $filename = RESTAURANT_PATH . basename($get_img['image']);
        //$filename2 = RESTAURANT_PATH . "\\" . basename($get_img['menu_image']);

        if (file_exists($filename)) {
            unlink($filename);
        }
        /**
          if (file_exists($filename2)) {
          unlink($filename2);
          }
         * */
        $this->db->where('id', $id);
        $this->db->delete($this->restaurant);

        $this->delete_restaurant_time($id);
        $this->delete_time_tracker($id);
        $this->TVclass->update_flag('restaurant');
    }

    function getAllResMenu($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('name', 'asc');
            $query = $this->db->get($this->rest_menus, $row_count, $offset);
        } else {
            $this->db->orderby('name', 'asc');
            $query = $this->db->get($this->rest_menus);
        }
        return $query;
    }

    function add_menu($img_data) {
        $data = array(
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'description' => htmlentities($this->input->post('description'), ENT_QUOTES, "UTF-8"),
            'price' => $this->input->post('price') . ' AED',
            'restaurant' => $this->input->post('restaurant'),
            'to_date' => $this->input->post('to_date'),
            'date_added' => $this->TVclass->current_date(),
            'menu_order' => $this->input->post('menu_order'),
            'image' => $img_data['file_name'] != "" ? $img_data['file_name'] : "",
        );
        $this->db->insert($this->rest_menus, $data);
        $this->TVclass->update_flag('restaurant');
    }

    function getAllResMenu_byid($id) {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get($this->rest_menus);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function update_menu($img_data, $id) {
        $data = array(
            'type' => $this->input->post('type'),
            'name' => $this->input->post('name'),
            'description' => htmlentities($this->input->post('description'), ENT_QUOTES, "UTF-8"),
            'price' => $this->input->post('price') . ' AED',
            'restaurant' => $this->input->post('restaurant'),
            'to_date' => $this->input->post('to_date'),
            'menu_order' => $this->input->post('menu_order'),
            'image' => $img_data['file_name'] != "" ? $img_data['file_name'] : "",
            'date_modified' => $this->TVclass->current_date(),
        );

        $this->db->where('id', $id);
        $this->db->update($this->rest_menus, $data);
        $this->TVclass->update_flag('restaurant');
    }

    function deleteRestaurant_menu($id) {
        $get_img = $this->getAllResMenu_byid($id);
        $filename = RESTAURANT_PATH . "\\" . basename($get_img['image']);

        if (file_exists($filename)) {
            unlink($filename);
        }

        $this->db->where('id', $id);
        $this->db->delete($this->rest_menus);
        $this->TVclass->update_flag('restaurant');
    }

    function getAllResMenutype($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('name', 'asc');
            $query = $this->db->get($this->rest_menutype, $row_count, $offset);
        } else {
            $this->db->orderby('name', 'asc');
            $query = $this->db->get($this->rest_menutype);
        }
        return $query;
    }

    function getAllResMenutype_byid($id) {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get($this->rest_menutype);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function add_menu_type() {
        $data = array(
            'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
            'date_added' => $this->TVclass->current_date()
        );
        $this->db->insert($this->rest_menutype, $data);
        $this->TVclass->update_flag('restaurant');
    }

    function update_menu_type($id) {
        $data = array(
            'name' => $this->input->post('name'),
            'code' => $this->input->post('code'),
            'date_modified' => $this->TVclass->current_date()
        );
        $this->db->where('id', $id);
        $this->db->update($this->rest_menutype, $data);
        $this->TVclass->update_flag('restaurant');
    }

    function deleteRestaurant_menutype($id) {

        $this->db->where('type', $id);
        $Q = $this->db->get($this->rest_menus);

        if ($Q->num_rows() == 0) {
            $this->db->where('id', $id);
            $this->db->delete($this->rest_menutype);
            $this->TVclass->update_flag('restaurant');
        } else {
            $this->session->set_flashdata('rmt_m', "Sorry! You can't delete this record because it is in use by other page(s).");
            redirect('backend/restaurantmenutype', 'location');
        }
    }

    function delete_restaurant_time($id) {
        $this->db->where('rt_rest_id', $id);
        $this->db->delete($this->restaurant_time);
    }

    function get_time_tracker($rest_id) {
        $this->db->where('rtt_rest_id', $rest_id);
        $query = $this->db->get($this->restaurant_time_tracker);
        return $query;
    }

    function delete_time_tracker($id) {
        $this->db->where('rtt_rest_id', $id);
        $this->db->delete($this->restaurant_time_tracker);
    }

    /** Other Languages * */
    function get_all_otherlanguage($offset = 0, $row_count = 0, $id) {
        $this->db->where('rest_mtype_id', $id);
        $this->db->orderby('rest_mtype_id', 'asc');

        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->detail_rest_menutype, $row_count, $offset);
        } else {
            $query = $this->db->get($this->detail_rest_menutype);
        }
        //print_r($this->db->last_query());
        return $query;
    }

    function insert_otherlanguage_data() {
        $data = array(
            'rest_mtype_id' => $this->input->post('rest_mtype_id'),
            'rest_mtype_desc' => $this->input->post('rest_mtype_desc'),
            'rest_mtype_language' => $this->input->post('rest_mtype_language'),
        );
        $this->db->insert($this->detail_rest_menutype, $data);
    }

    function update_otherlanguage_data($id) {
        $data = array(
            'rest_mtype_id' => $this->input->post('rest_mtype_id'),
            'rest_mtype_desc' => $this->input->post('rest_mtype_desc'),
            'rest_mtype_language' => $this->input->post('rest_mtype_language'),
        );
        $this->db->where('rest_detail_id', $id);
        $this->db->update($this->detail_rest_menutype, $data);
    }

    function get_record_otherlanguage_byid($id) {
        $data = array();
        $this->db->where('rest_detail_id', $id);
        $Q = $this->db->get($this->detail_rest_menutype);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        //print_r($this->db->last_query());
        $Q->free_result();
        return $data;
    }

    function get_record_otherlanguage_bylang($lang) {
        $data = array();
        $this->db->where('rest_mtype_language', $lang);
        $this->db->order_by('rest_mtype_desc', 'ASC');
        $Q = $this->db->get($this->detail_rest_menutype);
        return $Q;
    }

    function delete_otherlanguage($id) {
        $this->db->where('rest_detail_id', $id);
        $this->db->delete($this->detail_rest_menutype);
    }

    function alter_table_otherlanguage() {
        $query = 'ALTER TABLE ' . $this->detail_rest_menutype . ' AUTO_INCREMENT 1';
        $this->db->query($query);
    }

}
