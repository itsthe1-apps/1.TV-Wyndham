<?php

class Leftmenu extends Model {

    function Leftmenu() {
        parent::Model();
        $this->CI = & get_instance();
    }

    function get_tv_menu() {
        $this->CI->load->model('MGenre');
        $Q = $this->CI->MGenre->getAllgenre();
        $data = array();
        if ($Q->num_rows > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row['name'];
            }
        }
        return $data;
    }

    function get_tv_url() {
        $this->CI->load->model('MGenre');
        $Q = $this->CI->MGenre->getAllgenre();
        $data = array();
        if ($Q->num_rows > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row['url'] . $row['id'];
            }
        }
        return $data;
    }

    // ===========

    function get_vod_all() {
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('vod_genre');
        return $query;
    }

    function get_vod_menu() {
        $Q = $this->get_vod_all();
        $data = array();
        if ($Q->num_rows > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row['name'];
            }
        }
        return $data;
    }

    function get_vod_url() {
        $Q = $this->get_vod_all();
        $data = array();
        if ($Q->num_rows > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row['url'] . $row['id'];
            }
        }
        return $data;
    }

}

?>