var ip = "localhost/1.TV-NationsHospital";
var HOTEL_NAME = "ITSthe1 Hotel";
var APPNAME = "admin";
var SHOW_GUEST_TITLE = 1;
var REQUEST_TOKEN_ATTEMP = 0;
var DEBUG_MODE = "CONSOLE";//NONE,CONSOLE
var PROGRESS_MODE = "CONSOLE";//NONE,CONSOLE
var FAKE_DATA = 0;
var FAKE_TICKER = 0;
var SOCKET_SUPPORT = 0;
var HOME = 0;
var TV = 0;
var VOD = 0;
var RADIO = 0;
var INTERNET = 0;
var RESTAURANT = 0;
var INFORMATION = 0;
var SERVICES = 0;
var MESSAGES = 0;
var LAN_CHNGE = 1;
var SPA = 0;
var EXPERIENCE = 0;
var NEWSNPROMO = 1;
var CLOCK_ENABLED = 1;
var CLOCK_COUNTER = 1;
var VIEW_TYPE = "ThumbView";//ThumbView,ListView
var BACKGROUND_ARRAY = [];
var BG_IMG = '';
var DEFAULT_LANGUAGE = "en";
var DEFAULT_DIRECTION = "ltr";
var BROWSER_RESOLUTION = ""; //AUTO,720P,1080P,1080I
var SETTINGS_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/settings/format/json";
var PROMOTION_URL = "http://" + top.ip + "/" + top.APPNAME + "/xml/"; //Please Edit Here
var DEVICE_TYPE = "AUTO";//exterity,infomir1080,aminocom1080,infomir720
var DEVICE_ID = 0;
var MCAST_PREFIX = "";
var USER_PASSPWORD = "1234";
var MENU_LOADED = 0;
var AUTHENTICATION_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/user/";
var USERFLAG_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/userflag/";
var LANGSETTING_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/userlang/";
var USER_ID = 0;
var ROOM_NUMBER = 0;
var USER_REGION = 10;
var TRANSPARENCY_LEVEL = 60;
var CHROMAKEY = 1056816;
var OPAQUE_LEVEL = 100;
var VOLUME_STEP = 10;
var SPAINFO_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/spa/format/json";
var SPAINFO_IMG_URL = "http://" + top.ip + "/" + top.APPNAME + "/icons/SPA/";
var SPAINFO_LEFT_NAV_ROWS = 7;
var EXPINFO_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/experience/format/json";
var EXPINFO_IMG_URL = "http://" + top.ip + "/" + top.APPNAME + "/icons/EXP/";
var EXPINFO_LEFT_NAV_ROWS = 7;
var NEWSNPROMO_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/newsnpromos/language/";
var NEWSNPROMO_IMG_URL = "http://" + top.ip + "/" + top.APPNAME + "/icons/NEWSNPROMO/";
var NEWSNPROMO_LEFT_NAV_ROWS = 7;
var SERVICELIST = 1;
var SERVICELIST_URL = "http://" + top.ip + "/" + "admin/xml/services.json";
var SERVICELIST_IMG_URL = "http://" + top.ip + "/" + top.APPNAME + "/icons/SERVICES_LIST/";
var SERVICELIST_LEFT_NAV_ROWS = 7;
var VOLUME_MAX = 80;
var VOLUME_MIN = 0;
var FSV_INFOBAR_TIMEOUT = 5000;
var FAV_INFOBAR_TIMEOUT = 5000;
var FSV_TRICK_PLAY_TIMEOUT = 5000;
var IMAGES_PREFIX = "http://" + top.ip + "/" + top.APPNAME + "/icons/";
var SCREEN_MODE = 0;
var VOD_SCREEN_MODE = 0;
var CLIP_X = 300;
var CLIP_Y = 300;
var CLIP_W = 200;
var CLIP_H = 200;
var EPG_LOAD_TIMEOUT = 5000;
var MOVIES_CATURL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/vod/format/json";
var MOVIES_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/movies/id/";
var MOV_CLMNS = 3;
var MOV_ROWS = 3;
var MOV_CAT_CLMNS = 6;
var MOV_CAT_ROWS = 3;
var DEFAULT_CHANNEL_CATEGORY = 2;
var CHANNEL_COLUMNS = 4;
var CHANNEL_ROWS = 3;
var CATEGORY_COLUMNS = 6;
var CATEGORY_ROWS = 3;
var DATAFLAG_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/data_reload";
var DATA_LOAD_TIMEOUT = 30000;
var WEATHER_COUNTER = 1500;
var TTAPE_COUNTER = 30;
var CHANNELS_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/channels/uid/";
var CHANNELCAT_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/genres/format/json";
var CHANNELS_SETFAVURL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/setfavourite/";
var CHANNELS_RMFAVURL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/removefavourite/";
var CHFAVOURITE_ENABLED = 1;
var CHANNELS_GETFAVURL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/favourites/user/";
var NEWS_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/news/language/";
var NEWS_REFRESH_TIMEOUT = 600000;
var NEWS_SCROLL_DELAY = 10000;
var TTAPE_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/tickertape/language/";
var TICKERTAPE_ENABLED = 1;
var TTAPE_MARQUEE = 0;
var TTAPE_REFRESH_TIMEOUT = 1800000;
var TTAPE_SCROLL_DELAY = 130;
var NEWSTAPE_SCROLL_DELAY = 5000;
var NEWSTAPE_REFRESH_TIMEOUT = 5000;
var RESTURANT_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/restaurants/language/";
var RESTURANT_MTYPES = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/restmenutypes/format/json";
var ORDER_REQURL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/orderreq/";
var REST_DETAIL_ROWS = 5;
var LOCALINFO_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/localinfos/language/";
var LOCALINFO_LEFT_NAV_ROWS = 7;
var DATETIME_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/datetime/format/json";
var LOCAL_DATE = true;
var MEDIA_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/media/language/";
var TICKER_MEDIA_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/ticker_promo/language/";
var MEDIA_LOAD_TIMEOUT = 1800000;
var MESSAGE_READURL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/messageread/";
var MESSAGES_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/usermessages/";
var MSGS_ROWS = 5;
var WEATHER_ENABLED = 1;
var WEATHER_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/weather/language/";
var WEATHER_LOAD_TIMEOUT = 21600000;
var WEATHER_REFRESH_TIMEOUT = 60000;
var WEATHER_SCROLL_DELAY = 30000;
var WEATHER_IMG_URL = "http://" + top.ip + "/" + top.APPNAME + "/icons/weather/";
var THEME_COLOR = "pink";
var THEME = "default";
var LOGO = "http://" + top.ip + "/" + top.APPNAME + "/icons/LOGO/Logo_";
var WELCOME_MSG = "Hello Welcome";
var GUEST_NAME = "";
var STYLE_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/style/id/";
var DEFAULT_RADIO_CATEGORY = 2;
var RADIO_COLUMNS = 4;
var RADIO_ROWS = 3;
var RADIO_CAT_CLMNS = 6;
var RADIO_CAT_ROWS = 3;
var RADIOS_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/radios/uid/";
var RADIOCAT_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/rgenres/format/json";
var RADIOS_SETFAVURL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/setrfavourite/";
var RADIOS_RMFAVURL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/removerfavourite/";
var RADIOS_GETFAVURL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/rfavourites/user/";
var INTERNET_CAT_CLMNS = 6;
var INTERNET_CAT_ROWS = 4;
var INTERNETCAT_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/internets/format/json";
var SERVICE_REQURL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/servicereq/";
var ALARM_ENABLED = 0;
var SERVICEALARM_CHECKER = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/alarmchecker";
var SERVICEALARM_REQURL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/servicealarmreq/";
var SERVICEALARMCLOSED_REQURL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/servicealarmconfirm/";
var SERVICE_LEFT_NAV_ROWS = 4;
var ROOMKEEPER_REQURL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/roomreq/";
var KEEPER_LEFT_NAV_ROWS = 7;
var EXIT_ENABLED = 1;
var EMERGENCY_EXIT = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/exit/";
var EMERGENCY_EXIT_CHECKER = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/exitchecker/";
var RESTART_DONE = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/setdevicerebooted/";
var DUNE_ASPECT_RATIO = 0; //0=AUTO,1=16:9,2=4:3
var DUNE_VIDEO_MODE = 10; //7=VIDEO_MODE_1080I60, 11=VIDEO_MODE_1080P60,2=VIDEO_MODE_PAL,0=VIDEO_MODE_NTSC
var FORCE_STB_RESOLUTION = 0;
var AMINO_ASPECT_RATIO = "ignore";
var AMINO_VIDEO_MODE = "HD720";
var AMINO_FULLSCREEN_SETTING = "YDEFAULT_GREETING";
var AMINO_PWD = "snake";
var EXTERITY_RESOLUTION = "1080p";

var CURRENT_MENU_ID = 0;
var PRV_MENU_ID = 0;
var CURRENT_MENU = '';
var CURRENT_MAIN_MENU_ID = '';

//var PROM_JSON = null;
var GLOBAL_PROMOTION_INTERVAL = null;
var GLOBAL_SLIDER_INTERVAL = null;
var KEY_TV_PRESSED = 0;
var CURRENT_VOLUME = 40;
var DEFAULT_CHANNEL_NUMBER = 1;
var DEFAULT_ROOM;
var HighLight_W = 380;
var HighLight_H = 60;
var CHANGE_LANG_URL = "http://" + top.ip + "/" + top.APPNAME + "/index.php/api/changelang/";
var IS_DEPLOY = false;//true,false