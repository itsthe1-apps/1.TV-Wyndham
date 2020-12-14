var messageList = null;

function messageEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            top.changeBackgroundImg('MESSAGES');
            initMessageVars();
            messageListInitScreen(d.args);
            break;
        case "UNINIT_SCREEN":
            top.MessageManager.loadMessages();
            messageListUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.MESSAGE_LIST_MAIN:
                    c = messageListMainEventHandler(d);
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

function messageListMainEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_LEFT":
            messageListRestList.scrollUp(1);
            break;
        case "KEY_RIGHT":
            messageListRestList.scrollDown(1);
            break;
        case "KEY_UP":
            // Navigating to correct Menu ID
            top.State.setState(top.State.MENU_MAIN);
            var correct_menu_id = top.PRV_MENU_ID - top.CURRENT_MENU_ID;
            if (correct_menu_id != 0) {
                menuMainList.scrollDown(correct_menu_id);
            }
            //messageListRestList.scrollUp(1);
            break;
        case "KEY_DOWN":
            top.State.setState(top.State.MESSAGE_LIST_MAIN);
            //messageListRestList.scrollDown(1);
            break;
        case "KEY_BACK":
            document.getElementById("messageDetailContainer").innerHTML = "";
            document.getElementById("messageDetailContainer").style.visibility = "hidden";
            break;
        case "KEY_YELLOW":
            if (messageListRestList.getItem()) {
                top.RestuarantsManager.setCurrentRestuarant(messageListRestList.getItem());
                top.ScreenManager.load("MESSAGE_MENU");
            }
            break;
        case "KEY_SELECT":
            if (messageListRestList.getItem()) {
                d = "Date: " + messageListRestList.getItem().date + "<br><br>";
                d += messageListRestList.getItem().message + "<br>";
                document.getElementById("messageDetailContainer").innerHTML = d;
                document.getElementById("messageDetailContainer").style.visibility = "visible";
                top.MessageManager.setMessageRead(messageListRestList.getItem().id);
                top.MessageManager.checkNewMessage()
            }
            break;
        default:
            clearInterval_view();
            c = false;
            break
    }
    return c
}

function messageListActionHandler(c, d) {
    switch (c) {
    }
}

function messageListInitScreen(b) {
    top.State.setState(top.State.MESSAGE_LIST_MAIN);
    top.ScreenManager.displayScreen(messageListGetScreenHtml());
    top.Clock.show(this, "globalClock");
    top.CURRENT_MENU_ID = 0;
    clearInterval(top.GLOBAL_SLIDER_INTERVAL);
    clearInterval(top.GLOBAL_PROMOTION_INTERVAL);
    //initPromotionsMessages();
    menuInitMainList();
    menuInitWeatherListLoader();
    menuInitNewsListLoader();
    this.highlight_menu();
    top.Time.init();
    messageListInitMainList();
}

function messageListUninitScreen() {
    top.Clock.stop();
    document.getElementById("messageDetailContainer").innerHTML = "";
    document.getElementById("messageDetailContainer").style.visibility = "hidden";
    setToBinMessage()
}

function messageListInitMainList() {
    var b = [];
    x = top.MessageManager.getMessageList();
    messageListRestList = new top.List(top.ListType.BLOCK, top.MessageManager.getMessageList(), 0, 0, 0, top.MSGS_ROWS, document.getElementById("messageListRestListContainer"));
    messageListRestList.displayItem = messageListRestListDisplayItem;
    messageListRestList.displayEmptyList = messageListRestListDisplayEmptyList;
    messageListRestList.display = messageListRestListDisplay;
    messageListRestList.onBeforeDisplay = messageListRestListShowHighlight;
    messageListRestList.onIndexChanged = messageListRestListOnIndexChanged;
    messageListRestList.onAfterDisplay = messageListRestListOnAfterDisplay;
    messageListRestList.initList()
}

function setToBinMessage() {
    messageList = null;
    delete messageList;
    messageList = undefined;
    messageListRestList = null;
    delete messageListRestList;
    messageListRestList = undefined
}

function initPromotionsMessages() {
    var json_url = top.MEDIA_URL + "en/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", json_url, true, this, initPromotionsMessagesData);
}


function clearInterval_view() {
    clearIntervalTimer();
}


function initPromotionsMessagesData(jsonString) {

    var json = top.jsonParser(jsonString);
    var promotions = json.length;
    var trimed_text;
    var promo_text = "";


    for (var i = 0; i < json.length; i++) {


        if (!(json[i] == 'undefined' || json[i] == null)) {
            promo_text += json[i].ticker_promo_txt;
            promo_text += "|";
            trimed_text = promo_text.substring(0, promo_text.length - 1);

        }
    }

    messagesPromDisplayItem(trimed_text);
}

function initMessageVars() {
    messageList = null;
    messageListRestList = null
};

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
};