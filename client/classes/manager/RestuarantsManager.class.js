var RestuarantsManager = {
    restuarantsArray: [],
    currentRestuarantMenu: [],
    restuarantMenuType: [],
    isNewData: false,
    init: function(b) {},
    loadFlag: function(b) {
        top.kwUtils.kwXMLHttpRequest("GET", top.RESTURANT_MTYPES, true, this, this.getMenuTypes)
    },
    getMenuTypes: function(a) {
        try {
            a = (typeof a === "object") ? a : eval(a);
            this.isNewData = true;
            var r = [];
            for (var d = 0; d < a.length; d++) {
                var c = new top.RestuarantMenuType(a[d].id, a[d].name, a[d].code);
                r.push(c)
            }
            this.setRestMtype(r)
        } catch (e) {
            top.kwConsole.print("RESTCAT_LOAD_ERROR")
        }
    },
    loadInitRestuarants: function() {
        var a = top.RESTURANT_URL + top.DEFAULT_LANGUAGE + "/format/json";
        top.kwUtils.kwXMLHttpRequest("GET", a, true, this, this.getInitRestuarants)
    },
    getInitRestuarants: function(a) {
        try {
           
            a = (typeof a === "object") ? a : eval(a);
            this.restuarantsArray = a
        } catch (e) {
            top.kwConsole.print("RESTUARANTS_LOAD_ERROR")
        }
    },
    setCurrentRestuarantMenu: function(b) {
        this.currentRestuarantMenu = null;
        this.currentRestuarantMenu = b;
        return true
    },
    getCurrentRestuarantMenu: function() {
        return this.currentRestuarantMenu
    },
    setRestMtype: function(b) {
        this.restuarantMenuType = b;
        this.loadInitRestuarants()
    },
    getRestMtype: function(b) {
        return this.restuarantMenuType
    },
    setOrderRequest: function(b, e, h, f) {
        var c = top.USER_ID;
        var h = top.ORDER_REQURL + "type/" + b + "/user/" + c + "/time/" + e + "/date/" + h + "/guest/" + f;
        top.kwUtils.kwXMLHttpRequest("POST", h, true)
    }
};