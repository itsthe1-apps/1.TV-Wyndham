function internetChooserGetScreenHtml() {
    var b = "";
    b += '<div id="messageBlock" class="messageBlock"></div>';
    b += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    b += '<div class="header">';
    b += '<div class="headerLeft"></div><div class="headerRight"></div>';
    b += '<div id="globalLogo" class="globalLogo" style=""></div>';
    b += '<div id="globalLogoRight" class="globalLogoRight"></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += "</div>";
    b += '<div class="bodyBG" id="bodyBG">';
    b += '<div id="globalTitle" class="globalTitle">' + top.globalGetLabel("INTERNET_CHOOSER_TITLE") + "</div>";
    b += '<div id="internetChooserGenreListHighlight" class="internetChooserChannelListHighlight globalInternetGListHighlight hidden"></div>';
    b += '<div id="internetChooserListContainer" class="internetChooserChannelListContainer"></div>';
    b += '<div id="internetChooserGenreListTotal" class="internetChooserGenreListTotal"></div>';
    b += "</div>";
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showInternetChooserFooter() + "</div>";
    b += "</div>";
    return b
}

function showInternetChooserFooter() {
    var a = top.globalGetLabel("INTERNET_LIST_BACK") + top.globalGetLabel("RC_MENU");
    return a
}

function internetChooserGenreListHideHighlight() {
    document.getElementById("internetChooserGenreListHighlight").style.visibility = "hidden"
}

function internetChooserGenreListShowHighlight() {
    document.getElementById("internetChooserGenreListHighlight").style.visibility = "visible"
}

function internetChooserGenreListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        html += '<div class="internetChooserChannelListItem">';
        html += '<img src="' + this.eval(item, "logo", "").replace(" ", "%20") + '">';
        html += "</div>"
    }
    return html
}

function internetChooserGenreListOnIndexChanged(s, j) {
    this.display();
    var q = document.getElementById("internetChooserGenreListHighlight");
    var v;
    var p = window.getComputedStyle(document.getElementsByClassName("internetChooserChannelListContainer")[0], null).getPropertyValue("top");
    var c = window.getComputedStyle(document.getElementsByClassName("internetChooserChannelListContainer")[0], null).getPropertyValue("left");
    var h = document.getElementById("internetChooserListContainer");
    var n = window.getComputedStyle(h.getElementsByClassName("internetChooserChannelListItem")[0], null).getPropertyValue("margin-top");
    var g = parseInt(p, 10) + parseInt(n, 10) / 2;
    var r = parseInt(c, 10) + parseInt(n, 10) / 2;
    var m = window.getComputedStyle(document.getElementsByClassName("internetChooserChannelListItem")[0], null).getPropertyValue("width");
    var w = window.getComputedStyle(document.getElementsByClassName("internetChooserChannelListItem")[0], null).getPropertyValue("margin-left");
    var k = parseInt(r, 10);
    var o = parseInt(r, 10);
    var i = parseInt(m, 10) + parseInt(w, 10);
    var u = this.getSelected();
    if ((s == 1 || s == -1) && j == 1) {
        v = k + Math.floor((u % top.INTERNET_CAT_CLMNS)) * i;
        top.TransitionManager.runX2(v, s, q);
        v = g + Math.floor((u / top.INTERNET_CAT_CLMNS)) * i;
        top.TransitionManager.run(v, s, q)
    } else {
        if ((s == 1 || s == -1) && j == top.INTERNET_CAT_CLMNS) {
            v = k + Math.floor((u % top.INTERNET_CAT_CLMNS)) * i;
            top.TransitionManager.runX2(v, s, q);
            v = g + Math.floor((u / top.INTERNET_CAT_CLMNS)) * i;
            top.TransitionManager.run(v, s, q)
        }
    }
}

function internetChooserGenreListDisplay() {
    this.onBeforeDisplay();
    if (this.getLength() === 0) {
        return this.displayEmptyList()
    }
    var f = new top.Iterator(0, this.getIndex() - this.getSelected(), this.getLength(), this.isCyclic());
    var e = 0;
    var d = "";
    while (e < this.getDisplayCount()) {
        if (f.isChanged() && e < this.getLength()) {
            d += this.displayItem(f.getIndex(), e, e == this.getSelected());
            f.increaseIndex()
        } else {
            d += this.displayItem(-1, e, false)
        }
        e++
    }
    this._container.innerHTML = d;
    this.onAfterDisplay()
}

function internetChooserGenreListDisplayTotal() {
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
    document.getElementById("internetChooserGenreListTotal").innerHTML = b
}
;