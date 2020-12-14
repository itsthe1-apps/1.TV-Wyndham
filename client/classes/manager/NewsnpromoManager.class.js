var NewsnpromoManager = {
    newsnpromosArray: [],
    currentNewsnpromoMenu: [],
    newsnpromoMenuType: [],
    isNewData: false,
    init: function(b) {},
    loadFlag: function(b) {
        var c = top.NEWSNPROMO_URL + top.DEFAULT_LANGUAGE + "/format/json";
        top.kwUtils.kwXMLHttpRequest("GET", c, true, this, this.getInitNewsnpromos);
    },
    getInitNewsnpromos: function(a) {
        try {
            a = (typeof a === "object") ? a : eval(a);
            this.isNewData = true;
            this.newsnpromosArray = a;
        } catch (e) {
            top.kwConsole.print("NEWSNPROMO_LOAD_ERROR");
        }
    },
    setCurrentNewsnpromoMenu: function(b) {
        this.currentNewsnpromoMenu = null;
        this.currentNewsnpromoMenu = b;
        return true;
    },
    getCurrentNewsnpromoMenu: function() {
        return this.currentNewsnpromoMenu;
    }
};