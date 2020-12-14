<?php

Class Televisions_model extends Model {

    function Televisions_model() {
        parent::Model();
        $this->load->helper('url');

        $this->db_prefix = $this->db->dbprefix;
        $this->tvbrand = $this->db->dbprefix . 'tvbrand';
    }

    function get_data($offset = 0, $row_count = 0) {
        $this->db->orderby('id', 'asc');
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->tvbrand, $row_count, $offset);
        } else {
            $query = $this->db->get($this->tvbrand);
        }
        return $query;
    }
    
    function delete_data($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->tvbrand);
    }
    
    function insert_data() {
        $data = array(
            'brnd_name' => $this->input->post('brnd_name'),
            'brnd_folder' => $this->input->post('brnd_folder')
            );
        $this->db->insert($this->tvbrand,$data);
    }
    
    function update_data($id) {
        $data = array(
            'brnd_name' => $this->input->post('brnd_name'),
            'brnd_folder' => $this->input->post('brnd_folder')
            );
        $this->db->where('id',$id);
        $this->db->update($this->tvbrand,$data);
    }
            
    function get_data_byid($id){
        $this->db->where('id',$id);
        $query = $this->db->get($this->tvbrand);
        return $query;
    }
    
}

?>