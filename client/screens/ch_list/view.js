var tv_promotion_index; // added by ** Lakshan **
var promotions = new Array(); //Promotion Text Array added by ** Lakshan **



var favIsInfobarHidden = true;
function chListGetScreenHtml() {
  
    var promotionText = "Promotions";
    if (top.DEFAULT_LANGUAGE == "ar") {
        promotionText = " إعلانات وعروض خاصة ";
    }


    var a = "";
    //a += '<div class="bodyBG" id="bodyBG" style="background-image:' +  top.BG_IMG + '">';
    a += '<div class="bodyBG" id="bodyBG">';
    a += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    a += '<div id="globalVolumeBar" class="globalVolumeBar"></div>';
    a += '<div id="globalMute" class="globalMute"></div>';
    a += '<div id="messageBlock" class="messageBlock"></div>';
    a += '<div class="header" id="header">';
    a += '<div class="headerLeft"></div><div class="headerRight"></div>';
    a += '<div id="globalLogo" class="globalLogo" style=""></div>';
    a += '<div id="homeweather" class="homeweather"></div>';
    a += '<div id="globalClock" class="globalClock"></div>';
    a += "</div>";
    a += '<div id="globalClipScreen" class="globalClipScreen"><div id="chName" class="chName"></div>';
    a += "</div>";
    a += menuGetMenuListHtml();
    a += '<div id="chListSubMenuListContainer" class="chListSubMenuListContainer"></div>';
    a += '<div id="chListChannelListHighlight" class="chListChannelListHighlight globalTVListHighlight"></div>';
    a += '<div id="chListChannelListContainer" class="chListChannelListContainer"></div>';
    a += '<div id="chListChannelListTotal" class="chListChannelListTotal"></div>';
    a += '<div id="favInfobarContainer" class="favInfobarContainer"><div id="favContentName" class="favContentName"></div></div>';
    a += '<div id="fsvInfobarContainer" class="fsvInfobarContainer"></div>';
    a += '<div id="fsvContentName" class="fsvContentName"></div>';
    a += '<div id="cfsvProgramListContainer" class="cfsvProgramListContainer"></div>';
    a += "</div>";
    a += '<div class="footer" id="footer">';
    a += '<div id="ticker_tape_tv" class="ticker_tape_tv"><div id="promotion_id">'+promotionText+'</div><p id="tv_promotion_text"></p></div>';
    a += '<div id="footerContainer" class="footerContainer">' + showChannelFooter() + "</div>";
    a += "</div>";
    if (top.DEVICE_TYPE == "exterity") {
        a += '<img id="player" src="tv:" class="videoClip" />';
    }
    return a;
}


function showChannelFooter() {
    var yellow = top.globalGetLabel("CH_LIST_FAV");
    var red = top.globalGetLabel("CH_LIST_RMFAV") ;
    var blue = top.globalGetLabel("CH_LIST_BACK");
    var menu = top.globalGetLabel("RC_MENU");
    if (top.DEFAULT_LANGUAGE == 'ar') {
        yellow = "<div class=footerImage><img src=images/rc/yellow-bt.jpg  /></div><div class='footerText'>  أضف إلى المفضلة  </div>";
        red = "<div class=footerImage><img src=images/rc/orange-bt.jpg  /></div><div class=footerText>  إلغاء من المفضلة   </div>";
        blue = "<div class=footerImage><img src=images/rc/blue-bt.jpg  /></div><div class=footerText> القائمة الرئيسية   </div>";
        menu = "<div class=footerImage><img src=images/rc/menu-button.jpg  /></div><div class=footerText> القائمة الفرعية  </div>";
    }
    var b = "";
    if (top.State.getState() == top.State.CH_FAVLIST_MAIN) {
        b = yellow + red + blue + menu;
    } else {
        b = yellow + blue + menu;
    }
    return b;
}
function chListChannelListHideHighlight() {
    document.getElementById("chListChannelListHighlight").style.visibility = "hidden";
}
function chListChannelListShowHighlight() {
    document.getElementById("chListChannelListHighlight").style.visibility = "visible";
}
function chListChannelListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.icon && item.icon != "") {
            html += '<div class="chListChannelListItem">';
            html += '<img src="' + this.eval(item, "icon", "").replace(" ", "%20") + '" class="chListChannelIMG">';
            html += "</div>"
        } else {
            html += '<div class="chListChannelListItem">' + this.eval(item, "name", "") + "</div>"
        }
    }
    return html;
}
function binary(d) {
    var o = "";
    for (var i = 0; i < d.length; i = i + 2) {
        o += String.fromCharCode(eval("0x" + (d.substring(i, i + 2)).toString(16)));
    }
    return o;
}

//function chListChannelListOnIndexChanged(x, l) {
//    var F;
//    var selector = document.getElementById("chListChannelListHighlight");
//    var selectorLeft = parseInt(window.getComputedStyle(selector, null).getPropertyValue("left"));
//    var selectorTop = parseInt(window.getComputedStyle(selector, null).getPropertyValue("top"));
//
//    var item = document.getElementsByClassName("chListChannelListItem")[0];
//    var itemMarginTop = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-top"));
//
//    var itemMarginBottom = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-bottom"));
//    var itemMarginRight = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-right"));
//    var itemWidth = parseInt(window.getComputedStyle(item, null).getPropertyValue("width"));
//    var itemHeight = parseInt(window.getComputedStyle(item, null).getPropertyValue("height"));
//
//    this.display();
//    var C = parseInt(top.HighLight_W);
//    var f = parseInt(top.HighLight_H);
//    var A = parseInt(itemWidth + itemMarginRight);
//    var B = parseInt(itemHeight + itemMarginRight);
//    var t = this.getSelected();
//
//    if ((x == 1 || x == -1) && l == 1) {
//        F = f + Math.floor((t % top.CHANNEL_COLUMNS)) * A;
//        top.TransitionManager.runX2(F, x, selector);
//        F = C + Math.floor((t / top.CHANNEL_COLUMNS)) * B;
//        top.TransitionManager.run(F, x, selector);
//
//    } else {
//        if ((x == 1 || x == -1) && l == top.CHANNEL_COLUMNS) {
//            F = f + Math.floor((t % top.CHANNEL_COLUMNS)) * A;
//            top.TransitionManager.runX2(F, x, selector);
//            F = C + Math.floor((t / top.CHANNEL_COLUMNS)) * B;
//            top.TransitionManager.run(F, x, selector);
//        }
//    }
//}


function chListChannelListOnIndexChanged(x, l) {
    var F;
    var selector = document.getElementById("chListChannelListHighlight");
    var selectorLeft = parseInt(window.getComputedStyle(selector, null).getPropertyValue("left"));
    var selectorTop = parseInt(window.getComputedStyle(selector, null).getPropertyValue("top"));

    var item = document.getElementsByClassName("chListChannelListItem")[0];
    var itemMarginTop = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-top"));

    var itemMarginBottom = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-bottom"));
    var itemMarginRight = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-right"));
    var itemMarginLeft = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-left"));
    var itemWidth = parseInt(window.getComputedStyle(item, null).getPropertyValue("width"));
    var itemHeight = parseInt(window.getComputedStyle(item, null).getPropertyValue("height"));

    this.display();

    var border_width = top.BORDER_WIDTH*2;
    var border_height = top.BORDER_HEIGHT*2;

    var C = parseInt(top.HighLight_W);
    var f = parseInt(top.HighLight_H);

    var A = parseInt(itemWidth+ border_width + itemMarginRight);
    var B = parseInt(itemHeight + border_height + itemMarginRight);

    //Change values according to layout
    //Added By Lakshan
    var layout = top.DEFAULT_LANGUAGE;
    if (layout == 'ar') {
        A = parseInt(itemWidth + itemMarginLeft);
        B = parseInt(itemHeight + itemMarginLeft);
    }
    //End
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

function chListChannelListOnIndexChangedEn(c, a) {
    this.display();
    var f = document.getElementById("chListChannelListHighlight");
    var e, d;
    var g = this.getPrevSelected();
    var b = this.getSelected();
    if (a == 6) {
        e = 210 + Math.floor((b / 6)) * 89;
        top.TransitionManager.run(e, c, f);
    } else {
        if (((g == 5 || g == 11 || g == 17 || g == 23) && c == 1)) {
            document.getElementById("chListChannelListHighlight").style.left = 104 + "px";
            e = 210 + Math.floor((b / 6)) * 89;
            top.TransitionManager.run(e, c, f);
        } else {
            if ((g == 0 || g == 6 || g == 12 || g == 18) && c == -1) {
                document.getElementById("chListChannelListHighlight").style.left = (104 + 89 * 5) + "px";
                e = 210 + Math.floor((b / 6)) * 89;
                top.TransitionManager.run(e, c, f);
            } else {
                if (((g == 1 || g == 2 || g == 3 || g == 4 || g == 5 || g == 7 || g == 8 || g == 9 || g == 10 || g == 11 || g == 13 || g == 14 || g == 15 || g == 16 || g == 17 || g == 19 || g == 20 || g == 21 || g == 22 || g == 23) && c == -1) || ((g == 0 || g == 1 || g == 2 || g == 3 || g == 4 || g == 6 || g == 7 || g == 8 || g == 9 || g == 10 || g == 12 || g == 13 || g == 14 || g == 15 || g == 16 || g == 18 || g == 19 || g == 20 || g == 21 || g == 22) && c == 1)) {
                    d = 104 + (b % 6) * 89;
                    top.TransitionManager.runX(d, c, f);
                }
            }
        }
    }
}
function chListChannelListDisplay() {
    this.onBeforeDisplay();
    if (this.getLength() === 0) {
        return this.displayEmptyList()
    }
    var c = new top.Iterator(0, this.getIndex() - this.getSelected(), this.getLength(), this.isCyclic());
    var a = 0;
    var b = "";
    while (a < this.getDisplayCount()) {
        if (c.isChanged() && a < this.getLength()) {
            b += this.displayItem(c.getIndex(), a, a == this.getSelected());
            c.increaseIndex()
        } else {
            b += this.displayItem(-1, a, false)
        }
        a++
    }
    this._container.innerHTML = b;
    this.onAfterDisplay()
}
function chListChannelListDisplayTotal() {
    var a = "";
    if (this.getLength() > 0) {
        a += (this.getIndex() + 1) + "/" + this.getLength()
    }
    document.getElementById("chListChannelListTotal").innerHTML = a
}
function chListSubMenuListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    //console.log(item.txtLabel);
    //get_arabic_label(item.txtLabel);
    var html = '<div class="chSubMenuListItem ' + this.eval(item, "class", "") + (selected && top.State.getState() == top.State.CH_SUBMENU ? "Selected" : "") + '">' + item.txtLabel + '</div>';
    return html;
}
function favShowInfobar(a) {
    document.getElementById("favContentName").innerHTML = a;
    document.getElementById("favInfobarContainer").style.visibility = "visible";
    favIsInfobarHidden = false
}
function favStartHidingInfobar() {
    top.kwTimer.cancelTimer("HIDE_FAVBAR");
    top.kwTimer.setTimer("HIDE_FAVBAR", {scope: this, callback: favHideInfobar}, top.FAV_INFOBAR_TIMEOUT)
}
function favHideInfobar() {
    document.getElementById("favInfobarContainer").style.visibility = "hidden";
    favUnloadContent();
    favIsInfobarHidden = true
}
function favUnloadContent() {
    document.getElementById("favContentName").innerHTML = "";
    top.kwTimer.cancelTimer("HIDE_FAVBAR")
}
function cfsvHideInfobar() {
    document.getElementById("fsvInfobarContainer").style.visibility = "hidden";
    if (fsvType == "LIVE") {
        cfsvUnloadProgramList()
    }
    top.StreamManager.showSubtitles();
    fsvIsInfobarHidden = true
}
function cfsvUnloadProgramList() {
    document.getElementById("cfsvProgramListContainer").innerHTML = ""
}


//TV Promotions
function tvPromDisplayItem(prom_data) {

    tv_promotion_index = 0;
    promotions = prom_data.split("|");
    top.GLOBAL_PROMOTION_INTERVAL = setInterval(function () {
        tvPromotionDataDisplayFunction()
    }, 4000); //laksan
}

function tvPromotionDataDisplayFunction() {
    var count = promotions.length;
    if (tv_promotion_index < count) {
        var elx = document.getElementById("tv_promotion_text");
        elx.innerHTML = promotions[tv_promotion_index];
        tv_promotion_index++;
    } else {
        tv_promotion_index = 0;
    }
}


//End of TV Promotions

