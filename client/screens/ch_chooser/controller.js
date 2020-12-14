var chChooserSubMenuList = null;
var chChooserAlphaList = null;
var chChooserGenreList = null;

function chChooserEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            top.changeBackgroundImg('TV');
            initChChooserVars();
            chChooserInitScreen(d.args);
            break;
        case "UNINIT_SCREEN":
            chChooserUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.CH_CHOOSER_ALPHA:
                    c = chChooserAlphaEventHandler(d);
                    break;
                case top.State.CH_CHOOSER_GENRE:
                    c = chChooserGenreEventHandler(d);
                    break;
                case top.State.CH_SUBMENU:
                    c = chChooserSubMenuEventHandler(d);
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

function chChooserAlphaEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_LEFT":
            chChooserAlphaList.scrollUp();
            break;
        case "KEY_RIGHT":
            chChooserAlphaList.scrollDown();
            break;
        case "KEY_BACK":
            top.State.setState(top.State.CH_SUBMENU);
            chChooserGenreListHideHighlight();
            chChooserAlphaList.display();
            chChooserSubMenuList.display();
            break;
        case "KEY_SELECT":
            if (chChooserAlphaList.getItem()) {
                top.ScreenManager.load("CH_LIST", {
                    type: "alpha",
                    letter: chChooserAlphaList.getItem().letter
                })
            }
            break;
        default:
            c = false;
            break
    }
    return c
}

function chChooserGenreEventHandler(e) {

    var c = true;
    var f = e.code;
    if (f == "KEY_UP" && (chChooserGenreList.getIndex() < top.CATEGORY_COLUMNS)) {
        f = "KEY_BACK"
    }
    switch (f) {
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "rtl") ? chChooserGenreList.scrollDown() : chChooserGenreList.scrollUp();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "rtl") ? chChooserGenreList.scrollUp() : chChooserGenreList.scrollDown();
            break;
        case "KEY_UP":
            if ((chChooserGenreList.getIndex() - top.CATEGORY_COLUMNS) >= 0) {
                chChooserGenreList.scrollUp(top.CATEGORY_COLUMNS)
            }
            break;
        case "KEY_DOWN":
            if ((chChooserGenreList.getIndex() + top.CATEGORY_COLUMNS) < chChooserGenreList.getLength()) {
                chChooserGenreList.scrollDown(top.CATEGORY_COLUMNS)
            }
            break;
        case "KEY_BACK":
            top.State.setState(top.State.CH_SUBMENU);
            chChooserGenreListHideHighlight();
            chChooserSubMenuList.display();
            break;
        case "KEY_SELECT":
            if (chChooserGenreList.getItem()) {
                top.ChannelManager.clearChannelList();
                top.DEFAULT_CHANNEL_CATEGORY = chChooserGenreList.getItem().id;
                top.ChannelManager.chChooserLoadChannels(chChooserGenreList.getItem().id)
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

function chChooserSubMenuEventHandler(d) {
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
            chChooserSubMenuList.scrollUp();
            break;
        case "KEY_RIGHT":
            chChooserSubMenuList.scrollDown();
            break;
        case "KEY_DOWN":
            top.State.setState(top.State.CH_CHOOSER_GENRE);
            chChooserGenreListShowHighlight();
            chChooserSubMenuList.display();
            break;
        case "KEY_SELECT":
            top.CURRENT_MENU_ID = 0;
            top.CURRENT_MENU = chChooserSubMenuList.getItem().args.type;
            if (chChooserSubMenuList.getItem()) {
                if (chChooserSubMenuList.getItem().args.type == "all") {
                    top.ChannelManager.clearChannelList();
                    top.DEFAULT_CHANNEL_CATEGORY = 0;
                    top.ChannelManager.chChooserLoadChannels(top.DEFAULT_CHANNEL_CATEGORY)
                } else {
                    if (chChooserSubMenuList.getItem().args.type == "alpha") {
                        top.ChannelManager.clearChannelList();
                        top.ChannelManager.loadFavouriteChannel()
                    } else {
                        top.ScreenManager.load(chChooserSubMenuList.getItem().target, chChooserSubMenuList.getItem().args)
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

function chChooserActionHandler(c, d) {
    switch (c) {
    }
}

function chChooserInitScreen(b) {
    top.ScreenManager.displayScreen(chChooserGetScreenHtml());
    top.Player.setClipScreen();
    if (top.ChannelManager.getCurrentChannel()) {
        top.kwConsole.print("chChooserInitScreen :: " + top.ChannelManager.getCurrentChannel().mrl);
        top.Player.play(top.ChannelManager.getCurrentChannel().mrl);
    }
    top.Clock.show(this, "globalClock");
    if (b && b.type == "genre") {
        top.State.setState(top.State.CH_CHOOSER_GENRE);
        this.chChooserInitGenreList()
    } else {
        if (b && b.type == "all") {
            top.State.setState(top.State.CH_CHOOSER_ALPHA);
            this.chChooserInitAlphaList("all")
        } else {
            top.State.setState(top.State.CH_CHOOSER_ALPHA);
            this.chChooserInitAlphaList("fav")
        }
    }
    top.CURRENT_MENU_ID = 0;
    clearInterval(top.GLOBAL_SLIDER_INTERVAL);
    clearInterval(top.GLOBAL_PROMOTION_INTERVAL);
    menuInitMainList();
    highlight_menu_ch_chooser();
    menuInitWeatherListLoader();
    this.chChooserInitSubMenuList();
    get_TV_chooserPromotionData();
}

function chChooserUninitScreen() {
    top.Clock.stop();
    top.kwTimer.cancelTimer("WEATHER_SCROLL_DELAY");
    top.kwTimer.cancelTimer("WEATHER_REFRESH_TIMEOUT");
    if (top.SOCKET_SUPPORT == 1) {
        top.ListenerManager.stopWeatherLoad();
    }
    top.WeatherManager.isNewData = true;
    setToBinChChooser();
    top.kwConsole.print("chChooserUnloadScreen")
}

function chChooserGetSubMenuData() {
    var b = [];
    b.push({
        "class": "chSubMenuAllIcon",
        "txtLabel": "All Channels",
        target: "CH_LIST",
        args: {
            type: "all"
        }
    });
    b.push({
        "class": "chSubMenuGenreIcon",
        "txtLabel": "Genre Listing",
        target: "CH_CHOOSER",
        args: {
            type: "genre"
        }
    });
    b.push({
        "class": "chSubMenuAlphabetIcon",
        "txtLabel": "Favourites",
        target: "CH_CHOOSER",
        args: {
            type: "alpha"
        }
    });
    return b
}


function chChooserGetAlphaData() {
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
        letter: "W"
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

function chChooserInitSubMenuList() {
    chChooserSubMenuList = new top.List(top.ListType.BLOCK, chChooserGetSubMenuData(), 0, 0, 0, 3, document.getElementById("chChooserSubMenuListContainer"));
    chChooserSubMenuList.displayItem = chChooserSubMenuListDisplayItem;
    chChooserSubMenuList.initList()
}

function chChooserInitGenreList() {
    tl = top.CATEGORY_COLUMNS * top.CATEGORY_ROWS;
    chChooserGenreList = new top.List(top.ListType.BLOCK, top.ChannelManager.getCategoriesData(), 0, 0, 0, tl, document.getElementById("chChooserListContainer"));
    chChooserGenreList.displayItem = chChooserGenreListDisplayItem;
    chChooserGenreList.display = chChooserGenreListDisplay;
    chChooserGenreList.onBeforeDisplay = chChooserGenreListShowHighlight;
    chChooserGenreList.onIndexChanged = chChooserGenreListOnIndexChanged;
    chChooserGenreList.onAfterDisplay = chChooserGenreListDisplayTotal;
    chChooserGenreList.initList()
}

function chChooserInitAlphaList(a) {
    top.ChannelManager.clearChannelList();
    top.ChannelManager.loadFavouriteChannel()
}

function setToBinChChooser() {
    chChooserSubMenuList = null;
    delete chChooserSubMenuList;
    chChooserSubMenuList = undefined;
    chChooserAlphaList = null;
    delete chChooserAlphaList;
    chChooserAlphaList = undefined;
    chChooserGenreList = null;
    delete chChooserGenreList;
    chChooserGenreList = undefined
}

function initChChooserVars() {
    chChooserSubMenuList = null;
    chChooserAlphaList = null;
    chChooserGenreList = null
}

function highlight_menu_ch_chooser() {
    var current_menu_id = top.CURRENT_MENU_ID;
    var selected_menu_id = top.PRV_MENU_ID;

    var menu_id = document.getElementsByClassName("menuMainListItem")[selected_menu_id]; //
    var current_class = menu_id.className;
    var new_class = current_class + "Selected";
    var prev_menu_id = document.getElementsByClassName("menuMainListItem")[current_menu_id];
    var prev_class = prev_menu_id.className;
    prev_class = prev_class.replace('Selected', '');
    prev_menu_id.className = prev_class;
    menu_id.className = new_class;
}


//TV Promotions
function get_TV_chooserPromotionData() {

    var json_url = top.TICKER_MEDIA_URL + "en/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", json_url, true, this, myFunctionTVChooser);


}

function myFunctionTVChooser(jsonString) {

    var json = top.jsonParser(jsonString);
    var promotions;

    for (var i = 0; i < json.length; i++) {
        var promo_type = json[i].restaurant_id;
        if (promo_type == "DINE") {
            promotions = json[i].ticker_promo_txt;
        }
    }
    tv_chooser_PromDisplayItem(promotions);

}
//End Of TV promotions
