var chListInitType = null;
var chListInitLetter = null;
var chListInitGenreId = null;
var chListSubMenuList = null;
var chListChannelList = null;
var cfsvProgramList = null;
var menuNewsString = "";
var menuNewsList = null;


top.SCREEN_MODE = 0;
function chListEventHandler(d) {
    var c = true;
    switch (d.code) {
        case"INIT_SCREEN":
            // top.changeBackgroundImg('TV');
            top.BG_IMG = 'url(' + top.IMAGES_PREFIX + 'BGS/' + top.BACKGROUND_ARRAY['TV'] + ')';
            initChListVars();
            chListInitScreen(d.args);
            top.switchMuteDisplay(top.Player.isMute);
            break;
        case"UNINIT_SCREEN":
            chListUninitScreen();
            top.SCREEN_MODE = 0;
            break;
        default:
            switch (top.State.getState()) {
                case top.State.CH_LIST_MAIN:
                case top.State.CH_FAVLIST_MAIN:
                    c = chListMainEventHandler(d);
                    break;
                case top.State.CH_SUBMENU:
                    c = chListSubMenuEventHandler(d);
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
function chListSubMenuEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_UP": // menu step 2
            top.State.setState(top.State.MENU_MAIN);
            var correct_menu_id = top.PRV_MENU_ID - top.CURRENT_MENU_ID;
            if (correct_menu_id != 0) {
                menuMainList.scrollDown(correct_menu_id);
            }else if (correct_menu_id == 0) {

                var prev_menu_id = document.getElementsByClassName("menuMainListItem")[top.CURRENT_MENU_ID];
                var prev_class = prev_menu_id.className;
                prev_class = prev_class.replace('Semi_selected', '');
                prev_menu_id.className = prev_class;


                var menu_id = document.getElementsByClassName("menuMainListItem")[top.CURRENT_MENU_ID]; //
                var current_class = menu_id.className;
                var new_class = current_class + "Selected";
                menu_id.className = new_class;
            }

            break;
        case"KEY_LEFT":
            (top.DEFAULT_DIRECTION == "ltr") ? chListSubMenuList.scrollUp() : chListSubMenuList.scrollDown();
            //chListSubMenuList.scrollUp();
            break;
        case"KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "ltr") ? chListSubMenuList.scrollDown() : chListSubMenuList.scrollUp();
            //chListSubMenuList.scrollDown();
            break;
        case"KEY_DOWN":
            top.State.setState(top.State.CH_LIST_MAIN);
            chListChannelListShowHighlight();
            chListSubMenuList.display();
            break;
        case"KEY_SELECT":
            top.CURRENT_MENU_ID = 0;
            top.CURRENT_MENU = chListSubMenuList.getItem().args.type;
            if (chListSubMenuList.getItem()) {
                if (chListSubMenuList.getItem().args.type == "all") {
                    top.ChannelManager.clearChannelList();
                    top.DEFAULT_CHANNEL_CATEGORY = 0;
                    top.ChannelManager.chChooserLoadChannels(top.DEFAULT_CHANNEL_CATEGORY)
                } else {
                    if (chListSubMenuList.getItem().args.type == "alpha") {
                        top.ChannelManager.loadFavouriteChannel()
                    } else {
                        top.ScreenManager.load(chListSubMenuList.getItem().target, chListSubMenuList.getItem().args)
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
function chListMainEventHandler(h) {
    var g = true;
    var e = h.code;
    if (e == "KEY_UP" && (chListChannelList.getIndex() < top.CHANNEL_COLUMNS)) {
        if(top.SCREEN_MODE == 0){
            e = "KEY_BACK";
        }

    }
    switch (e) {
        case"KEY_CHANNEL_UP":
        case"KEY_CHANNEL_DOWN":
            if (top.SCREEN_MODE == 1) {
                cfsvChangeChannel(h);
            }
            break;
        case"KEY_LEFT":
            if (top.SCREEN_MODE == 0) {
                (top.DEFAULT_DIRECTION == "rtl") ? chListChannelList.scrollDown() : chListChannelList.scrollUp();
                setCurrentChannelItem();
            }

            break;
        case"KEY_RIGHT":
            if(top.SCREEN_MODE == 0){
                (top.DEFAULT_DIRECTION == "rtl") ? chListChannelList.scrollUp() : chListChannelList.scrollDown();
                setCurrentChannelItem();
            }
            break;
        case"KEY_UP":
            if(top.SCREEN_MODE == 0){
                if ((chListChannelList.getIndex() - top.CHANNEL_COLUMNS) >= 0) {
                    chListChannelList.scrollUp(top.CHANNEL_COLUMNS);
                    setCurrentChannelItem();
                    break
                } else {
                    h.code = "KEY_BACK"
                }
            }
        case"KEY_DOWN":
            if(top.SCREEN_MODE == 0){
                if ((chListChannelList.getIndex() + top.CHANNEL_COLUMNS) < chListChannelList.getLength()) {
                    chListChannelList.scrollDown(top.CHANNEL_COLUMNS);
                    setCurrentChannelItem();
                }
            }
            break;
        case"KEY_YELLOW":
            var f = chListChannelList.getItem().id;
            favChannels_URL = top.CHANNELS_SETFAVURL + "user/" + top.USER_ID + "/channel/" + f;
            top.ChannelManager.setFavouriteChannel(favChannels_URL);
            favShowInfobar("Selected Channel Added to Favourite List");
            favStartHidingInfobar();
            break;
        case"KEY_GREEN":
            top.Player.handleAlpha();
            break;
        case"KEY_RED":
            var f = chListChannelList.getItem().channelNumber;
            var i = top.CHANNELS_RMFAVURL + "user/" + top.USER_ID + "/channel/" + f;
            top.ChannelManager.removeFavouriteChannel(i);
            favShowInfobar("Selected Channel Will be Removed.");
            favStartHidingInfobar();
            break;
        case"KEY_BACK":
            if (top.SCREEN_MODE == 1) {
                top.SCREEN_MODE = 0;
                document.getElementById("bodyBG").style.visibility = "visible";
                document.getElementById("header").style.visibility = "visible";
                document.getElementById("footer").style.visibility = "visible";
                document.getElementById("chListChannelListHighlight").style.visibility = "visible";
                top.Player.setClipScreen(top.CLIP_Y, top.CLIP_X, top.CLIP_W, top.CLIP_H);
            } else {
                top.State.setState(top.State.CH_SUBMENU);
                chListChannelListHideHighlight();
                chListSubMenuList.display();
            }
            break;
        case"KEY_SELECT":
            if (chListChannelList.getItem()) {
                top.kwConsole.print("Full Screen Mode"+":::::::::::::Channel Number -");
                top.SCREEN_MODE = 1;

                document.getElementById("bodyBG").style.visibility = "hidden";
                document.getElementById("bodyBG").style.visibility = "hidden";
                document.getElementById("header").style.visibility = "hidden";
                document.getElementById("footer").style.visibility = "hidden";
                document.getElementById("chListChannelListHighlight").style.visibility = "hidden";
                top.Player.setFullScreen();
                top.Player.setAlphaLevel(top.TRANSPARENCY_LEVEL);
                top.switchMuteDisplay(top.Player.isMute);
            }
            break;
        case"EIT_LOADED":
            if (top.ChannelManager.getCurrentChannel() && top.ChannelManager.getCurrentChannel().id == h.args.channelId) {
                cfsvProgramListInit(h.args.programs)
            }
            break;
        default:
            g = false;
            break
    }
    return g
}
function chListActionHandler(c, d) {
    switch (c) {
    }
}
function chListInitScreen(b) {
    (b.type == "favourite") ? top.State.setState(top.State.CH_FAVLIST_MAIN) : top.State.setState(top.State.CH_LIST_MAIN);
    top.ScreenManager.displayScreen(chListGetScreenHtml());
    top.Clock.show(this, "globalClock");
    if (b) {
        chListInitType = b.type || null;
        chListInitLetter = b.letter || null;
        chListInitGenreId = b.genreId || null
    }

    top.CURRENT_MENU_ID = 0;
    clearInterval(top.GLOBAL_SLIDER_INTERVAL);
    clearInterval(top.GLOBAL_PROMOTION_INTERVAL);
    if (top.DEFAULT_LANGUAGE == 'en') {
        chListInitSubMenuList();
    }
    if (top.DEFAULT_LANGUAGE == 'ar') {
        chListInitSubMenuList_R();
    }
    chListInitMainList();

    this.setCurrentChannelItem();

    menuInitMainList();
    highlight_menu_tv();
    menuInitWeatherListLoader();
    getTVPromotionData();

}


function chListInitSubMenuList_R() {
    chListSubMenuList = new top.List(top.ListType.BLOCK, chListGetSubMenuData_R(), 0, 0, 0, 3, document.getElementById("chListSubMenuListContainer"));
    chListSubMenuList.displayItem = chListSubMenuListDisplayItem;
    chListSubMenuList.initList()
}
function chListGetSubMenuData_R() {
    var b = [];
    b.push({"class": "chSubMenuAllIcon", "txtLabel": "كل القنوات ", target: "CH_LIST", args: {type: "all"}});
    b.push({"class": "chSubMenuGenreIcon", "txtLabel": "قنوات مصنفة حسب النوع  ", target: "CH_CHOOSER", args: {type: "genre"}});
    b.push({"class": "chSubMenuAlphabetIcon", "txtLabel": "قنوات مفضلة ", target: "CH_CHOOSER", args: {type: "alpha"}});
    return b
}
//Added by Lakshan - 2017-09-12
function chListInitSubMenuList() {
    chListSubMenuList = new top.List(top.ListType.BLOCK, chListGetSubMenuData(), 0, 0, 0, 3, document.getElementById("chListSubMenuListContainer"));
    chListSubMenuList.displayItem = chListSubMenuListDisplayItem;
    chListSubMenuList.initList()
}
function chListGetSubMenuData() {
    var b = [];
    b.push({"class": "chSubMenuAllIcon", "txtLabel": "All Channels", target: "CH_LIST", args: {type: "all"}});
    b.push({"class": "chSubMenuGenreIcon", "txtLabel": "Genre Listing", target: "CH_CHOOSER", args: {type: "genre"}});
    b.push({"class": "chSubMenuAlphabetIcon", "txtLabel": "Favourites", target: "CH_CHOOSER", args: {type: "alpha"}});
    return b
}
function chListUninitScreen() {
    top.Clock.stop();
    top.kwTimer.cancelTimer("HIDE_CH_ZAPPER");
    top.kwTimer.cancelTimer("WEATHER_SCROLL_DELAY");
    top.kwTimer.cancelTimer("WEATHER_REFRESH_TIMEOUT");
    if (top.SOCKET_SUPPORT == 1) {
        top.ListenerManager.stopWeatherLoad();
    }
    top.WeatherManager.isNewData = true;
    setToBinChList();
    top.Player.stop();

}
function chListInitMainList() {
    try {
        tl = top.CHANNEL_ROWS * top.CHANNEL_COLUMNS;
        chListChannelList = new top.List(top.ListType.BLOCK, top.ChannelManager.getChannelList(), 0, 0, 0, tl, document.getElementById("chListChannelListContainer"));
        chListChannelList.displayItem = chListChannelListDisplayItem;
        chListChannelList.display = chListChannelListDisplay;
        chListChannelList.onBeforeDisplay = chListChannelListShowHighlight;
        chListChannelList.onIndexChanged = chListChannelListOnIndexChanged;
        chListChannelList.onAfterDisplay = chListChannelListDisplayTotal;
        chListChannelList.initList()
    } catch (a) {
        top.kwConsole.print("Chlist > chListInitMainList:" + a)
    }
}
function setCurrentChannelItem() {
    if (chListChannelList.getItem()) {
        top.ChannelManager.setCurrentChannel(chListChannelList.getItem());
        document.getElementById("chName").innerHTML = top.ChannelManager.getCurrentChannel().name
    }
    if (top.ChannelManager.getCurrentChannel()) {
        top.kwConsole.print("setCurrentChannelItem :: " + top.ChannelManager.getCurrentChannel().url);
        top.Player.play(top.ChannelManager.getCurrentChannel().url);
        top.Player.setClipScreen(top.CLIP_Y, top.CLIP_X, top.CLIP_W, top.CLIP_H);
    }
}
function hideChannelNumber() {
    document.getElementById("globalChannelZapper").innerHTML = "";
    top.kwTimer.cancelTimer("HIDE_CH_ZAPPER")
}
function showChannel() {
    var a = "<html><body><p class='globalChannelZapper'>";
    a += top.ChannelManager.getCurrentChannel().channelNumber;
    a += "</p></body></html>";
    document.getElementById("globalChannelZapper").innerHTML = a;
    top.kwTimer.setTimer("HIDE_CH_ZAPPER", {scope: this, callback: hideChannelNumber}, top.FSV_INFOBAR_TIMEOUT)
}



function cfsvChangeChannel(c) {
    var d = c && c.code ? c.code : null;
    switch (d) {
        case"KEY_CHANNEL_UP":
            top.ChannelManager.channelUp(true);
            top.Player.stop();
            top.Player.stop();
            // alert(top.ChannelManager.getCurrentChannel().url);
            // alert(top.SCREEN_MODE);
            top.Player.play(top.ChannelManager.getCurrentChannel().url);
            top.Player.setFullScreen();
            top.Player.setAlphaLevel(top.TRANSPARENCY_LEVEL);
            top.switchMuteDisplay(top.Player.isMute);
            showChannel();
            break;
        case"KEY_CHANNEL_DOWN":
            showChannel();
            top.ChannelManager.channelDown(true);
            top.Player.stop();
            top.Player.stop();
            //alert(top.ChannelManager.getCurrentChannel().url);
            top.Player.play(top.ChannelManager.getCurrentChannel().url);
            top.Player.setFullScreen();
            top.Player.setAlphaLevel(top.TRANSPARENCY_LEVEL);
            top.switchMuteDisplay(top.Player.isMute);
            showChannel();
            break
    }
}
function cfsvProgramListInit(b) {
    if (b.length < 2) {
        b.push({name: top.globalGetLabel("INFOBAR_INFORMATION_UNAVAILABLE")})
    }
    cfsvProgramList = new top.List(top.ListType.SCROLL, b, 0, 0, 0, 1, document.getElementById("cfsvProgramListContainer"));
    cfsvProgramList.displayItem = cfsvProgramListDisplayItem;
    cfsvProgramList.initList()
}
function setToBinChList() {
    chListInitType = null;
    delete chListInitType;
    chListInitType = undefined;
    chListInitLetter = null;
    delete chListInitLetter;
    chListInitLetter = undefined;
    chListInitGenreId = null;
    delete chListInitGenreId;
    chListInitGenreId = undefined;
    chListSubMenuList = null;
    delete chListSubMenuList;
    chListSubMenuList = undefined;
    chListChannelList = null;
    delete chListChannelList;
    chListChannelList = undefined;
    cfsvProgramList = null;
    delete cfsvProgramList;
    cfsvProgramList = undefined
}
function initChListVars() {
    chListInitType = null;
    chListInitLetter = null;
    chListInitGenreId = null;
    chListSubMenuList = null;
    chListChannelList = null;
    cfsvProgramList = null
}

function highlight_menu_tv() {
    if (top.KEY_TV_PRESSED == 1) {
        top.PRV_MENU_ID = 1;
    }
    var current_menu_id = top.CURRENT_MENU_ID;
    var selected_menu_id = top.PRV_MENU_ID;
    var menu_id = document.getElementsByClassName("menuMainListItem")[selected_menu_id]; //
    var current_class = menu_id.className;
    var new_class = current_class + "Semi_selected";
    var prev_menu_id = document.getElementsByClassName("menuMainListItem")[current_menu_id];
    var prev_class = prev_menu_id.className;
    prev_class = prev_class.replace('Selected', '');
    prev_menu_id.className = prev_class;
    menu_id.className = new_class;
}


//TV Promotions
function getTVPromotionData() {
    // var json_url = top.TICKER_MEDIA_URL + "en/format/json";
    // top.kwUtils.kwXMLHttpRequest("GET", json_url, true, this, myFunctionTV);
}

function myFunctionTV(jsonString) {

    var json = top.jsonParser(jsonString);
    var promotions;

    for (var i = 0; i < json.length; i++) {
        var promo_type = json[i].restaurant_id;
        if (promo_type == "DINE") {
            promotions = json[i].ticker_promo_txt;
        }
    }
    tvPromDisplayItem(promotions);

}


//Exit from player Added By Lakshan **************
function exit_from_screen(){
    if (top.SCREEN_MODE == 1 ) {
        top.SCREEN_MODE = 0;
        document.getElementById("bodyBG").style.visibility = "visible";
        document.getElementById("header").style.visibility = "visible";
        document.getElementById("footer").style.visibility = "visible";
        document.getElementById("chListChannelListHighlight").style.visibility = "visible";
        top.Player.setClipScreen(top.CLIP_Y, top.CLIP_X, top.CLIP_W, top.CLIP_H);
    }
}


//End Of TV promotions
