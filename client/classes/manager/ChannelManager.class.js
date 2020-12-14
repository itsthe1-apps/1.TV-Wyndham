var ChannelManager = {
    isNewData: false,
    dateFormat: "yyyy-MM-dd HH:mm:ss",
    lastUpdated: "1999-01-01 00:00:00",
    channelArray: [],
    data: [],
    channelLoaded: false,
    currentChannel: null,
    channelList: null,
    channelFullList: null,
    favouriteList: "",
    categoriesData: [],
    init: function () {
        this.channelList = new top.List(top.ListType.SCROLL_CYCLIC, null);
        this.channelList.display = function () {};
    },
    loadFlag: function (b) {
        top.kwUtils.kwXMLHttpRequest("GET", top.CHANNELCAT_URL, true, this, this.loadCategories);
    },
    loadCategories: function (a) {
        try {
            a = (typeof a === "object") ? a : eval(a);
            this.isNewData = true;
            var r = [];
            for (var d = 0; d < a.length; d++) {
                var c = new top.ChannelCategory(a[d].id, a[d].name, a[d].name);
                r.push(c);
            }
            this.categoriesData = a;
            if (this.categoriesData.length) {
                this.loadCategoryData(null);
            }
        } catch (e) {
            top.kwConsole.print("CHANNEL_CATEGORIES_LOAD_ERROR");
        }
    },
    loadCategoryData: function (b) {
        b = b ? b : 0;
        var a = top.CHANNELS_URL + top.USER_ID + "/gid/" + b + "/format/json";
        if (b == 0) {
            top.kwUtils.kwXMLHttpRequest("GET", a, true, this, top.ChannelManager.getCategoryFullData);
        } else {
            top.kwUtils.kwXMLHttpRequest("GET", a, true, this, top.ChannelManager.getCategoryData);
        }
    },
    getCategoryFullData: function (a) {
        try {
            a = (typeof a === "object") ? a : eval(a);
            this.isNewData = true;
            var r = [];
            for (var d = 0; d < a.length; d++) {
                var c = new top.Channel(a[d].id, a[d].number, a[d].name, a[d].description, a[d].mrl, a[d].logo, a[d].epgXML, a[d].eitXML);
                r.push(c);
            }
            this.setData(r);
            this.channelFullList = r;
        } catch (e) {
            top.kwConsole.print("CHANNELS_LOAD_ERROR");
        }
    },
    getCategoryData: function (a) {
        try {
            a = (typeof a === "object") ? a : eval(a);
            this.isNewData = true;
            var r = [];
            for (var d = 0; d < a.length; d++) {
                var c = new top.Channel(a[d].id, a[d].number, a[d].name, a[d].description, a[d].mrl, a[d].logo, a[d].epgXML, a[d].eitXML);
                r.push(c);
            }
            this.setData(r);
        } catch (e) {
            top.kwConsole.print("CHANNELS_LOAD_ERROR");
        }
    },
    getCategoriesData: function () {
        return this.categoriesData;
    },
    setData: function (b) {
        top.ChannelManager.channelList.setData(b);
        return true;
    },
    loadFavouriteChannel: function () {
        url = top.CHANNELS_GETFAVURL + top.USER_ID + "/format/json";
        top.kwUtils.kwXMLHttpRequest("GET", url, true, this, this.getFavouriteChannel);
    },
    getFavouriteChannel: function (b) {
        try {
            b = (typeof b === "object") ? b : eval(b);
            var r = [];
            for (var d = 0; d < b.length; d++) {
                var c = new top.Channel(b[d].id, b[d].number, b[d].name, b[d].description, b[d].mrl, b[d].logo);
                r.push(c);
            }
            this.clearChannelList();
            this.channelLoaded = true;
            this.setData(r);
            top.ScreenManager.load("CH_FAVLIST", {
                type: "favourite"
            });
        } catch (e) {
            this.setData(top.ChannelManager.channelFullList);
            top.ScreenManager.load("CH_LIST");
        }
    },
    loadAllChannel: function () {
        var a = top.CHANNELS_URL + top.USER_ID + "/gid/" + 0 + "/format/json";
        top.kwUtils.kwXMLHttpRequest("GET", a, true, this, this.getAllChannel);
    },
    getAllChannel: function (b) {
        try {
            b = (typeof b === "object") ? b : eval(b);
            var r = [];
            for (var d = 0; d < b.length; d++) {
                var c = new top.Channel(b[d].id, b[d].number, b[d].name, b[d].description, b[d].mrl, b[d].logo);
                r.push(c);
            }
            this.clearChannelList();
            this.channelLoaded = true;
            this.setData(r);
            top.ScreenManager.load("CH_LIST", {
                type: "all"
            });
        } catch (e) {
            //
        }
    },
    setFavouriteChannel: function (a) {
        top.kwUtils.kwXMLHttpRequest("POST", a, true);
    },
    removeFavouriteChannel: function (a) {
        top.kwUtils.kwXMLHttpRequest("POST", a, true);
    },
    chChooserLoadChannels: function (b) {
        b = b ? b : 0;
        var a = top.CHANNELS_URL + top.USER_ID + "/gid/" + b + "/format/json";
        top.kwUtils.kwXMLHttpRequest("GET", a, true, this, this.chChoosergetChannels);
    },
    chChoosergetChannels: function (a) {
        try {
            a = (typeof a === "object") ? a : eval(a);
            this.channelLoaded = true;
            var r = [];
            for (var d = 0; d < a.length; d++) {
                var c = new top.Channel(a[d].id, a[d].number, a[d].name, a[d].description, a[d].mrl, a[d].logo);
                r.push(c);
            }
            this.channelArray = r;
            this.setData(this.channelArray);
            top.ScreenManager.load("CH_LIST", {
                type: "genre",
                genreId: top.DEFAULT_CHANNEL_CATEGORY
            });
        } catch (e) {
            top.kwConsole.print("CHANNELS_LOAD_ERROR");
        }
    },
    getChannels: function (a) {
        try {
            this.channelLoaded = true;
            a = (a == "" ? "[]" : a);
            this.channelArray = a;
            this.setData(this.channelArray);
        } catch (c) {
            top.kwConsole.print("CHANNELS_LOAD_ERROR");
        }
    },
    getChannelList: function () {
        return this.channelList.getData();
    },
    getAllChannelList: function () {
        return this.allchannelList.getData();
    },
    clearChannelList: function () {
        this.channelLoaded = false;
        this.channelArray = [];
        this.channelList = null;
        this.channelList = new top.List(top.ListType.SCROLL_CYCLIC, null);
        this.channelList.display = function () {};
    },
    addChannel: function (a) {
        this.channelArray.push(a);
    },
    getChannelIndex: function (b) {
        if (b) {
            for (var a = 0; a < this.channelList.getLength(); a++) {
                if (this.channelList.getItem(a).id == b.id) {
                    return a;
                }
            }
        }
        return null;
    },
    getChannelById: function (b) {
        if (b) {
            for (var a = 0; a < this.channelList.getLength(); a++) {
                if (this.channelList.getItem(a).id == b) {
                    return this.channelList.getItem(a);
                }
            }
        }
        return null;
    },
    getCurrentChannel: function () {
        if (this.currentChannel == null) {
            this.currentChannel = this.channelList.getItem();
        }
        return this.currentChannel;
    },
    setCurrentChannel: function (a) {
        this.currentChannel = a;
        if (this.channelList.getItem().channelNumber != a) {
            if (!isNaN(this.getChannelIndex(a))) {
                this.channelList.setIndex(this.getChannelIndex(a));
            }
        }
    },
    getChannelByIndex: function (a) {
        return ((isNaN(a) || a == null) ? null : this.channelList.getItem(a));
    },
    getChannelIndexByProperty: function (c, b) {
        var e = 0,
                d = false;
        var a = this.channelList;
        var f = a.getLength();
        while (e < f && !d) {
            a.getItem(e)[c] == b ? d = true : e++;
        }
        return d ? e : null;
    },
    getChannelByNumber: function (a) {
        return this.getChannelByIndex(this.getChannelIndexByProperty("channelNumber", a));
    },
    loadEitByChannel: function (b) {
        if (b && b.eitXML) {
            var a = (top.Player.isSTB ? b.eitXML : top.COMMON_URL_PREFIX + "data/vendors/mbc/" + b.eitXML);
            top.kwUtils.kwXMLHttpRequest("GET", a, true, this, this.loadEitByChannelCallback, {
                responseXML: true,
                id: b.id
            });
        } else {
            top.globalFireEvent(new top.Event("EIT_LOADED", {
                channelId: b.id,
                programs: []
            }));
        }
    },
    loadEitByChannelCallback: function (h, b) {
        var o = this.getChannelById(b.id);
        var m = [],
                e, c, a, d;
        var f, g, n;
        if (o && h && !h.error) {
            e = h != null ? top.kwUtils.kwXpathGetNodes("//programme", h) : [];
            for (var l = 0; l < Math.min(e.length, 2); l++) {
                d = e[l];
                g = this.convertXMLDate(d.getAttribute("start"));
                n = this.convertXMLDate(d.getAttribute("stop"));
                for (var k = 0; k < d.childNodes.length; k++) {
                    c = d.childNodes[k];
                    a = top.kwUtils.kwXpathGetNodeContent(c);
                    switch (c.nodeName) {
                        case "title":
                            f = a;
                            break;
                    }
                }
                m.push({
                    name: f,
                    startTime: g,
                    endTime: n
                });
            }
        }
        top.globalFireEvent(new top.Event("EIT_LOADED", {
            channelId: b.id,
            programs: m
        }));
    },
    loadEPG: function () {
        var b = new Date();
        b.setHours(23, 59, 59);
        top.kwTimer.cancelTimer("LOAD_EPG");
        top.kwTimer.setTimer("LOAD_EPG", {
            scope: this,
            callback: this.loadEPG
        }, b.getTime());
        for (var a = 0; a < this.channelList.getLength(); a++) {
            this.loadEpgByChannel(this.channelList.getItem(a))
        }
    },
    loadEpgByChannel: function (b) {
        if (b && b.tag) {
            var a = (top.Player.isSTB ? b.epgXML : top.COMMON_URL_PREFIX + "data/vendors/mbc/xml/" + b.tag + ".xml");
            top.kwUtils.kwXMLHttpRequest("GET", a, true, this, this.loadEpgByChannelCallback, {
                responseXML: true,
                id: b.id
            });
        } else {
            this.attachProgramlist(b.id);
        }
    },
    loadEpgByChannelCallback: function (g, a) {
        var o = this.getChannelById(a.id);
        var l = [],
                f, b, p, e;
        var c, n, d, m;
        if (o && g && !g.error) {
            f = g != null ? top.kwUtils.kwXpathGetNodes("//programme", g) : [];
            for (var k = 0; k < f.length; k++) {
                e = f[k];
                d = this.convertXMLDate(e.getAttribute("start"));
                m = this.convertXMLDate(e.getAttribute("stop"));
                for (var h = 0; h < e.childNodes.length; h++) {
                    b = e.childNodes[h];
                    p = top.kwUtils.kwXpathGetNodeContent(b);
                    switch (b.nodeName) {
                        case "title":
                            c = p;
                            break;
                        case "desc":
                            n = p;
                            break
                    }
                }
                l.push({
                    name: c,
                    description: n,
                    startTime: d,
                    endTime: m
                });
            }
        }
        this.attachProgramlist(a.id, l);
    },
    attachProgramlist: function (a, b) {
        var c = this.getChannelById(a);
        if (c) {
            c.programs = b || [];
        }
    },
    fixEpgProgramListByChannel: function (b) {
        var a = top.Clock.getCurrentTime();
        if (b && b.id) {
            var c = this.getChannelById(b.id);
            for (var d = 0; d < c.programs.length; d++) {
                if (c.programs[d].endTime < a) {
                    c.programs.splice(d, 1);
                    d--;
                }
            }
            return c.programs;
        }
        return null;
    },
    convertXMLDate: function (a) {
        var b = new Date();
        b.setFullYear(a.substr(0, 4), a.substr(4, 2) - 1, a.substr(6, 2));
        b.setHours(a.substr(8, 2), a.substr(10, 2), a.substr(12, 2));
        return b.getTime();
    },
    channelUp: function (a) {
        this.channelList.scrollDown();
        if (a == true) {
            this.setCurrentChannel(this.channelList.getItem());
        }
    },
    channelDown: function (a) {
        this.channelList.scrollUp();
        if (a == true) {
            this.setCurrentChannel(this.channelList.getItem());
        }
    }
};