<?php
class RadioGenre extends Model{

	function RadioGenre(){
		parent::Model();
		$this->load->helper('url');
		
		$this->db_prefix		= $this->db->dbprefix;
		$this->genre			= $this->db->dbprefix.'r_genre';
		$this->parentalrating	= $this->db->dbprefix.'r_parentalrating';
	}
			
	function getGenreDropDown(){
		$data = array();
		$this->db->orderby('name','asc');
		$Q = $this->db->get($this->genre);
		if ($Q->num_rows() > 0){
			$data['']="Select";
			foreach ($Q->result_array() as $row){
				$data[$row['id']] = $row['name'];
			}
		}
		$Q->free_result();
		return $data;
	}

	function getpRatingDropDown(){
		$data = array();
		$Q = $this->db->get($this->parentalrating);
		if ($Q->num_rows() > 0){
			$data[]="Select";
			foreach ($Q->result_array() as $row){
				$data[$row['level']] = $row['name'];
			}
		}
		$Q->free_result();
		return $data;
	}			
	
}	