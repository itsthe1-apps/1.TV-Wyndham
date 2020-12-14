var LocalInfoManager = {
    restuarantsArray: [],
    currentRestuarantMenu: [],
    restuarantMenuType: [],
    isNewData: false,
    init: function(b) {},
    loadFlag: function(b) {
        var c = top.LOCALINFO_URL + top.DEFAULT_LANGUAGE + "/format/json";
        top.kwUtils.kwXMLHttpRequest("GET", c, true, this, this.getInitRestuarants)
    },
    getInitRestuarants: function(a) {
        try {
            a = (typeof a === "object") ? a : eval(a);
            this.isNewData = true;
            this.restuarantsArray = a
        } catch (e) {
            top.kwConsole.print("LOCALINFO_LOAD_ERROR")
        }
    },
    setCurrentRestuarantMenu: function(b) {
        this.currentRestuarantMenu = null;
        this.currentRestuarantMenu = b;
        return true
    },
    getCurrentRestuarantMenu: function() {
        return this.currentRestuarantMenu
    }
};