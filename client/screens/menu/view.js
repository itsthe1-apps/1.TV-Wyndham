var msgIsInfobarHidden = true;
function menuGetScreenHtml() {
    var c = "";
    c += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    c += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    c += '<div id="globalVolumeBar" class="globalVolumeBar"></div>';
    c += '<div class="header">';
    c += '<div class="headerLeft"></div><div class="headerRight"></div>';
    c += '<div id="globalMute" class="globalMute"></div>';
    c += '<div id="globalLogo" class="globalLogo" style=""></div>';
    c += '<div id="homeweather" class="homeweather"></div>';
    c += '<div id="globalLogoRight" class="globalLogoRight"></div>';
    c += '<div id="globalClock" class="globalClock"></div>';
    c += "</div>";
    c += menuGetMenuListHtml();
    c += '<div class="information">';
    c += '<div id="guestTitle" class="guestTitle">' + showUserTitle() + "</div>";
    c += '<div id="menuNewsListContainer" class="menuNewsListContainer"></div>';
    c += "</div>";
    c += '<div id="globalClipScreen" class="globalClipScreen welcome"></div>';
    c += '<div class="footer">';
    c += '<div id="homefooterContainer" class="homefooterContainer">';
    if (top.TTAPE_MARQUEE == 0) {
        c += showMenuFooter();
    }
    c += "</div>";
    c += "</div>";
    c += '<div id="messageBlock" class="messageBlock"></div>';
    return c;
}
function menuWeatherListDisplayItem(g, h, j) {
    var e = this.getItem(g);
    var c = "";
    c += '<div class="homeweatherImage"><img id="weatherURL" src="' + e.weatherImageURL + '" border=0 onError="noImage()"></div>';
    c += '<div class="homeweatherTextContainer">';
//    c += '<div class="homeweatherTextCity">' + e.day + '</div>';
    c += '<div class="homeweatherTextTmp">' + e.tmpHigh + '</div>';
    c += '<div class="homeweatherTextType">' + e.weatherType + '</div>';
    c += '</div>';
//    k += '<div class="homeweatherImage"><img id="weatherURL" style="-ant-highlight-color: transparent;-ant-user-input: disable;" src="' + i.weatherImageURL + '" width=50 border=0></div>';
//    k += '<div class="homeweatherTextContainer">';
//    k += '<div class="homeweatherTextCity"><b>' + i.day + "</b></div>";
//    k += '<div class="homeweatherTextTitle">' + i.weatherType + "</div>";
//    k += '<div class="homeweatherTextTmp"><b>Temperature</b>: High ' + i.tmpHigh + ", Low " + i.tmpLow + "</div>";
//    k += "</div>";
    return c;
}
function menuMediaListDisplayItem(h, i, k) {
    var l = "";
    var j = this.getItem(h);
    if (j.type == "image") {
        top.Player.stop();
        l += '<div class="homeMediaContainer" id="homeMediaContainer"><img src="' + j.url + '" class="promoImage" ></div>';
    } else {
        if (j.type == "video") {
            if (top.DEVICE_TYPE == "exterity") {
                top.kwConsole.print(j.url);
                top.Player.play(j.url);
                l += '<img id="player" style="background-color:#000; margin-left:10px; margin-top:15px;" src="tv:" width="' + top.CLIP_W + '" height="' + top.CLIP_H + '" />';
            }
            if (top.DEVICE_TYPE == "dunehd") {
                b = j.url;
                top.kwConsole.print(b);
                top.Player.play(b);
                top.Player.setClipScreen();
            }
            if (top.DEVICE_TYPE == "aminocom") {
                try {
                    top.Player.play(j.url);
                    top.Player.setClipScreen();
                } catch (m) {
                    alert(m.message);
                }
            }
            if (top.DEVICE_TYPE == "infomir") {
                b = top.MCAST_PREFIX + j.url;
                //alert("top.DEVICE_TYPE :: " + top.MCAST_PREFIX + j.url);
                top.kwConsole.print(b);
                top.Player.play(b);
                top.Player.setClipScreen();
            }
        }
    }
    return l
}
function showMenuFooter() {
    var title = top.globalGetLabel("TAPE_TITLE");
    if (top.DEFAULT_LANGUAGE == 'ar') {
        title = " أخبار عالمية ";
    }
    var c = '<div class="newsFooter" id="newsFooter"><div class="newsFooterTitle">' + title + '</div><div class="newsFooterText" id="newsFooterText"><input type="text" class="scrollInput" id="scrollInput"></div></div>';
    return c;
}
function showUserTitle() {
    var c = "";
    if (top.DEAULT_ROOM != 'NNNNN') {
        if(top.GUEST_NAME == 'Welcome . '){
            c = "Welcome To " + top.HOTEL_NAME + "<br>";
        }else{
            
            c = "<div id='guest_name_title'>"+top.GUEST_NAME + "</div><br>";
        }
    } else {
        
        c = "Welcome To " + top.HOTEL_NAME + "<br>";
    }
    if(top.CHECKED_OUT == true){
        c = "Welcome to Elite Byblos Hotel"+"<br/>";
    }else{
        //c = c + "<span class='guestWelcome'>" + top.WELCOME_MSG + "</span>";
    }
    return c;
}
function menuGetMenuListHtml() {
    var c = "";
    c += '<div class="menuListContainer">';
    c += '<div id="menuMainListContainer" class="menuMainListContainer"></div>';
    c += "</div>";
    c += '<div class="menuListCorner"></div>';
    return c;
}
function menuMainListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
//    var html = '<div class="menuMainListItem ' + this.eval(item, "class", "") + (selected ? "Selected" : "") + '"></div>';
    var html = '<div class="menuMainListItem ' + this.eval(item, "class", "") + (selected ? "Selected" : "") + '">' + item.txtLabel + '</div>';
    return html;
}
function menuNewsListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    var html = '<div class="menuNewsListItemTitle">' + this.eval(item, "title", "") + "</div>";
    html += '<div class="menuNewsListItemSummary">' + this.eval(item, "summary", "") + "</div>";
    return html;
}
function menuNewsTapeListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    var title = top.globalGetLabel("TAPE_TITLE");
    if (top.DEFAULT_LANGUAGE == 'ar') {
        title = 'اخبار العالم';
    }
    var html = '<div class="newsFooter" id="newsFooter"><div class="newsFooterTitle">' + title+ '</div><div class="newsFooterText" id="newsFooterText"><div class="scrollInput">' + this.eval(item, "title", "") + "</div></div></div>";
    return html;
}