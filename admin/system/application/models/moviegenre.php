<?php
class MovieGenre extends Model{

	function MovieGenre(){
		parent::Model();
		$this->load->helper('url');
		
		$this->db_prefix		= $this->db->dbprefix;
		$this->genre			= $this->config->item($this->db->dbprefix.'genre');
		$this->parentalrating	= $this->config->item($this->db->dbprefix.'parentalrating');
		$this->vod_genre		= $this->config->item($this->db->dbprefix.'vod_genre');
	}
		
	function getAllgenre(){
		$data = array();
		//$this->db->where('status', 'active');
		$Q = $this->db->get($this->genre);
		//$sql="SELECT * FROM genre WHERE status='active'";
		//$Q = $this->db->query($sql);
		if ($Q-> num_rows() > 0){
			foreach ($Q->result_array() as $row){
				$data[] = $row;
			}
		}
		$Q->free_result();
		return $data;
	}	
		
	function getGenre($id){
		$data = array();
		$options = array('id'=>$id);
		$Q = $this->db->getwhere($this->genre,$options,'en');
		if ($Q->num_rows() > 0){
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}	
		
	function addgenre(){
		$data = array(
			'name' => $_POST['name'],
			'language' => $_POST['LangID']
		);
		$this->db->insert($this->genre, $data);
	}	
		
	function UpdateGenre(){
		$data = array(
			'name' => $_POST['name']
		);
		$this->db->where('id',$_POST['id']);
		$this->db->update($this->genre, $data);	
	}
		
	function deleteGenre($id){
		//$data = array('status' => 'inactive');
		$this->db->where('id', $id);
		$this->db->delete($this->genre);
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

	function vod_genreDropDown(){
		$data = array();
		$this->db->orderby('name','asc');
		$Q = $this->db->get($this->vod_genre);
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
		$Q = $this->db->get('parentalrating');
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