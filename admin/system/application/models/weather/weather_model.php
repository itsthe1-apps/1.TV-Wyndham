<?php
class Weather_model extends Model{

	function Weather_model(){
		parent::Model();
		$this->load->helper('url');
		
		$this->db_prefix = $this->db->dbprefix;
		$this->weather = $this->db->dbprefix.'weather';
	}
	
	function get_data($offset = 0, $row_count = 0, $session_keyword = ''){
		if($this->session->userdata($session_keyword)!=""){
			$this->db->where('language',$this->session->userdata($session_keyword));
		}else{
			$this->db->where_in('language',array($this->config->item('system_lang'),));
		}
		
		$this->db->orderby('id','asc');
		if ($offset >= 0 AND $row_count > 0){				
			$query = $this->db->get($this->weather, $row_count, $offset);
		}else{
			$query = $this->db->get($this->weather);
		}	
		return $query;
	}
	
	function insert_data(){
		$data = array(
			'weather_url' => $this->input->post('weather_url'),
			'language' => $this->input->post('language')
		);
		$this->db->insert($this->weather,$data);
	}
	
	function update_data($id){
		$data = array(
			'weather_url' => $this->input->post('weather_url'),
			'language' => $this->input->post('language')
		);
		$this->db->where('id',$id);
		$this->db->update($this->weather,$data);
	}
	
	function delete_data($id){
		$this->db->where('id',$id);
		$this->db->delete($this->weather);
	}
	
	function get_data_byid($id){
		$this->db->where('id',$id);
		$query = $this->db->get($this->weather);
		return $query;
	}
}
?>