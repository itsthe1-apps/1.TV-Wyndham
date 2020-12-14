<?
class Skins extends Model{

	function Skins(){
		parent::Model();
		$this->load->helper('url');
		
		$this->db_prefix	= $this->db->dbprefix;
		$this->skin			= $this->config->item($this->db->dbprefix.'skin');
	}
	
	function insert_data(){
		$data = array(
			'sk_name'		=> $this->input->post('sk_name'),
			'sk_css'		=> $this->input->post('sk_css'),
			'sk_select'		=> 0,
			'date_added'	=> $this->TVclass->current_date()
		);
		$this->db->insert($this->skin,$data);		
	}
	
	function update_data($skin_id){
		$data = array(
			'sk_name'		=>	$this->input->post('sk_name'),
			'sk_css'		=>	$this->input->post('sk_css'),
			'sk_select'		=>	0,
			'date_updated'	=> $this->TVclass->current_date()
		);
		$this->db->where('id',$skin_id);	
		$this->db->update($this->skin,$data);		
	}
	
	function delete_skin($skin_id){
		$this->db->where('id',$skin_id);
		$this->db->delete($this->skin);
	}
	
	function get_all($offset = 0, $row_count = 0)
	{
		if ($offset >= 0 AND $row_count > 0)
		{
			$this->db->orderby('sk_name','asc');
			$query = $this->db->get($this->skin, $row_count, $offset);
		}else{
			$this->db->orderby('sk_name','asc');
			$query = $this->db->get($this->skin);
		}
		return $query;
	}
	
	function get_record_byid($id)
	{
		$data = array();
		$this->db->where('id',$id);
		$Q = $this->db->get($this->skin);
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
}
?>