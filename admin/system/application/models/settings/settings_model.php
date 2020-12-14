<?php

class Settings_model extends Model {

    function Settings_model() {
        parent::Model();
        $this->load->helper('url');

        $this->db_prefix = $this->db->dbprefix;
        $this->settings = $this->config->item($this->db->dbprefix . 'settings');
    }

    function get_data($offset = 0, $row_count = 0) {
        $this->db->join('themes', 'themes.th_id=settings.se_current_theme', 'left');
        $this->db->orderby($this->settings . '.se_id', 'desc');
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->settings, $row_count, $offset);
        } else {
            $query = $this->db->get($this->settings);
        }
        return $query;
    }

    function insert_data($img_data) {
        $data = array(
            'se_logo' => isset($img_data['file_name']) ? $img_data['file_name'] : '',
            'se_current_theme' => $this->input->post('se_current_theme'),
        );
        $this->db->insert($this->settings, $data);
    }

    function update_data($img_data, $id) {
        $data = array(
            'se_logo' => isset($img_data['file_name']) ? $img_data['file_name'] : '',
            'se_current_theme' => $this->input->post('se_current_theme'),
        );
        $this->db->where('se_id', $id);
        $this->db->update($this->settings, $data);
    }

    function delete_data($id) {
        $get_image = $this->get_data_byid($id)->row_array();
        $filename = './icons/LOGO/' . basename($get_image['se_logo']);
        if (file_exists($filename)) {
            unlink($filename);
        }

        $this->db->where('se_id', $id);
        $this->db->delete($this->settings);
    }

    function update_config_data($id) {
        $data = array(
            'se_table_booking' => $this->input->post('se_table_booking'),
            'se_wakeup_call' => $this->input->post('se_wakeup_call'),
            'se_restaurant_booking' => $this->input->post('se_restaurant_booking'),
            'se_order_taxi' => $this->input->post('se_order_taxi'),
            'se_room_service' => $this->input->post('se_room_service'),
            'se_laundery_request' => $this->input->post('se_laundery_request'),
        );
        $this->db->where('se_id', $id);
        $this->db->update($this->settings, $data);
    }

    function get_data_byid($id = false) {
        $this->db->where('se_id', $id);
        $query = $this->db->get($this->settings);
        return $query;
    }

}

?>