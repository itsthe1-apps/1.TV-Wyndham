<?php

class ChannelGroup extends Model 
{
	function ChannelGroup()
	{
		parent::Model();
		
		// Other stuff
		$this->_prefix = $this->config->item('DX_table_prefix');
		$this->_table = $this->_prefix.$this->config->item('DX_chroles_table');
	}
	
	function get_all()
	{
		$this->db->order_by('id', 'asc');
		return $this->db->get($this->_table);
	}
	
	function get_all_groups()
	{
		$data = array();
		$this->db->order_by('id', 'asc');
		$Q =$this->db->get($this->_table);
		//$Q = $this->db->get('itvtvchannels',$num,$offset);
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
	}
	
	function delete_role($role_id)
	{
		$this->db->where('id', $role_id);
		$this->db->delete($this->_table);		
	}
}

?>