function roomGetScreenHtml() {
    var b = "";
    b += '<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
    b += '<div id="messageBlock" class="messageBlock"></div>';
    b += '<div class="header">';
    b += '<div class="headerLeft"></div><div class="headerRight"></div>';
    b += '<div id="globalLogo" class="globalLogo" style=""></div>';
    b += '<div id="globalLogoRight" class="globalLogoRight"></div>';
    b += '<div id="globalClock" class="globalClock"></div>';
    b += "</div>";
    b += '<div id="globalTitle" class="globalTitle serviceListTitle">' + top.globalGetLabel("SERVICE_TITLE") + "</div>";
    b += '<div id="servicemsg" class="servicemsg"></div>';
    b += '<div id="serviceListInfo" class="serviceListInfo"></div>';
    b += '<div id="roomListHighlight" class="roomListHighlight globalRoomKeeperHighlight"></div>';
    b += '<div id="roomListContainer" class="roomListContainer"></div>';
    b += '<div id="roomOrderListHighlight" class="roomOrderListHighlight globalRoomOrderHighlight"></div>';
    b += '<div id="roomInfoContainer" class="roomInfoContainer">';
    b += '<div id="roomInfoContainerTitle" class="roomInfoContainerTitle"></div>';
    b += '<div id="roomInfoContainerContent" class="roomInfoContainerContent"></div></div>';
    b += "</div>";
    b += '<div class="footer">';
    b += '<div id="footerContainer" class="footerContainer">' + showRoomServiceOrderFooter() + "</div>";
    b += "</div>";
    return b
}

function showRoomServiceOrderFooter() {
    var a = top.globalGetLabel("RC_MENU") + top.globalGetLabel("RC_BACK");
    return a
}

function roomListShowHighlight() {
    document.getElementById("roomListHighlight").style.visibility = "visible"
}

function roomListHideHighlight() {
    document.getElementById("roomListHighlight").style.visibility = "hidden"
}

function roomListDisplayItem(index, position, selected) {
    var html = "";
    var item = this.getItem(index);
    if (item) {
        html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + '">&nbsp;</div>'
    }
    return html
}

function roomListOnIndexChanged(g, j) {
    this.display();
    roomDisplayRestInfo(this.getItem());
    var l = document.getElementById("roomListHighlight");
    var k = window.getComputedStyle(document.getElementsByClassName("roomkeeperNavItemList")[0], null).getPropertyValue("padding-bottom");
    var n = window.getComputedStyle(document.getElementsByClassName("roomkeeperNavItemList")[0], null).getPropertyValue("height");
    var i = window.getComputedStyle(document.getElementsByClassName("roomListContainer")[0], null).getPropertyValue("top");
    var o = parseInt(i, 10) - (parseInt(k, 10) / 2);
    var m;
    var h = this.getSelected();
    m = o + Math.floor(h % top.KEEPER_LEFT_NAV_ROWS) * (parseInt(n, 10) + parseInt(k, 10));
    top.TransitionManager.run(m, g, l)
}

function roomListDisplay() {
    this.onBeforeDisplay();
    if (this.getLength() === 0) {
        return this.displayEmptyList()
    }
    var d = new top.Iterator(0, this.getIndex() - this.getSelected(), this.getLength(), this.isCyclic());
    var f = 0;
    var e = "";
    while (f < this.getDisplayCount()) {
        if (d.isChanged() && f < this.getLength()) {
            e += this.displayItem(d.getIndex(), f, f == this.getSelected());
            d.increaseIndex()
        } else {
            e += this.displayItem(-1, f, false)
        }
        f++
    }
    this._container.innerHTML = e;
    this.onAfterDisplay()
}

function roomListDisplayEmptyList() {
    roomListListHideHighlight();
    this._container.innerHTML = '<div class="serviceListEmptyRestList">' + top.globalGetLabel("REST_LIST_EMPTY") + "</div>"
}

function roomDisplayRestInfo(d) {
    var e = "";
    if (d) {
        if (d.target == "vacant_status") {
            document.getElementById("roomInfoContainerTitle").innerHTML = "Room Vacant Status";
            ca = vsArray
        } else {
            if (d.target == "turn_down") {
                document.getElementById("roomInfoContainerTitle").innerHTML = "Room Turn Down";
                ca = tdArray
            } else {
                if (d.target == "under_maintenance") {
                    document.getElementById("roomInfoContainerTitle").innerHTML = "Room Under Maintenance";
                    ca = umArray
                } else {
                    if (d.target == "maintenance_req") {
                        document.getElementById("roomInfoContainerTitle").innerHTML = "Maintenance Request";
                        ca = mrArray
                    } else {
                        if (d.target == "extra_bed") {
                            document.getElementById("roomInfoContainerTitle").innerHTML = "Room Extra Bed";
                            ca = ebArray
                        } else {
                            if (d.target == "cleaning_req") {
                                document.getElementById("roomInfoContainerTitle").innerHTML = "Room Cleaning Request";
                                cr = mrArray
                            } else {
                                if (d.target == "baby_cot") {
                                    document.getElementById("roomInfoContainerTitle").innerHTML = "Room BabyCot Status";
                                    ca = bcArray
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function roomListOnAfterDisplay() {
    roomDisplayRestInfo(this.getItem());
    var b = "";
    if (this.getLength() > 0) {
        b += (this.getIndex() + 1) + "/" + this.getLength()
    }
}

function roomOrderListDisplayItem(index, position, selected) {
    if (inKeeperLeftNavigator == true) {
        selected = false
    }
    var html = "";
    var item = this.getItem(index);
    if (item) {
        if (item.target == "usercode") {
            html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + userCode + "</div>"
        } else {
            if (item.target == "roomstatus") {
                c = "";
                if (roomList.getItem().target == "vacant_status") {
                    c = vsArray[0]
                } else {
                    if (roomList.getItem().target == "turn_down") {
                        c = tdArray[0]
                    } else {
                        if (roomList.getItem().target == "under_maintenance") {
                            c = umArray[0]
                        } else {
                            if (roomList.getItem().target == "maintenance_req") {
                                c = mrArray[0]
                            } else {
                                if (roomList.getItem().target == "extra_bed") {
                                    c = ebArray[0]
                                } else {
                                    if (roomList.getItem().target == "cleaning_req") {
                                        c = crArray[0]
                                    } else {
                                        if (roomList.getItem().target == "baby_cot") {
                                            c = bcArray[0]
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + c + "</div>"
            } else {
                if (item.target == "guest") {
                    html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '">' + 1 + "</div>"
                } else {
                    if (item.target == "submit") {
                        html += '<div id="' + this.eval(item, "class", "") + '" class="' + this.eval(item, "class", "") + (selected ? "_selected" : "") + '"></div>'
                    }
                }
            }
        }
    }
    return html
}

function roomOrderListHideHighlight() {
    document.getElementById("roomOrderListHighlight").style.visibility = "hidden"
};