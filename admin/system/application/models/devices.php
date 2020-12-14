<?php

class Devices extends Model
{

    function Devices()
    {
        parent::Model();
        $this->load->helper('url');
        $this->load->model('Subscribers');
        $this->db_prefix = $this->db->dbprefix;
        $this->devices = $this->config->item($this->db->dbprefix . 'devices');
        $this->room_device = $this->config->item($this->db->dbprefix . 'room_device');
        $this->device_types = $this->config->item($this->db->dbprefix . 'device_types');
    }

    function device_insert_data()
    {
        $data = array(
            'UID' => $this->input->post('UID'),
            'mac_address' => $this->input->post('mac_address'),
            'device_type' => $this->input->post('device_type'),
            'display_type' => $this->input->post('display_type'),
            'video_type' => $this->input->post('video_type'),
            'purchase_order' => $this->input->post('purchase_order'),
            'serial_number' => $this->input->post('serial_number'),
            'IAD' => $this->input->post('IAD'),
            'device_mcast' => $this->input->post('device_mcast'),
            'device_rtp' => $this->input->post('device_rtp'),
            'device_dvbc' => $this->input->post('device_dvbc'),
            'device_ott' => $this->input->post('device_ott'),
            'local_storage' => $this->input->post('local_storage'),
            'PiP' => $this->input->post('PiP'),
            'date_added' => $this->TVclass->current_date()
        );

        if ($this->device_bymacaddress($this->input->post('mac_address'))->num_rows() == 0) {
            $this->db->insert($this->devices, $data);
            $device_id = $this->db->insert_id();
            //print $device_id;exit;
            $this->Subscribers->insert_guest_stb($device_id, 0, $this->TVclass->current_date());
            //  $this->insert_guest_stb($device_id,0,$this->TVclass->current_date());
        }
    }

    function device_update_data($device_id)
    {
        $data = array(
            'UID' => $this->input->post('UID'),
            'mac_address' => $this->input->post('mac_address'),
            'device_type' => $this->input->post('device_type'),
            'display_type' => $this->input->post('display_type'),
            'video_type' => $this->input->post('video_type'),
            'purchase_order' => $this->input->post('purchase_order'),
            'serial_number' => $this->input->post('serial_number'),
            'IAD' => $this->input->post('IAD'),
            'device_mcast' => $this->input->post('device_mcast'),
            'device_rtp' => $this->input->post('device_rtp'),
            'device_dvbc' => $this->input->post('device_dvbc'),
            'device_ott' => $this->input->post('device_ott'),
            'local_storage' => $this->input->post('local_storage'),
            'PiP' => $this->input->post('PiP'),
            'date_updated' => $this->TVclass->current_date()
        );
        $this->db->where('id', $device_id);
        $this->db->update($this->devices, $data);
        $this->Subscribers->update_guest_stb($device_id, 0, $this->TVclass->current_date());
    }

    function device_update_data_type($device_id, $type_id)
    {
        $data = array(
            'device_type' => $type_id
        );
        $this->db->where('id', $device_id);
        $this->db->update($this->devices, $data);
    }

    function deletedevice($device_id)
    {
        $this->db->where('device_id', $device_id);
        $this->db->delete($this->room_device);

        $this->db->where('id', $device_id);
        $this->db->delete($this->devices);

        $d = $this->Subscribers->delete_guest_stb($device_id);
    }

    function device_all($offset = 0, $row_count = 0, $orderby = "ASC", $device_dp = false)
    {
        if ($device_dp == true) {
            $this->db->where($this->devices . '.id NOT IN (select device_id from ' . $this->room_device . ')', NULL, FALSE);
        }
        if (!$orderby) {
            $orderby = "ASC";
        }
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('UID', $orderby);
            $query = $this->db->get($this->devices, $row_count, $offset);
        } else {
            $this->db->orderby('UID', $orderby);
            $query = $this->db->get($this->devices);
        }
        return $query;
    }

    function device_byid($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get($this->devices);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function device_bymacaddress($mac_address)
    {
        $this->db->where('mac_address', $mac_address);
        $query = $this->db->get($this->devices);
        return $query;
    }

    function device_count()
    {
        $a = 0;
        $Q = $this->db->get('devices');
        $a = $Q->num_rows();
        $Q->free_result();
        return $a;
    }

    /** Device Types * */
    function device_types_all($offset = 0, $row_count = 0)
    {
        if ($offset >= 0 AND $row_count > 0) {
            $this->db->orderby('device_type', 'asc');
            $query = $this->db->get($this->device_types, $row_count, $offset);
        } else {
            $this->db->orderby('device_type', 'asc');
            $query = $this->db->get($this->device_types);
        }
        return $query;
    }

    function devtype_insert_data()
    {
        $data = array(
            'device_type' => $this->input->post('device_type'),
            'date_added' => $this->TVclass->current_date()
        );
        $this->db->insert($this->device_types, $data);
    }

    function devtype_update_data($dev_type_id)
    {
        $data = array(
            'device_type' => $this->input->post('device_type'),
            'date_updated' => $this->TVclass->current_date()
        );
        $this->db->where('id', $dev_type_id);
        $this->db->update($this->device_types, $data);
    }

    function device_status_update($id, $value)
    {
        $data = array('device_status' => $value);
        if ($id != 0) {
            $this->db->where('id', $id);
        }
        $this->db->update($this->devices, $data);
        //print_r($this->db->last_query());
    }

    function delete_devtype($dev_type_id)
    {
        $this->db->where('id', $dev_type_id);
        $this->db->delete($this->device_types);
    }

    function device_type_byid($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get($this->device_types);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function device_id_bytype($type)
    {
        $data = array();
        $this->db->where('device_type', $type);
        $Q = $this->db->get($this->device_types);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function device_bymac($id)
    {
        $data = array();
        $this->db->where('mac_address', $id);
        $Q = $this->db->get($this->devices);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function addIfNotDeviceListed($mac, $serialnum, $type, $a)
    {
        $device_id = 0;
        $device_row = $this->device_id_bytype($type);
        if (count($device_row) == 0) {
            $device_row = $this->device_id_bytype($this->config->item('default_device_type'));
        }

        $data = array(
            'UID' => $mac,
            'mac_address' => $mac,
            'device_type' => $device_row['id'],
            'serial_number' => $serialnum,
            'date_added' => $this->TVclass->current_date()
        );

        $chk_device = $this->device_bymac($mac);

        if (count($chk_device) == 0) {
            if ($a == "yes") {
                $this->db->insert($this->devices, $data);
                $device_id = $this->db->insert_id();
                $this->Subscribers->insert_guest_stb($device_id, 0, $this->TVclass->current_date());
                $room_id = $this->rooms->getNNNNNRoomId();
                if ($room_id > 0 && $device_id > 0)
                    $this->rooms->insert_roomdevice($device_id, $room_id);
            }
        } else {
            $device_id = $chk_device['id'];
            $this->device_update_data_type($device_id, $device_row['id']);
        }
        return $device_id;
    }

}

?>