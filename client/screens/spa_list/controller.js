var spaListSubMenuList = null;
var spaList = null;
var spaListInitType = null;
var spaListInitLetter = null;
var spaListInitGenreId = null;

function spaEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            top.changeBackgroundImg('SPA');
            initInfoVars();
            spaListInitScreen(d.args);
            break;
        case "UNINIT_SCREEN":
            spaListUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.LOCAL_LIST_MAIN:
                    c = spaListMainEventHandler(d);
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

function spaListMainEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "ltr") ? spaList.scrollUp(1) : spaList.scrollDown(1);
            setCurrentLocal();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "ltr") ? spaList.scrollDown(1) : spaList.scrollUp(1);
            setCurrentLocal();
            break;
        case "KEY_UP":
            // spaList.scrollUp(1);
            // setCurrentLocal();
            // Navigating to correct Menu ID
            top.State.setState(top.State.MENU_MAIN);
            var correct_menu_id = top.PRV_MENU_ID - top.CURRENT_MENU_ID;
            if (correct_menu_id != 0) {
                menuMainList.scrollDown(correct_menu_id);
            }
            break;
        case "KEY_DOWN":
            // spaList.scrollDown(1);
            // setCurrentLocal();
            top.State.setState(top.State.LOCAL_LIST_MAIN);
            break;
        case "KEY_BACK":
            break;
        case "KEY_GREEN":
            break;
        case "KEY_SELECT":
            top.ScreenManager.load("LOCAL_DETAIL");
            break;
        default:
            c = false;
            break
    }
    return c
}

function setCurrentLocal() {
    top.SpaInfoManager.setCurrentSpaMenu(spaList.getItem())
}

function spaListActionHandler(c, d) {
    switch (c) {
    }
}

function spaListInitScreen(b) {
    top.State.setState(top.State.LOCAL_LIST_MAIN);
    top.ScreenManager.displayScreen(spaListGetScreenHtml());
    top.Clock.show(this, "globalClock");
    if (b) {
        spaListInitType = b.type || null;
        spaListInitLetter = b.letter || null;
        spaListInitGenreId = b.genreId || null
    }
    top.CURRENT_MENU_ID = 0;
    clearInterval(top.GLOBAL_SLIDER_INTERVAL);
    clearInterval(top.GLOBAL_PROMOTION_INTERVAL);
    menuInitMainList();
    highlight_menu_spa();
    menuInitWeatherListLoader();
    getSpaPromotionData();
    spaListInitMainList();


}

function spaListUninitScreen() {
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
    spaListSubMenuList = null;
    delete spaListSubMenuList;
    spaListSubMenuList = undefined;
    spaList = null;
    delete spaList;
    spaList = undefined;
    spaListInitType = null;
    delete spaListInitType;
    spaListInitType = undefined;
    spaListInitLetter = null;
    delete spaListInitLetter;
    spaListInitLetter = undefined;
    spaListInitGenreId = null;
    delete spaListInitGenreId;
    spaListInitGenreId = undefined
}

function initInfoVars() {
    spaListSubMenuList = null;
    spaList = null;
    spaListInitType = null;
    spaListInitLetter = null;
    spaListInitGenreId = null
}

function spaListInitMainList() {
    var b = [];
    spaList = new top.List(top.ListType.BLOCK, top.SpaInfoManager.spaArray, 0, 0, 0, top.SPAINFO_LEFT_NAV_ROWS, document.getElementById("spaListContainer"));
    spaList.displayItem = spaListDisplayItem;
    spaList.displayEmptyList = spaListDisplayEmptyList;
    spaList.display = spaListDisplay;
    spaList.onBeforeDisplay = spaListShowHighlight;
    spaList.onIndexChanged = spaListOnIndexChanged;
    spaList.onAfterDisplay = spaListOnAfterDisplay;
    spaList.initList();
    heighlight_first_menu_spa();
    setCurrentSpa();

}

//Spa Promotions
function getSpaPromotionData(){
    var json_url = top.TICKER_MEDIA_URL+"en/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", json_url, true, this, myFunctionSpa);


}

function myFunctionSpa(jsonString) {

    var json = top.jsonParser(jsonString);
    var promotions;

    for (var i = 0; i < json.length; i++) {
      var promo_type = json[i].restaurant_id;
      if (promo_type == "SPA") {
        promotions = json[i].ticker_promo_txt;
      }
    }
    spaPromDisplayItem(promotions);

}
//End Of Spa promotions


function highlight_menu_spa(){
    
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

function  heighlight_first_menu_spa(){
    var element = document.getElementsByClassName("spaListItem")[0];
    element.style.backgroundColor = "#B78D49";
};
