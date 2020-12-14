function vodChooserGetScreenHtml() {
    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    b += '<div class="header">';
    b += '<div class="headerLeft"></div><div class="headerRight"></div>';
    b += '<div id="globalLogo" class="globalLogo" style=""></div>';
    b += '<div id="globalLogoRight" class="globalLogoRight"></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += "</div>";
    b += '<div id="globalTitle" class="globalTitle">' + top.globalGetLabel("VOD_CHOOSER_TITLE") + "</div>";
    b += '<div id="vodChooserSubMenuListContainer" class="vodListSubMenuListContainer"></div>';
    b += '<div id="vodChooserGenreListHighlight" class="vodListMovieListHighlight globalTVGListHighlight hidden"></div>';
    b += '<div id="vodChooserListContainer" class="vodListGenreListContainer"></div>';
    b += '<div id="vodChooserGenreListTotal" class="vodChooserGenreListTotal"></div>';
    b += "</div>";
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showVODChooserFooter() + "</div>";
    b += "</div>";
    return b
}

function showVODChooserFooter() {
    var a = top.globalGetLabel("RC_MENU") + top.globalGetLabel("CH_LIST_BACK");
    return a
}

function vodChooserSubMenuListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    var html = '<div class="vodSubMenuListItem ' + this.eval(item, "class", "") + (selected && top.State.getState() == top.State.VOD_SUBMENU ? "Selected" : "") + '"></div>';
    return html
}

function vodChooserAlphaListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    if (top.DEFAULT_DIRECTION == "rtl") {
        var html = item ? '<div class="alpha_order_right" style="background-image:url(images/' + top.globalGetScreenHeightByResolution() + "/" + top.THEME + "_" + top.DEFAULT_LANGUAGE + "/alpha/" + this.eval(item, "letter", "") + (selected && top.State.getState() == top.State.VOD_CHOOSER_ALPHA ? "1" : "") + '.png);"></div>' : ""
    } else {
        var html = item ? '<div class="alpha_order_left" style="background-image:url(images/' + top.globalGetScreenHeightByResolution() + "/" + top.THEME + "_" + top.DEFAULT_LANGUAGE + "/alpha/" + this.eval(item, "letter", "") + (selected && top.State.getState() == top.State.VOD_CHOOSER_ALPHA ? "1" : "") + '.png);"></div>' : ""
    }
    return html
}

function vodChooserGenreListHideHighlight() {
    document.getElementById("vodChooserGenreListHighlight").style.visibility = "hidden"
}

function vodChooserGenreListShowHighlight() {
    document.getElementById("vodChooserGenreListHighlight").style.visibility = "visible"
}

function vodChooserGenreListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        html += '<div class="vodListMovieListItem">' + this.eval(item, "name", "") + "</div>"
    }
    return html
}

//function vodChooserGenreListOnIndexChanged(i, k) {
//    this.display();
//    var p = document.getElementById("vodChooserGenreListHighlight");
//    var r;
//    var h = window.getComputedStyle(document.getElementsByClassName("vodListGenreListContainer")[0], null).getPropertyValue("top");
//    var u = window.getComputedStyle(document.getElementsByClassName("vodListGenreListContainer")[0], null).getPropertyValue("left");
//    var c = document.getElementById("vodChooserListContainer");
//    var o = window.getComputedStyle(c.getElementsByClassName("vodListMovieListItem")[0], null).getPropertyValue("margin-top");
//    var v = parseInt(h, 10) + parseInt(o, 10) / 2;
//    var q = parseInt(u, 10) + parseInt(o, 10) / 2;
//    var n = window.getComputedStyle(document.getElementsByClassName("vodListMovieListItem")[0], null).getPropertyValue("width");
//    var s = window.getComputedStyle(document.getElementsByClassName("vodListMovieListItem")[0], null).getPropertyValue("margin-left");
//    var m = parseInt(q, 10);
//    var g = parseInt(n, 10) + parseInt(s, 10);
//    var j = this.getSelected();
//    if ((i == 1 || i == -1) && k == 1) {
//        r = m + Math.floor((j % top.MOV_CAT_CLMNS)) * g;
//        top.TransitionManager.runX2(r, i, p);
//        r = v + Math.floor((j / top.MOV_CAT_CLMNS)) * g;
//        top.TransitionManager.run(r, i, p)
//    } else {
//        if ((i == 1 || i == -1) && k == top.MOV_CAT_CLMNS) {
//            r = m + Math.floor((j % top.MOV_CAT_CLMNS)) * g;
//            top.TransitionManager.runX2(r, i, p);
//            r = v + Math.floor((j / top.MOV_CAT_CLMNS)) * g;
//            top.TransitionManager.run(r, i, p)
//        }
//    }
//}

function vodChooserGenreListOnIndexChanged(x, l) {
    var F;
    var selector = document.getElementById("vodChooserGenreListHighlight");
    var selectorLeft = parseInt(window.getComputedStyle(selector, null).getPropertyValue("left"));
    var selectorTop = parseInt(window.getComputedStyle(selector, null).getPropertyValue("top"));

    var item = document.getElementsByClassName("vodChooserListItem")[0];
    var itemMarginTop = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-top"));
    var itemMarginBottom = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-bottom"));
    var itemMarginRight = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-right"));
    var itemWidth = parseInt(window.getComputedStyle(item, null).getPropertyValue("width"));
    var itemHeight = parseInt(window.getComputedStyle(item, null).getPropertyValue("height"));

    // this.display();
    // var C = parseInt(top.CH_GENRE_W);
    // var f = parseInt(top.CH_GENRE_H);
    // var A = parseInt(itemWidth + itemMarginRight);
    // var B = parseInt(itemHeight + itemMarginRight);
    // var t = this.getSelected();

    // if ((x == 1 || x == -1) && l == 1) {
    //     F = f + Math.floor((t % top.MOV_CAT_CLMNS)) * A;
    //     top.TransitionManager.runX2(F, x, selector);
    //     F = C + Math.floor((t / top.MOV_CAT_CLMNS)) * B;
    //     top.TransitionManager.run(F, x, selector);
    // } else {
    //     if ((x == 1 || x == -1) && l == top.MOV_CAT_CLMNS) {
    //         F = f + Math.floor((t % top.MOV_CAT_CLMNS)) * A;
    //         top.TransitionManager.runX2(F, x, selector);
    //         F = C + Math.floor((t / top.MOV_CAT_CLMNS)) * B;
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

function vodChooserGenreListDisplay() {
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

function vodChooserGenreListDisplayTotal() {
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
    document.getElementById("vodChooserGenreListTotal").innerHTML = b
};