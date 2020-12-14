var radioListInitType = null;
var radioListInitLetter = null;
var radioListInitGenreId = null;
var radioListSubMenuList = null;
var radioListChannelList = null;
var cfsvProgramList = null;
top.SCREEN_MODE = 0;

function radioListEventHandler(a) {
    var b = true;
    switch (a.code) {
        case "INIT_SCREEN":
            top.changeBackgroundImg('RADIO');
            radioListInitScreen(a.args);
            top.switchMuteDisplay(top.Player.isMute);
            break;
        case "UNINIT_SCREEN":
            radioListUninitScreen();
            top.SCREEN_MODE = 0;
            break;
        default:
            switch (top.State.getState()) {
                case top.State.RADIO_LIST_MAIN:
                    b = radioListMainEventHandler(a);
                    break;
                case top.State.RADIO_SUBMENU:
                    b = radioListSubMenuEventHandler(a);
                    break;
                case top.State.MENU_MAIN: // menu step 1
                    b = menuMainEventHandler(a);
                    break;
                default:
                    b = false;
                    break
            }
            break
    }
    return b
}

function radioListSubMenuEventHandler(a) {
    var b = true;
    switch (a.code) {
        case "KEY_UP": // menu step 2
            top.State.setState(top.State.MENU_MAIN);
            var correct_menu_id = top.PRV_MENU_ID - top.CURRENT_MENU_ID;
            if (correct_menu_id != 0) {
                menuMainList.scrollDown(correct_menu_id);
            }
            break;
        case "KEY_LEFT":
            radioListSubMenuList.scrollUp();
            break;
        case "KEY_RIGHT":
            radioListSubMenuList.scrollDown();
            break;
        case "KEY_DOWN":
            top.State.setState(top.State.RADIO_LIST_MAIN);
            radioListChannelListShowHighlight();
            radioListSubMenuList.display();
            break;
        case "KEY_SELECT":
            top.CURRENT_MENU_ID = 0;
            top.CURRENT_MENU = radioListSubMenuList.getItem().args.type;
            if (radioListSubMenuList.getItem()) {
                if (radioListSubMenuList.getItem().args.type == "all") {
                    top.RadioManager.clearChannelList();
                    top.DEFAULT_RADIO_CATEGORY = 0;
                    top.RadioManager.chChooserLoadChannels(top.DEFAULT_RADIO_CATEGORY)
                } else {
                    if (radioListSubMenuList.getItem().args.type == "alpha") {
                        top.RadioManager.loadFavouriteChannel()
                    } else {
                        top.ScreenManager.load(radioListSubMenuList.getItem().target, radioListSubMenuList.getItem().args)
                    }
                }
            }
            break;
        default:
            b = false;
            break
    }
    return b
}

function radioListMainEventHandler(d) {
    var j = true;
    var b = d.code;
    if (b == "KEY_UP" && (radioListChannelList.getIndex() < top.RADIO_COLUMNS)) {
        b = "KEY_BACK"
    }
    switch (b) {
        case "KEY_RADIO_UP":
        case "KEY_RADIO_DOWN":
            if (top.SCREEN_MODE == 1) {
                rcfsvChangeChannel(d)
            }
            break;
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "rtl") ? radioListChannelList.scrollDown() : radioListChannelList.scrollUp();
            setRadioCurrentChannelItem();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "rtl") ? radioListChannelList.scrollUp() : radioListChannelList.scrollDown();
            setRadioCurrentChannelItem();
            break;
        case "KEY_UP":
            if ((radioListChannelList.getIndex() - top.RADIO_COLUMNS) >= 0) {
                radioListChannelList.scrollUp(top.RADIO_COLUMNS);
                setRadioCurrentChannelItem();
                break
            } else {
                d.code = "KEY_BACK"
            }
        case "KEY_DOWN":
            if ((radioListChannelList.getIndex() + top.RADIO_COLUMNS) < radioListChannelList.getLength()) {
                radioListChannelList.scrollDown(top.RADIO_COLUMNS);
                setRadioCurrentChannelItem()
            }
            break;
        case "KEY_YELLOW":
            var a = radioListChannelList.getItem().id;
            favChannels_URL = top.RADIOS_SETFAVURL + "user/" + top.USER_ID + "/channel/" + a;
            top.RadioManager.setFavouriteChannel(favChannels_URL);
            rfavShowInfobar("Selected Radio Stream Added to Favourite List");
            rfavStartHidingInfobar();
            break;
        case "KEY_GREEN":
            top.Player.handleAlpha();
            break;
        case "KEY_RED":
            var a = radioListChannelList.getItem().channelNumber;
            var c = top.RADIOS_RMFAVURL + "user/" + top.USER_ID + "/channel/" + a;
            top.RadioManager.removeFavouriteChannel(c);
            top.RadioManager.clearChannelList();
            top.RadioManager.loadFavouriteChannel();
            break;
        case "KEY_BACK":
            if (top.SCREEN_MODE == 1) {
                top.SCREEN_MODE = 0
            } else {
                top.State.setState(top.State.RADIO_SUBMENU);
                radioListChannelListHideHighlight();
                radioListSubMenuList.display()
            }
            break;
        case "KEY_SELECT":
            if (radioListChannelList.getItem()) {
            }
            break;
        default:
            j = false;
            break
    }
    return j
}

function radioListActionHandler(b, a) {
    switch (b) {
    }
}

function radioListInitScreen(a) {
    top.State.setState(top.State.RADIO_LIST_MAIN);
    top.ScreenManager.displayScreen(radioListGetScreenHtml());
    try {
        if (top.RadioManager.getCurrentChannel()) {
            top.kwConsole.print("radioListInitScreen :: " + top.RadioManager.getCurrentChannel().url);
            top.Player.play(top.RadioManager.getCurrentChannel().url);
            top.Player.setClipScreenMin();
            document.getElementById("chName").innerHTML = top.RadioManager.getCurrentChannel().name;
            document.getElementById("logo").src = "http://" + top.ip + "/" + top.APPNAME + "/icons/RADIO/radio.png";//top.RadioManager.getCurrentChannel().icon
        }
    } catch (d) {
        top.kwConsole.print("Chlist > radioListInitScreen:" + d)
    }
    top.Clock.show(this, "globalClock");
    if (a) {
        radioListInitType = a.type || null;
        radioListInitLetter = a.letter || null;
        radioListInitGenreId = a.genreId || null
    }
    top.CURRENT_MENU_ID = 0;
    clearInterval(top.GLOBAL_SLIDER_INTERVAL);
    clearInterval(top.GLOBAL_PROMOTION_INTERVAL);
    radioListInitSubMenuList();
    menuInitMainList();
    highlight_menu_radio_list();
    menuInitWeatherListLoader();
    getRadioPromotionData();
    radioListInitMainList();


}

function radioListInitSubMenuList() {
    radioListSubMenuList = new top.List(top.ListType.BLOCK, radioListGetSubMenuData(), 0, 0, 0, 3, document.getElementById("radioListSubMenuListContainer"));
    radioListSubMenuList.displayItem = radioListSubMenuListDisplayItem;
    radioListSubMenuList.initList()
}

function radioListGetSubMenuData() {
    var a = [];
    a.push({
        "class": "chSubMenuAllIcon",
        "txtLabel": "All Channels",
        target: "RADIO_LIST",
        args: {
            type: "all"
        }
    });
    a.push({
        "class": "chSubMenuGenreIcon",
        "txtLabel": "Genre Listing",
        target: "RADIO_CHOOSER",
        args: {
            type: "genre"
        }
    });
    a.push({
        "class": "chSubMenuAlphabetIcon",
        "txtLabel": "Favourites",
        target: "RADIO_CHOOSER",
        args: {
            type: "alpha"
        }
    });
    return a
}

function radioListUninitScreen() {
    top.Clock.stop();
    top.kwTimer.cancelTimer("WEATHER_SCROLL_DELAY");
    top.kwTimer.cancelTimer("WEATHER_REFRESH_TIMEOUT");
    if (top.SOCKET_SUPPORT == 1) {
        top.ListenerManager.stopWeatherLoad();
    }
    top.WeatherManager.isNewData = true;
    setToBinRadioList();
    top.Player.stop();
    top.kwTimer.cancelTimer("HIDE_RADIO_ZAPPER")
}

function radioListInitMainList() {
    try {
        tl = top.RADIO_COLUMNS * top.RADIO_ROWS;
        radioListChannelList = new top.List(top.ListType.BLOCK, top.RadioManager.getChannelList(), 0, 0, 0, tl, document.getElementById("radioListChannelListContainer"));
        radioListChannelList.displayItem = radioListChannelListDisplayItem;
        radioListChannelList.display = radioListChannelListDisplay;
        radioListChannelList.onBeforeDisplay = radioListChannelListShowHighlight;
        radioListChannelList.onIndexChanged = radioListChannelListOnIndexChanged;
        radioListChannelList.onAfterDisplay = radioListChannelListDisplayTotal;
        radioListChannelList.initList()
    } catch (b) {
        top.kwConsole.print("Chlist > radioListInitMainList:" + b)
    }
}

function setRadioCurrentChannelItem() {
    if (radioListChannelList.getItem()) {
        top.RadioManager.setCurrentChannel(radioListChannelList.getItem())
    }
    if (top.RadioManager.getCurrentChannel()) {
        top.kwConsole.print("setRadioCurrentChannelItem :: " + top.RadioManager.getCurrentChannel().url);
        top.Player.play(top.RadioManager.getCurrentChannel().url);
        top.Player.setClipScreenMin();
        document.getElementById("chName").innerHTML = top.RadioManager.getCurrentChannel().name;
        document.getElementById("logo").src = "http://" + top.ip + "/" + top.APPNAME + "/icons/RADIO/radio.png";//top.RadioManager.getCurrentChannel().icon
    }
}

function rhideChannelNumber() {
    document.getElementById("globalChannelZapper").innerHTML = "";
    top.kwTimer.cancelTimer("HIDE_RADIO_ZAPPER")
}

function rshowChannel() {
    var b = "<html><body><p class='globalChannelZapper'>";
    b += top.RadioManager.getCurrentChannel().channelNumber;
    b += "</p></body></html>";
    document.getElementById("globalChannelZapper").innerHTML = b;
    top.kwTimer.setTimer("HIDE_RADIO_ZAPPER", {
        scope: this,
        callback: rhideChannelNumber
    }, 5000)
}

function rcfsvChangeChannel(b) {

    var a = b && b.code ? b.code : null;
    switch (a) {
        case "KEY_RADIO_UP":
            top.RadioManager.channelUp(true);
            rshowChannel();
            break;
        case "KEY_RADIO_DOWN":
            top.RadioManager.channelDown(true);
            rshowChannel();
            break
    }
}



function highlight_menu_radio_list(){
    var current_menu_id =  top.CURRENT_MENU_ID;
    var selected_menu_id = top.PRV_MENU_ID;
    var  menu_id = document.getElementsByClassName("menuMainListItem")[selected_menu_id]; //
    var current_class = menu_id.className;
    var new_class = current_class +"Selected";
    var prev_menu_id = document.getElementsByClassName("menuMainListItem")[current_menu_id];
    var prev_class = prev_menu_id.className;
    prev_class = prev_class.replace('Selected','');
    prev_menu_id.className = prev_class;
    menu_id.className = new_class;
}

function setToBinRadioList() {}




//Radio Promotions
function getRadioPromotionData(){

    var json_url = top.TICKER_MEDIA_URL+"en/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", json_url, true, this, myFunctionRadio);


}

function myFunctionRadio(jsonString) {

    var json = top.jsonParser(jsonString);
    var promotions;

    for (var i = 0; i < json.length; i++) {
      var promo_type = json[i].restaurant_id;
      if (promo_type == "DINE") {
        promotions = json[i].ticker_promo_txt;
      }
    }
    radioPromDisplayItem(promotions);

};
//End Of Radio promotions
