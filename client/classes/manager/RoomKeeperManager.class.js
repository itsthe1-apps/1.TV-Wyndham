var RoomKeeperManager={init:function(){},setServiceRequest:function(b,e,f){var c=top.ROOM_NUMBER;var f=top.ROOMKEEPER_REQURL+"type/"+b+"/room_number/"+c+"/usercode/"+e+"/roomstatus/"+f;top.kwConsole.print(f);top.kwUtils.kwXMLHttpRequest("POST",f,true)}};