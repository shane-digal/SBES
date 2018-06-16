<?php
	$user_id = $_GET['employee_id'];
	include('../../includes/module.php');

	$sql = "SELECT
				COALESCE(project_name, 'NONE') as project_name,
				COALESCE(re.project_id, 0) as project_id,
				lep.position_name as position_name,
				re.position_id as position_id,
				fnFormatUserId(employee_id) as formattedEmpId,
				employee_id as emp_id,
				SetFullName(employee_id) as fullName,
				re.employee_fname as firstname,
				re.employee_mname as middlename,
				re.employee_lname as lastname,
				IF(employee_imagepath NOT IN ('', 'BLANK'), employee_imagepath  ,  '') as imgpath,
				employee_wage,
				employee_empstatus,
				IF(trim(employee_remarks) != '', employee_remarks  ,  'NONE') as emp_remarks
			FROM rec_employees re
			LEFT JOIN rec_projects rp
				ON re.project_id = rp.project_id
			LEFT JOIN lib_employee_positions lep
				ON lep.position_id = re.position_id
			WHERE employee_id = ?";
	$sql = $con->prepare($sql);
	$sql->bind_param('i', $user_id);
	$sql->execute();
	$res = $sql->get_result();
	$data = $res->fetch_all(MYSQLI_ASSOC);
	$sql->execute();
	$sql->bind_result(
		$project_name,
		$project_id,
		$position_name,
		$position_id,
		$employee_id,
		$emp_id,
		$full_name,
		$firstname,
		$middlename,
		$lastname,
		$employee_imagepath,
		$employee_wage,
		$emp_status,
		$employee_remarks
	);

	while($sql->fetch())
	{
?>

<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4> EMPLOYEE PROFILE ID #<?= $employee_id ?></h4>
	</div>
	<div class="col-xs-12 col-md-6">
		<a onclick="load_employee();" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-chevron-left"></i> RETURN TO LIST&emsp;</h5>
		</a>
		<a href="#" onClick="updateEmployeeStatus('DEACTIVATED')">
			<h5  class="pull-right"><i class="fa fa-trash"></i> REMOVE&emsp;|&emsp;</h5>
		</a>
		<a href="#" class="suspend-link" onCLick="updateEmployeeStatus('SUSPENDED')">
			<h5 class="pull-right"><i class="fa fa-user-times"></i> SUSPEND&emsp;|&emsp;</h5>
		</a>
		<a href="#" class="unsuspend-link" onCLick="updateEmployeeStatus('CONTRACTUAL')">
			<h5 class="pull-right"><i class="fa fa-user"></i> UNSUSPEND&emsp;|&emsp;</h5>
		</a>
		<a onclick="load_edit_employee()" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-check"></i> UPDATE&emsp;|&emsp;</h5>
		</a>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<!-- <p class="text-warning"><i class="fa fa-exclamation-triangle"></i> This employee still needs fingerprint data... <a href="#"><i class="fa fa-forumbee"></i> click here for verification.</a></p> -->
	</div>
</div>
<div class="row">
	<div class="col-xs-12 plr10">
		<div class="col-xs-12 col-md-9 plr5">
			<div class="row">
				<div class="col-xs-12">
					<div class="my-container mt10">
						<div class="row">
							<div class="col-xs-12">
								<h4 class="mt0 mb0"><small><i class="fa fa-user-o"></i> PERSONAL & EMPLOYMENT DETAILS</small></h4>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 plr10">
								<div class="col-xs-12 col-sm-5 col-md-3 plr5">
									<div class="row">
										<div class="col-xs-12">
											<label class="mt10">AVATAR</label>
										</div>
										<div class="col-xs-12">
											<div class="img img100" style="background:url('<?= $employee_imagepath?>');">
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-7 col-md-9">
									<div class="row">
										<div class="col-xs-12 plr5">
											<label class="mt10">FULL NAME</label>
											<h4 class="mt0 mb0"><?= $full_name?></h4>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">POSITION</label>
											<h4 class="mt0 mb0">
												<?= $position_name ?>
												<span class="emp-data text-gray">
													<small><?= $emp_status?></small>
												</span>
											</h4>
										</div>
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">WAGE</label>
											<h4 class="mt0 mb0">&#8369;<?= $employee_wage?>/hr</h4>
										</div>
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">ASSIGNMENT</label>
											<h4 class="mt0 mb0"><?= $project_name?></h4>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 plr5">
											<label class="mt10">NOTE</label>
											<h4 class="mt0 mb0"><?= $employee_remarks?></h4>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php
	}
	?>

			<div class="row">
				<div class="col-xs-12 plr10">
					<div class="col-xs-12 col-sm-6 col-md-4 plr5">
						<div class="my-container mt10">
							<div class="row">
								<div class="col-xs-12">
									<h4 class="mt0 mb0"><small><i class="fa fa-list"></i> BONUSES & DEDUCTIONS</small></h4>
								</div>
							</div>
							<div class="row mt10">
								<div class="col-xs-12">
									<label class="mt10">BONUSES</label>
								</div>
								<div class="col-xs-12" id="bonuses-container">

								</div>
							</div>
							<div class="row">
								<div class="col-xs-12">
									<hr class="mt5 mb0"/>
									<label class="mt10">DEDUCTIONS</label>
								</div>
								<div class="col-xs-12" id="deductions-container">

								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-8 plr5">
						<div class="my-container mt10">
							<div class="row">
								<div class="col-xs-12">
									<h4 class="mt0 mb0"><small><i class="fa fa-file-o"></i> FILE ATTACHMENTS</small></h4>
								</div>
							</div>

							<div class="row mt10">
								<div class="file-container col-xs-12 plr10">


								</div>
							</div>

							<div class="row mt10">
								<div class="col-xs-12">
									<label class="mt10 my-btn align-center trans300">
									<form id="file_upload">
											<input name="files[]" multiple="multiple" type="file"
												class="hidden" onChange="submitFiles()"/>
											UPLOAD FILES
											<i class="fa fa-upload pull-right mt5"></i>
											<input type="submit" id="submit-file-btn" hidden>
										</form>
									</label>
								</div>
								<div class="col-xs-12">
									<p class="mt0 mb0 text-info"><small>* You may upload contracts, resume, profiles, etc. pertaining to this employee *</small></p>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-3 plr5">
			<div class="my-container mt10">
				<div class="row">
					<div class="col-xs-12">
						<h4 class="mt0 mb0"><small><i class="fa fa-clock-o"></i> SCHEDULE DETAILS</small></h4>
					</div>
				</div>

				<div id="schedule-container">

				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content br13">
			<div class="modal-body plr15" id="selection_cont">
			</div>
		</div>
	</div>
</div>

<script>
	var empData = <?= json_encode($data[0]) ?>;
	var emp_id = '<?= $user_id?>' ;
	$('input[name="emp_id"]').val(emp_id);
</script>
<script src="subpages/employees/load_employee_profile.js"></script>
