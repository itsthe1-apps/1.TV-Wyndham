var localDetailList = null;
var localDetailInitType = null;
var localMenuList = null;

function localDetailEventHandler(e) {
    var c = true;
    d = top.State.getState();
    switch (e.code) {
        case "INIT_SCREEN":
            // top.changeBackgroundImg('INFO');
            top.BG_IMG = 'url(' + top.IMAGES_PREFIX + 'BGS/' + top.BACKGROUND_ARRAY['INFO'] + ')';
            initLocalDetailVars();
            localDetailInitScreen(e.args);
            break;
        case "UNINIT_SCREEN":
            localDetailUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.LOCAL_DETAIL:
                    c = localDetailMainEventHandler(e);
                    break;
                default:
                    c = false;
                    break
            }
            break
    }
    return c
}

function localDetailMainEventHandler(e) {
    var c = true;
    switch (e.code) {
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "ltr") ? localDetailList.scrollUp(1): localDetailList.scrollDown(1);
            setCurrentLocal();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "ltr") ? localDetailList.scrollDown(1): localDetailList.scrollUp(1);
            setCurrentLocal();
            break;
        case "KEY_UP":
            localDetailList.scrollUp(1);
            break;
        case "KEY_DOWN":
            try {
                localDetailList.scrollDown(1)
            } catch (f) {
                t = f
            }
            break;
        case "KEY_BACK":
            top.ScreenManager.load("LOCAL");
            break;
        case "KEY_SELECT":
            break;
        default:
            c = false;
            break
    }
    return c
}

function localDetailActionHandler(c, e) {
    switch (c) {}
}

function localDetailInitScreen(b) {
    top.State.setState(top.State.LOCAL_DETAIL);
    top.ScreenManager.displayScreen(localDetailGetScreenHtml());
    top.Clock.show(this, "globalClock");
    localDetailInitMainList()
}

function localDetailUninitScreen() {
    top.Clock.stop();
    setToBinLocalDetail()
}

function localDetailInitMainList() {
    var c = top.LocalInfoManager.currentRestuarantMenu.data;
    var b = [];
    localDetailList = new top.List(top.ListType.BLOCK, c, 0, 0, 0, top.LOCALINFO_LEFT_NAV_ROWS, document.getElementById("localDetailListContainer"));
    localDetailList.displayItem = localDetailListDisplayItem;
    localDetailList.displayEmptyList = localDetailListDisplayEmptyList;
    localDetailList.display = localDetailListDisplay;
    localDetailList.onBeforeDisplay = localDetailListShowHighlight;
    localDetailList.onIndexChanged = localDetailListOnIndexChanged;
    localDetailList.onAfterDisplay = localDetailListOnAfterDisplay;
    localDetailList.initList()
}

function initLocalDetailVars() {
    localDetailList = null;
    localDetailInitType = null;
    localMenuList = null
}

function setToBinLocalDetail() {
    localDetailList = null;
    delete localDetailList;
    localDetailList = undefined;
    localDetailInitType = null;
    delete localDetailInitType;
    localDetailInitType = undefined;
    localMenuList = null;
    delete localMenuList;
    localMenuList = undefined
};