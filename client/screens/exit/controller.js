var exitMainList = null;
function exitEventHandler(a) {
    var b = true;
    switch (a.code) {
        case"INIT_SCREEN":
            exitInitScreen();
            top.changeBackgroundImg('HOME');
            break;
        case"UNINIT_SCREEN":
            exitUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.ROOM_EXIT:
                    b = exitMainEventHandler(a);
                    break;
                default:
                    b = false;
                    break
            }
            break
    }
    return b
}
function exitMainEventHandler(a) {
    var b = true;
    switch (a.code) {
        case"KEY_SELECT":
            break;
        default:
            b = false;
            break
    }
    return b
}
function exitActionHandler(b, a) {
    switch (b) {
        }
}
function exitInitScreen() {
    top.State.setState(top.State.ROOM_EXIT);
    top.ScreenManager.displayScreen(exitGetScreenHtml());
    top.Player.play(top.ServiceManager.exitData.rtsp);
    top.Player.setMaxVolume()
}
function exitUninitScreen() {
    top.Player.stop();
    setToBinExit()
}
function setToBinExit() {
}
;