var MediaManager = {
    isNewData: false,
    mediaArray: [],
    init: function (b) {},
    loadMediaData: function (b) {
        var c = top.MEDIA_URL + top.DEFAULT_LANGUAGE + "/format/json";
        top.kwUtils.kwXMLHttpRequest("GET", c, true, this, this.getMedia);
    },
    getMedia: function (a) {
        try {
            a = (typeof a === "object") ? a : eval(a);
            this.isNewData = true;
            var r = [];
            for (var d = 0; d < a.length; d++) {
                var c = new top.Media(a[d].pr_id, a[d].pr_type, a[d].pr_width, a[d].pr_height, a[d].pr_url, a[d].pr_duration);
                r.push(c);
            }
            this.mediaArray = r;
        } catch (e) {
            top.kwConsole.print("MEDIA_LOAD_ERROR");
        }
    },
    getMediaList: function () {
        return this.mediaArray;
    }
};