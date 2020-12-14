var langMainList = null;

function langEventHandler(a) {
    var b = true;
    switch (a.code) {
        case "INIT_SCREEN":
            top.changeBackgroundImg('HOME');
            var e = langInitScreen();
            if (e) {
                //to skip the lang selection 
                var c = {code: "KEY_SELECT"};
                langMainEventHandler(c);
            }
            break;
        case "UNINIT_SCREEN":
            langUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.MENU_LANG:
                    b = langMainEventHandler(a);
                    break;
                default:
                    b = false;
                    break
            }
            break
    }
    return b
}

function langMainEventHandler(b) {
    var e = true;
    switch (b.code) {
        case "KEY_LEFT":
            langMainList.scrollUp();
            break;
        case "KEY_RIGHT":
            langMainList.scrollDown();
            break;
        case "KEY_SELECT":
            top.kwConsole.print("TARGETT LANGUAGE:TARGETT LANGUAGE:TARGETT LANGUAGE:------" + langMainList.getItem().language);
            var target = 0;
            if (top.DEFAULT_LANGUAGE == "ar") {
                target = 1;
            }
            if (langMainList.getItem().target) {
                try {
                    top.kwConsole.print("top.DEFAULT_LANGUAGE :: " + top.DEFAULT_LANGUAGE);
                    var i = "../language/labels." + top.DEFAULT_LANGUAGE + ".js";
                    removejscssfile(i, "js");
                    //var g = "css_" + top.COMMON_CSS_EXTENSION + ".css";
                    //removejscssfile(g, "css");
                    //top.DEFAULT_LANGUAGE = langMainList.getItem(target).language;
                    top.DEFAULT_DIRECTION = langMainList.getItem(target).direction;
                    g = "css_" + top.globalGetScreenWidthByResolution() + "x" + top.globalGetScreenHeightByResolution() + "_" + top.DEVICE_TYPE + "_" + top.THEME + "_" + top.DEFAULT_LANGUAGE + ".css";
                    top.kwConsole.print("Style Sheet Name:" + g);
                    top.kwStatusConsole.print("Skin Parameters,THEME:<b>" + top.THEME + "</b>,LANGUAGE:<b>" + top.DEFAULT_LANGUAGE + "</b>", 0);
                    loadjscssfile(g, "css");
                    l = "language/labels." + top.DEFAULT_LANGUAGE + ".js";
                    var a = document.createElement("script");
                    a.setAttribute("src", l);
                    a.setAttribute("type", "text/javascript");
                    var f = parent.document.getElementsByTagName("script")[0];
                    f.parentNode.insertBefore(a, f);
                    f.onload = callbackFuncJSScript();
                } catch (h) {
                    top.kwConsole.print(h.message);
                }
            }
            break;
        default:
            e = false;
            break
    }
    return e
}

function callbackFuncJSScript() {
    if (eval("typeof top.languageLoaded== 'function'")) {
        l = "classes/common/PreloadManager.class.js";
        ga = document.createElement("script");
        ga.setAttribute("src", l);
        ga.setAttribute("type", "text/javascript");
        s = parent.document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(ga, s);
        s.onload = callbackFuncImagePreloadScript()
    } else {
        setTimeout("callbackFuncJSScript()", 1000)
    }
}

function callbackFuncImagePreloadScript() {
    if (eval("typeof top.imagesLoaded== 'function'")) {
        top.PreloadManager.addImages();
        l = "global/" + top.globalGetScreenHeightByResolution() + ".js";
        ga = document.createElement("script");
        ga.setAttribute("src", l);
        ga.setAttribute("type", "text/javascript");
        s = parent.document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(ga, s);
        s.onload = callbackFuncConfig()
    } else {
        setTimeout("callbackFuncImagePreloadScript()", 1000)
    }
}

function callbackFuncConfig() {
    top.kwConsole.print("lang:controller:callbackFuncConfig in");
    if (eval("typeof top.settingLoaded=='function'") && (top.ChannelManager.isNewData == true || top.TV == 0) && (top.NewsnpromoManager.isNewData == true || top.NEWSNPROMO == 0) && (top.LocalInfoManager.isNewData == true || top.INFORMATION == 0) && top.MediaManager.isNewData == true && top.NewsManager.isNewData == true && (top.RestuarantsManager.isNewData == true || top.RESTAURANT == 0)) {
        top.kwStatusConsole.clear();
        top.kwStatusConsole.hide();
        top.ScreenManager.load(langMainList.getItem().target, langMainList.getItem().args);
        return
    } else {
        top.kwStatusConsole.print("Please wait for few seconds....", 0);
        setTimeout("callbackFuncConfig()", 6000)
    }
}

function langActionHandler(b, a) {
    switch (b) {
    }
}

function langInitScreen() {
    var e = true;
    retrivePromoDetails();
    top.State.setState(top.State.MENU_LANG);
    top.ScreenManager.displayScreen(langGetScreenHtml());
    langInitMainList();
    return e;
}

function langUninitScreen() {
    setToBinLang()
}

function langGetMenuListData() {
    var a = [];
    a.push({
        "class": "langEnglishIcon",
        target: "MENU",
        language: "en",
        direction: "ltr"
    });
    a.push({
        "class": "langArabicIcon",
        language: "en",
        target: "MENU",
        direction: "ltr"
    });
    return a
}

function langInitMainList() {
    langMainList = new top.List(top.ListType.SCROLL, langGetMenuListData(), 0, 0, 0, 2, document.getElementById("langMainListContainer"));
    langMainList.displayItem = langMainListDisplayItem;
    langMainList.initList()
}

function removejscssfile(d, f) {
    try {
        var a = (f == "js") ? "script" : (f == "css") ? "link" : "none";
        var g = (f == "js") ? "src" : (f == "css") ? "href" : "none";
        var c = document.getElementsByTagName(a);
        for (var e = c.length; e >= 0; e--) {
            if (c[e] && c[e].getAttribute(g) != null && c[e].getAttribute(g).indexOf(d) != -1) {
                c[e].parentNode.removeChild(c[e])
            }
        }
    } catch (b) {
        top.kwConsole.print(b.message)
    }
}

function loadjscssfile(c, d) {
    try {
        if (d == "js") {
            var b = document.createElement("script");
            b.setAttribute("type", "text/javascript");
            b.setAttribute("src", c)
        } else {
            if (d == "css") {
                var b = document.createElement("link");
                b.setAttribute("rel", "stylesheet");
                b.setAttribute("type", "text/css");
                b.setAttribute("href", c)
            }
        }
        if (typeof b != "undefined") {
            document.getElementsByTagName("head")[0].appendChild(b)
        }
    } catch (a) {
        top.kwConsole.print(a.message)
    }
}

function loadJS(b) {
    var d = document.createElement("script");
    d.type = "text/javascript";
    d.async = true;
    d.src = b;
    d.onload = function () {
        top.languageLoaded()
    };
    var c = document.getElementsByTagName("script")[0];
    c.parentNode.insertBefore(d, c)
}

function retrivePromoDetails() {
    var json_url = top.TICKER_MEDIA_URL + "en/format/json";
    top.kwUtils.kwXMLHttpRequest("GET", json_url, true, this, getPromoJson);
}

function getPromoJson(jsonString) {

    var json = JSON.parse(jsonString);

}


function setToBinLang() {}
;