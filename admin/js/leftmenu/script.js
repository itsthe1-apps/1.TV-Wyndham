$(document).ready(function(){
	/* This code is executed after the DOM has been completely loaded */

	/* Changing thedefault easing effect - will affect the slideUp/slideDown methods: */
	$.easing.def = "easeOutBounce";
	
	/* Binding a click event handler to the links: */
	$('li.button a').click(function(e){
	
		/* Finding the drop down list that corresponds to the current section: */
		var dropDown = $(this).parent().next();
		
		/* Closing all other drop down sections, except the current one */
		$('.dropdown').not(dropDown).slideUp('slow');
		dropDown.slideToggle('slow');
		
		/* Preventing the default event (which would be to navigate the browser to the link's address) */
		e.preventDefault();
	})
	
});


function deleteconform(url,var1,var2)
{
	var answer = confirm("Are you sure you want to delete this?")
	if (answer){
		window.location = base_url+"index.php/"+url+"/"+var1+"/"+var2;
	}
	else{
		
	}
}

function check_length(frm,x){
	maxLen = 300; // max number of characters allowed
	if (x.value.length >= maxLen) {
		// Alert message if maximum limit is reached. 
		// If required Alert can be removed. 
		var msg = "You have reached your maximum limit of characters allowed";
		alert(msg);
		// Reached the Maximum length so trim the textarea
		x.value = x.value.substring(0, maxLen);
	}
	else{ // Maximum length not reached so update the value of my_text counter
		document.getElementById('text_num').innerHTML = maxLen - x.value.length;
	}
}