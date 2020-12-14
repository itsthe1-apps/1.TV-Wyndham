var ThreadManager = {
    userDate: "1999-01-01 00:00:00",
    isUserInit: true,
    channelDate: "1999-01-01 00:00:00",
    infoDate: "1999-01-01 00:00:00",
    mediaDate: "1999-01-01 00:00:00",
    movieDate: "1999-01-01 00:00:00",
    newsDate: "1999-01-01 00:00:00",
    radioDate: "1999-01-01 00:00:00",
    internetDate: "1999-01-01 00:00:00",
    restDate: "1999-01-01 00:00:00",
    spaDate: "1999-01-01 00:00:00",
    dateFormat: "yyyy-MM-dd HH:mm:ss",
    dataLoadEvent: null,
    ttapeLoadEvent: null,
    weatherEvent: null,
    alarmLoadEvent: null,
    exitLoadEvent: null,
    weatherCounter: 0,
    tickerCounter: 0,
    init: function () {
        if (top.SOCKET_SUPPORT == 0) {
            this.checkDataFlag()
        }
    },
    checkDataFlag: function () {
        var c = top.DATAFLAG_URL + "/user/" + top.USER_ID + "/device/" + top.DEVICE_ID;
        top.kwUtils.kwXMLHttpRequest("GET", c, true, this, this.loadDataFlag);
        top.kwTimer.setTimer("DATA_LOAD_TIMEOUT", {
            scope: this,
            callback: this.checkDataFlag
        }, top.DATA_LOAD_TIMEOUT)
    },
    loadDataFlag: function (e) {
        try {
            top.Player.listenerEventHandler();
            a = JSON.parse(e);
            if (top.TV == 1) {
                f = compareDates(a.tv, top.ThreadManager.dateFormat, top.ThreadManager.channelDate, top.ThreadManager.dateFormat);
                if (f === 1) {
                    top.ThreadManager.channelDate = a.tv;
                    top.kwConsole.print("New TV Data");
                    top.ChannelManager.loadFlag()
                }
            }
            if (top.INFORMATION == 1) {
                f = compareDates(a.localinfo, top.ThreadManager.dateFormat, top.ThreadManager.infoDate, top.ThreadManager.dateFormat);
                if (f === 1) {
                    top.ThreadManager.infoDate = a.localinfo;
                    top.kwConsole.print("New Info Data");
                    top.LocalInfoManager.loadFlag();
                    top.kwConsole.print("New Spa Data");
                    top.SpaInfoManager.loadFlag();
                    top.kwConsole.print("New Experience Data");
                    top.ExperienceManager.loadFlag();
                    top.kwConsole.print("New ServicesList Data");
                    top.ServiceListManager.loadFlag();
                    top.kwConsole.print("New Newsnpromo Data");
                    top.NewsnpromoManager.loadFlag();
                }
            }
            if (top.RESTAURANT == 1) {
                f = compareDates(a.restaurant, top.ThreadManager.dateFormat, top.ThreadManager.restDate, top.ThreadManager.dateFormat);
                if (f === 1) {
                    top.ThreadManager.restDate = a.restaurant;
                    top.kwConsole.print("New Restuarant Data");
                    top.RestuarantsManager.loadFlag()
                }
            }
            f = compareDates(a.promotions, top.ThreadManager.dateFormat, top.ThreadManager.mediaDate, top.ThreadManager.dateFormat);
            if (f === 1) {
                top.ThreadManager.mediaDate = a.promotions;
                top.kwConsole.print("New Media Data");
                top.MediaManager.loadMediaData()
            }
            if (top.VOD == 1) {
                f = compareDates(a.vod, top.ThreadManager.dateFormat, top.ThreadManager.movieDate, top.ThreadManager.dateFormat);
                if (f === 1) {
                    top.ThreadManager.movieDate = a.movieDate;
                    top.kwConsole.print("New Movie Data");
                    top.MoviesManager.loadFlag()
                }
            }
            f = compareDates(a.news, top.ThreadManager.dateFormat, top.ThreadManager.newsDate, top.ThreadManager.dateFormat);
            if (f === 1) {
                top.ThreadManager.newsDate = a.news;
                top.kwConsole.print("New News Data");
                top.NewsManager.loadFlag()
            }
            if (top.RADIO == 1) {
                f = compareDates(a.radio, top.ThreadManager.dateFormat, top.ThreadManager.radioDate, top.ThreadManager.dateFormat);
                if (f === 1) {
                    top.ThreadManager.radioDate = a.radio;
                    top.kwConsole.print("New Radio Data");
                    top.RadioManager.loadFlag()
                }
            }
            if (top.INTERNET == 1) {
                f = compareDates(a.internet, top.ThreadManager.dateFormat, top.ThreadManager.internetDate, top.ThreadManager.dateFormat);
                if (f === 1) {
                    top.ThreadManager.internetDate = a.internet;
                    top.kwConsole.print("New internet Data");
                    top.InternetManager.loadFlag()
                }
            }
            if (a.need_restart == "yes") {

                ////Wakeup STB if on StandBy if Stand By
                p = gSTB.GetStandByStatus();
                top.kwConsole.print("GetStandByStatus :" + p);
                var tvStatus = gSTB.GetHDMIConnectionState();
                //alert(tvStatus+"----"+p);
                if ((tvStatus == 0) && (p == true)) {
                    gSTB.StandBy(false);
                }
                //top.Player.restart();
                top.Player.reboot();

            }
            //console.log("a.checked_out : "+a.checked_out,"----","top.CHECKED_OUT_FLAG : ",top.CHECKED_OUT_FLAG,"Device ID:"+top.DEVICE_ID);
            if (a.checked_out == "yes"){
                top.kwConsole.print("Checked Out STB");
                if(top.CHECKED_OUT_FLAG == false){
                    top.CHECKED_OUT = true;
                    top.ScreenManager.load("MENU");
                    top.CHECKED_OUT_FLAG == true;
                    top.UserManager.completeCheckout(top.DEVICE_ID);
                    //Set STB To Snad by
                    setTimeout(function () {

                        p = gSTB.GetStandByStatus();
                        top.kwConsole.print("GetStandByStatus :" + p);
                        var tvStatus = gSTB.GetHDMIConnectionState();
                        //alert(tvStatus+"----"+p);
                        if ((tvStatus == 2) && (p == false)) {
                            gSTB.StandBy(true);
                        }

                    },5000);
                }
            }else{
                if(top.CHECKED_OUT_FLAG == true){
                    top.CHECKED_OUT = false;
                    top.CHECKED_OUT_FLAG == false;
                }
                //console.log(a.checked_out);
            }
            if (a.device_status == "device_off") {
                top.kwConsole.print("Change Device Status");
                top.UserManager.setRestart();
            }
            if (top.MESSAGES == 1) {
                if (a.message == "yes") {

                	var p = gSTB.GetStandByStatus();
                    top.kwConsole.print("GetStandByStatus :" + p);
                    var tvStatus = gSTB.GetHDMIConnectionState();
                    //alert("tvStatus : "+tvStatus+"----"+"StandBy Status :"+p+"top.STANDBY_HOLD : "+top.STANDBY_HOLD);
                    if ((tvStatus == 0) && (p == true) && (top.STANDBY_HOLD == false)) {
                        gSTB.StandBy(false);
                    }

                    top.MessageManager.loadMessages();

                } else {
                    if (top.MessageManager.msgIsInfobarHidden == false) {
                        //top.MessageManager.messageShow(0)
                    }
                }
            }
            if (top.EXIT_ENABLED == 1) {
                if ((a.exit == "1" || a.exit == "0") && top.MENU_LOADED == 1) {
                    top.kwConsole.print("Check Exit Data");
                    top.ServiceManager.loadExitData(a.exit)
                }
            }
            if (top.WEATHER_ENABLED == 1) {
                if (this.weatherCounter > top.WEATHER_COUNTER) {
                    this.weatherCounter = 0
                }
                if (this.weatherCounter == 0) {
                    top.kwConsole.print("Recapturing Weather Data");
                    top.top.WeatherManager.loadFlag()
                }
            }
            if (top.TICKERTAPE_ENABLED == 1) {
                if (this.tickerCounter > top.TTAPE_COUNTER) {
                    this.tickerCounter = 0
                }
                if (this.tickerCounter == 0) {
                    top.kwConsole.print("Recapturing Ticker Tape RSS");
                    top.TickerTapeManager.loadFlag()
                }
            }
            if (a.alarm != "no" && top.ALARM_ENABLED == 1) {
                top.kwConsole.print("Wakeup Alarm Console");
                top.globalChannelNumber = a.alarm;
                top.globalSelectChannel();
                top.ServiceManager.setAlarmServiceClosed()
            }
            this.weatherCounter++;
            this.tickerCounter++
        } catch (b) {
            top.kwConsole.print(b.message)
        }
    }
};