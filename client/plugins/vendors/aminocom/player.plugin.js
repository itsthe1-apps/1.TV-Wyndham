var Player = {
    isSTB: true,
    currentMrl: "",
    currentState: null,
    playerSpeed: [2, 4, 6, 8, 16, 32],
    playerSpeedIndex: 0,
    isMute: 0,
    init: function () {
        try {
        } catch (a) {
            top.kwConsole.print("Player.init() error :: " + a.message);
        }
    },
    getPlayerHtml: function () {
        return ""
    },
    getPlayerState: function () {
        return this.currentState
    },
    setPlayerState: function (a) {
        top.kwConsole.print("Player.setPlayerState() " + a);
        this.currentState = a;
    },
    getVolume: function () {
        try {
            top.kwConsole.print("Current Volume is:" + AudioControl.GetVolume());
            return AudioControl.GetVolume();
        } catch (a) {
            top.kwConsole.print("getVolume error :: " + a.message);
            return 0;
        }
    },
    powerToggle: function () {
        p = ASTB.GetPowerState();
        p = (p == 2) ? 4 : 2;
        ASTB.SetPowerState(p);
    },
    setVolume: function (b) {
        try {
            b = b > top.VOLUME_MAX ? top.VOLUME_MAX : b;
            b = b < top.VOLUME_MIN ? top.VOLUME_MIN : b;
            AudioControl.SetVolume(b);
        } catch (a) {
            top.kwConsole.print("setVolume error :: " + a.message);
        }
    },
    setBrowser: function (b) {
        try {
            ASTB.SetMouseState(false);
            Browser.SetToolbarState(false);
        } catch (d) {
        }
    },
    toggleMute: function () {
        try {
            this.isMute = AudioControl.GetMute();
            this.isMute = (this.isMute == 1) ? 0 : 1;
            AudioControl.SetMute(this.isMute);
            return this.isMute;
        } catch (a) {
            top.kwConsole.print("toggleMute error :: " + a.message);
        }
    },
    getIpAddress: function () {
        try {
            return ASTB.GetIPAddress();
        } catch (a) {
            top.kwConsole.print(a.message);
            return "000.000.000.000";
        }
    },
    getMacAddress: function () {
        try {
            return ASTB.GetMacAddress();
        } catch (a) {
            top.kwConsole.print("GetMacAddress error :: " + a.message);
            return "00:00:00:00:00:00";
        }
    },
    getSerialNumber: function () {
        try {
            return ASTB.GetSerialNumber();
        } catch (a) {
            top.kwConsole.print("rtvGetSerialNumber error :: " + a.message);
            return "000000000000";
        }
    },
    getStoredData: function (a) {
        try {
            return this.player.getStorageValue(a);
        } catch (b) {
            top.kwConsole.print("Player.getStoredData() error :: " + b.message);
        }
    },
    setStoredData: function (b, c) {
        try {
            return this.player.setStorageValue(b, c);
        } catch (a) {
            top.kwConsole.print("Player.setStoredData() error :: " + a.message);
        }
    },
    loadUrl: function (a) {
        try {
            this.document.location.href = a;
        } catch (b) {
            top.kwConsole.print("Player.loadUrl() error :: " + b.message);
        }
    },
    stop: function () {
        try {
            this.setPlayerState("IDLE");
            AVMedia.Stop();
            this.currentMrl = "";
            this.playerSpeedIndex = 0;
            this.setClipScreen(0, top.globalGetScreenHeightByResolution(), top.CLIP_W, top.CLIP_H);
        } catch (a) {
            top.kwConsole.print("Player.stop() error :: " + a.message);
        }
    },
    play: function (c) {
        var b = null;
        try {
            if (c != this.currentMrl) {
                document.body.style.backgroundColor = "#102030";
                top.kwConsole.print("Player.play() " + c);
                this.setPlayerState("PLAYING");
                b = AVMedia.Play(c);
                if (b == 0) {
                    this.currentMrl = c;
                    this.setPlayerState("PLAYING");
                } else {
                    this.currentMrl = "";
                }
                this.setChromaKey(top.CHROMAKEY);
                Browser.SetToolbarState(0);
            }
        } catch (a) {
            top.kwConsole.print("Player.play() error :: " + a.message);
        }
    },
    restart: function () {
        ASTB.Reboot()
    },
    pause: function () {
        try {
            if (this.getPlayerState() === "PAUSED") {
                this.resume()
            } else {
                this.setPlayerState("PAUSED");
                AVMedia.Pause();
                this.playerSpeedIndex = 0
            }
        } catch (a) {
            top.kwConsole.print("Player.pause() error :: " + a.message)
        }
    },
    resume: function () {
        try {
            this.setPlayerState("PLAYING");
            this.playerSpeedIndex = 0;
            AVMedia.Continue()
        } catch (a) {
            top.kwConsole.print("Player.resume() error :: " + a.message)
        }
    },
    rewind: function (c) {
        try {
            var b = c || this.playerSpeed[(this.playerSpeedIndex == (this.playerSpeed.length - 1) ? this.playerSpeedIndex : this.playerSpeedIndex++)];
            top.kwConsole.print("rewind :: " + b);
            this.setPlayerState("REWIND");
            AVMedia.SetSpeed(-1 * b)
        } catch (a) {
            top.kwConsole.print("Player.rewind() error :: " + a.message)
        }
    },
    fforward: function (c) {
        try {
            var b = c || this.playerSpeed[(this.playerSpeedIndex == (this.playerSpeed.length - 1) ? this.playerSpeedIndex : this.playerSpeedIndex++)];
            top.kwConsole.print("fforward :: " + b);
            this.setPlayerState("FFORWARD");
            AVMedia.SetSpeed(b)
        } catch (a) {
            top.kwConsole.print("Player.fforward() error :: " + a.message)
        }
    },
    seekPDL: function (a) {
        try {
            this.player.seekPDL(a)
        } catch (b) {
            top.kwConsole.print("Player.seekPDL() error :: " + b.message)
        }
    },
    getPosition: function () {
        var a = 0;
        try {
            a = PVR.GetPltInfo()
        } catch (b) {
            top.kwConsole.print("Player.getPosition() error :: " + b.message)
        }
        return a
    },
    setPosition: function (a) {
        try {
            this.player.setPosition(a)
        } catch (b) {
            top.kwConsole.print("Player.setPosition() error :: " + b.message)
        }
    },
    getDuration: function () {
        var b = 0;
        try {
            b = AVMedia.GetDuration()
        } catch (a) {
            top.kwConsole.print("Player.getDuration() error :: " + a.message)
        }
        return b
    },
    setClipScreen: function () {
        try {
            var c = top.VideoDisplay.GetVideoWindow();
            if (c != null) {
                w = c.GetRectangle();
                w.width = top.CLIP_W;
                w.height = top.CLIP_H;
                w.left = top.CLIP_X;
                w.top = top.CLIP_Y;
                c.SetRectangle(w);
                this.setAlphaLevel(top.TRANSPARENCY_LEVEL)
            }
        } catch (d) {
        }
    },
    setClipScreenMin: function () {
        try {
            this.setAlphaLevel(top.OPAQUE_LEVEL)
        } catch (b) {
        }
    },
    setFullScreen: function () {
        try {
            var d = top.VideoDisplay.GetVideoWindow();
            if (d != null) {
                w = d.GetRectangle();
                w.width = top.globalConst("SCREEN_WIDTH");
                w.height = top.globalConst("SCREEN_HEIGHT");
                w.left = 0;
                w.top = 0;
                d.SetRectangle(w);
                this.setAlphaLevel(0)
            }
        } catch (a) {
            result = false
        }
    },
    getBrowserResolution: function () {
        var a = "1080";
        try {
            a = screen.height + ""
        } catch (d) {
            return a
        }
        return a
    },
    removeCache: function () {
        try {
            Browser.CacheFlush()
        } catch (b) {
            top.kwConsole.print(b.message)
        }
    },
    setAlphaLevel: function (b) {
        try {
            VideoDisplay.SetAlphaLevel(b)
        } catch (a) {
        }
    },
    setOutputResolution: function (a) {
        try {
            this.player.setOutputResolution(2, level)
        } catch (b) {
        }
    },
    setChromaKey: function (a) {
        try {
            VideoDisplay.SetChromaKey(a)
        } catch (b) {
        }
    },
    reboot: function () {
        try {
            ASTB.Reboot()
        } catch (a) {
        }
    },
    printDebugMessage: function (b) {
        try {
            top.ASTB.DebugString(b)
        } catch (a) {
        }
    },
    getVolumeLimit: function (c) {
        var b = false;
        try {
            b = this.player.getVolumeLimit(c)
        } catch (a) {
        }
        return b
    },
    playerEventHandler: function (b) {
        var a = "VIDEO_UNKNOWN_EVENT";
        switch (b) {
            case 1:
            case 2:
            case 3:
            case 4:
            case 8:
            case 9:
            case 10:
                a = "VIDEO_PLAYING_FAILED";
                break;
            case 5:
                a = "VIDEO_PLAYING_SUCCESS";
                break;
            case 7:
                a = "VIDEO_END_OF_STREAM";
                break;
            case 14:
                a = "VIDEO_START_OF_STREAM";
                break;
            case 16:
                a = "IGMP_END_OF_STREAM";
                break;
            case 17:
                a = "IGMP_PLAYING_SUCCESS";
                break;
            case 19:
                a = "UDP_END_OF_STREAM";
                break;
            case 20:
                a = "UDP_STATUS_PLAYING";
                break;
            case 21:
                a = "MP3_END_OF_STREAM";
                break;
            case 22:
                a = "MP3_START_OF_STREAM";
                break;
            case 23:
                a = "FILE_END_OF_STREAM";
                break;
            case 24:
                a = "DVR_RECORD_ERROR";
                break;
            case 25:
                a = "DVR_PLAY_ERROR";
                break;
            case 26:
                a = "DVR_END_OF_STREAM";
                break;
            case 27:
                a = "DVR_START_OF_STREAM";
                break;
            case 6:
            case 11:
            case 12:
            case 13:
            case 15:
            case 18:
                a = "VIDEO_UNKNOWN_EVENT";
                break;
            default:
                a = "VIDEO_UNKNOWN_EVENT_" + b;
                break
        }
        top.globalFireEvent(new top.Event(a))
    },
    firmwareEventHandler: function (b) {
        var a = "FIRMWARE_UNKNOWN_EVENT";
        switch (b) {
            case 1000:
                a = "FIRMWARE_EVENT_NEW_FIRMWARE_AVAILABLE";
                break;
            case 1001:
                a = "FIRMWARE_EVENT_FIRMWARE_UP_TO_DATE";
                break;
            case 1002:
                a = "FIRMWARE_EVENT_UPGRADE_CHECK_FAILED";
                break;
            default:
                a = "FIRMWARE_UNKNOWN_EVENT";
                break
        }
        top.globalFireEvent(new top.Event(a))
    },
    dvbEventHandler: function (b) {
        var a = "DVB_UNKNOWN_EVENT";
        switch (b) {
            case 2000:
                a = "DVBT_EVENT_SCAN_STARTED";
                break;
            case 2001:
                a = "DVBT_EVENT_SCAN_CONTINUE";
                break;
            case 2002:
                a = "DVBT_EVENT_SCAN_COMPLETED_WITH_CHANNELS";
                break;
            case 2003:
                a = "DVBT_EVENT_SCAN_COMPLETED_WITHOUT_CHANNELS";
                break;
            case 2004:
                a = "DVBT_EVENT_SCAN_ERROR";
                break;
            case 2005:
                a = "DVBT_EVENT_LOW_SIGNAL";
                break;
            case 2006:
                a = "DVBT_EVENT_LOST_SIGNAL";
                break;
            default:
                a = "DVB_UNKNOWN_EVENT";
                break
        }
        top.globalFireEvent(new top.Event(a))
    },
    upnpEventHandler: function (b) {
        var a = "UPNP_UNKNOWN_EVENT";
        switch (b) {
            case 1000:
                a = "UPNP_SCAN_IN_PROGRESS";
                break;
            case 1001:
                a = "UPNP_SCAN_SUCCESS_SERVERS_FOUND";
                break;
            case 1002:
                a = "UPNP_SCAN_SUCCESS_NO_SERVERS_FOUND";
                break;
            case 1003:
                a = "UPNP_SCAN_FAILED";
                break
        }
        top.globalFireEvent(new top.Event(a))
    },
    pvrEventHandler: function (c, a) {
        var b = "PVR_UNKNOWN_EVENT";
        switch (c) {
            case 2501:
                b = "RECORDING_STOPPED";
                break;
            case 2502:
                b = "RECORDING_ERROR";
                break;
            case 2503:
                b = "LIMIT_SIZE_EXCEEDED";
                break
        }
        top.globalFireEvent(new top.Event(b, {
            assetId: a
        }))
    },
    listenerEventHandler: function (a) {
        top.globalFireEvent(new top.Event("NOTIFICATION", {
            message: a
        }))
    },
    setCurrentSubtitle: function (b) {
        try {
            top.kwConsole.print("Player.setCurrentSubtitle() :: " + b);
            if (b != "off") {
                VideoDisplay.SetSubtitles(1)
            } else {
                VideoDisplay.SetSubtitles(0)
            }
        } catch (a) {
        }
    },
};