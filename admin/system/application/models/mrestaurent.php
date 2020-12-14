<?php
class MRestaurent extends Model{

	function MRestaurent()
		{
			parent::Model();
		}
	function getAllrestaurent($num,$offset)
		{
			$data = array();
			$this->db->select('* , DATE_FORMAT(dateadded,\'%d-%m-%Y\') as add_date',FALSE);
			$this->db->where('status', 'active');
			$Q = $this->db->get('restaurent',$num,$offset);
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
		
	function getRestaurent($id)
		{
			$data = array();
			$options = array('id'=>$id);
			$Q = $this->db->getwhere('restaurent',$options,1);
			if ($Q->num_rows() > 0)
				{
					$data = $Q->row_array();
				}
			$Q->free_result();
			return $data;
		}	
		
	function addrestaurent()
		{
			$data = array(
				'name' => $_POST['name'],
				'description' => $_POST['description'],
				//'icon' => $_POST['icon'],
				'path' => $_POST['path'],
				'year' => $_POST['year'],
				'dateadded' => $_POST['dateadded']
					);
				$config['upload_path'] = 'uploads/restaurent';
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
						$this->session->set_flashdata('res_img',$error);
						redirect('welcome/restaurent','refresh');
					}
				$image = $this->upload->data();
				//print_r ($image);
				if ($image['file_name'])
					{
						$data['icon'] = $image['file_name'];
						//$data['path'] = $config['upload_path'];
					}		
			$this->db->insert('restaurent', $data);
			
		}	
		
	function UpdateRestaurent()
		{
		$data = array(
				'name' => $_POST['name'],
				'description' => $_POST['description'],
				//'icon' => $_POST['icon'],
				'path' => $_POST['path'],
				'year' => $_POST['year'],
				'dateadded' => $_POST['dateadded']
					);
				$config['upload_path'] = 'uploads/restaurent';
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
						$this->session->set_flashdata('res_img',$error);
						redirect('welcome/restaurent','refresh');
					}
				$image = $this->upload->data();
				//print_r ($image);
				if ($image['file_name'])
					{
						$data['icon'] = $image['file_name'];
						//$data['path'] = $config['upload_path'];
					}		
				$this->db->where('id',$_POST['id']);
				$this->db->update('restaurent', $data);	
		}
		
	function deleteRestaurent($id){
			$data = array('status' => 'inactive');
			$this->db->where('id', $id);
			$this->db->update('restaurent', $data);
	}		
}	