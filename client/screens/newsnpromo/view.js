var newsnpromo_promotion_index; // added by ** Lakshan **
var promotions = new Array(); //Promotion Text Array added by ** Lakshan **
function newsnpromoListGetScreenHtml() {
    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="messageBlock" class="messageBlock"></div>';
    b += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    b += '<div class="header">';
    b += '<div id="globalLogo" class="globalLogo" style=""></div>';
    b += '<div id="homeweather" class="homeweather"></div>';
    // b += '<div id="globalLogoRight" class="globalLogoRight"></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += "</div>";
    b += menuGetMenuListHtml();
    // b += '<div id="globalTitle" class="globalTitle newsnpromoListTitle">' + top.globalGetLabel("NEWSNPROMO_LIST_TITLE") + "</div>";
    b += '<div id="newsnpromoListInfo" class="newsnpromoListInfo"><img id="newsnpromoListImage" class="newsnpromoListImage" /></div>';
    b += '<div id="newsnpromoListHighlight" class="newsnpromoListHighlight globalNewsnpromoHighlight"></div>';
    b += '<div id="newsnpromoListContainer" class="newsnpromoListContainer"></div>';
    b += "</div>";
    b += '<div id="newsnpromoListDescription" class="newsnpromoListDescription"></div>'
    b += '<div class="footer">';
    b += '<div class="newsFooter" id="newsFooter"><div class="newsFooterTitle" id="promotion_id">Promotions</div><div class="newsFooterText" id="newsFooterText"><div class="scrollInput" id="newsnpromo_promotion_text"></div></div></div>';
    //b += '<div id="ticker_tape_newsnpromo" class="ticker_tape_newsnpromo"><div id="promotion_id" class="newsFooterTitle">Promotions</div><p id="newsnpromo_promotion_text" class="scrollInput"></p></div>';
    b += '<div id="footerContainer" class="footerContainer">' + showNewsnpromoFooter() + "</div>";
    b += "</div>";
    return b
}

function showNewsnpromoFooter() {
    var a = top.globalGetLabel("RC_MENU");
    return a
}

function newsnpromoListHideHighlight() {
    document.getElementById("newsnpromoListHighlight").style.visibility = "hidden"
}

function newsnpromoListShowHighlight() {
    document.getElementById("newsnpromoListHighlight").style.visibility = "visible"
}

function newsnpromoListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.image && item.image != "") {
            html += '<div class="newsnpromoListItem">' + this.eval(item, "name", "") + "</div>"
        } else {
            html += '<div class="newsnpromoListItem">' + this.eval(item, "name", "") + "</div>"
        }
    }
    return html
}
//Newsnpromo Promotions
function newsnpromoPromDisplayItem(prom_data) {
    newsnpromo_promotion_index = 0;
    promotions = prom_data.split("|");
    top.GLOBAL_PROMOTION_INTERVAL = setInterval(function() {
        newsnpromoPromotionDataDisplayFunction()
    }, 4000); //laksan
}

function newsnpromoPromotionDataDisplayFunction() {
    var count = promotions.length;
    if (newsnpromo_promotion_index < count) {
        var elx = document.getElementById("newsnpromo_promotion_text");
        elx.innerHTML = promotions[newsnpromo_promotion_index];
        newsnpromo_promotion_index++;
    } else {
        newsnpromo_promotion_index = 0;
    }
}
//End of Newsnpromo Promotions
function newsnpromoListOnIndexChanged(c, i) {
    // this.display();
    // newsnpromoListDisplayInfo(this.getItem());
    // var k = document.getElementById("newsnpromoListHighlight");
    // var j = window.getComputedStyle(document.getElementsByClassName("newsnpromoListItem")[0], null).getPropertyValue("padding-bottom");
    // var m = window.getComputedStyle(document.getElementsByClassName("newsnpromoListItem")[0], null).getPropertyValue("height");
    // var h = window.getComputedStyle(document.getElementsByClassName("newsnpromoListContainer")[0], null).getPropertyValue("top");
    // var n = parseInt(h, 10) - (parseInt(j, 10) / 2);
    // var l;
    // var g = this.getSelected();
    // l = n + Math.floor(g % top.NEWSNPROMOINFO_LEFT_NAV_ROWS) * (parseInt(m, 10) + parseInt(j, 10));
    // top.TransitionManager.run(l, c, k)
    this.display();
    var k = this.getSelected();
    var element = document.getElementsByClassName("newsnpromoListItem")[k];
    element.style.color = "#FFF";
    // clearInterval(interval_id);
    //setting up promotion array according to restaurnt
    // if(k == 0){
    //     try{
    //         getNewsnpromoProms(k);
    //     } catch (f) {
    //         top.kwConsole.print(f.message);
    //     }
    // }else if(k == 1){
    //     try {
    //         getNewsnpromoProms(k);
    //     } catch (f) {
    //     }
    // }else if(k == 2){
    //     try {
    //         getNewsnpromoProms(k);
    //     } catch (f) {
    //     }
    // }else if(k == 3){
    //     try {
    //         getNewsnpromoProms(k);
    //     } catch (f) {
    //     }
    // }
}

function clearIntervalNewsnpromo() {
    clearInterval(interval_id);
}

function newsnpromoListDisplay() {
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

function newsnpromoListDisplayEmptyList() {
    newsnpromoListHideHighlight();
    this._container.innerHTML = '<div class="newsnpromoListEmpty">' + top.globalGetLabel("REST_LIST_EMPTY") + "</div>"
}

function newsnpromoListDisplayInfo(c) {
    var d = "";
    if (c) {
        img = document.getElementById("newsnpromoListImage");
        img.src = c.image;
        var desc = c.description;
        var info_ele = document.getElementById("newsnpromoListDescription");
        info_ele.innerHTML = htmlDecode(desc);
    }
}

function htmlDecode(input) {
    var e = document.createElement('div');
    e.innerHTML = input;
    return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
}

function newsnpromoListOnAfterDisplay() {
    newsnpromoListDisplayInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
}