function epgGetScreenHtml() {
    var b = "";
    b += '<div id="messageBlock" class="messageBlock"></div>';
    b += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    b += '<div id="epgProgramInfo" class="epgProgramInfo"></div>';
    b += '<div class="epgGridContainer">';
    b += '<div id="epgGridDate" class="epgGridDate"></div>';
    b += '<div id="epgGridTimeLine" class="epgGridTimeLine"></div>';
    b += '<div id="epgChannelListContainer" class="epgChannelListContainer"></div>';
    b += '<div id="epgProgramListContainer" class="epgProgramListContainer"></div>';
    b += "</div>";
    return b
}

function epgUpdateGridDate() {
    document.getElementById("epgGridDate").innerHTML = top.Clock.getFormattedDate(epgGridTime, "EEE NNN, dd")
}

function epgUpdateGridTimeLine() {
    var c = "";
    for (var d = 0; d < 5; d++) {
        c += '<div class="epgGridTimeLineItem">' + top.Clock.getFormattedTime((epgGridTime + d * 30 * 60 * 1000), false) + "</div>"
    }
    document.getElementById("epgGridTimeLine").innerHTML = c
}

function epgChannelListDisplayItem(e, f, g) {
    var h = "";
    if (this.getItem(e)) {
        h = '<div class="epgChannelListItem">' + this.getItem(e).number + "   " + this.getItem(e).name + "</div>"
    } else {
        h = '<div class="epgChannelListItem"></div>'
    }
    return h
}

function epgDisplayProgram(m, p, s) {
    var t = null,
            l = null,
            n = 0,
            v = 0,
            o = 0,
            u = 7;
    var q = '<div class="epgProgramsDiv">';
    if (m && m.programs) {
        m.programs = top.EPGChannelManager.fixEpgProgramListByChannel(m)
    }
    t = m && m.programs ? m.programs : null;
    var r = new top.Iterator(0, 0, t ? t.length : 0, false);
    if (t && t.length > 0) {
        do {
            l = t[r.getIndex()];
            if (l.endTime > epgGridTime) {
                n++;
                v = epgGetProgramWidth(l, epgGridTime);
                v = v == 0 ? (v + u + 1) : (v + u);
                o += (v + u + (n > 2 ? 2 : n));
                v = Math.min(v, (665 - (o - v)));
                q += '<div class="' + (s && (r.getIndex() == epgGetSelectedProgramIndex()) ? "epgProgramDivSelected" : "epgProgramDiv") + '" style="width:' + (v < 0 ? 0 : v) + 'px;">' + l.name + "</div>"
            }
            r.increaseIndex()
        } while (r.isChanged() && o <= 665);
        if (o < 665) {
            q += '<div class="epgProgramDiv" style="width:' + (665 - o - 7 - (n > 2 ? 2 : n)) + 'px;">' + top.globalGetLabel("INFOBAR_INFORMATION_UNAVAILABLE") + "</div>"
        }
    } else {
        if (m == -1) {
            q += '<div class="epgFullIU epgProgramDiv"></div>'
        } else {
            q += '<div class="epgFullIU ' + (s ? "epgProgramDivSelected" : "epgProgramDiv") + '">' + top.globalGetLabel("INFOBAR_INFORMATION_UNAVAILABLE") + "</div>"
        }
    }
    q += "</div>";
    return q
}

function epgDisplayPrograms() {
    var e = "",
            f = 0;
    var d = new top.Iterator(0, this.getIndex() - this.getSelected(), this.getLength(), this.isCyclic());
    while (f < this.getDisplayCount()) {
        if (d.isChanged() && f < this.getLength()) {
            e += this.displayProgram(this.getItem(d.getIndex()), f, f == this.getSelected());
            d.increaseIndex()
        } else {
            e += this.displayProgram(-1, f, false)
        }
        f++
    }
    document.getElementById("epgProgramListContainer").innerHTML = e
}

function epgGetProgramWidth(f, g) {
    var h = 120 * 60 * 1000;
    if (f.endTime < g || f.startTime > (g + h)) {
        return 0
    } else {
        var e = Math.round((Math.min(f.endTime, g + h) - Math.max(f.startTime, g)) * (665 / h));
        return e
    }
}

function epgUpdateProgramInfo() {
    var c = "";
    var d = epgGetSelectedProgram();
    if (d) {
        c += '<div class="epgProgramInfoName">' + d.name + "</div>";
        c += '<div class="epgProgramInfoDate">' + top.Clock.getFormattedDate(d.startTime, "EEE NNN, dd") + " " + top.Clock.getFormattedTime(d.startTime, false) + "</div>";
        c += '<div class="epgProgramInfoDescription">' + d.description + "</div>"
    }
    document.getElementById("epgProgramInfo").innerHTML = c
}