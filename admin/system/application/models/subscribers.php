<?php

class Subscribers extends Model
{

    function Subscribers()
    {
        parent::Model();
        $this->load->database();
        $this->load->helper('url');
        $this->db_prefix = $this->db->dbprefix;
        $this->guest = $this->db->dbprefix . 'guest';
        $this->skin = $this->db->dbprefix . 'skin';
        $this->room = $this->db->dbprefix . 'room';
        $this->room_guest = $this->db->dbprefix . 'room_guest';
        $this->room_device = $this->db->dbprefix . 'room_device';
        $this->history_room_guest = $this->db->dbprefix . 'history_room_guest';
        $this->guest_stb = $this->db->dbprefix . 'guest_stb';
        $this->guest_name = $this->db->dbprefix . 'guest_name';
        $this->guest_alarm = $this->db->dbprefix . 'guest_alarm';
        $this->message = $this->db->dbprefix . 'message';
        $this->usermessage = $this->db->dbprefix . 'usermessage';
        $this->guest_bill_item = $this->db_prefix . 'guest_bill_items';
    }

    function insert_data()
    {
        $dt = new DateTime('2016-03-11 11:00:00', new DateTimeZone('Asia/Dubai'));
        $guest_code = $dt->getTimestamp();

        $data = array(
            'title' => $this->input->post('name_title'),
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'skin' => $this->input->post('skin'),
            'accessibility' => $this->input->post('accessibility'),
            'status' => $this->input->post('status'),
            'address' => $this->input->post('address'),
            'postal_code' => $this->input->post('postal_code'),
            'post' => $this->input->post('post'),
            'country' => $this->input->post('country'),
            'fixed_phone' => $this->input->post('fixed_phone'),
            'mobile_phone' => $this->input->post('mobile_phone'),
            'job_phone' => $this->input->post('job_phone'),
            'FAX' => $this->input->post('FAX'),
            'UID' => $this->input->post('UID'),
            'auto_sub' => $this->input->post('auto_sub'),
            'auto_audio' => $this->input->post('auto_audio'),
            'auto_reminder_time' => $this->input->post('auto_reminder_time'),
            'parental_pin' => $this->input->post('parental_pin'),
            'user_pin' => $this->input->post('user_pin'),
            'package_id' => $this->input->post('package'),
            'date_added' => $this->TVclass->current_date(),
            'guest_code' => $guest_code
        );

        $this->db->insert($this->guest, $data);
        $guest_id = $this->db->insert_id();
        $is_updated_field = $this->input->post('is_updated_field');


        //Assigning guest to the Room
        if ($this->input->post('room_number') != "") {
            $room_guest = array(
                'room_id' => $this->input->post('room_number'),
                'guest_id' => $guest_id,
                //'date_added' => $this->TVclass->current_date(),
                'greeting_id' => $this->input->post('greeting'),
                'theme_id' => $this->input->post('themes'),
                'language_id' => $this->input->post('language')
            );
            $this->db->insert($this->room_guest, $room_guest);
        }

        //Assigning Greeting
        if ($this->input->post('greeting') != "") {
            $data = array(
                'greeting_id' => $this->input->post('greeting')
            );
            $data_where = array('room_id' => $this->input->post('room_number'));
            $this->db->update($this->room_guest, $data, $data_where);
            //$this->insert_guest_stb($guest_id,1,$data['date_added']);
        }

        //Assigning Theme
        if ($this->input->post('themes') != "" && $is_updated_field == 1) {
            $data = array(
                'theme_id' => $this->input->post('themes'),
                'date_added' => $this->TVclass->current_date()
            );
            $data_where = array('room_id' => $this->input->post('room_number'));
            $this->db->update($this->room_guest, $data, $data_where);
            //$this->insert_guest_stb($guest_id,1,$data['date_added']);
        }

        if ($this->input->post('language') != "" && $is_updated_field == 1) {
            $data = array(
                'language_id' => $this->input->post('language'),
                'date_added' => $this->TVclass->current_date()
            );
            $data_where = array('room_id' => $this->input->post('room_number'));
            $this->db->update($this->room_guest, $data, $data_where);
            //$this->insert_guest_stb($guest_id,1,$data['date_added']);
        }
        if ($is_updated_field == 1) {
            $this->save_history($this->input->post('room_number') != "" ? $this->input->post('room_number') : $this->input->post('edit_room_number'));
        }


        //Prototype for guest name translation

//        $name_title_ar = $this->translate_to_arabic($this->input->post('name_title'));
//        $name_ar = $this->translate_to_arabic($this->input->post('name'));
//        $surname_ar = $this->translate_to_arabic($this->input->post('surname'));
//
//        $data_ar = array(
//            'guest_id' => $guest_id,
//            'title' => $name_title_ar,
//            'name' => $name_ar,
//            'surname' => $surname_ar,
//            'language' => 'ar'
//        );
//
//
//
//        $data_en = array(
//            'guest_id' => $guest_id,
//            'title' => $this->input->post('name_title'),
//            'name' => $this->input->post('name'),
//            'surname' => $this->input->post('surname'),
//            'language' => 'en'
//        );
//        //Adding Guest Names to other languages EN
//        $this->db->insert($this->guest_name, $data_en);
//        //Adding Guest Names to other languages AR
//        $this->db->insert($this->guest_name, $data_ar);
    }

    function update_data($guest_id)
    {
        $data = array(
            'title' => $this->input->post('name_title'),
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'skin' => $this->input->post('skin'),
            'accessibility' => $this->input->post('accessibility'),
            'status' => $this->input->post('status'),
            'address' => $this->input->post('address'),
            'postal_code' => $this->input->post('postal_code'),
            'post' => $this->input->post('post'),
            'country' => $this->input->post('country'),
            'fixed_phone' => $this->input->post('fixed_phone'),
            'mobile_phone' => $this->input->post('mobile_phone'),
            'job_phone' => $this->input->post('job_phone'),
            'FAX' => $this->input->post('FAX'),
            'UID' => $this->input->post('UID'),
            'auto_sub' => $this->input->post('auto_sub'),
            'auto_audio' => $this->input->post('auto_audio'),
            'auto_reminder_time' => $this->input->post('auto_reminder_time'),
            'parental_pin' => $this->input->post('parental_pin'),
            'user_pin' => $this->input->post('user_pin'),
            'package_id' => $this->input->post('package'),
            'date_updated' => $this->TVclass->current_date()
        );
        $this->db->where('id', $guest_id);
        $this->db->update($this->guest, $data);

        $is_updated_field = $this->input->post('is_updated_field');

        if ($this->input->post('room_number') != "") {
            $this->delete_room_guest($guest_id);
            // $room_guest = array(
            //     'room_id' => $this->input->post('room_number'),
            //     'guest_id' => $guest_id,
            //     'greeting_id' => 0,
            //     'theme_id' => 0,
            //     'language_id' => 0
            //         //'date_added' => $this->TVclass->current_date()
            // );
            $room_guest = array(
                'room_id' => $this->input->post('room_number'),
                'guest_id' => $guest_id,
                //'date_added' => $this->TVclass->current_date(),
                'greeting_id' => $this->input->post('greeting'),
                'theme_id' => $this->input->post('themes'),
                'language_id' => $this->input->post('language')
            );
            $this->db->insert($this->room_guest, $room_guest);
            //$this->insert_guest_stb($guest_id,1,$this->TVclass->current_date());
        }

        if ($this->input->post('greeting')) {
            $data = array(
                'greeting_id' => $this->input->post('greeting')
            );
            $data_where = array('room_id' => $this->input->post('room_number') != "" ? $this->input->post('room_number') : $this->input->post('edit_room_number'));
            $this->db->update($this->room_guest, $data, $data_where);

            //$this->insert_guest_stb($guest_id,1,$data['date_added']);
        }

        if ($this->input->post('themes') != "" && $is_updated_field == 1) {
            $data = array(
                'theme_id' => $this->input->post('themes'),
                'date_added' => $this->TVclass->current_date()
            );
            $data_where = array('room_id' => $this->input->post('room_number') != "" ? $this->input->post('room_number') : $this->input->post('edit_room_number'));
            $this->db->update($this->room_guest, $data, $data_where);

            //$this->insert_guest_stb($guest_id,1,$data['date_added']);
        }

        if ($this->input->post('language') != "" && $is_updated_field == 1) {
            $data = array(
                'language_id' => $this->input->post('language'),
                'date_added' => $this->TVclass->current_date()
            );
            $data_where = array('room_id' => $this->input->post('room_number') != "" ? $this->input->post('room_number') : $this->input->post('edit_room_number'));
            $this->db->update($this->room_guest, $data, $data_where);

            //	$this->insert_guest_stb($guest_id,1,$data['date_added']);
        }
        if ($is_updated_field == 1) {
            $this->save_history($this->input->post('room_number') != "" ? $this->input->post('room_number') : $this->input->post('edit_room_number'));
        }


        //Prototype for guest name translation

//        $name_title_ar = $this->translate_to_arabic($this->input->post('name_title'));
//        $name_ar = $this->translate_to_arabic($this->input->post('name'));
//        $surname_ar = $this->translate_to_arabic($this->input->post('surname'));
//
//        $data_ar = array(
//            'title' => $name_title_ar,
//            'name' => $name_ar,
//            'surname' => $surname_ar,
//            'language' => 'ar'
//        );
//
//
//        $data_en = array(
//            'title' => $this->input->post('name_title'),
//            'name' => $this->input->post('name'),
//            'surname' => $this->input->post('surname'),
//            'language' => 'en'
//        );
//        //Updating Guest Names to other languages EN
//        $this->db->where('guest_id', $guest_id);
//        $this->db->where('language', 'en');
//        $this->db->update($this->guest_name, $data_en);
//
//        //Updating Guest Names to other languages AR
//        $this->db->where('guest_id', $guest_id);
//        $this->db->where('language', 'ar');
//        $this->db->update($this->guest_name, $data_ar);


    }

    function insert_guest_stb($device_id, $need_restart = 0, $date_modified)
    {
        $data = array(
            'device_id' => $device_id,
            'need_restart' => $need_restart,
            'date_modified' => $date_modified
        );
        $this->db->insert($this->guest_stb, $data);
    }

    function update_guest_stb($device_id, $need_restart = 0, $date_modified)
    {
        //$query="update ".$this->guest_stb." set need_restart = ".$need_restart.",date_modified='". $date_modified."' where device_id=".$device_id;
        //print_r(json_encode($this->db));
        /* try{
          $this->db->query($query);

          } catch (Exception $ex) {
          print $ex->getMessage();
          } */
        $data = array(
            'need_restart' => $need_restart,
            'date_modified' => $date_modified
        );
        // $this->firephp->log(json_encode($this->db));
        //print "jk".$this->guest_stb;
        $this->db->where('device_id', $device_id);
        $this->db->update($this->guest_stb, $data);
    }

    function setRoomDevicesToRestart($room_number, $need_restart, $date_modified)
    {
        $query = "update mw_guest_stb set need_restart=" . $need_restart . ",date_modified='" . $date_modified . "' where device_id in (select device_id from mw_room_device where room_id=(select id from mw_room where room_number='" . $room_number . "' limit 0,1))";
        //print $query;
        $this->db->query($query);
    }

    function delete_guest_stb($guest_id)
    {
        $this->db->where('device_id', $guest_id);
        $this->db->delete($this->guest_stb);
    }

    function save_history($room_id)
    {
        $query = 'INSERT INTO ' . $this->history_room_guest . ' SELECT * FROM ' . $this->room_guest . ' WHERE room_id=' . $room_id;
        $this->db->query($query);
    }

    function delete_room_guest($guest_id)
    {
        $this->db->where('guest_id', $guest_id);
        $this->db->delete($this->room_guest);
    }

    function delete_subscribers($sub_id)
    {
        $this->delete_room_guest($sub_id);
        $this->delete_namelanguage_guest($sub_id);
        $this->db->where('id', $sub_id);
        $this->db->delete($this->guest);
    }

    function get_all($offset = 0, $row_count = 0, $session_keyword = false)
    {
        if ($this->session->userdata($session_keyword) != "") {
            $this->db->where('status', $this->session->userdata($session_keyword));
        } else {
            $this->db->where('status', 1);
        }
        $this->db->select($this->guest . '.*,' . $this->skin . '.sk_name');
        $this->db->join($this->skin, $this->skin . '.sk_css=' . $this->guest . '.skin', 'left');
        $this->db->orderby('name', 'asc');

        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->guest, $row_count, $offset);
        } else {
            $query = $this->db->get($this->guest);
        }
        //print_r($this->db->last_query());
        return $query;
    }

    function get_record_byid($id)
    {
        $data = array();

        $this->db->join($this->room_guest, $this->room_guest . '.guest_id=' . $this->guest . '.id', 'left');
        $this->db->join($this->room, $this->room . '.id=' . $this->room_guest . '.room_id', 'left');

        $this->db->where('guest.id', $id);
        $Q = $this->db->get($this->guest);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        $Q->free_result();
        return $data;
    }

    function packages()
    {
        $this->db->orderby('name', 'asc');
        $query = $this->db->get('channel_group');

        return $query;
    }

    function get_package_byid($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get('channel_group');

        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }

        $Q->free_result();
        return $data;
    }

    function skin()
    {
        $this->db->orderby('sk_name', 'asc');
        $query = $this->db->get('skin');

        return $query;
    }

    function get_skin_byid($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get('skin');

        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }

        $Q->free_result();
        return $data;
    }

    /** Name in other languages * */
    function name_otherlanguages($offset = 0, $row_count = 0, $id)
    {
        $this->db->where('guest_id', $id);
        $this->db->orderby('guest_id', 'asc');

        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->guest_name, $row_count, $offset);
        } else {
            $query = $this->db->get($this->guest_name);
        }
        //print_r($this->db->last_query());
        return $query;
    }

    function insert_namelanguage_data()
    {
        $data = array(
            'guest_id' => $this->input->post('guest_id'),
            'title' => $this->input->post('title'),
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'language' => $this->input->post('language'),
        );
        $this->db->insert($this->guest_name, $data);
    }

    function update_namelanguage_data($id)
    {
        $data = array(
            'guest_id' => $this->input->post('guest_id'),
            'title' => $this->input->post('title'),
            'name' => $this->input->post('name'),
            'surname' => $this->input->post('surname'),
            'language' => $this->input->post('language'),
        );
        $this->db->where('id', $id);
        $this->db->update($this->guest_name, $data);
    }

    function get_record_namelanguage_byid($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $Q = $this->db->get($this->guest_name);
        if ($Q->num_rows() > 0) {
            $data = $Q->row_array();
        }
        //print_r($this->db->last_query());
        $Q->free_result();
        return $data;
    }

    function delete_namelanguage($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->guest_name);
    }

    function delete_namelanguage_guest($id)
    {
        $this->db->where('guest_id', $id);
        $this->db->delete($this->guest_name);
    }

    function guest_alarm($offset = 0, $row_count = 0)
    {
        $this->db->select('*,' . $this->guest_alarm . '.status as alarm_status,' . $this->guest_alarm . '.id as guest_alarm_id');
        $this->db->join($this->guest, $this->guest . '.id=' . $this->guest_alarm . '.guest', 'left');
        $this->db->order_by($this->guest_alarm . '.status ASC,' . $this->guest_alarm . '.alarm_time DESC');
        if ($offset >= 0 AND $row_count > 0) {
            $query = $this->db->get($this->guest_alarm, $row_count, $offset);
        } else {
            $query = $this->db->get($this->guest_alarm);
        }
        return $query;
    }

    function update_alarm_request($request_id, $status = 1)
    {
        $data = array('status' => $status);
        $this->db->where('id', $request_id);
        $this->db->update($this->guest_alarm, $data);
    }

    function delete_alarm_request($request_id)
    {
        $this->db->where('id', $request_id);
        $this->db->delete($this->guest_alarm);
    }

    function get_alarm_request_byid($request_id)
    {
        $this->db->where('id', $request_id);
        $query = $this->db->get($this->guest_alarm);
        return $query;
    }

    function add_message_log($guest_id, $message)
    {
        $data_message = array(
            'message' => nl2br($message),
            'date_added' => $this->TVclass->current_date()
        );
        $this->db->insert($this->message, $data_message);
        $added_id = $this->db->insert_id();

        $data = array('user' => $guest_id, 'message' => $added_id, 'date_added' => $this->TVclass->current_date());
        $this->db->insert($this->usermessage, $data);
    }

    /**
     * add guest from dtcm request
     * @param $data mixed
     * @param $room_guest mixed
     * @return void
     */
    function pms_checkin($data, $room_guest)
    {

        //Guest Insert
        $this->db->insert($this->guest, $data);
        $guest_id = $this->db->insert_id();
        $is_updated_field = 1;
        $roomId = $room_guest['room_id'];

        if ($room_guest['room_id'] != "") {
            $room_guest['guest_id'] = $guest_id;
            $room_guest['date_added'] = $this->TVclass->current_date();
            $status = $this->get_room_guest_by_room_id($roomId);
            if ($status) {
                $this->db->where('room_id', $roomId);
                $this->db->update($this->room_guest, $room_guest);
            } else {
                $this->db->insert($this->room_guest, $room_guest);
            }

        }

        if ($is_updated_field == 1) {
            $this->save_history($roomId);
        }

        //rebooting devices
        $devices = array();
        $this->db->select('device_id');
        $this->db->where('room_id', $roomId);
        $Q = $this->db->get($this->room_device);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $key) {
                $devices[] = $key['device_id'];
            }
        }

        $Q->free_result();
        foreach ($devices as $valule) {
            $this->reboot_device_by_id($valule);
        }


        ////Prototype for guest name translation

//        $name_title_ar = $this->translate_to_arabic($data['title']);
//        $name_ar = $this->translate_to_arabic($data['name']);
//        $surname_ar = $this->translate_to_arabic($data['surname']);

        $data_en = array(
            'guest_id' => $guest_id,
            'title' => $data['title'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'language' => 'en'
        );
        //Adding Guest Names to other languages EN
        $this->db->insert($this->guest_name, $data_en);

        $data_ar = array(
            'guest_id' => $guest_id,
            'title' => $data['title'],
            'name' => $data['name'],
            'surname' => $data['surname'],
            'language' => 'ar'
        );
        //Adding Guest Names to other languages AR
        $this->db->insert($this->guest_name, $data_ar);

    }

    //Guest Update

    function pms_guest_update($roomId,$guest_id,$update_data){
        //Update Guest
        $this->db->where('id', $guest_id);
        $this->db->update($this->guest, $update_data);


        //rebooting devices
        $devices = array();
        $this->db->select('device_id');
        $this->db->where('room_id', $roomId);
        $Q = $this->db->get($this->room_device);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $key) {
                $devices[] = $key['device_id'];
            }
        }

        $Q->free_result();
        foreach ($devices as $valule) {
            $this->reboot_device_by_id($valule);
        }


        //Prototype for guest name translation

//        $name_title_ar = $this->translate_to_arabic($update_data['title']);
//        $name_ar = $this->translate_to_arabic($update_data['name']);
//        $surname_ar = $this->translate_to_arabic($update_data['surname']);

        $data_en = array(
            'title' => $update_data['title'],
            'name' => $update_data['name'],
            'surname' => $update_data['surname'],
            'language' => 'en'
        );


        $data_ar = array(
            'title' => $update_data['title'],
            'name' => $update_data['name'],
            'surname' => $update_data['surname'],
            'language' => 'ar'
        );
        //Updating Guest Names to other languages EN
        $this->db->where('guest_id', $guest_id);
        $this->db->where('language', 'en');
        $this->db->update($this->guest_name, $data_en);

        //Updating Guest Names to other languages AR
        $this->db->where('guest_id', $guest_id);
        $this->db->where('language', 'ar');
        $this->db->update($this->guest_name, $data_ar);


    }

    function pms_checkout($guest_id,$room_id){


        //Remove Guests
        $this->db->where('id', $guest_id);
        $this->db->delete($this->guest);
        //Remove Guest From Room
        $status = $this->get_room_guest_by_room_id($room_id);
        if ($status){
            $this->db->where('guest_id', $guest_id);
            $this->db->delete($this->room_guest);
        }
        //Check Out Devices


        $devices = array();
        $this->db->select('device_id');
        $this->db->where('room_id', $room_id);
        $Q = $this->db->get($this->room_device);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $key) {
                $devices[] = $key['device_id'];
            }
        }

        $Q->free_result();
        foreach ($devices as $valule) {
            $this->checkout_device_by_id($valule);
        }

        //Remove Guest Names

        $this->db->where('guest_id', $guest_id);
        $this->db->delete($this->guest_name);

    }

    function pms_room_change($roomId_checkedOut,$roomId_checkedIn,$guest_code){
        //Remove Guest From Room
        $status = $this->get_room_guest_by_room_id($roomId_checkedOut);

        if ($status){
            $this->db->where('guest_id', $guest_code['guest_id']);
            $this->db->delete($this->room_guest);
        }

        //Check Out Devices


        $devices = array();
        $this->db->select('device_id');
        $this->db->where('room_id', $roomId_checkedOut);
        $Q = $this->db->get($this->room_device);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $key) {
                $devices[] = $key['device_id'];
            }
        }

        $Q->free_result();
        foreach ($devices as $valule) {
            $this->checkout_device_by_id($valule);
        }

        //Checkin Guest
        $theme_id = 18;
        $room_guest = array(
            'room_id'     => $roomId_checkedIn,
            'guest_id'    => '0',
            'greeting_id' => '1',
            'theme_id'    => $theme_id,
            'language_id' => '1',
        );

        if ($room_guest['room_id'] != "") {
            $room_guest['guest_id'] = $guest_code['guest_id'];
            $room_guest['date_added'] = $this->TVclass->current_date();
            $status = $this->get_room_guest_by_room_id($roomId_checkedIn);
            if ($status) {
                $this->db->where('room_id', $roomId);
                $this->db->update($this->room_guest, $room_guest);
            } else {
                $this->db->insert($this->room_guest, $room_guest);
            }

        }

        //rebooting devices
        $devices = array();
        $this->db->select('device_id');
        $this->db->where('room_id', $roomId_checkedIn);
        $Q = $this->db->get($this->room_device);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $key) {
                $devices[] = $key['device_id'];
            }
        }

        $Q->free_result();
        foreach ($devices as $valule) {
            $this->reboot_device_by_id($valule);
        }

    }

    function pms_bill_items($data){

        $this->db->insert($this->guest_bill_item, $data);

    }

    function pms_bill_total($guest_id,$guest_code,$total_amount){

        $this->db->set('bill_amount',$total_amount);
        $this->db->where('id', $guest_id);
        $this->db->where('guest_code', $guest_code);
        $this->db->update($this->guest);
    }

    /**
     * get_roomId_by_room_number
     * @param type $room_number
     * @return type
     */
    function get_roomId_by_room_number($room_number)
    {
        $roomId = array();
        $this->db->select('id');
        $this->db->where('room_number', $room_number);
        $Q = $this->db->get($this->room);
        if ($Q->num_rows() > 0) {
            $roomId = $Q->row_array();
        }
        //        print_r($this->db->last_query());
        $Q->free_result();
        return $roomId['id'];
    }


    /*
     * reboot device by Id
     * @param type $device_id String
     * @return void
     */
    function reboot_device_by_id($device_id)
    {
        $update_val = 1;
        $checkedOut = 0;
        $data = array(
            'need_restart' => $update_val,
            'date_modified' => $this->TVclass->current_date(),
            'checked_out' => $checkedOut
        );
        $status = $this->get_device_status($device_id);
        if ($status) {
            $this->db->where('device_id', $device_id);
            $this->db->update($this->guest_stb, $data);
        } else {
            $this->insert_guest_stb($device_id, 1, $this->TVclass->current_date());
        }


    }

    function checkout_device_by_id($device_id)
    {
        $update_val = 0;
        $checkedOut = 1;
        $data = array(
            'need_restart' => $update_val,
            'date_modified' => $this->TVclass->current_date(),
            'checked_out' => $checkedOut
        );
        $status = $this->get_device_status($device_id);
        if ($status) {
            $this->db->where('device_id', $device_id);
            $this->db->update($this->guest_stb, $data);
        } else {
            $this->insert_guest_stb($device_id, 1, $this->TVclass->current_date());
        }


    }

    function get_device_status($device_id)
    {
        $status = false;
        $this->db->select('device_id');
        $this->db->where('device_id', $device_id);
        $Q = $this->db->get($this->guest_stb);
        if ($Q->num_rows() > 0) {
            $status = true;
        }
        //        print_r($this->db->last_query());
        $Q->free_result();
        return $status;
    }

    function get_room_guest_by_room_id($room_id)
    {
        $status = false;
        $this->db->select('room_id');
        $this->db->where('room_id', $room_id);
        $Q = $this->db->get($this->room_guest);
        if ($Q->num_rows() > 0) {
            $status = true;
        }
        //        print_r($this->db->last_query());
        $Q->free_result();
        return $status;
    }

    function guest_status($guest_code){

        $guest_id = 0;
        $status = false;
        $this->db->select('id');
        $this->db->where('guest_code', $guest_code);
        $Q = $this->db->get($this->guest);
        if ($Q->num_rows() > 0) {
            $status = true;
            $guest_id = $Q->row_array();
        }
        $data = array('status' => $status,'guest_id' => $guest_id['id']);
        //print_r($this->db->last_query());
        $Q->free_result();
        return $data;
    }

    function guest_message($room_no,$guest_code,$message_text){
        $guest = $this->guest_status($guest_code);
        $status = $guest['status'];
        $id = $guest['guest_id'];
        //Insert Message
        if ($status == true){
            $message_data['message'] = $message_text;
            $message_data['date_added'] = $this->TVclass->current_date();
            $message_data['date_modified'] = $this->TVclass->current_date();

            $this->db->insert($this->message, $message_data);
            $added_id = $this->db->insert_id();

            $data = array('user' => $id, 'message' => $added_id, 'date_added' => $this->TVclass->current_date());
            $this->db->insert($this->usermessage, $data);
        }
    }

    function get_guest_code_room_number($guest_id){

        $room_id = 0;
        $this->db->select('room_id');
        $this->db->where('guest_id', $guest_id);
        $Q = $this->db->get($this->room_guest);
        if ($Q->num_rows() > 0) {
            $room_id = $Q->row_array();
        }
        //print_r($this->db->last_query());
        $Q->free_result();

        //Getting Guest Code
        $guest_code = null;
        $this->db->select('guest_code');
        $this->db->where('id', $guest_id);
        $QG = $this->db->get($this->guest);
        if ($QG->num_rows() > 0) {
            $guest_code = $QG->row_array();
        }
        //print_r($this->db->last_query());
        $QG->free_result();


        //Getting Room Number
        $room_number = 0;
        $this->db->select('room_number');
        $this->db->where('id', $room_id['room_id']);
        $QR = $this->db->get($this->room);
        if ($QR->num_rows() > 0) {
            $room_number = $QR->row_array();
        }
        //print_r($this->db->last_query());
        $QR->free_result();

        $guest_data = array('guest_code' => $guest_code['guest_code'], 'room_number' => $room_number['room_number']);
        return $guest_data;


    }

    //Translate Guest Names to Arabic
    function translate_to_arabic($text){
        $CLIENT_ID = "FREE_TRIAL_ACCOUNT";
        $CLIENT_SECRET = "PUBLIC_SECRET";
// Specify your translation requirements here:
        $postData = array(
            'fromLang' => "en",
            'toLang' => "ar",
            'text' => $text
        );
        $headers = array(
            'Content-Type: application/json',
            'X-WM-CLIENT-ID: '.$CLIENT_ID,
            'X-WM-CLIENT-SECRET: '.$CLIENT_SECRET
        );
        $url = 'http://api.whatsmate.net/v1/translation/translate';
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    function get_bill_items($room_no,$guest_code){

        $bill_items = array();
        $this->db->select('descreption');
        $this->db->select('amount');
        $this->db->where('room_number', $room_no);
        $this->db->where('guest_code', $guest_code);
        $QR = $this->db->get($this->guest_bill_item);
        if ($QR->num_rows() > 0) {
            //$room_number = $QR->row_array();
            foreach ($QR->result_array() as $key => $values){
                $bill_items[$key] = $values;
            }
        }
       //print_r($this->db->last_query());
        $QR->free_result();
        return $bill_items;
    }

    function get_bill_total($guest_code){
        $bill_total = null;
        $this->db->select('bill_amount');
        $this->db->where('guest_code', $guest_code);
        $QR = $this->db->get($this->guest);
        if ($QR->num_rows() > 0) {
            $bill_total = $QR->row_array();
        }
        return $bill_total['bill_amount'];
    }

    function complete_checkout($device_id){
        $this->db->where('device_id', $device_id);
        $data = array("checked_out"=>0);
        $this->db->update($this->guest_stb, $data);
    }

}
