function RadioCategory(a, c, b) {
    this.id = a;
    this.name = c;
    this.description = b
}

function InternetCategory(a, e, c, b) {
    this.id = a;
    this.name = e;
    this.description = c;
    this.image = b
}

function Radio(a, o, m, l, b, f, j, h) {
    this.id = a;
    this.channelNumber = o;
    this.name = m;
    this.description = l;
    this.url = b;
    this.icon = f;
    this.epgXML = j;
    this.eitXML = h
}

function ChannelCategory(a, c, b) {
    this.id = a;
    this.name = c;
    this.description = b
}

function Channel(a, o, m, l, b, f, j, h) {
    this.id = a;
    this.channelNumber = o;
    this.name = m;
    this.description = l;
    this.url = b;
    this.icon = f;
    this.epgXML = j;
    this.eitXML = h
}

function MovieCategory(a, c, b) {
    this.id = a;
    this.name = c;
    this.description = b
}

function Movie(k, j, h, e, b, f, c, a) {
    this.name = k;
    this.description = j;
    this.category = h;
    this.duration = e;
    this.url = b;
    this.trailerLink = f;
    this.icon = c;
    this.thumbnail = a
}

function Restuarant(b, j, h, a, g, f) {
    this.id = b;
    this.name = j;
    this.image = h;
    this.image_menu = a;
    this.description = g;
    this.menu = f
}

function RestuarantMenu(f, e, c, b, a) {
    this.name = f;
    this.description = e;
    this.price = c;
    this.type = b;
    this.image = a
}

function RestuarantMenuType(a, d, b) {
    this.id = a;
    this.name = d;
    this.code = b
}

function SpaMenuType(a, d, b) {
    this.id = a;
    this.name = d;
    this.code = b
}


function LocalInfoMenuType(a, d, b) {
    this.id = a;
    this.name = d;
    this.code = b
}

function Weather(i, e, b, a, f, g) {
    this.city = i || "";
    this.weatherType = e || "";
    this.weatherImageURL = b || "";
    this.tmpLow = a || 0;
    this.tmpHigh = f || 0;
    this.day = g || ""
}

function Media(e, c, a, f, b, g) {
    this.id = e;
    this.type = c;
    this.width = a;
    this.height = f;
    this.url = b;
    this.duration = g
}

function Exit(a, e, b, d, c) {
    this.message = a;
    this.rtsp = e;
    this.logo = b;
    this.status = d;
    this.image_path = c
};