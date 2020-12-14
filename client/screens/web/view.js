function webGetScreenHtml(){
    var b="";
    b+='<div class="bodyBG" style="background-image:' + top.BG_IMG + '">';
   // b += '<div id="globalLogoL" class="globalLogo" style="background-image:url('+top.LOGO+');"></div>';
   // b += '<div name="iframe" id="iframe"></div>';
    b += '<iframe id="webframe" target="_blank" name="webframe" src="" style="margin:0px;padding:0px;width:100%; height:100%;background-color:#red;top: 0px; left: 0px;" frameborder="2"></iframe>';
   // b += '<div id="webContainer" class="webContainer">'+webContent()+'</div>';
    b+="</div>";
    return b;
}
function webContent(){
    //window.location="http://www.cnn.com";
    //var b="";
    /*
    b+='<div class="webMessage" id="webMessage">' + top.ServiceManager.webData.message + '</div>';
    b+='<div id="webLogo" class="webLogo">';
    b += '<img src="' + top.ServiceManager.webData.logo + '" width="' + top.globalConst("WEB_IMG_WIDTH") + '" >';
    b+='</div>';
    */
    //b = frames['webframe'].document.body.innerHTML;
    //return b;
    try{
    //var f=document.getElementById("webframe");
    //var i=f.document.body.innerHTML;
    //return i;
    y=document.getElementById('webframe');
    y.src=top.InternetManager.selectedURL;
	top.kwConsole.print("Seleted URL"+top.InternetManager.selectedURL);
    }catch(e)
    {
        top.kwConsole.print("Error on URL"+e.message);
       // x=e;
    }
}
