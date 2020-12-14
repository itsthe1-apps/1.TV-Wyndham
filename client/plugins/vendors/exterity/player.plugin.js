var Player = {
    isSTB: true,
//    player: (typeof (document.createExterityPlayer()) == "function" ? document.createExterityPlayer() : {}),
    player: (typeof document.createExterityPlayer == 'function') ? document.createExterityPlayer() : {},
    conf: (typeof document.createExterityOutputConfig == 'function') ? document.createExterityOutputConfig() : {},
    currentMrl: "",
    currentState: null,
    playerSpeed: [2, 4, 8, 16, 32],
    playerSpeedIndex: 0,
    init: function () {
        //alert("I am inited");
        try {
//            this.player = document.createExterityPlayer();
            if (typeof (opera) != "undefined") {
                opera.disableorigincheck(document, true);
            }
            this.setChromaKey(0);
            top.kwConsole.print("Player.init() done");
        } catch (a) {
            top.kwConsole.print("Player.init() error :: " + a.message)
        }
    },
    getPlayerHtml: function () {
        return""
    },
    getPlayerState: function () {
        return this.currentState
    },
    setPlayerState: function (a) {
        top.kwConsole.print("Player.setPlayerState() " + a);
        this.currentState = a
    },
    getVolume: function () {
        try {
            return this.conf.getVolume()
        } catch (a) {
            top.kwConsole.print("getVolume error :: " + a.message);
            return 0
        }
    },
    setVolume: function (b) {
        try {
            b = b > 40 ? 40 : b;
            b = b < 0 ? 0 : b;
            this.conf.setVolume(b)
        } catch (a) {
            top.kwConsole.print("setVolume error :: " + a.message)
        }
    },
    toggleMute: function () {
        try {
            //this.player.setMute(!this.conf.isMute())
            this.conf.setMute(!this.conf.getMute())
        } catch (a) {
            top.kwConsole.print("toggleMute error :: " + a.message)
        }
    },
    getIpAddress: function () {
        try {
            return (typeof configread === 'undefined') ? "000.000.000.000" : configread("IPAddress")
        } catch (a) {
            top.kwConsole.print("rtvGetIp error :: " + a.message);
            return"000.000.000.000"
        }
    },
    getMacAddress: function () {
        try {
            return (typeof configread === 'undefined') ? "00:00:00:00:00:00" : configread("mac");
        } catch (a) {
            top.kwConsole.print("rtvGetMacAddress error :: " + a.message);
            return"00:00:00:00:00:00"
        }
    },
    getSerialNumber: function () {
        try {
            return (typeof configread === 'undefined') ? "000000000000" : configread("boardNumber");
        } catch (a) {
            top.kwConsole.print("rtvGetSerialNumber error :: " + a.message);
            return"000000000000"
        }
    },
    getStoredData: function (a) {
        try {
            return this.player.getStorageValue(a)
        } catch (b) {
            top.kwConsole.print("Player.getStoredData() error :: " + b.message)
        }
    },
    setStoredData: function (a, b) {
        try {
            return this.player.setStorageValue(a, b)
        } catch (c) {
            top.kwConsole.print("Player.setStoredData() error :: " + c.message)
        }
    },
    loadUrl: function (a) {
        try {
            // return this.player.loadUrl(a)
            this.document.location.href = a;
        } catch (b) {
            top.kwConsole.print("Player.loadUrl() error :: " + b.message)
        }
    },
    stop: function () {
        try {
            this.setPlayerState("IDLE");
            this.player.stop();
            this.currentMrl = "";
            this.playerSpeedIndex = 0
        } catch (a) {
            top.kwConsole.print("Player.stop() error :: " + a.message);
        }
    },
    play: function (b) {
        top.kwConsole.print("Player Play :: Player.play() :: " + b);
        var a = null;
        try {
            if (b != this.currentMrl) {
                this.setPlayerState("PLAYING");
                a = this.player.play(b);
                if (a) {
                    this.currentMrl = b;
                    this.setPlayerState("PLAYING");
                } else {
                    this.currentMrl = "";
                }
            }
        } catch (c) {
            top.kwConsole.print("Player.play() error :: " + c.message);
        }
    },
    pause: function () {
        try {
            if (this.getPlayerState() === "PAUSED") {
                this.resume();
            } else
            {
                this.setPlayerState("PAUSED");
                this.player.pause();
                this.playerSpeedIndex = 0;
            }
        } catch (a) {
            top.kwConsole.print("Player.pause() error :: " + a.message);
        }
    },
    resume: function () {
        try {
            //jkthis.player.resume();
            this.setPlayerState("PLAYING");
            this.playerSpeedIndex = 0
            this.player.play();
        } catch (a) {
            top.kwConsole.print("Player.resume() error :: " + a.message)
        }
    },
    rewind: function (b) {
        try {
            var a = b || this.playerSpeed[(this.playerSpeedIndex == (this.playerSpeed.length - 1) ? this.playerSpeedIndex : this.playerSpeedIndex++)];
            top.kwConsole.print("rewind :: " + a);
            this.setPlayerState("REWIND")
            this.player.rewind(-1 * a);
        } catch (c) {
            top.kwConsole.print("Player.rewind() error :: " + c.message)
        }
    },
    fforward: function (b) {
        try {
            var a = b || this.playerSpeed[(this.playerSpeedIndex == (this.playerSpeed.length - 1) ? this.playerSpeedIndex : this.playerSpeedIndex++)];
            top.kwConsole.print("fforward :: " + a);
            this.setPlayerState("FFORWARD")
            this.player.fastForward(a);
        } catch (c) {
            top.kwConsole.print("Player.fforward() error :: " + c.message)
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
            a = this.player.getPosition()
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
            b = this.player.getStreamDuration()
        } catch (a) {
            top.kwConsole.print("Player.getDuration() error :: " + a.message)
        }
        return b
    },
    setClipScreen: function (t, l, w, h) {
        if (this.player) {
            try {
                top.kwConsole.print("Player.setClipScreen() :: loaded");
                //top.kwConsole.print("Player.setClipScreen() :: top=" + t + ", left=" + l + ", width=" + w + ", height=" + h);
                //this.player.setVideoSize(false,b,f,c,a)
                if (top.getFrameDocument().getElementById("player")) {
                    top.kwConsole.print("Player.setClipScreen() :: setClipScreen");
                    top.getFrameDocument().getElementById("player").style.width = w + 'px';
                    top.getFrameDocument().getElementById("player").style.height = h + 'px';
                    top.getFrameDocument().getElementById("player").style.left = l + 'px';
                    top.getFrameDocument().getElementById("player").style.top = t + 'px';
                }
            } catch (d) {
                top.kwConsole.print("Player.setClipScreen() error :: " + d.message);
                result = false
            }
        }
    },
    setFullScreen: function () {
        if (this.player) {
            try {
                //this.player.setVideoSize(true)
                if (top.getFrameDocument().getElementById("player")) {
                    top.getFrameDocument().getElementById("player").style.width = top.globalGetScreenWidthByResolution() + 'px';
                    top.getFrameDocument().getElementById("player").style.height = top.globalGetScreenHeightByResolution() + 'px';
                    top.getFrameDocument().getElementById("player").style.left = '0px';
                    top.getFrameDocument().getElementById("player").style.top = '0px';
                }
            } catch (a) {
                result = false
            }
        }
    },
    getBrowserResolution: function () {
        var a = "";
        var b = (typeof configread === 'undefined') ? "720p60" : configread("screenResolution");
        switch (b) {
            case "720p60":
            case "720p50":
                a = "720P";
                break;
            case "1080p60":
            case "1080p50":
            case "1080i60":
            case "1080i50":
                a = "1080I";
                break;
        }
        //top.kwConsole.print("Player.getBrowserResolution() value :: "+a)
        return a
    },
    isWiredConnection: function () {
        var a = false;
        try {
            a = this.player.checkWiredConnection()
        } catch (b) {
            a = false
        }
        return a
    },
    setAlphaLevel: function (b) {
        try {
            this.player.setAlpha(b)
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
            this.player.setChromaKey(a)
        } catch (b) {
        }
    },
    reboot: function () {
        try {
            this.player.reboot()
        } catch (a) {
        }
    },
    printDebugMessage: function (b) {
        try {
            this.player.debugMsg(b, 3)
        } catch (a) {
        }
    },
    getChannelChangeTime: function () {
        var a = 0;
        try {
            a = this.player.getChannelChangeTime()
        } catch (b) {
        }
        return a
    },
    getAudioList: function () {
        var a = [];
        try {
            a = top.jsonParser(this.player.getAudioIDList())
        } catch (b) {
        }
        return a
    },
    getCurrentAudio: function () {
        var a = null;
        try {
            a = this.player.getAudioID()
        } catch (b) {
        }
        return a
    },
    setCurrentAudio: function (b) {
        try {
            top.kwConsole.print("Player.setCurrentAudio() :: " + b);
            this.player.setAudioID(b)
        } catch (a) {
        }
    },
    getSubtitleList: function () {
        var a = [];
        try {
            a = top.jsonParser(this.player.getSubtitleIDList())
        } catch (b) {
        }
        return a
    },
    getCurrentSubtitle: function () {
        var a = null;
        try {
            a = this.player.getSubtitleID()
        } catch (b) {
        }
        return a
    },
    setCurrentSubtitle: function (b) {
        try {
            top.kwConsole.print("Player.setCurrentSubtitle() :: " + b);
            if (b != "off") {
                this.player.setSubtitleID(b)
            } else {
                this.removeSubtitles()
            }
        } catch (a) {
        }
    },
    removeSubtitles: function () {
        try {
            this.player.removeSubtitles()
        } catch (a) {
        }
    },
    getSoftwareVersion: function () {
        var a = "0000";
        try {
            a = this.player.getSoftwareVersion()
        } catch (b) {
        }
        return a
    },
    setUpgradeParameters: function (c, b) {
        var a = false;
        top.kwConsole.print("Player.upgrade setUpgradeParameters type :: " + c + ", url :: " + b);
        try {
            a = this.player.setUpgradeParameters(parseInt(c), b)
        } catch (d) {
            top.kwConsole.print("Player.upgrade setUpgradeParameters :: " + d.message)
        }
        return a
    },
    upgrade: function () {
        var a = false;
        try {
            a = this.player.upgrade()
        } catch (b) {
            top.kwConsole.print("Player.upgrade error :: " + b.message)
        }
        return a
    },
    addSubtitleURL: function (b, d) {
        var a = false;
        try {
            a = this.player.addSubtitleURL(b, d)
        } catch (c) {
            a = 0
        }
        return a
    },
    setSubtitleURL: function (c) {
        var a = false;
        try {
            a = this.player.setSubtitleURL(c)
        } catch (b) {
            a = 0
        }
        return a
    },
    upnpInit: function () {
        var a = false;
        try {
            a = this.player.UPnPInit()
        } catch (b) {
            a = 0
        }
        return a
    },
    upnpUninit: function () {
        var a = false;
        try {
            a = this.player.UPnPUninit()
        } catch (b) {
            a = 0
        }
        return a
    },
    upnpScanDevices: function () {
        var a = false;
        try {
            a = this.player.UPnPScanDevices()
        } catch (b) {
        }
        return a
    },
    upnpGetDevicesList: function () {
        var a = null;
        try {
            a = this.player.UPnPGetDevices()
        } catch (b) {
        }
        return a
    },
    upnpBrowseDevice: function (b, d) {
        var a = null;
        try {
            a = this.player.UPnPBrowseDevice(b, d)
        } catch (c) {
        }
        return a
    },
    upnpGetMetadata: function (c, b) {
        var a = null;
        try {
            a = this.player.UPnPGetMetadata(c, b)
        } catch (d) {
        }
        return a
    },
    browseLocalDevice: function (c) {
        var a = null;
        try {
            a = this.player.browseLocalDevice(c)
        } catch (b) {
        }
        return a
    },
    startAutoScan: function () {
        var a = false;
        try {
            a = this.player.startScan(top.DVB_AUTO_SCAN_START_FREQUENCY, top.DVB_AUTO_SCAN_END_FREQUENCY, top.DVB_AUTO_SCAN_BANDWIDTH)
        } catch (b) {
        }
        return a
    },
    startManualScan: function () {
        var a = false;
        try {
            a = this.player.manualScan(top.DVB_MANUAL_SCAN_FREQUENCY, top.DVB_MANUAL_SCAN_BANDWIDTH)
        } catch (b) {
        }
        return a
    },
    stopScan: function () {
        var a = false;
        try {
            a = this.player.stopScan()
        } catch (b) {
        }
        return a
    },
    getSignalQuality: function () {
        var a = null;
        try {
            a = this.player.getSignalQuality()
        } catch (b) {
        }
        return a
    },
    getScanFrequency: function () {
        var a = null;
        try {
            a = this.player.getScanFrequency()
        } catch (b) {
        }
        return a
    },
    getScanProgress: function () {
        var a = null;
        try {
            a = this.player.getScanProgress()
        } catch (b) {
        }
        return a
    },
    isChannelsStored: function () {
        var a = false;
        try {
            a = this.player.isChannelsStored();
            top.kwConsole.print("isChannelsStored :: " + a)
        } catch (b) {
        }
        return a
    },
    storeScannedChannels: function () {
        var a = null;
        try {
            a = this.player.storeScannedChannels()
        } catch (b) {
        }
        return a
    },
    getStoredChannels: function () {
        var a = null;
        try {
            a = this.player.readStoredChannels()
        } catch (b) {
        }
        return a
    },
    deleteStoredChannels: function () {
        var a = false;
        try {
            a = this.player.deleteSavedChannels()
        } catch (b) {
        }
        return a
    },
    getPresentEvent: function (b) {
        var a = false;
        try {
            a = this.player.getPresentEvent(b)
        } catch (c) {
        }
        return a
    },
    getNextEvent: function (b) {
        var a = false;
        try {
            a = this.player.getNextEvent(b)
        } catch (c) {
        }
        return a
    },
    getAllScheduleEvents: function (b) {
        var a = false;
        try {
            a = this.player.getAllScheduleEvents(b)
        } catch (c) {
        }
        return a
    },
    wirelessInit: function () {
        var a = false;
        try {
            a = this.player.initWireless()
        } catch (b) {
            a = 0
        }
        return a
    },
    wirelessActivateListener: function () {
        var a = false;
        try {
            a = this.player.onWirelessEvent(this.wirelessEventHandler)
        } catch (b) {
            a = false
        }
        return a
    },
    wirelessUninit: function () {
        var a = false;
        try {
            a = this.player.uninitWireless()
        } catch (b) {
            a = false
        }
        return a
    },
    wirelessIsConfigExists: function () {
        var a = false;
        try {
            a = this.player.checkWirelessConfig()
        } catch (b) {
            a = 1
        }
        return a
    },
    wirelessResetExistingConfig: function () {
        var a = false;
        try {
            a = this.player.resetWirelessConfig()
        } catch (b) {
            a = false
        }
        return a
    },
    wirelessGetStatus: function () {
        var a = false;
        try {
            a = this.player.getWirelessStatus()
        } catch (b) {
            a = false
        }
        return a
    },
    wirelessReconnect: function () {
        var a = false;
        try {
            a = this.player.reconnectWireless()
        } catch (b) {
            a = false
        }
        return a
    },
    wirelessDisconnect: function () {
        var a = false;
        try {
            a = this.player.disconnectWireless()
        } catch (b) {
            a = false
        }
        return a
    },
    wirelessInitWPS: function () {
        var a = false;
        try {
            a = this.player.initWPS()
        } catch (b) {
            a = false
        }
        return a
    },
    wirelessConnectWPS: function () {
        var a = false;
        try {
            a = this.player.connectWirelessWPS()
        } catch (b) {
            a = false
        }
        return a
    },
    wirelessScan: function () {
        var a = false;
        try {
            a = this.player.scanWirelessAP()
        } catch (b) {
        }
        return a
    },
    wirelessGetNetworkList: function (b) {
        var a = false;
        try {
            a = this.player.getWirelessAPList(b || 0)
        } catch (c) {
            a = "test"
        }
        return a
    },
    wirelessGetSecurityTypeByName: function (a) {
        var b = null;
        switch (a.toUpperCase()) {
            case"NONE":
                b = 0;
                break;
            case"WEP64":
                b = 1;
                break;
            case"WEP128":
                b = 2;
                break;
            case"WPA":
                b = 5;
                break;
            case"WPA2":
                b = 6;
                break
        }
        return b
    },
    wirelessManualConnect: function (f, d, b) {
        var a = false;
        try {
            a = this.player.connectWirelessManual(f, d, b)
        } catch (c) {
        }
        return a
    },
    startPltv: function () {
        var a = false;
        try {
            a = this.player.pltvRecord(true, top.PLTV_BUFFER_SIZE)
        } catch (b) {
        }
        return a
    },
    stopPltv: function () {
        var a = false;
        try {
            a = this.player.pltvRecord(false)
        } catch (b) {
        }
        return a
    },
    startRecording: function (b, c, g, h, f) {
        var a = false;
        try {
            a = this.player.record(b, c, g, h, f);
            top.kwConsole.print("Player.startRec() :: " + c + ", " + g + ", result : " + a);
            if (a == 0) {
                this.setPlayerState("RECORD")
            }
        } catch (d) {
        }
        return a
    },
    stopRecording: function (c) {
        var a = false;
        try {
            a = this.player.stopRecording(c);
            top.kwConsole.print("Player.stoptRecording() :: " + c + ", result : " + a);
            if (a == 0) {
                this.setPlayerState("IDLE")
            }
        } catch (b) {
        }
        return a
    },
    getRecordVolumesList: function () {
        var a = [];
        try {
            a = this.player.getRecordingVolumeList();
            top.kwConsole.print("Player.getRecordVolumesList() :: " + a)
        } catch (b) {
        }
        return a
    },
    getOngoingRecording: function (c) {
        var a = null;
        try {
            if (c) {
                a = this.player.getRecordingStatusList(c)
            } else {
                a = this.player.getRecordingStatusList()
            }
            top.kwConsole.print("Player.getOngoingRecording() :: " + a)
        } catch (b) {
        }
        return a
    },
    getFinishedRecording: function (c) {
        var a = null;
        try {
            if (c) {
                a = this.player.getRecordingList(c)
            } else {
                a = this.player.getRecordingList()
            }
        } catch (b) {
        }
        return a
    },
    deleteRecording: function (c) {
        var a = false;
        try {
            a = this.player.deleteRecording(c)
        } catch (b) {
        }
        return a
    },
    deleteAllRecordings: function (b) {
        var a = false;
        try {
            a = this.player.deleteAllRecordings(b)
        } catch (c) {
        }
        return a == 0
    },
    lockRecording: function (d, b) {
        var a = false;
        try {
            a = this.player.lockRecording(d, b)
        } catch (c) {
        }
        return a == 0
    },
    getFinishedRecordingsCountByVolume: function (b) {
        var a = [];
        try {
            a = this.player.getNumOfRecordings(b)
        } catch (c) {
        }
        return a
    },
    getVolumeLimit: function (b) {
        var a = false;
        try {
            a = this.player.getVolumeLimit(b)
        } catch (c) {
        }
        return a
    },
    setVolumeLimit: function (b, c) {
        var a = false;
        try {
            a = this.player.setVolumeLimit(b, c)
        } catch (d) {
        }
        return a == 0
    },
    wirelessEventHandler: function (b) {
        var a = "";
        switch (b) {
            case 0:
                a = "WIRELESS_EVENT_WPS_SUCCESS";
                break;
            case 1:
                a = "WIRELESS_EVENT_WPS_IN_PROGRESS";
                break;
            case 2:
                a = "WIRELESS_EVENT_WPS_FAILED";
                break;
            case 3:
                a = "WIRELESS_EVENT_CONNECTION_SUCCESS";
                break;
            case 4:
                a = "WIRELESS_EVENT_CONNECTION_IN_PROGRESS";
                break;
            case 5:
                a = "WIRELESS_EVENT_SEARCHING_IN_PROGRESS";
                break;
            case 6:
                a = "WIRELESS_EVENT_AUTHENTICATING_IN_PROGRESS";
                break;
            case 7:
                a = "WIRELESS_EVENT_CONNECTION_FAILED";
                break;
            case 8:
                a = "WIRELESS_EVENT_DISCONNECTED_SUCCESS";
                break;
            case 9:
                a = "WIRELESS_EVENT_DISCONNECTION_IN_PROGRESS";
                break;
            case 10:
                a = "WIRELESS_EVENT_AP_SCAN_FAILED";
                break;
            case 11:
                a = "WIRELESS_EVENT_AP_SCAN_SUCCESS";
                break;
            case 12:
                a = "WIRELESS_EVENT_AP_SCAN_IN_PROGRESS";
                break;
            default:
                a = "UNKNOWN_PLUGIN_EVENT_" + b;
                break
        }
        top.globalFireEvent(new top.Event(a))
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
    pvrEventHandler: function (b, c) {
        var a = "PVR_UNKNOWN_EVENT";
        switch (b) {
            case 2501:
                a = "RECORDING_STOPPED";
                break;
            case 2502:
                a = "RECORDING_ERROR";
                break;
            case 2503:
                a = "LIMIT_SIZE_EXCEEDED";
                break
        }
        top.globalFireEvent(new top.Event(a, {
            assetId: c
        }))
    },
    listenerEventHandler: function (a) {
        top.globalFireEvent(new top.Event("NOTIFICATION", {
            message: a
        }))
    }
};