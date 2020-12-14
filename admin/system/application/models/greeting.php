<?php

class greeting extends Model {

    function greeting() {
        parent::Model();
        $this->load->helper('url');

        $this->db_prefix = $this->db->dbprefix;
        $this->greeting = $this->config->item($this->db->dbprefix . 'greeting');
        $this->occation = $this->config->item($this->db->dbprefix . 'occation');
        $this->language = $this->config->item($this->db->dbprefix . 'language');
        $this->detail_greeting = $this->db->dbprefix . 'detail_greeting';
    }

    function insert_data() {
        $data = array(
            'title' => $this->input->post('title'),
            'date_added' => $this->TVclass->current_date()
        );
        $this->db->insert($this->greeting, $data);
        $this->TVclass->update_flag('greeting');
    }

    function update_data($sub_id) {
        $data = array(
            'title' => $this->input->post('title'),
            'date_modified' => $this->TVclass->current_date()
        );
        $this->db->where('id', $sub_id);
        $this->db->update($this->greeting, $data);
        $this->TVclass->update_flag('greeting');
    }

    function delete_greeting($sub_id) {
        $this->db->where('greeting_id', $sub_id);
        $this->db->delete($this->detail_greeting);

        $this->db->where('id', $sub_id);
        $this->db->delete($this->greeting);
        $this->TVclass->update_flag('greeting');
    }

    function get_all($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('id', 'asc');
            $query = $this->db->get($this->greeting, $row_count, $offset);
        } else {
            $this->db->orderby('id', 'asc');
            $query = $this->db->get($this->greeting);
        }
        return $query;
    }

    function get_record_byid($id) {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get($this->greeting);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function packages() {
        $this->db->orderby('occation_name', 'asc');
        $query = $this->db->get($this->occation);

        return $query;
    }

    function get_package_byid($id) {
        $data = array();
        $this->db->where('occation_name', $id);
        $Q = $this->db->get($this->occation);

        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }

        $Q->free_result();
        return $data;
    }

    function language() {
        $this->db->orderby('short_label', 'asc');
        $query = $this->db->get($this->language);

        return $query;
    }

    function get_language_byid($id) {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get($this->language);

        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }

        $Q->free_result();
        return $data;
    }

    function alter_table_greeting() {
        $query = 'ALTER TABLE ' . $this->greeting . ' AUTO_INCREMENT 1';
        $this->db->query($query);
    }

    /** Other Languages * */
    function get_all_otherlanguage($offset = 0, $row_count = 0, $id) {
        $this->db->where('greeting_id', $id);
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('greeting_id', 'asc');
            $query = $this->db->get($this->detail_greeting, $row_count, $offset);
        } else {
            $this->db->orderby('greeting_id', 'asc');
            $query = $this->db->get($this->detail_greeting);
        }
        //print_r($this->db->last_query());
        return $query;
    }

    function insert_otherlanguage_data() {
        $data = array(
            'greeting_id' => $this->input->post('greeting_id'),
            'greeting_desc' => $this->input->post('greeting_desc'),
            'greeting_title' => $this->input->post('greeting_title'),
            'greeting_language' => $this->input->post('greeting_language'),
        );
        $this->db->insert($this->detail_greeting, $data);
    }

    function update_otherlanguage_data($id) {
        $data = array(
            'greeting_id' => $this->input->post('greeting_id'),
            'greeting_desc' => $this->input->post('greeting_desc'),
            'greeting_title' => $this->input->post('greeting_title'),
            'greeting_language' => $this->input->post('greeting_language'),
        );
        $this->db->where('detail_id', $id);
        $this->db->update($this->detail_greeting, $data);
    }

    function get_record_otherlanguage_byid($id) {
        $data = array();
        $this->db->where('detail_id', $id);
        $Q = $this->db->get($this->detail_greeting);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        //print_r($this->db->last_query());
        $Q->free_result();
        return $data;
    }

    function delete_otherlanguage($id) {
        $this->db->where('detail_id', $id);
        $this->db->delete($this->detail_greeting);
    }

    function alter_table_otherlanguage() {
        $query = 'ALTER TABLE ' . $this->detail_greeting . ' AUTO_INCREMENT 1';
        $this->db->query($query);
    }

}

?>