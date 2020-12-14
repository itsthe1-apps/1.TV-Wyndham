var ServiceManager = {
    exitData: null,
    exitPageLoaded: 0,
    init: function() {},
    setServiceRequest: function(b, e, h, f) {
        var c = top.USER_ID;
        e = e.replace(":", "_");
        var h = top.SERVICE_REQURL + "type/" + b + "/user/" + c + "/time/" + e + "/date/" + h + "/guest/" + f;
        top.kwUtils.kwXMLHttpRequest("POST", h, true)
    },
    setAlarmServiceRequest: function(b, e, i, h, j, f) {
        var c = top.USER_ID;
        e = e.replace(":", "_");
        var i = top.SERVICEALARM_REQURL + "type/" + b + "/user/" + c + "/time/" + e + "/date/" + i + "/alarm_type/" + h + "/udp_number/" + j + "/ring_type/" + f;
        top.kwUtils.kwXMLHttpRequest("POST", i, true)
    },
    setAlarmServiceClosed: function() {
        var a = top.USER_ID;
        var b = top.SERVICEALARMCLOSED_REQURL + "user/" + a;
        top.kwUtils.kwXMLHttpRequest("POST", b, true)
    },
    loadExitData: function(b) {
        if (b == 1 && this.exitPageLoaded == 0) {
            var a = top.EMERGENCY_EXIT + "room/" + top.ROOM_NUMBER + "/format/json";
            top.kwUtils.kwXMLHttpRequest("GET", a, true, this, this.getExitScreen)
        } else {
            if (b == 0 && this.exitPageLoaded == 1) {
                this.exitPageLoaded = 0;
                top.ScreenManager.load("MENU")
            }
        }
    },
    getExitScreen: function(b) {
        try {
            b = (typeof b === "object") ? b : JSON.parse(b);
            this.exitData = new top.Exit(b.message, b.rtsp, b.image, b.status, b.image_path);
            if (b.status == 1) {
                this.exitPageLoaded = 1;
                top.ScreenManager.load("ROOM_EXIT")
            }
        } catch (c) {
            top.kwConsole.print("EXIT_LOAD_ERROR")
        }
    }
};