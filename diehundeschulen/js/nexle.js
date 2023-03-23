function output_history_complete() {
	var element = document.getElementById("nxlLoginForm");
	
	if (element.style.display === "block") {
		element.style.display = "none";
	}
	else {
		element.style.display = "block";
	}
}
