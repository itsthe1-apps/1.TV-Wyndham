<?php

class Rooms extends Model {

    function Rooms() {
        parent::Model();
        $this->load->database();
        //$this->load->helper('url');
        //$this->db_prefix = $this->db->dbprefix;
        $this->db_prefix = 'mw_';
        $this->room = $this->config->item($this->db_prefix . 'room');
        $this->room_group = $this->config->item($this->db_prefix . 'room_group');
        $this->room_type = $this->config->item($this->db_prefix . 'room_type');
        $this->room_guest = $this->config->item($this->db_prefix . 'room_guest');
        $this->room_status = $this->config->item($this->db_prefix . 'room_status');
        $this->room_device = $this->config->item($this->db_prefix . 'room_device');
        $this->room_type = $this->config->item($this->db_prefix . 'room_type');
        $this->channel_group = $this->config->item($this->db_prefix . 'channel_group');
        $this->device_types = $this->config->item($this->db_prefix . 'device_types');
        $this->devices = $this->config->item($this->db_prefix . 'devices');
        $this->group_room = $this->config->item($this->db_prefix . 'group_room');
        $this->group_module = $this->config->item($this->db_prefix . 'group_module');
        $this->guest = $this->config->item($this->db_prefix . 'guest');
        $this->status_text = $this->db_prefix . 'status_text';
    }

    function insert_data($img_data) {
        $data = array(
            'room_number' => $this->input->post('room_number'),
            'emergency_img' => isset($img_data['file_name']) ? $img_data['file_name'] : "", //Edit by Yesh 
            'butler_email' => $this->input->post('butler_email'),
            'room_type' => $this->input->post('room_type'),
            'date_added' => $this->TVclass->current_date()
        );
        if ($this->getRooms() < ALLOWED_ROOMS) {
            $this->db->insert($this->room, $data);
            $this->insert_roomstatus($this->input->post('room_number'));
        }
    }

    function update_data($sub_id) {
        $data = array(
            'room_number' => $this->input->post('room_number'),
            'emergency_img' => isset($img_data['file_name']) ? $img_data['file_name'] : "", //Edit by Yesh 
            'butler_email' => $this->input->post('butler_email'),
            'room_type' => $this->input->post('room_type'),
            'date_updated' => $this->TVclass->current_date()
        );
        $this->db->where('id', $sub_id);
        $this->db->update($this->room, $data);
    }

    function delete_room($sub_id) {
        $this->db->where('room_id', $sub_id);
        $this->db->delete($this->room_guest);

        $this->db->where('room_id', $sub_id);
        $this->db->delete($this->room_device);

        $this->db->where('id', $sub_id);
        $this->db->delete($this->room);
    }

    function get_all($offset = 0, $row_count = 0, $guest_dp = false) {
        if ($guest_dp == true) {
            $this->db->where($this->room . '.id NOT IN (select room_id from ' . $this->room_guest . ')', NULL, FALSE);
        }

        $this->db->join($this->room_type, $this->room_type . '.rt_id=' . $this->room . '.room_type', 'left');
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('id', 'asc');
            $query = $this->db->get($this->room, $row_count, $offset);
        } else {
            $this->db->orderby('id', 'asc');
            $query = $this->db->get($this->room);
        }
        //print $this->db->last_query();
        return $query;
    }

    function get_record_byid($id) {
        $data = array();
        $this->db->join($this->room_type, $this->room_type . '.rt_id=' . $this->room . '.room_type', 'left');
        $this->db->where('id', $id);
        $Q = $this->db->get($this->room);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function getRooms() {
        $Q = $this->db->get($this->room);
        return $Q->num_rows();
    }

    function packages() {
        $this->db->orderby('name', 'asc');
        $query = $this->db->get($this->channel_group);

        return $query;
    }

    function get_package_byid($id) {
        $data = array();
        $this->db->where('name', $id);
        $Q = $this->db->get($this->channel_group);

        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }

        $Q->free_result();
        return $data;
    }

    function device_type() {
        $this->db->orderby('device_type', 'asc');
        $query = $this->db->get($this->device_types);

        return $query;
    }

    function get_device_type_byid($id) {
        $data = array();
        $this->db->where('device_type', $id);
        $Q = $this->db->get($this->device_types);

        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }

        $Q->free_result();

        return $data;
    }

    function getNNNNNRoomId() {
        $room_id = 0;
        $this->db->where('room_number', 'NNNNN');
        $this->db->limit(1);
        $Q = $this->db->get($this->room);

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $room_id = $row['id'];
            }
        }
        $Q->free_result();

        return $room_id;
    }

    function get_room_type() {
        $this->db->orderby('rt_type', 'asc');
        $query = $this->db->get($this->room_type);
        return $query;
    }

    function room_device_exist($device_id) {
        $this->db->where('device_id', $device_id);
        $query = $this->db->get($this->room_device);
        return $query->num_rows();
    }

    function insert_room_device() {
        $data = array(
            'device_id' => $this->input->post('device_id'),
            'room_id' => $this->input->post('room_id')
        );

        if ($this->room_device_exist($this->input->post('device_id')) == 0) {
            $this->db->insert($this->room_device, $data);
        } else {
            print '<div style="font-size:14px; color:red; margin:10px 40px;">Selected device is already in use.</div>';
        }
    }

    function insert_roomdevice($device, $room) {
        $data = array(
            'device_id' => $device,
            'room_id' => $room
        );

        if ($this->room_device_exist($device) == 0) {
            $this->db->insert($this->room_device, $data);
        }
    }

    function get_room_device($room_id) {
        $this->db->join($this->devices, $this->devices . '.id=' . $this->room_device . '.device_id', 'left');
        $this->db->where($this->room_device . '.room_id', $room_id);
        $this->db->orderby($this->devices . '.UID', 'desc');
        $query = $this->db->get($this->room_device);
        //print $this->db->last_query();
        return $query;
    }

    function delete_room_device($device_id) {
        $this->db->where('device_id', $device_id);
        $this->db->delete($this->room_device);
    }

    /** Room Type * */
    function room_types_all($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('rt_type', 'asc');
            $query = $this->db->get($this->room_type, $row_count, $offset);
        } else {
            $this->db->orderby('rt_type', 'asc');
            $query = $this->db->get($this->room_type);
        }
        return $query;
    }

    function roomtype_insert_data() {
        $data = array(
            'rt_type' => $this->input->post('rt_type'),
            'rt_date_added' => $this->TVclass->current_date()
        );
        $this->db->insert($this->room_type, $data);
    }

    function roomtype_update_data($dev_type_id) {
        $data = array(
            'rt_type' => $this->input->post('rt_type'),
            'rt_date_updated' => $this->TVclass->current_date()
        );
        $this->db->where('rt_id', $dev_type_id);
        $this->db->update($this->room_type, $data);
    }

    function delete_roomtype($dev_type_id) {
        $this->db->where('rt_id', $dev_type_id);
        $this->db->delete($this->room_type);
    }

    function room_type_byid($id) {
        $data = array();
        $this->db->where('rt_id', $id);
        $Q = $this->db->get($this->room_type);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function modules_byGroup($id) {
        $data = array();
        $this->db->where('group_id', $id);
        $Q = $this->db->get($this->group_module);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    /** Room Group * */
    function room_groups_all($offset = 0, $row_count = 0) {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('rg_name', 'asc');
            $query = $this->db->get($this->room_group, $row_count, $offset);
        } else {
            $this->db->orderby('rg_name', 'asc');
            $query = $this->db->get($this->room_group);
        }
        return $query;
    }

    function room_group_insert_data() {
        $data = array(
            'rg_name' => $this->input->post('rg_name'),
            'rg_date_added' => $this->TVclass->current_date()
        );
        $this->db->insert($this->room_group, $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }

    function room_group_update_data($room_group_id) {
        $data = array(
            'rg_name' => $this->input->post('rg_name'),
            'rg_date_updated' => $this->TVclass->current_date(),
        );
        $this->db->where('rg_id', $room_group_id);
        $this->db->update($this->room_group, $data);

        $this->delete_group_room($room_group_id);
        if (isset($_POST['room_number']) && count($_POST['room_number']) > 0) {
            for ($i = 0; $i < count($_POST['room_number']); $i++) {
                //print $_POST['room_number'][$i];
                $data = array('gr_group_id' => $room_group_id, 'gr_room_id' => $_POST['room_number'][$i]);
                $this->db->insert($this->group_room, $data);
            }
        }
    }

    function delete_group_room($group_id) {
        $this->db->where('gr_group_id', $group_id);
        $this->db->delete($this->group_room);
    }

    function delete_roomgroup($room_group_id) {
        $this->delete_group_room($room_group_id);
        $this->db->where('rg_id', $room_group_id);
        $this->db->delete($this->room_group);
    }

    function room_group_byid($id) {
        $data = array();
        $this->db->where('rg_id', $id);
        $Q = $this->db->get($this->room_group);

        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }

        $Q->free_result();
        return $data;
    }

    function get_group_room($group_id) {
        $this->db->where('gr_group_id', $group_id);
        $query = $this->db->get($this->group_room);
        return $query;
    }

    function insert_roomstatus() {
        $data = array(
            'room_id' => $this->input->post('room_number'),
            'date_added' => $this->TVclass->current_date()
        );
        $this->db->insert($this->room_status, $data);
    }

    function update_roomstatus($room_id) {
        $data = array(
            'occupied' => $this->input->post('occupied'),
            'clean_vacant' => $this->input->post('clean_vacant'),
            'maintenance_request' => $this->input->post('maintenance_request'),
            'roomcleaning_request' => $this->input->post('cleaning_request'),
            'extra_bed' => $this->input->post('extra_bed'),
            'babycot_request' => $this->input->post('babycot_request'),
            'turndown_done' => $this->input->post('turndown_done'),
            'under_maintenance' => $this->input->post('under_maintenance'),
            'date_added' => $this->TVclass->current_date()
        );
        //print_r($data);
        $this->db->where('room_id', $room_id);
        $this->db->update($this->room_status, $data);
    }

    function update_roomstatusvalue($room_id, $usercode, $type, $roomstatus) {
        $data = array();
        switch ($type) {
            case "vacant_status":
                $data = array('clean_vacant' => $roomstatus, 'clean_vacant_usr' => $usercode, 'clean_vacant_dt' => $this->TVclass->current_date());
                break;
            case "turn_down":
                $data = array('turndown_done' => $roomstatus, 'turndown_usr' => $usercode, 'turndown_dt' => $this->TVclass->current_date());
                break;
            case "under_maintenance":
                $data = array('under_maintenance' => $roomstatus, 'under_maintenance_usr' => $usercode, 'under_maintenance_dt' => $this->TVclass->current_date());
                break;
            case "maintenance_req":
                $data = array('maintenance_request' => $roomstatus, 'maintenance_request_usr' => $usercode, 'maintenance_request_dt' => $this->TVclass->current_date());
                break;
            case "extra_bed":
                $data = array('extra_bed' => $roomstatus, 'extra_bed_usr' => $usercode, 'extra_bed_dt' => $this->TVclass->current_date());
                break;
            case "cleaning_req":
                $data = array('roomcleaning_request' => $roomstatus, 'roomcleaning_request_usr' => $usercode, 'roomcleaning_request_dt' => $this->TVclass->current_date());
                break;
            case "baby_cot":
                $data = array('babycot_request' => $roomstatus, 'babycot_usr' => $usercode, 'babycot_dt' => $this->TVclass->current_date());
                break;
        }

        if (count($data) > 0) {
            //print_r($data);
            $this->db->where('room_id', $room_id);
            $this->db->update($this->room_status, $data);
        }
    }

    function delete_roomstatus($sub_id) {
        $this->db->where('room_id', $sub_id);
        $this->db->delete($this->room_status);
    }

    function get_roomstatus($offset = 0, $row_count = 0, $guest_dp = false) {
        $this->db->join($this->room, $this->room . '.room_number=' . $this->room_status . '.room_id', 'left');
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('room_id', 'asc');
            $query = $this->db->get($this->room_status, $row_count, $offset);
        } else {
            $this->db->orderby('room_id', 'asc');
            $query = $this->db->get($this->room_status);
        }
        //print $this->db->last_query();
        return $query;
    }

    function get_roomsts_filter($offset = 0, $row_count = 0, $flag = false, $guest_dp = false) {
        $parameters = array($flag);
        $query = $this->db->query("CALL prc_getRoomStatus(?)", $parameters);
        mysqli_next_result($this->db->conn_id);
        return $query;
    }

    function get_roomstatus_byid($id) {
        $data = array();
        $this->db->join($this->room, $this->room . '.room_number=' . $this->room_status . '.room_id', 'left');
        $this->db->where('room_id', $id);
        $Q = $this->db->get($this->room_status);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        //print $this->db->last_query();
        return $data;
    }

    function room_guest($room_number) {
        $this->db->join($this->guest, $this->guest . '.id=' . $this->room_guest . '.guest_id', 'left');
        $where = 'room_id = (SELECT id FROM ' . $this->room . ' WHERE room_number=' . $room_number . ')';
        $this->db->where($where);
        $Q = $this->db->get($this->room_guest);
        //print $this->db->last_query();
        return $Q;
    }

    function delete_room_guest($guest_id) {
        $this->db->where('guest_id', $guest_id);
        $this->db->delete($this->room_guest);

        $data = array('status' => 2);
        $this->db->where('id', $guest_id);
        $this->db->update($this->guest, $data);
    }

    function room_status_text() {
        $this->db->order_by('st_id', 'ASC');
        $Q = $this->db->get($this->status_text);
        return $Q;
    }

}

?>