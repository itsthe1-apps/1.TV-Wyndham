var userCode = "";
var ca = [];
var caIndex = 0;
var roomList = null;
var roomOrderList = null;
var inKeeperLeftNavigator = true;
var vsArray = [];
var tdArray = [];
var umArray = [];
var mrArray = [];
var ebArray = [];
var crArray = [];
var bcArray = [];

function roomEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            initKeeperVars();
            roomInitScreen(d.args);
            top.changeBackgroundImg('ROOM');
            break;
        case "UNINIT_SCREEN":
            roomUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.ROOM_LIST:
                    c = roomMainEventHandler(d);
                    break;
                case top.State.ROOM_ORDER:
                    c = roomOrderMainEventHandler(d);
                    break;
                default:
                    c = false;
                    break
            }
            break
    }
    return c
}

function roomMainEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_RIGHT":
            inKeeperLeftNavigator = false;
            if (top.DEFAULT_DIRECTION == "ltr") {
                top.State.setState(top.State.ROOM_ORDER);
                roomListHideHighlight();
                switchRoomService()
            }
            break;
        case "KEY_LEFT":
            if (top.DEFAULT_DIRECTION == "rtl") {
                top.State.setState(top.State.ROOM_ORDER);
                roomListHideHighlight()
            }
            break;
        case "KEY_UP":
            clearKeeperVars();
            roomList.scrollUp(1);
            switchRoomService();
            roomOrderListHideHighlight();
            break;
        case "KEY_DOWN":
            clearKeeperVars();
            roomList.scrollDown(1);
            switchRoomService();
            roomOrderListHideHighlight();
            break;
        case "KEY_BACK":
            top.ScreenManager.load("MENU");
            break;
        case "KEY_SELECT":
            top.State.setState(top.State.ROOM_ORDER);
            roomListHideHighlight();
            break;
        default:
            c = false;
            break
    }
    return c
}

function switchRoomService() {
    roomInitOrderList()
}

function roomOrderMainEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_LEFT":
            try {
                if (roomOrderList.getItem().target == "roomstatus") {
                    caIndex = (caIndex > 0) ? --caIndex : ca.length - 1;
                    if (document.getElementById("roomorderStatus")) {
                        document.getElementById("roomorderStatus").innerHTML = ca[caIndex]
                    }
                }
            } catch (e) {
                x1 = e
            }
            break;
        case "KEY_RIGHT":
            if (roomOrderList.getItem().target == "roomstatus") {
                caIndex = (caIndex < (ca.length - 1)) ? ++caIndex : 0;
                if (document.getElementById("roomorderStatus")) {
                    document.getElementById("roomorderStatus").innerHTML = ca[caIndex]
                }
            }
            break;
        case "KEY_CODE":
            top.kwConsole.print("KEY CODE");
            userCode += "" + d.args.value;
            document.getElementById("roomorderUser").innerHTML = userCode;
            break;
        case "KEY_RED":
            userCode = userCode.substring(0, userCode.length - 1);
            document.getElementById("roomorderUser").innerHTML = userCode;
            break;
        case "KEY_UP":
            roomOrderList.scrollUp(1);
            break;
        case "KEY_DOWN":
            try {
                roomOrderList.scrollDown(1)
            } catch (e) {
                x = e
            }
            break;
        case "KEY_BACK":
            inKeeperLeftNavigator = true;
            userCode = "";
            top.State.setState(top.State.ROOM_LIST);
            roomListShowHighlight();
            roomOrderListHideHighlight();
            break;
        case "KEY_SELECT":
            if (roomOrderList.getItem().target == "submit") {
                if (userCode.length > 3) {
                    document.getElementById("servicemsg").innerHTML = "Thank You. Your Request will be processed.";
                    top.RoomKeeperManager.setServiceRequest(roomList.getItem().target, userCode, caIndex)
                } else {
                    document.getElementById("servicemsg").innerHTML = "Please enter the User Code."
                }
            } else {
                document.getElementById("servicemsg").innerHTML = "Enter requered order information.."
            }
            break;
        default:
            c = false;
            break
    }
    return c
}

function roomInitScreen(b) {
    top.State.setState(top.State.ROOM_LIST);
    top.ScreenManager.displayScreen(roomGetScreenHtml());
    top.Clock.show(this, "globalClock");
    roomInitMainList();
    roomInitOrderList();
    ca = vsArray;
    top.Time.init()
}

function roomUninitScreen() {
    top.Clock.stop();
    setToBinKeeper()
}

function roomInitMainList() {
    try {
        var b = [];
        roomList = new top.List(top.ListType.BLOCK, roomListData(), 0, 0, 0, top.KEEPER_LEFT_NAV_ROWS, document.getElementById("roomListContainer"));
        roomList.displayItem = roomListDisplayItem;
        roomList.displayEmptyList = roomListDisplayEmptyList;
        roomList.display = roomListDisplay;
        roomList.onBeforeDisplay = roomListShowHighlight;
        roomList.onIndexChanged = roomListOnIndexChanged;
        roomList.onAfterDisplay = roomListOnAfterDisplay;
        roomList.initList()
    } catch (c) {
        x = c
    }
}

function roomInitOrderList() {
    try {
        var b = [];
        roomOrderList = new top.List(top.ListType.SCROLL, roomOrderListData(), 0, 0, 0, 3, document.getElementById("roomInfoContainerContent"));
        roomOrderList.displayItem = roomOrderListDisplayItem;
        roomOrderList.initList();
        roomOrderListHideHighlight()
    } catch (c) {
        x = c
    }
}

function roomListData() {
    var a = [];
    a.push({
        "class": "vacant_status roomkeeperNavItemList",
        target: "vacant_status"
    });
    a.push({
        "class": "turn_down roomkeeperNavItemList",
        target: "turn_down"
    });
    a.push({
        "class": "under_maintenance roomkeeperNavItemList",
        target: "under_maintenance"
    });
    a.push({
        "class": "maintenance_req roomkeeperNavItemList",
        target: "maintenance_req"
    });
    a.push({
        "class": "extra_bed roomkeeperNavItemList",
        target: "extra_bed"
    });
    a.push({
        "class": "cleaning_req roomkeeperNavItemList",
        target: "cleaning_req"
    });
    a.push({
        "class": "baby_cot roomkeeperNavItemList",
        target: "baby_cot"
    });
    return a
}

function roomOrderListData() {
    var a = [];
    a.push({
        "class": "roomorderUser",
        target: "usercode"
    });
    a.push({
        "class": "roomorderStatus",
        target: "roomstatus"
    });
    a.push({
        "class": "roomorderSubmit",
        target: "submit"
    });
    return a
}

function setToBinKeeper() {
    userCode = null;
    delete userCode;
    userCode = undefined;
    ca = null;
    delete ca;
    ca = undefined;
    caIndex = null;
    delete caIndex;
    caIndex = undefined;
    roomList = null;
    delete roomList;
    roomList = undefined;
    roomOrderList = null;
    delete roomOrderList;
    roomOrderList = undefined;
    vsArray = null;
    delete vsArray;
    vsArray = undefined;
    tdArray = null;
    delete tdArray;
    tdArray = undefined;
    umArray = null;
    delete umArray;
    umArray = undefined;
    mrArray = null;
    delete mrArray;
    mrArray = undefined;
    ebArray = null;
    delete ebArray;
    ebArray = undefined;
    crArray = null;
    delete crArray;
    crArray = undefined;
    bcArray = null;
    delete bcArray;
    bcArray = undefined
}

function initKeeperVars() {
    userCode = "";
    ca = [];
    caIndex = 0;
    roomList = null;
    roomOrderList = null;
    vsArray = new Array("Clean", "Dirty");
    tdArray = new Array("Done", "Not Done");
    umArray = new Array("No", "Yes");
    mrArray = new Array("Not Required", "Required");
    ebArray = new Array("No", "Yes");
    crArray = new Array("Not Required", "Required");
    bcArray = new Array("No", "Yes")
}

function clearKeeperVars() {
    userCode = "";
    ca = [];
    caIndex = 0
};