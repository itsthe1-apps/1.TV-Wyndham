<?
class Occation extends Model{

	function Occation(){
		parent::Model();
		$this->load->helper('url');
		
		$this->db_prefix	= $this->db->dbprefix;
		$this->occation		= $this->config->item($this->db->dbprefix.'occation');
	}	
	
	function insert_data(){
		$data = array(
			'occation_name'		=> $this->input->post('occation_name'),
			'date_added'		=> $this->TVclass->current_date()
		);
		$this->db->insert($this->occation,$data);	
	}
	
	function update_data($sub_id){
		$data = array(
			'occation_name'		=> $this->input->post('occation_name'),
			'date_updated'		=> $this->TVclass->current_date()
		);
		$this->db->where('id',$sub_id);	
		$this->db->update($this->occation,$data);		
	}
	
	function delete_occation($sub_id){
		$this->db->where('id',$sub_id);
		$this->db->delete($this->occation);
	}
	
	function get_all($offset = 0, $row_count = 0){
		if ($offset >= 0 AND $row_count > 0)
		{
			$this->db->orderby('id','asc');
			$query = $this->db->get($this->occation, $row_count, $offset);
		}else{
			$this->db->orderby('id','asc');
			$query = $this->db->get($this->occation);
		}
		return $query;
	}
	
	function get_record_byid($id)
	{
		$data = array();
		$this->db->where('id',$id);
		$Q = $this->db->get($this->occation);
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	
	
}
?>