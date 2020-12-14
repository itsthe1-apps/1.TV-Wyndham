var TickerTapeManager = {isNewData: true, data: [], tickerStr: "", init: function (b) {
    }, loadFlag: function (b) {
        var c = "database/ticker.json";
        if (top.FAKE_TICKER == 1) {
            c = "database/ticker.json";
        } else {
            if (top.FAKE_DATA == 0) {
                c = top.TTAPE_URL + top.DEFAULT_LANGUAGE + "/format/json";
            }
        }
        top.kwUtils.kwXMLHttpRequest("GET", c, true, this, this.loadData);
    }, loadData: function (a) {
        try {
            this.data = (typeof a === "object") ? a : eval(a);
            this.generateString();
        } catch (e) {
            top.kwConsole.print("TTAPE_LOAD_ERROR");
        }
    }, getData: function () {
        return this.data;
    }, generateString: function () {
        for (var b = 0; b < this.getData().length - 1; b++) {
            this.tickerStr += "    " + top.TickerTapeManager.getData()[b].title + "           ";
        }
        this.isNewData = true;
    }};