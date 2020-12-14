var ListenerManager = {
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
    init: function () {
        if (top.SOCKET_SUPPORT == 1) {
            this.listenDataLoad()
        }
    },
    listenDataLoad: function () {
        var b = "http://" + top.ip + "/" + top.APPNAME + "/index.php/push/data_reload/" + top.USER_ID + "/" + top.DEVICE_ID;

        if (typeof (EventSource) !== "undefined" && (this.dataLoadEvent === null || this.dataLoadEvent == "undefined")) {
            try {
                this.dataloadEvent = new EventSource(b);
                this.dataloadEvent.onmessage = function (d) {
                    top.kwConsole.print("listenDataLoad:" + d.data);
                    if (d.data != "" && d.data != null) {
                        a = JSON.parse(d.data);
                        f = compareDates(a.tv, top.ListenerManager.dateFormat, top.ListenerManager.channelDate, top.ListenerManager.dateFormat);
                        if (f === 1 && top.TV == 1) {
                            top.ListenerManager.channelDate = a.tv;
                            top.kwConsole.print("New TV Data");
                            top.ChannelManager.loadFlag()
                        }
                        f = compareDates(a.localinfo, top.ListenerManager.dateFormat, top.ListenerManager.infoDate, top.ListenerManager.dateFormat);
                        if (f === 1 && top.INFORMATION == 1) {
                            top.ListenerManager.infoDate = a;
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
                        f = compareDates(a.restaurant, top.ListenerManager.dateFormat, top.ListenerManager.restDate, top.ListenerManager.dateFormat);
                        if (f === 1 && top.RESTAURANT == 1) {
                            top.ListenerManager.restDate = a;
                            top.kwConsole.print("New Restuarant Data");
                            top.RestuarantsManager.loadFlag()
                        }
                        f = compareDates(a.promotions, top.ListenerManager.dateFormat, top.ListenerManager.mediaDate, top.ListenerManager.dateFormat);
                        if (f === 1) {
                            top.ListenerManager.mediaDate = a;
                            top.kwConsole.print("New Media Data");
                            top.MediaManager.loadMediaData()
                        }
                        f = compareDates(a.vod, top.ListenerManager.dateFormat, top.ListenerManager.movieDate, top.ListenerManager.dateFormat);
                        if (f === 1 && top.VOD == 1) {
                            top.ListenerManager.movieDate = a;
                            top.kwConsole.print("New Movie Data");
                            top.MoviesManager.loadFlag()
                        }
                        f = compareDates(a.news, top.ListenerManager.dateFormat, top.ListenerManager.newsDate, top.ListenerManager.dateFormat);
                        if (f === 1) {
                            top.ListenerManager.newsDate = a;
                            top.kwConsole.print("New News Data");
                            top.NewsManager.loadFlag()
                        }
                        f = compareDates(a.radio, top.ListenerManager.dateFormat, top.ListenerManager.radioDate, top.ListenerManager.dateFormat);
                        if (f === 1 && top.RADIO == 1) {
                            top.ListenerManager.radioDate = a;
                            top.kwConsole.print("New Radio Data");
                            top.RadioManager.loadFlag()
                        }
                        f = compareDates(a.internet, top.ListenerManager.dateFormat, top.ListenerManager.internetDate, top.ListenerManager.dateFormat);
                        if (f === 1 && top.INTERNET == 1) {
                            top.ListenerManager.internetDate = a;
                            top.kwConsole.print("New internet Data");
                            top.InternetManager.loadFlag()
                        }
                        if (a.need_restart == "yes") {
                            top.kwConsole.print("Restarting STB");
                            top.Player.restart();
                        }
                        if (a.tape == "yes" && top.TICKERTAPE_ENABLED == 1) {
                            top.kwConsole.print("Recapturing Ticker Tape RSS");
                            top.TickerTapeManager.loadFlag()
                        }
                        if (a.weather == "yes" && top.WEATHER_ENABLED == 1) {
                            top.kwConsole.print("Recapturing Weather Data");
                            top.top.WeatherManager.loadFlag()
                        }
                        if (a.alarm != "no" && top.ALARM_ENABLED == 1) {
                            top.kwConsole.print("Wakeup Alarm Console");
                            top.globalChannelNumber = a.alarm;
                            top.globalSelectChannel();
                            top.ServiceManager.setAlarmServiceClosed()
                        }
                        if ((a.exit == "1" || a.exit == "0") && top.MENU_LOADED == 1 && top.EXIT_ENABLED == 1) {
                            top.kwConsole.print("Recapturing Ticker Tape RSS");
                            top.ServiceManager.loadExitData(a.exit)
                        }
                        if (top.MESSAGES == 1) {
                            if (a.message == "yes") {
                                top.MessageManager.getMessage()
                            } else {
                                if (top.MessageManager.msgIsInfobarHidden == false) {
                                    top.MessageManager.messageShow(0)
                                }
                            }
                        }
                    }
                }
            } catch (c) {
                top.kwConsole.print(c.message)
            }
        } else {
            top.kwConsole.print("User Load no event source")
        }
    },
    stopDataLoad: function () {
        this.dataloadEvent.close();
        this.dataloadEvent = null;
        delete this.dataloadEvent;
        this.dataloadEvent = undefined
    },
};