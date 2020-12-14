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
            messageListRestList.scrollUp(1);
            break;
        case "KEY_DOWN":
            messageListRestList.scrollDown(1);
            break;
        case "KEY_BACK":
            document.getElementById("messageDetailContainer").innerHTML = "";
            document.getElementById("messageDetailContainer").style.visibility = "hidden";
            break;
        case "KEY_YELLOW":
            if (messageListRestList.getItem()) {
                top.RestuarantsManager.setCurrentRestuarant(messageListRestList.getItem());
                top.ScreenManager.load("MESSAGE_MENU")
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
            c = false;
            break
    }
    return c
}

function messageListActionHandler(c, d) {
    switch (c) {}
}

function messageListInitScreen(b) {
    top.State.setState(top.State.MESSAGE_LIST_MAIN);
    top.ScreenManager.displayScreen(messageListGetScreenHtml());
    top.Clock.show(this, "globalClock");
    messageListInitMainList()
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



function initMessageVars() {
    messageList = null;
    messageListRestList = null
};