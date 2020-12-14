var local_promotion_index; // added by ** Lakshan **
var promotions = new Array(); //Promotion Text Array added by ** Lakshan **

function localListGetScreenHtml() {

    var promotionText = "Promotions";
    if (top.DEFAULT_LANGUAGE == "ar") {
        promotionText = " إعلانات وعروض خاصة ";
    }

    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="messageBlock" class="messageBlock"></div>';
    b += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    b += '<div class="header">';
    b += '<div class="headerLeft"></div><div class="headerRight"></div>';
    b += '<div id="globalLogo" class="globalLogo" style=""></div>';
    b += '<div id="homeweather" class="homeweather"></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += "</div>";
    b += menuGetMenuListHtml();

    if (top.HIDE_SLIDER == 'YES') {
        b += '<div id="localListInfo" class="localListInfo"><img id="localListImage" class="localListImage" style="display:none;"/></div>';
    }

    b += '<div id="localListInfo" class="localListInfo"><img id="localListImage" class="localListImage" /></div>';
    b += '<div id="localListHighlight" class="localListHighlight globalLocalHighlight"></div>';
    b += '<div id="localListContainer" class="localListContainer"></div>';
    b += "</div>";
    b += '<div id="localListDescription" class="localListDescription"></div>'
    b += '<div id="ticker_tape_local" class="ticker_tape_local"><div id="promotion_id">'+promotionText+'</div><p id="local_promotion_text"></p></div>';
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showLocalFooter() + "</div>";
    b += "</div>";
    return b
}

function showLocalFooter() {
    var menu = top.globalGetLabel("RC_MENU");
    if (top.DEFAULT_LANGUAGE == 'ar') {
         menu = "<div class=footerImage><img src=images/rc/menu-button.jpg  /></div><div class=footerText> القائمة الفرعية  </div>";
    }
    return menu;
}

function localListHideHighlight() {
    document.getElementById("localListHighlight").style.visibility = "hidden"
}

function localListShowHighlight() {
    document.getElementById("localListHighlight").style.visibility = "visible"
}

function localListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.image && item.image != "") {
            html += '<div class="localListItem">' + this.eval(item, "name", "") + "</div>"
        } else {
            html += '<div class="localListItem">' + this.eval(item, "name", "") + "</div>"
        }
    }
    return html
}



//Local Promotions
function localPromDisplayItem(prom_data){

    local_promotion_index = 0;
    promotions = prom_data.split("|");
    top.GLOBAL_PROMOTION_INTERVAL = setInterval(function(){ localPromotionDataDisplayFunction() }, 4000); //laksan
}

function localPromotionDataDisplayFunction(){
    var count = promotions.length;
    if (local_promotion_index < count) {
        var elx = document.getElementById("local_promotion_text");
        elx.innerHTML = promotions[local_promotion_index];
        local_promotion_index ++;
    }else{
        local_promotion_index = 0;
    }
}

//End of Local Promotions


function localListOnIndexChanged(c, i) {
    // this.display();
    // localListDisplayRestInfo(this.getItem());
    // var k = document.getElementById("localListHighlight");
    // var j = window.getComputedStyle(document.getElementsByClassName("localListItem")[0], null).getPropertyValue("padding-bottom");
    // var m = window.getComputedStyle(document.getElementsByClassName("localListItem")[0], null).getPropertyValue("height");
    // var h = window.getComputedStyle(document.getElementsByClassName("localListContainer")[0], null).getPropertyValue("top");
    // var n = parseInt(h, 10) - (parseInt(j, 10) / 2);
    // var l;
    // var g = this.getSelected();
    // l = n + Math.floor(g % top.LOCALINFO_LEFT_NAV_ROWS) * (parseInt(m, 10) + parseInt(j, 10));
    // top.TransitionManager.run(l, c, k)
    this.display();

    var k = this.getSelected();

    var element = document.getElementsByClassName("localListItem")[k];
    //element.style.backgroundColor = "#B78D49";
    element.className += " active";
}



function localListDisplay() {
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

function localListDisplayEmptyList() {
    localListHideHighlight();
    this._container.innerHTML = '<div class="localListEmpty">' + top.globalGetLabel("REST_LIST_EMPTY") + "</div>"
}

function localListDisplayRestInfo(c) {
    var d = "";
    if (c) {
        img = document.getElementById("localListImage");
        img.src = c.image;
        var desc = c.description;
        var info_ele =  document.getElementById("localListDescription");
        info_ele.innerHTML = htmlDecode(desc);
    }
}

function htmlDecode(input){
  var e = document.createElement('div');
  e.innerHTML = input;
  return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
}

function localListOnAfterDisplay() {
    localListDisplayRestInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
}
