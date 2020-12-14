if (typeof(XMLHttpRequest) == "undefined") {
    if (typeof(ActiveXObject) != "undefined") {
        XMLHttpRequest = function () {
            return new ActiveXObject("Microsoft.XMLHTTP")
        }
    }
}
var kwUtils = {
    kwXMLHttpRequestToken: function (r, q, p, j, k, l) {
        var n = new XMLHttpRequest();
        var o = null;
        var m = q.split("?");
        n.open(r, m[0], p);
        n.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        //n.setRequestHeader("Content-length", (m[1] ? m[1].length : 0));
        //n.setRequestHeader("Connection", "close");
        n.setRequestHeader("Access-Control-Allow-Origin", "*");
        if (typeof(k) == "function") {
            n.onreadystatechange = function () {
                if (n.readyState == 4) {
                    if (typeof(k) == "function") {
                        if (n.status == 200 || n.status == 304 || n.status === 0) {
                            if (typeof(n.responseText) === "string" && (!l || !l.responseXML)) {
                                o = n.responseText
                            } else {
                                if (typeof(n.responseXML) === "object") {
                                    o = n.responseXML
                                }
                            }
                        } else {
                            o = {error: "XML HTTP error", message: "XML HTTP error " + n.status}
                        }
                        k.call(j, o, l)
                    }
                    delete n.onreadystatechange;
                    n.onreadystatechange = null
                }
            }
        }
        n.send((r == "POST" ? (m[1] ? m[1] : "") : null))
    }, kwXMLHttpRequest: function (r, q, p, j, k, l) {
        var n = new XMLHttpRequest();
        var o = null;
        var m = q.split("?");
        if (r === "POST") {
            try {
                n.open(r, m[0], p);
                n.setRequestHeader("Content-Type", "Application/x-www-form-urlencoded");
                //n.setRequestHeader("Content-length", (m[1] ? m[1].length : 0));
                n.setRequestHeader("Access-Control-Allow-Credentials", "True");
                n.setRequestHeader("Access-Control-Allow-Origin", "*");
                n.setRequestHeader("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE");
                //n.setRequestHeader("Connection", "close")
            } catch (n) {
                x = n
            }
        } else {
            n.open(r, q, p);
            n.setRequestHeader("Access-Control-Allow-Credentials", "True");
            n.setRequestHeader("Access-Control-Allow-Origin", "*");
            n.setRequestHeader("Access-Control-Allow-Methods", "GET, POST, PUT, DELETE");
            //n.setRequestHeader("Connection", "close")
        }
        if (q.substr(q.lastIndexOf(".") + 1) == "xml") {
            n.setRequestHeader("Content-Type", "text/xml; charset=utf-8")
        }
        if (typeof(k) == "function") {
            n.onreadystatechange = function () {
                if (n.readyState == 4) {
                    if (typeof(k) == "function") {
                        if (n.status == 200 || n.status == 304 || n.status === 0) {
                            if (typeof(n.responseText) === "string" && (!l || !l.responseXML)) {
                                o = n.responseText
                            } else {
                                if (typeof(n.responseXML) === "object") {
                                    o = n.responseXML
                                }
                            }
                        } else {
                            o = {error: "XML HTTP error", message: "XML HTTP error " + n.status}
                        }
                        k.call(j, o, l)
                    }
                    delete n.onreadystatechange;
                    n.onreadystatechange = null
                }
            }
        }
        n.send((r == "POST" ? (m[1] ? m[1] : "") : null))
    }, kwXpathLoadXmlFormFile: function (g, e, i) {
        var j = null;
        if (window.ActiveXObject) {
            try {
                j = new ActiveXObject("Microsoft.XMLDOM");
                j.async = false;
                j.load(g);
                i.call(e, j)
            } catch (k) {
                top.kwConsole.print("kwXpathLoadXmlFormFile error :: xml parser error :: " + k.message)
            }
        } else {
            try {
                j = document.implementation.createDocument("", "", null);
                j.load(g);
                j.onload = function () {
                    i.call(e, j)
                }
            } catch (h) {
                top.kwConsole.print("kwXpathLoadXmlFormFile error :: xml parser error :: " + h.message)
            }
        }
    }, kwXpathLoadXmlFormString: function (k, e, j) {
        var l = null;
        if (window.ActiveXObject) {
            try {
                l = new ActiveXObject("Microsoft.XMLDOM");
                l.async = false;
                l.load(k);
                j.call(e, l)
            } catch (m) {
                top.kwConsole.print("kwXpathLoadXmlFormString error :: xml parser error :: " + m.message)
            }
        } else {
            try {
                var i = new DOMParser();
                var n = new XMLSerializer();
                var k = n.serializeToString(k);
                l = i.parseFromString(k, "text/xml");
                j.call(e, l)
            } catch (m) {
                top.kwConsole.print("kwXpathLoadXmlFormString error :: xml parser error :: " + m.message)
            }
        }
    }, kwXpathGetSingleNode: function (h, j) {
        var f = null;
        if (window.ActiveXObject) {
            f = j.selectSingleNode(h)
        } else {
            var i = new XPathEvaluator();
            var g = i.createNSResolver(j.ownerDocument === null ? j.documentElement : j.ownerDocument.documentElement);
            f = i.evaluate(h, j, g, XPathResult.STRING_TYPE, null)
        }
        return f
    }, kwXpathGetNodes: function (k, n) {
        var o = [];
        var p = null;
        var l = null;
        if (window.ActiveXObject) {
            l = n.selectNodes(k);
            for (var i = 0; i < l.length; i++) {
                o.push(l.item(i))
            }
        } else {
            var m = new XPathEvaluator();
            var j = m.createNSResolver(n.ownerDocument == null ? n.documentElement : n.ownerDocument.documentElement);
            var l = m.evaluate(k, n, j, XPathResult.UNORDERED_NODE_ITERATOR_TYPE, null);
            while (p = l.iterateNext()) {
                o.push(p)
            }
        }
        return o
    }, kwXpathGetNodeContent: function (c) {
        var d = "";
        if (c.textContent) {
            d = c.textContent
        } else {
            if (c.text) {
                d = c.text
            }
        }
        return d
    }, kwImportJavascriptFile: function (f, e) {
        var d = document.createElement("script");
        d.type = "text/javascript";
        d.src = e;
        f = f || this;
        f.document.getElementsByTagName("head")[0].appendChild(d)
    }, kwImportCSSFile: function (f, e) {
        var d = document.createElement("link");
        d.rel = "stylesheet";
        d.type = "text/css";
        d.href = e;
        f = f || this;
        f.document.getElementsByTagName("head")[0].appendChild(d)
    }, kwRedirect: function (c, d) {
        c = c || this;
        c.document.location.href = d
    }, kwEvalJsonString: function (str) {
        var result = null;
        try {
            result = eval("(" + str + ")")
        } catch (e) {
            result = null
        }
        return result
    }, kwTypeof: function (c) {
        var d = typeof(c);
        if (d == "object") {
            if (c !== null) {
                if (typeof(c.length) == "number" && !(c.propertyIsEnumerable("length")) && typeof(c.splice) == "function") {
                    d = "array"
                }
            } else {
                d = "null"
            }
        }
        return d
    }, kwSerialize: function (f) {
        var e = "";
        var d;
        switch (this.kwTypeof(f)) {
            case"array":
                e = "[";
                for (d in f) {
                    if (e != "[") {
                        e += ", "
                    }
                    e += this.kwSerialize(f[d])
                }
                e += "]";
                break;
            case"object":
                e = "{";
                for (d in f) {
                    if (e != "{") {
                        e += ", "
                    }
                    e += '"' + d + '":' + this.kwSerialize(f[d])
                }
                e += "}";
                break;
            case"string":
                e = '"' + f + '"';
                break;
            case"function":
                e = "function";
                break;
            default:
                e = f;
                break
        }
        return e
    }
};
var kwConsole = {
    console: null, rowsNumber: 0, maxRows: 30, print: function (c) {
        switch (top.DEBUG_MODE) {
            case"CONSOLE":
                if (this.console) {
                    if (this.rowsNumber < this.maxRows) {
                        this.console.innerHTML += c + "<br/>"
                    } else {
                        this.rowsNumber = 0;
                        this.console.innerHTML = c + "<br/>"
                    }
                    this.rowsNumber += 2
                } else {
                    var d = document.createElement("div");
                    d.setAttribute("id", "console");
                    d.setAttribute("style", "position:absolute;top:80px;right:80px;width:900px;height:500px;color:#00ff00;font-size:24px;z-index:100;");
                    this.console = document.getElementsByTagName("body")[0].appendChild(d);
                    top.kwConsole.print(c)
                }
                break;
            case"TRACE":
                top.Player.printDebugMessage(c);
                break
        }
    }
};
var kwStatusConsole = {
    statusconsole: null, rowsNumber: 0, maxRows: 20, print: function (c, e) {
        switch (top.PROGRESS_MODE) {
            case"CONSOLE":
                if (this.statusconsole) {
                    if (this.rowsNumber < this.maxRows) {
                        this.statusconsole.innerHTML += c + "<br/>"
                    } else {
                        this.rowsNumber = 0;
                        this.statusconsole.innerHTML = c + "<br/>"
                    }
                    this.rowsNumber += 2
                } else {
                    var d = document.createElement("div");
                    d.setAttribute("id", "statusconsole");
                    d.setAttribute("style", "background-color:transperent;color: #5A750B; width:600px;height: 300px; position: absolute;top: 50px;left:50px; padding: 10px; font-size: 14px;z-index:100;");
                    this.statusconsole = document.getElementsByTagName("body")[0].appendChild(d)
                }
                break;
            case"NONE":
                break
        }
    }, hide: function () {
        if (this.statusconsole) {
            this.statusconsole.style.visibility = "hidden;"
        }
    }, clear: function () {
        if (this.statusconsole) {
            this.statusconsole.innerHTML = ""
        }
    }
};
function kwTrace(b) {
    top.kwConsole.print(b)
}
var kwTimer = {
    arr: [], setTimer: function (e, f, g, h) {
        this.cancelTimer(e);
        this.arr[e] = {task: f, repeat: h, timeout: setInterval("top.kwTimer.callback('" + e + "')", g)}
    }, cancelTimer: function (b) {
        if (this.arr[b] !== undefined) {
            clearInterval(this.arr[b].timeout);
            this.arr[b].timeout = null;
            delete this.arr[b]
        }
    }, isTimerSet: function (b) {
        if (this.arr[b] !== undefined) {
            return true
        }
        return false
    }, callback: function (l) {
        if (this.arr[l] !== undefined) {
            var h = this.arr[l].task;
            var i = this.arr[l].repeat;
            if (i !== true) {
                this.cancelTimer(l)
            }
            var k = h.scope !== undefined ? h.scope : (window !== undefined ? window : null);
            var j = h.callback || function () {
                };
            var f = h.args || [];
            j.apply(k, f)
        }
    }
};