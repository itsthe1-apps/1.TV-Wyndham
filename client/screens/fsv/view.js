var fsvIsInfobarHidden = true;

function fsvGetScreenHtml() {
    var a = "";
    if (top.DEVICE_TYPE == "exterity") {
        a += '<img id="player" src="tv:" class="videoFullScreen"></div>'
    }
    a += '<div id="fsvTrickPlayContainer" class="fsvTrickPlayContainer"><div id="fsvTrickPlayButton"></div></div>';
    a += '<div id="fsvInfobarContainer" class="fsvInfobarContainer">';
    a += '<div id="fsvContentName" class="fsvContentName"></div>';
    a += '<div id="fsvClock" class="fsvClock"></div>';
    a += '<div id="fsvProgramListContainer" class="fsvProgramListContainer"></div>';
    a += "</div>";
    a += '<div id="globalChannelZapper" class="globalChannelZapper"></div>';
    a += '<div id="globalMute" class="globalMute"></div>';
    a += '<div id="globalVolumeBar" class="globalVolumeBar"></div>';
    return a
}

function fsvShowInfobar() {
    top.StreamManager.hideSubtitles();
    document.getElementById("fsvInfobarContainer").style.visibility = "visible";
    fsvIsInfobarHidden = false
}

function fsvHideInfobar() {
    document.getElementById("fsvInfobarContainer").style.visibility = "hidden";
    if (fsvType == "LIVE") {
        fsvUnloadProgramList()
    }
    top.StreamManager.showSubtitles();
    fsvIsInfobarHidden = true
}

function fsvDisplayInfobarInformation() {
    var a = "";
    if (top.State.getState() == top.State.FSV_LIVE) {
        var b = top.ChannelManager.getCurrentChannel();
        if (b) {
            a = b.channelNumber + " " + b.name
        }
    } else {
        if (top.State.getState() == top.State.FSV_VOD) {
            if (fsvVideo) {
                a = (fsvType == "VOD" ? fsvVideo.name : (fsvVideo.name + " - " + top.Clock.getFormattedDate(fsvVideo.startTime * 1000) + " " + top.Clock.getFormattedTime(fsvVideo.startTime * 1000)))
            }
        }
    }
    document.getElementById("fsvContentName").innerHTML = a
}

function fsvStartHidingInfobar() {
    top.kwTimer.cancelTimer("HIDE_INFOBAR");
    top.kwTimer.setTimer("HIDE_INFOBAR", {
        scope: this,
        callback: fsvHideInfobar
    }, top.FSV_INFOBAR_TIMEOUT)
}

function fsvStopHidingInfobar() {
    top.kwTimer.cancelTimer("HIDE_INFOBAR")
}

function fsvShowTrickPlay(b) {
    var a = "";
    b = b ? b : top.Player.getPlayerState();
    fsvStopHidingTrickPlay();
    switch (b) {
        case "IDLE":
            a = "fsvIdleButton";
            break;
        case "PLAYING":
            a = "fsvPlayButton";
            break;
        case "PAUSED":
            a = "fsvPauseButton";
            break;
        case "REWIND":
            a = "fsvRewindButton";
            break;
        case "FFORWARD":
            a = "fsvFFButton";
            break
    }
    document.getElementById("fsvTrickPlayButton").className = a;
    document.getElementById("fsvTrickPlayContainer").style.visibility = "visible"
}

function fsvHideTrickPlay() {
    document.getElementById("fsvTrickPlayButton").className = "fsvIdleButton";
    document.getElementById("fsvTrickPlayContainer").style.visibility = "hidden"
}

function fsvStartHidingTrickPlay() {
    top.kwTimer.setTimer("HIDE_TRICK_PLAY", {
        scope: this,
        callback: fsvHideTrickPlay
    }, top.FSV_TRICK_PLAY_TIMEOUT)
}

function fsvStopHidingTrickPlay() {
    top.kwTimer.cancelTimer("HIDE_TRICK_PLAY")
}

function fsvUpdateProgressBar() {
    var d = top.Player.getPosition() || 0;
    var b = 0,
            a = "";
    var e = 300;
    var c = top.Player.getDuration();
    top.kwConsole.print("fsvUpdateProgressBar :: d : " + c + ", p : " + d);
    if (c > 0) {
        b = Math.floor((e * d) / c);
        b = b > 0 ? b : 0;
        a += '<div class="fsvProgressBarCurrentPosition">' + top.Clock.msec2Time(d) + "</div>";
        a += '<div style="width:' + b + 'px;height:12px;" class="fsvProgressBarCurrentPlayed"></div>';
        a += '<div style="width:' + (e - b) + 'px;height:12px;" class="fsvProgressBarCurrentRemained"></div>';
        document.getElementById("fsvProgressBarContainer").innerHTML = a
    }
    document.getElementById("fsvProgressBarContainer").innerHTML = a;
    fsvStartUpdateProgressBar()
}

function fsvStartUpdateProgressBar() {
    top.kwTimer.setTimer("UPGRADE_PROGRESS_BAR", {
        scope: this,
        callback: fsvUpdateProgressBar
    }, 1000, true)
}

function fsvStopUpdateProgressBar() {
    top.kwTimer.cancelTimer("UPGRADE_PROGRESS_BAR")
}

function fsvShowChannelZapper() {
    var b = "<html><body><p class='globalChannelZapper'>";
    b += top.ChannelManager.getCurrentChannel() ? top.ChannelManager.getCurrentChannel().channelNumber : "";
    b += "</p></body></html>";
    document.getElementById("globalChannelZapper").innerHTML = b;
    top.kwTimer.setTimer("HIDE_CHANNEL_ZAPPER", {
        scope: this,
        callback: fsvHideChannelZapper
    }, top.FSV_INFOBAR_TIMEOUT)
}

function fsvHideChannelZapper() {
    document.getElementById("globalChannelZapper").innerHTML = "";
    top.kwTimer.cancelTimer("HIDE_CHANNEL_ZAPPER")
}

function fsvProgramListDisplayItem(a, f, c) {
    var b = "";
    var d = this.getItem(a);
    var e = (a < this.getLength() - 1 ? this.getItem(a + 1) : null);
    if (d) {
        b += '<div class="fsvProgramListItemNow">' + (d.startTime ? top.Clock.getFormattedTime(d.startTime, false) : "") + "  " + d.name + "</div>"
    }
    if (e) {
        b += '<div class="fsvProgramListItemNext">' + (e.startTime ? top.Clock.getFormattedTime(e.startTime, false) : "") + "  " + e.name + "</div>"
    }
    return b
}

function fsvUnloadProgramList() {
    document.getElementById("fsvProgramListContainer").innerHTML = ""
}