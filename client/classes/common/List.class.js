var ListType = {
    FIXED: 1,
    BLOCK: 2,
    SCROLL: 3,
    FIXED_CYCLIC: 11,
    BLOCK_CYCLIC: 12,
    SCROLL_CYCLIC: 13
};

function List(c, d, g, e, a, o, f) {
    this._type = c;
    this._data = d || [];
    this._iterator = new Iterator(g || 0, e || 0, (d ? d.length : 0), this._type > 10);
    this._displayCount = o || 0;
    this._selected = ((c < 10 && a > this.getIndex()) ? this.getIndex() : (a || 0));
    this._prevSelected = this._selected;
    this._uid = Math.floor(Math.random() * 100000);
    this._container = f
}
List.prototype.initList = function() {
    this.display()
};
List.prototype.getData = function() {
    return this._data || []
};
List.prototype.getChannelData = function() {
    return this._data || []
};
List.prototype.setData = function(g, c, a) {
    this._data = g || [];
    this._iterator = new Iterator(c || 0, a || 0, (g ? g.length : 0), this._type > 10);
    this._selected = 0
};
List.prototype.getDataLength = function() {
    return this._data ? this._data.length : 0
};
List.prototype.getContainer = function() {
    return this._container
};
List.prototype.setContainer = function(a) {
    this._container = a
};
List.prototype.getItem = function(a) {
    return this._data[((a !== undefined && a !== null) ? a : this.getIndex())]
};
List.prototype.getChannelItem = function(a) {
    return this._data[((a !== undefined && a !== null) ? a : this.getIndex())]
};
List.prototype.setItem = function(a, e) {
    this._data[((a !== undefined && a !== null) ? a : this.getIndex())] = e
};
List.prototype.getDisplayCount = function() {
    return this._displayCount
};
List.prototype.setDisplayCount = function(a) {
    this._displayCount = !isNaN(a) ? a : this._displayCount
};
List.prototype.isCyclic = function() {
    return this._iterator.isCyclic()
};
List.prototype.getSelected = function() {
    return this._selected
};
List.prototype.setSelected = function(e) {
    var a = Math.min(this._displayCount, this.getLength());
    this._prevSelected = this._selected;
    switch (this._type) {
        case ListType.BLOCK:
            this._selected = (this.getIndex() % a);
            break;
        case ListType.BLOCK_CYCLIC:
            this._selected = (this._selected + e + a) % a;
            break;
        case ListType.SCROLL:
        case ListType.SCROLL_CYCLIC:
            this._selected += e;
            if (this._selected < 0) {
                this._selected = 0
            } else {
                if (this._selected >= a) {
                    this._selected = a - 1
                }
            }
            break
    }
    return (this._selected != this._prevSelected)
};
List.prototype.getPrevSelected = function() {
    return this._prevSelected
};
List.prototype.getIndex = function() {
    return this._iterator.getIndex()
};
List.prototype.setIndex = function(a) {
    if (a != this._iterator.getIndex()) {
        if (this._iterator.setIndex(a)) {
            this.onIndexChanged()
        }
    }
};
List.prototype.getLength = function() {
    return this._iterator.getLength()
};
List.prototype.scrollUp = function(a) {
    try {
        if (this._iterator.decreaseIndex(a)) {
            this.setSelected(-1 * (a || 1));
            this.onIndexChanged(-1, a || 1)
        }
    } catch (c) {
        top.kwConsole.print("Exeption:" + c.message)
    }
};
List.prototype.scrollFirst = function() {
    if (this._iterator.setIndex(this._iterator._firstIndex)) {
        this.setSelected(-1 * (b || 1));
        this.onIndexChanged(-1, b || 1)
    }
};
List.prototype.scrollDown = function(a) {
    if (this._iterator.increaseIndex(a)) {
        this.setSelected(a || 1);
        this.onIndexChanged(1, a || 1)
    }
};
List.prototype.toString = function() {
    if (this.getLength() === 0) {
        return this.displayEmptyList()
    }
    var g = new Iterator(0, this.getIndex() - this.getSelected(), this.getLength(), this.isCyclic());
    var a = 0;
    var c = "";
    while (a < this.getDisplayCount()) {
        if (g.isChanged() && a < this.getLength()) {
            c += this.displayItem(g.getIndex(), a, a == this.getSelected());
            g.increaseIndex()
        } else {
            c += this.displayItem(-1, a, false)
        }
        a++
    }
    return c
};
List.prototype.initDisplay = function() {
    if (this._container) {
        this._container.innerHTML = this.toString()
    }
};
List.prototype.updateDisplay = function() {
    var a, e;
    if (this.getLength() == 0) {
        if (this._container) {
            this._container.innerHTML = this.displayEmptyList()
        }
        return
    }
    a = new Iterator(0, this.getIndex() - this.getSelected(), this.getLength(), this.isCyclic());
    e = 0;
    while (e < this._displayCount) {
        if (a.isChanged() && e < this.getLength()) {
            this.updateItem(a.getIndex(), e, e == this.getSelected());
            a.increaseIndex()
        } else {
            this.updateItem(-1, e, false)
        }
        e++
    }
};
List.prototype.display = function() {
    this.onBeforeDisplay();
    if (this.updateItem === null) {
        this.initDisplay()
    } else {
        this.updateDisplay()
    }
    this.onAfterDisplay()
};
List.prototype.eval = function(a, d, i) {
    var c = (i !== undefined) ? i : "";
    if (a != null && a[d] != null) {
        c = a[d]
    }
    return c
};
List.prototype.displayEmptyList = function() {
    return ""
};
List.prototype.displayItem = function(g, c, a) {
    return false
};
List.prototype.onIndexChanged = function() {
    this.display()
};
List.prototype.updateItem = null;
List.prototype.onSelectedChanged = function() {};
List.prototype.onBeforeDisplay = function() {};
List.prototype.onAfterDisplay = function() {};