<?php
class MSong extends Model{

	function MSong()
		{
			parent::Model();
		}
	function getAllsong($num,$offset)
		{
			$data = array();
			//$this->db->where('status', 'active');
			//$Q = $this->db->get('song');
			$sql="SELECT * FROM song inner join artist on song.artistid=artist.a_id inner join genre on song.genreid=genre.g_id inner join album on song.albumid=album.al_id
			where song.status='active' order by id limit ".$num.",".$offset;
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
		
	function getSong($id)
		{
			$data = array();
			$options = array('id'=>$id);
			$Q = $this->db->getwhere('song',$options,1);
			if ($Q->num_rows() > 0)
				{
					$data = $Q->row_array();
				}
			$Q->free_result();
			return $data;
		}	
		
	function addSong()
		{
			$data = array(
				'name' => $_POST['name'],
				'artistid' => $_POST['a_id'],
				'genreid' => $_POST['g_id'],
				'albumid' => $_POST['al_id'],
				//'icon' => $_POST['icon'],
				'path' => $_POST['path'],
				'description' => $_POST['description']
					);
				$config['upload_path'] = 'uploads/song';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '200';
				$config['remove_spaces'] = true;
				$config['overwrite'] = true;
				//$config['max_size']	= '100';
				$config['max_width']  = '1024';
				$config['max_height']  = '768';
				$this->load->library('upload', $config);
				
				if(!$this->upload->do_upload('icon'))
					{
						$error=$this->upload->display_errors();
						//exit();
						$this->session->set_flashdata('song_img',$error);
						redirect('welcome/song','refresh');
					}
				$image = $this->upload->data();
				//print_r ($image);
				if ($image['file_name'])
					{
						$data['icon'] = $image['file_name'];
					}		
			$this->db->insert('song', $data);
			
		}	
		
	function UpdateSong()
		{
		$data = array(
				'name' => $_POST['name'],
				'artistid' => $_POST['a_id'],
				'genreid' => $_POST['g_id'],
				'albumid' => $_POST['al_id'],
				//'icon' => $_POST['icon'],
				'path' => $_POST['path'],
				'description' => $_POST['description']
					);
				$config['upload_path'] = 'uploads/song';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = '200';
				$config['remove_spaces'] = true;
				$config['overwrite'] = false;
				//$config['max_size']	= '100';
				$config['max_width']  = '1024';
				$config['max_height']  = '768';
				$this->load->library('upload', $config);
				
				if(!$this->upload->do_upload('icon'))
					{
						$error=$this->upload->display_errors();
						//exit();
						$this->session->set_flashdata('song_img',$error);
						//redirect('welcome/song','refresh');
					}
				$image = $this->upload->data();
				//print_r ($image);
				if ($image['file_name'])
					{
						$data['icon'] = $image['file_name'];
						//$data['path'] = $config['upload_path'];
					}		
				$this->db->where('id',$_POST['id']);
				$this->db->update('song', $data);	
		}
		
	function deleteSong($id)
		{
			$data = array('status' => 'inactive');
			$this->db->where('id', $id);
			$this->db->update('song', $data);
		}		
	
}	