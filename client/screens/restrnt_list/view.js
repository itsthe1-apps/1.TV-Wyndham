var dine_promotion_index; // added by ** Lakshan **
var index = 1; // Slider Image Index added by ** Lakshan **
var slider_images = new Array(); // Slider Image Array added by ** Lakshan **
var promotions = new Array(); //Promotion Text Array added by ** Lakshan **



function restrntListGetScreenHtml() {

    //Once data recive from db remove this sample text;
    //var sample_desc = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,";
    //var sample_heading = "Information Heading";

     var promotionText = "Promotions";
    if (top.DEFAULT_LANGUAGE == "ar") {
        promotionText = " إعلانات وعروض خاصة ";
    }

    b = "";
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
        b += '<div id="restrntListRestInfo" class="restrntListRestInfo"><img id="restImage" class="restImage" style="display:none;" /></div>';
    }
    b += '<div id="restrntListRestInfo" class="restrntListRestInfo"><img id="restImage" class="restImage" /></div>';
    b += '<div id="restrntListRestListHighlight" class="restrntListRestListHighlight globalRestListHighlight"></div>';
    b += '<div id="restrntListRestListContainer" class="restrntListRestListContainer"></div>';
    b += "</div>";
    b += '<div id="restaurant_information" class="restaurant_information"></div>';
    b += '<div id="ticker_tape_restaurent" class="ticker_tape_restaurent"><div id="promotion_id">'+promotionText+'</div><p id="restaurent_promotion_text"></p></div>';
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showRestFooter() + "</div>";
    b += "</div>";
    return b
}

function showRestFooter() {
    var menu = top.globalGetLabel("RC_MENU");
    if (top.DEFAULT_LANGUAGE == 'ar') {
         menu = "<div class=footerImage><img src=images/rc/menu-button.jpg  /></div><div class=footerText> القائمة الفرعية  </div>";
    }
    return menu;
}

function restrntListRestListHideHighlight() {
    document.getElementById("restrntListRestListHighlight").style.visibility = "hidden"
}

function restrntListRestListShowHighlight() {
    document.getElementById("restrntListRestListHighlight").style.visibility = "visible"
}

function restrntListRestListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.image && item.image != "") {
            html += '<div class="restrntListRestListItem">' + this.eval(item, "name", "") + "</div>"
        } else {
            html += '<div class="restrntListRestListItem">' + this.eval(item, "name", "") + "</div>"
        }
    }
    return html;
}


//Dine Promotions
function restrntPromDisplayItem(prom_data){

    dine_promotion_index = 0;
    promotions = prom_data.split("|");
    top.GLOBAL_PROMOTION_INTERVAL = setInterval(function(){ restaurantPromotionDataDisplayFunction() }, 4000); //laksan
}

function restaurantPromotionDataDisplayFunction(){
    var count = promotions.length;
    if (dine_promotion_index < count) {
        var elx = document.getElementById("restaurent_promotion_text");
        elx.innerHTML = promotions[dine_promotion_index];
        dine_promotion_index ++;
    }else{
        dine_promotion_index = 0;
    }
}

//End of Dine Promotions


function restrntListRestListOnIndexChanged(c, i) {
    // this.display();
    // restrntListDisplayRestInfo(this.getItem());
    // var k = document.getElementById("restrntListRestListHighlight");
    // var j = window.getComputedStyle(document.getElementsByClassName("restrntListRestListItem")[0], null).getPropertyValue("padding-bottom");
    // var m = window.getComputedStyle(document.getElementsByClassName("restrntListRestListItem")[0], null).getPropertyValue("height");
    // var h = window.getComputedStyle(document.getElementsByClassName("restrntListRestListContainer")[0], null).getPropertyValue("top");
    // var n = parseInt(h, 10) - (parseInt(j, 10) / 2);
    // var l;
    // var g = this.getSelected();
    // l = n + Math.floor(g % top.LOCALINFO_LEFT_NAV_ROWS) * (parseInt(m, 10) + parseInt(j, 10));
    // top.TransitionManager.run(l, c, k)

    this.display();

    var k = this.getSelected();
    var element = document.getElementsByClassName("restrntListRestListItem")[k];
    //element.style.backgroundColor = "#B78D49";
    element.className += " active";


}



// function getRestrnProms(id){

//     var prom_text = document.getElementById("restaurent_promotion_text");
//     prom_text.innerHTML = " ";
//     var json_url = top.TICKER_MEDIA_URL+"en/format/json";
//     top.kwUtils.kwXMLHttpRequest("GET", json_url, true, this, getRestaurantXMLData, id);

// }

// function getRestaurantXMLData(jsonString,id){

//     var json = JSON.parse(jsonString);
//     var promotions;

//     if (json[id] =='undefined' || json[id] == null) {
//         promotions = " | | |";
//     }else{
//         promotions = json[id].ticker_promo_txt;
//     }

//     restrntPromDisplayItem(promotions);
// }


function restrntListRestListDisplay() {
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



function restrntListRestListDisplayEmptyList() {
    restrntListRestListHideHighlight();
    this._container.innerHTML = '<div class="restrntListEmptyRestList">' + top.globalGetLabel("REST_LIST_EMPTY") + "</div>"
}

function restrntListDisplayRestInfo(c) {

    var d = "";
    if (c) {
        try {
            slider_images = null;
            var img = document.getElementById("restImage");
            var pre_url = top.IMAGES_PREFIX+"RESTAURANT/";
            slider_images = rest_get_images_array(c.image,pre_url);
            index = 1; // Initiating slider image index when  function recall
            img.src = slider_images[0]; // Displaying the first image of the slider before timer getting started
            clearInterval(top.GLOBAL_SLIDER_INTERVAL); // Clearing the slider timer when function recall
            top.GLOBAL_SLIDER_INTERVAL = setInterval(function(){ restChangeImg(img) }, 5000);


            //Description
            var information = document.getElementById("restaurant_information");
            information.innerHTML = htmlDecode(c.description);
        } catch (f) {
            top.kwConsole.print(f.message);
        }
    }
}

//Image Slider
function rest_get_images_array(image,pre_url){

    var img_arr = new Array();
    var imgs = image.split("|");
    for (var i = 0; i < imgs.length; i++) {
        if (i == 0) {
            img_arr[i] = imgs[i];
        }else{
            img_arr[i] = pre_url+imgs[i];
        }
    }
    return img_arr;
}


function restChangeImg(img){

    img.src = slider_images[index];
    index++;

    if (slider_images.length ==  index) {
         index = 0;
    }
}
//End Image Slider

//HTML Decode For Description
function htmlDecode(input){
  var e = document.createElement('div');
  e.innerHTML = input;
  return e.childNodes.length === 0 ? "" : e.childNodes[0].nodeValue;
}
// End HTML Decode For Description


function restrntListRestListOnAfterDisplay() {
    restrntListDisplayRestInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
}
