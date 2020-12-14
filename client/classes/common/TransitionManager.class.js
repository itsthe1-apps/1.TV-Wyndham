var TransitionManager = {
    _element: null,
    _runTimeout: 80,
    run: function (d, f, e) {
        this._element = e;
        this._run(d, f)
    },
    runX: function (d, f, e) {
        this._element = e;
        this._runX(d, f)
    },
    runX2: function (d, f, e) {
        this._element = e;
        this._runX2(d, f)
    },
    stop: function () {
        top.kwTimer.cancelTimer("TRANSITION_RUN")
    },
    _run: function (d, f, e) {
        this._element ? this._element.style.top = d + "px" : null
    },
    _runX2: function (d, f, e) {
        if (top.DEFAULT_DIRECTION == "ltr") {
            this._element ? this._element.style.left = d + "px" : null
        } else {
            this._element ? this._element.style.right = d + "px" : null
        }
    },
    _runX: function (d, f, e) {
        top.kwTimer.cancelTimer("TRANSITION_RUN");
        if (!e) {
            e = d + (10 * f)
        }
        if (top.DEFAULT_DIRECTION == "ltr") {
            this._element ? this._element.style.left = e + "px" : null
        } else {
            this._element ? this._element.style.right = e + "px" : null
        }
        if (e == d) {
            this._element = null
        } else {
            top.kwTimer.setTimer("TRANSITION_RUN", {
                scope: this,
                callback: this._runX,
                args: [d, f, (e + (-2 * f))]
            }, this._runTimeout)
        }
    }
};