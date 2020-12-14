function homeGetScreenHtml() {
    var a = "";
    a += '<div class="bodyBGFlight">';
    a += '<div  id="homeeader" class="homeHeader"></div>';
    a += '<div  id="globalLogo" class="globalLogo"></div>';
    a += '<div id="homeweather" class="homeweather"></div>';
    a += '<div class="dateContainer" id="dateContainer">';
    a += '<div id="dateTitle" class="dateTitle"></div>';
    a += '<div id="dateText" class="dateText"></div>';
    a += "</div>";
    a += '<div id="homeScheduleContainer"  class="homeScheduleContainer"></div>';
    a += '<div class="homeScheduleTitle">DEPARTURES</div>';
    a += '<div id="homeScheduleItemContainer"  class="homeScheduleItemContainer"></div>';
    a += '<div class="homeMediaContainer" id="homeMediaContainer"></div>';
    a += '<div class="newsFooter" id="newsFooter"><div class="newsFooterTitle">World News</div><div class="newsFooterText" id="newsFooterText"><input type="text" class="scrollInput" id="scrollInput"></div></div>';
    a += "</div>";
    return a
}

function menuScheduleListDisplayItem(b, a, d) {
    var e = this.getItem(b);
    var c = "";
    if (typeof e !== "undefined") {
        if (top.scheduleSwitch == 0) {
            c += "<div class=homeScheduleItem_logo><img src=" + e.logo_url + "  vspace=2></div>";
            c += "<div class=homeScheduleItem_route>" + e.route + "</div>";
            c += "<div class=homeScheduleItem_flight>" + e.flight + "</div>";
            c += "<div class=homeScheduleItem_time>" + e.time + "</div>"
        } else {
            c += "<div class=homeScheduleItem_logo><img src=" + e.logo_url + "  vspace=5 ></div>";
            c += "<div class=homeScheduleItem_route>" + e.route + "</div>";
            c += "<div class=homeScheduleItem_flight>" + e.gate + "</div>";
            c += "<div class=homeScheduleItem_time>" + e.status + "</div>"
        }
    }
    return c
}

function menuScheduleListDisplay() {
    if (this.getLength() === 0) {
        return this.displayEmptyList()
    }
    var d = new top.Iterator(0, this.getIndex() - this.getSelected(), this.getLength(), this.isCyclic());
    var f = 0;
    var e = "";
    if (top.scheduleSwitch == 0) {
        e += '<div class="homeScheduleItem_logo_t">Airline</div>';
        e += '<div class="homeScheduleItem_route_t">Destination</div>';
        e += '<div class="homeScheduleItem_flight_t">Flight</div>';
        e += '<div class="homeScheduleItem_time_t">Time</div>';
    } else {
        e += '<div class="homeScheduleItem_logo_t">Airline</div>';
        e += '<div class="homeScheduleItem_route_t">Destination</div>';
        e += '<div class="homeScheduleItem_flight_t">Gate</div>';
        e += '<div class="homeScheduleItem_time_t">Status</div>';
    }
    while (f < this.getDisplayCount()) {
        if (d.isChanged() && f < this.getLength()) {
            e += this.displayItem(d.getIndex(), f, f == this.getSelected());
            d.increaseIndex();
        } else {
            e += this.displayItem(-1, f, false);
        }
        f++;
    }
    this._container.innerHTML = e;
}

function menuNewsListDisplayItem(index, position, selected) {
    var item = this.getItem(index);
    var html = "";
    t = this.eval(item, "title", "");
    t = t.length > 70 ? t.substr(0, 70) + "..." : t;
    html += t;
    return html;
}

function menuWeatherListDisplayItem(b, a, d) {
    var e = this.getItem(b);
    var c = "";
    c += '<div class="homeweatherImage"><img id="weatherURL" src="' + e.weatherImageURL + '" border=0 onError="noImage()"></div>';
    c += '<div class="homeweatherTextContainer">';
//    c += '<div class="homeweatherTextCity">' + e.day + '</div>';
    c += '<div class="homeweatherTextTmp">' + e.tmpHigh + '</div>';
    c += '<div class="homeweatherTextType">' + e.weatherType + '</div>';
    c += '</div>';
//    c += '<div class="homeweatherImage"><img id="weatherURL" src="images/weather/' + e.weatherImageURL + '" height="40" border=0 onError="noImage()"></div>';
//    c += '<div class="homeweatherTextContainer">';
//    c += '<div class="homeweatherTextCity"><b>City</b>:' + e.city + "</div>";
//    c += '<div class="homeweatherTextTitle">' + e.weatherType + "</div>";
//    c += '<div class="homeweatherTextTmp" ><b>Temperature</b>: High ' + e.tmpHigh + ", Low " + e.tmpLow + "</div>";
//    c += "</div>";
    return c;
}

function noImage() {
    document.getElementById("weatherURL").src = "images/w-nyork.png";
}

function menuMediaListDisplayItem(b, a, d) {
    var c = "";
    var e = this.getItem(b);
    top.kwConsole.print("menuMediaListDisplayItem" + e.type);
    if (e.type == "image") {
        c += '<img src="' + e.url + '" width="' + e.width + '" height="' + e.height + '" >'
    } else {
        if (e.type == "video") {
            c += '<embed id="video" style="background-color:#FFFFFF;" type="application/x-ant-player"  src="' + e.url + '" width="' + e.width + '" height="' + e.height + '"  />'
        }
    }
    return c;
}

function topclock() {
    var c = new Date();
    var a = c.toLocaleTimeString();
    var b = top.dateFormat(c, "dddd dS mmmm yyyy");
    if (document.getElementById("dateTitle") !== null) {
        document.getElementById("dateTitle").innerHTML = b
    }
    if (document.getElementById("dateText") !== null) {
        document.getElementById("dateText").innerHTML = a
    }
}