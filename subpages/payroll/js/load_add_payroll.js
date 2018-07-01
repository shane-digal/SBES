var days = 0;
var start_index = 5;
var checked_employees = 0;
var employee_idArr = [];
var id_count = 0;


var rate_OT = parseFloat("<?php echo ($_SESSION['overtime_rate']/100)?>");

var weekday = ["SUN","MON","TUES","WED","THU","FRI","SAT"];
var curr = new Date; // get current date
var first = curr.getDate();// - curr.getDay(); // First day is the day of the month - the day of the week
var last = first + 6; // last day is the first day + 6

var firstday = new Date(curr.setDate(first)).toUTCString();
var lastday = new Date(curr.setDate(last)).toUTCString();

    
    
    
$('#search_daterange').daterangepicker({
		startDate: formatDate(firstday),
    	endDate: formatDate(lastday)
	});

	$("#payroll_start").val(firstday);
	$("#payroll_end").val(lastday);

	$('#payroll_form').ajaxForm({
		// set data type json
		dataType:'json',

		beforeSend: function() {
		},

		// complete call back 
		complete: function(data) {
			if(data.responseJSON.success) {
				var action = (edit_or_draft==1) ? 'updated.': 'created.';
				
				alert('Payroll successfully created');

				load_payroll();
			}
			else {
				console.log(data.responseJSON.error);
			}
		}
	});

	function formatDate(date) {
		var d = new Date(date),
			month = '' + (d.getMonth() + 1),
			day = '' + d.getDate(),
			year = d.getFullYear();

		if (month.length < 2) month = '0' + month;
		if (day.length < 2) day = '0' + day;

		return [month, day, year].join('/');
	}

	function formatDateForPHP(date) {
		var d = new Date(date),
			month = '' + (d.getMonth() + 1),
			day = '' + d.getDate(),
			year = d.getFullYear();

		if (month.length < 2) month = '0' + month;
		if (day.length < 2) day = '0' + day;

		return [day, month, year].join('/');
	}

    function load_employees(start, end, project_id) {
		start = encodeURIComponent(start);
		end = encodeURIComponent(end);
		console.log(project_id);
		$('#employee-list').load(
			"./subpages/payroll/load_employees.php?start="+start+"&end="+end+"&project="+project_id);
	}

	function checkbox_listener(element) {
		var name = $(element).attr('name');

		if(name != 'id-checkbox') {
			var all_ids = $('#all_ids').val().split(",");
			var class_name = $(element).attr('class');
			for(var i = 0; i < all_ids.length; i++) {
				var net_pay = parseFloat($("#net_pay"+all_ids[i]).val());
				var gross_pay = parseFloat($("#gross_pay"+all_ids[i]).val());
				var values = $("."+name).val().split(",");
				var deduction_id = values[0];
				var deduction_value = parseFloat(values[1]);

				if(class_name == 'bonus') {	
					if($(element).prop('checked')) {
						gross_pay += deduction_value;
						net_pay += deduction_value;
					}
					else {
						gross_pay -= deduction_value;
						net_pay -= deduction_value;
					}
					$("#gross_pay"+all_ids[i]).val(gross_pay);
				}
				else {
					if($(element).prop('checked'))
						net_pay -= deduction_value;
					else 
						net_pay += deduction_value;
				}

				$("#net_pay"+all_ids[i]).val(net_pay);
			}
				
		} else {
			if($(element).is(":checked")) {
				$("#checked_ids").val($('#all_ids').val());
				checked_employees = $('#all_ids').val().split(",").length;
			} else
				$("#checked_ids").val("0");
		}

		if($(element).is(":checked"))
			$("."+name).attr('checked', true);
		else
			$("."+name).attr('checked', false);
	}

	function removeCells(number) {
		for(var a = 0; a < number; a++) {
			var row = document.getElementById("headers");
			row.deleteCell(5);
		}
	}

	function addDay(date) {
		var startDate = new Date(date);

		// seconds * minutes * hours * milliseconds = 1 day 
		var day = 60 * 60 * 24 * 1000;

		var result = new Date(startDate.getTime() + day);
		return result;
	}	

	function display_days(start, end) {
		days = 0;
		do {
			var row = document.getElementById("headers");
			var x = row.insertCell(start_index+days);
			x.innerHTML = '<h5 class="mtb0">'
				+weekday[start.getDay()]+'<br/>'+start.getDate()+'</h5>';
			start = addDay(start);
			days++;
		}
		while(start <= end);

		$('#dates_header').attr('colspan',days);
	}
	function calculateBasic(id) {
		var total_minutes = 0;
		
		//get total minutes
		for(var i=1; i<=days; i++) {
			var minutes = parseFloat($("#input_minutes"+id+i).val());
			total_minutes += minutes;
		}
		
		var rate = parseFloat($("#input_wage"+id).val());
		var basic = rate*(total_minutes/60);

		$('#input_regular_time'+id).val(total_minutes);
		$('#input_basic'+id).html(basic.formatMoney(2, '.', ','));

		calculateTotalMinutesAndPay(id);
	}

	function calculateTotalMinutesAndPay(id) {
		var rate = parseFloat($("#input_wage"+id).val());
		var regular_minutes = parseFloat($('#input_regular_time'+id).val());
		var ot_minutes = parseFloat($('#input_OT'+id).val());

		var total_minutes = regular_minutes + ot_minutes;
		var basic_pay = (regular_minutes/60) * rate;
		var ot_pay = (ot_minutes/60) * (rate * rate_OT);
		var total_pay = basic_pay + ot_pay;
		
		$('#input_basic'+id).val(basic_pay.toFixed(2));
		$('#input_ot_pay'+id).val(ot_pay.toFixed(2));
		$('#total_time'+id).val(total_minutes);
		$('#gross_pay'+id).val(total_pay);
	}

	function checkEmployees(element) {
		var id = $(element).attr('id');
		var employee_id = $(element).val();

		if($("#"+id).prop('checked')) {
			checked_employees++;
			employee_idArr[id_count++] =  employee_id;
		} else {
			checked_employees--;
			employee_idArr = jQuery.grep(employee_idArr, function(value) {
				return value != employee_id;
			});
			id_count--;
		}
		$("#checked_ids").val(employee_idArr.join(','));
	};

	function checkDeduction(element) {
		var values = $(element).val().split(",");
		var deduction_id = values[0];
		var deduction_value = parseFloat(values[1]);
		var id = values[2];
		var net_pay = parseFloat($("#net_pay"+id).val());
		if($(element).prop('checked'))
			net_pay -= deduction_value;
		else 
			net_pay += deduction_value;
		$("#net_pay"+id).val(net_pay);
	}
	
	function checkBonus(element) {
		var values = $(element).val().split(",");
		var bonus_id = values[0];
		var bonus_value = parseFloat(values[1]);
		var id = values[2];
		var gross_pay = parseFloat($("#gross_pay"+id).val());
		var net_pay = parseFloat($("#net_pay"+id).val());
		
		if($(element).prop('checked')) {
			net_pay += bonus_value;
			gross_pay += bonus_value;			
		}
		else {
			net_pay -= bonus_value;
			gross_pay -= bonus_value;
		}
		$("#net_pay"+id).val(net_pay);
		$('#gross_pay'+id).val(gross_pay);
	}

	function add_payroll(id) {
		if(id == 0) {
			$("#is_draft").val("0");
			
			if(checked_employees == 0)
				alert("No employee selected.");
			else 
				$("#payroll_form").submit();
		} else if (id == 1) {
			$("#is_draft").val("1");
			$("#payroll_form").submit();
		} else if (id == 2) {
			$("#is_draft").val("2");
			$("#payroll_form").attr("action", "../../submits/payroll/add_payroll.php");

			console.log($("#is_draft").val());
			$("#payroll_form").submit();
		}
	}

	Number.prototype.formatMoney = function(c, d, t) {
		var n = this, 
		c = isNaN(c = Math.abs(c)) ? 2 : c, 
		d = d == undefined ? "." : d, 
		t = t == undefined ? "," : t, 
		s = n < 0 ? "-" : "", 
		i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
		j = (j = i.length) > 3 ? j % 3 : 0;
		return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	};