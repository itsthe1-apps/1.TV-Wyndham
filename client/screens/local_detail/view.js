function localDetailGetScreenHtml() {
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
    b += '<div id="globalTitle" class="globalTitle localDetailTitle">' + top.globalGetLabel("LOCAL_DETAIL_TITLE") + "</div>";
    b += '<div id="localDetailRestInfo" class="localDetailRestInfo">';
    b += '<div id="localDetailRestInfoPicture" class="localDetailRestInfoPicture"><img id="infoDetailIMG" class="infoDetailIMG" /></div>';
    b += '<div id="localListRestInfo_desc" class="localListRestInfo_desc"></div>';
    b += "</div>";
    b += '<div id="localDetailListHighlight" class="localDetailListHighlight globalLocalListHighlight"></div>';
    b += '<div id="localDetailListContainer" class="localDetailListContainer"></div>';
    b += "</div>";
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showLocalDetailFooter() + "</div>";
    b += "</div>";
    return b
}

function showLocalDetailFooter() {
    var a = top.globalGetLabel("RC_MENU") + top.globalGetLabel("RC_BACK");
    return a
}

function localDetailListHideHighlight() {
    document.getElementById("localDetailListHighlight").style.visibility = "hidden"
}

function localDetailListShowHighlight() {
    document.getElementById("localDetailListHighlight").style.visibility = "visible"
}

function localDetailListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.name && item.name != "") {
            html += '<div class="localDetailListItem">' + this.eval(item, "name", "") + "</div>"
        } else {
            html += '<div class="localDetailListItem">' + this.eval(item, "name", "") + "</div>"
        }
    }
    return html
}

function localDetailListOnIndexChanged(c, i) {
    this.display();
    localDetailDisplayRestInfo(this.getItem());
    var k = document.getElementById("localDetailListHighlight");
    var j = window.getComputedStyle(document.getElementsByClassName("localDetailListItem")[0], null).getPropertyValue("padding-bottom");
    var m = window.getComputedStyle(document.getElementsByClassName("localDetailListItem")[0], null).getPropertyValue("height");
    var h = window.getComputedStyle(document.getElementsByClassName("localDetailListContainer")[0], null).getPropertyValue("top");
    var n = parseInt(h, 10) - (parseInt(j, 10) / 2);
    var l;
    var g = this.getSelected();
    l = n + Math.floor(g % top.LOCALINFO_LEFT_NAV_ROWS) * (parseInt(m, 10) + parseInt(j, 10));
    top.TransitionManager.run(l, c, k)
}

function localDetailListDisplay() {
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

function localDetailListDisplayEmptyList() {
    localDetailListHideHighlight();
    this._container.innerHTML = '<div class="localDetailEmptyList">' + top.globalGetLabel("REST_LIST_EMPTY") + "</div>"
}

function localDetailDisplayRestInfo(c) {
    var d = "";
    if (c) {
        img = document.getElementById("infoDetailIMG");
        img.src = c.image;
        des = document.getElementById("localListRestInfo_desc");
        des.innerHTML = top.Encoder.htmlDecode(c.description)
    }
}

function localDetailListOnAfterDisplay() {
    localDetailDisplayRestInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
};