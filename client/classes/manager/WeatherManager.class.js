var WeatherManager = {data: [], isNewData: false, init: function (b) {
    }, loadFlag: function (b) {
        var c = "database/weather.json";
        if (top.FAKE_DATA == 0) {
            var c = top.WEATHER_URL + top.DEFAULT_LANGUAGE + "/format/json"
        } else {
            var c = "database/weather.json"
        }
        top.kwUtils.kwXMLHttpRequest("GET", c, true, top, this.loadData)
    }, loadData: function (a) {
        try {
            a = (typeof a === "object") ? a : eval(a);
            var r = [];
            for (var d = 0; d < a.length; d++) {
                var c = new Weather(a[d].city, a[d].weatherType, a[d].weatherImageURL, a[d].tmpHigh, a[d].tmpLow, a[d].day);
                r.push(c)
            }
            top.WeatherManager.isNewData = true;
            top.WeatherManager.data = r
        } catch (e) {
            top.kwConsole.print("WEATHER_LOAD_ERROR")
        }
    }, getData: function () {
        return top.WeatherManager.data
    }};