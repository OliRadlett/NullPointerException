window.onload = addActive;

function addActive() {

	let page = window.location.pathname;
	page = page.replace("/", "");
	page = page.replace(".php", "");
	
	document.getElementById(page).className += " active";

	// Overrides any window.onload event so run any JS functions in pages on header from here:

	if (page == "qa") {

		Download();

	}

}