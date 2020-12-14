<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

include('database.php');
$db_prefix = $db['default']['dbprefix'];
$config[$db_prefix . 'localinfo'] = $db_prefix . "localinfo";
$config[$db_prefix . 'flag'] = $db_prefix . "flag";
$config[$db_prefix . 'localinfo_menus'] = $db_prefix . "localinfo_menus";

$config[$db_prefix . 'newsnpromo'] = $db_prefix . "newsnpromo";
$config[$db_prefix . 'newsnpromo_menus'] = $db_prefix . "newsnpromo_menus";

//$config[$db_prefix . 'spa'] = $db_prefix . "spa";
//$config[$db_prefix . 'spa_menus'] = $db_prefix . "spa_menus";
$config[$db_prefix . 'radio'] = $db_prefix . "radio";
$config[$db_prefix . 'promotions'] = $db_prefix . "promotions";
$config[$db_prefix . 'channel'] = $db_prefix . "channel";
$config[$db_prefix . 'itvtv_bygenre'] = $db_prefix . "itvtv_bygenre";
$config[$db_prefix . 'parentalrating'] = $db_prefix . "parentalrating";
$config[$db_prefix . 'restaurant'] = $db_prefix . "restaurant";
$config[$db_prefix . 'restaurant_time'] = $db_prefix . "restaurant_time";
$config[$db_prefix . 'restaurant_time_tracker'] = $db_prefix . "restaurant_time_tracker";
$config[$db_prefix . 'rest_menus'] = $db_prefix . "rest_menus";
$config[$db_prefix . 'rest_menutype'] = $db_prefix . "rest_menutype";
$config[$db_prefix . 'favourites'] = $db_prefix . "favourites";
$config[$db_prefix . 'movie'] = $db_prefix . "movie";
$config[$db_prefix . 'news'] = $db_prefix . "news";
$config[$db_prefix . 'devices'] = $db_prefix . "devices";
$config[$db_prefix . 'room_device'] = $db_prefix . "room_device";
$config[$db_prefix . 'device_types'] = $db_prefix . "device_types";
$config[$db_prefix . 'skin'] = $db_prefix . "skin";
$config[$db_prefix . 'language'] = $db_prefix . "language";
$config[$db_prefix . 'guest'] = $db_prefix . "guest";
$config[$db_prefix . 'room_guest'] = $db_prefix . "room_guest";
$config[$db_prefix . 'room'] = $db_prefix . "room";
$config[$db_prefix . 'room_type'] = $db_prefix . "room_type";
$config[$db_prefix . 'occation'] = $db_prefix . "occation";
$config[$db_prefix . 'greeting'] = $db_prefix . "greeting";
$config[$db_prefix . 'detail_greeting'] = $db_prefix . "detail_greeting";
$config[$db_prefix . 'message'] = $db_prefix . "message";
$config[$db_prefix . 'usermessage'] = $db_prefix . "usermessage";
$config[$db_prefix . 'useralarm'] = $db_prefix . "guest_alarm";
$config[$db_prefix . 'users'] = $db_prefix . "users";
$config[$db_prefix . 'themes'] = $db_prefix . "themes";
$config[$db_prefix . 'resolution'] = $db_prefix . "resolution";
$config[$db_prefix . 'settings'] = $db_prefix . "settings";
$config[$db_prefix . 'channel_group'] = $db_prefix . "channel_group";
$config[$db_prefix . 'itvmovie_bygenre'] = $db_prefix . "itvmovie_bygenre";
$config[$db_prefix . 'itvtvgenre'] = $db_prefix . "itvtvgenre";
$config[$db_prefix . 'genre'] = $db_prefix . "genre";
$config[$db_prefix . 'history_room_guest'] = $db_prefix . "history_room_guest";
$config[$db_prefix . 'room_guest'] = $db_prefix . "room_guest";
$config[$db_prefix . 'room_group'] = $db_prefix . "room_group";
$config[$db_prefix . 'room_type'] = $db_prefix . "room_type";
$config[$db_prefix . 'archive_quotation_items'] = $db_prefix . "archive_quotation_items";
$config[$db_prefix . 'program'] = $db_prefix . "program";
$config[$db_prefix . 'epgfiles'] = $db_prefix . "epgfiles";
$config[$db_prefix . 'channel_role_permissions'] = $db_prefix . "channel_role_permissions";
$config[$db_prefix . 'channel_permissions'] = $db_prefix . "channel_permissions";
$config[$db_prefix . 'roles'] = $db_prefix . "roles";
$config[$db_prefix . 'vod_genre'] = $db_prefix . "vod_genre";
$config[$db_prefix . 'theme_params'] = $db_prefix . "theme_params";
$config[$db_prefix . 'group_room'] = $db_prefix . "group_room";
$config[$db_prefix . 'group_module'] = $db_prefix . "group_module";
$config[$db_prefix . 'room_status'] = $db_prefix . "room_status";
$config['rchannel'] = $db_prefix . "r_channel";
$config[$db_prefix . 'rfavourites'] = $db_prefix . "r_favourites";
$config['rgenre'] = $db_prefix . "r_genre";
$config['internets'] = $db_prefix . "internets";
$config['guest_stb'] = $db_prefix . "guest_stb";
$config['promotions_language'] = $db_prefix . "promotions_language";
$config['weather'] = $db_prefix . "weather";
$config['guest_name'] = $db_prefix . "guest_name";
$config['tickertape'] = $db_prefix . "tickertape";
$config['ritvtv_bygenre'] = $db_prefix . "r_itvtv_bygenre";
$config['exit'] = $db_prefix . "exit";
?>