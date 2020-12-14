var serviceListSubMenuList = null;
var serviceList = null;
var serviceListInitType = null;
var serviceListInitLetter = null;
var serviceListInitGenreId = null;

function serviceListEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            //top.changeBackgroundImg('SERVICES');
            top.BG_IMG = 'url(' + top.IMAGES_PREFIX + 'BGS/' + top.BACKGROUND_ARRAY['SERVICES'] + ')';
            initInfoVars();
            serviceListInitScreen(d.args);
            break;
        case "UNINIT_SCREEN":
            serviceListUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.SERVICELIST_MAIN:
                    c = serviceListMainEventHandler(d);
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

function serviceListMainEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "ltr") ? serviceList.scrollUp(1) : serviceList.scrollDown(1);
            setCurrentServiceList();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "ltr") ? serviceList.scrollDown(1) : serviceList.scrollUp(1);
            setCurrentServiceList();
            break;
        case "KEY_UP":
            // serviceList.scrollUp(1);
            // setCurrentLocal();
            top.State.setState(top.State.MENU_MAIN);
            var correct_menu_id = top.PRV_MENU_ID - top.CURRENT_MENU_ID;
            if (correct_menu_id != 0) {
                menuMainList.scrollDown(correct_menu_id);
            }
            break;
        case "KEY_DOWN":
            // serviceList.scrollDown(1);
            // setCurrentLocal();
            top.State.setState(top.State.SERVICELIST_MAIN);
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

function setCurrentServiceList() {
    top.ServiceListManager.setCurrentServiceListMenu(serviceList.getItem())
}

function serviceListActionHandler(c, d) {
    switch (c) {
    }
}

function serviceListInitScreen(b) {
    top.State.setState(top.State.SERVICELIST_MAIN);
    top.ScreenManager.displayScreen(serviceListGetScreenHtml());
    top.Clock.show(this, "globalClock");
    if (b) {
        serviceListInitType = b.type || null;
        serviceListInitLetter = b.letter || null;
        serviceListInitGenreId = b.genreId || null
    }
    top.CURRENT_MENU_ID = 0;
    clearInterval(top.GLOBAL_SLIDER_INTERVAL);
    clearInterval(top.GLOBAL_PROMOTION_INTERVAL);
    menuInitMainList();
    highlight_menu_services();
    menuInitWeatherListLoader();
    //getServiceListPromotionData();
    serviceListInitMainList();

}

function serviceListUninitScreen() {
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
    serviceListSubMenuList = null;
    delete serviceListSubMenuList;
    serviceListSubMenuList = undefined;
    serviceList = null;
    delete serviceList;
    serviceList = undefined;
    serviceListInitType = null;
    delete serviceListInitType;
    serviceListInitType = undefined;
    serviceListInitLetter = null;
    delete serviceListInitLetter;
    serviceListInitLetter = undefined;
    serviceListInitGenreId = null;
    delete serviceListInitGenreId;
    serviceListInitGenreId = undefined
}

function initInfoVars() {
    serviceListSubMenuList = null;
    serviceList = null;
    serviceListInitType = null;
    serviceListInitLetter = null;
    serviceListInitGenreId = null
}


//Local Info Promotions
function getServiceListPromotionData(){

    var json_url = top.TICKER_MEDIA_URL+"en/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", json_url, true, this, myFunctionLocal);

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





function serviceListInitMainList() {
    var b = [];
    serviceList = new top.List(top.ListType.BLOCK, top.ServiceListManager.serviceListArray, 0, 0, 0, top.SERVICELIST_LEFT_NAV_ROWS, document.getElementById("serviceListContainer"));
    serviceList.displayItem = serviceListDisplayItem;
    serviceList.displayEmptyList = serviceListDisplayEmptyList;
    serviceList.display = serviceListDisplay;
    serviceList.onBeforeDisplay = serviceListShowHighlight;
    serviceList.onIndexChanged = serviceListOnIndexChanged;
    serviceList.onAfterDisplay = serviceListOnAfterDisplay;
    serviceList.initList();
    heighlight_first_menu();
    setCurrentLocal()
}


function highlight_menu_services(){
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

function  heighlight_first_menu(){
    var element = document.getElementsByClassName("serviceListItem")[0];
    element.style.backgroundColor = "#B78D49";
};
