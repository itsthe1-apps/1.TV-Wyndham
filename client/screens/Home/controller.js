var menuScheduleList = null;
var menuNewsList = null;
var menuNewsString = "";
var menuMediaList = null;
var menuWeatherList = null;
var schedulePages = 0;
var scheduleCurrentPage = 1;

function homeEventHandler(a) {
    var b = true;
    switch (a.code) {
        case "INIT_SCREEN":
            homeInitScreen();
            break;
        case "UNINIT_SCREEN":
            homeUninitScreen();
            break;
        case "KEY_MENU":
            top.ScreenManager.load("MENU");
            break;
        default:
            switch (top.State.getState()) {
                case top.State.MENU_MAIN:
                    b = homeMainEventHandler(a);
                    break;
                default:
                    b = false;
                    break
            }
            break
    }
    return b
}

function homeMainEventHandler(a) {
    var b = true;
    switch (a.code) {
        case "KEY_SELECT":
            break;
        default:
            b = false;
            break
    }
    return b
}

function homeInitScreen() {
    var b = true;
    top.ScreenManager.displayScreen(homeGetScreenHtml());
    loadSheduleList();
    scheduleInitList();
    loadNewsString();
    loadMediaList();
    menuInitMediaList();
    loadWeatherList();
    menuInitWeatherList();
    setTopClock()
}

function loadSheduleList() {
    menuScheduleList = new top.List(top.ListType.SCROLL_CYCLIC, top.ScheduleManager.getBlocks(), 0, 0, 0, top.SCH_ITEMS_PERPAGES, document.getElementById("homeScheduleItemContainer"));
    x11 = menuScheduleList;
    menuScheduleList.displayItem = menuScheduleListDisplayItem;
    menuScheduleList.display = menuScheduleListDisplay;
    menuScheduleList.initList();
    if (menuScheduleList.getLength() > 0) {
        xa = menuScheduleList.getLength()
    }
    schedulePages = Math.round(top.SCH_ITEMS_PERPAGES / menuScheduleList.getLength());
    top.kwTimer.setTimer("LOAD_NEXT_SCHEDULE", {
        scope: this,
        callback: loadSheduleList
    }, top.SCH_LOAD_TIMEOUT, true)
}

function scheduleInitList() {
    top.kwTimer.setTimer("SHOW_NEXT_SCHEDULE", {
        scope: this,
        callback: scheduleInitListTimer
    }, top.SCH_SCROLL_TIMEOUT, true)
}

function scheduleInitListTimer() {
    xab = menuScheduleList.getLength();
    if (menuScheduleList.getLength() > 1 && menuScheduleList.getLength() > top.SCH_ITEMS_PERPAGES) {
        menuScheduleList.scrollDown(top.SCH_ITEMS_PERPAGES)
    }
    if (schedulePages > 0) {
        scheduleCurrentPage++;
        if (schedulePages < scheduleCurrentPage) {
            top.scheduleSwitch = (top.scheduleSwitch == 0) ? 1 : 0;
            scheduleCurrentPage = 1;
            menuScheduleList.initList()
        }
    }
    top.kwConsole.print("Page:" + Math.round(top.SCH_ITEMS_PERPAGES / menuScheduleList.getLength()) + 1)
}

function setTopClock() {
    top.kwTimer.setTimer("SHOW_NEXT_TIME", {
        scope: this,
        callback: topclock
    }, 1000, true)
}

function loadNewsList() {
    menuNewsList = new top.List(top.ListType.SCROLL_CYCLIC, top.NewsManager.getBlocks(), 0, 0, 0, 1, document.getElementById("newsFooterText"));
    menuNewsList.displayItem = menuNewsListDisplayItem;
    menuNewsList.initList();
    top.kwTimer.setTimer("LOAD_NEXT_NEWS", {
        scope: this,
        callback: loadNewsList
    }, top.NEWS_LOAD_TIMEOUT, true)
}

function menuInitNewsList() {
    top.kwTimer.setTimer("SHOW_NEXT_NEWS", {
        scope: this,
        callback: menuInitNewsTimer
    }, top.NEWS_SCROLL_TIMEOUT, true)
}

function menuInitNewsTimer() {
    if (menuNewsList.getLength() > 1) {
        menuNewsList.scrollDown()
    }
}
ScrollSpeed = 200;
ScrollChars = 1;

function loadNewsString() {
    for (var b = 0; b < top.NewsManager.getBlocks().length; b++) {
        menuNewsString += "**" + top.NewsManager.getBlocks()[b].title + "        "
    }
    document.getElementById("scrollInput").value = menuNewsString;
    ScrollNewsMarquee()
}

function ScrollNewsMarquee() {
    top.kwTimer.setTimer("NEWS_SCROLLER", {
        scope: this,
        callback: ScrollNewsMarquee
    }, top.NEWS_SCROLL_DELAY, true);
    var a = document.getElementById("scrollInput").value;
    document.getElementById("scrollInput").value = a.substring(ScrollChars) + a.substring(0, ScrollChars);
}

function loadNewsString2() {
    for (var b = 0; b < top.NewsManager.getBlocks().length; b++) {
        menuNewsString += top.NewsManager.getBlocks()[b].title + "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    }
    var c = "";
    c += '<marquee direction="left" scrolldelay="' + top.NEWS_SCROLL_DELAY + '">' + menuNewsString + "</marquee>";
    return c
}

function loadWeatherList() {
    menuWeatherList = new top.List(top.ListType.SCROLL_CYCLIC, top.WeatherManager.getBlocks(), 0, 0, 0, 1, document.getElementById("homeweather"));
    menuWeatherList.displayItem = menuWeatherListDisplayItem;
    menuWeatherList.initList();
    top.kwTimer.setTimer("LOAD_NEXT_WEATHER", {
        scope: this,
        callback: loadWeatherList
    }, top.WEATHER_LOAD_TIMEOUT, true)
}

function menuInitWeatherList() {
    top.kwTimer.setTimer("SHOW_NEXT_WEATHER", {
        scope: this,
        callback: menuInitWeatherTimer
    }, top.WEATHER_SCROLL_TIMEOUT, true)
}

function menuInitWeatherTimer() {
    if (menuWeatherList.getLength() > 1) {
        menuWeatherList.scrollDown()
    }
}
var timeTracker;

function loadMediaList() {
    if (timeTracker > 0) {
        clearTimeout(timeTracker)
    }
    if (menuMediaList !== null) {
        menuMediaList = null
    }
    menuMediaList = new top.List(top.ListType.SCROLL_CYCLIC, top.MediaManager.getBlocks(), 0, 0, 0, 1, document.getElementById("homeMediaContainer"));
    menuMediaList.displayItem = menuMediaListDisplayItem;
    menuMediaList.initList();
    top.kwTimer.setTimer("LOAD_NEXT_MEDIA", {
        scope: this,
        callback: loadMediaList
    }, top.MEDIA_LOAD_TIMEOUT, true)
}

function menuInitMediaList() {
    if (menuMediaList.getItem()) {
        d = menuMediaList.getItem().duration;
        timeTracker = setTimeout(menuInitMediaTimer, d)
    }
}

function menuInitMediaTimer() {
    if (menuMediaList.getLength() > 1) {
        menuMediaList.scrollDown()
    }
    menuInitMediaList()
}

function homeUninitScreen() {
    top.Clock.stop();
    top.kwTimer.cancelTimer("LOAD_NEXT_SCHEDULE");
    top.kwTimer.cancelTimer("SHOW_NEXT_SCHEDULE");
    top.kwTimer.cancelTimer("LOAD_NEXT_NEWS");
    top.kwTimer.cancelTimer("SHOW_NEXT_NEWS");
    top.kwTimer.cancelTimer("LOAD_NEXT_MEDIA");
    top.kwTimer.cancelTimer("SHOW_NEXT_TIME");
    top.kwTimer.cancelTimer("LOAD_NEXT_WEATHER");
    top.kwTimer.cancelTimer("NEWS_SCROLLER")
}
