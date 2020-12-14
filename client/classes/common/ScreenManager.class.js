function Event(c, d) {
    this.code = c || "";
    this.args = d || {}
}
function Screen(f, e, d) {
    this.name = f;
    this.eventHandler = e;
    this.args = d || null
}
function globalFireEvent(f) {
    var e = false;
    var i = top.ScreenManager.getCurrentScreen();
    top.kwConsole.print("ScreenManager::globalFireEvent:currentScreen=" + i);
    if (i && i.eventHandler) {
        var h = window.frames.viewFrame[i.eventHandler];
        top.kwConsole.print("ScreenManager::globalFireEvent:EventHandler=" + i.eventHandler);
        if (typeof (h) === "function") {
            try {
                e = h(f);
            } catch (g) {
                top.kwConsole.print("ScreenManager::globalFireEvent:Exception=" + g.message);
            }
        }
    }
    if (!e) {
        e = globalEventHandler(f)
    }
    return e
}
function getFrameDocument() {
    var b = document.getElementById("viewFrame");
    var a = b.contentDocument || b.contentWindow.document;
    return a
}
var ScreenManager = {_currentScreen: null, screens: [], store: [], add: function (b) {
        this.screens.push(b);
    }, load: function (f, g) {
        var e = window.frames.viewFrame;
        var h = this.getScreenByName(f);
        if (e && h) {
            this.unload();
            this._currentScreen = h;
            top.globalFireEvent(new top.Event("INIT_SCREEN", g));
        }
    }, unload: function () {
        this.args = null;
        var b = window.frames.viewFrame;
        if (b) {
            top.globalFireEvent(new top.Event("UNINIT_SCREEN"));
        }
    }, displayScreen: function (d) {
        var c = window.frames.viewFrame;
        if (c) {
            c.document.body.innerHTML = d;
        }
    }, clearDisplayScreen: function () {
        var c = window.frames.viewFrame;
        if (c) {
            c.document.body.innerHTML = "";
        }
    }, getCurrentScreen: function () {
        return this._currentScreen
    }, getScreenByName: function (d) {
        for (var c = 0; c < this.screens.length; c++) {
            if (this.screens[c].name == d) {
                return this.screens[c]
            }
        }
    }, getCurrentScreenWindow: function () {
        var b = window.frames.viewFrame;
        if (b) {
            return b
        } else {
            return null
        }
    }, storeScreen: function (c, d) {
        this.store.push({name: c, args: d})
    }, deleteHistory: function () {
        this.store = []
    }, loadLastScreen: function () {
        var b = this.store.splice(0, 1);
        if (b && b[0]) {
            this.load(b[0].name, b[0].args)
        }
    }};