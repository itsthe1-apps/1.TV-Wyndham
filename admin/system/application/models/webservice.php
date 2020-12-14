<?php

class WebService extends Model
{

    function WebService()
    {
        parent::Model();
        $this->load->database();
        $this->_prefix = 'mw_';
        $this->_table = $this->_prefix . $this->config->item('DX_users_table');
        $this->_roles_table = $this->_prefix . $this->config->item('DX_roles_table');
        $this->group_module = $this->db_prefix . 'group_module';
        $this->users = $this->config->item($this->_prefix . 'users');
        $this->channel_permissions = $this->config->item($this->_prefix . 'channel_permissions');
        $this->settings = $this->config->item($this->_prefix . 'settings');
        $this->backgrounds = $this->_prefix . 'backgrounds';
        $this->themes = $this->config->item($this->_prefix . 'themes');
        $this->guest = $this->config->item($this->_prefix . 'guest');
        $this->devices = $this->config->item($this->_prefix . 'devices');
        $this->room_device = $this->config->item($this->_prefix . 'room_device');
        $this->room_guest = $this->config->item($this->_prefix . 'room_guest');
        $this->greeting = $this->config->item($this->_prefix . 'greeting');
        $this->detail_greeting = $this->config->item($this->_prefix . 'detail_greeting');
        $this->flag = $this->config->item($this->_prefix . 'flag');
        $this->channel = $this->config->item($this->_prefix . 'channel');
        $this->itvtv_bygenre = $this->config->item($this->_prefix . 'itvtv_bygenre');
        $this->channel_role_permissions = $this->config->item($this->_prefix . 'channel_role_permissions');
        $this->restaurant = $this->config->item($this->_prefix . 'restaurant');
        $this->spa = $this->_prefix . 'spa';
        $this->experience = $this->_prefix . 'experience';
        $this->movie = $this->config->item($this->_prefix . 'movie');
        $this->rest_menutype = $this->config->item($this->_prefix . 'rest_menutype');
        $this->rest_menus = $this->config->item($this->_prefix . 'rest_menus');
        $this->program = $this->config->item($this->_prefix . 'program');
        $this->genre = $this->config->item($this->_prefix . 'genre');
        $this->parentalrating = $this->config->item($this->_prefix . 'parentalrating');
        $this->news = $this->config->item($this->_prefix . 'news');
        $this->epgfiles = $this->config->item($this->_prefix . 'epgfiles');
        $this->room = $this->config->item($this->_prefix . 'room');
        $this->useralarm = $this->config->item($this->_prefix . 'useralarm');
        $this->usermessage = $this->config->item($this->_prefix . 'usermessage');
        $this->localinfo = $this->config->item($this->_prefix . 'localinfo');
        $this->localinfo_menus = $this->config->item($this->_prefix . 'localinfo_menus');
        $this->newsnpromo = $this->config->item($this->_prefix . 'newsnpromo');
        $this->newsnpromo_menus = $this->config->item($this->_prefix . 'newsnpromo_menus');
        $this->localinfo_menus = $this->config->item($this->_prefix . 'localinfo_menus');
        $this->radio = $this->config->item($this->_prefix . 'radio');
        $this->skin = $this->config->item($this->_prefix . 'skin');
        $this->language = $this->config->item($this->_prefix . 'language');
        $this->device_types = $this->config->item($this->_prefix . 'device_types');
        $this->device_groups = $this->config->item($this->_prefix . 'device_groups');
        $this->occation = $this->config->item($this->_prefix . 'occation');
        $this->promotions = $this->config->item($this->_prefix . 'promotions');
        $this->itvtvgenre = $this->config->item($this->_prefix . 'itvtvgenre');
        $this->channel_group = $this->config->item($this->_prefix . 'channel_group');
        $this->roles = $this->config->item($this->_prefix . 'roles');
        $this->favourites = $this->config->item($this->_prefix . 'favourites');
        $this->vod_genre = $this->config->item($this->_prefix . 'vod_genre');
        $this->theme_params = $this->config->item($this->_prefix . 'theme_params');
        $this->message = $this->config->item($this->_prefix . 'message');
        $this->room_group = $this->config->item($this->_prefix . 'room_group');
        $this->group_room = $this->config->item($this->_prefix . 'group_room');
        $this->ticker_promo = $this->_prefix . 'ticker_promo';

        $this->rfavourites = $this->config->item($this->_prefix . 'rfavourites');
        $this->rchannel = $this->config->item('rchannel');
        $this->rgenre = $this->config->item('rgenre');
        $this->internets = $this->config->item('internets');
        $this->ritvtv_bygenre = $this->config->item('ritvtv_bygenre');

        $this->promotions_language = $this->config->item('promotions_language');
        $this->weather = $this->config->item('weather');
        $this->guest_name = $this->config->item('guest_name');
        $this->tickertape = $this->config->item('tickertape');
        $this->exit = $this->config->item('exit');

        $this->CI = &get_instance();
    }

    function get_user_by_username($mac_address, $serial_number)
    {
        $this->db->where('mac_address', $mac_address);
        // $this->db->where('serial_number', $serial_number);
        $query = $this->db->get($this->users);
        return $query->num_rows();
    }

    function get_flag_api()
    {
        $data = array();
        // $this->db->select('*');
        $this->db->from($this->flag);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    /* XML JSON API */

    // Get permission query
    function get_permission_value($role_id)
    {
        $this->db->where_in('role_id', $role_id);
        $query = $this->db->get($this->channel_permissions);
        $data = array();
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data[] = $row['data'];
            }
        }

        return $data;
    }

    function get_newsflag_api()
    {
        $data = array();
        //$this->db->select('flag');
        $this->db->limit(1);
        $Q = $this->db->get($this->flag);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        //print_r($this->db->last_query());
        $Q->free_result();
        return $data;
    }

    function get_channels_api($u_id = 0, $g_id = 0)
    {
        $data = array();
        //$Q2 = $this->db->query("");
        $this->db->select($this->channel . '.*');
        $this->db->join($this->channel_permissions, $this->channel_permissions . '.data=' . $this->channel . '.id', 'left');
        $this->db->join($this->channel_role_permissions, $this->channel_role_permissions . '.data=' . $this->channel_permissions . '.role_id', 'left');
        $this->db->join($this->room_group, $this->room_group . '.rg_id=' . $this->channel_role_permissions . '.role_id', 'left');
        $this->db->join($this->group_room, $this->group_room . '.gr_group_id=' . $this->room_group . '.rg_id', 'left');
        $this->db->join($this->room_guest, $this->room_guest . '.room_id=' . $this->group_room . '.gr_room_id', 'left');
        if ($g_id > 0) {
            $this->db->join($this->itvtv_bygenre, $this->itvtv_bygenre . '.TVChannelId=' . $this->channel . '.id', 'left');
            $this->db->where($this->itvtv_bygenre . '.TVGenreID', $g_id);
        }

        $this->db->where($this->room_guest . '.guest_id', $u_id);
        //$this->db->group_by($this->channel_permissions.'.data');
        $this->db->group_by($this->channel . '.id');
        $this->db->orderby($this->channel . '.number', 'asc');

        $Q = $this->db->get($this->channel);
        //print_r($Q);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $row['logo'] = $this->config->item('tv_icon_url') . $row['logo'];
                $data[] = $row;
            }
        }
        //print_r($this->db->last_query());
        $Q->free_result();
        return $data;
    }

    function get_restaurants_api($l)
    {
        $data = array();

        $this->db->order_by($this->restaurant . ".id", "asc");
        $this->db->where($this->restaurant . ".language", $l);
        $Q = $this->db->get($this->restaurant);

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $row['image'] = $this->config->item('rest_icon_url') . $row['image'];
                $Q1 = $this->db->query("SELECT * FROM " . $this->rest_menutype . " order by id");
                if ($Q1->num_rows() > 0) {
                    foreach ($Q1->result_array() as $row1) {
                        $Q2 = $this->db->query("SELECT rm.name, rm.description, rm.price, mt.name as type,rm.image FROM " . $this->rest_menus . " rm," . $this->rest_menutype . " as mt where rm.type=mt.id  and rm.restaurant=" . $row['id'] . " and rm.type=" . $row1['id'] . " order by rm.menu_order");
                        if ($Q2->num_rows() > 0) {
                            foreach ($Q2->result_array() as $row2) {
                                $row2['image'] = $this->config->item('rest_icon_url') . $row2['image'];
                                $m = $row1['code'];
                                $row[$m][] = $row2;
                            }
                        }
                    }
                }
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_spa_api()
    {
        $data = array();
        $this->db->from($this->spa);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_experience_api()
    {
        $data = array();
        $this->db->from($this->experience);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    /* XML JSON API */

    function get_movies_api($gid = false)
    {
        $data = array();
        //$this->db->select('');
        $gid != "0" ? $this->db->where('genreId', $gid) : "";
        $this->db->from($this->movie);
        $this->db->order_by("id", "asc");

        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $row["logo"] = $this->config->item('vod_icon_url') . $row["logo"];
                $row["thumbnail"] = $this->config->item('vod_thumbnail_url') . $row["thumbnail"];
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_restmenutype_api()
    {
        $data = array();
        $this->db->from($this->rest_menutype);
        $this->db->order_by("id", "asc");

        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_programs_api()
    {
        $data = array();
        $this->db->select('');
        $this->db->from($this->program);
        $this->db->order_by("id", "asc");

        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_genres_api()
    {
        $data = array();
        $this->db->select('');
        $this->db->from($this->genre);
        $this->db->order_by("id", "asc");

        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_parentals_api()
    {
        $data = array();
        $this->db->select('');
        $this->db->from($this->parentalrating);
        $this->db->order_by("id", "asc");

        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_news_api($l)
    {
        $data = array();
        $this->db->select('');
        $this->db->where('language', $l);
        $this->db->from($this->news);
        $this->db->order_by("date_updated", "desc");

        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        // print_r($this->db->last_query());
        $Q->free_result();
        return $data;
    }

    function get_tickertape_api($l)
    {
        $rss = "";
        $this->db->select('');
        $this->db->where('language', $l);
        $this->db->from($this->tickertape);
        // $this->db->order_by("date_updated", "desc");

        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                //$data[] = $row; //tickertape_url
                $rss = $row['tickertape_url'];
            }
        }
        // print_r($this->db->last_query());
        $Q->free_result();
        $this->load->library('rssparser');
        $this->rssparser->set_feed_url($rss);  // get feed
        $this->rssparser->set_cache_life(30);                       // Set cache life time in minutes
        $rss2 = $this->rssparser->getFeed(6);
        //print_r($rss2);
        return $rss2;
    }

    function get_xmltvlist_api()
    {
        $data = array();
        $this->db->select('channel, path as eitXML');
        $this->db->from($this->epgfiles);
        $this->db->order_by("channel", "asc");

        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function getAllowedChannelGroups($mac_address, $serial_number)
    {
        $result = NULL;
        //$Q = $this->db->query("select data from channel_role_permissions where channel_role_permissions.role_id = (SELECT role_id FROM users where mac_address='$mac_address' and serial_number='$serial_number')");
        //$Q = $this->db->query("select data from ".$this->channel_role_permissions." where ".$this->channel_role_permissions.".role_id = (SELECT role_id FROM ".$this->users." where mac_address='$mac_address')");

        $Q = $this->db->query("SELECT data FROM " . $this->channel_role_permissions . " WHERE " . $this->channel_role_permissions . ".role_id = (SELECT " . $this->room . ".room_group FROM " . $this->devices . " LEFT JOIN " . $this->room_device . " ON " . $this->room_device . ".device_id=" . $this->devices . ".id LEFT JOIN " . $this->room . " ON " . $this->room . ".id=" . $this->room_device . ".room_id WHERE " . $this->devices . ".mac_address='$mac_address')");

        //print_r($this->db->last_query());

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $result = explode(",", $row['data']);
            }
        }
        $Q->free_result();
        return $result;
    }

    function getUserMessage($user_id)
    {
        $this->db->where('user', $user_id);
        $this->db->where('status', 0);
        $Q = $this->db->get($this->usermessage);
        return $Q->num_rows();
    }

    function getUserAlarm($user_id)
    {
        $data = array();
        $this->db->where('guest', $user_id);
        $this->db->where('status', 1); //status 0 request from gust, 1 reception confirm, 2 after guest read confirm,3 stop by guest
        $sql = "alarm_time=DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i')";
        $this->db->where($sql);
        $Q = $this->db->get($this->useralarm);
        //print_r($this->db->last_query());
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                // print_r($row);
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function checkUser($mac_address, $serial_number)
    {
        $data = "no";
        //$Q = $this->db->query("SELECT * FROM users where mac_address='$mac_address' and serial_number='$serial_number' limit 1");
        $this->db->join($this->room_device, $this->room_device . '.device_id=' . $this->devices . '.id');
        $this->db->join($this->room_guest, $this->room_guest . '.room_id=' . $this->room_device . '.room_id', 'left');

        $this->db->where($this->devices . '.mac_address', $mac_address);
        $Q = $this->db->get($this->devices);

        if ($Q->num_rows() > 0) {
            $data = "yes";
        }

        $Q->free_result();
        return $data;
    }

    function getUserMessages($user_id)
    {
        $data = array();
        $this->db->select($this->usermessage . '.id as id, ' . $this->message . '.message as message, ' . $this->message . '.date_added as date, ' . $this->usermessage . '.status as status');
        $this->db->join($this->message, $this->message . '.id=' . $this->usermessage . '.message', 'left');
        $this->db->where($this->usermessage . '.user', $user_id);
        $this->db->order_by($this->usermessage . '.date_added', 'desc');
        $Q = $this->db->get($this->usermessage);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function getChannelsforGroups($groups)
    {
        $result = NULL;
        // take $groups as package id
        if (!empty($groups)) {
            $groups = implode(",", $groups);
            $Q = $this->db->query("select * from " . $this->channel_permissions . " where role_id in ($groups)"); // here role_id means package id
            //print_r($this->db->last_query());
            if ($Q->num_rows() > 0) {
                foreach ($Q->result_array() as $row) {
                    $result = $result . "," . $row['data'];
                }
            }
            $Q->free_result();
        }
        return $result;
    }

    function getAllowedChannels($groups)
    {
        $data = array();
        if (!empty($groups)) {
            $groups = explode(",", $groups);
            $groups = preg_replace(array("/^,/", "/,$/"), '', $groups);
            $this->db->select('*');
            $this->db->where_in('id', $groups);
            $this->db->order_by("number", "asc");
            //$this->db->distinct();
            $Q = $this->db->get($this->channel);
            //print_r($this->db->last_query());
            if ($Q->num_rows() > 0) {
                foreach ($Q->result_array() as $row) {
                    $data[] = $row;
                }
            }
            $Q->free_result();
            return $data;
        }
        return $result;
    }

    function get_skins_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('skin');
        $this->db->order_by("sk_name", "asc");

        $Q = $this->db->get($this->skin);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_language_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('language');
        $this->db->order_by("short_label", "asc");

        $Q = $this->db->get($this->language);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_devices_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('devices');
        $this->db->order_by("UID", "asc");

        $Q = $this->db->get($this->devices);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_devices_type_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('device_types');
        $this->db->order_by("device_type", "asc");

        $Q = $this->db->get($this->device_types);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_devices_groups_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('device_groups');
        $this->db->order_by("group_name", "asc");

        $Q = $this->db->get($this->device_groups);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_guest_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('guest');
        $this->db->order_by("name", "asc");

        $Q = $this->db->get($this->guest);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_rooms_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('room');
        $this->db->order_by("room_number", "asc");

        $Q = $this->db->get($this->room);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_greeting_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('greeting');
        $this->db->order_by("title", "asc");

        $Q = $this->db->get($this->greeting);

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_occation_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('occation');
        $this->db->order_by("occation_name", "asc");

        $Q = $this->db->get($this->occation);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_message_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('usermessage');
        $this->db->order_by("id", "desc");

        $Q = $this->db->get($this->usermessage);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_itvgenre_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('itvtvgenre');
        $this->db->order_by("Code", "asc");

        $Q = $this->db->get($this->itvtvgenre);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_packages_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('channel_group');
        $this->db->order_by("name", "asc");

        $Q = $this->db->get($this->channel_group);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_parental_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('parentalrating');
        $this->db->order_by("name", "asc");

        $Q = $this->db->get($this->parentalrating);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_user_roles_api()
    {
        $data = array();
        //$this->db->select('');
        //$this->db->from('roles');
        $this->db->order_by("name", "asc");

        $Q = $this->db->get($this->roles);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_users_api()
    {
        $data = array();
        //$this->db->select('');
        // $this->db->from('users');
        $this->db->order_by("username", "asc");

        $Q = $this->db->get($this->users);

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_favourites_api($fav_id = 0)
    {
        $data = array();
        $Q = $this->db->query("SELECT * FROM " . $this->channel . " as c where id in (SELECT fav_channel_id FROM " . $this->favourites . " as f where f.fav_user=$fav_id group by fav_channel_id) order by c.number");
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $row['logo'] = $this->config->item('tv_icon_url') . $row['logo'];
                $data[] = $row;
            }
        }
        // print_r($this->db->last_query());
        $Q->free_result();

        return $data;
    }

    function favourite_insert_data($u, $c)
    {
        $data = array(
            'fav_user' => $u,
            'fav_channel_id' => $c
        );
        $this->db->where('fav_user', $u);
        $this->db->where('fav_channel_id', $c);
        $Q = $this->db->get($this->favourites, 1, 0);
        if ($Q->num_rows() == 0) {
            $this->db->insert($this->favourites, $data);
        }
        $Q->free_result();
    }

    function favourite_remove_data($u, $c)
    {
        $this->CI->load->model('mtv');
        $d = $this->CI->mtv->getTvByNumber($c);
        if ($d['id']) {
            $this->db->where('fav_user', $u);
            $this->db->where('fav_channel_id', $d['id']);
            $this->db->delete($this->favourites);
        }
    }

    function get_vod_api()
    {
        $data = array();
        $this->db->select('');
        //$this->db->from('vod_genre');
        $this->db->order_by("id", "asc");

        $Q = $this->db->get($this->vod_genre);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    /**
     * get_user_api
     * @param int $id
     * @return array
     */
    function get_user_api($id = 0)
    {
        $data = array();
        //$mac_address == true ? $this->db->where('mac_address', $mac_address) : "";
        $this->db->join($this->room_device, $this->room_device . '.device_id=' . $this->devices . '.id', 'left');
        $this->db->join($this->room, $this->room . '.id=' . $this->room_device . '.room_id', 'left');
        $this->db->join($this->device_types, $this->device_types . '.id=' . $this->devices . '.device_type', 'left');
        $this->db->join($this->room_guest, $this->room_guest . '.room_id=' . $this->room_device . '.room_id', 'left');
        $this->db->join($this->guest, $this->guest . '.id=' . $this->room_guest . '.guest_id', 'left');
        $this->db->join($this->themes, $this->themes . '.th_id=' . $this->room_guest . '.theme_id', 'left');
        $this->db->join($this->greeting, $this->greeting . '.id=' . $this->room_guest . '.greeting_id', 'left');
        $this->db->join($this->detail_greeting, $this->greeting . '.id=' . $this->detail_greeting . '.greeting_id', 'left');
        $this->db->join($this->settings, $this->settings . '.se_id=' . $this->settings . '.se_id', 'left');
        $this->db->join($this->group_room, $this->group_room . '.gr_room_id=' . $this->room . '.id', 'left');
        $this->db->join($this->group_module, $this->group_module . '.group_id=' . $this->group_room . '.gr_group_id', 'left');

        $this->db->limit(1);
        if ($id > 0)
            $this->db->where($this->devices . '.id=' . $id, NULL, FALSE);
        $this->db->select('*,' . $this->guest . '.title as saluation');
        $query = $this->db->get($this->devices);

//        echo '<pre>';
//        print_r($this->db->last_query());
//        echo '</pre>';
//        die();
        $language = "en";
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $data['id'] = $row['guest_id'];
                $data['title'] = "Welcome " . $row['saluation'] . "." . $row['name'] . " " . $row['surname'];
                $data['theme'] = $row['th_folder'];
                $data['welcome_msg'] = $row['greeting_desc'];
                $data['logo'] = $this->config->item('logo_icon_url') . $row['se_logo'];
                $data['device_id'] = $row['device_id'];

                //Added by Yesh - 2017-JUL-12
                $language_id = $row['language_id'];
                if ($language_id == 2) {
                    $language = "ar";
                }
                $data['language'] = $language;
                //Added by Yesh - 2017-JUL-12

                $data['device_type'] = $row['device_type'];
                $data['mcast_prefix'] = $row['mcast_prefix'];
                $data['transperancy_level'] = $row['transp_level'];
                $data['volume_step'] = $row['volume_step'];
                $data['volume_max'] = $row['volume_max'];
                $data['volume_min'] = $row['volume_min'];
                $data['opaque_level'] = $row['opaque_level'];
                $data['clip_x'] = $row['window_x'];
                $data['clip_y'] = $row['window_y'];
                $data['clip_w'] = $row['window_width'];
                $data['clip_h'] = $row['window_height'];
                $data['room_number'] = $row['room_number'];

                $data['home'] = $row['home'];
                $data['tv'] = $row['tv'];
                $data['vod'] = $row['vod'];
                $data['radio'] = $row['radio'];
                $data['internet'] = $row['internet'];
                $data['restaurant'] = $row['restaurant'];

                $data['information'] = $row['information'];
                $data['messages'] = $row['messages'];
                $data['services'] = $row['services'];
                $data['weather'] = $row['weather'];
                $data['clock'] = $row['clock'];

                $data['socket_enabled'] = $row['se_socket_enabled'];
                $data['tapemarquee_enabled'] = $row['se_tapemarquee_enabled'];
                $data['fakedata_enabled'] = $row['se_fakedata_enabled'];
                $data['internet_enabled'] = $row['se_internet_enabled'];
                $data['ajaxpull_enabled'] = $row['se_ajaxpull_enabled'];
                $data['exit_enabled'] = $row['se_exit_enabled'];
                $data['alarm_enabled'] = $row['se_alarm_enabled'];
                $data['tickertape_enabled'] = $row['tickertape_enabled'];
                $data['chfavourite_enabled'] = $row['chfavourite_enabled'];
                $data['se_guest_title'] = $row['se_guest_title'];

                $data['tv_brand_folder'] = $row['tv_brand_folder'];
                $data['view_type'] = $row['se_view_type'];
                //$data['check_reboot'] = $row['check_reboot'];
            }
            $data['background_array'] = $this->db->where('language', $language)->get($this->backgrounds)->result_array();
        }
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die();
        $query->free_result();
        return $data;
    }

    function updateMessage($id)
    {
        $data = array('status' => 1);
        $this->db->where('id', $id);
        $this->db->update('usermessage', $data);
    }

    /**
     * @added - by Yeshan
     * @date - 2017-JUL-13
     * @param $id
     * @return array
     */
    function get_device_api($id)
    {
        $data = array();
        $this->db->where('id', $id);
        $this->db->from($this->devices);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_localinfos_api($l)
    {
        $data = array();
        //$this->db->select('');
        $this->db->order_by("id", "asc");
        $this->db->where("language", $l);
        $Q = $this->db->get($this->localinfo);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $row['image'] = $this->config->item('localinfo_icon_url') . $row['image'];
                $Q1 = $this->db->query("SELECT * FROM " . $this->localinfo_menus . " where localinfo=" . $row['id'] . " order by id");
                if ($Q1->num_rows() > 0) {

                    foreach ($Q1->result_array() as $row1) {
                        //$Q2 = $this->db->query("SELECT rm.name, rm.description, rm.price,mt.name as type,rm.image FROM localinfo_menus rm,localinfo_menutype as mt  where rm.type=mt.id  and rm.restaurant=" . $row['id'] . "  and rm.type=".$row1['id']." order by rm.menu_order");
                        //if ($Q2->num_rows() > 0) {
                        ///    foreach ($Q2->result_array() as $row2) {
                        //        $m=$row1['code'];
                        $row1['image'] = $this->config->item('localinfo_icon_url') . $row1['image'];
                        $row['data'][] = $row1;
                        //    }
                        //}
                    }
                }


                $data[] = $row;
                $Q1->free_result();
                //$Q2->free_result();
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_newsnpromos_api($l)
    {
        $data = array();
        //$this->db->select('');
        $this->db->order_by("id", "asc");
        $this->db->where("language", $l);
        $Q = $this->db->get($this->newsnpromo);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $row['image'] = $this->config->item('newsnpromo_icon_url') . $row['image'];
                $Q1 = $this->db->query("SELECT * FROM " . $this->newsnpromo_menus . " where newsnpromo=" . $row['id'] . " order by id");
                if ($Q1->num_rows() > 0) {

                    foreach ($Q1->result_array() as $row1) {
                        //$Q2 = $this->db->query("SELECT rm.name, rm.description, rm.price,mt.name as type,rm.image FROM newsnpromo_menus rm,newsnpromo_menutype as mt  where rm.type=mt.id  and rm.restaurant=" . $row['id'] . "  and rm.type=".$row1['id']." order by rm.menu_order");
                        //if ($Q2->num_rows() > 0) {
                        ///    foreach ($Q2->result_array() as $row2) {
                        //        $m=$row1['code'];
                        $row1['image'] = $this->config->item('newsnpromo_icon_url') . $row1['image'];
                        $row['data'][] = $row1;
                        //    }
                        //}
                    }
                }


                $data[] = $row;
                $Q1->free_result();
                //$Q2->free_result();
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_localinfotypes_api()
    {
        $data = array();
        $this->db->order_by("id", "asc");
        $Q = $this->db->get($this->localinfo_menus);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_settings_api()
    {
        $data = array();
        $Q = $this->db->query("SELECT s.se_logo as logo,t.th_name as theme, s.se_weather_rss as weather_rss FROM " . $this->settings . " as s left join " . $this->themes . " as t on s.se_current_theme=t.th_id limit 0,1");
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_weather_api($l)
    {
        $data = array();
        $Q = $this->db->query("SELECT s.weather_url as weather_rss FROM " . $this->weather . " as s where language='$l' limit 0,1");
        //print_r($this->db->last_query());
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_style_api($id = 1)
    {
        $data = array();
        $this->db->where('theme', $id);
        //$this->db->from('theme_params');
        $this->db->limit(1);
        $Q = $this->db->get($this->theme_params);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }

        $Q->free_result();
        return $data;
    }

    /*
      function get_radio_api() {
      $data = array();
      $this->db->order_by("ra_id", "asc");

      $Q = $this->db->get($this->radio);
      if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
      $row['ra_logo'] = $this->config->item('radio_icon_url') . $row['ra_logo'];
      $data[] = $row;
      }
      }
      $Q->free_result();
      return $data;
      }
     */

//flag services
    function get_userflag_api($user_id)
    {
        $data = array();
        $this->db->select('date_added');
        $this->db->where('guest_id', $user_id);
        $this->db->from($this->room_guest);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        // print_r($this->db->last_query());
        $Q->free_result();
        return $data;
    }

    function get_userprofileflag_api($user_id)
    {
        $data = array();
        $this->db->select('date_updated');
        $this->db->where('id', $user_id);
        $this->db->from($this->guest);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_movieflag_api()
    {
        $data = array();
        $this->db->select('vod');
        $this->db->from($this->flag);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_restflag_api()
    {
        $data = array();
        $this->db->select('restaurant');
        $this->db->from($this->flag);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    /*
      function get_radioflag_api() {
      $data = array();
      $this->db->select('radio');
      $this->db->from($this->flag);
      $this->db->limit(1);
      $Q = $this->db->get();
      if ($Q->num_rows() > 0) {
      foreach ($Q->result_array() as $row) {
      $data[] = $row;
      }
      }
      $Q->free_result();
      return $data;
      }
     */

    function get_infoflag_api()
    {
        $data = array();
        $this->db->select('localinfo');
        $this->db->from($this->flag);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_channelflag_api()
    {
        $data = array();
        $this->db->select('tv');
        $this->db->from($this->flag);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_mediaflag_api()
    {
        $data = array();
        $this->db->select('promotions');
        $this->db->from($this->flag);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_media_api($l)
    {
        $data = array();
        $this->db->join($this->promotions, $this->promotions . '.pr_id=' . $this->promotions_language . '.promotion_id', 'left');
        $this->db->where($this->promotions_language . '.language', $l);
        $this->db->select($this->promotions . '.*,');
        $this->db->order_by($this->promotions . '.pr_id', "asc");
        $Q = $this->db->get($this->promotions_language);
        //print_r($this->db->last_query());
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                if ($row['pr_type'] == 'video') {
                    $row['pr_url'] = $row['pr_url'];
                } else {
                    $row['pr_url'] = $this->config->item('promotion_icon_url') . $row['pr_url'];
                }

                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_ticker_promo()
    {
        $Q = $this->db->get($this->ticker_promo);
//        print_r($this->db->last_query());
//        die();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $options = $this->config->item('ticker_promo_menu');
                $id = $row['restaurant_id'];
                foreach ($options as $key => $value) {
                    if ($row['restaurant_id'] == $key) {
                        $row['restaurant_id'] = $value;
                    }
                }
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_radioflag_api()
    {
        $data = array();
        $this->db->select('radio');
        $this->db->from($this->flag);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_internetflag_api()
    {
        $data = array();
        $this->db->select('internet');
        $this->db->from($this->flag);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_radios_api($u_id = 0, $g_id = 0)
    {
        $data = array();
        $this->db->select($this->rchannel . '.*');
        if ($g_id > 0) {
            $this->db->join($this->ritvtv_bygenre, $this->ritvtv_bygenre . '.TVChannelID=' . $this->rchannel . '.id', 'right');
            $this->db->where($this->ritvtv_bygenre . '.TVGenreID', $g_id);
        }
        $this->db->group_by($this->rchannel . '.id');
        $Q = $this->db->get($this->rchannel);
        //print_r($Q);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $row['logo'] = $this->config->item('radio_icon_url') . $row['logo'];
                $data[] = $row;
            }
        }
        // print_r($this->db->last_query());
        $Q->free_result();
        return $data;
    }

    function get_rgenres_api()
    {
        $data = array();
        $this->db->select('');
        $this->db->from($this->rgenre);
        $this->db->order_by("id", "asc");

        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_internets_api()
    {
        $data = array();
        $this->db->select('');
        $this->db->from($this->internets);
        $this->db->order_by("id", "asc");

        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $row['logo'] = $this->config->item('net_icon_url') . $row['logo'];
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_rfavourites_api($fav_id = 0)
    {
        $data = array();
        $Q = $this->db->query("SELECT * FROM " . $this->rchannel . " as c where id in (SELECT fav_channel_id FROM " . $this->rfavourites . " as f where f.fav_user=$fav_id group by fav_channel_id) order by c.number");
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $row['logo'] = $this->config->item('radio_icon_url') . $row['logo'];
                $data[] = $row;
            }
        }
        //print_r($this->db->last_query());
        $Q->free_result();

        return $data;
    }

    function rfavourite_insert_data($u, $c)
    {
        $data = array(
            'fav_user' => $u,
            'fav_channel_id' => $c
        );
        $this->db->where('fav_user', $u);
        $this->db->where('fav_channel_id', $c);
        $Q = $this->db->get($this->rfavourites, 1, 0);
        if ($Q->num_rows() == 0) {
            $this->db->insert($this->rfavourites, $data);
        }
        $Q->free_result();
    }

    function rfavourite_remove_data($u, $c)
    {
        $this->CI->load->model('rmtv');
        $d = $this->CI->mtv->getTvByNumber($c);
        if ($d['id']) {
            $this->db->where('fav_user', $u);
            $this->db->where('fav_channel_id', $d['id']);
            $this->db->delete($this->rfavourites);
        }
    }

    function get_userlang_api($u, $l)
    {
        $data = array();
        /*
          $this->db->join($this->greeting, $this->greeting . '.id=' . $this->detail_greeting . '.greeting_id', 'left');
          $this->db->join($this->room_guest, $this->room_guest . '.greeting_id=' . $this->greeting . '.id', 'left');
          $this->db->limit(1);
          $this->db->where($this->detail_greeting . '.greeting_language', $l);
          $this->db->where($this->room_guest . '.guest_id', $u);
          $this->db->select('*,' . $this->detail_greeting . '.greeting_desc as welcome_msg');
          $query = $this->db->get($this->detail_greeting);
         */
        $this->db->select("$this->guest.title as te,$this->guest.name as ne,$this->guest.surname as se");
        $this->db->select("$this->guest_name.title as tol,$this->guest_name.name as nol,$this->guest_name.surname as sol");
        $this->db->select("$this->detail_greeting.greeting_desc as welcome_msg,$this->detail_greeting.greeting_title");
        $this->db->join($this->room_guest, $this->room_guest . '.guest_id=' . $this->guest . '.id', 'left');
        $this->db->join($this->greeting, $this->greeting . '.id=' . $this->room_guest . '.greeting_id', 'left');
        $this->db->join($this->detail_greeting, $this->detail_greeting . '.greeting_id=' . $this->greeting . '.id', 'left');
        $this->db->join($this->guest_name, $this->guest_name . '.guest_id=' . $this->guest . '.id', 'left');
        $this->db->limit(1);
        $this->db->where($this->detail_greeting . '.greeting_language', $l);
        //$this->db->where($this->guest_name . '.language', $l);
        $this->db->where($this->guest . '.id', $u);
        $query = $this->db->get($this->guest);
        //print_r($this->db->last_query());

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                if ($l == "en") {
                    $data['title'] = $row['greeting_title'] . " " . $row['te'] . "." . $row['ne'] . " " . $row['se'];
                    $data['welcome_msg'] = $row['welcome_msg'];
                } else {
                    $data['title'] = $row['greeting_title'] . " " . $row['tol'] . "." . $row['nol'] . " " . $row['sol'];
                    $data['welcome_msg'] = $row['welcome_msg'];
                }
            }
        }
        $query->free_result();
        return $data;
    }

    function guestalarm_insert_data($u, $d, $at, $udp, $rt)
    {
        $data = array(
            'guest' => $u,
            'alarm_time' => $d,
            'status' => 0,
            'type' => $at,
            'udp' => $udp,
            'tone' => $rt
        );
        // $this->db->where('fav_user', $u);
        // $this->db->where('fav_channel_id', $c);
        //  $Q = $this->db->get($this->favourites, 1, 0);
        //  if ($Q->num_rows() == 0) {
        //print $this->useralarm;
        $this->db->insert($this->useralarm, $data);

        //$Q->free_result();
    }

    function guestalarm_closedupdate_data($u)
    {
        $data = array(
            'status' => 2
        );
        //$this->db->where('guest', $u);
        $w = $this->useralarm . '.guest=' . $u . ' and ' . $this->useralarm . '.alarm_time<=NOW() and ' . $this->useralarm . '.status=1';
        $this->db->where($w, NULL, FALSE);
        $this->db->update($this->useralarm, $data);
        //$this->db->insert($this->useralarm, $data);
        $this->db->update($this->useralarm, $data);

        //$Q->free_result();
    }

    function get_configmail($t)
    {
        $to_mail = "";
        if ($t == 'wakeup')
            $this->db->select("$this->settings.se_wakeup_call as mail");
        else if ($t == 'taxi')
            $this->db->select("$this->settings.se_order_taxi as mail");
        else if ($t == 'room')
            $this->db->select("$this->settings.se_room_service as mail");
        else if ($t == 'laundry')
            $this->db->select("$this->settings.se_laundery_request as mail");
        $this->db->from($this->settings);
        $this->db->limit(1);
        $Q = $this->db->get();
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $to_mail = $row['mail'];
            }
        }
        $Q->free_result();
        return $to_mail;
    }

    function getRoomExit()
    {
        $data = array();
        $w = $this->exit . '.status>0';
        $this->db->where($w, NULL, FALSE);
        $this->db->select($this->exit . '.*,');
        $this->db->limit(1);
        $Q = $this->db->get($this->exit);
        //print_r($this->db->last_query());
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

    function get_exitdata($r)
    {
        $data = array();

        $this->db->where($this->room . ".room_number", $r);
        $Q = $this->db->get($this->room);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $row['emergency_img'] = $this->config->item('exit_map_url') . $row['emergency_img'];
                $data['image'] = $row['emergency_img'];
            }
        }
        $Q->free_result();

        //  $this->db->where($this->exit . ".status", 1);
        $this->db->limit(1);
        $Q = $this->db->get($this->exit);

        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data['message'] = $row['message'];
                $data['rtsp'] = $row['rtsp'];
                $data['status'] = $row['status'];
                $data['image_path'] = $this->config->item('exit_icon_url') . $row['image_path'];
            }
        }
        $Q->free_result();
        return $data;
    }

    /**
     * change_user_lang
     * @param $user_id
     * @param $language
     */
    function change_user_lang($user_id, $language)
    {
        $data = array(
            'language_id' => $language
        );
        $this->db->where('guest_id', $user_id);
        $this->db->update($this->room_guest, $data);
//        echo '<pre>';
//        print_r($this->db->last_query());
//        echo '</pre>';
//        die();
        return true;
    }

}
