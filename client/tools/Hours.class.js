var Hours = {
    hours: [],
    selectedHour: "00",
    currentIndex: 0,
    maxIndex: 0,
    init: function() {
        this.currentIndex = 0;
        this.maxIndex = 0;
        this.hours = [];
        var a = 0;
        this.hours[a] = "00";
        this.hours[++a] = "01";
        this.hours[++a] = "02";
        this.hours[++a] = "03";
        this.hours[++a] = "04";
        this.hours[++a] = "05";
        this.hours[++a] = "06";
        this.hours[++a] = "07";
        this.hours[++a] = "08";
        this.hours[++a] = "09";
        this.hours[++a] = "10";
        this.hours[++a] = "11";
        this.hours[++a] = "12";
        this.hours[++a] = "13";
        this.hours[++a] = "14";
        this.hours[++a] = "15";
        this.hours[++a] = "16";
        this.hours[++a] = "17";
        this.hours[++a] = "18";
        this.hours[++a] = "19";
        this.hours[++a] = "20";
        this.hours[++a] = "21";
        this.hours[++a] = "22";
        this.hours[++a] = "23";
        this.maxIndex = a;
    },
    setHour: function(a) {
        this.currentIndex = a;
        this.selectedHour = this.hours[a];
    },
    getSelectedHour: function() {
        return this.selectedHour;
    },
    getCurrentIndex: function() {
        return this.currentIndex;
    },
    getMaxIndex: function() {
        return this.maxIndex;
    }
};