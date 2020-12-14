var experience_promotion_index; // added by ** Lakshan **
var index = 1; // Slider Image Index added by ** Lakshan **
var slider_images = new Array(); // Slider Image Array added by ** Lakshan **
var promotions = new Array(); //Promotion Text Array added by ** Lakshan **

function expListGetScreenHtml() {
    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="messageBlock" class="messageBlock"></div>';
    b += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    b += '<div class="header">';
    b += '<div class="headerLeft"></div><div class="headerRight"></div>';
    b += '<div id="homeweather" class="homeweather"></div>';
    b += '<div id="globalLogo" class="globalLogo" style=""></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += "</div>";
    b += menuGetMenuListHtml();
    b += '<div id="expListInfo" class="expListInfo"><img id="expListImage" class="expListImage" /></div>';
    b += '<div id="expListHighlight" class="expListHighlight globalLocalHighlight"></div>';
    b += '<div id="expListContainer" class="expListContainer"></div>';
    b += "</div>";
    b += '<div id="expListDescription" class="expListDescription"></div>'
    b += '<div id="ticker_tape_exp" class="ticker_tape_exp"><div id="promotion_id">Promotions</div><p id="exp_promotion_text"></p></div>';
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showLocalFooter() + "</div>";
    b += "</div>";
    return b
}

function showLocalFooter() {
    var a = top.globalGetLabel("RC_MENU");
    return a
}

function expListHideHighlight() {
    document.getElementById("expListHighlight").style.visibility = "hidden"
}

function expListShowHighlight() {
    document.getElementById("expListHighlight").style.visibility = "visible"
}

function expListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.image && item.image != "") {
            html += '<div class="expListItem">' + this.eval(item, "experience_type", "") + "</div>"
        } else {
            html += '<div class="expListItem">' + this.eval(item, "experience_type", "") + "</div>"
        }
    }
    return html
}


function expListOnIndexChanged(c, i) {
    // this.display();
    // expListDisplayRestInfo(this.getItem());
    // var k = document.getElementById("expListHighlight");
    // var j = window.getComputedStyle(document.getElementsByClassName("expListItem")[0], null).getPropertyValue("padding-bottom");
    // var m = window.getComputedStyle(document.getElementsByClassName("expListItem")[0], null).getPropertyValue("height");
    // var h = window.getComputedStyle(document.getElementsByClassName("expListContainer")[0], null).getPropertyValue("top");
    // var n = parseInt(h, 10) - (parseInt(j, 10) / 2);
    // var l;
    // var g = this.getSelected();
    // l = n + Math.floor(g % top.LOCALINFO_LEFT_NAV_ROWS) * (parseInt(m, 10) + parseInt(j, 10));
    // top.TransitionManager.run(l, c, k)
    this.display();

    var k = this.getSelected();

    var element = document.getElementsByClassName("expListItem")[k];
    element.style.backgroundColor = "#B78D49";
    //setting up promotion array according to restaurnt

}

function expListDisplay() {
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

function expListDisplayEmptyList() {
    expListHideHighlight();
    this._container.innerHTML = '<div class="expListEmpty">' + top.globalGetLabel("EXP_LIST_EMPTY") + "</div>"
}

function expListDisplayRestInfo(c) {
    var d = "";
    if (c) {

        slider_images = null;
        var img = document.getElementById("expListImage");
        var pre_url = top.IMAGES_PREFIX+"EXP/";
        slider_images = exp_get_images_array(c.experience_img_url,pre_url);
        index = 1; // Initiating slider image index when  function recall
        img.src = slider_images[0]; // Displaying the first image of the slider before timer getting started
        clearInterval(top.GLOBAL_SLIDER_INTERVAL); // Clearing the slider timer when function recall
        top.GLOBAL_SLIDER_INTERVAL = setInterval(function(){ expChangeImg(img) }, 5000);


        //Description

        var desc = c.description;
        var info_ele = document.getElementById("expListDescription");
        info_ele.innerHTML = desc;
    }
}

//Image Slider
function exp_get_images_array(image,pre_url){

    var img_arr = new Array();
    var imgs = image.split("|");
    for (var i = 0; i < imgs.length; i++) {
        img_arr[i] = pre_url+imgs[i];
    }
    return img_arr;
}


function expChangeImg(img){

    img.src = slider_images[index];
    index++;

    if (slider_images.length ==  index) {
         index = 0;
    }
}
//End Image Slider

function htmlDecode(input) {
    var e = document.createElement('div');
    e.innerHTML = input;
    return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
}

function expListOnAfterDisplay() {
    expListDisplayRestInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
}

//Experiece Promotions
function experiencePromDisplayItem(prom_data){

    experience_promotion_index = 0;
    promotions = prom_data.split("|");
    top.GLOBAL_PROMOTION_INTERVAL = setInterval(function(){ experiencePromotionDataDisplayFunction() }, 4000); //laksan
}

function experiencePromotionDataDisplayFunction(){
    var count = promotions.length;
    if (experience_promotion_index < count) {
        var elx = document.getElementById("exp_promotion_text");
        elx.innerHTML = promotions[experience_promotion_index];
        experience_promotion_index ++;
    }else{
        experience_promotion_index = 0;
    }
}

//End of Experiece Promotions
