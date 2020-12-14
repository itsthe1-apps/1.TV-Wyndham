var menuMainList = null;
var menuNewsList = null;
var menuMediaList = null;
var menuNewsString = "";
var enteringMenu = 0;

function menuEventHandler(a) {
    var b = true;
    switch (a.code) {
        case "INIT_SCREEN":
            top.changeBackgroundImg('HOME');
            top.kwStatusConsole.clear();
            top.kwStatusConsole.hide();
            top.MENU_LOADED = 1;
            enteringMenu = 0;
            menuInitScreen();
            enteringMenu = 1;
            break;
        case "UNINIT_SCREEN":
            menuUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.MENU_MAIN:
                    b = menuMainEventHandler(a);
                    break;
                default:
                    b = false;
                    break
            }
            break
    }
    return b;
}

function menuMainEventHandler(a) {
    var b = true;
    switch (a.code) {
        case "KEY_LEFT":
            menuMainList.scrollUp(1);
            top.kwConsole.print("Key Left::target" + menuMainList.getItem().target);
            break;
        case "KEY_RIGHT":
            if (menuMainList.getIndex() == menuMainList.getLength() - 1) {
                menuMainList.scrollUp(menuMainList.getLength());
            } else {
                menuMainList.scrollDown(1);
            }
            break;
        case "KEY_SELECT":
            top.PRV_MENU_ID = menuMainList.getIndex();
            top.CURRENT_MAIN_MENU_ID = menuMainList.getItem().target;
            if (menuMainList.getItem().target) {
                if (menuMainList.getItem().target == "CHNGE_LANG") {
                    top.UserManager.changeUserLang();
                }
                if (menuMainList.getItem().target == "BROWSER") {
                    top.Player.loadUrl("http://www.youtube.com/xl")
                } else {
                    if (menuMainList.getItem().target == "CH_LIST") {
                        if (top.CHFAVOURITE_ENABLED == 1) {
                            top.ChannelManager.loadFavouriteChannel();
                        } else {
                            top.ChannelManager.clearChannelList();
                            top.DEFAULT_CHANNEL_CATEGORY = 0;
                            top.ChannelManager.chChooserLoadChannels(top.DEFAULT_CHANNEL_CATEGORY);
                        }
                    } else {
                        if (menuMainList.getItem().target == "FSCHEDULE") {
                            top.ScreenManager.load("HOME");
                        } else {
                            top.ScreenManager.load(menuMainList.getItem().target, menuMainList.getItem().args);
                        }
                    }
                }
            }
            break;
        case "KEY_DOWN":
            top.CURRENT_MENU_ID = menuMainList.getIndex();
            switch (top.State.getPreviousState()) {
                //TV Channels
                case top.State.CH_LIST_MAIN:
                case top.State.CH_FAVLIST_MAIN:
                    b = chListMainEventHandler(a);
                    menu_highlight_menu();
                    break;
                case top.State.CH_SUBMENU:
                    if (top.CURRENT_MENU == "genre") {
                        b = chChooserSubMenuEventHandler(a);
                        menu_highlight_menu();
                        break;
                    }
                    b = chListSubMenuEventHandler(a);
                    menu_highlight_menu();
                    break;
                //Radio Channels
                case top.State.RADIO_LIST_MAIN:
                    b = radioListMainEventHandler(a);
                    break;
                case top.State.RADIO_SUBMENU:
                    if (top.CURRENT_MENU == "genre") {
                        b = radioChooserSubMenuEventHandler(a);
                        menu_highlight_menu();
                        break;
                    }
                    b = radioListSubMenuEventHandler(a);
                    menu_highlight_menu();
                    break;
                //Restaurants
                case top.State.RESTRNT_LIST_MAIN:
                    b = restrntListMainEventHandler(a);
                    menu_highlight_menu();
                    break;
                //Spa Experience Local_Info
                case top.State.LOCAL_LIST_MAIN:
                    if (top.CURRENT_MAIN_MENU_ID == "SPA") {
                        // b = spaListMainEventHandler(a);
                        // menu_highlight_menu();
                    } else if (top.CURRENT_MAIN_MENU_ID == "EXPERIENCE") {
                        // b = expListMainEventHandler(a);
                        // menu_highlight_menu();
                    } else if (top.CURRENT_MAIN_MENU_ID == "SERVICELIST") {
                        // b = serviceListMainEventHandler(a);
                        // menu_highlight_menu();
                    } else if (top.CURRENT_MAIN_MENU_ID == "LOCAL") {
                        localListMainEventHandler(a);
                        menu_highlight_menu();
                    }
                    break;
                case top.State.NEWSPROMO_LIST_MAIN:
                    b = newsnpromoListMainEventHandler(a);
                    menu_highlight_menu();
                    break;
                //Main Menu
                case top.State.MENU_MAIN:
                    b = menuMainEventHandler(a);
                    break;
                default:
                    b = false;
                    break
            }
            break;
        default:
            b = false;
            break;
    }
    return b;
}

function menu_highlight_menu() {

    var current_menu_id = top.CURRENT_MENU_ID;
    var selected_menu_id = top.PRV_MENU_ID;


    var menu_id = document.getElementsByClassName("menuMainListItem")[selected_menu_id]; //
    var current_class = menu_id.className;
    var new_class = current_class + "Selected";
    menu_id.className = new_class;

    var prev_menu_id = document.getElementsByClassName("menuMainListItem")[current_menu_id];
    var prev_class = prev_menu_id.className;
    prev_class = prev_class.replace('Selected', '');
    prev_menu_id.className = prev_class;

}

function menuActionHandler(b, a) {
    switch (b) {
    }
}

function menuInitScreen() {
    try {

        clearInterval(top.GLOBAL_SLIDER_INTERVAL);
        clearInterval(top.GLOBAL_PROMOTION_INTERVAL);

        top.State.setState(top.State.MENU_MAIN);
        top.ScreenManager.displayScreen(menuGetScreenHtml());
        if (top.CLOCK_ENABLED == 1) {
            top.Clock.show(this, "globalClock")
        }
        this.menuInitMainList();
        this.menuInitNewsListLoader();
        this.menuInitWeatherListLoader();
        //this.loadMediaList();//Added by Yesh - 2016-08-02 - Disable promotions
        if (top.TTAPE_MARQUEE == 1) {
            this.loadNewsString();
        } else {
            this.menuInitNewsTapeListLoader();
        }
        top.switchMuteDisplay(top.Player.isMute);
        top.checkVolumeBar();
    } catch (a) {
        top.kwConsole.print("menuInitScreen" + a);
    }
}

function menuUninitScreen() {
    top.Clock.stop();
    top.kwTimer.cancelTimer("NEWS_REFRESH_TIMEOUT");
    top.kwTimer.cancelTimer("NEWS_SCROLL_DELAY");
    top.kwTimer.cancelTimer("CHECK_NEWMEDIADATA");
    top.kwTimer.cancelTimer("WEATHER_SCROLL_DELAY");
    top.kwTimer.cancelTimer("WEATHER_REFRESH_TIMEOUT");
    top.kwTimer.cancelTimer("TTAPE_SCROLLER");
    top.kwTimer.cancelTimer("TTAPE_REFRESH_TIMEOUT");
    top.kwTimer.cancelTimer("TTAPE_SCROLL_DELAY");
    top.kwTimer.cancelTimer("NEXT_MEDIA");
    if (top.SOCKET_SUPPORT == 1) {
        top.ListenerManager.stopWeatherLoad();
    }
    top.WeatherManager.isNewData = true;
    setToBinMenu();
    top.Player.stop();
}

function setToBinMenu() {
    timeTracker = null;
    delete timeTracker;
    timeTracker = undefined;
}

function menuInitWeatherListLoader() {
    if (top.WeatherManager.isNewData || enteringMenu == 0) {
        top.WeatherManager.isNewData = false;
        menuWeatherList = new top.List(top.ListType.SCROLL_CYCLIC, top.WeatherManager.getData(), 0, 0, 0, 1, document.getElementById("homeweather"));
        menuWeatherList.displayItem = menuWeatherListDisplayItem;
        menuWeatherList.initList();
        top.kwTimer.cancelTimer("WEATHER_SCROLL_DELAY");
        this.menuInitWeatherTimer();
    }
    top.kwTimer.setTimer("WEATHER_REFRESH_TIMEOUT", {
        scope: this,
        callback: menuInitWeatherListLoader
    }, top.WEATHER_REFRESH_TIMEOUT, true);
}

function menuInitWeatherTimer() {
    if (menuWeatherList.getLength() > 1) {
        menuWeatherList.scrollUp();
    }
    top.kwTimer.setTimer("WEATHER_SCROLL_DELAY", {
        scope: this,
        callback: menuInitWeatherTimer
    }, top.WEATHER_SCROLL_DELAY, true);
}
var timeTracker;

function loadMediaList() {
    if (top.kwTimer.isTimerSet("NEXT_MEDIA")) {
        top.kwTimer.cancelTimer("NEXT_MEDIA");
    }
    if (menuMediaList !== null) {
        menuMediaList = null;
    }
    menuMediaList = new top.List(top.ListType.SCROLL_CYCLIC, top.MediaManager.getMediaList(), 0, 0, 0, 1, document.getElementById("globalClipScreen"));
    menuMediaList.displayItem = menuMediaListDisplayItem;
    menuMediaList.initList();
    this.menuInitMediaList();
    top.kwTimer.setTimer("CHECK_NEWMEDIADATA", {
        scope: this,
        callback: loadMediaList
    }, top.MEDIA_LOAD_TIMEOUT, true);
}

function menuInitMediaList() {
    if (menuMediaList.getItem()) {
        d = menuMediaList.getItem().duration;
        if (menuMediaList.getLength() > 1) {
            top.kwTimer.setTimer("NEXT_MEDIA", {
                scope: this,
                callback: menuInitMediaTimer
            }, d, true);
        }
    }
}

function menuInitMediaTimer() {
    if (menuMediaList.getLength() > 1) {
        menuMediaList.scrollDown();
    }
    menuInitMediaList();
}


function menuGetMenuListData() {
    menus = 0;
    var a = [];
    a.push({
        "class": "menuHomeIcon",
        "txtLabel": "WELCOME",
        target: "MENU"
    });
    menus++;
    if (top.TV) {
        a.push({
            "class": "menuTvIcon",
            "txtLabel": "TV",
            target: "CH_LIST"
        });
        menus++;
    }
    if (top.INFORMATION) {
        a.push({
            "class": "menuLocalIcon",
            "txtLabel": "Hospital Infomation",
            target: "LOCAL"
        });
        menus++;
    }
    if (top.VOD) {
        a.push({
            "class": "menuVodIcon",
            "txtLabel": "VOD",
            target: "VOD_LIST"
        });
        menus++;
    }
    if (top.RADIO) {
        a.push({
            "class": "menuRadioIcon",
            "txtLabel": "RADIO",
            target: "RADIO_LIST"
        });
        menus++;
    }
    if (top.RESTAURANT) {
        a.push({
            "class": "menuRestrntIcon",
            "txtLabel": "Retail & Dining",
            target: "RESTRNT"
        });
        menus++;
    }
    if (top.SPA) {
        a.push({
            "class": "menuSpaIcon",
            "txtLabel": "SPA",
            target: "SPA"
        });
        menus++;
    }
    if (top.EXPERIENCE) {
        a.push({
            "class": "menuExperienceIcon",
            "txtLabel": "Experience",
            target: "EXPERIENCE"
        });
        menus++;
    }
    if (top.NEWSNPROMO) {
        a.push({
            "class": "menuNewsnpromoIcon",
            "txtLabel": "News & Promotions",
            target: "NEWSNPROMO"
        });
        menus++;
    }
    if (top.SERVICES) {
        a.push({
            "class": "menuServiceIcon",
            "txtLabel": "SERVICES",
            target: "SERVICE"
        });
        menus++;
    }
    if (top.MESSAGES) {
        a.push({
            "class": "menuMessageIcon",
            "txtLabel": "Messages",
            target: "MESSAGE"
        });
        menus++;
    }
    if (top.LAN_CHNGE) {
        a.push({
            "class": "menuLanguageIconA",
            "txtLabel": "",
            target: "CHNGE_LANG"
        });
        menus++;
    }
    return a;
}

function menuGetMenuListData_R() {
    menus = 0;
    var a = [];
    a.push({
        "class": "menuHomeIcon",
        "txtLabel": "WELCOME",
        target: "MENU"
    });
    menus++;
    if (top.TV) {
        a.push({
            "class": "menuTvIcon",
            "txtLabel": "TV",
            target: "CH_LIST"
        });
        menus++;
    }
    if (top.INFORMATION) {
        a.push({
            "class": "menuLocalIcon",
            "txtLabel": "Hospital Infomation",
            target: "LOCAL"
        });
        menus++;
    }
    if (top.VOD) {
        a.push({
            "class": "menuVodIcon",
            "txtLabel": "VOD",
            target: "VOD_LIST"
        });
        menus++;
    }
    if (top.RADIO) {
        a.push({
            "class": "menuRadioIcon",
            "txtLabel": "RADIO",
            target: "RADIO_LIST"
        });
        menus++;
    }
    if (top.RESTAURANT) {
        a.push({
            "class": "menuRestrntIcon",
            "txtLabel": "Retail & Dining",
            target: "RESTRNT"
        });
        menus++;
    }
    if (top.SPA) {
        a.push({
            "class": "menuSpaIcon",
            "txtLabel": "SPA",
            target: "SPA"
        });
        menus++;
    }
    if (top.EXPERIENCE) {
        a.push({
            "class": "menuExperienceIcon",
            "txtLabel": "Experience",
            target: "EXPERIENCE"
        });
        menus++;
    }
    if (top.NEWSNPROMO) {
        a.push({
            "class": "menuNewsnpromoIcon",
            "txtLabel": "News & Promotions",
            target: "NEWSNPROMO"
        });
        menus++;
    }
    if (top.SERVICES) {
        a.push({
            "class": "menuServiceIcon",
            "txtLabel": "SERVICES",
            target: "SERVICE"
        });
        menus++;
    }
    if (top.MESSAGES) {
        a.push({
            "class": "menuMessageIcon",
            "txtLabel": "Messages",
            target: "MESSAGE"
        });
        menus++;
    }
    if (top.LAN_CHNGE) {
        a.push({
            "class": "menuLanguageIconE",
            "txtLabel": "",
            target: "CHNGE_LANG"
        });
        menus++;
    }
    return a;
}

function menuInitMainList() {
    if (top.DEFAULT_DIRECTION == "ltr") {
        menuMainList = new top.List(top.ListType.SCROLL, menuGetMenuListData(), 0, 0, 0, menus, document.getElementById("menuMainListContainer"))
    } else {
        menuMainList = new top.List(top.ListType.SCROLL, menuGetMenuListData_R(), 0, 0, 0, menus, document.getElementById("menuMainListContainer"))
    }
    menuMainList.displayItem = menuMainListDisplayItem;
    menuMainList.initList();
}

function menuInitNewsListLoader() {
    if (top.NewsManager.isNewData || enteringMenu == 0) {
        top.NewsManager.isNewData = false;
        menuNewsList = new top.List(top.ListType.SCROLL_CYCLIC, top.NewsManager.getData(), 0, 0, 0, 1, document.getElementById("menuNewsListContainer"));
        menuNewsList.displayItem = menuNewsListDisplayItem;
        menuNewsList.initList();
        top.kwTimer.cancelTimer("NEWS_SCROLL_DELAY");
        this.menuInitNewsTimer();
    }
    top.kwTimer.setTimer("NEWS_REFRESH_TIMEOUT", {
        scope: this,
        callback: menuInitNewsListLoader
    }, top.NEWS_REFRESH_TIMEOUT, true);
}

function menuInitNewsTimer() {
    if (menuNewsList.getLength() > 1) {
        menuNewsList.scrollUp();
    }
    top.kwTimer.setTimer("NEWS_SCROLL_DELAY", {
        scope: this,
        callback: menuInitNewsTimer
    }, top.NEWS_SCROLL_DELAY, true);
}

function menuInitNewsTapeListLoader() {
    if (top.TickerTapeManager.isNewData || enteringMenu == 0) {
        top.TickerTapeManager.isNewData = false;
        menuNewsTapeList = new top.List(top.ListType.SCROLL_CYCLIC, top.TickerTapeManager.getData(), 0, 0, 0, 1, document.getElementById("homefooterContainer"));
        menuNewsTapeList.displayItem = menuNewsTapeListDisplayItem;
        menuNewsTapeList.initList();
        top.kwTimer.cancelTimer("NEWSTAPE_SCROLL_DELAY");
        this.menuInitNewsTapeTimer();
    }
    top.kwTimer.setTimer("NEWSTAPE_REFRESH_TIMEOUT", {
        scope: this,
        callback: menuInitNewsTapeListLoader
    }, top.NEWSTAPE_REFRESH_TIMEOUT, true);
}

function menuInitNewsTapeTimer() {
    if (menuNewsTapeList.getLength() > 1) {
        menuNewsTapeList.scrollUp();
    }
    top.kwTimer.setTimer("NEWSTAPE_SCROLL_DELAY", {
        scope: this,
        callback: menuInitNewsTapeTimer
    }, top.NEWSTAPE_SCROLL_DELAY, true);
}

// function menuInitWeatherListLoader() {
//     if (top.WeatherManager.isNewData == true || enteringMenu == 0) {
//         top.WeatherManager.isNewData = false;
//         menuWeatherList = new top.List(top.ListType.SCROLL_CYCLIC, top.WeatherManager.getData(), 0, 0, 0, 1, document.getElementById("homeweather"));
//         menuWeatherList.displayItem = menuWeatherListDisplayItem;
//         menuWeatherList.initList();
//         this.menuInitWeatherTimer();
//     }
//     top.kwTimer.setTimer("WEATHER_REFRESH_TIMEOUT", {
//         scope: this,
//         callback: menuInitWeatherListLoader
//     }, top.WEATHER_REFRESH_TIMEOUT, true);
// }
//
// function menuInitWeatherTimer() {
//    if (menuWeatherList.getLength() > 1) {
//        menuWeatherList.scrollUp();
//    }
//    top.kwTimer.setTimer("WEATHER_SCROLL_DELAY", {
//        scope: this,
//        callback: menuInitWeatherTimer
//    }, top.WEATHER_SCROLL_DELAY, true);
// }
ScrollChars = 1;

function loadNewsString() {
    if (top.TickerTapeManager.isNewData) {
        top.kwConsole.print("Ticker Tape New Data Available");
        top.TickerTapeManager.isNewData = false;
        menuNewsString = top.TickerTapeManager.tickerStr;
        document.getElementById("scrollInput").value = menuNewsString;
        top.kwTimer.cancelTimer("TTAPE_SCROLLER");
        ScrollNewsMarquee();
    }
    top.kwTimer.setTimer("TTAPE_REFRESH_TIMEOUT", {
        scope: this,
        callback: loadNewsString
    }, top.TTAPE_REFRESH_TIMEOUT, true);
}

function ScrollNewsMarquee() {
    var a = document.getElementById("scrollInput").value;
    top.kwConsole.print(a.substring(ScrollChars) + a.substring(0, ScrollChars));
    document.getElementById("scrollInput").value = a.substring(ScrollChars) + a.substring(0, ScrollChars);
    top.kwTimer.setTimer("TTAPE_SCROLLER", {
        scope: this,
        callback: ScrollNewsMarquee
    }, top.TTAPE_SCROLL_DELAY, true);
}

function highlightTopMainMenu() {
    // // var current_menu_id = top.PRV_MENU_ID;
    // // var selected_menu_id = top.CURRENT_MENU_ID;
    // // var menu_id = document.getElementsByClassName("menuMainListItem")[selected_menu_id];
    // // var current_class = menu_id.className;

    // var new_class = current_class + "Selected";
    // var prev_menu_id = document.getElementsByClassName("menuMainListItem")[0];
    // var prev_class = prev_menu_id.className;
    // prev_class = prev_class.replace('Selected', '');
    // prev_menu_id.className = prev_class;
    // menu_id.className = new_class;
}

