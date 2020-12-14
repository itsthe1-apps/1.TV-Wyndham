var MessageManager = {
    isNewData: false,
    messageArray: [],
    message: "",
    msgIsInfobarHidden: true,
    init: function () {
        if (top.FAKE_DATA == 0) {
            this.loadMessages();
        }
    },
    loadMessages: function () {
        var b = top.MESSAGES_URL + "user_id/" + top.USER_ID + "/format/json";
        top.kwUtils.kwXMLHttpRequest("GET", b, true, this, this.getMessages);
    },
    getMessage: function () {
        try {
            this.isNewData = true;
            this.messageShow(1);
            this.loadMessages()
        } catch (a) {
            top.kwConsole.print("MESSAGE_LOAD_ERROR");
        }
    },
    getMessages: function (a) {
        try {
            if (a && a.length > 0) {
                a = (typeof a === "object") ? a : eval(a);
                this.messageArray = a;
                top.kwConsole.print("MESSAGE_LOADED");
            }
        } catch (e) {
            top.kwConsole.print("MESSAGE_LOAD_ERROR");
        }
    },
    getMessageString: function () {
        return this.message
    },
    getMessageList: function () {
        return this.messageArray
    },
    setMessageRead: function (b) {
        var f = top.Player.getMacAddress();
        var e = top.MESSAGE_READURL + "mac_address/" + f + "/id/" + b;
        top.kwUtils.kwXMLHttpRequest("POST", e, true);
    },
    messageShow: function (b) {
        try {
            if (b) {
                if (top.getFrameDocument().getElementById("messageBlock")) {
                    top.getFrameDocument().getElementById("messageBlock").style.visibility = "visible";
                    this.msgIsInfobarHidden = false;
                }
            } else {
                if (top.getFrameDocument().getElementById("messageBlock")) {
                    top.getFrameDocument().getElementById("messageBlock").style.visibility = "hidden";
                    this.msgIsInfobarHidden = true;
                }
            }
        } catch (c) {
            top.kwConsole.print("MessageManager::messageShow" + c.message);
        }
    }
};