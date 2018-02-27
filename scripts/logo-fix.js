window.onload = checkLogo;
window.onresize = checkLogo;


function checkLogo() {

	var width = window.innerWidth;
	var logo = document.getElementById("logo");
	var fullLogo = "img/logo.png";
	var mobileLogo = "img/logo-MOBILE.png";

	if (width > 576) {

		logo.src = fullLogo;

	} else {

		logo.src = mobileLogo;

	}

}