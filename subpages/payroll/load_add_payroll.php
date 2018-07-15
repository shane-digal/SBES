<?php
	include('../../includes/module.php');

	$_SESSION['deductions'] = array();
	$_SESSION['bonuses'] =  array();
	$index = 0;

	$getDeductions = $con->prepare("SELECT deduction_id,
		deduction_name,
		deduction_percent,
		deduction_amount
		FROM lib_deductions");
	$bind = $getDeductions->execute();
	$getDeductions->store_result();
	$getDeductions->bind_result($deduction_id,
		$deduction_name,
		$deduction_percent,
		$deduction_amount);
	$deduction_count = $getDeductions->num_rows();

	while($getDeductions->fetch()){
		$_SESSION['deductions'][$index]['id'] 		= $deduction_id;
		$_SESSION['deductions'][$index]['name'] 	= $deduction_name;
		$_SESSION['deductions'][$index]['percent'] 	= $deduction_percent;
		$_SESSION['deductions'][$index]['amount'] 	= $deduction_amount;
		$index++;
	}
	$getDeductions->close();
	$index = 0;

	$getBonuses = $con->prepare("SELECT bonus_id,
		bonus_name,
		bonus_percent,
		bonus_amount
		FROM lib_bonuses");
	$bind = $getBonuses->execute();
	$getBonuses->store_result();
	$getBonuses->bind_result($bonus_id,
		$bonus_name,
		$bonus_percent,
		$bonus_amount);
	$bonus_count = $getBonuses->num_rows();

	while($getBonuses->fetch()){
		$_SESSION['bonuses'][$index]['id'] 		= $bonus_id;
		$_SESSION['bonuses'][$index]['name'] 	= $bonus_name;
		$_SESSION['bonuses'][$index]['percent'] = $bonus_percent;
		$_SESSION['bonuses'][$index]['amount'] 	= $bonus_amount;
		$index++;
	}
	$getBonuses->close();

	$getProjects = $con->prepare("SELECT project_id, project_name FROM rec_projects");
	$getProjects->execute();
	$getProjects->bind_result($project_id,
		$project_name);
?>

<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4>GENERATE PAYROLL</h4>
	</div>
	<div class="col-xs-12 col-md-6">
		<a onclick="load_payroll();" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-chevron-left"></i> RETURN TO LIST&emsp;</h5>
		</a>
		<a onclick="add_project(1);" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-folder-open-o"></i> SAVE TO DRAFTS&emsp;|&emsp;</h5>
		</a>
		<a onclick="add_project(0);" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-plus-square-o"></i> GENERATE PAYROLL&emsp;|&emsp;</h5>
		</a>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="my-container mt10">
			<div class="row">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-12">
							<h4 class="mt0 mb0"><small><i class="fa fa-book"></i> BASIC INFORMATION</small></h4>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 plr10">
							<div class="col-xs-12 col-md-6 plr5">
								<div class="row mt5">
									<div class="col-xs-12 col-sm-5 col-lg-4">
										<label class="mtb0">PROJECT:</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-lg-8">
										<select 
											class="form-control"
											id="project_id"
											name="project_id"
										>
											<?php while($getProjects->fetch()) { ?>
											<option value="<?= $project_id ?>"><?php echo $project_name; ?></option>
											<?php } $getProjects->close(); ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-6 plr5">
								<div class="row mt5">
									<div class="col-xs-12 col-sm-5 col-lg-4">
										<label class="mtb0">PROJECT STATUS:</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-lg-8">
										<select 
											class="form-control"
											id="search_status"
										>
											<option value="All">All</option>
											<option value="Pending">Pending</option>
											<option value="Approved">Approved</option>
											<option value="Ongoing">Ongoing</option>
											<option value="Completed">Completed</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-6 plr5">
								<div class="row mt5">
									<div class="col-xs-12 col-sm-5 col-lg-4">
										<label class="mtb0">PAYROLL SPAN:</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-lg-8">
										<div class="input-group">
											<input 
												type="text" 
												class="form-control pull-right" 
												id="search_daterange"
											>
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row mt20">
				<div class="col-xs-12" id="payroll-cont">
					<div class="table-responsive">
						<table class="table table-hover table-bordered table-striped">
							<thead>
								<tr>
									<td colspan="1"></td>
									<td colspan="4"></td>
									<td colspan="7" class="align-center" id="dates_header"><h5>DATE RANGE</h5></td>
									<td colspan="3" class="align-center"><h5>TOTAL TIME</h5></td>
									<td colspan="3" class="align-center"><h5>EARNINGS</h5></td>
									<?php if($deduction_count > 0) { ?>
									<td colspan="<?php echo $deduction_count; ?>" class="align-center"><h5>DEDUCTIONS</h5></td>
									<?php } if($bonus_count > 0) {?>
									<td colspan="<?php echo $bonus_count; ?>" class="align-center"><h5>BONUSES</h5></td>
									<?php } ?>
									<td colspan="2" class="align-center"><h5>TOTALS</h5></td>
								</tr>
								<tr id="headers">
									<td nowrap>
										<h5 class="mt15 mb0">
											<input type="checkbox" style="margin-top:-4px;" name="id-checkbox" onclick="checkbox_listener(this);"/>
										</h5>
									</td>
									<td nowrap><h5 class="mt15 mb0">ID #</h5></td>
									<td nowrap><h5 class="mt15 mb0">NAME</h5></td>
									<td nowrap><h5 class="mt15 mb0">POSITION</h5></td>
									<td nowrap><h5 class="mt15 mb0">RATES</h5></td>
									
									<td nowrap><h5 class="mtb0">REG<br/>MIN</h5></td>
									<td nowrap><h5 class="mtb0">OT<br/>MIN</h5></td>
									<td nowrap><h5 class="mt15 mb0">TOTAL</h5></td>

									<td nowrap><h5 class="mt15 mb0">BASIC</h5></td>
									<td nowrap><h5 class="mt15 mb0">OT</h5></td>
									<td nowrap><h5 class="mt15 mb0">DE MINIMIS</h5></td>

									<?php for($i = 0; $i < $deduction_count; $i++) { 
										$name = preg_replace('/\s+/', '', $_SESSION['deductions'][$i]['name']);
									?>
									<td nowrap>
										<h5 class="mt15 mb0">
											<input type="checkbox" style="margin-top:-4px;" name="<?php echo $name.'-checkbox'; ?>" 
											onclick="checkbox_listener(this);"/> <?php echo $_SESSION['deductions'][$i]['name']; ?>
										</h5>
									</td>
									<?php }  ?>

									<?php for($i = 0; $i < $bonus_count; $i++) {
										$name = preg_replace('/\s+/', '', $_SESSION['bonuses'][$i]['name']);
									?>
									<td nowrap>
										<h5 class="mt15 mb0">
											<input type="checkbox" style="margin-top:-4px;" name="<?php echo $name.'-checkbox'; ?>" 
											onclick="checkbox_listener(this);"/> <?php echo $_SESSION['bonuses'][$i]['name']; ?>
										</h5>
									</td>
									<?php }  ?>

									<td nowrap><h5 class="mt15 mb0">GROSS</h5></td>
									<td nowrap><h5 class="mt15 mb0">NET</h5></td>

								</tr>
							</thead>
							<tbody id="employee-list">
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var days = 0;
	var start_index = 5;
	
	var weekday = ["SUN","MON","TUES","WED","THU","FRI","SAT"];
	var curr = new Date; // get current date
	var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
	var last = first + 6; // last day is the first day + 6

	var firstday = new Date(curr.setDate(first)).toUTCString();
	var lastday = new Date(curr.setDate(last)).toUTCString();

    $('#search_daterange').daterangepicker({
		startDate: formatDate(firstday),
    	endDate: formatDate(lastday)
	});

	$('#search_status').on('change', function() {
		var status = $('#search_status').val();
		$.ajax({
			url: '../../submits/payroll/filter_projects.php',
			type: 'POST',
			data: {project_status: status},
			datatype: 'json',
			encode : true
		})
		.done(function(data) {
			data = jQuery.parseJSON(data);
			if(!data.success) {
				$('#project_id').empty();
				if(data.count != 0)
					for(var i = 0; i < data.count; i++) {
						$('#project_id').append(data.element[i]);
					}
				else
				$('#project_id').append('<option>No project</option>');
			}
		});
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

    function load_employees(start, end, project) {
		start = encodeURIComponent(start);
		end = encodeURIComponent(end);
		$('#employee-list').load("./subpages/payroll/load_employees.php?start="+start+"&end="+end+"&project="+project);
	}

	function checkbox_listener(element) {
		var name = $(element).attr('name');

		if($(element).is(":checked"))
			$("."+name).attr('checked', true);
		else
			$("."+name).attr('checked', false);
	}

	function removeCells(number) {
		for(var a = 0; a < number; a++)
		{
			var row = document.getElementById("headers");
			row.deleteCell(5);
		}
	}

	function addDay(date) {
		//var dateString = 'Mon Jun 30 2014 00:00:00';

		var startDate = new Date(date);

		// seconds * minutes * hours * milliseconds = 1 day 
		var day = 60 * 60 * 24 * 1000;

		var result = new Date(startDate.getTime() + day);
		return result;
	}	

	function display_days(start, end)
	{
		days=0;
		do
		{
			var row = document.getElementById("headers");
			var x = row.insertCell(start_index+days);
			x.innerHTML = '<h5 class="mtb0">'+weekday[start.getDay()]+'<br/>'+start.getDate()+'</h5>';
			start = addDay(start);
			days++;
		}
		while(start < end);

		$('#dates_header').attr('colspan',days);
	}

	function calculateBasic(id)
	{
		var total_minutes = 0;
		
		for(var i=1; i<=days; i++)
		{
			var minutes = parseFloat(document.getElementById("input_minutes"+id+i).value);
			total_minutes += minutes;
		}

		var rate = parseFloat(document.getElementById("input_wage"+id).value);
		var basic = rate*(total_minutes/60);
		$('#input_totaltime'+id).val(total_minutes);
		$('#input_basic'+id).html(basic.formatMoney(2, '.', ','));
	}

	$('#search_daterange').change(function () {
		onChangeListener();
	});
	
	$('#project_id').change(function () {
		onChangeListener();
	});

	function onChangeListener() {
		var start_date = $('#search_daterange').data('daterangepicker').startDate._d;
		var end_date = $('#search_daterange').data('daterangepicker').endDate._d;
		
		// if(days!=0)
		removeCells(days);
		
		display_days(start_date, end_date);
		//alert(formatDate(start_date));
		load_employees(formatDateForPHP(start_date), formatDateForPHP(end_date), $('#project_id').val());
	}

	Number.prototype.formatMoney = function(c, d, t){
		var n = this, 
		c = isNaN(c = Math.abs(c)) ? 2 : c, 
		d = d == undefined ? "." : d, 
		t = t == undefined ? "," : t, 
		s = n < 0 ? "-" : "", 
		i = String(parseInt(n = Math.abs(Number(n) || 0).toFixed(c))), 
		j = (j = i.length) > 3 ? j % 3 : 0;
		return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
	};
	
	display_days(new Date(curr.setDate(first)), new Date(curr.setDate(last)));
	var project_id = $('#project_id').val();
	// console.log(project_id);
	load_employees(firstday, lastday, project_id);
</script>