var pluginKeymap = {
    38: "KEY_UP",
    40: "KEY_DOWN",
    39: "KEY_RIGHT",
    37: "KEY_LEFT",
    8492: "KEY_CHANNEL_UP",
    8494: "KEY_CHANNEL_DOWN",
    8568: "KEY_BACK",
    8516: "KEY_MENU",
    13: "KEY_SELECT",
    8512: "KEY_RED",
    8513: "KEY_GREEN",
    8514: "KEY_YELLOW",
    8515: "KEY_BLUE",
    8497: "KEY_MUTE",
    8495: "KEY_VOLUME_UP",
    8496: "KEY_VOLUME_DOWN",
    8498: "POWER_BUTTON",
    8501: "KEY_STOP",
    8502: "KEY_REWIND",
    8500: "KEY_FFORWARD",
    8499: "KEY_PLAY",
    8504: "KEY_PAUSE"
};

function pluginKeyHandler(g) {
    try {
        var e = null;
        var f = g.which || g.keyCode;
        top.kwConsole.print("KeyBoard Listener" + f);
        if (f < 58 && f >= 48) {
            e = "KEY_NUMERIC";
            f = f - 48
        } else {
            e = pluginKeymap[f]
        }
        top.kwConsole.print("KeyBoard Map" + e)
    } catch (d) {}
    top.globalFireEvent(new Event(e, {
        value: f
    }));
    return false
}

function pluginInitRcPlugin() {
    document.onkeydown = pluginKeyHandler
}
pluginInitRcPlugin();