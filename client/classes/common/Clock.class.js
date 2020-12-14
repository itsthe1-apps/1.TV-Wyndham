var Clock = {
    dateFormat: "NNN dd",
    currentTime: null,
    ampm: false,
    show: function (i, g) {
       var u = top.DATETIME_URL+top.DEFAULT_LANGUAGE+"/format/json";
        //added by Yesh - for none working NTP server STBs
        if (top.LOCAL_DATE) {
            top.kwUtils.kwXMLHttpRequest("GET", u, true, this, function (datetime) {
                datetime = (typeof datetime === "object") ? datetime : top.jsonParser(datetime);
                currentTime = datetime.time;
                var k = '<div class="homeclockImage"></div><div class="homeclockTextContainer"><div class="homeclockTextTmp">' + datetime.time + '</div><div class="homeclockTextType">' + datetime.day + '</div></div>';
//                var k = '<span align="right" class="sceneDateTime">' + this.getFormattedDate() + ", " + this.getFormattedTime() + "</span>";
                var l = i.document.getElementById(g);
                if (l) {
                    l.innerHTML = k;
                }
                var h = (60 * 1000);
                top.kwTimer.setTimer("CLOCK", {
                    scope: this,
                    callback: this.show,
                    args: [i, g]
                }, h);
            });
        } else {
            var j = new Date(this.getCurrentTime());
            var k = '<span align="right" class="sceneDateTime">' + this.getFormattedDate() + ", " + this.getFormattedTime() + "</span>";
            var l = i.document.getElementById(g);
            if (l) {
                l.innerHTML = k;
            }
            var h = (60000 - ((j.getSeconds() * 1000) + j.getMilliseconds()));
            top.kwTimer.setTimer("CLOCK", {
                scope: this,
                callback: this.show,
                args: [i, g]
            }, h);
        }
    },
    stop: function () {
        top.kwTimer.cancelTimer("CLOCK");
    },
    addLeadingZero: function (b) {
        return (b > 9 ? b : "0" + b);
    },
    msec2Time: function (g) {
        var h = Math.floor(g / 1000);
        var e = Math.floor(h / 60);
        var f = Math.floor(e / 60);
        return this.addLeadingZero(f % 24) + ":" + this.addLeadingZero(e % 60) + ":" + this.addLeadingZero(h % 60)
    },
    getCurrentTime: function (d) {
        return new Date(d).getTime();
    },
    getFormattedDate: function (f, g) {
        var h = g ? g : this.dateFormat;
        var i = new Array();
        f = typeof (f) === "object" ? f : (f ? new Date(f) : new Date(this.getCurrentTime()));
        i.DD = top.globalGetLabel("DAY_NAME")[f.getDay()];
        i.EEE = top.globalGetLabel("SHORT_DAY_NAME")[f.getDay()];
        i.dd = this.addLeadingZero(f.getDate());
        i.mm = this.addLeadingZero(f.getMonth());
        i.MM = top.globalGetLabel("MONTH_NAME")[f.getMonth()];
        i.M = top.globalGetLabel("SHORT_MONTH_NAME")[f.getMonth()];
        i.NNN = top.globalGetLabel("SHORT_MONTH_NAME")[f.getMonth()];
        i.yyyy = f.getFullYear();
        for (var j in i) {
            h = h.replace(j, i[j])
        }
        return h
    },
    getFormattedTime: function (h, j) {
        h = h ? new Date(h) : new Date(this.getCurrentTime());
        var g = "";
        var i = h.getMinutes();
        var f = h.getHours();
        j = (j == true ? true : this.ampm);
        if (j) {
            if (f >= 12) {
                if (f > 12) {
                    f -= 12
                }
                g = "pm"
            } else {
                if (f == 0) {
                    f = 12
                }
                g = "am"
            }
        }
        return this.addLeadingZero(f) + ":" + this.addLeadingZero(i) + g
    },
    addDays: function (c, b) {
        var a = new Date();
        a.setDate(a.getDate() + c);
        return this.getFormattedDate(a, b)
    }
};