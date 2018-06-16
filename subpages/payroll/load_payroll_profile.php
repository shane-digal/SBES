<?php
	include('../../includes/module.php');
	$payroll_id = $_GET['payroll_id'];

	getBonusesAndDeductions();
	$deduction_count = count($_SESSION['deductions']);
	$bonus_count = count($_SESSION['bonuses']);
	
	$paid = 0;

	$getDetails = $con->prepare("SELECT rec_payrolls.payroll_id, 
		rec_payrolls.project_id, 
		rec_payrolls.payroll_start,
		rec_payrolls.payroll_end,
		rec_payrolls.payroll_status,
		rec_payrolls.payroll_created,
		rec_projects.project_name
		FROM rec_payrolls
		INNER JOIN rec_projects
		ON rec_payrolls.project_id = rec_projects.project_id
		WHERE rec_payrolls.payroll_id = ?");
	$getDetails	->bind_param("i", $payroll_id);
	$getDetails ->execute();
	$getDetails ->bind_result($payroll_id, 
		$project_id, 
		$payroll_start,
		$payroll_end,
		$payroll_status,
		$payroll_created,
		$project_name);
	$getDetails ->fetch();
	$getDetails ->close();

	$start = date('m/d/Y', strtotime($payroll_start));
	$end = date('m/d/Y', strtotime($payroll_end));
	$created = date('m/d/Y h:m', strtotime($payroll_created));

	$getItem = $con->prepare("SELECT payrollitem_id FROM rec_payroll_items
		WHERE payroll_id = ?
		LIMIT 1");
	$getItem->bind_param("i", $payroll_id);
	$getItem->execute();
	$getItem->bind_result($payrollitem_id);
	$getItem->fetch();
	$getItem->close();

	//DAYS FOR HEADER
	$dayArr = array();
	$dateArr = array();
	$index = 0;

	$getDays = $con->prepare("SELECT payrollitemdate_day,
		payrollitemdate_date 
		FROM rec_payroll_item_dates
		WHERE payrollitem_id = ?");
	$getDays->bind_param("i", $payrollitem_id);
	$getDays->execute();
	$getDays->store_result();
	$getDays->bind_result($day,
		$date);
	$days = $getDays->num_rows;
	while($getDays->fetch()) {
		array_push($dayArr, $day);
		array_push($dateArr, $date);
	}
	$getDays->close();

	//GET EMPLOYEE LIST
	$employeeArr = array();
	$getEmployees = $con->prepare("SELECT payrollitem_id,
		rec_payroll_items.payroll_id,
		rec_payroll_items.employee_id,
		rec_payroll_items.bonus_id,
		rec_payroll_items.deduction_id,
		rec_payroll_items.payrollitem_timereg,
		rec_payroll_items.payrollitem_timeot,
		rec_payroll_items.payrollitem_basic,
		rec_payroll_items.payrollitem_ot,
		rec_payroll_items.payrollitem_deminimis,
		rec_payroll_items.payrollitem_tmonthamount,
		rec_payroll_items.payrollitem_gross,
		rec_payroll_items.payrollitem_net,
		rec_payroll_items.payrollitem_status,
		rec_payroll_items.payrollitem_lastupdated,
		rec_employees.employee_fname,
		rec_employees.employee_lname,
		rec_employees.employee_wage,
		lib_employee_positions.position_name
		FROM rec_payroll_items
		INNER JOIN rec_employees 
		ON rec_payroll_items.employee_id = rec_employees.employee_id
		INNER JOIN lib_employee_positions
		ON rec_employees.position_id = lib_employee_positions.position_id
		WHERE payroll_id = ?");
	$getEmployees->bind_param("i", $payroll_id);
	$getEmployees->execute();
	$getEmployees->bind_result($payrollitem_id,
		$payroll_id,
		$employee_id,
		$bonus_id,
		$deduction_id,
		$payrollitem_timereg,
		$payrollitem_timeot,
		$payrollitem_basic,
		$payrollitem_ot,
		$payrollitem_deminimis,
		$payrollitem_tmonthamount,
		$payrollitem_gross,
		$payrollitem_net,
		$payrollitem_status,
		$payrollitem_lastupdated,
		$employee_fname,
		$employee_lname,
		$employee_wage,
		$position_name);
	$getEmployees->store_result();
	$employee_count = $getEmployees->num_rows;

	while($getEmployees->fetch()) {
		$newdata =  array (
			'id' => $payrollitem_id,
			'payroll_id' => $payroll_id,
			'employee_id' => $employee_id,
			'bonus_id' => $bonus_id,
			'deduction_id' => $deduction_id,
			'timereg' => $payrollitem_timereg,
			'timeot' => $payrollitem_timeot,
			'basic' => $payrollitem_basic,
			'ot' => $payrollitem_ot,
			'deminimis' => $payrollitem_deminimis,
			'tmonthamount' => $payrollitem_tmonthamount,
			'gross' => $payrollitem_gross,
			'net' => $payrollitem_net,
			'status' => $payrollitem_status,
			'lastupdated' => $payrollitem_lastupdated,
			'fname' => $employee_fname,
			'lname' => $employee_lname,
			'wage' => $employee_wage,
			'position' => $position_name
		);

		array_push($employeeArr,$newdata);

		if($payrollitem_status == 'Completed') $paid++;
	}
	$getEmployees->close();
?>
<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4><i class="fa fa-circle-o legend-ongoing"></i> PAYROLL PROFILE</h4>
	</div>
	<div class="col-xs-12 col-md-6">
		<a onclick="load_payroll();" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-chevron-left"></i> RETURN TO LIST&emsp;</h5>
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
										<label class="mtb0">PAYROLL ID:</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-lg-8">
										<span class="emp-data"><?php echo $payroll_id; ?></span>
									</div>
								</div>
								<div class="row mt5">
									<div class="col-xs-12 col-sm-5 col-lg-4">
										<label class="mtb0">PROJECT:</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-lg-8">
										<span class="emp-data"><?php echo $project_name; ?></span>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-6 plr5">
								<div class="row mt5">
									<div class="col-xs-12 col-sm-5 col-lg-4">
										<label class="mtb0">PAYROLL SPAN:</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-lg-8">
										<span class="emp-data"><?php echo $start . ' to ' . $end; ?></span>
									</div>
								</div>
								<div class="row mt5">
									<div class="col-xs-12 col-sm-5 col-lg-4">
										<label class="mtb0">DATE GENERATED:</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-lg-8">
										<span class="emp-data"><?php echo $created; ?></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row mt20">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-12">
							<h4 class="mt0 mb0"><small><i class="fa fa-asterisk"></i> PAYMENT DETAILS</small></h4>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12 plr10">
							<div class="col-xs-12 col-md-6 plr5">
								<div class="row mt5">
									<div class="col-xs-12 col-sm-5 col-lg-4">
										<label class="mtb0">TOTAL EXPENSES:</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-lg-8">
										<span class="emp-data">&#8369; 124.251</span>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-6 plr5">
								<div class="row mt5">
									<div class="col-xs-12 col-sm-5 col-lg-4">
										<label class="mtb0">PAID PERSONNELS:</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-lg-8">
										<span class="emp-data"><?php echo $paid . '/' . $employee_count; ?></span>
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
									<td colspan="<?= $days; ?>" class="align-center"><h5>DATE RANGE</h5></td>
									<td colspan="3" class="align-center"><h5>TOTAL TIME</h5></td>
									<td colspan="3" class="align-center"><h5>EARNINGS</h5></td>
									<?php if($deduction_count > 0) { ?>
									<td colspan="<?= $deduction_count; ?>" class="align-center"><h5>DEDUCTIONS</h5></td>
									<?php } if($bonus_count > 0) {?>
									<td colspan="<?= $bonus_count; ?>" class="align-center"><h5>BONUSES</h5></td>
									<?php } ?>
									<td colspan="2" class="align-center"><h5>TOTALS</h5></td>
								</tr>
								<tr>
									<td nowrap></td>
									<td nowrap><h5 class="mt15 mb0">ID #</h5></td>
									<td nowrap><h5 class="mt15 mb0">NAME</h5></td>
									<td nowrap><h5 class="mt15 mb0">POSITION</h5></td>
									<td nowrap><h5 class="mt15 mb0">RATES</h5></td>
									
									<?php for($i = 0; $i < count($dateArr); $i++) { 
										$display_date = date_format(date_create($dateArr[$i]), 'd');
									?>
										<td nowrap><h5 class="mtb0"><?php echo $dayArr[$i]. "<br/>" .$display_date; ?></h5></td>
									<?php } ?>

									<td nowrap><h5 class="mtb0">REG<br/>MIN</h5></td>
									<td nowrap><h5 class="mtb0">OT<br/>MIN</h5></td>
									<td nowrap><h5 class="mt15 mb0">TOTAL</h5></td>

									<td nowrap><h5 class="mt15 mb0">BASIC</h5></td>
									<td nowrap><h5 class="mt15 mb0">OT</h5></td>
									<td nowrap><h5 class="mt15 mb0">DE MINIMIS</h5></td>
									<?php for($d = 0; $d < count($_SESSION['deductions']); $d++) { ?>
										<td nowrap><h5 class="mt15 mb0"><?php echo $_SESSION['deductions'][$d]['name']; ?></h5></td>
									<?php } ?>
									<?php for($b = 0; $b < count($_SESSION['bonuses']); $b++) { ?>
										<td nowrap><h5 class="mt15 mb0"><?php echo $_SESSION['bonuses'][$b]['name']; ?></h5></td>
									<?php } ?>

									<td nowrap><h5 class="mt15 mb0">GROSS</h5></td>
									<td nowrap><h5 class="mt15 mb0">NET</h5></td>

								</tr>
							</thead>
							<tbody>
								<?php foreach($employeeArr as $emp) { ?>
								<tr>
									<td nowrap>
										<span class="dropdown pull-right">
											<a class="dropdown-toggle" href="javascript:void(0);" type="button" data-toggle="dropdown" >
												<i class="fa fa-gear"></i>
											</a>
											<ul class="dropdown-menu" style="left:0px; width: 220px;">
												<li>
													<a href="javascript:void(0);" title="" <?php echo "onclick=updateStatus(".$emp['id'].",1)"; ?>>
														<i class="fa fa-flag fa-xs legend-pending"></i> Set as Pending
													</a>
												</li>
												<li>
													<a href="javascript:void(0);" title="" <?php echo "onclick=updateStatus(".$emp['id'].",2)"; ?>>
														<i class="fa fa-flag fa-xs legend-approved"></i> Set as Approved
													</a>
												</li>
												<li>
													<a href="javascript:void(0);" title="" <?php echo "onclick=updateStatus(".$emp['id'].",3)"; ?>>
														<i class="fa fa-flag fa-xs legend-ongoing"></i> Set as Ongoing
													</a>
												</li>
												<li>
													<a href="javascript:void(0);" title="" <?php echo "onclick=updateStatus(".$emp['id'].",4)"; ?>>
														<i class="fa fa-flag fa-xs legend-completed"></i> Set as Completed
													</a>
												</li>
												<li>
													<a href="javascript:void(0);" title="" <?php echo "onclick=updateStatus(".$emp['id'].",5)"; ?>>
														<i class="fa fa-flag fa-xs legend-cancelled"></i> Set as Cancelled
													</a>
												</li>
											</ul>
										</span>
									</td>
									
									<td nowrap><h5 class="mtb0"><?php echo $emp['employee_id']; ?></h5></td>
									<td nowrap><h5 class="mtb0"><?php echo $emp['fname'] . ' ' . $emp['lname']; ?></h5></td>
									<td nowrap><h5 class="mtb0"><?php echo $emp['position']; ?></h5></td>
									<td nowrap><h5 class="mtb0"><?php echo $emp['wage'] . '/hr'; ?></h5></td>

									<?php 
										$getTimes = $con->prepare("SELECT payrollitemdate_day,
											payrollitemdate_date,
											payrollitem_hours
											FROM rec_payroll_item_dates
											WHERE payrollitem_id = ?");
										$getTimes->bind_param("i", $emp['id']);
										$getTimes->execute();
										$getTimes->bind_result($payrollitemdate_day,
											$payrollitemdate_date,
											$payrollitem_hours);
										while($getTimes->fetch()) {
									?>
									<td nowrap><h5 class="mtb0"><?php echo $payrollitem_hours; ?></h5></td>
									<?php } $getTimes->close(); ?>

									<td nowrap><h5 class="mtb0"><?php echo $emp['timereg']; ?></h5></td>
									<td nowrap><h5 class="mtb0"><?php echo $emp['timeot']; ?></h5></td>
									<td nowrap><h5 class="mtb0"><?php echo ($emp['timereg'] + $emp['timeot']); ?></h5></td>

									<td nowrap><h5 class="mtb0"><?php echo $emp['basic']; ?></h5></td>
									<td nowrap><h5 class="mtb0"><?php echo $emp['ot']; ?></h5></td>
									<td nowrap><h5 class="mtb0"><?php echo $emp['deminimis']; ?></h5></td>
								
									<?php 
									for($d = 0; $d < count($_SESSION['deductions']); $d++) { 
										if($emp['deduction_id' ] == '')
											$value = 0;
										else {
											$deductions = explode(",", $emp['deduction_id' ]);
											if(in_array($_SESSION['deductions'][$d]['id'], $deductions))
												if($_SESSION['deductions'][$d]['amount'] != 0)
													$value = $_SESSION['deductions'][$d]['amount'];
												else
													$value = ($emp['wage']*(8*30))*($_SESSION['deductions'][$d]['percent']/100);
											else
												$value = 0;
										}
									?>
									<td nowrap><h5 class="mtb0"><?php echo $value; ?></h5></td>
									<?php } 
									for($d = 0; $d < count($_SESSION['bonuses']); $d++) { 
										if($emp['bonus_id' ] == '')
											$value = 0;
										else {
											$bonuses = explode(",", $emp['bonus_id' ]);
											if(in_array($_SESSION['bonuses'][$d]['id'], $bonuses))
												if($_SESSION['bonuses'][$d]['amount'] != 0)
													$value = $_SESSION['bonuses'][$d]['amount'];
												else
													$value = ($emp['wage']*(8*30))*($_SESSION['bonuses'][$d]['percent']/100);
											else
												$value = 0;
										}
									?>
									<td nowrap><h5 class="mtb0"><?php echo $value; ?></h5></td>
									<?php } ?>

									<td nowrap><h5 class="mtb0"><?php echo $emp['gross']; ?></h5></td>
									<td nowrap><h5 class="mtb0"><?php echo $emp['net']; ?></h5></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	function updateStatus(id, status) {
		var new_status = "";

		switch (status) {
			case 1:
				new_status = 'Pending';
				break;
			case 2:
				new_status = 'Approved';
				break;
			case 3:
				new_status = 'Ongoing';
				break;
			case 4:
				new_status = 'Completed';
				break;
			case 5:
				new_status = 'Cancelled';
				break;
		}

		$.ajax({
			url: '../../submits/payroll/update_payroll_status.php',
			type: 'POST',
			data: {item_id: id, item_status: new_status},
			datatype: 'json',
			encode : true
		})
		.done(function(data) {
			data = jQuery.parseJSON(data);
			
			if(!data.success)
				console.log(data.error);
		});

		load_payroll_profile(<?php echo $payroll_id; ?>);
	}
</script>