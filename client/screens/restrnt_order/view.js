function restrntOrderGetScreenHtml() {
    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="messageBlock" class="messageBlock"></div>';
    b += '<div class="header"></div>';
    b += '<div id="globalLogo" class="globalLogo" style=""></div>';
    b += '<div id="globalLogoRight" class="globalLogoRight"></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += '<div id="globalTitle" class="globalTitle restrntListTitle">' + top.globalGetLabel("REST_ORDER_TITLE") + "</div>";
    b += '<div id="restrntOrdermsg" class="restrntOrdermsg"></div>';
    b += '<div id="restrntOrderRestInfo" class="restrntOrderRestInfo"></div>';
    b += '<div id="restrntOrderListContainer" class="restrntOrderRestListContainer"></div>';
    b += '<div id="restrntOrderInfoContainer" class="restrntOrderInfoContainer">' + showRestOrderInfo() + "</div>";
    b += '<div id="footerContainer" class="footerContainer">' + showRestOrderDetailFooter() + "</div>";
    b += "</div>";
    b += '<div class="footer"></div>';
    return b
}

function showRestOrderInfo() {
    var a = "";
    var b = top.RestuarantsManager.getCurrentRestuarantMenu();
    a += "<b>" + b.name + "</b><br>";
    if (b.description) {
        a += top.Encoder.htmlDecode(b.description) + "<br><br>"
    }
    if (b.daliy_time) {
        a += "<b>Daily Lunch</b>&nbsp;&nbsp;&nbsp;&nbsp;" + b.daliy_time + "<br>"
    }
    if (b.breakf_time) {
        a += "<b>Breakfast</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + b.breakf_time + "<br>"
    }
    if (b.lunch_time) {
        a += "<b>Lunch Time</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" + b.lunch_time + "<br>"
    }
    if (b.dinner_time) {
        a += "<b>Dinner Time</b>&nbsp;&nbsp;&nbsp;&nbsp;" + b.dinner_time + "<br>"
    }
    a += "<br>";
    if (b.dress) {
        a += "<b>Dress Code</b>&nbsp;&nbsp;&nbsp;&nbsp;" + b.dress + "<br>"
    }
    if (b.venue) {
        a += "<b>" + b.venue + "</b>"
    }
    return a
}

function showRestOrderDetailFooter() {
    var a = top.globalGetLabel("RC_MENU") + top.globalGetLabel("RC_BACK");
    return a
}

function restrntOrderListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.target == "time") {
            html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + selectedTime + "</div>"
        } else {
            if (item.target == "date") {
                html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + top.Clock.addDays(0, "dd - M - yyyy") + "</div>"
            } else {
                if (item.target == "guest") {
                    html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + 0 + "</div>"
                } else {
                    if (item.target == "submit") {
                        html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '"></div>'
                    }
                }
            }
        }
    }
    return html
}

function restrntOrderDisplayRestInfo(c) {
    var d = "";
    if (c) {
        d += '<div class="restrntOrderRestInfoPicture" style="background-image:url(' + c.image + ');"></div>'
    }
    document.getElementById("restrntOrderRestInfo").innerHTML = d
};