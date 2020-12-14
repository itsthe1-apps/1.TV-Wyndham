var newsnpromoListSubMenuList = null;
var newsnpromoList = null;
var newsnpromoListInitType = null;
var newsnpromoListInitLetter = null;
var newsnpromoListInitGenreId = null;

function newsnpromoEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            // top.changeBackgroundImg('SERVICES');
            top.BG_IMG = 'url(' + top.IMAGES_PREFIX + 'BGS/' + top.BACKGROUND_ARRAY['SERVICES'] + ')';
            initNewsNPromoVars();
            newsnpromoListInitScreen(d.args);
            break;
        case "UNINIT_SCREEN":
            newsnpromoListUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.NEWSPROMO_LIST_MAIN:
                    c = newsnpromoListMainEventHandler(d);
                    break;
                case top.State.MENU_MAIN:
                    c = menuMainEventHandler(d);
                    break;
                default:
                    c = false;
                    break;
            }
            break;
    }
    return c;
}

function newsnpromoListMainEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "ltr") ? newsnpromoList.scrollUp(1): newsnpromoList.scrollDown(1);
            setCurrentNewsnpromo();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "ltr") ? newsnpromoList.scrollDown(1): newsnpromoList.scrollUp(1);
            setCurrentNewsnpromo();
            break;
        case "KEY_UP":
            // newsnpromoList.scrollUp(1);
            // setCurrentNewsnpromo();
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
            // newsnpromoList.scrollDown(1);
            // setCurrentNewsnpromo();
            top.State.setState(top.State.NEWSPROMO_LIST_MAIN);
            break;
        case "KEY_BACK":
            clearIntervalNewsnpromo_call();
            break;
        case "KEY_GREEN":
            break;
        case "KEY_SELECT":
            // clearIntervalNewsnpromo_call();
            // top.ScreenManager.load("NEWSNPROMO_DETAIL");
            break;
        default:
            clearIntervalNewsnpromo_call();
            c = false;
            break;
    }
    return c;
}

function setCurrentNewsnpromo() {
    top.NewsnpromoManager.setCurrentNewsnpromoMenu(newsnpromoList.getItem())
}

function newsnpromoListActionHandler(c, d) {
    switch (c) {
        //
    }
}

function newsnpromoListInitScreen(b) {
    top.State.setState(top.State.NEWSPROMO_LIST_MAIN);
    top.ScreenManager.displayScreen(newsnpromoListGetScreenHtml());
    top.Clock.show(this, "globalClock");
    if (b) {
        newsnpromoListInitType = b.type || null;
        newsnpromoListInitLetter = b.letter || null;
        newsnpromoListInitGenreId = b.genreId || null
    }
    top.CURRENT_MENU_ID = 0;
    clearInterval(top.GLOBAL_SLIDER_INTERVAL);
    clearInterval(top.GLOBAL_PROMOTION_INTERVAL);
    menuInitMainList();
    highlight_menu();
    menuInitWeatherListLoader();
    getNewsnpromoPromotionData();
    newsnpromoListInitMainList();
}

function newsnpromoListUninitScreen() {
    top.Clock.stop();
    top.kwTimer.cancelTimer("WEATHER_SCROLL_DELAY");
    top.kwTimer.cancelTimer("WEATHER_REFRESH_TIMEOUT");
    if (top.SOCKET_SUPPORT == 1) {
        top.ListenerManager.stopWeatherLoad();
    }
    top.WeatherManager.isNewData = true;
    setToBinInfo();
}

function setToBinInfo() {
    newsnpromoListSubMenuList = null;
    delete newsnpromoListSubMenuList;
    newsnpromoListSubMenuList = undefined;
    newsnpromoList = null;
    delete newsnpromoList;
    newsnpromoList = undefined;
    newsnpromoListInitType = null;
    delete newsnpromoListInitType;
    newsnpromoListInitType = undefined;
    newsnpromoListInitLetter = null;
    delete newsnpromoListInitLetter;
    newsnpromoListInitLetter = undefined;
    newsnpromoListInitGenreId = null;
    delete newsnpromoListInitGenreId;
    newsnpromoListInitGenreId = undefined;
}

function initNewsNPromoVars() {
    newsnpromoListSubMenuList = null;
    newsnpromoList = null;
    newsnpromoListInitType = null;
    newsnpromoListInitLetter = null;
    newsnpromoListInitGenreId = null;
}
//Newsnpromo Info Promotions
function getNewsnpromoPromotionData() {
    var json_url = top.MEDIA_URL + "en/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", json_url, true, this, myFunctionNewsnpromo);
}

function myFunctionNewsnpromo(jsonString) {
    var json = top.jsonParser(jsonString);
    var promotions;
    for (var i = 0; i < json.length; i++) {
        var promo_type = json[i].newsnpromo_id;
        if (promo_type == "NEWSNPROMO") {
            promotions = json[i].ticker_promo_txt;
        }
    }
    newsnpromoPromDisplayItem(promotions);
}
//End Of Newsnpromo Info Promotions
function newsnpromoListInitMainList() {
    var b = [];
    newsnpromoList = new top.List(top.ListType.BLOCK, top.NewsnpromoManager.newsnpromosArray, 0, 0, 0, top.NEWSNPROMO_LEFT_NAV_ROWS, document.getElementById("newsnpromoListContainer"));
    newsnpromoList.displayItem = newsnpromoListDisplayItem;
    newsnpromoList.displayEmptyList = newsnpromoListDisplayEmptyList;
    newsnpromoList.display = newsnpromoListDisplay;
    newsnpromoList.onBeforeDisplay = newsnpromoListShowHighlight;
    newsnpromoList.onIndexChanged = newsnpromoListOnIndexChanged;
    newsnpromoList.onAfterDisplay = newsnpromoListOnAfterDisplay;
    newsnpromoList.initList();
    heighlight_newsnpromo_first_menu();
    setCurrentNewsnpromo();
}

function highlight_menu() {
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

function heighlight_newsnpromo_first_menu() {
    var element = document.getElementsByClassName("newsnpromoListItem")[0];
    // element.style.color = "#FFF";
    element.className += " active";
}