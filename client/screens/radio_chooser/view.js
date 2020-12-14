var radio_chooser_promotion_index; // added by ** Lakshan **
var promotions = new Array(); //Promotion Text Array added by ** Lakshan **


function radioChooserGetScreenHtml() {
    var a = "";
    a += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    a += '<div id="messageBlock" class="messageBlock"></div>';
    a += '<div id="globalMute" class="globalMute"></div>';
    a += '<div class="header">';
    a += '<div class="headerLeft"></div><div class="headerRight"></div>';
    a += '<div id="globalVolumeBar" class="globalVolumeBar"></div>';
    a += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    a += '<div id="globalLogo" class="globalLogo" style=""></div>';
    a += '<div id="homeweather" class="homeweather"></div>';
    a += '<div id="globalClock" class="globalClock"></div>';
    a += "</div>";
    a += menuGetMenuListHtml();
    a += '<div id="radioChooserSubMenuListContainer" class="chListSubMenuListContainer"></div>';
    a += '<div id="radioChooserGenreListHighlight" class="radioChooserChannelListHighlight globalTVGListHighlight hidden"></div>';
    a += '<div id="radioChooserListContainer" class="radioChooserChannelListContainer"></div>';
    a += '<div id="radioListChannelListTotal" class="radioListChannelListTotal"></div>';
    a += "</div>";
    a += '<div id="ticker_tape_radio_genre" class="ticker_tape_radio_genre"><div id="promotion_id">Promotions</div><p id="radio_genre_promotion_text"></p></div>';
    a += '<div class="footer">';
    a += '<div id="footerContainer" class="footerContainer">' + showChannelChooserFooter() + "</div>";
    a += "</div>";
    return a
}

function showChannelChooserFooter() {
    var b = top.globalGetLabel("RADIO_LIST_BACK") + top.globalGetLabel("RC_MENU");
    return b
}

function radioChooserSubMenuListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    var html = '<div class="chSubMenuListItem ' + this.eval(item, "class", "") + (selected && top.State.getState() == top.State.RADIO_SUBMENU ? "Selected" : "") + '">' + item.txtLabel + '</div>';
    return html
}

function radioChooserAlphaListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    var html = item ? '<div style="background-image:url(images/' + top.DEFAULT_LANGUAGE + "/720p/alpha/" + this.eval(item, "letter", "") + (selected && top.State.getState() == top.State.RADIO_CHOOSER_ALPHA ? "1" : "") + '.png);background-repeat:no-repeat;width:70px;height:70px;float:left;"></div>' : "";
    return html
}

function radioChooserGenreListHideHighlight() {
    document.getElementById("radioChooserGenreListHighlight").style.visibility = "hidden"
}

function radioChooserGenreListShowHighlight() {
    document.getElementById("radioChooserGenreListHighlight").style.visibility = "visible"
}

function radioChooserGenreListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        html += '<div class="radioChooserChannelListItem">' + this.eval(item, "name", "") + "</div>"
    }
    return html
}

function radioChooserGenreListOnIndexChanged(x, l) {
    var F;
    var selector = document.getElementById("radioChooserGenreListHighlight");
    var selectorLeft = parseInt(window.getComputedStyle(selector, null).getPropertyValue("left"));
    var selectorTop = parseInt(window.getComputedStyle(selector, null).getPropertyValue("top"));

    var item = document.getElementsByClassName("radioChooserChannelListItem")[0];
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



function radioChooserGenreListDisplay() {
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

function radioChooserGenreListDisplayTotal() {
    var a = "";
    if (this.getLength() > 0) {
        a += (this.getIndex() + 1) + "/" + this.getLength()
    }
    document.getElementById("radioListChannelListTotal").innerHTML = a
}

//Radio Chooser Promotions
function radioChooserPromDisplayItem(prom_data){

    radio_chooser_promotion_index = 0;
    promotions = prom_data.split("|");
    top.GLOBAL_PROMOTION_INTERVAL = setInterval(function(){ radio_chooserPromotionDataDisplayFunction() }, 4000); //laksan
}

function radio_chooserPromotionDataDisplayFunction(){
    var count = promotions.length;
    if (radio_chooser_promotion_index < count) {
        var elx = document.getElementById("radio_genre_promotion_text");
        elx.innerHTML = promotions[radio_chooser_promotion_index];
        radio_chooser_promotion_index ++;
    }else{
        radio_chooser_promotion_index = 0;
    }
}

//End of Radio Chooser Promotions;