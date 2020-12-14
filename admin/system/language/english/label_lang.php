<?php

$lang['header_title'] = "1.TV Admin Portal";
// TV Menus
$lang['TV'] = array('ALL', 'ACTION', 'COMEDY', 'DOCUMENTARY', 'FANTASY', 'GENERAL', 'HISTORY', 'HORROR', 'MYSTERY', 'SCI-FI', 'THRILLER');
$lang['TV_URL'] = array('welcome/Tv/all/0', 'welcome/Tv/action/8', 'welcome/Tv/comedy/10', 'welcome/Tv/documentary/16', 'welcome/Tv/fantasy/17', 'welcome/Tv/general/7', 'welcome/Tv/history/18', 'welcome/Tv/horror/9', 'welcome/Tv/mystery/14', 'welcome/Tv/scifi/13', 'welcome/Tv/thriller/15');
// TV Child Menus
/**
  $lang['TV_CHILD']		= array(
  'TV MENU 01'	=> array('TV CHILD 01-01','TV CHILD 01-02'),
  'TV MENU 02' 	=> array('TV CHILD 02-01'),
  );

  $lang['TV_CHILD_URL']	= array(
  'TV MENU 01'	=> array('',''),
  'TV MENU 02'	=> array(''),
  );
 * */
//==============//
// Vod Menus
$lang['VOD'] = array('ALL', 'ACTION', 'COMEDY', 'DOCUMENTARY', 'FANTASY', 'GENERAL', 'HISTORY', 'HORROR', 'MYSTERY', 'SCI-FI', 'THRILLER');
$lang['VOD_URL'] = array('welcome/product/all/0', 'welcome/product/action/1', 'welcome/product/comedy/2', 'welcome/product/documentary/3', 'welcome/product/fantasy/4', 'welcome/product/general/5', 'welcome/product/history/6', 'welcome/product/horror/7', 'welcome/product/mystery/8', 'welcome/product/scifi/9', 'welcome/product/thriller/10');
//==============//
// News Menus
$lang['NEWS'] = array('NEWS MENU');
$lang['NEWS_URL'] = array('');
// Restaurant Menus
$lang['RESTAURANTS'] = array('RESTAURANTS'); //$lang['RESTAURANTS'] = array('RESTAURANTS', 'RESTAURANT MENU', 'RESTAURANT MENU TYPE');
$lang['RESTAURANTS_URL'] = array('restaurants'); //$lang['RESTAURANTS_URL'] = array('restaurants', 'restaurants/restaurantmenu', 'restaurants/restaurantmenutype');
// Restaurant Menus
$lang['LOCALINFO'] = array('LOCAL INFO'); //$lang['LOCALINFO'] = array('LOCAL INFO', 'LOCAL INFO MENU');
$lang['LOCALINFO_URL'] = array('localinfo'); //$lang['LOCALINFO_URL'] = array('localinfo', 'localinfo/menu/localinfomenu');

$lang['NEWSNPROMO'] = array('NEWSNPROMO'); //$lang['LOCALINFO'] = array('LOCAL INFO', 'LOCAL INFO MENU');
$lang['NEWSNPROMO_URL'] = array('newsnpromo'); //$lang['LOCALINFO_URL'] = array('localinfo', 'localinfo/menu/localinfomenu');

$lang['PROMOTIONS'] = array('PROMOTIONS'); //$lang['LOCALINFO'] = array('LOCAL INFO', 'LOCAL INFO MENU');
$lang['PROMOTIONS_URL'] = array('promotions'); //$lang['LOCALINFO_URL'] = array('localinfo', 'localinfo/menu/localinfomenu');

$lang['TICKERPROMOTIONS'] = array('TICKER PROMOTIONS'); //$lang['LOCALINFO'] = array('LOCAL INFO', 'LOCAL INFO MENU');
$lang['TICKERPROMOTIONS_URL'] = array('ticker_promo'); //$lang['LOCALINFO_URL'] = array('localinfo', 'localinfo/menu/localinfomenu');


$lang['GUEST'] = array('GUEST', 'GREETING', 'GUEST ALARM');
$lang['GUEST_URL'] = array('guest', 'guest/greeting', 'guest/guestalarm');
$lang['ROOMS'] = array('OCCUPANCY', 'VACANT STATUS', 'MAINTENANCE REQUIRED', 'EXTRA BED', 'BABY COT', 'CLEANING REQUIRED', 'TURN DOWN', 'UNDER MAINTENANCE');
$lang['ROOMS_URL'] = array(
    'room/filter/occupancy',
    'room/filter/vacantstatus',
    'room/filter/maintenancerequired',
    'room/filter/extrabed',
    'room/filter/babycot',
    'room/filter/cleaningrequired',
    'room/filter/turndown',
    'room/filter/undermaintenance'
);
$lang['MESSAGES'] = array('MESSAGES');
$lang['MESSAGES_URL'] = array('messages');
// Admin Menus
$lang['ADMIN'] = array('ENTITIES', 'GENRE', 'PACKAGES', 'SETTINGS', 'EMERGENCY MESSAGE'); //Edit by Yesh
$lang['ADMIN_URL'] = array('', '', '', '', 'backend/exitmsg');
$lang['MYAUTH'] = array('USER ROLES', 'USERS');
$lang['MYAUTH_URL'] = array('myauth/roles', 'myauth/users');
// Admin Child Menus
$lang['ADMIN_CHILD'] = array(
    //JK 'SYSTEM' => array('USER ROLES','USERS','SKINS','LANGUAGE'),
    //'SYSTEM' => array('USER ROLES','USERS'),
    'PACKAGES' => array('PACKAGE', 'PACKAGE CHANNELS', 'ROOM & PACKAGES'),
    //'GENRE' => array('TV GENRE', 'ITV GENRE'),
    //JK 'GENRE' => array('TV GENRE','VOD GENRE'),
    'GENRE' => array('TV GENRE', 'RADIO GENRE', 'VOD GENRE'),
    //JK 'SETTINGS' => array('PARENTAL RATING','API','THEMES','LOGO'),
    'SETTINGS' => array('THEMES', 'BACKGROUNDS', 'WEATHER', 'TICKER TAPE', 'CONFIG MIDDLEWARE', 'TV BRANDS'),
    //JK 'ENTITIES' => array('DEVICES','DEVICE TYPES','GUEST','ROOMS','ROOM TYPES','ROOM GROUP','GREETING','OCCATION','MESSAGE')
    'ENTITIES' => array('DEVICES', 'DEVICE TYPES', 'ROOMS', 'ROOM TYPES', 'ROOM GROUP')
);
//welcome/pRating/parentalrating
//backend/channelgroup/packages
//backend/channel_permissions/packagechannels
//backend/roles_channelgroups/rolespackages
$lang['ADMIN_CHILD_URL'] = array(
    //JK'SYSTEM' => array('backend/roles','backend/users','backend/skins','backend/language'),
    //'SYSTEM' => array('backend/roles','backend/users'),
    'PACKAGES' => array('backend/channelgroup', 'backend/channel_permissions', 'backend/roles_channelgroups'),
    //'GENRE' => array('welcome/genre','backend/genre_itv'),
    'GENRE' => array('welcome/tvgenre', 'welcome/radiogenre', 'welcome/vodgenre'),
    //JK'SETTINGS' => array('welcome/pRating','backend/listapilinks','backend/themes','backend/settings'),
    'SETTINGS' => array('backend/themes', 'backend/backgrounds', 'backend/weather', 'backend/tickertape', 'backend/config_middleware', 'backend/television_brands'), //Edit by Yesh
    //JK'ENTITIES' => array('backend/devices','backend/devicetypes','backend/guest','backend/rooms','backend/roomtypes','backend/roomgroups','backend/greeting','backend/occation','backend/message')
    'ENTITIES' => array('backend/devices/0', 'backend/devicetypes', 'backend/rooms', 'backend/roomtypes', 'backend/roomgroups')
        //'ENTITIES' => array('backend/guest','backend/devices','backend/rooms','backend/greeting','backend/occation','backend/devicetypes','backend/devicegroups
);
$lang['users'] = 'USERS';
$lang['register'] = 'REGISTER';
$lang['roles'] = 'MANAGE ROLES';
