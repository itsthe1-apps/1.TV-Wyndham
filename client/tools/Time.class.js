var Time = {
    times: [],
    selectedTime: "00:00",
    currentIndex: 0,
    maxIndex: 0,
    init: function() {
        this.currentIndex = 0;
        this.maxIndex = 0;
        this.times = [];
        var a = 0;
        this.times[a] = "00:00";
        this.times[++a] = "00:30";
        this.times[++a] = "01:00";
        this.times[++a] = "01:30";
        this.times[++a] = "02:00";
        this.times[++a] = "02:30";
        this.times[++a] = "03:00";
        this.times[++a] = "03:30";
        this.times[++a] = "04:00";
        this.times[++a] = "04:30";
        this.times[++a] = "05:00";
        this.times[++a] = "05:30";
        this.times[++a] = "06:00";
        this.times[++a] = "06:30";
        this.times[++a] = "07:00";
        this.times[++a] = "07:30";
        this.times[++a] = "08:00";
        this.times[++a] = "08:30";
        this.times[++a] = "09:00";
        this.times[++a] = "09:30";
        this.times[++a] = "10:00";
        this.times[++a] = "10:30";
        this.times[++a] = "11:00";
        this.times[++a] = "11:30";
        this.times[++a] = "12:00";
        this.times[++a] = "12:30";
        this.times[++a] = "13:00";
        this.times[++a] = "13:30";
        this.times[++a] = "14:00";
        this.times[++a] = "14:30";
        this.times[++a] = "15:00";
        this.times[++a] = "15:30";
        this.times[++a] = "16:00";
        this.times[++a] = "16:30";
        this.times[++a] = "17:00";
        this.times[++a] = "17:30";
        this.times[++a] = "18:00";
        this.times[++a] = "18:30";
        this.times[++a] = "19:00";
        this.times[++a] = "19:30";
        this.times[++a] = "20:00";
        this.times[++a] = "20:30";
        this.times[++a] = "21:00";
        this.times[++a] = "21:30";
        this.times[++a] = "22:00";
        this.times[++a] = "22:30";
        this.times[++a] = "23:00";
        this.times[++a] = "23:30";
        this.maxIndex = a
    },
    setTime: function(a) {
        this.currentIndex = a;
        this.selectedTime = this.times[a]
    },
    getSelectedTime: function() {
        return this.selectedTime
    },
    getCurrentIndex: function() {
        return this.currentIndex
    },
    getMaxIndex: function() {
        return this.maxIndex
    }
};