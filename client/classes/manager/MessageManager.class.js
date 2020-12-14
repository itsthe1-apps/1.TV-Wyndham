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
    displayMessage: function () {
        this.messageShow(1);
    },
    getMessages: function (a) {
        try {
            if (a && a.length > 0) {
                a = (typeof a === "object") ? a : eval(a);
                this.messageArray = a;
                this.displayMessage();
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
            if (b == 1 && this.msgIsInfobarHidden == true) {
                if (top.getFrameDocument().getElementById("messageBlock")) {
                    top.CURRENT_MESSAGE_ID = this.messageArray[0].id;
                    var messageSpan = "";
                    messageSpan += '<div id="messageContent" class="messageContent">';
                    // messageSpan += '<span id="messageTitle">You have recieved a new Message</span>';
                    messageSpan += '<p id="messageBody">'+this.messageArray[0].message+'</p>';
                    // messageSpan += '<span id="messageExit">Press F4 Key to Exit</span>';
                    messageSpan += '</div>';
                    top.getFrameDocument().getElementById("messageBlock").innerHTML = messageSpan;
                    top.getFrameDocument().getElementById("messageBlock").style.visibility = "visible";
                    this.msgIsInfobarHidden = false;
                }
            } else if (b == 0 && this.msgIsInfobarHidden == false){
                //alert(b+"---"+this.msgIsInfobarHidden);
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