var restrntListSubMenuList = null;
var restrntListRestList = null;
var restrntListInitType = null;
var restrntListInitLetter = null;
var restrntListInitGenreId = null;
var promotionList = null;
var menu_id_count = 0;



function restrntEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            // top.changeBackgroundImg('RESTAURANT');
            top.BG_IMG = 'url(' + top.IMAGES_PREFIX + 'BGS/' + top.BACKGROUND_ARRAY['RESTAURANT'] + ')';
            initRestListVars();
            restrntListInitScreen(d.args);
            break;
        case "UNINIT_SCREEN":
            restrntListUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.RESTRNT_LIST_MAIN:
                    c = restrntListMainEventHandler(d);
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

function restrntListMainEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_LEFT":
        top.IMAGES_ARRAY = true;
            if (top.DEFAULT_DIRECTION == "ltr") {
                restrntListRestList.scrollUp(1);
                setCurrentRestauant();
                menu_id_count--;
            }else{
                restrntListRestList.scrollDown(1);
                setCurrentRestauant();
                menu_id_count++;
            }
            
            break;
        case "KEY_RIGHT":
             if (top.DEFAULT_DIRECTION == "ltr") {
                restrntListRestList.scrollDown(1);
                setCurrentRestauant();
                menu_id_count++;
             }else{
                restrntListRestList.scrollUp(1);
                setCurrentRestauant();
                menu_id_count--;
             }
            
            break;
        case "KEY_UP":

            // Navigating to correct Menu ID
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
            //restrntListRestList.scrollDown(1);
            //setCurrentRestauant();
            top.State.setState(top.State.RESTRNT_LIST_MAIN);
            break;
        case "KEY_BACK":
            break;
        case "KEY_SELECT":
            //top.ScreenManager.load("RESTRNT_DETAIL");
            break;
        default:
            c = false;
            break
    }
    return c
}


function setCurrentRestauant() {
    top.RestuarantsManager.setCurrentRestuarantMenu(restrntListRestList.getItem())
}

function restrntListActionHandler(c, d) {
    switch (c) {
    }
}

function restrntListInitScreen(b) {
    top.State.setState(top.State.RESTRNT_LIST_MAIN);
    top.ScreenManager.displayScreen(restrntListGetScreenHtml());
    top.Clock.show(this, "globalClock");
    if (b) {
        restrntListInitType = b.type || null;
        restrntListInitLetter = b.letter || null;
        restrntListInitGenreId = b.genreId || null
    }
    top.CURRENT_MENU_ID = 0;
    clearInterval(top.GLOBAL_SLIDER_INTERVAL);
    clearInterval(top.GLOBAL_PROMOTION_INTERVAL);
    menuInitMainList();
    highlight_menu_dine();
    menuInitWeatherListLoader();
    restrntListInitMainList();
    setCurrentRestauant();
    getrestrntPromotionData();

}

function restrntListUninitScreen() {
    top.Clock.stop();
    top.kwTimer.cancelTimer("WEATHER_SCROLL_DELAY");
    top.kwTimer.cancelTimer("WEATHER_REFRESH_TIMEOUT");
    if (top.SOCKET_SUPPORT == 1) {
        top.ListenerManager.stopWeatherLoad();
    }
    top.WeatherManager.isNewData = true;
    setToBinRestList()
}

function restrntListInitMainList() {
    var b = [];
    x = top.RestuarantsManager.restuarantsArray;
    restrntListRestList = new top.List(top.ListType.BLOCK, top.RestuarantsManager.restuarantsArray, 0, 0, 0, top.LOCALINFO_LEFT_NAV_ROWS, document.getElementById("restrntListRestListContainer"));

    restrntListRestList.displayItem = restrntListRestListDisplayItem;
    restrntListRestList.displayEmptyList = restrntListRestListDisplayEmptyList;
    restrntListRestList.display = restrntListRestListDisplay;
    restrntListRestList.onBeforeDisplay = restrntListRestListShowHighlight;
    restrntListRestList.onIndexChanged = restrntListRestListOnIndexChanged;
    restrntListRestList.onAfterDisplay = restrntListRestListOnAfterDisplay;
    restrntListRestList.initList();
    heighlight_first_menu_dine();
    setCurrentRestauant();

}


//Dine Promotions
function getrestrntPromotionData() {

    var json_url = top.TICKER_MEDIA_URL + "en/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", json_url, true, this, myFunctionRestaurant);


}

function myFunctionRestaurant(jsonString) {

    var json = top.jsonParser(jsonString);
    var promotions;

    for (var i = 0; i < json.length; i++) {
        var promo_type = json[i].restaurant_id;
        if (promo_type == "DINE") {
            promotions = json[i].ticker_promo_txt;
        }
    }
    restrntPromDisplayItem(promotions);

}
//End Of Dine promotions



function setToBinRestList() {
    restrntListSubMenuList = null;
    delete restrntListSubMenuList;
    restrntListSubMenuList = undefined;
    restrntListRestList = null;
    delete restrntListRestList;
    restrntListRestList = undefined;
    restrntListInitType = null;
    delete restrntListInitType;
    restrntListInitType = undefined;
    restrntListInitLetter = null;
    delete restrntListInitLetter;
    restrntListInitLetter = undefined;
    restrntListInitGenreId = null;
    delete restrntListInitGenreId;
    restrntListInitGenreId = undefined
}

function initRestListVars() {
    restrntListSubMenuList = null;
    restrntListRestList = null;
    restrntListInitType = null;
    restrntListInitLetter = null;
    restrntListInitGenreId = null
}


function highlight_menu_dine() {
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

function  heighlight_first_menu_dine() {
    var element = document.getElementsByClassName("restrntListRestListItem")[0];
    // element.style.backgroundColor = "#B78D49";
    element.className += " active";
}