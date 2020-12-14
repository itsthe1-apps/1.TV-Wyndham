<?php

class Category extends Model {

    function Category() {
        parent::Model();
    }

    function insert_data() {
        $data = array(
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'accessibility' => $this->input->post('accessibility'),
            'status' => $this->input->post('status'),
            'address' => $this->input->post('address'),
            'postal_code' => $this->input->post('postal_code'),
            'post' => $this->input->post('post'),
            'country' => $this->input->post('country'),
            'fixed_phone' => $this->input->post('fixed_phone'),
            'mobile_phone' => $this->input->post('mobile_phone'),
            'job_phone' => $this->input->post('job_phone'),
            'FAX' => $this->input->post('FAX'),
            'UID' => $this->input->post('UID'),
            'auto_sub' => $this->input->post('auto_sub'),
            'auto_audio' => $this->input->post('auto_audio'),
            'auto_reminder_time' => $this->input->post('auto_reminder_time'),
            'parental_pin' => $this->input->post('parental_pin'),
            'user_pin' => $this->input->post('user_pin'),
            'package_id' => $this->input->post('package')
        );
        $this->db->insert('subscribers', $data);
    }

    function update_data($sub_id) {
        $data = array(
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'accessibility' => $this->input->post('accessibility'),
            'status' => $this->input->post('status'),
            'address' => $this->input->post('address'),
            'postal_code' => $this->input->post('postal_code'),
            'post' => $this->input->post('post'),
            'country' => $this->input->post('country'),
            'fixed_phone' => $this->input->post('fixed_phone'),
            'mobile_phone' => $this->input->post('mobile_phone'),
            'job_phone' => $this->input->post('job_phone'),
            'FAX' => $this->input->post('FAX'),
            'UID' => $this->input->post('UID'),
            'auto_sub' => $this->input->post('auto_sub'),
            'auto_audio' => $this->input->post('auto_audio'),
            'auto_reminder_time' => $this->input->post('auto_reminder_time'),
            'parental_pin' => $this->input->post('parental_pin'),
            'user_pin' => $this->input->post('user_pin'),
            'package_id' => $this->input->post('package')
        );
        $this->db->where('id', $sub_id);
        $this->db->update('subscribers', $data);
    }

    function delete_subscribers($sub_id) {
        $this->db->where('id', $sub_id);
        $this->db->delete('subscribers');
    }

    function get_all($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('cat_name', 'asc');
            $query = $this->db->get('category', $row_count, $offset);
        } else {
            $this->db->orderby('cat_name', 'asc');
            $query = $this->db->get('category');
        }
        return $query;
    }

    function get_record_byid($id) {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get('subscribers');
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function packages() {
        $this->db->orderby('name', 'asc');
        $query = $this->db->get('channel_group');

        return $query;
    }

    function get_package_byid($id) {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get('channel_group');

        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }

        $Q->free_result();
        return $data;
    }

}

?>