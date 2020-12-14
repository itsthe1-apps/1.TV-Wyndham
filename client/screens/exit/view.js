function exitGetScreenHtml() {
    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="exitContainer" class="exitContainer">' + exitContent() + "</div>";
    if (top.DEVICE_TYPE == "exterity") {
        b += '<img id="audioSound" src="tv:" class="audioSound"></div>'
    }
    b += "</div>";
    return b
}

function exitContent() {
    var b = "";
    b += '<div id="exitLogo" class="exitLogo">';
    b += '<img src="' + top.ServiceManager.exitData.image_path + '" width="' + top.globalConst("EXIT_IMG_WIDTH") + '" >';
    b += "</div>";
    return b
}
;