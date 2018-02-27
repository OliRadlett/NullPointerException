window.onload = addActive;

function addActive() {

	let headerPages = ["index", "signup", "qa", "career", "tutorial", "community"]

	let page = window.location.pathname;
	page = page.replace("/", "");
	page = page.replace(".php", "");

	if (headerPages.indexOf(page) !== -1) {
		
		document.getElementById(page).className += " active";

	}
	// Overrides any window.onload event so run any JS functions in pages on header from here:

	if (page == "qa") {

		Download();

	}

}