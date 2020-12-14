var ServiceListManager = {
    serviceListArray: [],
    currentServiceListMenu: [],
    restuarantMenuType: [],
    isNewData: false,
    init: function (b) {
    },
    loadFlag: function (b) {
        var c = top.SERVICELIST_URL;
        top.kwUtils.kwXMLHttpRequest("GET", c, true, this, this.getInitServiceList)
    },
    getInitServiceList: function (a) {
        a = top.jsonParser(a);
        try {
            a = (typeof a === "object") ? a : eval(a);
            this.isNewData = true;
            this.serviceListArray = a;
        } catch (e) {
            top.kwConsole.print("SERVICE_LIST_LOAD_ERROR");
        }
    },
    setCurrentServiceListMenu: function (b) {
        this.currentServiceListMenu = null;
        this.currentServiceListMenu = b;
        return true
    },
    getCurrentServiceListMenu: function () {
        return this.currentServiceListMenu
    }
};