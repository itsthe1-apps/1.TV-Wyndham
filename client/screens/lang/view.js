function langGetScreenHtml() {
    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="globalLogoL" class="globalLogo" style=""></div>';
    b += '<div id="loader" class="loader"></div>';
    b += langGetMenuListHtml();
    b += "</div>";
    return b
}

function langGetMenuListHtml() {
    var b = "";
    b += '<div class="langListContainer">';
    b += '<div id="langMainListContainer" class="langMainListContainer"></div>';
    b += "</div>";
    return b
}

function langMainListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    var html = '<div class="langMainListItem ' + this.eval(item, "class", "") + (selected ? "Selected" : "") + '"></div>';
    return html
};