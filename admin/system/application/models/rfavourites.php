<?
class RFavourites extends Model{
	
	function RFavourites(){
		parent::Model();
		$this->load->helper('url');
		
		$this->db_prefix	= $this->db->dbprefix;
		$this->users		= $this->db->dbprefix.'users';
		$this->favourites	= $this->db->dbprefix.'r_favourites';
		$this->channel		= $this->db->dbprefix.'r_channel';
	}
	
	function check_user_id($user_id){
		$this->db->where('id',$user_id);
		$query = $this->db->get($this->users);
		return $query;
	}
	
	function get_data_id($user_id,$channel_id=false){
		$this->db->where('fav_user',$user_id);
		$channel_id==true ? $this->db->where('fav_channel_id',$channel_id) : '';
		$query = $this->db->get($this->favourites);
		return $query;
	}
	
	function insert_data($user_id,$channel_id){
		$data = array(
			'fav_user' 			=> $user_id,
			'fav_channel_id'	=> $channel_id!="" ? implode(",",$this->allowed_channel($user_id,$channel_id)) : "",
			'fav_date_added'	=> $this->TVclass->current_date()
		);
		$this->db->insert($this->favourites,$data);
		$this->TVclass->update_flag('radio');
	}
	
	function update_data($user_id,$channel_id){
		$data = array(
			'fav_user' 				=> $user_id,
			'fav_channel_id'		=> $channel_id!="" ? implode(",",$this->allowed_channel($user_id,$channel_id)) : "",
			'fav_date_modfified'	=> $this->TVclass->current_date()
		);
		$this->db->where('fav_user',$user_id);
		$this->db->update($this->favourites,$data);
		$this->TVclass->update_flag('radio');
	}
	
	function delete_data($user_id,$channel_id){
		$this->db->where('fav_user',$user_id);
		$this->db->where('fav_channel_id',$channel_id);
		$this->db->delete($this->favourites);
		$this->TVclass->update_flag('radio');
	}
	
	function delete_bychannel_id($channel_id){
		$this->db->where('fav_channel_id',$channel_id);
		$this->db->delete($this->favourites);
	}
	
	function allowed_channel($user_id=false,$channel_id=false){
		$data = array();
		if($channel_id==true){
			$explode_channel = explode("-",$channel_id);
			for($i=0;$i<count($explode_channel);$i++){
				if($this->check_channel($explode_channel[$i])->num_rows()>0){
					$data[$i] = $explode_channel[$i];
				}
			}
			if(count($data)==0){
				$get_exist_data = $this->get_data_id($user_id)->result();
				foreach($get_exist_data as $row){
					$data = $row->fav_channel_id=="" ? array() : explode(",",$row->fav_channel_id);
				}
			}
		}
		return $data;
	}
	
	function check_channel($channel_id=false){
		$this->db->where('id',$channel_id);
		$query = $this->db->get($this->channel);
		return $query;
	}
	
	function get_all_favourites($offset = 0, $row_count = 0){
		//$this->db->join('users','users.id=favourites.fav_user','left');
		$this->db->join($this->channel,$this->channel.'.id='.$this->favourites.'.fav_channel_id','left');
		
		$this->db->where('fav_user',$this->input->post('users-changel'));
		if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->favourites, $row_count, $offset);
        } else {
            $query = $this->db->get($this->favourites);
        }
		//print_r($this->db->last_query()."<br>");
        return $query;
	}
}
?>