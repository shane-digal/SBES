<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4>REGISTER NEW EMPLOYEE</h4>
	</div>
	<div class="col-xs-12 col-md-6">
		<a onclick="load_employee();" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-chevron-left"></i> RETURN TO LIST&emsp;</h5>
		</a>
		<a href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-check"></i> REGISTER EMPLOYEE&emsp;|&emsp;</h5>
		</a>
	</div>
</div>
<div class="row">
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
								<div class="col-xs-12 col-sm-5 col-md-3 plr5">
									<div class="row">
										<div class="col-xs-12">
											<label class="mt10">AVATAR</label>
										</div>
										<div class="col-xs-12">
											<div class="img img100" style="background:url('http://127.0.0.1/sbes/resources/theme/dist/img/user2-160x160.jpg');">
											</div>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-7 col-md-9">
									<div class="row">
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">FIRST NAME</label>
											<input 
												type="text" 
												class="form-control pull-right" 
												placeholder="Enter first name..."
											/>
										</div>
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">MIDDLE NAME</label>
											<input
												type="text" 
												class="form-control pull-right" 
												placeholder="Enter middle name..."
											/>
										</div>
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">LAST NAME</label>
											<input 
												type="text" 
												class="form-control pull-right" 
												placeholder="Enter last name..."
											/>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">POSITION</label>
											<select 
												class="form-control"
												id="search_project"
											>
												<option>Position 1</option>
												<option>Position 2</option>
												<option>Position 3</option>
											</select>
										</div>
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">STATUS</label>
											<select 
												class="form-control"
												id="search_project"
											>
												<option>Contractual</option>
												<option>Job Order</option>
												<option>Regular</option>
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
													class="form-control pull-right align-right"
													placeholder="0.00"
													min="0"
													step="0.1" 
												>
											</div>
										</div>
										<div class="col-xs-12 col-md-4 plr5">
											<label class="mt10">ASSIGNMENT</label>
											<select 
												class="form-control"
												id="search_project"
											>
												<option>Project 1</option>
												<option>Project 2</option>
												<option>Project 3</option>
												<option>Project 4</option>
												<option>Project 5</option>
											</select>
										</div>
										<div class="col-md-8 plr5">
											<label class="mt10">NOTE</label>
											<textarea class="form-control" placeholder="Enter note for this employee..." rows="1"></textarea>
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
								<div class="col-xs-12">
									<label class="label-data">
										<input type="checkbox" checked/> CHRISTMAS BONUS
									</label>
									<label class="label-data">
										<input type="checkbox" checked/> SAMPLE BONUS 1
									</label>
									<label class="label-data">
										<input type="checkbox" checked/> SAMPLE BONUS 2
									</label>
									<label class="label-data">
										<input type="checkbox" checked/> SAMPLE BONUS 3
									</label>
									<label class="label-data">
										<input type="checkbox" checked/> SAMPLE BONUS 4
									</label>
									<label class="label-data">
										<input type="checkbox" checked/> SAMPLE BONUS 5
									</label>
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
								<div class="col-xs-12">
									<label class="label-data">
										<input type="checkbox" checked/> SSS
									</label>
									<label class="label-data">
										<input type="checkbox" checked/> PHIL HEALTH
									</label>
									<label class="label-data">
										<input type="checkbox" checked/> PAG-IBIG
									</label>
									<label class="label-data">
										<input type="checkbox" checked/> TAX
									</label>
									<label class="label-data">
										<input type="checkbox" checked/> SAMPLE DEDUCTION 1
									</label>
									<label class="label-data">
										<input type="checkbox" checked/> SAMPLE DEDUCTION 2
									</label>
									<label class="label-data">
										<input type="checkbox" checked/> SAMPLE DEDUCTION 3
									</label>
									<label class="label-data">
										<input type="checkbox" checked/> SAMPLE DEDUCTION 4
									</label>
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
				<div class="row">
					<div class="col-xs-12 plr10">
						<div class="col-xs-12 plr5">
							<label class="mt10 mb0 my-cb-label">SUN 
								<input type="checkbox" class="my-cb">
								<span></span>
							</label>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>FROM</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>TO</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 plr10">
						<div class="col-xs-12 plr5">
							<label class="mt10 mb0 my-cb-label">MON 
								<input type="checkbox" class="my-cb">
								<span></span>
							</label>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>FROM</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>TO</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 plr10">
						<div class="col-xs-12 plr5">
							<label class="mt10 mb0 my-cb-label">TUE 
								<input type="checkbox" class="my-cb">
								<span></span>
							</label>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>FROM</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>TO</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 plr10">
						<div class="col-xs-12 plr5">
							<label class="mt10 mb0 my-cb-label">WED 
								<input type="checkbox" class="my-cb">
								<span></span>
							</label>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>FROM</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>TO</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 plr10">
						<div class="col-xs-12 plr5">
							<label class="mt10 mb0 my-cb-label">THU 
								<input type="checkbox" class="my-cb">
								<span></span>
							</label>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>FROM</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>TO</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 plr10">
						<div class="col-xs-12 plr5">
							<label class="mt10 mb0 my-cb-label">FRI 
								<input type="checkbox" class="my-cb">
								<span></span>
							</label>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>FROM</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>TO</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 plr10">
						<div class="col-xs-12 plr5">
							<label class="mt10 mb0 my-cb-label">SAT 
								<input type="checkbox" class="my-cb">
								<span></span>
							</label>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>FROM</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
						<div class="col-xs-6 plr5 bootstrap-timepicker">
							<h5 class="mt5 mb5"><small>TO</small></h5>
							<div class="input-group">
								<input type="text" class="form-control timepicker">
								<div class="input-group-addon">
									<i class="fa fa-clock-o"></i>
								</div>
							</div>
						</div>
					</div>
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

<script type="text/javascript">
    $('.timepicker').timepicker({showInputs: false});
</script>