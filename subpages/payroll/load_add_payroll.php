<?php
	include('../../includes/module.php');

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
		<a onclick="add_payroll(1);" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-folder-open-o"></i> SAVE TO DRAFTS&emsp;|&emsp;</h5>
		</a>
		<a onclick="add_payroll(0);" href="javascript:void(0);">
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
						<form id="payroll_form" action="../../submits/payroll/add_payroll.php" method="POST">
						<input type='hidden' name="is_draft" id="is_draft" value="0" />
						<input type='hidden' name="record_count" id="record_count" value="0" />
						<input type='hidden' name="all_ids" id="all_ids" value="0" />
						<input type='hidden' name="checked_ids" id="checked_ids" value="0" />
						<input type='hidden' name="days_count" id="days_count" value="0" />
						<input type='hidden' name="payroll_start" id="payroll_start" value="0" />
						<input type='hidden' name="payroll_end" id="payroll_end" value="0" />
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
	var edit_or_draft = 0;
	display_days(new Date(curr.setDate(first)), new Date(curr.setDate(last)));
	load_employees(firstday, lastday);
</script>
<script src="subpages/payroll/js/load_add_payroll.js"></script>