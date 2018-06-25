$('.timepicker').timepicker({
	showInputs: false
});

var empBonusData = [];
var empDeductionData = [];
var empScheduleData = [];


function load_edit_employee() {
	$("#main-content-container").load("./subpages/employees/load_edit_employee.php");
}

function updateEmployeeStatus(status) {
	$.ajax({
		url: "http://localhost/sbes/api?q=UpdateEmployeeStatus",
		method: "POST",
		data: {
			'emp_id': emp_id,
			status
		},
		dataType: 'json',
		success: function (response) {
			const msgStatus = (status == 'CONTRACTUAL' ? 'unsuspended' : status.toLowerCase())
			alert(`Employee is now ${msgStatus} .`);
			load_employee();
		}
	});
}

$.ajax({
	url: "http://localhost/sbes/api?q=GetUserBonuses",
	method: "POST",
	data: {
		'emp_id': emp_id
	},
	dataType: 'json',
	success: function (response) {

		$.each(response.values, function (key, v) {
			cbox = '<label class="label-data">' + v.bonus_name + '</option>';
			$('#bonuses-container').append(cbox);
		});
		empBonusData = response;
	}
});
$.ajax({
	url: "http://localhost/sbes/api?q=GetUserDeductions",
	method: "POST",
	data: {
		'emp_id': emp_id
	},
	dataType: 'json',
	success: function (response) {
		$.each(response.values, function (key, v) {
			cbox = '<label class="label-data">' + v.deduction_name + '</option>';
			$('#deductions-container').append(cbox);
		});
		empDeductionData = response;
	}
});
$.ajax({
	url: "http://localhost/sbes/api?q=GetUserSchedule",
	method: "POST",
	data: {
		'emp_id': emp_id
	},
	dataType: 'json',
	success: function (response) {
		$.each(response.values, function (key, v) {
			time = v.empschedule_in + ' - ' + v.empschedule_out;
			cbox = '<div class="row">' +
				'<div class="col-xs-12">' +
				'<label class="mt10 mb0 my-cb-label">' + v.empschedule_day + '</label>' +
				'<h4 class="mt5 mb5"><i class="fa fa-clock-o"></i>&emsp;' + time + '</h4>' +
				'</div>' +
				'</div>';
			$('#schedule-container').append(cbox);
		});
		empScheduleData = response;
	}
});


function loadEmployeeFiles() {
	$('.file-container').html('');
	$.ajax({
		url: "http://localhost/sbes/api?q=GetEmployeeFiles",
		method: "POST",
		data: {
			'emp_id': emp_id
		},
		dataType: 'json',
		success: (response) => {
			$.each(response.values, function (key, v) {
				const element = `
						<div class="col-xs-4 col-sm-6 col-md-3 plr5 mt5">
								<span class="emp-file-attachments">
									<i class="fa fa-file-text-o file-type" onClick="downloadFile(${v.file_id})"></i>
									<i class="fa fa-trash file-remover" onclick="removeFile(${v.file_id});"></i>
								</span>
								<span class="emp-file-attachment-text">${v.file_name}</span>
						</div>
					`;
				$('.file-container').append(element);
			});
		}
	});
}
loadEmployeeFiles();


if (empData.employee_empstatus == 'SUSPENDED') {
	$('.suspend-link').css('display', 'none');
} else {
	$('.unsuspend-link').css('display', 'none');
}

function submitFiles() {
	$('#submit-file-btn').click();
}

function removeFile(id) {
	if (confirm('Are you sure to delete this file?')){
		$.ajax({
			url: "http://localhost/sbes/api?q=DeleteUserFile",
			method: "POST",
			data: {
				'file_id': id
			},
			success: () => {
				loadEmployeeFiles();
				alert('File Deleted');
			}
		});
	}
}

function downloadFile(id){
	window.location =
		`http://localhost/sbes/apis/employee_download_file.php?id=${id}`
	;
}

$('#file_upload').submit((e) => {
	var	formData = new FormData($('#file_upload')[0]);
	var fileUrl = '';
	$.ajax({
		url: `http://localhost/sbes/apis/classes/employee_submit_file.php`,
		method: "POST",
		data: formData,
		dataType: 'json',
		async: false,
		cache: false,
		contentType: false,
		processData: false,
		success: (response) => {
			fileUrl = response.fileData;
			e.preventDefault();
		},
		error: (a, b, c) => {
			e.preventDefault();
		}
	})
		.then(
			$.ajax({
				url: "http://localhost/sbes/api?q=addFile",
        method: "POST",
        data: {
					fileData: [fileUrl],
					emp_id
				},
        dataType: 'json',
        success: function (response) {
          loadEmployeeFiles();
        }
			})
		);
});