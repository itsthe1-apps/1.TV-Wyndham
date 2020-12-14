var pluginKeymap = {
    38: "KEY_UP",
    40: "KEY_DOWN",
    39: "KEY_RIGHT",
    37: "KEY_LEFT",
    427: "KEY_CHANNEL_UP",
    428: "KEY_CHANNEL_DOWN",
    8: "KEY_BACK",
    109: "KEY_MENU",
    77: "KEY_MENU",
    13: "KEY_SELECT",
    82: "KEY_RED",
    71: "KEY_GREEN",
    89: "KEY_YELLOW",
    107: "KEY_GUIDE",
    69: "KEY_EXIT",
    85: "KEY_MUTE",
    61: "KEY_VOLUME_UP",
    173: "KEY_VOLUME_DOWN",
    115: "KEY_STOP",
    114: "KEY_REWIND",
    102: "KEY_FFORWARD",
    112: "KEY_PLAY",
    122: "KEY_PAUSE"
};

function pluginKeyHandler(b) {
    var a = null;
    var c = b.which || b.keyCode;
    if (c < 58 && c >= 48) {
        a = (top.ScreenManager.getCurrentScreen().name == "ROOM_KEEPER" || top.ScreenManager.getCurrentScreen().name == "SERVICE") ? "KEY_CODE" : "KEY_NUMERIC";
        c = c - 48
    } else {
        a = pluginKeymap[c]
    }
    top.kwConsole.print("KeyBoard Listener" + c + "," + a);
    if (top.SCREEN_MODE == 1) {
        switch (a) {
            case "KEY_UP":
                a = "KEY_CHANNEL_UP";
                break;
            case "KEY_DOWN":
                a = "KEY_CHANNEL_DOWN";
                break;
            case "KEY_RIGHT":
                a = "KEY_VOLUME_UP";
                break;
            case "KEY_LEFT":
                a = "KEY_VOLUME_DOWN";
                break
        }
    } else {
        if (top.VOD_SCREEN_MODE == 1) {
            switch (a) {
                case "KEY_UP":
                case "KEY_RIGHT":
                    a = "KEY_VOLUME_UP";
                    break;
                case "KEY_DOWN":
                case "KEY_LEFT":
                    a = "KEY_VOLUME_UP";
                    break
            }
        }
    }
    top.kwConsole.print("KeyBoard LMapped KeyCode: " + a);
    top.globalFireEvent(new Event(a, {
        value: c
    }));
    return false
}

function pluginInitRcPlugin() {
    document.onkeydown = pluginKeyHandler
};