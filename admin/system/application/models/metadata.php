<?
class Metadata extends Model{

	function Metadata()
	{
		parent::Model();
	}
	
	function getAllMetadata($num,$offset)
		{
			$data = array();
			$Q = $this->db->get('metadata',$num,$offset);
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
	
	function addmetadata()
	{
		$data = array(
				'director' => $_POST['dirname'],
				'cast' => $_POST['cast'],
				'languages' => $_POST['LangID'],
				);
		$this->db->insert('metadata', $data);
	}
	
	function getMetadata($id)
	{
		$data = array();
		$options = array('id'=>$id);
		$Q = $this->db->getwhere('metadata',$options);
		if ($Q->num_rows() > 0)
		{
			$data = $Q->row_array();
		}
		$Q->free_result();
		return $data;
	}
	
	function UpdateMetadata()
	{
		$data = array(
			'director' => $_POST['dirname'],
			'cast' => $_POST['cast'],
			'languages' => $_POST['LangID']
		);
				
		$this->db->where('id',$_POST['id']);
		$this->db->update('metadata', $data);	
	}
	
	function deleteMetadata($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('metadata');
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