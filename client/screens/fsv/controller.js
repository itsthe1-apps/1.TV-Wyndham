var fsvType = "";
var fsvVideo = null;
var fsvImage = null;
var fsvProgramList = null;

function fsvEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "INIT_SCREEN":
            fsvInitScreen(d.args);
            top.switchMuteDisplay(top.Player.isMute);
            break;
        case "UNINIT_SCREEN":
            fsvUninitScreen();
            top.SCREEN_MODE = 0;
            top.VOD_SCREEN_MODE = 0;
            break;
        default:
            switch (top.State.getState()) {
                case top.State.FSV_LIVE:
                    c = fsvLiveEventHandler(d);
                    break;
                case top.State.FSV_VOD:
                    c = fsvVodEventHandler(d);
                    break;
                default:
                    c = false;
                    break
            }
            break
    }
    return c
}

function fsvLiveEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_CHANNEL_UP":
        case "KEY_CHANNEL_DOWN":
            fsvChangeChannel(d);
            break;
        case "KEY_INFO":
        case "KEY_SELECT":
            if (fsvIsInfobarHidden) {
                top.ChannelManager.loadEitByChannel(top.ChannelManager.getCurrentChannel());
                fsvShowInfobar();
                fsvStartHidingInfobar()
            }
            break;
        case "KEY_BACK":
            top.Player.stop();
            top.ScreenManager.load("MENU");
            break;
        case "KEY_LANGUAGE":
            top.StreamManager.nextAudio();
            break;
        case "KEY_SUBTITLE":
            top.StreamManager.nextSubtitle();
            break;
        case "EIT_LOADED":
            if (top.ChannelManager.getCurrentChannel() && top.ChannelManager.getCurrentChannel().id == d.args.channelId) {
                fsvProgramListInit(d.args.programs)
            }
            break;
        default:
            c = false;
            break
    }
    return c
}

function fsvVodEventHandler(d) {
    var c = true;
    switch (d.code) {
        case "KEY_INFO":
        case "KEY_SELECT":
            if (fsvIsInfobarHidden) {
                fsvShowInfobar();
                fsvStartHidingInfobar()
            }
            break;
        case "KEY_BACK":
            if (!fsvIsInfobarHidden) {
                fsvHideInfobar()
            }
            top.ScreenManager.load("VOD_LIST");
            break;
        case "KEY_BLUE":
        case "KEY_STOP":
        case "FILE_END_OF_STREAM":
            top.Player.stop();
            top.ScreenManager.loadLastScreen();
            break;
        case "KEY_PLAY":
            top.Player.resume();
            fsvShowTrickPlay();
            fsvStartHidingTrickPlay();
            break;
        case "KEY_PAUSE":
            top.Player.pause();
            fsvShowTrickPlay();
            fsvStartHidingTrickPlay();
            break;
        case "KEY_REWIND":
            top.Player.rewind();
            fsvShowTrickPlay();
            break;
        case "KEY_FFORWARD":
            top.Player.fforward();
            fsvShowTrickPlay();
            break;
        default:
            c = false;
            break
    }
    return c
}

function fsvActionHandler(c, d) {
    switch (c) {
    }
}

function fsvInitScreen(b) {
    top.ScreenManager.displayScreen(fsvGetScreenHtml());
    fsvType = b && b.type ? b.type : "LIVE";
    fsvVideo = ((fsvType == "VOD" || fsvType == "PVR") && b && b.video ? b.video : null);
    switch (fsvType) {
        case "LIVE":
            top.SCREEN_MODE = 1;
            top.State.setState(top.State.FSV_LIVE);
            top.Player.setFullScreen();
            top.Player.setAlphaLevel(top.TRANSPARENCY_LEVEL);
            fsvChangeChannel();
            break;
        case "VOD":
            top.VOD_SCREEN_MODE = 1;
            top.State.setState(top.State.FSV_VOD);
            if (fsvVideo) {
                top.kwConsole.print("fsv::fsvInitScreen: start play VOD :: " + fsvVideo.trailerLink);
                top.Player.setFullScreen();
                top.Player.setAlphaLevel(top.TRANSPARENCY_LEVEL);
                top.Player.play(fsvVideo);
                fsvShowTrickPlay();
                fsvStartHidingTrickPlay()
            }
            break
    }
    top.Clock.show(this, "fsvClock")
}

function fsvUninitScreen() {
    top.Player.setAlphaLevel(top.OPAQUE_LEVEL);
    top.StreamManager.hideSubtitles();
    setToBinFSV();
    top.Clock.stop()
}

function fsvChangeChannel(c) {
    var d = c && c.code ? c.code : null;
    switch (d) {
        case "KEY_CHANNEL_UP":
            top.ChannelManager.channelUp(true);
            break;
        case "KEY_CHANNEL_DOWN":
            top.ChannelManager.channelDown(true);
            break
    }
    top.kwConsole.print("FSV :: fsvChangeChannel :: " + top.ChannelManager.getCurrentChannel().url);
    top.Player.play(top.ChannelManager.getCurrentChannel().url);
    fsvShowChannelZapper()
}

function fsvProgramListInit(b) {
    if (b.length < 2) {
        b.push({
            name: top.globalGetLabel("INFOBAR_INFORMATION_UNAVAILABLE")
        })
    }
    fsvProgramList = new top.List(top.ListType.SCROLL, b, 0, 0, 0, 1, document.getElementById("fsvProgramListContainer"));
    fsvProgramList.displayItem = fsvProgramListDisplayItem;
    fsvProgramList.initList()
}

function fsvFilterPastPrograms(h) {
    var g = [];
    var e = new Date().getTime();
    for (var f = 0; f < h.length; f++) {
        if (h[f].endTime > e) {
            g.push(h[f])
        }
    }
    return g
}

function setToBinFSV() {
    fsvType = null;
    delete fsvType;
    fsvType = undefined;
    fsvVideo = null;
    delete fsvVideo;
    fsvVideo = undefined;
    fsvImage = null;
    delete fsvImage;
    fsvImage = undefined;
    fsvProgramList = null;
    delete fsvProgramList;
    fsvProgramList = undefined
}