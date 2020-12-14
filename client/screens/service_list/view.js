
var service_list_promotion_index; // added by ** Lakshan **
var promotions = new Array(); //Promotion Text Array added by ** Lakshan **

function serviceListGetScreenHtml() {
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
    b += '<div id="serviceListInfo" class="serviceListInfo"><img id="serviceListImage" class="serviceListImage" /></div>';
    b += '<div id="serviceListHighlight" class="serviceListHighlight globalservice_listHighlight"></div>';
    b += '<div id="serviceListContainer" class="serviceListContainer"></div>';
    b += "</div>";
    b += '<div id="serviceListDescription" class="serviceListDescription"></div>'
    b += '<div id="ticker_tape_service_list" class="ticker_tape_service_list"><div id="promotion_id">Promotions</div><p id="service_list_promotion_text"></p></div>';
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showservice_listFooter() + "</div>";
    b += "</div>";
    return b
}

function showservice_listFooter() {
    var a = top.globalGetLabel("RC_MENU");
    return a
}

function serviceListHideHighlight() {
    document.getElementById("serviceListHighlight").style.visibility = "hidden"
}

function serviceListShowHighlight() {
    document.getElementById("serviceListHighlight").style.visibility = "visible"
}

function serviceListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.image && item.image != "") {
            html += '<div class="serviceListItem">' + this.eval(item, "service_type", "") + "</div>"
        } else {
            html += '<div class="serviceListItem">' + this.eval(item, "service_type", "") + "</div>"
        }
    }
    return html
}

//service_list Promotions
function service_listPromDisplayItem(prom_data){

    service_list_promotion_index = 0;
    promotions = prom_data.split("|");
    top.GLOBAL_PROMOTION_INTERVAL = setInterval(function(){ service_listPromotionDataDisplayFunction() }, 4000); //laksan
}

function service_listPromotionDataDisplayFunction(){
    var count = promotions.length;
    if (service_list_promotion_index < count) {
        var elx = document.getElementById("service_list_promotion_text");
        elx.innerHTML = promotions[service_list_promotion_index];
        service_list_promotion_index ++;
    }else{
        service_list_promotion_index = 0;
    }
}

//End of service_list Promotions


function serviceListOnIndexChanged(c, i) {
    // this.display();
    // serviceListDisplayRestInfo(this.getItem());
    // var k = document.getElementById("serviceListHighlight");
    // var j = window.getComputedStyle(document.getElementsByClassName("serviceListItem")[0], null).getPropertyValue("padding-bottom");
    // var m = window.getComputedStyle(document.getElementsByClassName("serviceListItem")[0], null).getPropertyValue("height");
    // var h = window.getComputedStyle(document.getElementsByClassName("serviceListContainer")[0], null).getPropertyValue("top");
    // var n = parseInt(h, 10) - (parseInt(j, 10) / 2);
    // var l;
    // var g = this.getSelected();
    // l = n + Math.floor(g % top.service_listINFO_LEFT_NAV_ROWS) * (parseInt(m, 10) + parseInt(j, 10));
    // top.TransitionManager.run(l, c, k)
    this.display();

    var k = this.getSelected();

    var element = document.getElementsByClassName("serviceListItem")[k];
    element.style.backgroundColor = "#B78D49";
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
    serviceListHideHighlight();
    this._container.innerHTML = '<div class="serviceListEmpty">' + top.globalGetLabel("REST_LIST_EMPTY") + "</div>"
}

function serviceListDisplayRestInfo(c) {
    var d = "";
    if (c) {
        img = document.getElementById("serviceListImage");
        var pre_url = top.IMAGES_PREFIX+"SERVICE_LIST/";
        img.src = pre_url+c.image;
        var desc = c.description+'<br/><br/><h5 id="services_tel">'+c.telephone+'</h5>';
        var info_ele =  document.getElementById("serviceListDescription");
        info_ele.innerHTML = "<p>"+desc+"</p>";//htmlDecode(desc);
    }
}

function htmlDecode(input){
  var e = document.createElement('div');
  e.innerHTML = input;
  return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
}

function serviceListOnAfterDisplay() {
    serviceListDisplayRestInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
}
