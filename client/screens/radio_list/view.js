var radio_promotion_index; // added by ** Lakshan **
var promotions = new Array(); //Promotion Text Array added by ** Lakshan **


var favIsInfobarHidden = true;

function radioListGetScreenHtml() {
    var a = "";
    a += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '" id="bodyBG">';
    a += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    a += '<div id="globalVolumeBar" class="globalVolumeBar"></div>';
    a += '<div id="messageBlock" class="messageBlock"></div>';
    a += '<div id="globalMute" class="globalMute"></div>';
    a += '<div class="header">';
    a += '<div class="headerLeft"></div><div class="headerRight"></div>';
    a += '<div id="globalLogo" class="globalLogo" style=""></div>';
    a += '<div id="homeweather" class="homeweather"></div>';
    a += '<div id="globalClock" class="globalClock"></div>';
    a += "</div>";
    a += '<div id="globalClipScreen" class="globalClipScreen"><div id="chName" class="chName"></div>';
    a += '<img id="logo" class="RadioCliplogo" />';
    a += "</div>";
    a += menuGetMenuListHtml();
    a += '<div id="radioListSubMenuListContainer" class="radioListSubMenuListContainer"></div>';
    a += '<div id="radioListChannelListHighlight" class="radioListChannelListHighlight globalTVListHighlight"></div>';
    a += '<div id="radioListChannelListContainer" class="radioListChannelListContainer"></div>';
    a += '<div id="radioListChannelListTotal" class="radioListChannelListTotal"></div>';
    a += '<div id="favInfobarContainer" class="favInfobarContainer"><div id="favContentName" class="favContentName"></div></div>';
    a += '<div id="fsvInfobarContainer" class="fsvInfobarContainer"></div>';
    a += '<div id="fsvContentName" class="fsvContentName"></div>';
    a += '<div id="cfsvProgramListContainer" class="cfsvProgramListContainer"></div>';
    a += "</div>";
    a += '<div id="ticker_tape_radio" class="ticker_tape_radio"><div id="promotion_id">Promotions</div><p id="radio_promotion_text"></p></div>';
    a += '<div class="footer">';
    a += '<div id="footerContainer" class="footerContainer">' + showrChannelFooter() + "</div>";
    a += "</div>";
    return a
}

function showrChannelFooter() {
    var b = top.globalGetLabel("RADIO_LIST_FAV") + top.globalGetLabel("RADIO_LIST_BACK") + top.globalGetLabel("RC_MENU");
    return b
}

function radioListChannelListHideHighlight() {
    document.getElementById("radioListChannelListHighlight").style.visibility = "hidden"
}

function radioListChannelListShowHighlight() {
    document.getElementById("radioListChannelListHighlight").style.visibility = "visible"
}

function radioListChannelListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.icon && item.icon != "") {
            html += '<div class="radioListChannelListItem">';
            html += '<img src="' + this.eval(item, "icon", "").replace(" ", "%20") + '" class="radioChannelIMG">';
            html += "</div>"
        } else {
            html += '<div class="radioListChannelListItem">' + this.eval(item, "name", "") + "</div>"
        }
    }
    return html
}

function binary(d) {
    var o = "";
    for (var i = 0; i < d.length; i = i + 2) {
        o += String.fromCharCode(eval("0x" + (d.substring(i, i + 2)).toString(16)))
    }
    return o
}

function radioListChannelListOnIndexChanged(x, l) {
    var F;
    var selector = document.getElementById("radioListChannelListHighlight");
    var selectorLeft = parseInt(window.getComputedStyle(selector, null).getPropertyValue("left"));
    var selectorTop = parseInt(window.getComputedStyle(selector, null).getPropertyValue("top"));

    var item = document.getElementsByClassName("radioListChannelListItem")[0];
    var itemMarginTop = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-top"));

    var itemMarginBottom = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-bottom"));
    var itemMarginRight = parseInt(window.getComputedStyle(item, null).getPropertyValue("margin-right"));
    var itemWidth = parseInt(window.getComputedStyle(item, null).getPropertyValue("width"));
    var itemHeight = parseInt(window.getComputedStyle(item, null).getPropertyValue("height"));

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


function radioListChannelListDisplay() {
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

function radioListChannelListDisplayTotal() {
    var a = "";
    if (this.getLength() > 0) {
        a += (this.getIndex() + 1) + "/" + this.getLength()
    }
    document.getElementById("radioListChannelListTotal").innerHTML = a
}

function radioListSubMenuListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    var html = '<div class="chSubMenuListItem ' + this.eval(item, "class", "") + (selected && top.State.getState() == top.State.RADIO_SUBMENU ? "Selected" : "") + '">' + item.txtLabel + '</div>';
    return html
}

function rfavShowInfobar(a) {
    document.getElementById("favContentName").innerHTML = a;
    document.getElementById("favInfobarContainer").style.visibility = "visible";
    favIsInfobarHidden = false
}

function rfavStartHidingInfobar() {
    top.kwTimer.cancelTimer("HIDE_FAVBAR");
    top.kwTimer.setTimer("HIDE_FAVBAR", {
        scope: this,
        callback: rfavHideInfobar
    }, top.FAV_INFOBAR_TIMEOUT)
}

function rfavHideInfobar() {
    document.getElementById("favInfobarContainer").style.visibility = "hidden";
    favUnloadContent();
    favIsInfobarHidden = true
}

function favUnloadContent() {
    document.getElementById("favContentName").innerHTML = ""
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

//Radio Promotions
function radioPromDisplayItem(prom_data){

    radio_promotion_index = 0;
    promotions = prom_data.split("|");
    top.GLOBAL_PROMOTION_INTERVAL = setInterval(function(){ radioPromotionDataDisplayFunction() }, 4000); //laksan
}

function radioPromotionDataDisplayFunction(){
    var count = promotions.length;
    if (radio_promotion_index < count) {
        var elx = document.getElementById("radio_promotion_text");
        elx.innerHTML = promotions[radio_promotion_index];
        radio_promotion_index ++;
    }else{
        radio_promotion_index = 0;
    }
};

//End of Radio Promotions