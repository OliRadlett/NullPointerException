window.onload = checkLogo;
window.onresize = checkLogo;


function checkLogo() {

	var width = window.innerWidth;
	var logo = document.getElementById("logo");
	var fullLogo = "img/logo-old.png";
	var mobileLogo = "img/logo-old-MOBILE.png";

	if (width > 576) {

		logo.src = fullLogo;

	} else {

		logo.src = mobileLogo;

	}

}