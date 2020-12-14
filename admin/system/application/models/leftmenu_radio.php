<?
class Leftmenu_radio extends Model
{
	function Leftmenu_radio()
	{
		parent::Model();
		$this->CI =& get_instance();
	}
	
	function get_tv_menu(){
		$this->CI->load->model('RGenre');
		$Q = $this->CI->RGenre->getAllgenre();
		$data = array();
		if($Q->num_rows>0){
			foreach ($Q->result_array() as $row)	
			{
				$data[] = $row['name'];
			}
		}
		return $data;
	}
	
	function get_tv_url(){
		$this->CI->load->model('RGenre');
		$Q = $this->CI->RGenre->getAllgenre();
		$data = array();
		if($Q->num_rows>0){
			foreach ($Q->result_array() as $row)	
			{
				$data[] = $row['url'].$row['id'];
			}
		}
		return $data;
	}	
}
?>