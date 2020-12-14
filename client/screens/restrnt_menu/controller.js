function restrntMenuEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            //top.changeBackgroundImg('RESTAURANT');
            top.BG_IMG = 'url(' + top.IMAGES_PREFIX + 'BGS/' + top.BACKGROUND_ARRAY['RESTAURANT'] + ')';
            restrntMenuListInitScreen(d.args);
            break;
        case "UNINIT_SCREEN":
            restrntMenuListUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.RESTRNT_MENU_MAIN:
                    c = restrntMenuListMainEventHandler(d);
                    break;
                default:
                    c = false;
                    break
            }
            break
    }
    return c
}

function restrntMenuListMainEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_BACK":
            top.ScreenManager.load("RESTRNT");
            break;
        default:
            c = false;
            break
    }
    return c
}

function restrntMenuListActionHandler(c, d) {
    switch (c) {}
}

function restrntMenuListInitScreen(b) {
    top.State.setState(top.State.RESTRNT_MENU_MAIN);
    top.ScreenManager.displayScreen(restrntMenuListGetScreenHtml());
    top.Clock.show(this, "globalClock");
    restrntMenuListDisplayRestInfo(top.RestuarantsManager.getCurrentRestuarant())
}

function restrntMenuListUninitScreen() {
    top.Clock.stop()
};