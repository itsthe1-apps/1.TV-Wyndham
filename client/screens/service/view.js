var services_promotion_index; // added by ** Lakshan **
var promotions = new Array(); //Promotion Text Array added by ** Lakshan **


function serviceGetScreenHtml() {

    var promotionText = "Promotions";
    if (top.DEFAULT_LANGUAGE == "ar") {
        promotionText = " إعلانات وعروض خاصة ";
    }

    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="showAlarmContainer" class="showAlarmContainer"><div id="alarmShowText">Press F1 Button To Dissmiss</div></div>'
    b += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    b += '<div id="messageBlock" class="messageBlock"></div>';
    b += '<div class="header">';
    b += '<div id="globalLogo" class="globalLogo" style=""></div>';
    b += '<div id="homeweather" class="homeweather"></div>';
    // b += '<div id="globalLogoRight" class="globalLogoRight"></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += menuGetMenuListHtml();
    b += "</div>";    
    // b += '<div id="globalTitle" class="globalTitle serviceListTitle">' + top.globalGetLabel("SERVICE_TITLE") + "</div>";
    b += '<div id="serviceMessageBox" class="serviceMessageBox"></div>';
    b += '<div id="serviceListInfo" class="serviceListInfo"></div>';
    b += '<div id="serviceListHighlight" class="serviceListHighlight globalServiceHighlight"></div>';
    b += '<div id="serviceListContainer" class="serviceListContainer"></div>';
    b += '<div id="serviceOrderListHighlight" class="serviceOrderListHighlight globalServiceOrderHighlight"></div>';
    b += '<div id="serviceInfoContainer" class="serviceInfoContainer">';
    b += '<div id="serviceInfoContainerTitle" class="serviceInfoContainerTitle"></div>';
    b += '<div id="serviceInfoContainerContent" class="serviceInfoContainerContent">';
    b += "</div></div>";
    b += '<div id="ticker_tape_services" class="ticker_tape_services"><div id="promotion_id">'+promotionText+'</div><p id="services_promotion_text"></p></div>';
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showServiceOrderFooter() + "</div>";
    b += "</div>";
    return b
}

function showServiceOrderFooter() {
    var a = top.globalGetLabel("RC_MENU");
     if (top.DEFAULT_LANGUAGE == 'ar') {
        menu = "<div class=footerImage><img src=images/rc/menu-button.jpg  /></div><div class=footerText> القائمة الفرعية  </div>";
        a = menu;
    }
    return a
}

function serviceListShowHighlight() {
    document.getElementById("serviceListHighlight").style.visibility = "visible"
}

function serviceListHideHighlight() {
    document.getElementById("serviceListHighlight").style.visibility = "hidden"
}

function serviceListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + '">&nbsp;</div>'
    }
    return html
}

function serviceListOnIndexChanged(c, i) {
    this.display();
    serviceDisplayRestInfo(this.getItem());
    var k = document.getElementById("serviceListHighlight");
    var j = window.getComputedStyle(document.getElementsByClassName("serviceNavListItems")[0], null).getPropertyValue("margin-bottom");
    var m = window.getComputedStyle(document.getElementsByClassName("serviceNavListItems")[0], null).getPropertyValue("height");
    var h = window.getComputedStyle(document.getElementsByClassName("serviceListContainer")[0], null).getPropertyValue("top");
    var n = parseInt(h, 10) - (parseInt(j, 10) / 2);
    var l;
    var g = this.getSelected();
    l = n + Math.floor(g % top.SERVICE_LEFT_NAV_ROWS) * (parseInt(m, 10) + parseInt(j, 10));
    l = l+2;
    top.TransitionManager.run(l, c, k)
}

function serviceListDisplay() {
    this.onBeforeDisplay();
    if (this.getLength() === 0) {
        return this.displayEmptyList()
    }
    var d = new top.Iterator(0, this.getIndex() - this.getSelected(), this.getLength(), this.isCyclic());
    var f = 0;
    var e = "";
    while (f < this.getDisplayCount()) {
        if (d.isChanged() && f < this.getLength()) {
            e += this.displayItem(d.getIndex(), f, f == this.getSelected());
            d.increaseIndex()
        } else {
            e += this.displayItem(-1, f, false)
        }
        f++
    }
    this._container.innerHTML = e;
    this.onAfterDisplay()
}

function serviceListDisplayEmptyList() {
    serviceListListHideHighlight();
    this._container.innerHTML = '<div class="serviceListEmptyRestList">' + top.globalGetLabel("REST_LIST_EMPTY") + "</div>"
}

function serviceDisplayRestInfo(c) {
    //console.log("serviceDisplayRestInfo :",c);
    var d = "";
    var backgroundImg = document.getElementById("serviceInfoContainer");
    if (c) {
        if (c.target == "taxi") {
            document.getElementById("serviceInfoContainerTitle").innerHTML = ""; //"Taxi Request Service"
            
            if (top.DEFAULT_LANGUAGE == 'ar') {
                backgroundImg.style.backgroundImage = "url('images/1080/wyndham_en/service/Taxi_ar.jpg')";
            }else{
                backgroundImg.style.backgroundImage = "url('images/1080/wyndham_en/service/Taxi.jpg')";
            }
            hideAlarmTime();
        } else {
            if (c.target == "wakeup") {
                var lang_text_title = "Set Alarm"
                if (top.DEFAULT_LANGUAGE == 'ar') {
                    lang_text_title = "حديد موعد للإيقاظ  ";
                }
                document.getElementById("serviceInfoContainerTitle").innerHTML = lang_text_title;
                if (!document.getElementById("activeAlarmTime")) {
                    var div = document.createElement("Div"); 
                    div.className = "activeAlarmTime";
                    div.id = "activeAlarmTime";

                    var lang_text_alarm_current_val = "ALARM NOT SET";
                    if (top.DEFAULT_LANGUAGE == 'ar') {
                        lang_text_alarm_current_val = "وقت الإيقاظ لم يتم ضبطه ";
                    }

                    var alarmTime = (top.GLOBAL_ALARM_DATA == null) ? lang_text_alarm_current_val : top.GLOBAL_ALARM_DATA.alarm_time;

                    var lang_text_alarm_current = "Current Alarm :";
                    if (top.DEFAULT_LANGUAGE == 'ar') {
                        lang_text_alarm_current = "التنبيه الحالي:";
                    }

                    div.innerHTML = '<div id="activeAlarmTimeLable">'+lang_text_alarm_current+'</div><div id="activeAlarmTimeContainer">&nbsp;'+alarmTime+'</div>';
                    backgroundImg.appendChild(div);
                }else{
                    document.getElementById("activeAlarmTime").style.visibility = "visible";
                }

                
                if (top.DEFAULT_LANGUAGE == 'ar') {
                    backgroundImg.style.backgroundImage = "url('images/1080/wyndham_en/service/Alarm_ar.jpg')";
                }else{
                    backgroundImg.style.backgroundImage = "url('images/1080/wyndham_en/service/Alarm.jpg')";
                }
            } else {
                if (c.target == "laundry") {
                    document.getElementById("serviceInfoContainerTitle").innerHTML = ""; //Laundry Service Request
                     if (top.DEFAULT_LANGUAGE == 'ar') {
                        backgroundImg.style.backgroundImage = "url('images/1080/wyndham_en/service/Laundry_ar.jpg')";
                    }else{
                        backgroundImg.style.backgroundImage = "url('images/1080/wyndham_en/service/Laundry.jpg')";
                    }
                    

                    //Set loading png
                    var html_text_en = "<div id='loading_img'><img src='images/1080/wyndham_en/service/loading.gif'/><p id='loading_text'>Processing Your Request<br/>Please Wait...</p></div>";
                    var html_text_ar = "<div id='loading_img'><img src='images/1080/wyndham_en/service/loading.gif'/><p id='loading_text'>... لمعالجة طلبك يرجى الانتظار  </p></div>";
                    var loadingHTML = html_text_en;
                    if (top.DEFAULT_LANGUAGE == "ar") {
                        loadingHTML = html_text_ar;
                    }
                    document.getElementById("serviceInfoContainerTitle").innerHTML = loadingHTML;
                    //Send request to get bill info
                    displayBillInfo();

                    hideAlarmTime();
                } else {
                    if (c.target == "room") {
                        document.getElementById("serviceInfoContainerTitle").innerHTML = ""; //Room Service Request
                        if (top.DEFAULT_LANGUAGE == 'ar') {
                            backgroundImg.style.backgroundImage = "url('images/1080/wyndham_en/service/Roomservice_ar.jpg')";
                        }else{
                            backgroundImg.style.backgroundImage = "url('images/1080/wyndham_en/service/Roomservice.jpg')";
                        }
                        hideAlarmTime();
                    }
                }
            }
        }
    }
}

function hideAlarmTime(){
    if (document.getElementById("activeAlarmTime")) {
        document.getElementById("activeAlarmTime").style.visibility = "hidden";
    }
}

function serviceListOnAfterDisplay() {
    //serviceDisplayRestInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
}

function serviceOrderListDisplayItem(index, position, selected) {
    if (inLeftNavigator == true) {
        selected = false
    }
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.target == "hour") {
            // html += '<div class="alarmRowItemServiceLable">Requested Time :</div>';
            // html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + selectedHour + "</div>"
        }else{
            if (item.target == "minute") {
            //html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + selectedMinute + "</div>"
            } else {
                if (item.target == "date") {
                    // html += '<div class="alarmRowItemServiceDateLable">Requested Date :</div>';
                    // html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + top.Clock.addDays(requestedDateDiff, "dd - M - yyyy") + "</div>"
                } else {
                    if (item.target == "alarm_date") {
                        var lang_text_alarm_date = "Alarm Date :";
                        if (top.DEFAULT_LANGUAGE == 'ar') {
                            lang_text_alarm_date = " :تاريخ التنبيه";
                        }
                        html += '<div class="alarmRowItemDateLable">'+lang_text_alarm_date+'</div>';
                        html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + top.Clock.addDays(requestedDateDiff, "dd - M - yyyy") + "</div>"
                    } else {
                        if (item.target == "alarm_hour") {
                            var lang_text_alarm_time = "Alarm Time :";
                            if (top.DEFAULT_LANGUAGE == 'ar') {
                                lang_text_alarm_time = " : وقت التنبيه ";
                            }
                            html += '<div class="alarmRowItemLable">'+lang_text_alarm_time+'</div>';
                            html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + selectedHour + "</div>"
                            html += '<div id="hourMinSeparator">:</div>';
                        }else{
                            if (item.target == "alarm_minute") {
                            html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + selectedMinute + "</div>"
                            } else {
                                if (item.target == "alarm_type") {
                                    var lang_text_alarm_type = "Alarm Type ";
                                    if (top.DEFAULT_LANGUAGE == 'ar') {
                                        lang_text_alarm_type = "نوع التنبيه ";
                                    }
                                    html += '<div class="alarmRowItemTypeLable">'+lang_text_alarm_type+'</div>';
                                    html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + typeArray[alarmType] + "</div>"
                                } else {
                                    var lang_text_channel_no = "Channel No ";
                                    if (top.DEFAULT_LANGUAGE == 'ar') {
                                        lang_text_channel_no = "رقم القناة "; 
                                    }
                                    if (item.target == "alarm_udpnumber") {
                                        html += '<div class="alarmRowItemChannelLable">'+lang_text_channel_no+'</div>';
                                        html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + udpArray[udpNumber] + "</div>"
                                    } else {
                                        var lang_text_ringtone = "Ringtone ";
                                        if (top.DEFAULT_LANGUAGE == 'ar') {
                                            lang_text_ringtone = " النغمة المختارة "; 
                                        }
                                        if (item.target == "alarm_ringtone") {
                                            html += '<div class="alarmRowItemRingtoneLable">'+lang_text_ringtone+'</div>';
                                            html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + toneArray[ringType] + "</div>"
                                        } else {
                                            if (item.target == "guest") {
                                                // html += '<div class="alarmRowItemTaxiGuestLable">Number of Guests</div>';
                                                // html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + requestedGuest + "</div>"
                                            } else {
                                                if (item.target == "submit") {
                                                    //html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">Submit</div>'
                                                } else {
                                                    if (item.target == "taxi_hour") {
                                                        // html += '<div class="alarmRowItemTaxiLable">Requested Time :</div>';
                                                        // html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + selectedHour + "</div>"
                                                        // html += '<div id="hourMinSeparator">:</div>'
                                                    }else{
                                                        if (item.target == "taxi_minute") {
                                                            //html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + selectedMinute + "</div>"
                                                        }else{
                                                            if (item.target == "taxi_submit") {
                                                                 //html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">Submit</div>'
                                                            }else{
                                                                var lang_text_set_alarm = "SET ALARM ";
                                                                if (top.DEFAULT_LANGUAGE == 'ar') {
                                                                    lang_text_set_alarm = "حديد موعد للإيقاظ  ";
                                                                }
                                                                if (item.target == "alarm_submit") {
                                                                    html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">'+lang_text_set_alarm+'</div>'
                                                                }else{
                                                                    var lang_text_delete_alarm = "DELETE ALARM ";
                                                                    if (top.DEFAULT_LANGUAGE == 'ar') {
                                                                        lang_text_delete_alarm = " إلغاء التنبيه "; 
                                                                    }
                                                                    if (item.target == "alarm_delete") {
                                                                        html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">'+lang_text_delete_alarm+'</div>'
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
                }
            }
        }
    }
    return html
}

function serviceOrderListShowHighlight() {
    document.getElementById("serviceOrderListHighlight").style.visibility = "visible";
    document.getElementById("serviceOrderListHighlight").style.top = "262px"
}

function serviceOrderListHideHighlight() {
    document.getElementById("serviceOrderListHighlight").style.visibility = "hidden"
}

function serviceOrderListOnAfterDisplay() {
    serviceDisplayRestInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
}

//Dine Promotions


//End of Dine Promotions
