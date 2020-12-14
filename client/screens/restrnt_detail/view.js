function restrntDetailGetScreenHtml() {
    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="messageBlock" class="messageBlock"></div>';
    b += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    b += '<div class="header">';
    b += '<div class="headerLeft"></div><div class="headerRight"></div>';
    b += '<div id="globalLogo" class="globalLogo" style=""></div>';
    b += '<div id="globalLogoRight" class="globalLogoRight"></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += "</div>";
    b += '<div id="globalTitle" class="globalTitle restrntDetailTitle">' + top.globalGetLabel("REST_LIST_TITLE") + "</div>";
    b += '<div id="restrntMenuListHighlight" class="restrntMenuListHighlight globalRestMenuHighlight"></div>';
    b += '<div id="restrntDetailRestInfo" class="restrntDetailRestInfo"></div>';
    b += '<div id="restrntDetailListHighlight" class="restrntDetailListHighlight globalRestListHighlight"></div>';
    b += '<div id="restrntDetailListContainer" class="restrntDetailListContainer"></div>';
    b += '<div id="foodDetailContainer" class="foodDetailContainer">';
    if (top.DEFAULT_DIRECTION == "rtl") {
        b += '<div id="restDetailListRestInfo_desc" class="restDetailListRestInfo_desc"></div>';
        b += '<div id="restDetailRestInfoPicture" class="restDetailRestInfoPicture"><img id="restDetailIMG" class="restDetailIMG" /></div>'
    } else {
        b += '<div id="restDetailRestInfoPicture" class="restDetailRestInfoPicture"><img id="restDetailIMG" class="restDetailIMG"  /></div>';
        b += '<div id="restDetailListRestInfo_desc" class="restDetailListRestInfo_desc"></div>'
    }
    b += "</div>";
    b += "</div>";
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showRestDetailFooter() + "</div>";
    b += "</div>";
    return b
}

function showRestDetailFooter() {
    var a = top.globalGetLabel("RC_MENU") + top.globalGetLabel("RC_BACK");
    if (top.RestuarantsManager.getCurrentRestuarantMenu().is_service == 0) {
        a = a + top.globalGetLabel("REST_GREEN")
    }
    return a
}

function restrntDetailListHideHighlight() {
    document.getElementById("restrntDetailListHighlight").style.visibility = "hidden"
}

function restrntDetailListShowHighlight() {
    document.getElementById("restrntDetailListHighlight").style.visibility = "visible"
}

function restrntDetailListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.name && item.name != "") {
            html += '<div class="restrntDetailListItem">' + this.eval(item, "name", "") + "</div>"
        } else {
            html += '<div class="restrntDetailListItem">' + this.eval(item, "name", "") + "</div>"
        }
    }
    return html
}

function restrntDetailListOnIndexChanged(c, i) {
    this.display();
    restrntListDisplayRestInfo(this.getItem());
    var k = document.getElementById("restrntDetailListHighlight");
    var j = window.getComputedStyle(document.getElementsByClassName("restrntDetailListItem")[0], null).getPropertyValue("padding-bottom");
    var m = window.getComputedStyle(document.getElementsByClassName("restrntDetailListItem")[0], null).getPropertyValue("height");
    var h = window.getComputedStyle(document.getElementsByClassName("restrntDetailListContainer")[0], null).getPropertyValue("top");
    var n = parseInt(h, 10) - (parseInt(j, 10) / 2);
    var l;
    var g = this.getSelected();
    l = n + Math.floor(g % top.LOCALINFO_LEFT_NAV_ROWS) * (parseInt(m, 10) + parseInt(j, 10));
    top.TransitionManager.run(l, c, k)
}

function restrntDetailListDisplay() {
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

function restrntDetailListDisplayEmptyList() {
    restrntDetailListHideHighlight();
    this._container.innerHTML = '<div class="restrntDetailEmptyList">' + top.globalGetLabel("REST_LIST_EMPTY") + "</div>"
}

function restrntDetailDisplayRestInfo(c) {
    var d = "";
    if (c) {}
    document.getElementById("restrntDetailRestInfo").innerHTML = d
}

function restrntDetailListOnAfterDisplay() {
    restrntDetailDisplayRestInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
}

function restrntFoodListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        html += '<div class="restrntFoodListItem">';
        if (top.DEFAULT_DIRECTION == "rtl") {
            html += "<div class=price>" + this.eval(item, "price", "") + "</div>";
            html += "<div class=description>" + this.eval(item, "description", "") + "</div>";
            html += '<div class="title">' + this.eval(item, "name", "") + "</div>"
        } else {
            html += '<div class="title">' + this.eval(item, "name", "") + "</div>";
            html += "<div class=description>" + this.eval(item, "description", "") + "</div>";
            html += "<div class=price>" + this.eval(item, "price", "") + "</div>"
        }
        html += "</div>"
    }
    return html
}

function restrntFoodListDisplayEmptyList() {
    restrntDetailListHideHighlight();
    this._container.innerHTML = '<div class="restrntDetailEmptyList">' + top.globalGetLabel("REST_LIST_EMPTY") + "</div>"
}

function restrntFoodListDisplay() {
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

function restrntFoodListShowHighlight() {
    var c = window.getComputedStyle(document.getElementById("restrntDetailListContainer").getElementsByClassName("restrntDetailListItem")[0], null).getPropertyValue("padding-bottom");
    var a = window.getComputedStyle(document.getElementsByClassName("restrntDetailListContainer")[0], null).getPropertyValue("top");
    var b = parseInt(a, 10) - parseInt(c, 10) / 2;
    document.getElementById("restrntMenuListHighlight").style.top = b + "px";
    document.getElementById("restrntMenuListHighlight").style.visibility = "visible"
}

function restrntFoodListHideHighlight() {
    document.getElementById("restrntMenuListHighlight").style.visibility = "hidden"
}

function restrntFoodListContainerHideHighlight() {
    document.getElementById("restrntMenuListHighlight").style.visibility = "hidden";
    document.getElementById("restrntDetailRestInfo").style.visibility = "hidden"
}

function restrntFoodListContainerShowHighlight() {
    document.getElementById("restrntMenuListHighlight").style.visibility = "visible";
    document.getElementById("restrntDetailRestInfo").style.visibility = "visible"
}

function restrntFoodListOnIndexChanged(c, i) {
    this.display();
    var k = document.getElementById("restrntMenuListHighlight");
    var j = window.getComputedStyle(document.getElementsByClassName("restrntFoodListItem")[0], null).getPropertyValue("margin-bottom");
    var h = window.getComputedStyle(document.getElementsByClassName("restrntDetailRestInfo")[0], null).getPropertyValue("top");
    var n = parseInt(h, 10) - (parseInt(j, 10) / 2);
    var m = window.getComputedStyle(document.getElementsByClassName("restrntFoodListItem")[0], null).getPropertyValue("height");
    var l;
    var g = this.getSelected();
    l = n + Math.floor(g % top.REST_DETAIL_ROWS) * (parseInt(m, 10) + parseInt(j, 10));
    top.TransitionManager.run(l, c, k)
}

function restrntFoodListOnAfterDisplay() {};