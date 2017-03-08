/*
	Collapse or expand search boxes when their headers are clicked.
*/
$(document).on("click", "section.search > a", function(event) {
	event.preventDefault();
	$(this).next().slideToggle();
});

/*
	Make AJAX request based on given parameters.
*/
function ajaxRequest(url, toSend, addTo) {
	$.ajax({
		url: url,
		type: "post",
		dataType: "html",
		data: toSend,
		success: function(result) {
			$(addTo).append(result);
		}
	});
}

/*
	Search by Category/Year
*/
$(document).on("submit", "#cat_year", function(event) {
	event.preventDefault();
	// event.stopPropagation();
	$("#cy_results").empty();
	if ($("#cat").val() != "" && $("#year1").val() != "")
		ajaxRequest("cat_year.php", $(this).serialize(), "#cy_results");
	// return false;
});

/*
	Search by Name/Title
*/
$(document).on("submit", "#name_title", function(event) {
	event.preventDefault();
	$("#nt_results").empty();
	if ($("#name").val() != "Name or Title")
		ajaxRequest("name_title.php", $(this).serialize(), "#nt_results");
});

/*
	Search by Award/Year
*/
$(document).on("submit", "#award_year", function(event) {
	event.preventDefault();
	$("#ay_results").empty();
	if ($("#award").val() != "" && $("#year2").val() != "")
		ajaxRequest("award_year.php", $(this).serialize(), "#ay_results");
});

/*
	Productions by Number of Awards
*/
$(document).on("submit", "#num_prod", function(event) {
	event.preventDefault();
	$("#np_results").empty();
	ajaxRequest("num_prod.php", $(this).serialize(), "#np_results");
});

/*
	People with Most Awards by Role
*/
$(document).on("submit", "#max_person", function(event) {
	event.preventDefault();
	$("#mp_results").empty();
	if ($("#role").val() != "")
		ajaxRequest("max_person.php", $(this).serialize(), "#mp_results");
});