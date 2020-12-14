var services_promotion_index; // added by ** Lakshan **
var promotions = new Array(); //Promotion Text Array added by ** Lakshan **


function serviceGetScreenHtml() {
    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="messageBlock" class="messageBlock"></div>';
    b += '<div class="header">';
    b += '<div class="headerLeft"></div><div class="headerRight"></div>';
    b += '<div id="globalLogo" class="globalLogo" style=""></div>';
    b += '<div id="homeweather" class="homeweather"></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += "</div>";
    b += menuGetMenuListHtml();
    b += '<div id="servicemsg" class="servicemsg"></div>';
    b += '<div id="serviceListInfo" class="serviceListInfo"></div>';
    b += '<div id="serviceListHighlight" class="serviceListHighlight globalServiceHighlight"></div>';
    b += '<div id="serviceListContainer" class="serviceListContainer"></div>';
    b += '<div id="serviceOrderListHighlight" class="serviceOrderListHighlight globalServiceOrderHighlight"></div>';
    b += '<div id="serviceInfoContainer" class="serviceInfoContainer">';
    b += '<div id="serviceInfoContainerTitle" class="serviceInfoContainerTitle"></div>';
    b += '<div id="serviceInfoContainerContent" class="serviceInfoContainerContent"></div></div>';
    b += "</div>";
    b += '<div id="ticker_tape_services" class="ticker_tape_services"><div id="promotion_id">Promotions</div><p id="services_promotion_text"></p></div>';
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showServiceOrderFooter() + "</div>";
    b += "</div>";
    return b
}

function showServiceOrderFooter() {
    var a = top.globalGetLabel("RC_MENU");
    return a
}

function serviceListShowHighlight() {
    document.getElementById("serviceListHighlight").style.visibility = "visible"
}

function serviceListHideHighlight() {
    document.getElementById("serviceListHighlight").style.visibility = "hidden"
}

function serviceListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + '">&nbsp;</div>'
    }
    return html
}

function serviceListOnIndexChanged(c, i) {
    this.display();
    serviceDisplayRestInfo(this.getItem());
    var k = document.getElementById("serviceListHighlight");
    var j = window.getComputedStyle(document.getElementsByClassName("serviceNavListItems")[0], null).getPropertyValue("padding-bottom");
    var m = window.getComputedStyle(document.getElementsByClassName("serviceNavListItems")[0], null).getPropertyValue("height");
    var h = window.getComputedStyle(document.getElementsByClassName("serviceListContainer")[0], null).getPropertyValue("top");
    var n = parseInt(h, 10) - (parseInt(j, 10) / 2);
    var l;
    var g = this.getSelected();
    l = n + Math.floor(g % top.SERVICE_LEFT_NAV_ROWS) * (parseInt(m, 10) + parseInt(j, 10));
    top.TransitionManager.run(l, c, k)
}

function serviceListDisplay() {
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

function serviceListDisplayEmptyList() {
    serviceListListHideHighlight();
    this._container.innerHTML = '<div class="serviceListEmptyRestList">' + top.globalGetLabel("REST_LIST_EMPTY") + "</div>"
}

function serviceDisplayRestInfo(c) {
    var d = "";
    if (c) {
        if (c.target == "taxi") {
            document.getElementById("serviceInfoContainerTitle").innerHTML = "Taxi Request Service"
        } else {
            if (c.target == "wakeup") {
                document.getElementById("serviceInfoContainerTitle").innerHTML = "Wake-Up Service Request"
            } else {
                if (c.target == "laundry") {
                    document.getElementById("serviceInfoContainerTitle").innerHTML = "Laundry Request Service"
                } else {
                    if (c.target == "room") {
                        document.getElementById("serviceInfoContainerTitle").innerHTML = "Room Service Request"
                    }
                }
            }
        }
    }
}

function serviceListOnAfterDisplay() {
    serviceDisplayRestInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
}

function serviceOrderListDisplayItem(index, position, selected) {
    if (inLeftNavigator == true) {
        selected = false
    }
    var html = "";
    var item = this.getItem(index);
    
    return html
}

function serviceOrderListShowHighlight() {
    document.getElementById("serviceOrderListHighlight").style.visibility = "visible";
    document.getElementById("serviceOrderListHighlight").style.top = "262px"
}

function serviceOrderListHideHighlight() {
    document.getElementById("serviceOrderListHighlight").style.visibility = "hidden"
}

function serviceOrderListOnAfterDisplay() {
    serviceDisplayRestInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
}

//Dine Promotions
function servicesPromDisplayItem(prom_data){

    services_promotion_index = 0;
    promotions = prom_data.split("|");
    top.GLOBAL_PROMOTION_INTERVAL = setInterval(function(){ servicesPromotionDataDisplayFunction() }, 4000); //laksan
}

function servicesPromotionDataDisplayFunction(){
    var count = promotions.length;
    if (services_promotion_index < count) {
        var elx = document.getElementById("services_promotion_text");
        elx.innerHTML = promotions[services_promotion_index];
        services_promotion_index ++;
    }else{
        services_promotion_index = 0;
    }
}

//End of Dine Promotions
