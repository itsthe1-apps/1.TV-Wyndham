var radioChooserSubMenuList = null;
var radioChooserAlphaList = null;
var radioChooserGenreList = null;

function radioChooserEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            top.changeBackgroundImg('RADIO');
            initRadioChooserVars();
            radioChooserInitScreen(d.args);
            top.switchMuteDisplay(top.Player.isMute);
            break;
        case "UNINIT_SCREEN":
            radioChooserUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.RADIO_CHOOSER_ALPHA:
                    c = radioChooserAlphaEventHandler(d);
                    break;
                case top.State.RADIO_CHOOSER_GENRE:
                    c = radioChooserGenreEventHandler(d);
                    break;
                case top.State.RADIO_SUBMENU:
                    c = radioChooserSubMenuEventHandler(d);
                    break;
                case top.State.MENU_MAIN: // menu step 1
                    c = menuMainEventHandler(d);
                    break;
                default:
                    c = false;
                    break
            }
            break
    }
    return c
}

function radioChooserAlphaEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_LEFT":
            radioChooserAlphaList.scrollUp();
            break;
        case "KEY_RIGHT":
            radioChooserAlphaList.scrollDown();
            break;
        case "KEY_BACK":
            top.State.setState(top.State.RADIO_SUBMENU);
            radioChooserGenreListHideHighlight();
            radioChooserAlphaList.display();
            radioChooserSubMenuList.display();
            break;
        case "KEY_SELECT":
            if (radioChooserAlphaList.getItem()) {
                top.ScreenManager.load("RADIO_LIST", {
                    type: "alpha",
                    letter: radioChooserAlphaList.getItem().letter
                })
            }
            break;
        default:
            c = false;
            break
    }
    return c
}

function radioChooserGenreEventHandler(e) {
    var c = true;
    var f = e.code;
    if (f == "KEY_UP" && (radioChooserGenreList.getIndex() < top.RADIO_CAT_CLMNS)) {
        f = "KEY_BACK"
    }
    switch (f) {
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "rtl") ? radioChooserGenreList.scrollDown() : radioChooserGenreList.scrollUp();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "rtl") ? radioChooserGenreList.scrollUp() : radioChooserGenreList.scrollDown();
            break;
        case "KEY_UP":
            if ((radioChooserGenreList.getIndex() - top.RADIO_CAT_CLMNS) >= 0) {
                radioChooserGenreList.scrollUp(top.RADIO_CAT_CLMNS)
            }
            break;
        case "KEY_DOWN":
            if ((radioChooserGenreList.getIndex() + top.RADIO_CAT_CLMNS) < radioChooserGenreList.getLength()) {
                radioChooserGenreList.scrollDown(top.RADIO_CAT_CLMNS)
            }
            break;
        case "KEY_BACK":
            top.State.setState(top.State.RADIO_SUBMENU);
            radioChooserGenreListHideHighlight();
            radioChooserSubMenuList.display();
            break;
        case "KEY_SELECT":
            if (radioChooserGenreList.getItem()) {
                top.RadioManager.clearChannelList();
                top.DEFAULT_RADIO_CATEGORY = radioChooserGenreList.getItem().id;
                top.RadioManager.chChooserLoadChannels(radioChooserGenreList.getItem().id)
            }
            break;
        default:
            c = false;
            break
    }
    return c
}

function sleep() {
    return
}

function radioChooserSubMenuEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_UP": // menu step 2
            top.State.setState(top.State.MENU_MAIN);
            var correct_menu_id = top.PRV_MENU_ID - top.CURRENT_MENU_ID;
            if (correct_menu_id != 0) {
                menuMainList.scrollDown(correct_menu_id);
            }
            break;
        case "KEY_LEFT":
            radioChooserSubMenuList.scrollUp();
            break;
        case "KEY_RIGHT":
            radioChooserSubMenuList.scrollDown();
            break;
        case "KEY_DOWN":
            top.State.setState(top.State.RADIO_CHOOSER_GENRE);
            radioChooserGenreListShowHighlight();
            radioChooserSubMenuList.display();
            break;
        case "KEY_SELECT":
            top.CURRENT_MENU_ID = 0;
            top.CURRENT_MENU = radioChooserSubMenuList.getItem().args.type;
            if (radioChooserSubMenuList.getItem()) {
                if (radioChooserSubMenuList.getItem().args.type == "all") {
                    top.RadioManager.clearChannelList();
                    top.DEFAULT_RADIO_CATEGORY = 0;
                    top.RadioManager.chChooserLoadChannels(top.DEFAULT_RADIO_CATEGORY)
                } else {
                    if (radioChooserSubMenuList.getItem().args.type == "alpha") {
                        top.RadioManager.clearChannelList();
                        top.RadioManager.loadFavouriteChannel()
                    } else {
                        top.ScreenManager.load(radioChooserSubMenuList.getItem().target, radioChooserSubMenuList.getItem().args)
                    }
                }
            }
            break;
        default:
            c = false;
            break
    }
    return c
}

function radioChooserActionHandler(c, d) {
    switch (c) {
    }
}

function radioChooserInitScreen(b) {
    top.ScreenManager.displayScreen(radioChooserGetScreenHtml());
    top.Player.setClipScreen();
    if (top.RadioManager.getCurrentChannel()) {
        top.kwConsole.print("radioChooserInitScreen :: " + top.RadioManager.getCurrentChannel().mrl);
        top.Player.play(top.RadioManager.getCurrentChannel().mrl);
    }
    top.Clock.show(this, "globalClock");
    if (b && b.type == "genre") {
        top.State.setState(top.State.RADIO_CHOOSER_GENRE);
        this.radioChooserInitGenreList()
    } else {
        if (b && b.type == "all") {
            top.State.setState(top.State.RADIO_CHOOSER_ALPHA);
            this.radioChooserInitAlphaList("all")
        } else {
            top.State.setState(top.State.RADIO_CHOOSER_ALPHA);
            this.radioChooserInitAlphaList("fav")
        }
    }

    top.CURRENT_MENU_ID = 0;
    clearInterval(top.GLOBAL_SLIDER_INTERVAL);
    clearInterval(top.GLOBAL_PROMOTION_INTERVAL);
    menuInitMainList();
    highlight_menu_radio();
    menuInitWeatherListLoader();
    this.radioChooserInitSubMenuList();
    getRadioChooserPromotionData();



}

function radioChooserUninitScreen() {
    top.Clock.stop();
    top.kwTimer.cancelTimer("WEATHER_SCROLL_DELAY");
    top.kwTimer.cancelTimer("WEATHER_REFRESH_TIMEOUT");
    if (top.SOCKET_SUPPORT == 1) {
        top.ListenerManager.stopWeatherLoad();
    }
    top.WeatherManager.isNewData = true;
    setToBinRadioChooser();
    top.kwConsole.print("radioChooserUnloadScreen")
}

function radioChooserGetSubMenuData() {
    var b = [];
    b.push({
        "class": "chSubMenuAllIcon",
        "txtLabel": "All Channels",
        target: "RADIO_LIST",
        args: {
            type: "all"
        }
    });
    b.push({
        "class": "chSubMenuGenreIcon",
        "txtLabel": "Genre Listing",
        target: "RADIO_CHOOSER",
        args: {
            type: "genre"
        }
    });
    b.push({
        "class": "chSubMenuAlphabetIcon",
        "txtLabel": "Favourites",
        target: "RADIO_CHOOSER",
        args: {
            type: "alpha"
        }
    });
    return b
}

function radioChooserGetAlphaData() {
    var b = [];
    b.push({
        letter: "A"
    });
    b.push({
        letter: "B"
    });
    b.push({
        letter: "C"
    });
    b.push({
        letter: "D"
    });
    b.push({
        letter: "E"
    });
    b.push({
        letter: "F"
    });
    b.push({
        letter: "G"
    });
    b.push({
        letter: "H"
    });
    b.push({
        letter: "I"
    });
    b.push({
        letter: "J"
    });
    b.push({
        letter: "K"
    });
    b.push({
        letter: "L"
    });
    b.push({
        letter: "M"
    });
    b.push({
        letter: "N"
    });
    b.push({
        letter: "O"
    });
    b.push({
        letter: "P"
    });
    b.push({
        letter: "Q"
    });
    b.push({
        letter: "R"
    });
    b.push({
        letter: "S"
    });
    b.push({
        letter: "T"
    });
    b.push({
        letter: "U"
    });
    b.push({
        letter: "V"
    });
    b.push({
        letter: "X"
    });
    b.push({
        letter: "Y"
    });
    b.push({
        letter: "Z"
    });
    return b
}

function radioChooserInitSubMenuList() {
    radioChooserSubMenuList = new top.List(top.ListType.BLOCK, radioChooserGetSubMenuData(), 0, 0, 0, 3, document.getElementById("radioChooserSubMenuListContainer"));
    radioChooserSubMenuList.displayItem = radioChooserSubMenuListDisplayItem;
    radioChooserSubMenuList.initList()
}

function radioChooserInitGenreList() {
    tl = top.RADIO_CAT_CLMNS * top.RADIO_CAT_ROWS;
    radioChooserGenreList = new top.List(top.ListType.BLOCK, top.RadioManager.getCategoriesData(), 0, 0, 0, tl, document.getElementById("radioChooserListContainer"));
    radioChooserGenreList.displayItem = radioChooserGenreListDisplayItem;
    radioChooserGenreList.display = radioChooserGenreListDisplay;
    radioChooserGenreList.onBeforeDisplay = radioChooserGenreListShowHighlight;
    radioChooserGenreList.onIndexChanged = radioChooserGenreListOnIndexChanged;
    radioChooserGenreList.onAfterDisplay = radioChooserGenreListDisplayTotal;
    radioChooserGenreList.initList()
}

function radioChooserInitAlphaList(a) {
    top.RadioManager.clearChannelList();
    top.RadioManager.loadFavouriteChannel()
}

function setToBinRadioChooser() {
    radioChooserSubMenuList = null;
    delete radioChooserSubMenuList;
    radioChooserSubMenuList = undefined;
    radioChooserAlphaList = null;
    delete radioChooserAlphaList;
    radioChooserAlphaList = undefined;
    radioChooserGenreList = null;
    delete radioChooserGenreList;
    radioChooserGenreList = undefined
}

function initRadioChooserVars() {
    radioChooserSubMenuList = null;
    radioChooserAlphaList = null;
    radioChooserGenreList = null
}



function highlight_menu_radio(){
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


//Radio Chooser Promotions
function getRadioChooserPromotionData(){

    var json_url = top.TICKER_MEDIA_URL+"en/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", json_url, true, this, myFunctionRadioChooser);


}

function myFunctionRadioChooser(jsonString) {

    var json = top.jsonParser(jsonString);
    var promotions;

    for (var i = 0; i < json.length; i++) {
      var promo_type = json[i].restaurant_id;
      if (promo_type == "DINE") {
        promotions = json[i].ticker_promo_txt;
      }
    }
    radioChooserPromDisplayItem(promotions);

};
//End Of Radio Chooser promotions
