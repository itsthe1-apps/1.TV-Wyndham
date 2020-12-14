<?php
class Themes_model extends Model{

	function Themes_model(){
		parent::Model();
		$this->load->helper('url');
		
		$this->db_prefix	= $this->db->dbprefix;
		$this->themes		= $this->config->item($this->db->dbprefix.'themes');
		$this->resolution	= $this->config->item($this->db->dbprefix.'resolution');
	}
	
	function get_data($offset = 0, $row_count = 0){
		$this->db->order_by('th_name','asc');
		if ($offset >= 0 AND $row_count > 0){				
			$query = $this->db->get($this->themes, $row_count, $offset);
		}else{
			$query = $this->db->get($this->themes);
		}
		return $query;
	}
	
	function insert_data(){
		$data = array(
			'th_name'			=> $this->input->post('th_name'),
			'th_folder'			=> $this->input->post('th_folder'),
		);
		$this->db->insert($this->themes,$data);
		$folder = "./themes/".$data['th_folder'];
		if (!is_dir($folder)) {
			mkdir($folder);
		}
	}
	
	function update_data($id){
		$get_data	= $this->get_data_byid($id)->row_array();
		$folder		= "./themes/".$get_data['th_folder'];
		if (is_dir($folder)){
			@rename($folder,"./themes/".$this->input->post('th_folder'));
		}
		$data = array(
			'th_name'			=> $this->input->post('th_name'),
			'th_folder'			=> $this->input->post('th_folder'),
		);
		$this->db->where('th_id',$id);
		$this->db->update($this->themes,$data);
	}
	
	function delete_data($id){
		$get_data	= $this->get_data_byid($id)->row_array();
		$folder		= "./themes/".$get_data['th_folder'];
		
		$this->rrmdir($folder);
		
		$this->db->where('th_id',$id);
		$this->db->delete($this->themes);
	}
	
	function get_data_byid($id=false){
		$this->db->where('th_id',$id);
		$query = $this->db->get($this->themes);
		return $query;
	}
	
	function get_resolution(){
		$this->db->order_by('re_type');
		$query = $this->db->get('resolution');
		return $query;
	}
		
	function rrmdir($dir) { 
	   if (is_dir($dir)) { 
		 $objects = scandir($dir); 
		 foreach ($objects as $object) { 
		   if ($object != "." && $object != "..") { 
			 if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
		   } 
		 } 
		 reset($objects); 
		 rmdir($dir); 
	   } 
 	} 
}
?>