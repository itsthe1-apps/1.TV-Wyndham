var tv_chooser_promotion_index; // added by ** Lakshan **
var promotions = new Array(); //Promotion Text Array added by ** Lakshan **


function chChooserGetScreenHtml() {
    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="messageBlock" class="messageBlock"></div>';
    b += '<div class="header">';
    b += '<div class="headerLeft"></div><div class="headerRight"></div>';
    b += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    b += '<div id="globalVolumeBar" class="globalVolumeBar"></div>';
    b += '<div id="globalLogo" class="globalLogo" style=""></div>';
    b += '<div id="homeweather" class="homeweather"></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += "</div>";
    b += menuGetMenuListHtml();
    b += '<div id="chChooserSubMenuListContainer" class="chListSubMenuListContainer"></div>';
    b += '<div id="chChooserGenreListHighlight" class="chChooserChannelListHighlight globalTVGListHighlight hidden"></div>';
    b += '<div id="chChooserListContainer" class="chChooserChannelListContainer"></div>';
    b += '<div id="chChooserGenreListTotal" class="chChooserGenreListTotal"></div>';
    b += "</div>";
    b += '<div id="ticker_tape_tv_genre" class="ticker_tape_tv_genre"><div id="promotion_id">Promotions</div><p id="tv_genre_promotion_text"></p></div>';
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showChannelChooserFooter() + "</div>";
    b += "</div>";
    return b
}

function showChannelChooserFooter() {
    var a = top.globalGetLabel("CH_LIST_BACK") + top.globalGetLabel("RC_MENU");
    return a
}

function chChooserSubMenuListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    var html = '<div class="chSubMenuListItem ' + this.eval(item, "class", "") + (selected && top.State.getState() == top.State.CH_SUBMENU ? "Selected" : "") + '">' + item.txtLabel + '</div>';
    return html
}

function chChooserAlphaListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    var html = item ? '<div style="background-image:url(images/' + top.DEFAULT_LANGUAGE + "/720p/alpha/" + this.eval(item, "letter", "") + (selected && top.State.getState() == top.State.CH_CHOOSER_ALPHA ? "1" : "") + '.png);background-repeat:no-repeat;width:70px;height:70px;float:left;"></div>' : "";
    return html
}

function chChooserGenreListHideHighlight() {
    document.getElementById("chChooserGenreListHighlight").style.visibility = "hidden"
}

function chChooserGenreListShowHighlight() {
    document.getElementById("chChooserGenreListHighlight").style.visibility = "visible"
}

function chChooserGenreListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        html += '<div class="chChooserChannelListItem">' + this.eval(item, "name", "") + "</div>"
    }
    return html
}


function chChooserGenreListOnIndexChanged(x, l) {
    var F;
    var selector = document.getElementById("chChooserGenreListHighlight");
    var selectorLeft = parseInt(window.getComputedStyle(selector, null).getPropertyValue("left"));
    var selectorTop = parseInt(window.getComputedStyle(selector, null).getPropertyValue("top"));

    var item = document.getElementsByClassName("chChooserChannelListItem")[0];
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

function chChooserGenreListDisplay() {
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


function chChooserGenreListDisplayTotal() {
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
    document.getElementById("chChooserGenreListTotal").innerHTML = b
}

//TV_Chooser Promotions
function tv_chooser_PromDisplayItem(prom_data){

    tv_chooser_promotion_index = 0;
    promotions = prom_data.split("|");
    top.GLOBAL_PROMOTION_INTERVAL = setInterval(function(){ tv_chooser_PromotionDataDisplayFunction() }, 4000); //laksan
}

function tv_chooser_PromotionDataDisplayFunction(){
    var count = promotions.length;
    if (tv_chooser_promotion_index < count) {
        var elx = document.getElementById("tv_genre_promotion_text");
        elx.innerHTML = promotions[tv_chooser_promotion_index];
        tv_chooser_promotion_index ++;
    }else{
        tv_chooser_promotion_index = 0;
    }
}

//End of TV_Chooser Promotions
