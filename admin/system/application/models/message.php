<?

class message extends Model {

    function message() {
        parent::Model();
		$this->load->helper('url');
		
		$this->db_prefix	= $this->db->dbprefix;
		$this->message		= $this->config->item($this->db->dbprefix.'message');
		$this->usermessage	= $this->config->item($this->db->dbprefix.'usermessage');
		$this->users		= $this->config->item($this->db->dbprefix.'users');
		$this->guest		= $this->config->item($this->db->dbprefix.'guest');
    }

    function insert_data() {

        $get_users = $this->input->post('list2');
        //$split_users	= implode(",",$get_users);
        /*
          $data = array(
          'user_id' => $split_users,
          'message' => $this->input->post('message')
          );
         *
         */
        $data = array(
            'message'		=> $this->input->post('message'),
			'date_added'	=> $this->TVclass->current_date()
        );
        $this->db->insert($this->message, $data);
        $added_id = $this->db->insert_id();
		
        foreach ($get_users as $users) {
            $data = array('user' => $users, 'message' => $added_id, 'date_added' => $this->TVclass->current_date());
            $this->db->insert($this->usermessage, $data);
        }
    }

    function update_data($msg_id) {
		//Update message table
		$get_users = $this->input->post('list2');
		
		$data_message = array(
            'message' 		=> $this->input->post('message'),
			'date_modified'	=> $this->TVclass->current_date()
        );
		$this->db->where('id',$msg_id);
        $this->db->update($this->message, $data_message);
		
		// First delete related message records from usermessage table
		$this->db->where('message',$msg_id);
		$this->db->delete($this->usermessage);
		
		// Now insert usermessage as new record
		foreach ($get_users as $users) {
            $data = array('user' => $users, 'message' => $msg_id, 'date_added' => $this->TVclass->current_date());
            $this->db->insert($this->usermessage, $data);
        }
		
		/**
        $get_users = $this->input->post('list2');
        $split_users = implode(",", $get_users);

        $data = array(
            'user_id' => $split_users,
            'message' => $this->input->post('message')
        );
        $this->db->where('id', $sub_id);
        $this->db->update('user_message', $data);
		**/
    }

    function delete_message($msg_id) {
		$this->db->where('message',$msg_id);
		$this->db->delete($this->usermessage);
        $this->db->where('id', $msg_id);
        $this->db->delete($this->message);
    }

    function get_all($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('message.id', 'asc');
            $query = $this->db->get($this->message, $row_count, $offset);
        } else {
            $this->db->orderby('message.id', 'asc');
            $query = $this->db->get($this->message);
        }

        return $query;
    }

	function get_message_users($msg_id){
		$data = array();
		$this->db->join($this->guest,$this->guest.'.id='.$this->usermessage.'.user','left');
		$this->db->where($this->usermessage.'.message',$msg_id);
		$query = $this->db->get($this->usermessage);
		if ($query->num_rows() > 0) {
           foreach($query->result() as $row){
			   $data[] = $row->name;
		   }
        }
		$rsk =  implode(",", $data);
		print $rsk;
	}

	function get_message_users_array($msg_id){
		$data = array();
		$this->db->join($this->guest,$this->guest.'.id='.$this->usermessage.'.user','left');
		$this->db->where($this->usermessage.'.message',$msg_id);
		$query = $this->db->get($this->usermessage);
		return $query;
		//print_r($this->db->last_query());
		/**
		if ($query->num_rows() > 0) {
           foreach($query->result() as $row){
			   $data[] = $row->id;
		   }
        }
		$rsk =  implode(",", $data);
		return $rsk;
		**/
	}

    function get_record_byid($id) {
        $data = array();
		$this->db->select('*, '.$this->message.'.message as d_msg');
		$this->db->join($this->message,$this->message.'.id='.$this->usermessage.'.message','left');
        $this->db->where($this->usermessage.'.message', $id);
        $Q = $this->db->get($this->usermessage);
        if ($Q->num_rows() > 0) {
			$data = $Q->row_array();
        }
        $Q->free_result();
		//print_r($this->db->last_query());
        return $data;
    }

    function get_guest_list($edit_mode=false) {
		$this->db->select($this->guest.'.*',FALSE);
		$this->db->join($this->usermessage,$this->usermessage.'.user='.$this->guest.'.id','left');
		if($edit_mode==true){
			$statement = $this->guest.'.id NOT IN (select user from '.$this->usermessage.' where message='.$edit_mode.')';
			$this->db->where($statement);
		}
        $this->db->orderby($this->guest.'.id', 'asc');
        $query = $this->db->get($this->guest);
		//print_r($this->db->last_query());
        return $query;
    }

    function get_package_byid($id) {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get($this->users);

        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }

        $Q->free_result();
        return $data;
    }

    function word_limiter($str=false, $limit=false, $end_char=false) {
        if (trim($str) == '')
            return $str;

        preg_match('/\s*(?:\S*\s*){' . (int) $limit . '}/', $str, $matches);

        if (strlen($matches[0]) == strlen($str))
            $end_char = '';

        return rtrim($matches[0]) . $end_char;
    }

}

?>