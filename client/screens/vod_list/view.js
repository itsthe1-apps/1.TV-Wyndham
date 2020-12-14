function vodListGetScreenHtml() {
    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    b += '<div class="header">';
    b += '<div class="headerLeft"></div><div class="headerRight"></div>';
    b += '<div id="globalLogo" class="globalLogo" style=""></div>';
    b += '<div id="globalLogoRight" class="globalLogoRight"></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += "</div>";
    b += '<div id="globalTitle" class="globalTitle">' + top.globalGetLabel("VOD_LIST_TITLE") + "</div>";
    b += '<div id="vodListMovieInfo" class="vodListMovieInfo">';
    b += "</div>";
    b += '<div id="vodPlayerContainer" class="vodPlayerContainer"></div>';
    b += '<div id="vodListSubMenuListContainer" class="vodListSubMenuListContainer"></div>';
    b += '<div id="vodListMovieListHighlight" class="vodListMovieListHighlight globalTVGListHighlight"></div>';
    b += '<div id="vodListMovieListContainer" class="vodListMovieListContainer"></div>';
    b += '<div id="vodListMovieListTotal" class="vodListMovieListTotal"></div>';
    b += "</div>";
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showVODListFooter2() + "</div>";
    b += "</div>";
    return b
}

function vodPlayerSubMenuListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    var html = '<div class="' + this.eval(item, "class", "") + (selected && top.State.getState() == top.State.VOD_PLAYMENU ? "Selected" : "") + '"></div>';
    return html
}

function showVODListFooter2() {
    var a = top.globalGetLabel("RC_MENU") + top.globalGetLabel("VOD_LIST_BACK");
    return a
}

function vodListSubMenuListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    var html = '<div class="vodSubMenuListItem ' + this.eval(item, "class", "") + (selected && top.State.getState() == top.State.VOD_SUBMENU ? "Selected" : "") + '"></div>';
    return html
}

function vodListMovieListHideHighlight() {
    document.getElementById("vodListMovieListHighlight").style.visibility = "hidden"
}

function vodListMovieListShowHighlight() {
    document.getElementById("vodListMovieListHighlight").style.visibility = "visible"
}

function vodListMovieListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.icon && item.icon != "") {
            html += '<div class="vodListMovieListItem">';
            html += '<img src="' + this.eval(item, "thumbnail", "").replace(" ", "%20") + '" class="vodMovieListItemIMG">';
            html += "</div>"
        } else {
            html += '<div class="vodListMovieListItem">' + this.eval(item, "name", "") + "</div>"
        }
    }
    return html
}

//function vodListMovieListOnIndexChanged(k, n) {
//    this.display();
//    vodListDisplayMovieInfo(this.getItem());
//    var s = document.getElementById("vodListMovieListHighlight");
//    var v;
//    var j = window.getComputedStyle(document.getElementsByClassName("vodListMovieListContainer")[0], null).getPropertyValue("top");
//    var x = window.getComputedStyle(document.getElementsByClassName("vodListMovieListContainer")[0], null).getPropertyValue("left");
//    var g = document.getElementById("vodListMovieListContainer");
//    var r = window.getComputedStyle(g.getElementsByClassName("vodListMovieListItem")[0], null).getPropertyValue("margin-top");
//    var y = parseInt(j, 10) + parseInt(r, 10) / 2;
//    var u = parseInt(x, 10) + parseInt(r, 10) / 2;
//    var q = window.getComputedStyle(document.getElementsByClassName("vodListMovieListItem")[0], null).getPropertyValue("width");
//    var w = window.getComputedStyle(document.getElementsByClassName("vodListMovieListItem")[0], null).getPropertyValue("margin-left");
//    var p = parseInt(u, 10);
//    var i = parseInt(u, 10);
//    var h = parseInt(q, 10) + parseInt(w, 10);
//    var o = this.getPrevSelected();
//    var m = this.getSelected();
//    if ((k == 1 || k == -1) && n == 1) {
//        v = p + Math.floor((m % top.MOV_CLMNS)) * h;
//        top.TransitionManager.runX2(v, k, s);
//        v = y + Math.floor((m / top.MOV_CLMNS)) * h;
//        top.TransitionManager.run(v, k, s)
//    } else {
//        if ((k == 1 || k == -1) && n == top.MOV_CLMNS) {
//            v = p + Math.floor((m % top.MOV_CLMNS)) * h;
//            top.TransitionManager.runX2(v, k, s);
//            v = y + Math.floor((m / top.MOV_CLMNS)) * h;
//            top.TransitionManager.run(v, k, s)
//        }
//    }
//}

function vodListMovieListOnIndexChanged(x, l) {
    var F;
    var selector = document.getElementById("vodListMovieListHighlight");
    var selectorLeft = parseInt(window.getComputedStyle(selector, null).getPropertyValue("left"));
    var selectorTop = parseInt(window.getComputedStyle(selector, null).getPropertyValue("top"));

    var item = document.getElementsByClassName("vodListMovieListItem")[0];
    var itemMarginTop = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-top"));

    var itemMarginBottom = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-bottom"));
    var itemMarginRight = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-right"));
    var itemWidth = parseInt(window.getComputedStyle(item, null).getPropertyValue("width"));
    var itemHeight = parseInt(window.getComputedStyle(item, null).getPropertyValue("height"));

    // this.display();
    // var C = parseInt(top.CH_SELECT_W);
    // var f = parseInt(top.CH_SELECT_H);
    // var A = parseInt(itemWidth + itemMarginRight);
    // var B = parseInt(itemHeight + itemMarginRight);
    // var t = this.getSelected();

    // if ((x == 1 || x == -1) && l == 1) {
    //     F = f + Math.floor((t % top.MOV_CLMNS)) * A;
    //     top.TransitionManager.runX2(F, x, selector);
    //     F = C + Math.floor((t / top.MOV_CLMNS)) * B;
    //     top.TransitionManager.run(F, x, selector);

    // } else {
    //     if ((x == 1 || x == -1) && l == top.MOV_CLMNS) {
    //         F = f + Math.floor((t % top.MOV_CLMNS)) * A;
    //         top.TransitionManager.runX2(F, x, selector);
    //         F = C + Math.floor((t / top.MOV_CLMNS)) * B;
    //         top.TransitionManager.run(F, x, selector);
    //     }
    // }

    this.display();
    var C = parseInt(top.HighLight_W);
    var f = parseInt(top.HighLight_H);
    var A = parseInt(itemWidth + itemMarginRight);
    var B = parseInt(itemHeight + itemMarginRight);
    var t = this.getSelected();

    if ((x == 1 || x == -1) && l == 1) {
        F = f + Math.floor((t % top.CHANNEL_COLUMNS)) * A;
        top.TransitionManager.runX2(F, x, selector);
        F = C + Math.floor((t / top.CHANNEL_COLUMNS)) * B;
        top.TransitionManager.run(F, x, selector);

    } else {
        if ((x == 1 || x == -1) && l == top.CHANNEL_COLUMNS) {
            F = f + Math.floor((t % top.CHANNEL_COLUMNS)) * A;
            top.TransitionManager.runX2(F, x, selector);
            F = C + Math.floor((t / top.CHANNEL_COLUMNS)) * B;
            top.TransitionManager.run(F, x, selector);
        }
    }
}

function vodListMovieListDisplay() {
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

function vodListMovieListDisplayEmptyList() {
    vodListMovieListHideHighlight();
    this._container.innerHTML = '<div class="vodListEmptyMovieList">' + top.globalGetLabel("VOD_LIST_EMPTY") + "</div>"
}

function vodListDisplayMovieInfo(c) {
    var d = "";
    if (c) {
        d += '<img src="' + c.icon.replace(" ", "%20") + '" class="vodListMovieInfoPicture">';
        d += '<div class="vodListMovieInfoMetadataContainer">';
        d += '<div class="vodListMovieInfoName">' + c.name + " [" + c.duration + " m]</div>";
        d += '<div class="vodListMovieInfoTitle"></div>';
        d += '<div class="vodListMovieInfoDescription">' + c.description + "</div>";
        d += "</div>"
    }
    document.getElementById("vodListMovieInfo").innerHTML = d
}

function vodListMovieListOnAfterDisplay() {
    vodListDisplayMovieInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
    document.getElementById("vodListMovieListTotal").innerHTML = b
};