<?php

/**
 * Created by PhpStorm.
 * User: laksh
 * Date: 3/30/2017
 * Time: 11:04 AM
 */
class Services_data_model extends Model
{
    function Services_data_model() {
        parent::Model();
        $this->load->helper('url');

        $this->db_prefix = $this->db->dbprefix;
        $this->services_data = $this->config->item($this->db->dbprefix . 'services_data');
        $this->services_data_table = $this->db->db_prefix . 'services_data';
    }

    function getServiceDetails($offset = 0, $row_count = 0, $session_keyword) {



        if ($this->session->userdata($session_keyword) != "") {
            $query = 'spa IN(SELECT promotion_id from ' . $this->promotions_language . ' WHERE language="' . $this->session->userdata($session_keyword) . '")';
        } else {
            $query = $this->services_data . 'services_data';
        }
        $this->db->from($query);
        $this->db->where('language', $this->config->item('system_lang'));
        $this->db->orderby('services_data_id', 'asc');
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->services_data, $row_count, $offset);
        } else {
            $query = $this->db->get($this->services_data);
        }
        return $query;
    }

}