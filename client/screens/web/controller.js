var webMainList=null;
function webEventHandler(d){
    var c=true;
    switch(d.code){
        case"INIT_SCREEN":
            webInitScreen();
            break;
        case"UNINIT_SCREEN":
            webUninitScreen();
            break;
        default:
            switch(top.State.getState()){
                case top.State.INTERNET_WEB:
                    c=webMainEventHandler(d);
                    break;
                default:
                    c=false;
                    break
            }
            break
    }
    return c
}
function webMainEventHandler(d){
    var c=true;
    switch(d.code){
        case"KEY_SELECT":
            break;
        default:
            c=false;
            break
    }
    return c
}


function webActionHandler(c,d){
    switch(c){}
}
function webInitScreen(){
    top.State.setState(top.State.INTERNET_WEB);
    top.ScreenManager.displayScreen(webGetScreenHtml());
    this.webContent();
}
function webUninitScreen(){
    setToBinWeb();
}

function setToBinWeb()
{
}
;


  