$('.timepicker').timepicker({showInputs: false});
	$('.from-time').val('8:00 AM');
	$('.to-time').val('5:00 PM');

	function submitNewEmployee(){
        $('#submit-btn').click();
        var values = $('#form-new_employee').serializeArray();
        e.preventDefault();
	}

	$('#form-new_employee').submit(function(e){
        var values = $(this).serializeArray();
        e.preventDefault();
		$.ajax({
			url : "http://localhost/sbes/api?q=InsertNewEmployee",
			method: "POST",
			data: values,
			dataType: 'json',
			success: function(response){
				alert(response.message);
			}
        });
        e.preventDefault();
	});

	$.ajax({
		url : "http://localhost/sbes/api?q=GetBonuses",
		method: "POST",
		dataType: 'json',
		success: function(response){
			$('.bonuses-list').empty();
			var cbox;
			$.each(response.values, function(key, v){
				cbox = 	'<label class="label-data">' +
						'<input type="checkbox" name="bonus[]" value="'+v.bonus_id+'"  checked/> ' +  v.bonus_name +
						'</label>';
				$('.bonuses-list').append(cbox);
			});
		}
	});

	$.ajax({
		url : "http://localhost/sbes/api?q=GetDeductions",
		method: "POST",
		dataType: 'json',
		success: function(response){
			var cbox;
			$.each(response.values, function(key, v){
			cbox = 	'<label class="label-data">' +
					'<input type="checkbox" name="deduction[]" value="'+v.deduction_id+'"  checked/> ' +  v.deduction_name +
					'</label>';

			$('.deduction-list').append(cbox);
			});
		}
	});

	$.ajax({
		url : "http://localhost/sbes/api?q=GetApprovedProjects",
		method: "POST",
		dataType: 'json',
		success: function(response){
			var cbox;
			$.each(response.values, function(key, v){
			cbox = 	'<option value="'+v.project_id+'">' + v.project_name + '</option>';
			$('#assignment').append(cbox);
			});
		}
	});

	$.ajax({
		url : "http://localhost/sbes/api?q=GetAllPositions",
		method: "POST",
		dataType: 'json',
		success: function(response){
			var cbox;
			$.each(response.values, function(key, v){
			cbox = 	'<option>' + v.position_name + '</option>';
			$('#position').append(cbox);
			});
		}
	});

	$('.my-cb').click(function(){
		var idx = $(this).data('index');
		var isDisabled = !$(this).prop('checked');
		$($('.from-time')[idx]).prop('disabled', isDisabled);
		$($('.to-time')[idx]).prop('disabled', isDisabled);
	});