var expListSubMenuList = null;
var expList = null;
var expListInitType = null;
var expListInitLetter = null;
var expListInitGenreId = null;

function expEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            top.changeBackgroundImg('EXPERIENCE');
            initInfoVars();
            expListInitScreen(d.args);
            break;
        case "UNINIT_SCREEN":
            expListUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.LOCAL_LIST_MAIN:
                    c = expListMainEventHandler(d);
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

function expListMainEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "ltr") ? expList.scrollUp(1) : expList.scrollDown(1);
            setCurrentLocal();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "ltr") ? expList.scrollDown(1) : expList.scrollUp(1);
            setCurrentLocal();
            break;
        case "KEY_UP":
            // expList.scrollUp(1);
            // setCurrentLocal();
            // Navigating to correct Menu ID
            top.State.setState(top.State.MENU_MAIN);
            var correct_menu_id = top.PRV_MENU_ID - top.CURRENT_MENU_ID;
            if (correct_menu_id != 0) {
                menuMainList.scrollDown(correct_menu_id);
            }
            break;
        case "KEY_DOWN":
            // expList.scrollDown(1);
            // setCurrentLocal();
            top.State.setState(top.State.LOCAL_LIST_MAIN);
            break;
        case "KEY_BACK":
            break;
        case "KEY_GREEN":
            break;
        case "KEY_SELECT":
            //top.ScreenManager.load("LOCAL_DETAIL");
            break;
        default:
            c = false;
            break
    }
    return c
}

function setCurrentLocal() {
    top.ExperienceManager.setCurrentExpMenu(expList.getItem())
}

function expListActionHandler(c, d) {
    switch (c) {
    }
}

function expListInitScreen(b) {
    top.State.setState(top.State.LOCAL_LIST_MAIN);
    top.ScreenManager.displayScreen(expListGetScreenHtml());
    top.Clock.show(this, "globalClock");
    if (b) {
        expListInitType = b.type || null;
        expListInitLetter = b.letter || null;
        expListInitGenreId = b.genreId || null
    }
    top.CURRENT_MENU_ID = 0;
    clearInterval(top.GLOBAL_SLIDER_INTERVAL);
    clearInterval(top.GLOBAL_PROMOTION_INTERVAL);
    menuInitMainList();
    highlight_menu_exp();
    menuInitWeatherListLoader();
    getExperiencePromotionData();
    expListInitMainList();

}

function expListUninitScreen() {
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
    expListSubMenuList = null;
    delete expListSubMenuList;
    expListSubMenuList = undefined;
    expList = null;
    delete expList;
    expList = undefined;
    expListInitType = null;
    delete expListInitType;
    expListInitType = undefined;
    expListInitLetter = null;
    delete expListInitLetter;
    expListInitLetter = undefined;
    expListInitGenreId = null;
    delete expListInitGenreId;
    expListInitGenreId = undefined
}

function initInfoVars() {
    expListSubMenuList = null;
    expList = null;
    expListInitType = null;
    expListInitLetter = null;
    expListInitGenreId = null
}

function expListInitMainList() {
    var b = [];
    expList = new top.List(top.ListType.BLOCK, top.ExperienceManager.expArray, 0, 0, 0, top.EXPINFO_LEFT_NAV_ROWS, document.getElementById("expListContainer"));
    expList.displayItem = expListDisplayItem;
    expList.displayEmptyList = expListDisplayEmptyList;
    expList.display = expListDisplay;
    expList.onBeforeDisplay = expListShowHighlight;
    expList.onIndexChanged = expListOnIndexChanged;
    expList.onAfterDisplay = expListOnAfterDisplay;
    expList.initList();
    heighlight_first_menu_exp();
    setCurrentExp();
}


function highlight_menu_exp(){
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

function  heighlight_first_menu_exp(){
    var element = document.getElementsByClassName("expListItem")[0];
    element.style.backgroundColor = "#B78D49";
}

//Dine Promotions
function getExperiencePromotionData(){

    var json_url = top.TICKER_MEDIA_URL+"en/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", json_url, true, this, myFunctionExperience);


}

function myFunctionExperience(jsonString) {

    var json = top.jsonParser(jsonString);
    var promotions;

    for (var i = 0; i < json.length; i++) {
      var promo_type = json[i].restaurant_id;
      if (promo_type == "EXPERIENCE") {
        promotions = json[i].ticker_promo_txt;
      }
    }
    experiencePromDisplayItem(promotions);

}
//End Of Dine promotions
