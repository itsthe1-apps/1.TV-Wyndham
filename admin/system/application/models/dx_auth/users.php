<?php

class Users extends Model {

    function Users() {
        parent::Model();

        // Other stuff
        $this->_prefix = $this->config->item('DX_table_prefix');
        $this->_table = $this->_prefix . $this->config->item('DX_users_table');
        $this->_roles_table = $this->_prefix . $this->config->item('DX_roles_table');
        
        
    }

    // General function

    function get_all($offset = 0, $row_count = 0) {
        $users_table = $this->_table;
        $roles_table = $this->_roles_table;
        $orderby = $this->session->userdata('orderby');

        if ($offset >= 0 AND $row_count > 0) {
            $this->db->select("$users_table.*", FALSE);
            $this->db->select("$roles_table.name AS role_name", FALSE);
            $this->db->join($roles_table, "$roles_table.id = $users_table.role_id");
            !empty($orderby) ? $this->db->order_by($orderby) : $this->db->order_by("$users_table.username", "ASC");

            $query = $this->db->get($this->_table, $row_count, $offset);
        } else {
            //$this->db->join($roles_table, "$roles_table.id = $users_table.role_id and $roles_table.name!='Admin'");
            $this->db->join($roles_table, "$roles_table.id = $users_table.role_id");
            !empty($orderby) ? $this->db->order_by($orderby) : $this->db->order_by("$users_table.username", "ASC");
            $query = $this->db->get($this->_table);
        }
        //print_r($this->db->last_query()."<br>");
        return $query;
    }

    function get_user_by_id($user_id) {
        $this->db->where('id', $user_id);
        return $this->db->get($this->_table);
    }

    function getUserByStaffCode($code) {
        $this->db->where('staff_code', $code);
        $Q = $this->db->get($this->_table);
        //print_r($this->db->last_query());        
        if ($Q->num_rows() > 0) {
            return true;
        }
        return false;
    }

    function get_user_by_username($username) {
        $this->db->where('username', $username);
        return $this->db->get($this->_table);
    }

    function get_user_by_email($email) {
        $this->db->where('email', $email);
        return $this->db->get($this->_table);
    }

    function get_login($login) {
        $this->db->where('username', $login);
        $this->db->or_where('email', $login);
        return $this->db->get($this->_table);
    }

    function check_ban($user_id) {
        $this->db->select('1', FALSE);
        $this->db->where('id', $user_id);
        $this->db->where('banned', '1');
        return $this->db->get($this->_table);
    }

    function check_username($username) {
        $this->db->select('1', FALSE);
        $this->db->where('LOWER(username)=', strtolower($username));
        return $this->db->get($this->_table);
    }

    function check_email($email) {
        $this->db->select('1', FALSE);
        $this->db->where('LOWER(email)=', strtolower($email));
        return $this->db->get($this->_table);
    }

    function ban_user($user_id, $reason = NULL) {
        $data = array(
            'banned' => 1
                //'ban_reason' 	=> $reason
        );
        return $this->set_user($user_id, $data);
    }

    function unban_user($user_id) {
        $data = array(
            'banned' => 0
                //'ban_reason' 	=> NULL
        );
        return $this->set_user($user_id, $data);
    }

    function set_role($user_id, $role_id) {
        $data = array(
            'role_id' => $role_id
        );
        return $this->set_user($user_id, $data);
    }

    // User table function

    function create_user($data) {
        $data['created'] = date('Y-m-d H:i:s', time());
        $this->db->insert($this->_table, $data);

        //log_history_message('history', 'User added (User ID : '.$this->db->insert_id().').','USERS');
    }

    function get_user_field($user_id, $fields) {
        $this->db->select($fields);
        $this->db->where('id', $user_id);
        return $this->db->get($this->_table);
    }

    function set_user($user_id, $data) {
        $this->db->where('id', $user_id);
        return $this->db->update($this->_table, $data);
    }

    function set_user_ip($user_id, $data) {
        $this->db->where('id', $user_id);
        $this->db->update($this->_table, $data);

        //log_history_message('history', 'User updated (User ID : '.$user_id.').','USERS');
        //return $update_status;
    }

    function delete_user($user_id) {
        $this->db->where('id', $user_id);
        $this->db->delete($this->_table);

        //$this->db->where('ticket_owner', $user_id);
        //$this->db->delete('tickets');
        //$this->db->where('ticket_owner', $user_id);
        //$this->db->delete('tickets_report');
        //$this->db->where('ticket_owner', $user_id);
        //$this->db->delete('travelled_status');
        //log_history_message('history', 'User deleted (User ID : '.$user_id.').','USERS');

        return $this->db->affected_rows() > 0;
    }

    // Forgot password function

    function newpass($user_id, $pass, $key) {
        $data = array(
            'newpass' => $pass,
            'newpass_key' => $key,
            'newpass_time' => date('Y-m-d h:i:s', time() + $this->config->item('DX_forgot_password_expire'))
        );
        return $this->set_user($user_id, $data);
    }

    function activate_newpass($user_id, $key) {
        $this->db->set('password', 'newpass', FALSE);
        $this->db->set('newpass', NULL);
        $this->db->set('newpass_key', NULL);
        $this->db->set('newpass_time', NULL);
        $this->db->where('id', $user_id);
        $this->db->where('newpass_key', $key);

        return $this->db->update($this->_table);
    }

    function clear_newpass($user_id) {
        $data = array(
            'newpass' => NULL,
            'newpass_key' => NULL,
            'newpass_time' => NULL
        );
        return $this->set_user($user_id, $data);
    }

    // Change password function

    function change_password($user_id, $new_pass) {
        $this->db->set('password', $new_pass);
        $this->db->where('id', $user_id);
        return $this->db->update($this->_table);
    }

    function get_user_view($user_id) {
        $users_table = $this->_table;
        $roles_table = $this->_roles_table;

        $this->db->select("$users_table.*", FALSE);
        $this->db->select("$roles_table.name AS role_name", FALSE);
        //$this->db->select("location.country AS location_name", FALSE);
        $this->db->join($roles_table, "$roles_table.id = $users_table.role_id");
        //$this->db->join("location", "location.id = $users_table.location", "left");
        $this->db->order_by("$users_table.id", "ASC");
        $this->db->where("$users_table.id", $user_id);
        return $this->db->get($this->_table);
    }

    function get_company_name($id) {
        $this->db->where('id', $id);
        $Q = $this->db->get('companies');
        if ($Q->num_rows() > 0) {
            foreach ($Q->result() as $row) {
                $data = $row->name;
            }
        } else {
            $data = "-";
        }
        return $data;
    }

}

?>