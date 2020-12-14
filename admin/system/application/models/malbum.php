<?php
class MAlbum extends Model{

	function MAlbum()
		{
			parent::Model();
		}
	function getAllalbum($num,$offset)
		{
			$data = array();
			//$this->db->where('status', 'active');
			//$Q = $this->db->get('album');
			$sql="SELECT * FROM album inner join artist on album.al_artistid=artist.a_id inner join genre on album.al_genreid=genre.g_id where album.status='active' order by al_id limit ". $num ."," . $offset;
			$Q = $this->db->query($sql);
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
		
	function getAlbum($id)
		{
			$data = array();
			$options = array('al_id'=>$id);
			$Q = $this->db->getwhere('album',$options,1);
			if ($Q->num_rows() > 0)
				{
					$data = $Q->row_array();
				}
			$Q->free_result();
			return $data;
		}	
		
	function addalbum()
		{
			$data = array(
				'al_name' => $_POST['name'],
				'al_artistid' => $_POST['a_id'],
				'al_genreid' => $_POST['g_id'],
				'al_description' => $_POST['description']
					);
			$this->db->insert('album', $data);
			
		}	
		
	function UpdateAlbum()
		{
		$data = array(
				'al_name' => $_POST['name'],
				'al_artistid' => $_POST['a_id'],
				'al_genreid' => $_POST['g_id'],
				'al_description' => $_POST['description']
					);
				$this->db->where('al_id',$_POST['id']);
				$this->db->update('album', $data);	
		}
		
	function deleteAlbum($id)
		{
			$data = array('status' => 'inactive');
			$this->db->where('al_id', $id);
			$this->db->update('album', $data);
		}		
		
	function getAlbumDropDown()
			{
				$data = array();
				$Q = $this->db->get('album');
				if ($Q->num_rows() > 0)
					{
						foreach ($Q->result_array() as $row)
							{
								$data[$row['al_id']] = $row['al_name'];
							}
					}
				$Q->free_result();
				return $data;
			}	
		
	
}	