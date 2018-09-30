/**
 *
 * Script used to change the logo to a shorter version if the browser width goes below a certain value
 *
 * @author Oli Radlett <o.radlett@gmail.com>
 *
 */

// Run the checkLogo() function when the page first loads and every time the browser window changes size
window.onload = checkLogo;
window.onresize = checkLogo;


function checkLogo() {

    // Get the current width of the browser
	let width = window.innerWidth;
	// Get a reference to the logo element
	let logo = document.getElementById("logo");
	// Create Strings for the paths of the two logos
	let fullLogo = "img/logo.png";
	let mobileLogo = "img/logo-MOBILE.png";

	if (width > 576) {

	    // Apply full size logo if browser is wide enough
		logo.src = fullLogo;

	} else {

	    // Apply shorter logo if browser is too narrow
		logo.src = mobileLogo;

	}

}