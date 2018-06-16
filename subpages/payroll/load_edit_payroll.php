<?php
	include('../../includes/module.php');

	$id = 0;	
	$employee_ids = array();

	if(!isset($_GET['payroll_id']))
		header('Location: /sbes/');
	else 
		$payroll_id = $_GET['payroll_id'];

	/**
	 * GET PAYROLL
	 */
	$get_payroll = $con->prepare("SELECT 
		project_id,
		payroll_start,
		payroll_end
		FROM rec_payroll_drafts
		WHERE payroll_id = ?");
	$get_payroll->bind_param("i",
		$payroll_id);
	$get_payroll->execute();
	$get_payroll->bind_result($project_id,
		$payroll_start,
		$payroll_end);
	$get_payroll->fetch();
	$get_payroll->close();
	// END GET PAYROLL

	/**
	 * GET PAYROLL ITEMS
	 */
	$payroll_items = array();
	$get_items = $con->prepare("SELECT 
		rec_payroll_item_drafts.payrollitem_id,
		rec_payroll_item_drafts.employee_id,
		rec_payroll_item_drafts.bonus_id,
		rec_payroll_item_drafts.deduction_id,
		rec_payroll_item_drafts.payrollitem_timereg,
		rec_payroll_item_drafts.payrollitem_timeot,
		rec_payroll_item_drafts.payrollitem_basic,
		rec_payroll_item_drafts.payrollitem_ot,
		rec_payroll_item_drafts.payrollitem_deminimis,
		rec_payroll_item_drafts.payrollitem_tmonthamount,
		rec_payroll_item_drafts.payrollitem_gross,
		rec_payroll_item_drafts.payrollitem_net,
		rec_employees.employee_fname,
		rec_employees.employee_lname,
		rec_employees.employee_wage,
		lib_employee_positions.position_name
		FROM rec_payroll_item_drafts 
		INNER JOIN rec_employees
		ON rec_payroll_item_drafts.employee_id = rec_employees.employee_id
		INNER JOIN lib_employee_positions
		ON rec_employees.position_id = lib_employee_positions.position_id
		WHERE rec_payroll_item_drafts.payroll_id = ?");
	$get_items->bind_param("i",
		$payroll_id);
	$get_items->execute();
	$get_items->store_result();
	$checked = $get_items->num_rows;
	$get_items->bind_result(
		$payrollitem_id,
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
		$employee_fname,
		$employee_lname,
		$employee_wage,
		$position_name);

	$index = 0;

	while($get_items->fetch()) {
		$payroll_items[$index]['payrollitem_id'] = $payrollitem_id;
		$payroll_items[$index]['employee_id'] = $employee_id;
		$payroll_items[$index]['bonus_id'] = $bonus_id;
		$payroll_items[$index]['deduction_id'] = $deduction_id;
		$payroll_items[$index]['timereg'] = $payrollitem_timereg;
		$payroll_items[$index]['timeot'] = $payrollitem_timeot;
		$payroll_items[$index]['basic'] = $payrollitem_basic;
		$payroll_items[$index]['ot'] = $payrollitem_ot;
		$payroll_items[$index]['deminimis'] = $payrollitem_deminimis;
		$payroll_items[$index]['tmonthamount'] = $payrollitem_tmonthamount;
		$payroll_items[$index]['gross'] = $payrollitem_gross;
		$payroll_items[$index]['net'] = $payrollitem_net;
		$payroll_items[$index]['fname'] = $employee_fname;
		$payroll_items[$index]['lname'] = $employee_lname;
		$payroll_items[$index]['wage'] = $employee_wage;
		$payroll_items[$index++]['position'] = $position_name;
	}
	// END GET PAYROLL ITEMS
	getBonusesAndDeductions();

	$deduction_count = count($_SESSION['deductions']);
	$bonus_count = count($_SESSION['bonuses']);
?>

<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4>GENERATE PAYROLL</h4>
	</div>
	<div class="col-xs-12 col-md-6">
		<a onclick="load_payroll();" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-chevron-left"></i> RETURN TO LIST&emsp;</h5>
		</a>
		<a onclick="update_draft(1);" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-edit"></i> UPDATE DRAFT&emsp;|&emsp;</h5>
		</a>
		<a onclick="add_payroll(2);" href="javascript:void(0);">
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
						<form id="payroll_form" action="../../submits/payroll/update_payroll.php" method="POST">
						<input type='hidden' name="payroll_id" id="payroll_id" value="<?= $payroll_id ?>" />
						<input type='hidden' name="is_draft" id="is_draft" value="1" />
						<input type='hidden' name="record_count" id="record_count" value="<?= $checked ?>" />
						<input type='hidden' name="all_ids" id="all_ids" value="0" />
						<input type='hidden' name="checked_ids" id="checked_ids" value="0" />
						<input type='hidden' name="days_count" id="days_count" value="0" />
						<input type='hidden' name="payroll_start" id="payroll_start" value="<?= $payroll_start ?>" />
						<input type='hidden' name="payroll_end" id="payroll_end" value="<?= $payroll_end ?>" />
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
											<input type="checkbox" style="margin-top:-4px;" class="deduction" name="<?php echo $name.'-checkbox'; ?>" 
											onclick="checkbox_listener(this);"/> <?php echo $_SESSION['deductions'][$i]['name']; ?>
										</h5>
									</td>
									<?php }  ?>

									<?php for($i = 0; $i < $bonus_count; $i++) {
										$name = preg_replace('/\s+/', '', $_SESSION['bonuses'][$i]['name']);
									?>
									<td nowrap>
										<h5 class="mt15 mb0">
											<input type="checkbox" style="margin-top:-4px;" class="bonus" name="<?php echo $name.'-checkbox'; ?>" 
											onclick="checkbox_listener(this);"/> <?php echo $_SESSION['bonuses'][$i]['name']; ?>
										</h5>
									</td>
									<?php }  ?>

									<td nowrap><h5 class="mt15 mb0">GROSS</h5></td>
									<td nowrap><h5 class="mt15 mb0">NET</h5></td>

								</tr>
							</thead>
							<tbody id="employee-list">
								<?php 
									foreach ($payroll_items as $key => $payroll) {
								?>
								<tr>
									<td nowrap>
										<input type="checkbox" class="id-checkbox" id="<?= 'checkbox'.$employee_id; ?>" 
											onclick="checkEmployees(this);" value="<?= $employee_id ?>" checked/>
									</td>
									<td nowrap><h5 class="mtb0"><?php echo $payroll['employee_id']; ?></h5></td>
									<td nowrap><h5 class="mtb0"><?php echo $payroll['fname']; ?></h5></td>
									<td nowrap><h5 class="mtb0"><?php echo $payroll['lname']; ?></h5></td>
									<td nowrap>
										<h5 class="mtb0">
											<input type="number" class="form-control payroll-input" step="0.1" id="<?= 'input_wage'.$employee_id; ?>" value="<?= $payroll['wage'] ?>"  onchange="calculateBasic(<?php echo $payroll['employee_id']; ?>);" placeholder="Hourly rate..." />	
										</h5>
									</td>

									<!-- dates -->
									<?php 
										$get_dates = $con->prepare("SELECT
											payrollitemdate_day,
											payrollitemdate_date,
											payrollitem_hours
											FROM rec_payroll_item_date_drafts
											WHERE payrollitem_id = ?");
										$get_dates->bind_param("i",
											$payroll['payrollitem_id']);
										$get_dates->execute();
										$get_dates->bind_result(
											$payrollitemdate_day,
											$payrollitemdate_date,
											$payrollitem_hours);
										$input_count = 1;
										while ($get_dates->fetch()) {
									?>
									<td nowrap>
										<h5 class="mtb0">
										<input type="number" id="<?= 'input_minutes'.$payroll['employee_id'].$input_count; ?>" name="<?= 'input_minutes'.$employee_id.$input_count++; ?>" onchange="calculateBasic(<?php echo $payroll['employee_id']; ?>);" class="form-control payroll-input" step="0.1" value="<?= $payrollitem_hours; ?>" placeholder="Minutes worked..." />	</h5>
									</td>
									<?php } ?>	

										<!-- total time -->
									<td nowrap>
										<input type="number" class="form-control payroll-input" id="<?= 'input_regular_time'.$payroll['employee_id']; ?>" name="<?= 'input_regular_time'.$payroll['employee_id']; ?>" step="0.1" onchange="calculateTotalMinutesAndPay(<?php echo $payroll['employee_id'] ?>);" value="<?= $payroll['timereg']; ?>" placeholder="Minutes worked..." />	
									</td>
									<td nowrap>	
										<input type="number" class="form-control payroll-input" id="<?= 'input_OT'.$payroll['employee_id']; ?>" name="<?= 'input_OT'.$payroll['employee_id']; ?>" step="0.1" onchange="calculateTotalMinutesAndPay(<?php echo $payroll['employee_id'] ?>);"  value="<?= $payroll['timeot']; ?>" placeholder="Minutes worked..." />	
									</td>
									<td nowrap>
										<input type="number" class="form-control payroll-input" id="<?= 'total_time'.$payroll['employee_id']; ?>"  name="<?= 'total_time'.$payroll['employee_id']; ?>"	value="<?= $payroll['timereg'] + $payroll['timeot'];; ?>" readonly/>	
									</td>

									<!-- EARNINGS -->
									<td nowrap><h5 class="mtb0"><input type="number" id="<?= 'input_basic'.$payroll['employee_id']; ?>" name="<?= 'input_basic'.$payroll['employee_id']; ?>" class="form-control payroll-input" step="0.1" value="<?= $payroll['basic']; ?>" placeholder="Minutes worked..." /></td>
									<td nowrap><h5 class="mtb0"><input type="number" id="<?= 'input_ot_pay'.$payroll['employee_id']; ?>" name="<?= 'input_ot_pay'.$payroll['employee_id']; ?>" class="form-control payroll-input" step="0.1" value="<?= $payroll['ot']; ?>" placeholder="Minutes worked..." /></td>
									<td nowrap>
										<h5 class="mtb0">
											<input type="number" id="<?= 'deminimis'.$payroll['employee_id']; ?>" name="<?= 'deminimis'.$payroll['employee_id']; ?>" class="form-control payroll-input" step="0.1" value="<?= $payroll['deminimis'] ?>" placeholder="Minutes worked..." />	
										</h5>
									</td>

									<!-- DEDUCTIONS -->
									<?php for($d = 0; $d < count($_SESSION['deductions']); $d++) { 
										if($_SESSION['deductions'][$d]['amount'] != 0)
											$deduction = $_SESSION['deductions'][$d]['amount'];
										else
											$deduction = ($payroll['wage']*(8*30))*($_SESSION['deductions'][$d]['percent']/100);
										$name = preg_replace('/\s+/', '', $_SESSION['deductions'][$d]['name']);
										$deduction_id = $_SESSION['deductions'][$d]['id']; 
										$deduction_values = $deduction_id . ',' . $deduction . ',' . $payroll['employee_id'];
									?>
									<td nowrap>
										<h5 class="mtb0">
											<input type="checkbox" class="<?= $name.'-checkbox' ?>" name="deduction[]" value="<?= $deduction_values ?>" onclick="checkDeduction(this);"/> <?php echo $deduction; ?>
										</h5>
									</td>
									<?php } ?>
								 
									<!-- BONUSES -->
									<?php for($b=0; $b<count($_SESSION['bonuses']); $b++) { 
										if($_SESSION['bonuses'][$b]['amount'] != 0)
											$bonus 		= $_SESSION['bonuses'][$b]['amount'];
										else
											$bonus		= ($payroll['wage']*(8*30))*($_SESSION['bonuses'][$b]['percent']/100);

										$name = preg_replace('/\s+/', '', $_SESSION['bonuses'][$b]['name']);
										$bonus_id = $_SESSION['bonuses'][$b]['id']; 
										$bonus_values = $bonus_id . ',' . $bonus . ',' . $payroll['employee_id'];
									?>
									<td nowrap>
										<h5 class="mtb0">
											<input type="checkbox" class="<?= $name.'-checkbox'; ?>" name="bonus[]" value="<?= $bonus_values; ?>" onclick="checkBonus(this);"/> <?php echo $bonus; ?>
										</h5>
									</td>
									<?php } ?>

									<!-- TOTALS -->
									<td nowrap><input type="number" id="<?= 'gross_pay'.$payroll['employee_id']; ?>" name="<?= 'gross_pay'.$payroll['employee_id']; ?>" class="form-control payroll-input" value="<?= $payroll['gross'] ?>" readonly/></td>
									<td nowrap><input type="number" id="<?= 'net_pay'.$payroll['employee_id']; ?>" name="<?= 'net_pay'.$payroll['employee_id']; ?>" class="form-control payroll-input" value="<?= $payroll['net'] ?>" readonly/></td> 
								</tr>
								<?php } ?>
							</tbody>
						</table>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="subpages/payroll/js/load_add_payroll.js"></script>
<script type="text/javascript">
	var edit_or_draft = 2; //SAVE FROM DRAFT
	checked_employees = <?php echo $checked; ?>;

	var firstday = '<?php echo date_format(date_create($payroll_start), "m/d/Y"); ?>';
	var lastday = '<?php echo date_format(date_create($payroll_end), "m/d/Y"); ?>';

	<?php for($i = 0; $i < $index; $i++) { ?>
		employee_idArr[id_count++] =  <?php echo $payroll_items[$i]['employee_id'] ?>;
	<?php } ?>	

	$("#all_ids").val(employee_idArr.join(','));
	$("#checked_ids").val(employee_idArr.join(','));

	$('#search_daterange').daterangepicker({
		startDate: formatDate(firstday),
    	endDate: formatDate(lastday)
	});

	first_display = new Date(firstday).toUTCString();
	last_display = new Date(lastday).toUTCString();

	$("#payroll_start").val(first_display);
	$("#payroll_end").val(last_display);

	display_days(new Date(firstday), new Date(lastday));

	function update_draft(id) {
		
		if(id == 0) {
			$("#is_draft").val("0");
			
			if(checked_employees == 0)
				alert("No employee selected.");
			else 
				$("#payroll_form").submit();
		} else if (id == 1) {
			$("#is_draft").val("1");
			$("#payroll_form").submit();
		}
	}
</script>
<script src="subpages/payroll/js/date_functions.js"></script>