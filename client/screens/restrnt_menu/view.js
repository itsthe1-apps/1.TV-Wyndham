function restrntMenuListGetScreenHtml() {
    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="messageBlock" class="messageBlock"></div>';
    b += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    b += '<div class="header">';
    b += '<div class="headerLeft"></div><div class="headerRight"></div>';
    b += '<div id="globalLogo" class="globalLogo"></div>';
    b += '<div id="globalLogoRight" class="globalLogoRight"></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += "</div>";
    b += '<div id="restrntMenuListRestInfo" class="restrntMenuListRestInfo"></div>';
    b += "</div>";
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showFooterRest() + "</div>";
    b += "</div>";
    return b
}

function showFooterRest() {
    var a = top.globalGetLabel("RC_BACK") + top.globalGetLabel("RC_MENU");
    return a
}

function restrntMenuListDisplayRestInfo(c) {
    var d = "";
    if (c) {
        d += '<div class="restrntMenuListRestInfoPicture" style="background-image:url(' + c.image_menu + ');"></div>'
    }
    document.getElementById("restrntMenuListRestInfo").innerHTML = d
}

function restrntMenuListRestListOnAfterDisplay() {
    restrntListDisplayRestInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
};