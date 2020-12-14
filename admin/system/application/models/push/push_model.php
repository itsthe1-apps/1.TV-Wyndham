<?php

class Push_model extends Model {

    function Push_model() {
        parent::Model();
        $this->load->helper('url');
        $this->load->database();
        $this->_prefix = 'mw_';
        $this->_guest_stb = $this->config->item('guest_stb');
    }

    function get_data() {
        return 'I am from model!';
    }

    function get_guestSTBStatus($id=0) {
        $this->db->select('need_restart');
        $this->db->where('device_id', $id);
        $this->db->where('need_restart', 1);
        $this->db->from($this->_guest_stb);
        $this->db->limit(1);
        $Q = $this->db->get();
        
        if ($Q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
        $Q->free_result();
         
        
    }

    function update_guestSTBStatus($id, $status) {
        $data = array('need_restart' => $status,);
        $this->db->where('guest_id', $id);
        $this->db->update($this->_guest_stb, $data);
    }

}