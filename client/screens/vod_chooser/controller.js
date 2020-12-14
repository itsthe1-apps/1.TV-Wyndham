var vodChooserSubMenuList = null;
var vodChooserAlphaList = null;
var vodChooserGenreList = null;
var lastView = null;

function vodChooserEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            top.changeBackgroundImg('VOD');
            initVODChooserVars();
            vodChooserInitScreen(d.args);
            break;
        case "UNINIT_SCREEN":
            vodChooserUninitScreen();
            break;
        default:
            switch (top.State.getState()) {
                case top.State.VOD_CHOOSER_ALPHA:
                    c = vodChooserAlphaEventHandler(d);
                    break;
                case top.State.VOD_CHOOSER_GENRE:
                    c = vodChooserGenreEventHandler(d);
                    break;
                case top.State.VOD_SUBMENU:
                    c = vodChooserSubMenuEventHandler(d);
                    break;
                default:
                    c = false;
                    break
            }
            break
    }
    return c
}

function vodChooserAlphaEventHandler(e) {
    var c = true;
    var f = e.code;
    if (f == "KEY_UP" && (vodChooserAlphaList.getIndex() < 6)) {
        f = "KEY_BACK"
    }
    switch (f) {
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "ltr") ? vodChooserAlphaList.scrollUp(): vodChooserAlphaList.scrollDown();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "ltr") ? vodChooserAlphaList.scrollDown(): vodChooserAlphaList.scrollUp();
            break;
        case "KEY_BACK":
            lastView = "alpha";
            top.State.setState(top.State.VOD_SUBMENU);
            vodChooserGenreListHideHighlight();
            vodChooserAlphaList.display();
            vodChooserSubMenuList.display();
            break;
        case "KEY_UP":
            vodChooserAlphaList.scrollUp(6);
            break;
        case "KEY_DOWN":
            vodChooserAlphaList.scrollDown(6);
            break;
        case "KEY_SELECT":
            if (vodChooserAlphaList.getItem()) {
                top.MoviesManager.clearMovieList();
                top.MoviesManager.getMovieListByLetter(top.MoviesManager.alphabetMoviesArray, vodChooserAlphaList.getItem().letter);
                top.ScreenManager.load("VOD_LIST")
            }
            break;
        default:
            c = false;
            break
    }
    return c
}

function vodChooserGenreEventHandler(e) {
    var c = true;
    var f = e.code;
    if (f == "KEY_UP" && (vodChooserGenreList.getIndex() < top.MOV_CAT_CLMNS)) {
        f = "KEY_BACK"
    }
    switch (f) {
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "ltr") ? vodChooserGenreList.scrollUp(): vodChooserGenreList.scrollDown();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "ltr") ? vodChooserGenreList.scrollDown(): vodChooserGenreList.scrollUp();
            break;
        case "KEY_UP":
            if ((vodChooserGenreList.getIndex() - top.MOV_CAT_CLMNS) >= 0) {
                vodChooserGenreList.scrollUp(top.MOV_CAT_CLMNS)
            }
            break;
        case "KEY_DOWN":
            if ((vodChooserGenreList.getIndex() + top.MOV_CAT_CLMNS) < vodChooserGenreList.getLength()) {
                vodChooserGenreList.scrollDown(top.MOV_CAT_CLMNS)
            }
            break;
        case "KEY_BACK":
            lastView = "genre";
            top.State.setState(top.State.VOD_SUBMENU);
            vodChooserGenreListHideHighlight();
            vodChooserSubMenuList.display();
            break;
        case "KEY_SELECT":
            if (vodChooserGenreList.getItem()) {
                top.MoviesManager.clearMovieList();
                top.DEFAULT_CHANNEL_CATEGORY = vodChooserGenreList.getItem().id;
                top.MoviesManager.loadMovies(vodChooserGenreList.getItem().id)
            }
            break;
        default:
            c = false;
            break
    }
    return c
}

function vodChooserSubMenuEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_LEFT":
            (top.DEFAULT_DIRECTION == "ltr") ? vodChooserSubMenuList.scrollUp(): vodChooserSubMenuList.scrollDown();
            break;
        case "KEY_RIGHT":
            (top.DEFAULT_DIRECTION == "ltr") ? vodChooserSubMenuList.scrollDown(): vodChooserSubMenuList.scrollUp();
            break;
        case "KEY_SELECT":
            if (vodChooserSubMenuList.getItem()) {
                top.ScreenManager.load(vodChooserSubMenuList.getItem().target, vodChooserSubMenuList.getItem().args)
            }
            break;
        case "KEY_DOWN":
            if (lastView == "alpha") {
                vodChooserSubMenuList.setIndex(0)
            } else {
                vodChooserSubMenuList.setIndex(1)
            }
            if (vodChooserSubMenuList.getItem()) {
                top.ScreenManager.load(vodChooserSubMenuList.getItem().target, vodChooserSubMenuList.getItem().args)
            }
            break;
        default:
            c = false;
            break
    }
    return c
}

function vodChooserActionHandler(c, d) {
    switch (c) {}
}

function vodChooserInitScreen(b) {
    top.ScreenManager.displayScreen(vodChooserGetScreenHtml());
    top.Clock.show(this, "globalClock");
    if (b && b.type == "genre") {
        top.State.setState(top.State.VOD_CHOOSER_GENRE);
        vodChooserInitGenreList()
    } else {
        top.State.setState(top.State.VOD_CHOOSER_ALPHA);
        vodChooserInitAlphaList()
    }
    vodChooserInitSubMenuList()
}

function vodChooserUninitScreen() {
    top.Clock.stop();
    setToBinVODChooser();
    top.kwConsole.print("vodChooserUnloadScreen")
}

function vodChooserGetSubMenuData() {
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

function vodChooserGetAlphaData() {
    var b = [];
    b.push({
        letter: "A"
    });
    b.push({
        letter: "B"
    });
    b.push({
        letter: "C"
    });
    b.push({
        letter: "D"
    });
    b.push({
        letter: "E"
    });
    b.push({
        letter: "F"
    });
    b.push({
        letter: "G"
    });
    b.push({
        letter: "H"
    });
    b.push({
        letter: "I"
    });
    b.push({
        letter: "J"
    });
    b.push({
        letter: "K"
    });
    b.push({
        letter: "L"
    });
    b.push({
        letter: "M"
    });
    b.push({
        letter: "N"
    });
    b.push({
        letter: "O"
    });
    b.push({
        letter: "P"
    });
    b.push({
        letter: "Q"
    });
    b.push({
        letter: "R"
    });
    b.push({
        letter: "S"
    });
    b.push({
        letter: "T"
    });
    b.push({
        letter: "U"
    });
    b.push({
        letter: "V"
    });
    b.push({
        letter: "X"
    });
    b.push({
        letter: "Y"
    });
    b.push({
        letter: "Z"
    });
    return b
}

function vodChooserInitSubMenuList() {
    vodChooserSubMenuList = new top.List(top.ListType.BLOCK, vodChooserGetSubMenuData(), 0, 0, 0, 2, document.getElementById("vodChooserSubMenuListContainer"));
    vodChooserSubMenuList.displayItem = vodChooserSubMenuListDisplayItem;
    vodChooserSubMenuList.initList()
}

function vodChooserInitGenreList() {
    tl = top.MOV_CAT_CLMNS * top.MOV_CAT_ROWS;
    vodChooserGenreList = new top.List(top.ListType.BLOCK, top.MoviesManager.getCategoriesData(), 0, 0, 0, tl, document.getElementById("vodChooserListContainer"));
    vodChooserGenreList.displayItem = vodChooserGenreListDisplayItem;
    vodChooserGenreList.display = vodChooserGenreListDisplay;
    vodChooserGenreList.onBeforeDisplay = vodChooserGenreListShowHighlight;
    vodChooserGenreList.onIndexChanged = vodChooserGenreListOnIndexChanged;
    vodChooserGenreList.onAfterDisplay = vodChooserGenreListDisplayTotal;
    vodChooserGenreList.initList()
}

function vodChooserInitAlphaList() {
    vodChooserAlphaList = new top.List(top.ListType.BLOCK, vodChooserGetAlphaData(), 0, 0, 0, 25, document.getElementById("vodChooserListContainer"));
    vodChooserAlphaList.displayItem = vodChooserAlphaListDisplayItem;
    vodChooserAlphaList.initList()
}

function setToBinVODChooser() {
    vodChooserSubMenuList = null;
    delete vodChooserSubMenuList;
    vodChooserSubMenuList = undefined;
    vodChooserAlphaList = null;
    delete vodChooserAlphaList;
    vodChooserAlphaList = undefined;
    vodChooserGenreList = null;
    delete vodChooserGenreList;
    vodChooserGenreList = undefined;
    lastView = null;
    delete lastView;
    lastView = undefined
}

function initVODChooserVars() {
    vodChooserSubMenuList = null;
    vodChooserAlphaList = null;
    vodChooserGenreList = null;
    lastView = null
};