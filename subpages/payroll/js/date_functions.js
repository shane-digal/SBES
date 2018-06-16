$('#search_daterange').change(function () {
	var start_date = $('#search_daterange')
		.data('daterangepicker').startDate._d;
	var end_date = $('#search_daterange')
		.data('daterangepicker').endDate._d;
	
	// if(days!=0)
	removeCells(days);
	
	display_days(start_date, end_date);
	//alert(formatDate(start_date));
	load_employees(formatDateForPHP(start_date), formatDateForPHP(end_date));
});


