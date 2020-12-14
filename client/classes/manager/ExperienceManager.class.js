var ExperienceManager = {
    expArray: [],
    currentExpMenu: [],
    restuarantMenuType: [],
    isNewData: false,
    init: function (b) {
    },
    loadFlag: function (b) {
        //var c = top.LOCALINFO_URL + top.DEFAULT_LANGUAGE + "/format/json";
        var c = top.EXPINFO_URL;
        
        top.kwUtils.kwXMLHttpRequest("GET", c, true, this, this.getInitExp)
    },
    getInitExp: function (a) {
        try {
            a = (typeof a === "object") ? a : eval(a);
            this.isNewData = true;
            this.expArray = a
        } catch (e) {
            top.kwConsole.print("EXPINFO_LOAD_ERROR");
        }
    },
    setCurrentExpMenu: function (b) {
        this.currentExpMenu = null;
        this.currentExpMenu = b;
        return true
    },
    getCurrentExpMenu: function () {
        return this.currentExpMenu
    }
};