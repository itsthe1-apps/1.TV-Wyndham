var localListSubMenuList = null;
var localList = null;
var localListInitType = null;
var localListInitLetter = null;
var localListInitGenreId = null;

function localEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            // top.changeBackgroundImg('INFO');
            top.BG_IMG = 'url(' + top.IMAGES_PREFIX + 'BGS/' + top.BACKGROUND_ARRAY['INFO'] + ')';
            initInfoVars();
            localListInitScreen(d.args);
            break;
        case "UNINIT_SCREEN":
            localListUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.LOCAL_LIST_MAIN:
                    c = localListMainEventHandler(d);
                    break;
                case top.State.MENU_MAIN:
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

function localListMainEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "ltr") ? localList.scrollUp(1) : localList.scrollDown(1);
            setCurrentLocal();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "ltr") ? localList.scrollDown(1) : localList.scrollUp(1);
            setCurrentLocal();
            break;
        case "KEY_UP":
            // localList.scrollUp(1);
            // setCurrentLocal();
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
        case "KEY_DOWN":
            // localList.scrollDown(1);
            // setCurrentLocal();
            top.State.setState(top.State.LOCAL_LIST_MAIN);
            break;
        case "KEY_BACK":
            break;
        case "KEY_GREEN":
            break;
        case "KEY_SELECT":
            // top.ScreenManager.load("LOCAL_DETAIL");
            break;
        default:
            c = false;
            break
    }
    return c
}

function setCurrentLocal() {
    top.LocalInfoManager.setCurrentRestuarantMenu(localList.getItem())
}

function localListActionHandler(c, d) {
    switch (c) {
    }
}

function localListInitScreen(b) {
    top.State.setState(top.State.LOCAL_LIST_MAIN);
    top.ScreenManager.displayScreen(localListGetScreenHtml());
    top.Clock.show(this, "globalClock");
    if (b) {
        localListInitType = b.type || null;
        localListInitLetter = b.letter || null;
        localListInitGenreId = b.genreId || null
    }
    top.CURRENT_MENU_ID = 0;
    clearInterval(top.GLOBAL_SLIDER_INTERVAL);
    clearInterval(top.GLOBAL_PROMOTION_INTERVAL);
    menuInitMainList();
    highlight_menu_local();
    menuInitWeatherListLoader();
    getLocalPromotionData();
    localListInitMainList();

}

function localListUninitScreen() {
    top.Clock.stop();
    top.kwTimer.cancelTimer("WEATHER_SCROLL_DELAY");
    top.kwTimer.cancelTimer("WEATHER_REFRESH_TIMEOUT");
    if (top.SOCKET_SUPPORT == 1) {
        top.ListenerManager.stopWeatherLoad();
    }
    top.WeatherManager.isNewData = true;
    setToBinInfo()
}

function setToBinInfo() {
    localListSubMenuList = null;
    delete localListSubMenuList;
    localListSubMenuList = undefined;
    localList = null;
    delete localList;
    localList = undefined;
    localListInitType = null;
    delete localListInitType;
    localListInitType = undefined;
    localListInitLetter = null;
    delete localListInitLetter;
    localListInitLetter = undefined;
    localListInitGenreId = null;
    delete localListInitGenreId;
    localListInitGenreId = undefined
}

function initInfoVars() {
    localListSubMenuList = null;
    localList = null;
    localListInitType = null;
    localListInitLetter = null;
    localListInitGenreId = null
}


//Local Info Promotions
function getLocalPromotionData(){

    // var json_url = top.TICKER_MEDIA_URL+"en/format/json";
    // top.kwUtils.kwXMLHttpRequest("GET", json_url, true, this, myFunctionLocal);

}

function myFunctionLocal(jsonString) {

    var json = top.jsonParser(jsonString);
    var promotions;

    for (var i = 0; i < json.length; i++) {
      var promo_type = json[i].restaurant_id;
      if (promo_type == "LOCAL") {
        promotions = json[i].ticker_promo_txt;
      }
    }
    localPromDisplayItem(promotions);

}
//End Of Local Info Promotions





function localListInitMainList() {
    var b = [];
    localList = new top.List(top.ListType.BLOCK, top.LocalInfoManager.restuarantsArray, 0, 0, 0, top.LOCALINFO_LEFT_NAV_ROWS, document.getElementById("localListContainer"));
    localList.displayItem = localListDisplayItem;
    localList.displayEmptyList = localListDisplayEmptyList;
    localList.display = localListDisplay;
    localList.onBeforeDisplay = localListShowHighlight;
    localList.onIndexChanged = localListOnIndexChanged;
    localList.onAfterDisplay = localListOnAfterDisplay;
    localList.initList();
    heighlight_first_menu();
    setCurrentLocal()
}


function highlight_menu_local(){
    var current_menu_id =  top.CURRENT_MENU_ID;
    var selected_menu_id = top.PRV_MENU_ID;
    var  menu_id = document.getElementsByClassName("menuMainListItem")[selected_menu_id]; //
    var current_class = menu_id.className;
    var new_class = current_class +"Semi_selected";
    var prev_menu_id = document.getElementsByClassName("menuMainListItem")[current_menu_id];
    var prev_class = prev_menu_id.className;
    prev_class = prev_class.replace('Selected','');
    prev_menu_id.className = prev_class;
    menu_id.className = new_class;
}

function  heighlight_first_menu(){
    var element = document.getElementsByClassName("localListItem")[0];
    //element.style.backgroundColor = "#B78D49";
    element.className += " active";
};
