var userPass = "";
var serviceList = null;
var serviceOrderList = null;
var requestedTime = 0;
var requestedHour = 0;
var requestedMinute = 0;
var selectedTime = "00:00";
var selectedHour = "00";
var selectedMinute = "00";
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
var mac = "";
var guest_code = null;
var room_number = null;

function serviceEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            //top.changeBackgroundImg('SERVICES');
            top.BG_IMG = 'url(' + top.IMAGES_PREFIX + 'BGS/' + top.BACKGROUND_ARRAY['SERVICES'] + ')';
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
            // inLeftNavigator = false;
            // if (top.DEFAULT_DIRECTION == "ltr") {
            //     top.State.setState(top.State.SERVICE_ORDER);
            //     serviceListHideHighlight();
            //     serviceOrderListShowHighlight();
            //     switchService();
            // }
            break;
        case "KEY_LEFT":
        
          if (top.DEFAULT_DIRECTION == "rtl") {
              top.State.setState(top.State.SERVICE_ORDER);
              serviceListHideHighlight();
              serviceOrderListShowHighlight()

          }
          break;
        case "KEY_UP":
            if (serviceList.getItem().target == "wakeup") {
                top.State.setState(top.State.MENU_MAIN);
                var correct_menu_id = top.PRV_MENU_ID - top.CURRENT_MENU_ID;
                if (correct_menu_id != 0) {
                    menuMainList.scrollDown(correct_menu_id);
                }
            }
            clearServiceVars();
            serviceList.scrollUp(1);
            switchService();
            serviceOrderListHideHighlight();
            
            break;
        case "KEY_DOWN":
            clearServiceVars();
            serviceList.scrollDown(1);
            switchService();
            serviceOrderListHideHighlight();
            
            break;
        case "KEY_BACK":
            top.ScreenManager.load("MENU");
            break;
        case "KEY_SELECT":
            inLeftNavigator = false;
            if (top.DEFAULT_DIRECTION == "ltr" || top.DEFAULT_DIRECTION == "rtl") {
                top.State.setState(top.State.SERVICE_ORDER);
                serviceListHideHighlight();
                serviceOrderListShowHighlight();
                switchService();
            }
            // top.State.setState(top.State.SERVICE_ORDER);
            // serviceListHideHighlight();
            // serviceOrderListShowHighlight();
            break;
        case "KEY_CODE":
            userPass += "" + d.args.value;
            top.kwConsole.print("KEY CODE,:" + userPass);
            break;
        case "KEY_RED":
            if (top.GLOBAL_FIRE_ALARM == 1) {
                stopAlarm();
            }
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
                if (serviceOrderList.getItem().target == "hour" && requestedHour > 0) {
                    requestedHour--;
                    top.Hours.setHour(requestedHour);
                    if (document.getElementById("serviceorderHour")) {
                        document.getElementById("serviceorderHour").innerHTML = top.Hours.getSelectedHour();
                    }
                } else{
                    if (serviceOrderList.getItem().target == "minute" && requestedMinute > 0) {
                        requestedMinute--;
                        top.Minutes.setMinute(requestedMinute);
                        if (document.getElementById("serviceorderMinute")) {
                            document.getElementById("serviceorderMinute").innerHTML = top.Minutes.getSelectedMinute();
                        }
                    }else {
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
                            if (serviceOrderList.getItem().target == "alarm_hour" && requestedHour > 0) {
                                requestedHour--;
                                top.Hours.setHour(requestedHour);
                                if (document.getElementById("serviceorderAlarmHour")) {
                                    selectedHour = top.Hours.getSelectedHour();
                                    document.getElementById("serviceorderAlarmHour").innerHTML = selectedHour
                                }
                            } else {
                                if (serviceOrderList.getItem().target == "alarm_minute" && requestedMinute > 0) {
                                    requestedMinute--;
                                    top.Minutes.setMinute(requestedMinute);
                                    if (document.getElementById("serviceorderAlarmMinute")) {
                                        selectedMinute = top.Minutes.getSelectedMinute();
                                        document.getElementById("serviceorderAlarmMinute").innerHTML = selectedMinute
                                    }
                                }else{

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
                                                if (typeArray[alarmType] == "TV") {
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
                                                }else{
                                                    if (serviceOrderList.getItem().target == "taxi_hour" && requestedHour > 0) {
                                                        requestedHour--;
                                                        top.Hours.setHour(requestedHour);
                                                        if (document.getElementById("serviceorderTaxiHour")) {
                                                            document.getElementById("serviceorderTaxiHour").innerHTML = top.Hours.getSelectedHour();
                                                        }
                                                    }else{
                                                        if (serviceOrderList.getItem().target == "taxi_minute" && requestedMinute > 0) {
                                                            requestedMinute--;
                                                            top.Minutes.setMinute(requestedMinute);
                                                            if (document.getElementById("serviceorderTaxiMinute")) {
                                                                document.getElementById("serviceorderTaxiMinute").innerHTML = top.Minutes.getSelectedMinute();
                                                            }
                                                        }
                                                    }
                                                }
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
            if (serviceOrderList.getItem().target == "hour" && top.Hours.getMaxIndex() > requestedHour) {
                requestedHour++;
                top.Hours.setHour(requestedHour);
                if (document.getElementById("serviceorderHour")) {
                    selectedHour = top.Hours.getSelectedHour();
                    document.getElementById("serviceorderHour").innerHTML = selectedHour
                }
            } else {
                if (serviceOrderList.getItem().target == "minute" && top.Minutes.getMaxIndex() > requestedMinute) {
                    requestedMinute++;
                    top.Minutes.setMinute(requestedMinute);
                    if (document.getElementById("serviceorderMinute")) {
                        selectedMinute = top.Minutes.getSelectedMinute();
                        document.getElementById("serviceorderMinute").innerHTML = selectedMinute
                    }
                }else {
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
                                if (serviceOrderList.getItem().target == "alarm_hour" && top.Hours.getMaxIndex() > requestedHour) {
                                    //console.log(top.Hours.getMaxIndex() > requestedHour,top.Hours.getMaxIndex(),requestedHour);
                                    requestedHour++;
                                    top.Hours.setHour(requestedHour);
                                    // console.log(requestedHour);
                                    if (document.getElementById("serviceorderAlarmHour")) {
                                        selectedHour = top.Hours.getSelectedHour();
                                        document.getElementById("serviceorderAlarmHour").innerHTML = selectedHour
                                    }
                                } else { 
                                    if (serviceOrderList.getItem().target == "alarm_minute" && top.Minutes.getMaxIndex() > requestedMinute) {
                                        requestedMinute++;
                                        top.Minutes.setMinute(requestedMinute);
                                        if (document.getElementById("serviceorderAlarmMinute")) {
                                            selectedMinute = top.Minutes.getSelectedMinute();
                                            document.getElementById("serviceorderAlarmMinute").innerHTML = selectedMinute
                                        }
                                    }else{
                                        if (serviceOrderList.getItem().target == "alarm_type") {
                                            if (document.getElementById("serviceorderAlarmType")) {
                                                alarmType = (alarmType < (typeArray.length - 1)) ? ++alarmType : 0;
                                                document.getElementById("serviceorderAlarmType").innerHTML = typeArray[alarmType];
                                                if (typeArray[alarmType] == "TV") {
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
                                                }else {
                                                    if (serviceOrderList.getItem().target == "taxi_hour" && top.Hours.getMaxIndex() > requestedHour) {
                                                        requestedHour++;
                                                        top.Hours.setHour(requestedHour);
                                                        if (document.getElementById("serviceorderTaxiHour")) {
                                                            selectedHour = top.Hours.getSelectedHour();
                                                            document.getElementById("serviceorderTaxiHour").innerHTML = selectedHour
                                                        }
                                                    }else{
                                                        if (serviceOrderList.getItem().target == "taxi_minute" && top.Minutes.getMaxIndex() > requestedMinute) {
                                                            requestedMinute++;
                                                            top.Minutes.setMinute(requestedMinute);
                                                            if (document.getElementById("serviceorderTaxiMinute")) {
                                                                selectedMinute = top.Minutes.getSelectedMinute();
                                                                document.getElementById("serviceorderTaxiMinute").innerHTML = selectedMinute
                                                            }
                                                        }
                                                    }
                                                }

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
            //document.getElementById("servicemsg").innerHTML = "";
            top.State.setState(top.State.SERVICE_LIST);
            serviceListShowHighlight();
            serviceOrderListHideHighlight();
            break;
        case "KEY_SELECT":
            if ((serviceOrderList.getItem().target == "submit") || (serviceOrderList.getItem().target == "alarm_submit") || (serviceOrderList.getItem().target == "taxi_submit") || (serviceOrderList.getItem().target == "alarm_delete")) {
                
                //console.log(serviceList.getItem().target);
                if (serviceList.getItem().target == "wakeup" && serviceOrderList.getItem().target == "alarm_submit") {
                    var alarm_time = selectedHour+":"+selectedMinute;

                    var dateSelected = new Date();
                    dateSelected.setDate(dateSelected.getDate() + requestedDateDiff);
                    var alarm_date = this.formatDate(dateSelected);

                    //console.log();
                    top.ServiceManager.setAlarmServiceRequest(serviceList.getItem().target, alarm_time, requestedDateDiff, typeArray[alarmType], udpArray[udpNumber], toneArray[ringType], mac);

                    //Success
                    var b = '<div id="servicemsg" class="servicemsg">';
                    b += '<div id="serviceNotificationTitle">Your Alarm has been set to '+alarm_date+' at '+alarm_time+' </div>';
                    b += '<div id="serviceNotificationBody">Thank You !</div><div>';
                    document.getElementById("serviceMessageBox").innerHTML = b;
                    setTimeout(function(){ 
                        document.getElementById("serviceMessageBox").innerHTML = ""; 
                        getCurrentAlarm(mac);
                    }, 4000);
                } else if (serviceOrderList.getItem().target == "taxi_submit") {
                    var taxi_time = selectedHour+":"+selectedMinute;
                    
                }else if (serviceList.getItem().target == "wakeup" && serviceOrderList.getItem().target == "alarm_delete") {
                    if (top.GLOBAL_ALARM_DATA == null) {
                         var b = '<div id="servicemsg" class="servicemsg">';
                        b += '<div id="serviceNotificationTitle">Your Alarm not set </div>';
                        b += '<div id="serviceNotificationBody">Thank You !</div><div>';
                        document.getElementById("serviceMessageBox").innerHTML = b;
                        setTimeout(function(){ 
                            document.getElementById("serviceMessageBox").innerHTML = ""; 
                            getCurrentAlarm(mac);
                        }, 4000);
                    }else{
                        RemoveAlarm(mac);
                        //Success
                        var b = '<div id="servicemsg" class="servicemsg">';
                        b += '<div id="serviceNotificationTitle">Your Alarm has been Removed </div>';
                        b += '<div id="serviceNotificationBody">Thank You !</div><div>';
                        document.getElementById("serviceMessageBox").innerHTML = b;
                        setTimeout(function(){ 
                            document.getElementById("serviceMessageBox").innerHTML = ""; 
                            getCurrentAlarm(mac);
                        }, 4000);
                    }
                }else {
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

    mac = top.Player.getMacAddress();
    top.State.setState(top.State.SERVICE_LIST);
    top.ScreenManager.displayScreen(serviceGetScreenHtml());
    top.Clock.show(this, "globalClock");
    serviceInitMainList();
    serviceInitOrderAlarmList();
    top.CURRENT_MENU_ID = 0;
    menuInitMainList();
    highlight_menu();
    menuInitWeatherListLoader();
    top.Time.init();
    top.Hours.init();
    top.Minutes.init();
    //serviceMenuInitMainList();
    // document.getElementById("servicemsg").style.visibility = "hidden";
    top.ALARM_CONTAINER = document.getElementById("showAlarmContainer");
    top.ALARM_CONTAINER.style.visibility = "hidden";

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
        serviceOrderList = new top.List(top.ListType.SCROLL, serviceOrderListData(), 0, 0, 0, 4, document.getElementById("serviceInfoContainerContent"));
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
        serviceOrderList = new top.List(top.ListType.SCROLL, serviceOrderAlarmData(), 0, 0, 0, 8, document.getElementById("serviceInfoContainerContent"));
        serviceOrderList.displayItem = serviceOrderListDisplayItem;
        serviceOrderList.initList();
        serviceOrderListHideHighlight();
    } catch (c) {
        x = c
    }
}

function serviceInitOrderListTaxi() {
    try {
        var b = [];
        serviceOrderList = new top.List(top.ListType.SCROLL, serviceOrderListDataTaxi(), 0, 0, 0, 5, document.getElementById("serviceInfoContainerContent"));
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
        "class": "serviceorderHour",
        target: "hour"
    });
    a.push({
        "class": "serviceorderMinute",
        target: "minute"
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
        "class": "serviceorderAlarmHour",
        target: "alarm_hour"
    });
    a.push({
        "class": "serviceorderAlarmMinute",
        target: "alarm_minute"
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
    a.push({
        "class": "serviceorderAlarmList",
        target: "alarm_delete"
    });
    return a
}

function serviceOrderListDataTaxi() {
    var a = [];
    a.push({
        "class": "serviceorderTaxiHour",
        target: "taxi_hour"
    });
    a.push({
        "class": "serviceorderTaxiMinute",
        target: "taxi_minute"
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
        "class": "serviceorderTaxiSubmit",
        target: "taxi_submit"
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

    requestedHour = null;
    delete requestedHour;
    requestedHour = undefined;
    requestedMinute = null;
    delete requestedMinute;
    requestedMinute = undefined;

    selectedHour = null;
    delete selectedHour;
    selectedHour = undefined;
    selectedMinute = null;
    delete selectedMinute;
    selectedMinute = undefined;

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
    requestedHour = 0;
    requestedMinute = 0;
    selectedTime = "00:00";
    selectedHour = "00";
    selectedMinute = "00";
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
    requestedHour = 0;
    requestedMinute = 0;
    selectedTime = "00:00";
    selectedHour = "00";
    selectedMinute = "00";
    requestedDateDiff = 0;
    requestedDateDate = null;
    requestedGuest = 1;
    alarmType = 0;
    tvSelected = 1;
    udpNumber = 0;
    ringType = 0;
    typeArray = new Array("TV", "RingTone");
    udpArray = new Array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20);
    toneArray = new Array("Alarm 1", "Alarm 2", "Alarm 3", "Alarm 4")
}



function highlight_menu(){
    var current_menu_id =  top.CURRENT_MENU_ID;
    var selected_menu_id = top.PRV_MENU_ID;
    var  menu_id = document.getElementsByClassName("menuMainListItem")[selected_menu_id]; //
    var current_class = menu_id.className;
    var new_class = current_class +"Semi_selected";
    var prev_menu_id = document.getElementsByClassName("menuMainListItem")[current_menu_id];
    var prev_class = prev_menu_id.className;
    prev_class = prev_class.replace('Selected','');
    prev_menu_id.className = prev_class;
    menu_id.className = new_class;
}


function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
};
function getCurrentAlarm(mac){
    var i = top.SERVICEALARM_CURRENT + "mac/" + mac +"/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", i, true, this, setCurrentAlarm);
}
function setCurrentAlarm(alarm){
        if (alarm.error) {
            top.GLOBAL_ALARM_DATA = null;
            alert(alarm.error);
            document.getElementById("activeAlarmTimeContainer").innerHTML = "&nbsp;ALARM NOT SET";
        }else{
            var jsonAlarm = top.jsonParser(alarm);
            top.GLOBAL_ALARM_DATA = jsonAlarm[0];
            var alarmTime = (top.GLOBAL_ALARM_DATA == null) ? "ALARM NOT SET" : top.GLOBAL_ALARM_DATA.alarm_time;
            document.getElementById("activeAlarmTimeContainer").innerHTML = "&nbsp;"+alarmTime;
        }
        
}
function RemoveAlarm(mac){
    if (top.GLOBAL_ALARM_DATA != null) {
        var b = top.SERVICEALARM_REMOVE + "mac/" + mac;
        top.kwUtils.kwXMLHttpRequest("POST", b, true);
    }
}

function stopAlarm(){
    top.GLOBAL_FIRE_ALARM = 0;
    if (top.GLOBAL_ALARM_DATA.type == "RingTone") {
        top.Player.stop();
    }
    top.ALARM_CONTAINER.style.visibility = "hidden";
    RemoveAlarm(top.Player.getMacAddress());
    top.GLOBAL_ALARM_DATA = null;
    document.getElementById("activeAlarmTimeContainer").innerHTML = "&nbsp;ALARM NOT SET";
}

function displayBillInfo(){
    var url = top.SERVICE_GUEST_INFO+"id/"+top.USER_ID+"/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", url, true, this, guestinfo);
}

function guestinfo(b){
    b = (typeof b === "object") ? b : JSON.parse(b);
    //console.log(b);
    guest_code = b.guest_code;
    room_number = b.room_number;


    // php CURL

    var urlx = top.COMMON_APP_URL+"init_view_bill/guest_code/"+guest_code+"/room_no/"+room_number+"/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", urlx, true, this, viewbillResponse);

}


function viewbillResponse(response) {
    response = (typeof response === "object") ? response : JSON.parse(response);
    if(response != null){
        setTimeout(function () {
            //Requesting Bill info
            var url = top.COMMON_APP_URL+"bill_info/guest_code/"+guest_code+"/room_no/"+room_number+"/format/json";
            top.kwUtils.kwXMLHttpRequest("GET", url, true, this, guestbillinfo);
        },6000);
    }
}


function guestbillinfo(b) {
    b = (typeof b === "object") ? b : JSON.parse(b);
    //var bill_items = b.bill_items;
    var bill_total = b.bill_total/100;

    bill_total = bill_total.toFixed(2);
    var guestName = top.GUEST_NAME;
    var HTMLGuestData = "<div id='bill_title'>View Bill</div><div id='guest_info'><div id='guest_room'><span id='guest_room_label'>Guest Room #</span><span id='guest_room_text'>"+room_number+"</span></div><div id='guest_name'><span id='guest_name_label'>Guest Name&nbsp;&nbsp;&nbsp;</span><span id='guest_name_text'>"+guestName.replace("Welcome","")+"</span></div></div>";
    // var HTMLBillItemlist = "";
    // for(i=0; i<bill_items.length; i++){
    //     HTMLBillItemlist += "<li><span id='bill_item'></span>"+bill_items[i].descreption+"<span id='bill_item_amount'>"+bill_items[i].amount+"</span></li>";
    //     console.log(bill_items[i].descreption);
    // }
    var HTMLBillTotal = HTMLGuestData+"<div id='bill_total_container'><span id='bill_total_label'>Total Amount</span><span id='bill_total_amount'>"+bill_total+"</span></div>";
    //Display bill
    var loadingText = document.getElementById('loading_img');
    loadingText.style.visibility = "hidden";
    //<marquee direction='up' scrollamount='3'><ul id='bill_items'>"+HTMLBillItemlist+"</ul></marquee> //Bill Items Preview Not available in Protel <div id='bill_items_container'></div>
    var HTMLviewbill = "<div id='guest_bill'><div id='bill_total'>"+HTMLBillTotal+"</div></div>";
    var guestBillContainer = document.getElementById("serviceInfoContainerContent");
    guestBillContainer.innerHTML = HTMLviewbill;
    //console.log(HTMLviewbill);

};

