function ClockBlock(e, g, d, f, a) {
    this.id = e || "";
    this.Country = g || "";
    this.timediff = d || "+";
    this.timeH = f || 0;
    this.timeM = a || 0
}
var ClockManager = {
    clockArray: [],
    blocks: [],
    init: function() {
        this.loadClock()
    },
    loadClock: function() {
        top.DataManager.loadClockData();
        top.kwTimer.setTimer("LOAD_CLOCK", {
            scope: this,
            callback: this.loadClock
        }, top.CLOCK_LOAD_TIMEOUT)
    },
    setClock: function(a) {
        if (typeof a == "undefined" || a.length == 0) {
            this.clockArray = eval(top.fakeClock)
        } else {
            this.clockArray = a
        }
        if (this.clockArray.clocks) {
            this.blocks = [];
            for (var a = 0; a < this.clockArray.clocks.clock.length; a++) {
                b = new ClockBlock(this.clockArray.clocks.clock[a].id, this.clockArray.clocks.clock[a].Country, this.clockArray.clocks.clock[a].timediff, this.clockArray.clocks.clock[a].timeH, this.clockArray.clocks.clock[a].timeM);
                this.blocks.push(b)
            }
        }
        top.WeatherManager.init()
    },
    resetBlocks: function() {
        this.blocks = []
    },
    getBlocks: function() {
        return this.blocks
    },
    getLength: function() {
        return this.blocks.length
    }
};