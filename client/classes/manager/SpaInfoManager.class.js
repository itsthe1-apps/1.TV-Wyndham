var SpaInfoManager = {
    spaArray: [],
    currentSpaMenu: [],
    restuarantMenuType: [],
    isNewData: false,
    init: function (b) {
    },
    loadFlag: function (b) {
        //var c = top.LOCALINFO_URL + top.DEFAULT_LANGUAGE + "/format/json";
        var c = top.SPAINFO_URL;
        top.kwUtils.kwXMLHttpRequest("GET", c, true, this, this.getInitSpa)
    },
    getInitSpa: function (b) {
        try {
            b = (typeof b === "object") ? b : eval(b);
            this.isNewData = true;
            this.spaArray = b;

        } catch (e) {
            top.kwConsole.print("SPA_INFO_LOAD_ERROR");
        }
    },
    setCurrentSpaMenu: function (b) {
        this.currentSpaMenu = null;
        this.currentSpaMenu = b;
        return true
    },
    getCurrentSpaMenu: function () {
        return this.currentSpaMenu
    }
};