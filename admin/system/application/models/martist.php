<?php
class MArtist extends Model{

	function MArtist()
		{
			parent::Model();
		}
	function getAllartist($num,$offset)
		{
			$data = array();
			$this->db->where('status', 'active');
			$Q = $this->db->get('artist',$num,$offset);
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
		
	function getArtist($id)
		{
			$data = array();
			$options = array('a_id'=>$id);
			$Q = $this->db->getwhere('artist',$options,1);
			if ($Q->num_rows() > 0)
				{
					$data = $Q->row_array();
				}
			$Q->free_result();
			return $data;
		}	
		
	function addartist()
		{
			$data = array(
				'a_name' => $_POST['name'],
				'a_description' => $_POST['description']
					);
			$this->db->insert('artist', $data);
			
		}	
		
	function UpdateArtist()
		{
		$data = array(
				'a_name' => $_POST['name'],
				'a_description' => $_POST['description']
					);
				$this->db->where('a_id',$_POST['id']);
				$this->db->update('artist', $data);	
		}
		
	function deleteArtist($id)
		{
			$data = array('status' => 'inactive');
			$this->db->where('a_id', $id);
			$this->db->update('artist', $data);
		}		
		
	function getArtistDropDown()
			{
				$data = array();
				$Q = $this->db->get('artist');
				if ($Q->num_rows() > 0)
					{
						foreach ($Q->result_array() as $row)
							{
								$data[$row['a_id']] = $row['a_name'];
							}
					}
				$Q->free_result();
				return $data;
			}	
	
}	