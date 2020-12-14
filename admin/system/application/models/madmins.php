<?php
class MAdmins extends Model
	{
		function MAdmins()
			{
				parent::Model();
			}
		
		function verifyUser($u,$pw)
			{
				$this->db->select('id,username');
				$this->db->where('username',$u);
				//$this->db->where('password', $pw);
				$this->db->where('password', $pw);
				$this->db->where('status', 'active');
				$this->db-> limit(1);
				$Q = $this->db->get('user');
				if ($Q-> num_rows() > 0)
					{
						$row = $Q-> row_array();
						//$_SESSION['userid'] = $row['id'];
						//$_SESSION['username'] = $row['username'];	
						$this->session->set_userdata('userid',$row['id']);
						$this->session->set_userdata('username',$row['username']);
				}else
					{
						$this->session->set_flashdata('error', 'Sorry, your username or password is incorrect!');
					}
			}
			
		function NonUser()
			{
				$this->session->set_flashdata('error', 'Please Enter your user name and pass word!');
			}
			
	}	