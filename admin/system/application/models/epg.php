<?php
class EPG extends Model{

	function EPG()
		{
			parent::Model();
		}
	function getAllepg($num,$offset)
		{
			$data = array();
			//$this->db->select('* , DATE_FORMAT(dateadded,\'%d-%m-%Y\') as add_date',FALSE);
			//$this->db->where('status', 'active');
			
			$this->db->select('*');
			$this->db->from('epgfiles');
			if($offset=='')
			{
			 $newoff=0;
			}else {
				$newoff=$offset;
			}
			$this->db->join('channel', 'epgfiles.channel = channel.id');
			$this->db->limit($num, $newoff);
			//$this->db->select('id,title,summary,fullnews,DATE_FORMAT(date_added,\'%Y-%m-%d\') as add_date',FALSE);
			$Q = $this->db->get();

			
			//print $offset;
			//$Q = $this->db->get('news',$num,$offset);
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
		
	function getepg($id)
		{
			$data = array();
			$options = array('channel'=>$id);
			$Q = $this->db->getwhere('epgfiles',$options,1);
			if ($Q->num_rows() > 0)
				{
					$data = $Q->row_array();
				}
			$Q->free_result();
			return $data;
		}	
		
	function addepg()
		{
			$data = array(
				'channel' => $_POST['Id'],
				'path' => $_POST['path']
					);
			$this->db->insert('epgfiles', $data);
		}	
		
	function Updateepg()
		{
		$data = array(
				'channel' => $_POST['Id'],
				'path' => $_POST['path']
					);
				$this->db->where('id',$_POST['id']);
				$this->db->update('epgfiles', $data);
		}
		
	function deleteepg($id)
		{
				$this->db->where('channel', $id);
				$this->db->delete('epgfiles');
				
		}		
		
	function getChannelsDropDown()
			{
				$data = array();
				$Q = $this->db->get('channel');
				if ($Q->num_rows() > 0)
					{
						foreach ($Q->result_array() as $row)
							{
								$data[$row['id']] = $row['name'];
							}
					}
				$Q->free_result();
				return $data;
			}		
			
	function getselectedchannel($Id)
		{
			$data = array();
			$options = array('id'=>$Id);
			$Q = $this->db->getwhere('channel',$options,1);
			if ($Q->num_rows() > 0)
				{
					$data = $Q->row_array();
				}
			$Q->free_result();
			return $data;
		}			
	
}	