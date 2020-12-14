<?php

require(APPPATH . '/libraries/REST_Controller.php');

class Api extends REST_Controller
{

    function channels_get()
    {

        $u_id = $this->get('uid');
        $g_id = $this->get('gid');

        $this->load->model('WebService');

        $channels = $this->WebService->get_channels_api($u_id, $g_id);

        if ($channels) {
            $this->response($channels, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function restaurants_get()
    {
        $this->load->model('WebService');
        $language = "en";
        if (array_key_exists('language', $this->get())) {
            $language = trim($this->get('language'));
        }
        $restaurants = $this->WebService->get_restaurants_api($language);
        if ($restaurants) {
            $this->response($restaurants, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function spa_get()
    {
        $this->load->model('WebService');
        $language = "en";
        if (array_key_exists('language', $this->get())) {
            $language = trim($this->get('language'));
        }

        $spa = $this->WebService->get_spa_api($language);
        if ($spa) {
            $this->response($spa, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function experience_get()
    {

        $this->load->model('WebService');
        $language = "en";
        if (array_key_exists('language', $this->get())) {
            $language = trim($this->get('language'));
        }

        $experience = $this->WebService->get_experience_api($language);
        if ($experience) {
            $this->response($experience, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    /**
     * datetime_get
     * Added by Yesh
     * 2016-08-14
     */
    function datetime_get()
    {
        $datetime = DateTime::createFromFormat('Y-m-d H:i', date('Y-m-d H:i'));
        $array = array('date' => date("Y-m-d"), 'time' => date('H:i'), 'day' => $datetime->format('D'));
        if ($array) {
            $this->response($array, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find now date and time!'), 404);
        }
    }

    function restmenutypes_get()
    {
        $this->load->model('WebService');

        $restaurants = $this->WebService->get_restmenutype_api();
        if ($restaurants) {
            $this->response($restaurants, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function localinfos_get()
    {
        $this->load->model('WebService');
        if (array_key_exists('language', $this->get())) {
            $language = trim($this->get('language'));
        }
        $localinfos = $this->WebService->get_localinfos_api($language);
        if ($localinfos) {
            $this->response($localinfos, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function newsnpromos_get()
    {
        $this->load->model('WebService');
        if (array_key_exists('language', $this->get())) {
            $language = trim($this->get('language'));
        }
        $newsnpromos = $this->WebService->get_newsnpromos_api($language);
        if ($newsnpromos) {
            $this->response($newsnpromos, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any news n promos!'), 404);
        }
    }

    function localinfotypes_get()
    {
        $this->load->model('WebService');
        $localinfotypes = $this->WebService->get_localinfotypes_api();
        if ($localinfotypes) {
            $this->response($localinfotypes, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function newsflag_get()
    {
        $this->load->model('WebService');

        $news = $this->WebService->get_newsflag_api();
        /*
          if ($news[0]['news']) {
          $this->response($news[0]['news'], 200); // 200 being the HTTP response code
          } else {
          $this->response(array('error' => 'Couldn\'t find any users!'), 404);
          } */
        print $news[0]['news'];
    }

    function weather_get()
    {
        $this->load->model('WebService');
        $language = "en";
        if (array_key_exists('language', $this->get())) {
            $language = trim($this->get('language'));
        }
        $data = $this->WebService->get_weather_api($language);
        if ($data) {
            $url = $data[0]['weather_rss'];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $curlout = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($curlout, true);
//            echo '<pre>';
//            print_r($response);
//            echo '</pre>';
//            die();
            $forecast = $response['query']['results']['channel']['item']['forecast'];
            $city = $response['query']['results']['channel']['location']['city'];
            $unit = $response['query']['results']['channel']['units']['temperature'];
            $weatherArray = [];
            $i = 0;
            foreach ($forecast as $value) {
                $weatherType = $value['text'];
                $tmpHigh = $value['high'] . "" . $unit;
                $tmpLow = $value['low'] . "" . $unit;
                $code = $value['code'];
                $day = $i == 0 ? 'Today' : ($i == 1 ? 'Tomorrow' : $value['day']);
                $imgName = $code . $this->config->item('weather_icon_type');
                $weatherImageURL = $this->config->item('weather_icon_url') . $imgName;
                array_push($weatherArray, array('city' => $city, 'weatherType' => $weatherType, 'tmpHigh' => $tmpHigh, 'tmpLow' => $tmpLow, 'weatherImageURL' => $weatherImageURL, 'day' => $day));
                $i++;
            }
            $this->response($weatherArray, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function checkRemoteFile($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (curl_exec($ch) !== FALSE) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function messageread_post()
    {
        $this->load->model('WebService');
        $mac_address = "";
        $id = 0;
        if (array_key_exists('mac_address', $this->get())) {
            $mac_address = trim($this->get('mac_address'));
            $mac_address = str_replace(":", "", $mac_address);
            $mac_address = strtolower($mac_address);
        }

        if (array_key_exists('id', $this->get())) {
            $id = trim($this->get('id'));
        }

        //print $str = $mac_address . ":" . $serial_number . ":" . $id;

        if ($mac_address != "" && $id > 0) {
            $isUser = $this->WebService->checkUser($mac_address);
            //print "jk".$isUser;
            ///$this->firephp->log("userstatus"+$isUser+":id"+$id);
            if ($isUser == "yes") {
                $this->WebService->updateMessage($id);
            }
        }

        //  $this->response($str, 200);
    }

    function userchannels_get()
    {
        $this->load->model('WebService');
        $mac_address = "";
        $serial_number = "";

        if (array_key_exists('mac_address', $this->get())) {
            $mac_address = trim($this->get('mac_address'));
            $mac_address = str_replace(":", "", $mac_address);
        }

        if (array_key_exists('serial_number', $this->get())) {
            $serial_number = trim($this->get('serial_number'));
        }

        if ($mac_address != "" && $serial_number != "") {
            $allowed_chgroups = $this->WebService->getAllowedChannelGroups($mac_address, $serial_number);
            if (!empty($allowed_chgroups)) {
                $allowed_channels = $this->WebService->getChannelsforGroups($allowed_chgroups);
                if (!empty($allowed_channels)) {
                    $channels = $this->WebService->getAllowedChannels($allowed_channels);
                    if ($channels) {
                        $this->response($channels, 200); // 200 being the HTTP response code
                    } else {
                        $this->response(array('error' => 'Couldn\'t find any users!'), 404);
                    }
                }
            }
        }
    }

    function movies_get()
    {
        $g_id = $this->get('id');

        $this->load->model('WebService');

        $movies = $this->WebService->get_movies_api($g_id);
        if ($movies) {
            $this->response($movies, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function programs_get()
    {
        $this->load->model('WebService');

        $programs = $this->WebService->get_programs_api();
        if ($programs) {
            $this->response($programs, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function genres_get()
    {
        $this->load->model('WebService');

        $genres = $this->WebService->get_genres_api();
        if ($genres) {
            $this->response($genres, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function parentals_get()
    {
        $this->load->model('WebService');

        $parentals = $this->WebService->get_parentals_api();
        if ($parentals) {
            $this->response($parentals, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function news_get()
    {
        $this->load->model('WebService');
        $language = "";

        if (array_key_exists('language', $this->get())) {
            $language = trim($this->get('language'));
        }
        $news = $this->WebService->get_news_api($language);
        if ($news) {
            $this->response($news, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function tickertape_get()
    {
        $this->load->model('WebService');
        $language = "";

        if (array_key_exists('language', $this->get())) {
            $language = trim($this->get('language'));
        }
        $news = $this->WebService->get_tickertape_api($language);
        if ($news) {
            $this->response($news, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function xmltvlist_get()
    {
        $this->load->model('WebService');

        $news = $this->WebService->get_xmltvlist_api();
        if ($news) {
            $this->response($news, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function login_post()
    {
        $this->load->model('WebService');
        $response_string = "";
        $mac_address = "";
        $serial_number = "";

        if (array_key_exists('mac_address', $this->get())) {
            $mac_address = trim($this->get('mac_address'));
            $mac_address = str_replace(":", "", $mac_address);
        }

        if (array_key_exists('serial_number', $this->get())) {
            $serial_number = trim($this->get('serial_number'));
        }

        if ($mac_address == "" || $serial_number == "") {
            $response_string = "EMPTY_CREDENTIALS";
        } else {
            $mac_address = trim($this->get('mac_address'));
            $serial_number = trim($this->get('serial_number'));
            $result = $this->WebService->get_user_by_username($mac_address, $serial_number);
            $response_string = ($result == 1) ? 'VALID_CREDENTIALS' : 'INVALID_CREDENTIALS';
        }

        $data = $response_string;
        $this->responseHTML($data);
    }

    function skins_get()
    {
        $this->load->model('WebService');

        $skins = $this->WebService->get_skins_api();

        if ($skins) {
            $this->response($skins, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function language_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_language_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function devices_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_devices_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function devices_type_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_devices_type_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function devices_groups_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_devices_groups_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function guest_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_guest_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function rooms_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_rooms_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function greeting_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_greeting_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function occation_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_occation_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function message_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_message_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function itvgenre_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_itvgenre_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function packages_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_packages_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function parental_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_parental_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function user_roles_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_user_roles_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function users_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_users_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function favourites_get()
    {
        $get_id = $this->get('user');
        $this->load->model('WebService');

        $channels = $this->WebService->get_favourites_api($get_id);

        if ($channels) {
            $this->response($channels, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function setfavourite_post()
    {
        $this->load->model('WebService');
        $user = 0;
        $channel = 0;

        if (array_key_exists('user', $this->get())) {
            $user = trim($this->get('user'));
        }
        if (array_key_exists('channel', $this->get())) {
            $channel = trim($this->get('channel'));
        }
        if ($user > 0 && $channel > 0) {
            $this->WebService->favourite_insert_data($user, $channel);
        }
    }

    function changelang_post()
    {
        $this->load->model('rooms');
        if (array_key_exists('user_id', $this->get())) {
            $user_id = trim($this->get('user_id'));
        }
        if (array_key_exists('language', $this->get())) {
            $language = trim($this->get('language'));
        }
//        $user_id = $this->get('user_id');
//        $language = $this->get('language');
        $this->load->model('WebService');
        $lan = $language == "en" ? 2 : 1; //if en change to ar
        if (isset($user_id)) {
            $data = $this->WebService->change_user_lang($user_id, $lan);
            if ($data) {
                $this->response($data, 200); //200 being the HTTP response code
            } else {
                $this->response(array('error' => 'Couldn\'t find any users!'), 404);
            }
        } else {
            $this->response(array('error' => 'Language Changed'), 404);
        }
    }

    function removefavourite_post()
    {
        $this->load->model('WebService');
        $user = 0;
        $channel = 0;

        if (array_key_exists('user', $this->get())) {
            $user = trim($this->get('user'));
        }
        if (array_key_exists('channel', $this->get())) {
            $channel = trim($this->get('channel'));
        }

        if ($user > 0 && $channel > 0) {
            $this->WebService->favourite_remove_data($user, $channel);
        }
    }

    function vod_get()
    {
        $this->load->model('WebService');

        $channels = $this->WebService->get_vod_api();

        if ($channels) {
            $this->response($channels, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function user_get()
    {
        $this->load->model('WebService');
        $this->load->model('rooms');
        $this->load->model('Devices');

        $mac_address = strtolower($this->get('mac_address'));
        $mac_address = str_replace(":", "", $mac_address);
        $allowed_macrange = substr($mac_address, 0, MAC_LEN);
        $serial_num = $this->get('serial_number');
        $type = $this->get('type');
        $td = $this->Devices->device_count();
        $add = "no";
        if (DEVICE_LIMIT == $td)
            $add = "eq";
        else if (DEVICE_LIMIT < $td)
            $add = "yes";

        if (in_array($allowed_macrange, unserialize(STB_RANGE)) && ($add == "eq" || $add = "yes")) {
            $device_id = 0;
            $device_id = $this->Devices->addIfNotDeviceListed($mac_address, $serial_num, $type, $add);
            //$data = array();
            if ($device_id > 0) {
                $data = $this->WebService->get_user_api($device_id);
            }

            if ($data) {
                $this->response($data, 200); // 200 being the HTTP response code
            } else {
                $this->response(array('error' => 'Couldn\'t find any users!'), 404);
            }
        } else {
            $this->response(array('error' => 'Invalid Device'), 404);
        }
    }

    function usermessages_get()
    {
        $this->load->model('WebService');
        $user_id = "";

        if (array_key_exists('user_id', $this->get())) {
            $user_id = trim($this->get('user_id'));
        }

        if ($user_id != "") {
            $message = $this->WebService->getUserMessages($user_id);
            if (!empty($message)) {
                if ($message) {
                    $this->response($message, 200); // 200 being the HTTP response code
                } else {
                    $this->response(array('error' => 'Couldn\'t find any users!'), 404);
                }
            }
        }
    }

    function settings_get()
    {

        $this->load->model('WebService');

        $data = $this->WebService->get_settings_api();
        if ($data) {
            $this->response($data, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function style_get()
    {
        $id = $this->get('id');
        $this->load->model('WebService');
        $data = $this->WebService->get_style_api($id);
        if ($data) {
            $this->response($data, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function user_get_post()
    {
        $this->load->model('WebService');
        $type = "";
        $user = 0;
        $guest = 1;
        $date = "";
        $time = "";
        if (array_key_exists('type', $this->get())) {
            $type = trim($this->get('type'));
        }
        if (array_key_exists('user', $this->get())) {
            $user = trim($this->get('user'));
        }
        if (array_key_exists('guest', $this->get())) {
            $guest = trim($this->get('guest'));
        }
        if (array_key_exists('time', $this->get())) {
            $time = trim($this->get('time'));
        }
        $time = str_replace("_", ":", $time);
        if (array_key_exists('date', $this->get())) {
            $date = trim($this->get('date'));
        }
        if ($user > 0 && $type != "") {
            //code here
            $this->load->model('dx_auth/users');
            $this->load->model('Subscribers');

            if ($date > 0) {
                $date = date('l jS F Y', strtotime("+$date days"));
            } else {
                $date = date('l jS F Y');
            }

            $guest_info = $this->Subscribers->get_record_byid($user);

            // $to_email = $guest_info['butler_email'];

            $message = 'Date : ' . $date . '<br>';
            $message .= 'Time : ' . $time . '<br>';
            $message .= 'Guest Name : ' . $guest_info['title'] . '.' . $guest_info['name'] . '<br>';
            $message .= 'Room Number : ' . $guest_info['room_number'] . '<br>';
            $from_email = $this->config->item('guest_support');
            $from_name = 'Room Number - ' . $guest_info['room_number'];

            $subject = "";
            $to_email = $this->WebService->get_configmail($type);
            if ($type == 'wakeup') {
                $subject = 'WakeUp Call Request';
            } else
                if ($type == 'taxi') {
                    $subject = 'Taxi Request';
                    $message .= '<br> Number Of Guests : ' . $guest;
                } else if ($type == 'room') {
                    $subject = 'Room Service Request';
                } else if ($type == 'laundry') {
                    $subject = 'Laundry Service Request';
                }

            $this->send_email($from_email, $from_name, $to_email, $subject, $message);
        }
    }

    function servicealarmreq_post()
    {
        $this->load->model('WebService');
        $type = "";
        $user = 0;
        $date = "";
        $time = "";
        $alarm_type = "TV";
        $udp_number = 1;
        $ring_type = "Default";

        if (array_key_exists('type', $this->get())) {
            $type = trim($this->get('type'));
        }
        if (array_key_exists('user', $this->get())) {
            $user = trim($this->get('user'));
        }
        if (array_key_exists('time', $this->get())) {
            $time = trim($this->get('time'));
        }
        $time = str_replace("_", ":", $time);

        if (array_key_exists('date', $this->get())) {
            $date = trim($this->get('date'));
        }
        if (array_key_exists('udp_number', $this->get())) {
            $udp_number = trim($this->get('udp_number'));
        }
        if (array_key_exists('alarm_type', $this->get())) {
            $alarm_type = trim($this->get('alarm_type'));
        }
        if (array_key_exists('ring_type', $this->get())) {
            $ring_type = trim($this->get('ring_type'));
        }
        if ($user > 0 && $type != "") {
            $this->load->model('dx_auth/users');
            $this->load->model('Subscribers');

            if ($date > 0) {
                $date = date('Y-m-d', strtotime("+$date days"));
            } else {
                $date = date('Y-m-d');
            }

            $guest_info = $this->Subscribers->get_record_byid($user);

            $message = 'Date : ' . $date . '<br>';
            $message .= 'Time : ' . $time . '<br>';
            $message .= 'Guest Name : ' . $guest_info['title'] . '.' . $guest_info['name'] . '<br>';
            $message .= 'Room Number : ' . $guest_info['room_number'] . '<br>';

            $from_email = $this->config->item('guest_support');
            $from_name = 'Room Number - ' . $guest_info['room_number'];

            $to_email = $this->WebService->get_configmail($type);
            $subject = 'WakeUp Call Request';
            $this->send_email($from_email, $from_name, $to_email, $subject, $message);
            $this->WebService->guestalarm_insert_data($user, $date . " " . $time, $alarm_type, $udp_number, $ring_type);
        }
    }

    function servicealarmconfirm_post()
    {
        $this->load->model('WebService');
        $user = 0;

        if (array_key_exists('user', $this->get())) {
            $user = trim($this->get('user'));
        }

        if ($user > 0) {
            $this->load->model('dx_auth/users');
            $this->load->model('Subscribers');
            $this->WebService->guestalarm_closedupdate_data($user);
        }
    }

    function restarted_post()
    {
        $this->load->config('dx_auth');
        $this->load->model('WebService');
        $this->load->model('dx_auth/users', 'users');
        if ($this->users->getUserByStaffCode($usercode)) {
            $guest_info = $this->Rooms->update_roomstatusvalue($room_number, $usercode, $type, $roomstatus);
        }
    }

    /**
     * setdevicerebooted_post
     * @updated - Yeshan
     * @date - 2017-JUL-13
     */
    function setdevicerebooted_post()
    {
        $this->load->model('TVclass');
        $device = 0;
        if (array_key_exists('device', $this->get())) {
            $device = trim($this->get('device'));
            $this->load->model('Devices');
            $this->Devices->device_status_update($device, 1);
        }
        $x = $this->TVclass->current_date();
        $this->load->model('Subscribers');
        $this->Subscribers->update_guest_stb($device, 0, $this->TVclass->current_date());
    }

    function roomreq_post()
    {
        $this->load->config('dx_auth');
        $this->load->model('WebService');
        $this->load->model('dx_auth/users', 'users');
        $type = "";
        $user = 0;
        $usercode = 1;
        $roomstatus = "";

        if (array_key_exists('type', $this->get())) {
            $type = trim($this->get('type'));
        }
        if (array_key_exists('room_number', $this->get())) {
            $room_number = trim($this->get('room_number'));
        }
        if (array_key_exists('usercode', $this->get())) {
            $usercode = trim($this->get('usercode'));
        }
        if (array_key_exists('roomstatus', $this->get())) {
            $roomstatus = trim($this->get('roomstatus'));
        }

        if ($room_number > 0 && $type != "") {
            //code here
            $this->load->model('Rooms');
            //$this->load->model('Subscribers');

            if ($this->users->getUserByStaffCode($usercode)) {
                $guest_info = $this->Rooms->update_roomstatusvalue($room_number, $usercode, $type, $roomstatus);
            }
        }
    }

    function orderreq_post()
    {
        $this->load->model('WebService');
        $type = 0;
        $user = 0;
        $guest = 1;
        $date = "";
        $time = "";
        if (array_key_exists('type', $this->get())) {
            $type = trim($this->get('type'));
        }
        if (array_key_exists('user', $this->get())) {
            $user = trim($this->get('user'));
        }
        if (array_key_exists('guest', $this->get())) {
            $guest = trim($this->get('guest'));
        }
        if (array_key_exists('time', $this->get())) {
            $time = trim($this->get('time'));
        }
        if (array_key_exists('date', $this->get())) {
            $date = trim($this->get('date'));
        }
        if ($user > 0 && $type != "") {
            //code here
            $this->load->model('dx_auth/users');
            $this->load->model('Subscribers');
            $this->load->model('Restaurant');

            if ($date > 0) {
                $date = date('l jS F Y', strtotime("+$date days"));
            } else {
                $date = date('l jS F Y');
            }

            print $date;
            $guest_info = $this->Subscribers->get_record_byid($user);
            $rest_info = $this->Restaurant->getRestaurant($type);

            $to_email = $guest_info['butler_email'];

            $message = 'Date : ' . $date . '<br>';
            $message .= 'Time : ' . $time . '<br>';
            $message .= 'Guest Name : ' . $guest_info['title'] . '.' . $guest_info['name'] . '<br>';
            $message .= 'Room Number : ' . $guest_info['room_number'] . '<br>';
            $message .= 'Order Requested Restaurant Name : ' . $rest_info['name'] . '<br>';

            $from_email = $this->config->item('guest_support');
            $from_name = 'Room Number - ' . $guest_info['room_number'];
            $subject = "Restaurant Table Booking Request";


            $this->send_email($from_email, $from_name, $to_email, $subject, $message);
        }
    }

    function get_admin_info()
    {
        $this->load->model('dx_auth/users');
        $admin_info = $this->users->get_user_by_username('admin')->row_array();
        return $admin_info;
    }

    function send_email($from_email, $from_name, $to_email, $subject, $message)
    {
        $this->load->library('email');
        $this->email->from($from_email, $from_name);
        $this->email->to($to_email);

        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

    //flags
    function userflag_get()
    {
        $user_id = "";
        if (array_key_exists('user_id', $this->get())) {
            $user_id = trim($this->get('user_id'));
        }
        $this->load->model('WebService');

        $flag = $this->WebService->get_userflag_api($user_id);
        /*
          if ($flag[0]['date_added']) {
          $this->response($flag[0]['date_added'], 200); // 200 being the HTTP response code
          } else {
          $this->response(array('error' => 'Couldn\'t find any users!'), 404);
          } */
        print $flag[0]['date_added'];
    }

    /**
     * data_reload_get
     * @updated - Yeshan
     * @date - 2017-JUL-13
     */
    function data_reload_get()
    {
        $this->load->model('WebService');
        $this->load->model('push/Push_model');
        $id = $this->get('user');
        $device = $this->get('device');

        $flag = $this->WebService->get_flag_api();
        $result = $this->Push_model->get_guestSTBStatus($device);
        if ($result == true)
            $flag[0]['need_restart'] = "yes";
        else
            $flag[0]['need_restart'] = "no";

        $message = $this->WebService->getUserMessage($id);
        $flag[0]['message'] = "no";
        if ($message > 0)
            $flag[0]['message'] = "yes"; // 200 being the HTTP response code

        $flag[0]['exit'] = 0;
        $rows = $this->WebService->getRoomExit();
        if (count($rows) > 0)
            $flag[0]['exit'] = $rows[0]['status'];

        $flag[0]['alarm'] = "no";
        if ($id > 0) {
            $alarm = $this->WebService->getUserAlarm($id);
            if (count($alarm) > 0)
                $flag[0]['alarm'] = $alarm[0]['udp'];
        }

        $device_info = $this->WebService->get_device_api($device);

        if (isset($device_info[0]['device_status'])) {
            $flag[0]['device_status'] = $device_info[0]['device_status'] == 1 ? 'device_on' : 'device_off';
        }

        $data['data'] = json_encode($flag[0]);
        print $data['data'];
    }

    function alarmchecker_get()
    {
        $this->load->model('WebService');
        $id = $this->get('user');
        if ($id > 0) {
            $message = $this->WebService->getUserAlarm($id);
            //print  $message[0]['alarm_time'];
            if (count($message) > 0)
                $data['data'] = $message[0]['udp']; // 200 being the HTTP response code
            else
                $data['data'] = 0;

            print $data[data];
        }
    }

    function media_get()
    {
        $this->load->model('WebService');

        $language = "en";
        if (array_key_exists('language', $this->get())) {
            $language = trim($this->get('language'));
        }

        $news = $this->WebService->get_media_api($language);
        //print_r($news);
        if ($news) {
            $this->response($news, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function ticker_promo_get()
    {
        $this->load->model('WebService');
        $news = $this->WebService->get_ticker_promo();
        //print_r($news);
        if ($news) {
            $this->response($news, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any promo!'), 404);
        }
    }

    function radios_get()
    {

        $u_id = $this->get('uid');
        $g_id = $this->get('gid');

        $this->load->model('WebService');

        $channels = $this->WebService->get_radios_api($u_id, $g_id);

        if ($channels) {
            $this->response($channels, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function rgenres_get()
    {
        $this->load->model('WebService');

        $genres = $this->WebService->get_rgenres_api();
        if ($genres) {
            $this->response($genres, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function internets_get()
    {
        $this->load->model('WebService');

        $genres = $this->WebService->get_internets_api();
        if ($genres) {
            $this->response($genres, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function rfavourites_get()
    {
        $get_id = $this->get('user');
        $this->load->model('WebService');

        $channels = $this->WebService->get_rfavourites_api($get_id);

        if ($channels) {
            $this->response($channels, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function setrfavourite_post()
    {
        $this->load->model('WebService');
        $user = 0;
        $channel = 0;

        if (array_key_exists('user', $this->get())) {
            $user = trim($this->get('user'));
        }
        if (array_key_exists('channel', $this->get())) {
            $channel = trim($this->get('channel'));
        }
        if ($user > 0 && $channel > 0) {
            $this->WebService->rfavourite_insert_data($user, $channel);
        }
    }

    function removerfavourite_post()
    {
        $this->load->model('WebService');
        $user = 0;
        $channel = 0;

        if (array_key_exists('user', $this->get())) {
            $user = trim($this->get('user'));
        }
        if (array_key_exists('channel', $this->get())) {
            $channel = trim($this->get('channel'));
        }

        if ($user > 0 && $channel > 0) {
            $this->WebService->rfavourite_remove_data($user, $channel);
        }
    }

    function userlang_get()
    {
        $this->load->model('rooms');
        $user_id = $this->get('user_id');
        $language = $this->get('language');
        $this->load->model('WebService');

        if (isset($user_id)) {
            $data = $this->WebService->get_userlang_api($user_id, $language);

            if ($data) {
                $this->response($data, 200); // 200 being the HTTP response code
            } else {
                $this->response(array('error' => 'Couldn\'t find any users!'), 404);
            }
        } else {
            $this->response(array('error' => 'Invalid Device'), 404);
        }
    }

    function exitchecker_get()
    {
        $data['data'] = 0;
        $this->load->model('WebService');
        $rows = $this->WebService->getRoomExit();
        if (count($rows) > 0)
            $data['data'] = $rows[0]['status']; // 200 being the HTTP response code
        print $data['data'];
    }

    function exit_get()
    {
        $r = $this->get('room');
        $this->load->model('WebService');

        $data = $this->WebService->get_exitdata($r);

        if ($data) {
            $this->response($data, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    function dtcm_data_get()
    {
        $this->load->model('Subscribers');
        $name_title = $this->get('name_title') == 1 ? "Mr" : $this->get('name_title') == 2 ? "Mrs" : $this->get('name_title');
        $data = array(
            'title' => $name_title,
            'name' => $this->get('name'),
            'surname' => $this->get('surname'),
            'skin' => 'default',
            'accessibility' => '0',
            'status' => $this->get('status'),
            'address' => '0',
            'postal_code' => '0',
            'post' => '0',
            'country' => '0',
            'fixed_phone' => '0',
            'mobile_phone' => '0',
            'job_phone' => '0',
            'FAX' => '0',
            'UID' => '0',
            'auto_sub' => '0',
            'auto_audio' => '0',
            'auto_reminder_time' => '0',
            'parental_pin' => '0',
            'user_pin' => '0',
            'package_id' => '26',
            'date_added' => $this->TVclass->current_date()
        );

        $room_number = $this->get("room_number");
        $roomId = $this->Subscribers->get_roomId_by_room_number($room_number);

        $room_guest = array(
            'room_id' => $roomId,
            'guest_id' => '0',
            'greeting_id' => '1',
            'theme_id' => '11',
            'language_id' => '1'
        );
        $this->Subscribers->add_dtcm_guest($data, $room_guest);
        $this->response($data, 200);
        //$this->response(NULL,404);

    }

    //rebooting devices
    function reboot_stbs_get()
    {
        $this->load->model('Subscribers');
        //$this->Subscribers->reboot_all_devices();
    }

}
