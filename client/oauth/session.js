if(JSON&&JSON.stringify&&JSON.parse){var Session=Session||(function(){var c=window.top||window;var a=(c.name?JSON.parse(c.name):{});function b(){c.name=JSON.stringify(a)}if(window.addEventListener){window.addEventListener("unload",b,false)}else{if(window.attachEvent){window.attachEvent("onunload",b)}else{window.onunload=b}}return{set:function(d,e){a[d]=e},get:function(d){return(a[d]?a[d]:undefined)},clear:function(){a={}},dump:function(){return JSON.stringify(a)}}})()};