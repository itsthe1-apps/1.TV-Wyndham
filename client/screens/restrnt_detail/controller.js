var restrntDetailList = null;
var restrntDetailInitType = null;
var foodMenuList = null;
var detailImage = 0;

function restrntDetailEventHandler(e) {
    var c = true;
    d = top.State.getState();
    switch (e.code) {
        case "INIT_SCREEN":
            top.changeBackgroundImg('RESTAURANT');
            initRestDetailVars();
            restrntDetailInitScreen(e.args);
            break;
        case "UNINIT_SCREEN":
            restrntDetailUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.RESTRNT_DETAIL:
                    c = restrntDetailMainEventHandler(e);
                    break;
                case top.State.RESTRNT_FOODMENU:
                    c = restrntFoodMainEventHandler(e);
                    break;
                default:
                    c = false;
                    break
            }
            break
    }
    return c
}

function restrntDetailMainEventHandler(e) {
    var c = true;
    switch (e.code) {
        case "KEY_RIGHT":
            if (top.DEFAULT_DIRECTION == "ltr") {
                top.State.setState(top.State.RESTRNT_FOODMENU);
                restrntDetailListHideHighlight();
                foodMenuList.display();
                restrntFoodListShowHighlight()
            }
            break;
        case "KEY_LEFT":
            if (top.DEFAULT_DIRECTION == "rtl") {
                top.State.setState(top.State.RESTRNT_FOODMENU);
                restrntDetailListHideHighlight();
                foodMenuList.display();
                restrntFoodListShowHighlight()
            }
            break;
        case "KEY_UP":
            restrntDetailList.scrollUp(1);
            setFoodMenuList();
            break;
        case "KEY_DOWN":
            restrntDetailList.scrollDown(1);
            setFoodMenuList();
            break;
        case "KEY_GREEN":
            if (top.RestuarantsManager.getCurrentRestuarantMenu().is_service == 0) {
                top.ScreenManager.load("RESTRNT_ORDER")
            }
            break;
        case "KEY_BACK":
            top.ScreenManager.load("RESTRNT");
            break;
        case "KEY_SELECT":
            break;
        default:
            c = false;
            break
    }
    return c
}

function restrntDetailActionHandler(c, e) {
    switch (c) {}
}

function restrntDetailInitScreen(b) {
    top.State.setState(top.State.RESTRNT_DETAIL);
    top.ScreenManager.displayScreen(restrntDetailGetScreenHtml());
    top.Clock.show(this, "globalClock");
    this.restrntDetailInitMainList()
}

function restrntDetailUninitScreen() {
    top.Clock.stop();
    setToBinRestDetail()
}

function restrntDetailInitMainList() {
    var c = top.RestuarantsManager.getRestMtype();
    var b = [];
    restrntDetailList = new top.List(top.ListType.BLOCK, c, 0, 0, 0, top.LOCALINFO_LEFT_NAV_ROWS, document.getElementById("restrntDetailListContainer"));
    restrntDetailList.displayItem = restrntDetailListDisplayItem;
    restrntDetailList.displayEmptyList = restrntDetailListDisplayEmptyList;
    restrntDetailList.display = restrntDetailListDisplay;
    restrntDetailList.onIndexChanged = restrntDetailListOnIndexChanged;
    restrntDetailList.onAfterDisplay = restrntDetailListOnAfterDisplay;
    restrntDetailList.initList();
    this.setFoodMenuList()
}

function restrntFoodMainEventHandler(e) {
    var c = true;
    switch (e.code) {
        case "KEY_UP":
            if (detailImage == 0) {
                foodMenuList.scrollUp(1)
            }
            break;
        case "KEY_GREEN":
            if (top.RestuarantsManager.getCurrentRestuarantMenu().is_service == 0) {
                top.ScreenManager.load("RESTRNT_ORDER")
            }
            break;
        case "KEY_DOWN":
            if (detailImage == 0) {
                foodMenuList.scrollDown(1)
            }
            break;
        case "KEY_SELECT":
            if (foodMenuList.getItem()) {
                img = document.getElementById("restDetailIMG");
                img.src = foodMenuList.getItem().image;
                img.width = top.globalConst("RESTRNT_DETAIL_IMG_WIDTH");
                img.height = top.globalConst("RESTRNT_DETAIL_IMG_HEIGHT");
                des = document.getElementById("restDetailListRestInfo_desc");
                des.innerHTML = foodMenuList.getItem().name;
                restrntFoodListContainerHideHighlight();
                document.getElementById("foodDetailContainer").style.visibility = "visible";
                detailImage = 1
            }
            break;
        case "KEY_BACK":
            if (detailImage == 1) {
                detailImage = 0;
                restrntFoodListContainerShowHighlight();
                document.getElementById("foodDetailContainer").style.visibility = "hidden"
            } else {
                if (detailImage == 0) {
                    top.State.setState(top.State.RESTRNT_DETAIL);
                    restrntDetailListShowHighlight();
                    restrntFoodListHideHighlight();
                    this.setFoodMenuList()
                }
            }
            break;
        default:
            c = false;
            break
    }
    return c
}

function setFoodMenuList() {
    if (restrntDetailList.getItem().code) {
        var b = restrntDetailList.getItem().code;
        var a = top.RestuarantsManager.getCurrentRestuarantMenu().starter;
        if (b == "maincourse") {
            a = top.RestuarantsManager.getCurrentRestuarantMenu().maincourse
        } else {
            if (b == "dessert") {
                a = top.RestuarantsManager.getCurrentRestuarantMenu().dessert
            } else {
                if (b == "drink") {
                    a = top.RestuarantsManager.getCurrentRestuarantMenu().drink
                }
            }
        }
        if (a && a.length > 0) {
            foodMenuList = new top.List(top.ListType.BLOCK, a, 0, 0, 0, 5, document.getElementById("restrntDetailRestInfo"));
            foodMenuList.displayItem = restrntFoodListDisplayItem;
            foodMenuList.displayEmptyList = restrntFoodListDisplayEmptyList;
            foodMenuList.display = restrntFoodListDisplay;
            foodMenuList.onIndexChanged = restrntFoodListOnIndexChanged;
            foodMenuList.onAfterDisplay = restrntFoodListOnAfterDisplay;
            foodMenuList.initList()
        }
        restrntFoodListHideHighlight()
    }
}

function setToBinRestDetail() {
    restrntDetailList = null;
    delete restrntDetailList;
    restrntDetailList = undefined;
    restrntDetailInitType = null;
    delete restrntDetailInitType;
    restrntDetailInitType = undefined;
    foodMenuList = null;
    delete foodMenuList;
    foodMenuList = undefined;
    detailImage = null;
    delete detailImage;
    detailImage = undefined
}

function initRestDetailVars() {
    restrntDetailList = null;
    restrntDetailInitType = null;
    foodMenuList = null;
    detailImage = 0
};