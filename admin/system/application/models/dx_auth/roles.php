<?php

class Roles extends Model 
{
	function Roles()
	{
		parent::Model();
		
		// Other stuff
		$this->_prefix = $this->config->item('DX_table_prefix');
		$this->_table = $this->_prefix.$this->config->item('DX_roles_table');
		$this->users= $this->config->item($this->_prefix.'users');
	}
	
	function get_all()
	{
		$orderby = $this->session->userdata('orderby');
		!empty($orderby) ? $this->db->order_by($orderby) : $this->db->order_by("name", "asc");
		return $this->db->get($this->_table);
	}
	
	function get_role_by_id($role_id)
	{
		$this->db->where('id', $role_id);
		return $this->db->get($this->_table);
	}
	
	function create_role($name, $parent_id = 0)
	{
		$data = array(
			'name' => $name,
			'parent_id' => $parent_id
		);
		$this->db->insert($this->_table, $data);
		//log_history_message('history', 'User group added (Group ID : '.$this->db->insert_id().').','USER GROUPS');
	}
	
	function delete_role($role_id)
	{
		$this->db->where('id', $role_id);
		$this->db->delete($this->_table);
		//log_history_message('history', 'User group deleted (Group ID : '.$role_id.').','USER GROUPS');		
	}
	
	function get_companies()
	{
		$this->db->order_by('id', 'asc');
		return $this->db->get("companies");
	}
	
	function get_location()
	{
		$this->db->where('country is not null');
		$this->db->group_by('country');
		$this->db->order_by('country', 'asc');
		return $this->db->get("location");
	}
	
	function updateRole($id)
	{
		$data = array(
	          'name'=>$this->input->post('role_name')
	        );
			
		$this->db->where('id',$id);
		$this->db->update('roles', $data);
		//log_history_message('history', 'User group updated (Group ID : '.$id.').','USER GROUPS');
	}
	
	function tabs()
	{
		$data = array();
		$this->db->select("parent_id", FALSE);
		$q = $this->db->get("tabs");
		foreach($q->result() as $row)
		{
			$data[] = $row->parent_id;
		}
		
		$this->db->where_not_in('id', $data);
		$this->db->where('is_main', 0);
		$this->db->order_by('id');
		return $this->db->get("tabs");
		
	}
	
	function groups_exist_users($group_id)
	{
		$this->load->database();
		$query = $this->db->query("select ".$this->users.".role_id from ".$this->users." where ".$this->users.".role_id in (".$group_id.")");
		return $query->num_rows();
	}
}

?>