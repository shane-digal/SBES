<style type="text/css">
#employee_avatar_display
{
	transition:all 200ms ease-in-out;
	background: #676767;
}
.img-remove-btn
{
	background: #FF7070;
    border: none;
    width: 30px;
    height: 30px;
    color: white;
}
</style>


<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4 id="update-label">UPDATE EMPLOYEE</h4>
	</div>
	<div class="col-xs-12 col-md-6">
		<a onclick="return_to_emp_profile();" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-chevron-left"></i> RETURN TO EMPLOYEE DETAIL&emsp;</h5>
		</a>
		<a onclick="submitUpdatedEmployee()" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-check"></i> UPDATE EMPLOYEE&emsp;|&emsp;</h5>
		</a>
	</div>
</div>
<div class="row">
	<form id="form-new_employee">
	<input type="submit" id="submit-btn" hidden>
	<div class="col-xs-12 plr10">
		<div class="col-xs-12 col-md-8 plr5">
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
								<div class="col-xs-12 col-sm-5 col-md-4 plr5">
									<!-- <div class="row" hidden>
										<div class="col-xs-12">
											<label class="mt10">AVATAR</label>
										</div>
										<div class="col-xs-12 img img100" id="image-preview">
											<div class="img img100" style="background:url('http://127.0.0.1/sbes/resources/theme/dist/img/user2-160x160.jpg');">
											</div>
											<label for="image-upload" id="image-label">Choose File</label>
											<input type="file" name="image" id="image-upload" />
										</div>
									</div> -->
									<div class="row">
										<div class="col-xs-12">
											<div class="col-xs-12 plr0">
												<label class="mt5 mb0">AVATAR</label>
												<input type="file" name="imageAvatar" id="employee_avatar" class="hidden"  accept="image/*"/>
												<p id="employee_avatar_remove_cont" style="position: absolute; right:0; margin:0px;"></p>
												<label for="employee_avatar" style="width:100%; display:absolute;">
													<div id="employee_avatar_display" class="img img100">
													</div>
												</label>
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-7 col-md-8">
									<div class="row">
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">FIRST NAME</label>
											<input
												type="text"
												name="firstname"
												class="form-control pull-right"
												placeholder="Enter first name..."
												required
											/>
										</div>
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">MIDDLE NAME</label>
											<input
												type="text"
												name="middlename"
												class="form-control pull-right"
												placeholder="Enter middle name..."
												required
											/>
										</div>
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">LAST NAME</label>
											<input
												type="text"
												name="lastname"
												class="form-control pull-right"
												placeholder="Enter last name..."
												required
											/>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">POSITION</label>
											<select
												class="form-control"
												name="position"
												id="position"
												required
											>
											</select>
										</div>
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">STATUS</label>
											<select
												class="form-control"
												name="status"
											>
												<option value="CONTRACTUAL">CONTRACTUAL</option>
												<option value="JOB ORDER">JOB ORDER</option>
												<option value="REGULAR">REGULAR</option>
												<option value="SUSPENDED">SUSPENDED</option>
											</select>
										</div>
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">WAGE</label>
											<div class="input-group">
														<div class="input-group-addon">
													<b>&#8369;</b>
												</div>
												<input
													type="number"
													name="wage"
													class="form-control pull-right align-right"
													placeholder="0.00"
													min="0"
													step="0.1"
													required
												>
											</div>
										</div>
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">ASSIGNMENT</label>
											<select
												class="form-control"
												name="assignment"
												id = "assignment"
											>
												<option value="0"> None </option>
											</select>
										</div>
										<div class="col-md-8 plr5">
											<label class="mt10">NOTE</label>
											<textarea
												class="form-control"
												placeholder="Enter note for this employee..."
												name="remarks"
												rows="1"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 plr10">
					<div class="col-xs-12 col-sm-6 col-md-6 plr5">
						<div class="my-container mt10">
							<div class="row">
								<div class="col-xs-12">
									<h4 class="mt0 mb0"><small><i class="fa fa-list"></i> BONUSES</small></h4>
								</div>
							</div>
							<div class="row mt10">
								<div class="col-xs-12 bonuses-list">
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-6 col-md-6 plr5">
						<div class="my-container mt10">
							<div class="row">
								<div class="col-xs-12">
									<h4 class="mt0 mb0"><small><i class="fa fa-list"></i> DEDUCTIONS</small></h4>
								</div>
							</div>
							<div class="row mt10">
								<div class="col-xs-12 deduction-list">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-4 plr5">
			<div class="my-container mt10">
				<div class="row">
					<div class="col-xs-12">
						<h4 class="mt0 mb0"><small><i class="fa fa-clock-o"></i> SCHEDULE DETAILS</small></h4>
					</div>
				</div>


				<?php
					$days = ['SUN', 'MON', 'TUE', 'WED', 'THU', 'FRI', 'SAT'];
					foreach ($days as $key => $value) {
						?>
						<div class="row " >
							<div class="col-xs-12 plr10">
								<div class="col-xs-12 plr5">
									<label class="mt10 mb0 my-cb-label"><?=$value?>
										<input type="checkbox" class="my-cb" name="schedule_days[]" data-index=<?=$key?> value="<?=$value?>">
										<span></span>
									</label>
								</div>
								<div class="col-xs-6 plr5 bootstrap-timepicker">
									<h5 class="mt5 mb5"><small>FROM</small></h5>
									<div class="input-group">
										<input type="text" class="form-control timepicker from-time <?= $value?>" name="time-from[]" disabled>
										<div class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</div>
									</div>
								</div>
								<div class="col-xs-6 plr5 bootstrap-timepicker">
									<h5 class="mt5 mb5"><small>TO</small></h5>
									<div class="input-group">
										<input type="text" class="form-control timepicker to-time <?= $value?>" name="time-to[]" disabled>
										<div class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</div>
									</div>
								</div>
							</div>
						</div>

						<?php
					}
				?>
					<div id="for-hidden-data">

					</div>
			</div>
		</div>
	</div>
	</form>
</div>

<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content br13">
			<div class="modal-body plr15" id="selection_cont">
			</div>
		</div>
	</div>
</div>

<script src="subpages/employees/edit_employee.js"></script>
<script src="subpages/employees/add_edit_shared_controls.js"></script>
