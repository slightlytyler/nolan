jQuery(document).ready(function() {
	updateDatepickers();
});

function updateDatepickers () {
	jQuery("div#widgets-right [data-date]").datepicker();
}