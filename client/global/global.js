var globalChannelNumber = "";
var globalVolumeNumber = "";
var COMMON_CSS_EXTENSION = "";
var COMMON_URL_PREFIX = "";

function globalLoadApplication() {
    top.kwStatusConsole.print("Frames Loaded.", 0);
    loadDeviceAPI();
}

function loadDeviceAPI() {
    top.kwStatusConsole.print("loadDeviceAPI func :: loaded", 0);
    try {
        if (typeof (AirTiesVP) != "undefined") {
            top.DEVICE_TYPE = "airties";
        } else if (typeof document.createExterityPlayer == "function") {
            top.DEVICE_TYPE = "exterity";
            if (top.FORCE_STB_RESOLUTION == 1) {
                try {
                    configwrite("HD", "yes");
                    configwrite("screenResolution", top.EXTERITY_RESOLUTION);
                } catch (ex) {
                    alert(ex.message);
                }
            }
        } else if (typeof ASTB !== "undefined") {
            top.DEVICE_TYPE = "aminocom";
            //ASTB.SetMouseState(0);
            //ASTB.DefaultKeys(0);
            if (top.FORCE_STB_RESOLUTION == 1) {
                top.setASTBConfig();
            }
        } else if (typeof gSTB !== "undefined") {//added by Yesh
            top.DEVICE_TYPE = "infomir";
        } else {
            var h = document.getElementsByTagName("body")[0];
            var e = document.createElement("div");
            e.innerHTML = '<object id="duneapi" type="application/x-dune-stb-api" style="visibility: hidden; width: 0px; height: 0px;"></object>';
            h.appendChild(e);
            var g = document.getElementById("duneapi");
            if (typeof g.init !== "function") {
                top.DEVICE_TYPE = "pc";
            } else {
                if (typeof g.init == "function") {
                    top.kwConsole.print("stb is defined");
                    top.DEVICE_TYPE = "dunehd";
                    top.setDUNEConfig();
                }
            }
        }
        top.kwConsole.print("Device Type:" + top.DEVICE_TYPE);
        top.kwStatusConsole.print("Detected Device:" + top.DEVICE_TYPE, 0);
        top.loadPlayer();
    } catch (f) {
        alert("Error:" + f.message);
    }
}

function loadPlayer() {
    top.kwConsole.print("load player");
    l = "plugins/vendors/" + top.DEVICE_TYPE + "/player.plugin.js";
    top.kwConsole.print("load player script:" + l);
    var c = document.createElement("script");
    c.setAttribute("src", l);
    c.setAttribute("type", "text/javascript");
    var d = parent.document.getElementsByTagName("script")[0];
    d.parentNode.insertBefore(c, d);
    d.onload = top.playerLoaded();
}

function playerLoaded() {
    top.kwConsole.print("playerLoaded");
    if (eval("typeof top.Player != 'undefined'")) {
        top.kwConsole.print("playerLoaded:: Player defined");
        top.kwStatusConsole.print("Player API loaded:", 0);
        //top.COMMON_CSS_EXTENSION = top.globalGetScreenWidthByResolution() + "x" + top.globalGetScreenHeightByResolution() + "_" + top.DEFAULT_LANGUAGE;
        top.COMMON_URL_PREFIX = document.location.href.substring(0, document.location.href.lastIndexOf("/")) + "/";
        top.Player.init();
        top.loadKeyListener();
    } else {
        top.kwStatusConsole.print("Player API trying to load......", 1);
        setTimeout("top.playerLoaded()", 1000);
    }
}

function loadKeyListener() {
    top.kwConsole.print("loadKeyListener");
    l = "plugins/vendors/" + top.DEVICE_TYPE + "/rc.plugin.js";
    var c = document.createElement("script");
    c.setAttribute("src", l);
    c.setAttribute("type", "text/javascript");
    var d = parent.document.getElementsByTagName("script")[0];
    d.parentNode.insertBefore(c, d);
    d.onload = top.keyListenerLoaded()
}

function keyListenerLoaded() {
    if (eval("typeof top.pluginInitRcPlugin== 'function'")) {
        top.kwConsole.print("keyListenerLoaded::pluginInitRcPlugin");
        top.kwStatusConsole.print("KeyBoard Listener Loaded:", 0);
        top.pluginInitRcPlugin();
        top.UserManager.init()
    } else {
        top.kwStatusConsole.print("KeyBoard Listener trying to load.....", 1);
        setTimeout("top.keyListenerLoaded()", 1000)
    }
}

function setASTBConfig() {
    if (typeof ASTB != "undefined") {
        try {
            ASTB.SetConfig(top.AMINO_PWD, "SETTINGS.DISPLAY_MODE", top.AMINO_ASPECT_RATIO);
            ASTB.SetConfig(top.AMINO_PWD, "SETTINGS.FULLSCREEN", top.AMINO_FULLSCREEN_SETTING);
            ASTB.SetConfig(top.AMINO_PWD, "SETTINGS.GFX_RESOLUTION", top.AMINO_VIDEO_MODE);
            ASTB.SetConfig(top.AMINO_PWD, "SETTINGS.DISPLAY_MODE", top.AMINO_ASPECT_RATIO);
            ASTB.CommitConfig();
        } catch (b) {
            alert(b.message);
        }
    }
}

function setDUNEConfig() {
    if (top.DEVICE_TYPE == "dunehd") {
        try {
            var c = top.document.getElementById("duneapi");
        } catch (b) {
            alert(b.message);
        }
    } else {
        alert("No");
    }
}

function globalUnloadApplication() {
    top.Player.stop();
}

function globalGetScreenWidthByResolution() {
    var b = "";
    var a = top.BROWSER_RESOLUTION == "AUTO" ? top.Player.getBrowserResolution() : top.BROWSER_RESOLUTION;
    top.kwConsole.print("globalGetScreenWidthByResolution:: BROWSER_RESOLUTION :: " + a);
    switch (a) {
        case "PAL":
        case "NTSC":
            b = "720";
            break;
        case "720P":
        case "720":
        case "720p":
        case "pc720":
        case "infomir720":
        case "exterity720":
        case "dunehd720":
        case "aminocom720":
            b = "1280";
            break;
        case "1080I":
        case "HD1080":
        case "1080":
        case "1080p":
        case "1080P":
        case "pc1080":
        case "infomir1080":
        case "exterity1080":
        case "dunehd1080":
        case "aminocom1080":
            b = "1920";
            break;
    }
    return b;
}

function globalGetScreenHeightByResolution() {
    var a = "";
    var b = top.BROWSER_RESOLUTION == "AUTO" ? top.Player.getBrowserResolution() : top.BROWSER_RESOLUTION;
    top.kwConsole.print("globalGetScreenHeightByResolution:: BROWSER_RESOLUTION :: " + b);
    switch (b) {
        case "NTSC":
            a = "480";
            break;
        case "PAL":
            a = "576";
            break;
        case "720P":
        case "720":
        case "pc720":
        case "infomir720":
        case "exterity720":
        case "dunehd720":
        case "aminocom720":
            a = "720";
            break;
        case "1080I":
        case "HD1080":
        case "1080":
        case "1080i":
        case "1080P":
        case "1080p":
        case "pc1080":
        case "infomir1080":
        case "exterity1080":
        case "dunehd1080":
        case "aminocom1080":
            a = "1080";
            break;
    }
    return a;
}

function globalGetUserLanguage() {
    return top.DEFAULT_LANGUAGE;
}

function globalGetCommonCSSExtention() {
    return top.COMMON_CSS_EXTENSION;
}

function globalHideChannelNumber() {
    var b = top.ScreenManager.getCurrentScreenWindow();
    if (b) {
        var a = b.document.getElementById("globalChannelZapper");
        if (a) {
            a.innerHTML = "";
        }
    }
}

function globalLoginCallback(a) {
    try {
        if (a == "VALID_CREDENTIALS") {
            try {
                top.globalFireEvent(new top.Event("LOGIN_SUCCESS"))
            } catch (f) {
                top.kwConsole.print("globalLoginCallback catch" + f.message)
            }
        }
    } catch (e) {
        top.globalFireEvent(new top.Event("LOGIN_FAILURE"))
    }
}

function globalInitScreens() {
    top.ScreenManager.add(new top.Screen("LANG", "langEventHandler"));
    top.ScreenManager.add(new top.Screen("MENU", "menuEventHandler"));
    top.ScreenManager.add(new top.Screen("FSV", "fsvEventHandler"));
    top.ScreenManager.add(new top.Screen("CH_LIST", "chListEventHandler"));
    top.ScreenManager.add(new top.Screen("CH_FAVLIST", "chListEventHandler"));
    top.ScreenManager.add(new top.Screen("CH_CHOOSER", "chChooserEventHandler"));
    top.ScreenManager.add(new top.Screen("RADIO_LIST", "radioListEventHandler"));
    top.ScreenManager.add(new top.Screen("RADIO_CHOOSER", "radioChooserEventHandler"));
    top.ScreenManager.add(new top.Screen("VOD_LIST", "vodListEventHandler"));
    top.ScreenManager.add(new top.Screen("VOD_CHOOSER", "vodChooserEventHandler"));
    top.ScreenManager.add(new top.Screen("RESTRNT", "restrntEventHandler"));
    top.ScreenManager.add(new top.Screen("MESSAGE", "messageEventHandler"));
    top.ScreenManager.add(new top.Screen("RESTRNT_DETAIL", "restrntDetailEventHandler"));
    top.ScreenManager.add(new top.Screen("RESTRNT_ORDER", "restrntOrderEventHandler"));
    top.ScreenManager.add(new top.Screen("SERVICE", "serviceEventHandler"));
    top.ScreenManager.add(new top.Screen("LOCAL", "localEventHandler"));
    top.ScreenManager.add(new top.Screen("LOCAL_DETAIL", "localDetailEventHandler"));
    top.ScreenManager.add(new top.Screen("LOCAL_ORDER", "localOrderEventHandler"));
    top.ScreenManager.add(new top.Screen("ROOM_KEEPER", "roomEventHandler"));
    top.ScreenManager.add(new top.Screen("ROOM_EXIT", "exitEventHandler"));
    top.ScreenManager.add(new top.Screen("EPG", "epgEventHandler"));
    top.ScreenManager.add(new top.Screen("SPA", "spaEventHandler"));
    top.ScreenManager.add(new top.Screen("EXPERIENCE", "expEventHandler"));
    top.ScreenManager.add(new top.Screen("NEWSNPROMO", "newsnpromoEventHandler"));
    top.ScreenManager.add(new top.Screen("SERVICELIST", "serviceListEventHandler"));
    //top.ScreenManager.add(new top.Screen("INTERNET_WEB", "webEventHandler"))
}

function globalInitManagers() {
    try {
        top.StreamManager.init();
        if (top.MESSAGES) {
            top.MessageManager.init();
        }
        if (top.SERVICES) {
            top.ServiceManager.init();
        }
        if (top.SERVICES) {
            top.RoomKeeperManager.init();
        }
        if (top.RADIO) {
            top.RadioManager.init();
        }
        if (top.EXPERIENCE) {
            top.ExperienceManager.loadFlag();
        }
        if (top.NEWSNPROMO) {
            top.NewsnpromoManager.loadFlag();
        }
        if (top.TV) {
            top.ChannelManager.init();
        }
        if (top.SOCKET_SUPPORT == 1) {
            top.ListenerManager.init();
        } else {
            top.ThreadManager.init();
        }
        initGlobalAlarmTime();
    } catch (b) {
        top.kwConsole.print("global.js::globalInitScreens Error:" + b.message);
    }
}

function globalEventHandler(h) {
    top.kwConsole.print("global::globalEventHandler:a.code:" + h.code);
    var a = true;
    try {
        switch (h.code) {
            case "VIDEO_START_OF_STREAM":
            case "UDP_STATUS_PLAYING":
                top.StreamManager.updateStream();
                break;
            case "KEY_INFO":
                top.ScreenManager.load("FSV");
                break;
            case "KEY_GUIDE":
                top.ScreenManager.load("EPG");
                break;
            case "KEY_MENU":
                top.ScreenManager.load("MENU");
                break;
            case "PAGES_LOADED":
                top.ScreenManager.load("LANG");
                break;
            case "LOGIN_SUCCESS":
                globalInitScreens();
                globalInitManagers();
                top.globalFireEvent(new top.Event("PAGES_LOADED"));
                break;
            case "KEY_EXIT":
                top.ScreenManager.load("ROOM_EXIT");
                break;
            case "POWER_OFF":
                break;
            case "KEY_VOLUME_UP":
                v = top.Player.getVolume() + top.VOLUME_STEP;
                top.Player.setVolume(v);
                top.globalSetVolumeBar(1);
                break;
            case "KEY_VOLUME_DOWN":
                v = top.Player.getVolume() - top.VOLUME_STEP;
                top.Player.setVolume(v);
                top.globalSetVolumeBar(0);
                break;
            case "KEY_MUTE":
                if (top.Player.getPlayerState() === "PLAYING") {
                    var b = top.Player.toggleMute();
                    top.switchMuteDisplay(b);
                }
                break;
            case "POWER_BUTTON":
                // top.ScreenManager.load("MENU");
                top.Player.powerToggle();
                break;
            case "KEY_NUMERIC":
                top.globalSetChannelNumber(h);
                break;
            case "KEY_TV":
                top.KEY_TV_PRESSED = 1;
                top.ScreenManager.load("CH_LIST");
                break;
            // case "KEY_CHANNEL_UP":
            //     break;
            // case "KEY_CHANNEL_DOWN":
            //     break;
            // case "KEY_NUMERIC":
            //     top.globalSetChannelNumber(h);
            //     break;
            case "CHANNEL_SELECTED":
                channel = top.ChannelManager.getChannelByNumber(h.args.channelNumber);

                // for (i = 0; i <= 30; i++) {
                // }
                top.kwConsole.print(":::::::::" + h.args.channelNumber + " THE CHANNEL" + channel + "selected");
                if (channel) {
                    top.ChannelManager.setCurrentChannel(channel);
                    top.ScreenManager.deleteHistory();
                    top.globalChannelApproved = false;
                    top.ScreenManager.load("FSV")
                } else {
                    top.globalChannelNumber = "---";
                    top.globalDisplayChannelNumber();
                    top.kwTimer.setTimer("HIDE_CHANNEL_ZAPPING_TIMEOUT", {
                        scope: this,
                        callback: top.globalHideChannelNumber
                    }, 1500);
                }
                break;
            case "KEY_BLUE":
                if(top.MessageManager.msgIsInfobarHidden == false){

                    top.MessageManager.messageShow(0);
                    top.MessageManager.setMessageRead(top.CURRENT_MESSAGE_ID);
                    top.CURRENT_MESSAGE_ID = null;

                }
                break;
        }
    } catch (e) {
        top.kwConsole.print("global::globalEventHandler:Exception:" + e.message);
    }
    return a;
}

function globalFixChannelNumber(c, a) {
    var b;
    switch (c.toString().length) {
        case 1:
            b = a + a + c;
            break;
        case 2:
            b = a + c;
            break;
        default:
            b = c;
            break
    }
    return b
}

function globalDisplayChannelNumber() {
    var a = top.ScreenManager.getCurrentScreenWindow();
    if (a) {
        var f = a.document.getElementById("globalChannelZapper");
        if (f) {
            var b = "<html><body><p class='globalChannelZapper'>";
            b += top.globalFixChannelNumber(top.globalChannelNumber, "-");
            b += "</p></body></html>";
            f.innerHTML = b
        }
    }
}

function switchMuteDisplay(g) {
    top.kwConsole.print("MUTE VALUE" + g);
    var h = top.ScreenManager.getCurrentScreenWindow();
    if (h) {
        var f = h.document.getElementById("globalMutePage");
        var b = h.document.getElementById("globalMute");
        if (g == 1) {
            if (f) {
                f.style.visibility = "visible"
            }
            if (b) {
                b.style.visibility = "visible"
            }
        } else {
            if (f) {
                f.style.visibility = "hidden"
            }
            if (b) {
                b.style.visibility = "hidden"
            }
        }
    }
}

function globalSetChannelNumber(a) {
    top.kwTimer.cancelTimer("CHANNEL_ZAPPING_TIMEOUT");
    if (top.globalChannelNumber.length == 3) {
        top.globalChannelNumber = "" + a.args.value
    } else {
        top.globalChannelNumber += a.args.value
    }
    top.globalDisplayChannelNumber();
    if (top.globalChannelNumber.length == 3) {
        top.globalSelectChannel()
    } else {
        top.kwTimer.setTimer("CHANNEL_ZAPPING_TIMEOUT", {
            scope: this,
            callback: top.globalSelectChannel
        }, 1500)
    }
}

function globalSelectChannel() {
    top.kwTimer.cancelTimer("CHANNEL_ZAPPING_TIMEOUT");
    top.globalFireEvent(new top.Event("CHANNEL_SELECTED", {
        channelNumber: top.globalChannelNumber
    }));
    top.globalChannelNumber = ""
}

function checkVolumeBar() {
    v = top.Player.getVolume();
    vs = Math.floor(v / top.VOLUME_STEP);
    top.Player.setVolume(vs * top.VOLUME_STEP);
    var b = top.ScreenManager.getCurrentScreenWindow();
    var a = b.document.getElementById("globalVolumeBar");
    top.globalVolumeNumber = "";
    if (a) {
        for (var g = 0; g < vs; g++) {
            top.globalVolumeNumber += "|"
        }
        var h = "<html><body><p class='globalVolumeBar'>";
        h += top.globalVolumeNumber;
        h += "</p></body></html>";
        a.innerHTML = h
    }
}

function globalSetVolumeBar(a) {
    top.kwTimer.cancelTimer("VOLUME_ZAPPING_TIMEOUT");
    t = top.VOLUME_MAX / top.VOLUME_STEP;
    if (a) {
        if (top.globalVolumeNumber.length < t) {
            top.globalVolumeNumber += "|"
        }
    } else {
        if (top.globalVolumeNumber.length > top.VOLUME_MIN) {
            top.globalVolumeNumber = top.globalVolumeNumber.substring(0, top.globalVolumeNumber.length - 1)
        }
    }
    top.globalDisplayVolumeBar();
    if (top.globalVolumeNumber.length == top.VOLUME_MAX) {
        top.globalSelectVolume()
    } else {
        top.kwTimer.setTimer("VOLUME_ZAPPING_TIMEOUT", {
            scope: this,
            callback: top.globalSelectVolume
        }, 1500)
    }
}

function globalDisplayVolumeBar() {
    var a = top.ScreenManager.getCurrentScreenWindow();
    if (a) {
        var f = a.document.getElementById("globalVolumeBar");
        if (f) {
            var b = "<html><body><p class='globalVolumeBar'>";
            b += top.globalVolumeNumber;
            b += "</p></body></html>";
            f.innerHTML = b;
            f.style.visibility = "visible"
        }
    }
}

function globalSelectVolume() {
    top.kwTimer.cancelTimer("VOLUME_ZAPPING_TIMEOUT");
    var b = top.ScreenManager.getCurrentScreenWindow();
    var a = b.document.getElementById("globalVolumeBar");
    if (a) {
        a.style.visibility = "hidden"
    }
}

function loadJSScript(a) {
    $.getScript(a, function () {
        return true
    });
    return false
}

function ChannelArrayfind(a, e) {
    if (!e || typeof (e) != "function") {
        return -1
    }
    if (!a || !a.length || a.length < 1) {
        return -1
    }
    for (var f = 0; f < a.length; f++) {
        if (e(a[f])) {
            return a[f]
        }
    }
    return -1
}

/**
 * changeBackgroundImg
 * @param {type} str
 * @returns void
 * Added by Yesh - 2016-06-10
 */
function changeBackgroundImg(str) {
    var obj = top.BACKGROUND_ARRAY;
    top.BG_IMG = '';
    for (var i = 0; i < obj.length; i++) {
        if (obj[i].background_module == str) {
            top.BG_IMG = 'url(' + top.IMAGES_PREFIX + 'BGS/' + obj[i].background_image + ')';

        }
    }
}

function initGlobalAlarmTime(){
    var mac = top.Player.getMacAddress();
    var i = top.SERVICEALARM_CURRENT + "mac/" + mac +"/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", i, true, this, initAlarmTime);
}

function initAlarmTime(alarm){
    if (alarm.error) {
        top.GLOBAL_ALARM_DATA = null;
    }else{
        var jsonAlarm = top.jsonParser(alarm);
        top.GLOBAL_ALARM_DATA = jsonAlarm[0];
    }
    
}

function initAlarmClock(){
    
    //Checking alarm time
    if (top.GLOBAL_ALARM_DATA != null) {
        var date = new Date(); // for now
        
        var mm = date.getMonth()+1;
        var dd = date.getDate();
        var hh = date.getHours();
        var min = date.getMinutes();
        if(dd<10) {
            dd = '0'+dd
        } 
        if(mm<10) {
            mm = '0'+mm
        }
        if (hh < 10) {
            hh = '0'+hh
        } 
        if (min <10) {
            min = '0'+min;
        }
        var currentDate = date.getFullYear()+"-"+mm+"-"+dd;
        var currentTime =  hh+":"+min+":00";
        var dateTime = currentDate+" "+currentTime;
        var alarmTime = top.GLOBAL_ALARM_DATA.alarm_time;


        if (dateTime == alarmTime) {
            
            
            top.GLOBAL_FIRE_ALARM = 1;
            var alarm_tone = "";
            if (top.GLOBAL_ALARM_DATA.tone == "Alarm 1") { 
                alarmTone = "alarm1";
            }else if (top.GLOBAL_ALARM_DATA.tone  == "Alarm 2") {
                alarmTone = "alarm2";
            }else if (top.GLOBAL_ALARM_DATA.tone  == "Alarm 3") {
                alarmTone = "alarm3";
            }else if (top.GLOBAL_ALARM_DATA.tone  == "Alarm 4") {
                alarmTone = "alarm4";
            }
            if (gSTB.GetStandByStatus() == false) {
                
               startAlarm(alarmTone);
                

            }else{
                gSTB.StandBy(false);
                // var alarm_url = "http://"+top.ip+"/client/alarm/alarm.mp3";
                // console.log(alarm_url);
                // top.ScreenManager.load("SERVICE");
                // top.Player.stop();
                // top.Player.play(alarm_url);
                // gSTB.SetLoop(1);
                startAlarm(alarmTone);

                
            }
            
        }
    }
    var h = (60 * 1000);
    top.kwTimer.setTimer("ALARM", {
        scope: this,
        callback: this.initAlarmClock,
        args: []
    }, h);
}

function startAlarm(alarmTone){
     if (top.GLOBAL_ALARM_DATA.type == "TV") {
        var channel = top.ChannelManager.getChannelByNumber(top.GLOBAL_ALARM_DATA.udp);
        kwConsole.print("channel :" +channel);
        if (channel) {
            gSTB.SetVolume(100);
            top.ChannelManager.setCurrentChannel(channel);
            top.ScreenManager.deleteHistory();
            top.globalChannelApproved = false;
            top.ScreenManager.load("FSV");
        }

    }else if (top.GLOBAL_ALARM_DATA.type == "RingTone") {
        
        //console.log("Ring Tone");
        
        var alarm_url = "http://"+top.ip+"/client/alarm/"+alarmTone+".mp3";
        //console.log(alarm_url);

        top.ScreenManager.load("SERVICE");
        top.ALARM_CONTAINER.style.visibility = "visible";

        top.Player.stop();
        gSTB.SetVolume(100);
        top.Player.play(alarm_url);
        gSTB.SetLoop(1);
    }
}




