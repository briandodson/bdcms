// JQuery
	$(document).ready(function(){	
				
		// Form Validate
		
		var noSpam = new Array("url=http", "<a href", "href");
		$.validator.addMethod("noSpam", function(value) {
    	return !new RegExp('!/' + noSpam.join('|') + '/').test(value);
    },"No links (spam)");
		
		var badNameList = new Array("Name", "Name *", "Name*");
		$.validator.addMethod("badName", function(value) {
    	return !new RegExp('!/' + badNameList.join('|') + '/').test(value);
    },"Enter YOUR name");
		
		var badPhoneList = new Array("Phone", "Phone *", "Phone*");
		$.validator.addMethod("badPhone", function(value) {
    	return !new RegExp('!/' + badPhoneList.join('|') + '/').test(value);
    },"Enter YOUR phone");
		
		var badEmailList = new Array("Email", "Email *", "Email*");
		$.validator.addMethod("badEmail", function(value) {
    	return !new RegExp('!/' + badEmailList.join('|') + '/').test(value);
    },"Enter YOUR email");
		
		var badIndustryList = new Array("What is your industry?", "What is your industry", "What is your industry?");
		$.validator.addMethod("badIndustry", function(value) {
    	return !new RegExp('!/' + badIndustryList.join('|') + '/').test(value);
    },"Enter YOUR industry");
		
		
		$("#contactForm").validate({
			meta: "validate"
		});
		
		$("#sendForm").validate({
			meta: "validate"
		});
		
		$("#optinForm").validate({
			meta: "validate"
		});

		
		// eof Form Validate
	
	});
	
	// eof JQuery
	
	// Clear/Replace default form values
	function clearText(thefield){
		if (thefield.defaultValue == thefield.value) thefield.value = '';
		else if (thefield.value == '') thefield.value = thefield.defaultValue;
	}
	
	// Son of Suckerfish dropdown for IE6
	sfHover = function() {
		var sfEls = document.getElementById("nav").getElementsByTagName("LI");
		for (var i=0; i<sfEls.length; i++) {
			sfEls[i].onmouseover=function() {
				this.className+=" sfhover";
			}
			sfEls[i].onmouseout=function() {
				this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
			}
		}
	}
	if (window.attachEvent) window.attachEvent("onload", sfHover);