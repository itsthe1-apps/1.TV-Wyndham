var userPass = "";
var serviceList = null;
var serviceOrderList = null;
var requestedTime = 0;
var selectedTime = "00:00";
var requestedDateDiff = 0;
var requestedDateDate = null;
var requestedGuest = 1;
var alarmType = 0;
var tvSelected = 1;
var udpNumber = 0;
var ringType = 0;
var inLeftNavigator = true;
var typeArray = [];
var udpArray = [];
var toneArray = [];

function serviceEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            top.changeBackgroundImg('SERVICES');
            initServiceVars();
            serviceInitScreen(d.args);
            break;
        case "UNINIT_SCREEN":
            serviceUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.SERVICE_LIST:
                    c = serviceMainEventHandler(d);
                    break;
                case top.State.SERVICE_ORDER:
                    c = serviceOrderMainEventHandler(d);
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

function serviceMainEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_RIGHT":
            inLeftNavigator = false;
            if (top.DEFAULT_DIRECTION == "ltr") {
                top.State.setState(top.State.SERVICE_ORDER);
                serviceListHideHighlight();
                serviceOrderListShowHighlight();
                switchService();
            }
            break;
        case "KEY_LEFT":
          if (top.DEFAULT_DIRECTION == "rtl") {
              top.State.setState(top.State.SERVICE_ORDER);   //
              serviceListHideHighlight();                    //
              serviceOrderListShowHighlight()                //

          }
          break;
        case "KEY_UP":
            clearServiceVars();                              //
            serviceList.scrollUp(1);                         //
            switchService();                                 //
            serviceOrderListHideHighlight();                 //
            top.State.setState(top.State.MENU_MAIN);
            break;
        case "KEY_DOWN":
            clearServiceVars();                              //
            serviceList.scrollDown(1);                       //
            switchService();                                 //
            serviceOrderListHideHighlight();                 //
            top.State.setState(top.State.LOCAL_LIST_MAIN);
            break;
        case "KEY_BACK":
            top.ScreenManager.load("MENU");
            break;
        case "KEY_SELECT":
            top.State.setState(top.State.SERVICE_ORDER);
            serviceListHideHighlight();
            serviceOrderListShowHighlight();
            break;
        case "KEY_CODE":
            userPass += "" + d.args.value;
            top.kwConsole.print("KEY CODE,:" + userPass);
            break;
        case "KEY_RED":
            userPass = "";
            break;
        case "KEY_GREEN":
            if (userPass == top.USER_PASSPWORD) {
                top.ScreenManager.load("ROOM_KEEPER")
            }
            break;
        default:
            c = false;
            break
    }
    return c
}

function switchService() {
    if (serviceList.getItem().target == "taxi") {
        serviceInitOrderListTaxi()
    } else {
        if (serviceList.getItem().target == "wakeup") {
            serviceInitOrderAlarmList()
        } else {
            serviceInitOrderList()
        }
    }
    requestedDateDiff = 0;
    requestedTime = 0;
    requestedGuest = 1
}

function serviceOrderMainEventHandler(d) {
    var c = true;
    if ((d.code == "KEY_LEFT" || d.code == "KEY_RIGHT") && (top.DEFAULT_DIRECTION == "rtl")) {
        d.code = (d.code == "KEY_LEFT") ? "KEY_RIGHT" : "KEY_LEFT"
    }
    switch (d.code) {
        case "KEY_LEFT":
            try {
                if (serviceOrderList.getItem().target == "time" && requestedTime > 0) {
                    requestedTime--;
                    top.Time.setTime(requestedTime);
                    if (document.getElementById("serviceorderTime")) {
                        document.getElementById("serviceorderTime").innerHTML = top.Time.getSelectedTime()
                    }
                } else {
                    if (serviceOrderList.getItem().target == "guest" && requestedGuest > 1) {
                        requestedGuest--;
                        if (document.getElementById("serviceorderGuest")) {
                            document.getElementById("serviceorderGuest").innerHTML = requestedGuest
                        }
                    } else {
                        if (serviceOrderList.getItem().target == "date" && requestedDateDiff > 0) {
                            requestedDateDiff--;
                            if (document.getElementById("serviceorderDate")) {
                                document.getElementById("serviceorderDate").innerHTML = top.Clock.addDays(requestedDateDiff, "dd - M - yyyy")
                            }
                        } else {
                            if (serviceOrderList.getItem().target == "alarm_time" && requestedTime > 0) {
                                requestedTime--;
                                top.Time.setTime(requestedTime);
                                if (document.getElementById("serviceorderAlarmTime")) {
                                    selectedTime = top.Time.getSelectedTime();
                                    document.getElementById("serviceorderAlarmTime").innerHTML = selectedTime
                                }
                            } else {
                                if (serviceOrderList.getItem().target == "alarm_date" && requestedDateDiff >= 1) {
                                    requestedDateDiff--;
                                    if (document.getElementById("serviceorderAlarmDate")) {
                                        document.getElementById("serviceorderAlarmDate").innerHTML = top.Clock.addDays(requestedDateDiff, "dd - M - yyyy")
                                    }
                                } else {
                                    if (serviceOrderList.getItem().target == "alarm_type") {
                                        if (document.getElementById("serviceorderAlarmType")) {
                                            alarmType = (alarmType > 0) ? --alarmType : typeArray.length - 1;
                                            document.getElementById("serviceorderAlarmType").innerHTML = typeArray[alarmType];
                                            if (typeArray[alarmType] == "TV" || typeArray[alarmType] == "Radio") {
                                                tvSelected = 1;
                                                ringType = 0;
                                                document.getElementById("serviceorderAlarmRingTone").innerHTML = toneArray[ringType]
                                            } else {
                                                tvSelected = 0;
                                                udpNumber = 0;
                                                document.getElementById("serviceorderAlarmUDPNumber").innerHTML = udpArray[ringType]
                                            }
                                        }
                                    } else {
                                        if (serviceOrderList.getItem().target == "alarm_udpnumber") {
                                            if (document.getElementById("serviceorderAlarmUDPNumber") && tvSelected == 1) {
                                                udpNumber = (udpNumber > 0) ? --udpNumber : udpArray.length - 1;
                                                document.getElementById("serviceorderAlarmUDPNumber").innerHTML = udpArray[udpNumber]
                                            }
                                        } else {
                                            if (serviceOrderList.getItem().target == "alarm_ringtone") {
                                                if (document.getElementById("serviceorderAlarmRingTone") && tvSelected == 0) {
                                                    ringType = (ringType > 0) ? --ringType : toneArray.length - 1;
                                                    document.getElementById("serviceorderAlarmRingTone").innerHTML = toneArray[ringType]
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } catch (e) {
                x1 = e
            }
            break;
        case "KEY_RIGHT":
            if (serviceOrderList.getItem().target == "time" && top.Time.getMaxIndex() > requestedTime) {
                requestedTime++;
                top.Time.setTime(requestedTime);
                if (document.getElementById("serviceorderTime")) {
                    selectedTime = top.Time.getSelectedTime();
                    document.getElementById("serviceorderTime").innerHTML = selectedTime
                }
            } else {
                if (serviceOrderList.getItem().target == "guest" && requestedGuest < 100) {
                    requestedGuest++;
                    if (document.getElementById("serviceorderGuest")) {
                        document.getElementById("serviceorderGuest").innerHTML = requestedGuest
                    }
                } else {
                    if (serviceOrderList.getItem().target == "date" && requestedDateDiff < 100) {
                        requestedDateDiff++;
                        if (document.getElementById("serviceorderDate")) {
                            document.getElementById("serviceorderDate").innerHTML = top.Clock.addDays(requestedDateDiff, "dd - M - yyyy")
                        }
                    } else {
                        if (serviceOrderList.getItem().target == "alarm_date" && requestedDateDiff >= 0) {
                            requestedDateDiff++;
                            if (document.getElementById("serviceorderAlarmDate")) {
                                document.getElementById("serviceorderAlarmDate").innerHTML = top.Clock.addDays(requestedDateDiff, "dd - M - yyyy")
                            }
                        } else {
                            if (serviceOrderList.getItem().target == "alarm_time" && top.Time.getMaxIndex() > requestedTime) {
                                requestedTime++;
                                top.Time.setTime(requestedTime);
                                if (document.getElementById("serviceorderAlarmTime")) {
                                    selectedTime = top.Time.getSelectedTime();
                                    document.getElementById("serviceorderAlarmTime").innerHTML = selectedTime
                                }
                            } else {
                                if (serviceOrderList.getItem().target == "alarm_type") {
                                    if (document.getElementById("serviceorderAlarmType")) {
                                        alarmType = (alarmType < (typeArray.length - 1)) ? ++alarmType : 0;
                                        document.getElementById("serviceorderAlarmType").innerHTML = typeArray[alarmType];
                                        if (typeArray[alarmType] == "TV" || typeArray[alarmType] == "Radio") {
                                            tvSelected = 1;
                                            ringType = 0;
                                            document.getElementById("serviceorderAlarmRingTone").innerHTML = toneArray[ringType]
                                        } else {
                                            tvSelected = 0;
                                            udpNumber = 0;
                                            document.getElementById("serviceorderAlarmUDPNumber").innerHTML = udpArray[ringType]
                                        }
                                    }
                                } else {
                                    if (serviceOrderList.getItem().target == "alarm_udpnumber") {
                                        if (document.getElementById("serviceorderAlarmUDPNumber") && tvSelected == 1) {
                                            udpNumber = (udpNumber < (udpArray.length - 1)) ? ++udpNumber : 0;
                                            document.getElementById("serviceorderAlarmUDPNumber").innerHTML = udpArray[udpNumber]
                                        }
                                    } else {
                                        if (serviceOrderList.getItem().target == "alarm_ringtone") {
                                            if (document.getElementById("serviceorderAlarmRingTone") && tvSelected == 0) {
                                                ringType = (ringType < (toneArray.length - 1)) ? ++ringType : 0;
                                                document.getElementById("serviceorderAlarmRingTone").innerHTML = toneArray[ringType]
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
            break;
        case "KEY_UP":
            serviceOrderList.scrollUp(1);
            break;
        case "KEY_DOWN":
            try {
                serviceOrderList.scrollDown(1)
            } catch (e) {
                x = e
            }
            break;
        case "KEY_BACK":
            inLeftNavigator = true;
            document.getElementById("servicemsg").innerHTML = "";
            top.State.setState(top.State.SERVICE_LIST);
            serviceListShowHighlight();
            serviceOrderListHideHighlight();
            break;
        case "KEY_SELECT":
            if ((serviceOrderList.getItem().target == "submit") || (serviceOrderList.getItem().target == "alarm_submit")) {
                document.getElementById("servicemsg").innerHTML = "Thank You. Your Request will be processed.";
                if (serviceList.getItem().target == "wakeup") {
                    top.ServiceManager.setAlarmServiceRequest(serviceList.getItem().target, selectedTime, requestedDateDiff, typeArray[alarmType], udpNumber, toneArray[ringType])
                } else {
                    top.ServiceManager.setServiceRequest(serviceList.getItem().target, selectedTime, requestedDateDiff, requestedGuest)
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

function serviceInitScreen(b) {

    top.State.setState(top.State.SERVICE_LIST);
    top.ScreenManager.displayScreen(serviceGetScreenHtml());
    top.Clock.show(this, "globalClock");
    serviceInitMainList();
    serviceInitOrderAlarmList();
    top.CURRENT_MENU_ID = 0;
    clearInterval(top.GLOBAL_SLIDER_INTERVAL);
    clearInterval(top.GLOBAL_PROMOTION_INTERVAL);
    menuInitMainList();
    highlight_menu();
    menuInitWeatherListLoader();
    servicesPromotionData();
    top.Time.init();
    serviceMenuInitMainList();

}

function serviceUninitScreen() {
    top.Clock.stop();
    top.kwTimer.cancelTimer("WEATHER_SCROLL_DELAY");
    top.kwTimer.cancelTimer("WEATHER_REFRESH_TIMEOUT");
    if (top.SOCKET_SUPPORT == 1) {
        top.ListenerManager.stopWeatherLoad();
    }
    top.WeatherManager.isNewData = true;
    setToBinService()
}

function serviceInitMainList() {
    try {
        var b = [];
        serviceList = new top.List(top.ListType.BLOCK, serviceListData(), 0, 0, 0, top.SERVICE_LEFT_NAV_ROWS, document.getElementById("serviceListContainer"));
        serviceList.displayItem = serviceListDisplayItem;
        serviceList.displayEmptyList = serviceListDisplayEmptyList;
        serviceList.display = serviceListDisplay;
        serviceList.onBeforeDisplay = serviceListShowHighlight;
        serviceList.onIndexChanged = serviceListOnIndexChanged;
        serviceList.onAfterDisplay = serviceListOnAfterDisplay;
        serviceList.initList()
    } catch (c) {
        x = c
    }
}

function serviceInitOrderList() {
    try {
        var b = [];
        serviceOrderList = new top.List(top.ListType.SCROLL, serviceOrderListData(), 0, 0, 0, 3, document.getElementById("serviceInfoContainerContent"));
        serviceOrderList.displayItem = serviceOrderListDisplayItem;
        serviceOrderList.initList();
        serviceOrderListHideHighlight()
    } catch (c) {
        x = c
    }
}

function serviceInitOrderAlarmList() {
    try {
        var b = [];
        serviceOrderList = new top.List(top.ListType.SCROLL, serviceOrderAlarmData(), 0, 0, 0, 6, document.getElementById("serviceInfoContainerContent"));
        serviceOrderList.displayItem = serviceOrderListDisplayItem;
        serviceOrderList.initList();
        serviceOrderListHideHighlight()
    } catch (c) {
        x = c
    }
}

function serviceInitOrderListTaxi() {
    try {
        var b = [];
        serviceOrderList = new top.List(top.ListType.SCROLL, serviceOrderListDataTaxi(), 0, 0, 0, 4, document.getElementById("serviceInfoContainerContent"));
        serviceOrderList.displayItem = serviceOrderListDisplayItem;
        serviceOrderList.initList()
    } catch (c) {
        x = c
    }
}

function serviceListData() {
    var a = [];
    a.push({
        "class": "wakeupservice serviceNavListItems",
        target: "wakeup"
    });
    a.push({
        "class": "taxiservice serviceNavListItems",
        target: "taxi"
    });
    a.push({
        "class": "roomservice serviceNavListItems",
        target: "room"
    });
    a.push({
        "class": "laundryservice serviceNavListItems",
        target: "laundry"
    });
    return a
}

function serviceOrderListData() {
    var a = [];
    a.push({
        "class": "serviceorderTime",
        target: "time"
    });
    a.push({
        "class": "serviceorderDate",
        target: "date"
    });
    a.push({
        "class": "serviceorderSubmit",
        target: "submit"
    });
    return a
}

function serviceOrderAlarmData() {
    var a = [];
    a.push({
        "class": "serviceorderAlarmTime",
        target: "alarm_time"
    });
    a.push({
        "class": "serviceorderAlarmDate",
        target: "alarm_date"
    });
    a.push({
        "class": "serviceorderAlarmType",
        target: "alarm_type"
    });
    a.push({
        "class": "serviceorderAlarmUDPNumber",
        target: "alarm_udpnumber"
    });
    a.push({
        "class": "serviceorderAlarmRingTone",
        target: "alarm_ringtone"
    });
    a.push({
        "class": "serviceorderAlarmSubmit",
        target: "alarm_submit"
    });
    return a
}

function serviceOrderListDataTaxi() {
    var a = [];
    a.push({
        "class": "serviceorderTime",
        target: "time"
    });
    a.push({
        "class": "serviceorderDate",
        target: "date"
    });
    a.push({
        "class": "serviceorderGuest",
        target: "guest"
    });
    a.push({
        "class": "serviceorderSubmit",
        target: "submit"
    });
    return a
}

function setToBinService() {
    serviceList = null;
    delete serviceList;
    serviceList = undefined;
    serviceOrderList = null;
    delete serviceOrderList;
    serviceOrderList = undefined;
    userPass = null;
    delete userPass;
    userPass = undefined;
    requestedTime = null;
    delete requestedTime;
    requestedTime = undefined;
    selectedTime = null;
    delete selectedTime;
    selectedTime = undefined;
    requestedDateDiff = null;
    delete requestedDateDiff;
    requestedDateDiff = undefined;
    requestedDateDate = null;
    delete requestedDateDate;
    requestedDateDate = undefined;
    requestedGuest = null;
    delete requestedGuest;
    requestedGuest = undefined;
    alarmType = 0;
    udpNumber = 0;
    ringType = 0
}

function clearServiceVars() {
    userPass = "";
    requestedTime = 0;
    selectedTime = "00:00";
    requestedDateDiff = 0;
    requestedDateDate = null;
    requestedGuest = 1;
    alarmType = 0;
    tvSelected = 1;
    udpNumber = 0;
    ringType = 0
}


//Services Promotions

//End Of Services promotions


function initServiceVars() {
    serviceList = null;
    serviceOrderList = null;
    userPass = "";
    serviceList = null;
    serviceOrderList = null;
    requestedTime = 0;
    selectedTime = "00:00";
    requestedDateDiff = 0;
    requestedDateDate = null;
    requestedGuest = 1;
    alarmType = 0;
    tvSelected = 1;
    udpNumber = 0;
    ringType = 0;
    typeArray = new Array("TV", "Radio", "RingTone");
    udpArray = new Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20);
    toneArray = new Array("Default", "Classic", "Tone1", "Tone2")
}



function highlight_menu(){
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
};
