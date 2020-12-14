var State = {
    MENU_LANG: 5,
    MENU_MAIN: 10,
    FSV_LIVE: 15,
    FSV_VOD: 20,
    CH_LIST_MAIN: 25,
    CH_FAVLIST_MAIN: 26,
    VOD_LIST_MAIN: 30,
    VOD_SUBMENU: 35,
    VOD_PLAYMENU: 40,
    CH_SUBMENU: 45,
    VOD_CHOOSER_ALPHA: 50,
    VOD_CHOOSER_GENRE: 55,
    CH_CHOOSER_ALPHA: 60,
    CH_CHOOSER_GENRE: 65,
    RESTRNT_LIST_MAIN: 70,
    RESTRNT_SUBMENU: 75,
    RESTRNT_DETAIL: 80,
    RESTRNT_FOODMENU: 85,
    RESTRNT_ORDER: 90,
    MESSAGE_LIST_MAIN: 95,
    EPG_MAIN: 100,
    BROWSER: 105,
    RADIO_LIST: 110,
    SPA_LIST_MAIN: 126,
    EXP_LIST_MAIN: 112,
    SERVICE_LIST: 115,
    SERVICELIST_MAIN: 116,
    SERVICE_ORDER: 120,
    LOCAL_LIST_MAIN: 125,
    NEWSPROMO_LIST_MAIN: 127,
    LOCAL_DETAIL: 130,
    LOCAL_FOODMENU: 135,
    ROOM_KEEPER: 140,
    ROOM_ORDER: 145,
    ROOM_LIST: 150,
    RADIO_LIST_MAIN: 160,
    RADIO_SUBMENU: 170,
    RADIO_CHOOSER_ALPHA: 180,
    RADIO_CHOOSER_GENRE: 190,
    ROOM_EXIT: 200,
    INTERNET_CHOOSER_GENRE: 210,
    INTERNET_WEB: 130,
        _current: null,
    _previous: null,
    setState: function(b) {
        if (b != this._current) {
            this._previous = this._current;
            this._current = b
        }
        return b
    },
    getState: function() {
        return this._current
    },
    getPreviousState: function() {
        return this._previous
    }
};