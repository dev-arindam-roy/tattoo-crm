function setCookieMenu() {				
	if ($("body").hasClass("sidebar-collapse") == true) {
	var cvalue = 1;
	}
	else {
	var cvalue = 0;
	}
	//alert(cvalue);
	var d = new Date();
	d.setTime(d.getTime() + (1*24*60*60*1000));
	var expires = "expires="+ d.toUTCString();
	document.cookie = "ariDASHx_left_menu=" + cvalue + ";" + expires + ";path=/";
}
function getCookieMenu() {
	var name = "ariDASHx_left_menu=";
	var decodedCookie = decodeURIComponent(document.cookie);
	var ca = decodedCookie.split(';');
	for(var i = 0; i <ca.length; i++) {
	var c = ca[i];
	//console.log(c);
	while (c.charAt(0) == ' ') {
	c = c.substring(1);
	}
	if (c.indexOf(name) == 0) {
	return c.substring(name.length, c.length);
	//alert(c.substring(name.length, c.length));
	}
	}
	return "";
}
function checkCookieMenu() {
	var user=getCookieMenu();
	//alert(user);
	if (user == "1") {
	$("body").removeClass("sidebar-collapse");
	} else {
	$("body").addClass("sidebar-collapse");
	}
}
checkCookieMenu();