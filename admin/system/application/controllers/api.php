<?php

require APPPATH . '/libraries/REST_Controller.php';

class Api extends REST_Controller
{

    public function channels_get()
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

    public function restaurants_get()
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

    public function spa_get()
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

    public function experience_get()
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
    public function datetime_get()
    {
        $language = "en";
        if (array_key_exists('language', $this->get())) {
            $language = trim($this->get('language'));
        }
        $datetime = DateTime::createFromFormat('Y-m-d H:i', date('Y-m-d H:i'));

        $today = $datetime->format('D');

        $days = array('Sun' => 'الأحد', 'Mon' => 'الإثنين', 'Tue' => 'الثلاثاء', 'Wed' => 'الأربعاء', 'Thu' => 'الخميس', 'Fri' => 'يوم الجمعة', 'Sat' => 'يوم السبت');
        if ($language == 'ar') {
            $today = $days[$today];
        }

        $array = array('date' => date("Y-m-d"), 'time' => date('H:i'), 'day' => $today);
        if ($array) {
            $this->response($array, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find now date and time!'), 404);
        }
    }

    public function restmenutypes_get()
    {
        $this->load->model('WebService');

        $restaurants = $this->WebService->get_restmenutype_api();
        if ($restaurants) {
            $this->response($restaurants, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function localinfos_get()
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

    public function newsnpromos_get()
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

    public function localinfotypes_get()
    {
        $this->load->model('WebService');
        $localinfotypes = $this->WebService->get_localinfotypes_api();
        if ($localinfotypes) {
            $this->response($localinfotypes, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function newsflag_get()
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

    public function weather_get()
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

            //          Arabic Weather Types
            $weather_types = array(
                "Partly Cloud" => "سحابة جزئيا",
                "Showers" => "الاستحمام",
                "Partly Cloudy" => "غائم جزئيا",
                "AM Showers" => "الصباح الاستحمامo",
                "PM Showers" => "مساء الاستحمام",
                "PM Thunderstorms" => "عواصف رعدية مسائية",
                "Scattered Thunderstorms" => "عواصف رعدية متفرقة",
                "Light Rain with Thunder" => "ضوء المطر مع الرعد",
                "Thunderstorms" => "عواصف رعدية",
                "Heavy Rain" => "مطر غزير",
                "Mostly Sunny" => "غالبا مشمس",
                "Light Rain" => "مطر خفيف",
                "Fog" => "ضباب",
                "Fair" => "معرض",
                "Sunny" => "مشمس",
                "AM Rain" => "الصباح المطر",
                "PM Rain" => "مساء المطر",
                "Mostly Cloudy" => "غالبا غائم",
                "Isolated Thunderstorms" => "هبوب عواصف رعدية متفرقة",
                "Thundershowers" => "عواصف رعدية",
                "Heavy Thunderstorms" => "عواصف رعدية ثقيلة",
                "Clear" => "واضح",
                "Rain" => "تمطر",
                "Cloudy" => "غائم");

            foreach ($forecast as $value) {
                $weatherType = $value['text'];
                if ($language == 'ar') {
                    $weatherType = $weather_types[$weatherType];
                }
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

    public function checkRemoteFile($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        if (curl_exec($ch) !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function messageread_post()
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

    public function userchannels_get()
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

    public function movies_get()
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

    public function programs_get()
    {
        $this->load->model('WebService');

        $programs = $this->WebService->get_programs_api();
        if ($programs) {
            $this->response($programs, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function genres_get()
    {
        $this->load->model('WebService');

        $genres = $this->WebService->get_genres_api();
        if ($genres) {
            $this->response($genres, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function parentals_get()
    {
        $this->load->model('WebService');

        $parentals = $this->WebService->get_parentals_api();
        if ($parentals) {
            $this->response($parentals, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function news_get()
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

    public function tickertape_get()
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

    public function xmltvlist_get()
    {
        $this->load->model('WebService');

        $news = $this->WebService->get_xmltvlist_api();
        if ($news) {
            $this->response($news, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function login_post()
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

    public function skins_get()
    {
        $this->load->model('WebService');

        $skins = $this->WebService->get_skins_api();

        if ($skins) {
            $this->response($skins, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function language_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_language_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function devices_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_devices_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function devices_type_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_devices_type_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function devices_groups_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_devices_groups_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function guest_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_guest_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function rooms_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_rooms_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function greeting_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_greeting_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function occation_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_occation_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function message_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_message_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function itvgenre_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_itvgenre_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function packages_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_packages_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function parental_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_parental_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function user_roles_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_user_roles_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function users_get()
    {
        $this->load->model('WebService');

        $language = $this->WebService->get_users_api();

        if ($language) {
            $this->response($language, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function favourites_get()
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

    public function setfavourite_post()
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

    public function changelang_post()
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

    public function removefavourite_post()
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

    public function vod_get()
    {
        $this->load->model('WebService');

        $channels = $this->WebService->get_vod_api();

        if ($channels) {
            $this->response($channels, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function user_get()
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
        if (DEVICE_LIMIT == $td) {
            $add = "eq";
        } else if (DEVICE_LIMIT < $td) {
            $add = "yes";
        }
        if (in_array($allowed_macrange, unserialize(STB_RANGE)) && ($add == "eq" || $add = "yes")) {
            $device_id = 0;
            $device_id = $this->Devices->addIfNotDeviceListed($mac_address, $serial_num, $type, $add);
            //$data = array();
            if ($device_id > 0) {
                $userLangId = $this->WebService->get_user_lang_bymac($mac_address);
                $data = $this->WebService->get_user_api($device_id, $userLangId);
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

    public function usermessages_get()
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

    public function settings_get()
    {

        $this->load->model('WebService');

        $data = $this->WebService->get_settings_api();
        if ($data) {
            $this->response($data, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function style_get()
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

    public function user_get_post()
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

    public function servicealarmreq_post()
    {
        $this->load->model('WebService');
        $type = "";
        $user = 0;
        $date = "";
        $time = "";
        $alarm_type = "TV";
        $udp_number = 1;
        $ring_type = "Default";
        $mac = "00:00:00:00:00";

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
        if (array_key_exists('mac', $this->get())) {
            $mac = trim($this->get('mac'));
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
            $this->WebService->guestalarm_insert_data($user, $date . " " . $time, $alarm_type, $udp_number, $ring_type, $mac);

            //$this->response($re, 200);
        }
    }

    public function servicealarmconfirm_post()
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

    public function servicealarmcurrent_get()
    {
        $this->load->model('WebService');
        $result = "";
        $mac = "00:00:00:00:00";
        if (array_key_exists('mac', $this->get())) {
            $mac = trim($this->get('mac'));
            $result = $this->WebService->get_current_alarm($mac);
        }
        $this->response($result, 200);
    }

    public function servicealarmremove_post()
    {
        $this->load->model('WebService');
        $mac = "00:00:00:00:00";
        if (array_key_exists('mac', $this->get())) {
            $mac = trim($this->get('mac'));
            $this->WebService->remove_current_alarm($mac);
        }
        $this->response($result, 200);
    }

    public function restarted_post()
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
    public function setdevicerebooted_post()
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

    public function roomreq_post()
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

    public function orderreq_post()
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

    public function get_admin_info()
    {
        $this->load->model('dx_auth/users');
        $admin_info = $this->users->get_user_by_username('admin')->row_array();
        return $admin_info;
    }

    public function send_email($from_email, $from_name, $to_email, $subject, $message)
    {
        $this->load->library('email');
        $this->email->from($from_email, $from_name);
        $this->email->to($to_email);

        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

    //flags
    public function userflag_get()
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
    public function data_reload_get()
    {
        $this->load->model('WebService');
        $this->load->model('push/Push_model');
        $id = $this->get('user');
        $device = $this->get('device');

        $flag = $this->WebService->get_flag_api();
        $result = $this->Push_model->get_guestSTBStatus($device);
        if ($result == true) {
            $flag[0]['need_restart'] = "yes";
        } else {
            $flag[0]['need_restart'] = "no";
        }


        $resultCheckedOut = $this->Push_model->get_guestSTBCheckedOutStatus($device);
        if ($resultCheckedOut == true) {
            $flag[0]['checked_out'] = "yes";
        } else {
            $flag[0]['checked_out'] = "no";
        }

        $message = $this->WebService->getUserMessage($id);
        $flag[0]['message'] = "no";
        if ($message > 0) {
            $flag[0]['message'] = "yes";
        }
        // 200 being the HTTP response code

        $flag[0]['exit'] = 0;
        $rows = $this->WebService->getRoomExit();
        if (count($rows) > 0) {
            $flag[0]['exit'] = $rows[0]['status'];
        }

        $flag[0]['alarm'] = "no";
        if ($id > 0) {
            $alarm = $this->WebService->getUserAlarm($id);
            if (count($alarm) > 0) {
                $flag[0]['alarm'] = $alarm[0]['udp'];
            }

        }

        $device_info = $this->WebService->get_device_api($device);

        if (isset($device_info[0]['device_status'])) {
            $flag[0]['device_status'] = $device_info[0]['device_status'] == 1 ? 'device_on' : 'device_off';
        }

        $data['data'] = json_encode($flag[0]);
        print $data['data'];
    }

    public function alarmchecker_get()
    {
        $this->load->model('WebService');
        $id = $this->get('user');
        if ($id > 0) {
            $message = $this->WebService->getUserAlarm($id);
            //print  $message[0]['alarm_time'];
            if (count($message) > 0) {
                $data['data'] = $message[0]['udp'];
            } // 200 being the HTTP response code
            else {
                $data['data'] = 0;
            }

            print $data[data];
        }
    }

    public function media_get()
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

    public function ticker_promo_get()
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

    public function radios_get()
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

    public function rgenres_get()
    {
        $this->load->model('WebService');

        $genres = $this->WebService->get_rgenres_api();
        if ($genres) {
            $this->response($genres, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function internets_get()
    {
        $this->load->model('WebService');

        $genres = $this->WebService->get_internets_api();
        if ($genres) {
            $this->response($genres, 200); // 200 being the HTTP response code
        } else {
            $this->response(array('error' => 'Couldn\'t find any users!'), 404);
        }
    }

    public function rfavourites_get()
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

    public function setrfavourite_post()
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

    public function removerfavourite_post()
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

    public function userlang_get()
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

    public function exitchecker_get()
    {
        $data['data'] = 0;
        $this->load->model('WebService');
        $rows = $this->WebService->getRoomExit();
        if (count($rows) > 0) {
            $data['data'] = $rows[0]['status'];
        }
        // 200 being the HTTP response code
        print $data['data'];
    }

    public function exit_get()
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


    //Meteor PMS Integration

    public function meteor_get()
    {

        switch ($this->get('RI')) {
            case GI :
                $this->checkin();
                break;
            case GO :
                $this->checkout();
                break;
            case GC:

                if ($this->get('RO')) {
                    //Room Change
                    $this->room_change();
                } else {
                    //Guest Update
                    $this->guest_update();
                }

                break;
            case XL:
                //Guest Message
                $this->guest_message();

                break;

            case XI:
                //Single Bill Item
                $this->guest_bill_item();
                break;

            case XB:
                //Bill Total
                $this->guest_bill_total();
                break;

            default :
                break;
        }
    }

    //Checkin Function
    public function checkin()
    {
        $this->load->model('Subscribers');
        $data = array(
            'title' => $this->get('GQ'),
            'name' => $this->get('GN'),
            'surname' => $this->get('GF'),
            'skin' => 'default',
            'accessibility' => '0',
            'status' => '1',
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
            'date_added' => $this->TVclass->current_date(),
            'guest_code' => $this->get('GX'),
            'bill_amount' => 0.0
        );

        $room_number = $this->get('RN');
        $roomId = $this->Subscribers->get_roomId_by_room_number($room_number);

        $theme_id = 18; //Coral Dubai

        $guest_lang = $this->get('GL');
        $guest_tv_pack = $this->get('TV');

        $room_guest = array(
            'room_id' => $roomId,
            'guest_id' => '0',
            'greeting_id' => '1',
            'theme_id' => $theme_id,
            'language_id' => '1',
        );

        $guest_code = $data['guest_code'];
        $guest_status = $this->Subscribers->guest_status($guest_code);

        if ($guest_status['status'] != TRUE) {
            $this->Subscribers->pms_checkin($data, $room_guest);
        }

        $response = array('payTV' => 'OK');
        $this->response($response, 200);

    }


    public function checkout()
    {

        $this->load->model('Subscribers');
        $room_number = $this->get('RN');
        $guest_code = $this->get('GX');

        $guest_status = $this->Subscribers->guest_status($guest_code);
        if ($guest_status['status'] == TRUE) {

            $guest_data = $this->Subscribers->guest_status($guest_code);
            $roomId = $this->Subscribers->get_roomId_by_room_number($room_number);
            $this->Subscribers->pms_checkout($guest_data['guest_id'], $roomId);
        }

        $response = array('payTV' => 'OK');
        $this->response($response, 200);
    }

    public function room_change()
    {


        //Checkout Process
        $this->load->model('Subscribers');
        $checkout_room = $this->get('RO');
        $checkin_room = $this->get('RN');
        $guest_code = $this->get('GX');

        $roomId_checkedOut = $this->Subscribers->get_roomId_by_room_number($checkout_room);
        $roomId_checkedIn = $this->Subscribers->get_roomId_by_room_number($checkin_room);
        $guest_data = $this->Subscribers->guest_status($guest_code);
        //var_dump($guest_code,$roomId_checkedIn,$roomId_checkedOut);

        $guest_status = $this->Subscribers->guest_status($guest_code);
        if ($guest_status['status'] != TRUE) {

            $this->Subscribers->pms_room_change($roomId_checkedOut, $roomId_checkedIn, $guest_data);

        }


        $response = array('payTV' => 'OK');
        $this->response($response, 200);

    }

    public function guest_message()
    {

        $this->load->model('Subscribers');
        $room_no = $this->get('RN');
        $guest_code = $this->get('GX');
        $message_text = $this->get('MT');
        $this->Subscribers->guest_message($room_no, $guest_code, $message_text);
        $response = array('payTV' => 'OK');
        $this->response($response, 200);
    }

    public function guest_update()
    {
        $this->load->model('Subscribers');
        $guest_code = $this->get('GX');
        $guest_data = $this->Subscribers->guest_status($guest_code);
        $guest_id = $guest_data['guest_id'];
        $room_no = $this->get('RN');
        $roomId = $this->Subscribers->get_roomId_by_room_number($room_no);
        $guest_id = $guest_id;
        $update_data = array(
            'title' => $this->get('GQ'),
            'name' => $this->get('GN'),
            'surname' => $this->get('GF')
        );

        $guest_status = $this->Subscribers->guest_status($guest_code);
        if ($guest_status['status'] != TRUE) {

            $this->Subscribers->pms_guest_update($roomId, $guest_id, $update_data);

        }
        $response = array('payTV' => 'OK');
        $this->response($response, 200);
    }

    public function guest_bill_item()
    {

        $this->load->model('Subscribers');
        $guest_code = $this->get('GX');
        $guest_data = $this->Subscribers->guest_status($guest_code);
        $guest_id = $guest_data['guest_id'];
        $room_no = $this->get('RN');
        $item_amount = $this->get('BI');
        $item_name = $this->get('BD');

        $data = array(
            'guest_id' => $guest_id,
            'guest_code' => $guest_code,
            'room_number' => $room_no,
            'descreption' => $item_name,
            'amount' => $item_amount
        );
        //$this->Subscribers->pms_bill_items($data);

        $response = array('payTV' => 'OK');
        $this->response($response, 200);


    }

    public function guest_bill_total()
    {

        $this->load->model('Subscribers');
        $guest_code = $this->get('GX');
        $guest_data = $this->Subscribers->guest_status($guest_code);
        $guest_id = $guest_data['guest_id'];
        $total_amount = $this->get('BA');


        $this->Subscribers->pms_bill_total($guest_id, $guest_code, $total_amount);

        $response = array('payTV' => 'OK');
        $this->response($response, 200);

    }

    public function guestdata_get()
    {

        $guest_id = $this->get('id');
        //Room Number Guest Code
        $this->load->model('Subscribers');
        $guest_data = $this->Subscribers->get_guest_code_room_number($guest_id);
        $this->response($guest_data, 200);

    }

    public function removeguestbillitems_get()
    {

        $this->load->model('Subscribers');
        $guest_code = $this->get('guest_code');
        $room_no = $this->get('room_no');


        $response = array('payTV' => 'OK', 'guest_code' => $guest_code, 'room_no' => $room_no);
        $this->response($response, 200);

    }

    public function bill_info_get()
    {

        $this->load->model('Subscribers');
        $guest_code = $this->get('guest_code');
        $room_no = $this->get('room_no');
        //$bill_items = $this->Subscribers->get_bill_items($room_no,$guest_code); //Not Available in Protel PMS
        $bill_items = null;
        $bill_total = $this->Subscribers->get_bill_total($guest_code);
        $guest_bill = array(
            'bill_items' => $bill_items,
            'bill_total' => $bill_total
        );
        $this->response($guest_bill, 200);

    }

    public function init_view_bill_get()
    {

        //Get Parameters
        $guest_code = $this->get('guest_code');
        $room_no = $this->get('room_no');
        $url = 'http://192.168.3.11:8081/Meteor/interface/istv/istv.jsp?RI=XR&RN=' . $room_no . '&GX=' . $guest_code . '';

        // Get cURL resource
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url,
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        $this->response($resp, 200);
    }

    public function complete_checkout_post()
    {
        $this->load->model('Subscribers');
        $device_id = $this->get('device_id');
        $this->Subscribers->complete_checkout($device_id);
        $this->response("OK", 200);
    }


}
