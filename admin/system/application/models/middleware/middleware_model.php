<?php

class Middleware_model extends Model {

    function Middleware_model() {
        parent::Model();
        $this->load->helper('url');

        $this->db_prefix = $this->db->dbprefix;
        $this->settings = $this->db->dbprefix . 'settings';
    }

    function get_data($offset = 0, $row_count = 0) {
        $this->db->orderby('se_id', 'asc');
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->settings, $row_count, $offset);
        } else {
            $query = $this->db->get($this->settings);
        }
        return $query;
    }

    /**
     * get_enum_values
     * @param type $col
     * @return type array
     * Added by Yesh
     */
    function get_enum_values($col) {
        $data = array();
        $type = $this->db->query("SHOW COLUMNS FROM $this->settings WHERE Field = '$col'")->row(0)->Type;
        preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
        $enum = explode("','", $matches[1]);
        foreach ($enum as $val){
            $data["$val"] = $val;
        }
        return $data;
    }

    function update_data($img_data, $se_id) {
        $data = array(
            'se_logo' => isset($img_data['file_name']) ? $img_data['file_name'] : '',
//            'se_current_theme' => $this->input->post('se_current_theme'),
            'se_view_type' => $this->input->post('se_view_type'),
            'se_weather_rss' => $this->input->post('se_weather_rss'),
            'se_news_rss' => $this->input->post('se_news_rss'),
            'se_pin_number' => $this->input->post('se_pin_number'),
            'se_vod_cost' => $this->input->post('se_vod_cost'),
            'se_table_booking' => $this->input->post('se_table_booking'),
            'se_wakeup_call' => $this->input->post('se_wakeup_call'),
            'se_restaurant_booking' => $this->input->post('se_restaurant_booking'),
            'se_order_taxi' => $this->input->post('se_order_taxi'),
            'se_room_service' => $this->input->post('se_room_service'),
            'se_laundery_request' => $this->input->post('se_laundery_request'),
            'se_socket_enabled' => $this->input->post('se_socket_enabled'),
            'se_tapemarquee_enabled' => $this->input->post('se_tapemarquee_enabled'),
            'se_fakedata_enabled' => $this->input->post('se_fakedata_enabled'),
            'se_internet_enabled' => $this->input->post('se_internet_enabled'),
            'se_ajaxpull_enabled' => $this->input->post('se_ajaxpull_enabled'),
            'se_exit_enabled' => $this->input->post('se_exit_enabled'),
            'se_alarm_enabled' => $this->input->post('se_alarm_enabled'),
            'tickertape_enabled' => $this->input->post('tickertape_enabled'),
            'chfavourite_enabled' => $this->input->post('chfavourite_enabled'),
            'se_guest_title' => $this->input->post('se_guest_title')
        );
        if (empty($img_data['file_name'])) {
            unset($data['se_logo']);
        }
        $this->db->where('se_id', $se_id);
        $this->db->update($this->settings, $data);
    }

    function get_data_byid($id = false) {
        $this->db->where('se_id', $id);
        $query = $this->db->get($this->settings);
        return $query;
    }

}
