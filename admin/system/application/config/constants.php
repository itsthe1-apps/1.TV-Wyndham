<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/** These are Image Height and Widht Sizes */
define('max_width', 60);
define('max_height', 60);


/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');


//Define STB limitations and allowed roomt
define('ALLOWED_ROOMS', 100);
define('DEVICE_LIMIT', 275);
define("STB_RANGE", serialize(array("00181c", "000000", "0016e8", "0026aa", "a00abf", "000202", "001a79", "3d13e4", "cc6ea4", "c808e9")));
define("MAC_LEN", 6);  //we need to check maximum 11 charactors from left of macaddress
define("BLOCKED_MODULES", serialize(array("MyAuth2")));
define("HTML_PUSH_SLEEP", 5);
define("HTML_PUSH_EXIT_SLEEP", 5);
define("HTML_PUSH_SLEEP_TTAPE", 1);
define("HTML_PUSH_SLEEP_WEATHER", 20);
define("HTML_PUSH_SLEEP_NEWS", 20);
define("HTML_PUSH_SLEEP_USERPROFILE", 1);
define("HTML_PUSH_SLEEP_USERRELOAD", 60);

//Development
define('RECORDS_PERPAGE', 100);
define('TV_PATH', './icons/TV/');
define('MOVIE_PATH', './icons/VOD/');
define('RESTAURANT_PATH', './icons/RESTAURANT/');
define('EXIT_PATH', './icons/EXIT/');
define('HOTEL_NAME', 'Elite Byblos');

//License
define("APP_HASLIFE", (int)true);//enable / disable DEMO script.
define("BLK_MSG", (int)true);//enable / disable msg box
define("BLK_ADMIN", (int)false);//enable / disable access to the admin if license expired.
define("BLK_CLIENT", (int)true);//enable / disable access to the client if license expired.
define("EXPIRE_DATE", "2020-04-10");//product expire date.
define("CHECK_EXPIRE", "-1 months");//-1 days,-2 weeks

/* End of file constants.php */
/* Location: ./system/application/config/constants.php */