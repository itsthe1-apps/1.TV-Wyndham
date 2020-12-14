function messageListGetScreenHtml() {
    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    b += '<div class="header">';
    b += '<div id="globalLogo" class="globalLogo" style=""></div>';
    //b += '<div id="globalLogoRight" class="globalLogoRight"></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += menuGetMenuListHtml();
    b += "</div>";
    b += '<div id="globalTitle" class="globalTitle messageListTitle">' + top.globalGetLabel("MSG_LIST_TITLE") + "</div>";
    b += '<div id="messageListRestInfo" class="messageListRestInfo"></div>';
    b += '<div id="messageListRestListHighlight" class="messageListRestListHighlight globalMsgListHighlight"></div>';
    b += '<div id="messageListRestListContainer" class="messageListRestListContainer"></div>';
    b += '<div id="messageDetailContainer" class="messageDetailContainer"></div>';
    b += "</div>";
    b += '<div class="footer">';
    b += '<div class="newsFooter" id="newsFooter"><div class="newsFooterTitle" id="promotion_id">Promotions</div><div class="newsFooterText" id="newsFooterText"><div class="scrollInput" id="messages_promotion_text"></div></div></div>';
    //b += '<div id="ticker_tape_messages" class="ticker_tape_messages"><div id="promotion_id" class="newsFooterTitle">Promotions</div><p class="scrollInput" id="messages_promotion_text"></p></div>';
    b += '<div id="footerContainer" class="footerContainer">' + showMessageFooter() + "</div>";
    b += "</div>";
    return b
}

function showMessageFooter() {
    var a = top.globalGetLabel("RC_MENU") + top.globalGetLabel("MSG_OK");
    return a
}

function messageListSubMenuListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    var html = '<div class="messageSubMenuListItem ' + this.eval(item, "class", "") + (selected && top.State.getState() == top.State.RESTRNT_SUBMENU ? "Selected" : "") + '"></div>';
    return html
}

function messageListRestListHideHighlight() {
    document.getElementById("messageListRestListHighlight").style.visibility = "hidden"
}

function messageListRestListShowHighlight() {
    document.getElementById("messageListRestListHighlight").style.visibility = "visible"
}

function messageListRestListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.image && item.image != "") {
            html += '<div class="messageListRestListItem">' + this.eval(item, "date", "") + " : " + this.eval(item, "message", "") + "</div>"
        } else {
            m = (item.message.length > 70) ? item.message.substr(0, 70) + "....." : item.message;
            if (item.status == 0) {
                if (top.DEFAULT_DIRECTION == "rtl") {
                    html += '<div class="messageListRestListItem"><b>' + m + " : " + this.eval(item, "date", "") + "</b></div>"
                } else {
                    html += '<div class="messageListRestListItem"><b>' + this.eval(item, "date", "") + " : " + m + "</b></div>"
                }
            } else {
                if (top.DEFAULT_DIRECTION == "rtl") {
                    html += '<div class="messageListRestListItem">' + m + " : " + this.eval(item, "date", "") + "</div>"
                } else {
                    html += '<div class="messageListRestListItem">' + this.eval(item, "date", "") + " : " + m + "</div>"
                }
            }
        }
    }
    return html
}

function messageListRestListOnIndexChanged(c, i) {
    this.display();
    messageListDisplayRestInfo(this.getItem());
    var k = document.getElementById("messageListRestListHighlight");
    var j = window.getComputedStyle(document.getElementsByClassName("messageListRestListItem")[0], null).getPropertyValue("margin-bottom");
    var n = window.getComputedStyle(document.getElementsByClassName("messageListRestListItem")[0], null).getPropertyValue("height");
    var h = window.getComputedStyle(document.getElementsByClassName("messageListRestListContainer")[0], null).getPropertyValue("top");
    var o = parseInt(h, 10);
    var l;
    var g = this.getSelected();
    l = o + Math.floor(g % top.MSGS_ROWS) * (parseInt(n, 10) + parseInt(j, 10)*3);
    top.TransitionManager.run(l, c, k)
}

function messageListRestListDisplay() {
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

function messageListRestListDisplayEmptyList() {
    messageListRestListHideHighlight();
    this._container.innerHTML = '<div class="messageListEmptyRestList">' + top.globalGetLabel("REST_LIST_EMPTY") + "</div>"
}

function messageListDisplayRestInfo(c) {
    var d = "";
    if (c) {
        d += '<div class="messageListRestInfoPicture" style="background-image:url(' + c.image + ');"></div>'
    }
    document.getElementById("messageListRestInfo").innerHTML = d
}

function messageListRestListOnAfterDisplay() {
    messageListDisplayRestInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
}

function messagesPromDisplayItem(prom_data) {

    promotion_index = 0;
    var promotions = prom_data.split("|");
    interval_id = setInterval(function () {
        messagesPromotionDataDisplayFunction(promotions)
    }, 3000); //laksan
}

function messagesPromotionDataDisplayFunction(prom_data) {


    var count = prom_data.length;
    if (promotion_index < count) {
        var elx = document.getElementById("messages_promotion_text");
        elx.innerHTML = prom_data[promotion_index];
        promotion_index++;
    } else {
        promotion_index = 0;
    }
}

function clearIntervalTimer() {
    clearInterval(interval_id);
};