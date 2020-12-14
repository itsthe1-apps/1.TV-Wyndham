<?
class PRating extends Model{
	
	function PRating()
	{
		parent::Model();
	}
	
	function getAllPRating($num,$offset)
	{
		$data = array();
		$Q = $this->db->get('parentalrating',$num,$offset);
		if ($Q-> num_rows() > 0)
			{
				foreach ($Q->result_array() as $row)	
				{
					$data[] = $row;
				}
			}
		$Q->free_result();
		return $data;
	}	
	
	function addPRating()
	{
		$data = array(
				'name' => $_POST['name'],
				'level' => $_POST['level'],
				'language' => $_POST['LangID'],
				);
		$this->db->insert('parentalrating', $data);
	}
	
	function UpdatePRating()
	{
		$data = array(
			'name' => $_POST['name'],
			'level' => $_POST['level'],
			'language' => $_POST['LangID']
		);
				
		$this->db->where('id',$_POST['id']);
		$this->db->update('parentalrating', $data);	
	}
	
	function deletePRating($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('parentalrating');
	}
	
	function getPRating($id)
	{
		$data = array();
		$options = array('id'=>$id);
		$Q = $this->db->getwhere('parentalrating',$options);
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	
	function language($lang)
	{
		switch($lang){
			case "en":
				$name = "English";
				break;
			case "fr":
				$name = "French";
				break;
			default:
				$name = "";
				break;
		}
		return $name;
	}
}
?>