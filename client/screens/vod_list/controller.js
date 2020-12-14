var vodListSubMenuList = null;
var vodListMovieList = null;
var vodListInitType = null;
var vodListInitLetter = null;
var vodListInitGenreId = null;
var vodPlayerSubMenuList = null;

function vodListEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            top.changeBackgroundImg('VOD');
            initVODListVars();
            vodListInitScreen(d.args);
            break;
        case "UNINIT_SCREEN":
            vodListUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.VOD_LIST_MAIN:
                    c = vodListMainEventHandler(d);
                    break;
                case top.State.VOD_SUBMENU:
                    c = vodListSubMenuEventHandler(d);
                    break;
                case top.State.VOD_PLAYMENU:
                    c = vodListPlayMenuEventHandler(d);
                    break;
                default:
                    c = false;
                    break
            }
            break
    }
    return c
}

function vodListPlayMenuEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "ltr") ? vodPlayerSubMenuList.scrollUp(): vodListSubMenuList.scrollDown();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "ltr") ? vodPlayerSubMenuList.scrollDown(): vodPlayerSubMenuList.scrollUp();
            break;
        case "KEY_BACK":
            top.State.setState(top.State.VOD_LIST_MAIN);
            vodListMovieListShowHighlight();
            vodPlayerSubMenuList.display();
            break;
        case "KEY_SELECT":
            if (vodListMovieList.getItem()) {
                top.ScreenManager.storeScreen("VOD_LIST");
                if (vodPlayerSubMenuList.getItem().target == "VOD_PLAY") {
                    top.ScreenManager.load("FSV", {
                        type: "VOD",
                        video: vodListMovieList.getItem().url
                    })
                } else {
                    top.ScreenManager.load("FSV", {
                        type: "VOD",
                        video: vodListMovieList.getItem().trailerLink
                    })
                }
            }
            break;
        default:
            c = false;
            break
    }
    return c
}

function vodListMainEventHandler(e) {
    var c = true;
    var g = e.code;
    if (g == "KEY_UP" && (vodListMovieList.getIndex() < top.MOV_CLMNS)) {
        g = "KEY_BACK"
    }
    switch (g) {
        case "KEY_LEFT":
            try {
                (top.DEFAULT_DIRECTION == "ltr") ? vodListMovieList.scrollUp(): vodListMovieList.scrollDown()
            } catch (f) {
                x = f
            }
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "ltr") ? vodListMovieList.scrollDown(): vodListMovieList.scrollUp();
            break;
        case "KEY_UP":
            if ((vodListMovieList.getIndex() - top.MOV_CLMNS) >= 0) {
                vodListMovieList.scrollUp(top.MOV_CLMNS)
            }
            break;
        case "KEY_DOWN":
            if ((vodListMovieList.getIndex() + top.MOV_CLMNS) < vodListMovieList.getLength()) {
                vodListMovieList.scrollDown(top.MOV_CLMNS)
            }
            break;
        case "KEY_BACK":
            top.State.setState(top.State.VOD_SUBMENU);
            vodListMovieListHideHighlight();
            vodListSubMenuList.display();
            break;
        case "KEY_SELECT":
            top.State.setState(top.State.VOD_PLAYMENU);
            vodListMovieListHideHighlight();
            vodPlayerSubMenuList.display();
            break;
        default:
            c = false;
            break
    }
    return c
}

function vodPlayerInitSubMenuList() {
    vodPlayerSubMenuList = new top.List(top.ListType.BLOCK, vodPlayerGetSubMenuData(), 0, 0, 0, 2, document.getElementById("vodPlayerContainer"));
    vodPlayerSubMenuList.displayItem = vodPlayerSubMenuListDisplayItem;
    vodPlayerSubMenuList.initList()
}

function vodPlayerGetSubMenuData() {
    var b = [];
    b.push({
        "class": "vodTrailerIcon",
        target: "VOD_TRAILER",
        args: {
            type: "trailer"
        }
    });
    b.push({
        "class": "vodPlayIcon",
        target: "VOD_PLAY",
        args: {
            type: "play"
        }
    });
    return b
}

function vodListSubMenuEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "ltr") ? vodListSubMenuList.scrollUp(): vodListSubMenuList.scrollDown();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "ltr") ? vodListSubMenuList.scrollDown(): vodListSubMenuList.scrollUp();
            break;
        case "KEY_DOWN":
            top.State.setState(top.State.VOD_LIST_MAIN);
            vodListMovieListShowHighlight();
            vodListSubMenuList.display();
            break;
        case "KEY_SELECT":
            if (vodListSubMenuList.getItem()) {
                top.ScreenManager.load(vodListSubMenuList.getItem().target, vodListSubMenuList.getItem().args)
            }
            break;
        default:
            c = false;
            break
    }
    return c
}

function vodListActionHandler(c, d) {
    switch (c) {}
}

function vodListInitScreen(b) {
    top.State.setState(top.State.VOD_LIST_MAIN);
    top.ScreenManager.displayScreen(vodListGetScreenHtml());
    top.Clock.show(this, "globalClock");
    if (b) {
        vodListInitType = b.type || null;
        vodListInitLetter = b.letter || null;
        vodListInitGenreId = b.genreId || null
    }
    vodListInitSubMenuList();
    vodPlayerInitSubMenuList();
    vodListInitMainList()
}

function vodListUninitScreen() {
    top.Clock.stop();
    setToBinVODList();
    top.kwConsole.print("vodListUnloadScreen")
}

function vodListGetSubMenuData() {
    var b = [];
    b.push({
        "class": "vodSubMenuAlphabetIcon",
        target: "VOD_CHOOSER",
        args: {
            type: "alpha"
        }
    });
    b.push({
        "class": "vodSubMenuGenreIcon",
        target: "VOD_CHOOSER",
        args: {
            type: "genre"
        }
    });
    return b
}

function vodListInitSubMenuList() {
    vodListSubMenuList = new top.List(top.ListType.BLOCK, vodListGetSubMenuData(), 0, 0, 0, 2, document.getElementById("vodListSubMenuListContainer"));
    vodListSubMenuList.displayItem = vodListSubMenuListDisplayItem;
    vodListSubMenuList.initList()
}

function vodListInitMainList() {
    var b = [];
    tl = top.MOV_CLMNS * top.MOV_ROWS;
    b = top.MoviesManager.moviesArray;
    vodListMovieList = new top.List(top.ListType.BLOCK, top.MoviesManager.moviesArray, 0, 0, 0, tl, document.getElementById("vodListMovieListContainer"));
    vodListMovieList.displayItem = vodListMovieListDisplayItem;
    vodListMovieList.displayEmptyList = vodListMovieListDisplayEmptyList;
    vodListMovieList.display = vodListMovieListDisplay;
    vodListMovieList.onBeforeDisplay = vodListMovieListShowHighlight;
    vodListMovieList.onIndexChanged = vodListMovieListOnIndexChanged;
    vodListMovieList.onAfterDisplay = vodListMovieListOnAfterDisplay;
    vodListMovieList.initList()
}

function setToBinVODList() {
    vodListSubMenuList = null;
    delete vodListSubMenuList;
    vodListSubMenuList = undefined;
    vodListMovieList = null;
    delete vodListMovieList;
    vodListMovieList = undefined;
    vodListInitType = null;
    delete vodListInitType;
    vodListInitType = undefined;
    vodListInitLetter = null;
    delete vodListInitLetter;
    vodListInitLetter = undefined;
    vodListInitGenreId = null;
    delete vodListInitGenreId;
    vodListInitGenreId = undefined;
    vodPlayerSubMenuList = null;
    delete vodPlayerSubMenuList;
    vodPlayerSubMenuList = undefined
}

function initVODListVars() {
    vodListSubMenuList = null;
    vodListMovieList = null;
    vodListInitType = null;
    vodListInitLetter = null;
    vodListInitGenreId = null;
    vodPlayerSubMenuList = null
};