var UserManager = {
    userAccount: null,
    init: function () {
        if (top.FAKE_DATA == 1) {
            this.data = eval(top.fakeUserList);
        } else {
            this.loadFlag();
        }
    }, loadFlag: function (f) {
        var d = top.Player.getMacAddress();
        var e = "itsthe1";
        u = top.AUTHENTICATION_URL + "mac_address/" + d + "/serial_number/" + e + "/type/" + top.DEVICE_TYPE + top.globalGetScreenHeightByResolution() + "/format/json";
        top.kwConsole.print(u);
        top.kwUtils.kwXMLHttpRequest("GET", u, true, this, this.loadData);
    }, loadData: function (b) {
        try {
            b = (typeof b === "object") ? b : top.jsonParser(b);
            if (b.id !== undefined) {
                //Added By Lakshan
                if (b.id == null) {
                    //Asigning Default values for the
                    b.id = top.DEFAULT_GUEST_ID;
                    b.theme = top.DEFAULT_THEME;
                    b.welcome_msg = top.DEFAULT_GREETING;
                }
                top.kwStatusConsole.print("Authentication Succeeded.", 0);
            } else {
                top.kwStatusConsole.print("Authentication Failed.", 1);

                return;
            }
            if (b != null && b.id == null) {
                top.kwStatusConsole.print("Room is vacant.", 0);
                top.kwConsole.print("USER_LOAD_ERROR");
                
                return;
            }
            if (this.userAccount == null) {
                this.userAccount = b;
                this.setUserId(true);
            } else {
                this.userAccount = b;
                this.setUserId(false);
            }
        } catch (c) {
            top.kwStatusConsole.print("Authentication Failed.", 2);
            top.kwConsole.print("USER_LOAD_ERROR");
        }
    }, setUserId: function (b) {
        if (this.userAccount) {
            top.USER_ID = this.userAccount.id;
            top.DEVICE_ID = this.userAccount.device_id;
            //Added by Yesh - 2017-JUL-12
            top.DEFAULT_LANGUAGE = this.userAccount.language;
            //Added by Yesh - 2017-JUL-12
            if (top.DEVICE_ID > 0) {
                this.setRestart();
            }
            //Added by Yesh
            top.BROWSER_RESOLUTION = this.userAccount.device_type;
            //Added by Yesh
            top.HOME = parseInt(this.userAccount.home);
            top.TV = parseInt(this.userAccount.tv);
            top.VOD = parseInt(this.userAccount.vod);
            top.RADIO = parseInt(this.userAccount.radio);
            top.INTERNET = parseInt(this.userAccount.internet);
            top.RESTAURANT = parseInt(this.userAccount.restaurant);
            top.INFORMATION = parseInt(this.userAccount.information);
            //top.NEWSNPROMO = parseInt(this.userAccount.newspromo);
            top.SERVICES = parseInt(this.userAccount.services);
            top.MESSAGES = parseInt(this.userAccount.messages);
            top.WEATHER_ENABLED = parseInt(this.userAccount.weather);
            top.CLOCK_ENABLED = parseInt(this.userAccount.clock);
            top.kwConsole.print("User:" + top.USER_ID);
            top.THEME = this.userAccount.theme;
            //top.LOGO = this.userAccount.logo;
            top.WELCOME_MSG = this.userAccount.welcome_msg;
            top.GUEST_NAME = this.userAccount.title;
            top.MCAST_PREFIX = this.userAccount.mcast_prefix;
            top.TRANSPARENCY_LEVEL = parseInt(this.userAccount.transperancy_level);
            top.OPAQUE_LEVEL = parseInt(this.userAccount.opaque_level);
            top.VOLUME_STEP = parseInt(this.userAccount.volume_step);
            top.VOLUME_MAX = parseInt(this.userAccount.volume_max);
            top.VOLUME_MIN = parseInt(this.userAccount.volume_min);
            top.ROOM_NUMBER = this.userAccount.room_number;
            top.CLIP_X = parseInt(this.userAccount.clip_x);
            top.CLIP_Y = parseInt(this.userAccount.clip_y);
            top.CLIP_W = parseInt(this.userAccount.clip_w);
            top.CLIP_H = parseInt(this.userAccount.clip_h);
            top.SOCKET_SUPPORT = parseInt(this.userAccount.socket_enabled);
            var str = this.userAccount.view_type;
            top.VIEW_TYPE = str.replace(/\s+/g, '');
            top.BACKGROUND_ARRAY = this.userAccount.background_array;
            //console.log(top.BACKGROUND_ARRAY);
            top.TTAPE_MARQUEE = parseInt(this.userAccount.tapemarquee_enabled);
            top.FAKE_DATA = parseInt(this.userAccount.fakedata_enabled);
            top.IS_INTERNET = parseInt(this.userAccount.internet_enabled);
            top.EXIT_ENABLED = parseInt(this.userAccount.exit_enabled);
            top.ALARM_ENABLED = parseInt(this.userAccount.alarm_enabled);
            top.TICKERTAPE_ENABLED = parseInt(this.userAccount.tickertape_enabled);
            top.CHFAVOURITE_ENABLED = parseInt(this.userAccount.chfavourite_enabled);
            top.SHOW_GUEST_TITLE = parseInt(this.userAccount.se_guest_title);
            top.kwConsole.print("USERID:" + top.USER_ID + "THEME:" + top.THEME);
            if (b) {
                top.globalLoginCallback("VALID_CREDENTIALS");
            } else {
                top.ScreenManager.load("LANG");
            }
        }
        return null;
    }, getLangSettings: function () {
        u = top.LANGSETTING_URL + "user_id/" + top.USER_ID + "/language/" + top.DEFAULT_LANGUAGE + "/format/json";
        top.kwUtils.kwXMLHttpRequest("GET", u, true, this, this.loadLangSettings);
    }, loadLangSettings: function (b) {
        try {
            b = (typeof b === "object") ? b : jsonParser(b);
            top.WELCOME_MSG = b.welcome_msg;
            top.GUEST_NAME = b.title;
        } catch (c) {
            top.kwConsole.print("USER_LOAD_ERROR");
        }
    }, changeUserLang: function () {
        // var b = top.CHANGE_LANG_URL + "user_id/" + top.USER_ID + "/language/" + top.DEFAULT_LANGUAGE + "/format/json";
        // top.kwUtils.kwXMLHttpRequest("POST", b, true);
        // top.Player.restart();
    }, setRestart: function () {
        var a = top.ROOM_NUMBER;
        var b = top.RESTART_DONE + "device/" + top.DEVICE_ID;
        top.kwUtils.kwXMLHttpRequest("POST", b, true);
    }, completeCheckout: function (device_id) {
        var url = top.COMMON_APP_URL+"complete_checkout/device_id/"+device_id+"/format/json";
        top.kwUtils.kwXMLHttpRequest("POST", url, true);
        console.log(url);
    }
};