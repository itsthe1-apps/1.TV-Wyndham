var Minutes = {
    minutes: [],
    selectedMinute: "00",
    currentIndex: 0,
    maxIndex: 0,
    init: function() {
        this.currentIndex = 0;
        this.maxIndex = 0;
        this.minutes = [];
        var a = 0;
        this.minutes[a] = "00";
        this.minutes[++a] = "01";
        this.minutes[++a] = "02";
        this.minutes[++a] = "03";
        this.minutes[++a] = "04";
        this.minutes[++a] = "05";
        this.minutes[++a] = "06";
        this.minutes[++a] = "07";
        this.minutes[++a] = "08";
        this.minutes[++a] = "09";
        this.minutes[++a] = "10";
        this.minutes[++a] = "11";
        this.minutes[++a] = "12";
        this.minutes[++a] = "13";
        this.minutes[++a] = "14";
        this.minutes[++a] = "15";
        this.minutes[++a] = "16";
        this.minutes[++a] = "17";
        this.minutes[++a] = "18";
        this.minutes[++a] = "19";
        this.minutes[++a] = "20";
        this.minutes[++a] = "21";
        this.minutes[++a] = "22";
        this.minutes[++a] = "23";
        this.minutes[++a] = "24";
        this.minutes[++a] = "25";
        this.minutes[++a] = "26";
        this.minutes[++a] = "27";
        this.minutes[++a] = "28";
        this.minutes[++a] = "29";
        this.minutes[++a] = "30";
        this.minutes[++a] = "31";
        this.minutes[++a] = "32";
        this.minutes[++a] = "33";
        this.minutes[++a] = "34";
        this.minutes[++a] = "35";
        this.minutes[++a] = "36";
        this.minutes[++a] = "37";
        this.minutes[++a] = "38";
        this.minutes[++a] = "39";
        this.minutes[++a] = "40";
        this.minutes[++a] = "41";
        this.minutes[++a] = "42";
        this.minutes[++a] = "43";
        this.minutes[++a] = "44";
        this.minutes[++a] = "45";
        this.minutes[++a] = "46";
        this.minutes[++a] = "47";
        this.minutes[++a] = "48";
        this.minutes[++a] = "49";
        this.minutes[++a] = "50";
        this.minutes[++a] = "51";
        this.minutes[++a] = "52";
        this.minutes[++a] = "53";
        this.minutes[++a] = "54";
        this.minutes[++a] = "55";
        this.minutes[++a] = "56";
        this.minutes[++a] = "57";
        this.minutes[++a] = "58";
        this.minutes[++a] = "59";
        this.maxIndex = a;
    },
    setMinute: function(a) {
        this.currentIndex = a;
        this.selectedMinute = this.minutes[a];
    },
    getSelectedMinute: function() {
        return this.selectedMinute;
    },
    getCurrentIndex: function() {
        return this.currentIndex;
    },
    getMaxIndex: function() {
        return this.maxIndex;
    }
};