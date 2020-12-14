<?php

class RGenre extends Model {

    function RGenre() {
        parent::Model();
		$this->load->helper('url');
		
		$this->db_prefix		= $this->db->dbprefix;
		$this->genre			= $this->db->dbprefix.'r_genre';
		$this->CI = & get_instance();
    }

    function getAllgenre($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('name', 'asc');
            $query = $this->db->get($this->genre, $row_count, $offset);
        } else {
            $this->db->orderby('name', 'asc');
            $query = $this->db->get($this->genre);
        }
        return $query;
    }
	
	function addgenre() {
        $data = array(
            'name'			=> $_POST['name'],
			'url'			=> $_POST['url'],
            'language'		=> $_POST['LangID'],
			'date_added'	=> $this->TVclass->current_date()
        );
        $this->db->insert($this->genre, $data);
    }
	
	function UpdateGenre() {
        $data = array(
            'name' 			=> $_POST['name'],
			'url'			=> $_POST['url'],
            'language'		=> $_POST['LangID'],
			'date_updated'	=> $this->TVclass->current_date()
        );
        $this->db->where('id', $_POST['id']);
        $this->db->update($this->genre, $data);
    }
	
	function getGenret($id) {
        $data = array();
        $options = array('id' => $id);
        $Q = $this->db->getwhere($this->genre, $options, 1);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }
	
	  function deleteGenre($id) {
        //$data = array('status' => 'inactive');
		$this->CI->load->model('radio/RMTV');
		$this->CI->RMTV->delete_bygenre($id);
		
        $this->db->where('id', $id);
        $this->db->delete($this->genre);
    }
}

