<?php
class MGAMES extends Model{

	function MGAMES()
		{
			parent::Model();
		}
	function getgames($num,$offset)
		{
			$data = array();
			$this->db->select('* , DATE_FORMAT(dateadded,\'%d-%m-%Y\') as add_date',FALSE);
			$this->db->where('status', 'active');
			$Q = $this->db->get('games',$num,$offset);
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
		
	function getgame($id)
		{
			$data = array();
			$options = array('id'=>$id);
			$Q = $this->db->getwhere('games',$options,1);
			if ($Q->num_rows() > 0)
				{
					$data = $Q->row_array();
				}
			$Q->free_result();
			return $data;
		}	
		
	function addgames()
		{
			$data = array(
				'name' => $_POST['name'],
				'description' => $_POST['description'],
				//'icon' => $_POST['icon'],
				'path' => $_POST['path'],
				'year' => $_POST['year'],
				'dateadded' => $_POST['dateadded']
					);
				$config['upload_path'] = 'uploads/games';
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
						$this->session->set_flashdata('ga_img',$error);
						redirect('welcome/games','refresh');
					}
				$image = $this->upload->data();
				//print_r ($image);
				if ($image['file_name'])
					{
						$data['icon'] = $image['file_name'];
					}		
			$this->db->insert('games', $data);
			
		}	
		
	function UpdateGames()
		{
		$data = array(
				'name' => $_POST['name'],
				'description' => $_POST['description'],
				//'icon' => $_POST['icon'],
				'path' => $_POST['path'],
				'year' => $_POST['year'],
				'dateadded' => $_POST['dateadded']
					);
				$config['upload_path'] = 'uploads/games';
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
						$this->session->set_flashdata('ga_img',$error);
						redirect('welcome/games','refresh');
					}
				$image = $this->upload->data();
				//print_r ($image);
				if ($image['file_name'])
					{
						$data['icon'] = $image['file_name'];
						//$data['path'] = $config['upload_path'];
					}		
				$this->db->where('id',$_POST['id']);
				$this->db->update('games', $data);	
		}
		
	function deleteGame($id)
		{
			$data = array('status' => 'inactive');
			$this->db->where('id', $id);
			$this->db->update('games', $data);
		}		
	
}	