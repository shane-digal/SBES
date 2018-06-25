
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
										<span class="emp-data">10412311</span>
									</div>
								</div>
								<div class="row mt5">
									<div class="col-xs-12 col-sm-5 col-lg-4">
										<label class="mtb0">PROJECT:</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-lg-8">
										<span class="emp-data">DDP SYSTEMS DEVELOPMENT</span>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-md-6 plr5">
								<div class="row mt5">
									<div class="col-xs-12 col-sm-5 col-lg-4">
										<label class="mtb0">PAYROLL SPAN:</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-lg-8">
										<span class="emp-data">7/15/17 to 7/21/17</span>
									</div>
								</div>
								<div class="row mt5">
									<div class="col-xs-12 col-sm-5 col-lg-4">
										<label class="mtb0">DATE GENERATED:</label>
									</div>
									<div class="col-xs-12 col-sm-7 col-lg-8">
										<span class="emp-data">7/21/17 19:11</span>
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
										<span class="emp-data">12/54</span>
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
									<td colspan="7" class="align-center"><h5>DATE RANGE</h5></td>
									<td colspan="3" class="align-center"><h5>TOTAL TIME</h5></td>
									<td colspan="3" class="align-center"><h5>EARNINGS</h5></td>
									<td colspan="4" class="align-center"><h5>DEDUCTIONS</h5></td>
									<td colspan="1" class="align-center"><h5>BONUSES</h5></td>
									<td colspan="2" class="align-center"><h5>TOTALS</h5></td>
								</tr>
								<tr>
									<td nowrap></td>
									<td nowrap><h5 class="mt15 mb0">ID #</h5></td>
									<td nowrap><h5 class="mt15 mb0">NAME</h5></td>
									<td nowrap><h5 class="mt15 mb0">POSITION</h5></td>
									<td nowrap><h5 class="mt15 mb0">RATES</h5></td>

									<td nowrap><h5 class="mtb0">SUN<br/>15</h5></td>
									<td nowrap><h5 class="mtb0">MON<br/>16</h5></td>
									<td nowrap><h5 class="mtb0">TEU<br/>17</h5></td>
									<td nowrap><h5 class="mtb0">WED<br/>18</h5></td>
									<td nowrap><h5 class="mtb0">THU<br/>19</h5></td>
									<td nowrap><h5 class="mtb0">FRI<br/>20</h5></td>
									<td nowrap><h5 class="mtb0">SAT<br/>21</h5></td>

									<td nowrap><h5 class="mtb0">REG<br/>MIN</h5></td>
									<td nowrap><h5 class="mtb0">OT<br/>MIN</h5></td>
									<td nowrap><h5 class="mt15 mb0">TOTAL</h5></td>

									<td nowrap><h5 class="mt15 mb0">BASIC</h5></td>
									<td nowrap><h5 class="mt15 mb0">OT</h5></td>
									<td nowrap><h5 class="mt15 mb0">DE MINIMIS</h5></td>

									<td nowrap><h5 class="mt15 mb0">SSS</h5></td>
									<td nowrap><h5 class="mt15 mb0">PHIL HEALTH</h5></td>
									<td nowrap><h5 class="mt15 mb0">PAG IBIG</h5></td>
									<td nowrap><h5 class="mt15 mb0">TAX</h5></td>

									<td nowrap><h5 class="mt15 mb0">13th MONTH</h5></td>

									<td nowrap><h5 class="mt15 mb0">GROSS</h5></td>
									<td nowrap><h5 class="mt15 mb0">NET</h5></td>

								</tr>
							</thead>
							<tbody>
								<tr>
									<td nowrap>
										<span class="dropdown pull-right">
											<a class="dropdown-toggle" href="javascript:void(0);" type="button" data-toggle="dropdown" >
												<i class="fa fa-gear"></i>
											</a>
											<ul class="dropdown-menu" style="left:0px; width: 220px;">
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-pending"></i> Set as Pending
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-approved"></i> Set as Approved
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-ongoing"></i> Set as Ongoing
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-completed"></i> Set as Completed
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-cancelled"></i> Set as Cancelled
													</a>
												</li>
											</ul>
										</span>
									</td>
									<td nowrap><h5 class="mtb0">131</h5></td>
									<td nowrap><h5 class="mtb0">Christopher Domaub</h5></td>
									<td nowrap><h5 class="mtb0">Web Developer</h5></td>
									<td nowrap><h5 class="mtb0">95/hr</h5></td>

									<td nowrap><h5 class="mtb0">480</h5></td>
									<td nowrap><h5 class="mtb0">430</h5></td>
									<td nowrap><h5 class="mtb0">500</h5></td>
									<td nowrap><h5 class="mtb0">511</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>
									<td nowrap><h5 class="mtb0">501</h5></td>
									<td nowrap><h5 class="mtb0">474</h5></td>

									<td nowrap><h5 class="mtb0">2824</h5></td>
									<td nowrap><h5 class="mtb0">72</h5></td>
									<td nowrap><h5 class="mtb0">2896</h5></td>

									<td nowrap><h5 class="mtb0">4471</h5></td>
									<td nowrap><h5 class="mtb0">91</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>

									<td nowrap><h5 class="mtb0">100</h5></td>
									<td nowrap><h5 class="mtb0">120</h5></td>
									<td nowrap><h5 class="mtb0">120</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>

									<td nowrap><h5 class="mtb0">13th MONTH</h5></td>

									<td nowrap><h5 class="mtb0">4562</h5></td>
									<td nowrap><h5 class="mtb0">4242</h5></td>

								</tr>
								<tr>
									<td nowrap>
										<span class="dropdown pull-right">
											<a class="dropdown-toggle" href="javascript:void(0);" type="button" data-toggle="dropdown" >
												<i class="fa fa-gear"></i>
											</a>
											<ul class="dropdown-menu" style="left:0px; width: 220px;">
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-pending"></i> Set as Pending
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-approved"></i> Set as Approved
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-ongoing"></i> Set as Ongoing
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-completed"></i> Set as Completed
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-cancelled"></i> Set as Cancelled
													</a>
												</li>
											</ul>
										</span>
									</td>
									<td nowrap><h5 class="mtb0">131</h5></td>
									<td nowrap><h5 class="mtb0">Christopher Domaub</h5></td>
									<td nowrap><h5 class="mtb0">Web Developer</h5></td>
									<td nowrap><h5 class="mtb0">95/hr</h5></td>

									<td nowrap><h5 class="mtb0">480</h5></td>
									<td nowrap><h5 class="mtb0">430</h5></td>
									<td nowrap><h5 class="mtb0">500</h5></td>
									<td nowrap><h5 class="mtb0">511</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>
									<td nowrap><h5 class="mtb0">501</h5></td>
									<td nowrap><h5 class="mtb0">474</h5></td>

									<td nowrap><h5 class="mtb0">2824</h5></td>
									<td nowrap><h5 class="mtb0">72</h5></td>
									<td nowrap><h5 class="mtb0">2896</h5></td>

									<td nowrap><h5 class="mtb0">4471</h5></td>
									<td nowrap><h5 class="mtb0">91</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>

									<td nowrap><h5 class="mtb0">100</h5></td>
									<td nowrap><h5 class="mtb0">120</h5></td>
									<td nowrap><h5 class="mtb0">120</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>

									<td nowrap><h5 class="mtb0">13th MONTH</h5></td>

									<td nowrap><h5 class="mtb0">4562</h5></td>
									<td nowrap><h5 class="mtb0">4242</h5></td>

								</tr>
								<tr>
									<td nowrap>
										<span class="dropdown pull-right">
											<a class="dropdown-toggle" href="javascript:void(0);" type="button" data-toggle="dropdown" >
												<i class="fa fa-gear"></i>
											</a>
											<ul class="dropdown-menu" style="left:0px; width: 220px;">
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-pending"></i> Set as Pending
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-approved"></i> Set as Approved
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-ongoing"></i> Set as Ongoing
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-completed"></i> Set as Completed
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-cancelled"></i> Set as Cancelled
													</a>
												</li>
											</ul>
										</span>
									</td>
									<td nowrap><h5 class="mtb0">131</h5></td>
									<td nowrap><h5 class="mtb0">Christopher Domaub</h5></td>
									<td nowrap><h5 class="mtb0">Web Developer</h5></td>
									<td nowrap><h5 class="mtb0">95/hr</h5></td>

									<td nowrap><h5 class="mtb0">480</h5></td>
									<td nowrap><h5 class="mtb0">430</h5></td>
									<td nowrap><h5 class="mtb0">500</h5></td>
									<td nowrap><h5 class="mtb0">511</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>
									<td nowrap><h5 class="mtb0">501</h5></td>
									<td nowrap><h5 class="mtb0">474</h5></td>

									<td nowrap><h5 class="mtb0">2824</h5></td>
									<td nowrap><h5 class="mtb0">72</h5></td>
									<td nowrap><h5 class="mtb0">2896</h5></td>

									<td nowrap><h5 class="mtb0">4471</h5></td>
									<td nowrap><h5 class="mtb0">91</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>

									<td nowrap><h5 class="mtb0">100</h5></td>
									<td nowrap><h5 class="mtb0">120</h5></td>
									<td nowrap><h5 class="mtb0">120</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>

									<td nowrap><h5 class="mtb0">13th MONTH</h5></td>

									<td nowrap><h5 class="mtb0">4562</h5></td>
									<td nowrap><h5 class="mtb0">4242</h5></td>

								</tr>
								<tr>
									<td nowrap>
										<span class="dropdown pull-right">
											<a class="dropdown-toggle" href="javascript:void(0);" type="button" data-toggle="dropdown" >
												<i class="fa fa-gear"></i>
											</a>
											<ul class="dropdown-menu" style="left:0px; width: 220px;">
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-pending"></i> Set as Pending
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-approved"></i> Set as Approved
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-ongoing"></i> Set as Ongoing
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-completed"></i> Set as Completed
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-cancelled"></i> Set as Cancelled
													</a>
												</li>
											</ul>
										</span>
									</td>
									<td nowrap><h5 class="mtb0">131</h5></td>
									<td nowrap><h5 class="mtb0">Christopher Domaub</h5></td>
									<td nowrap><h5 class="mtb0">Web Developer</h5></td>
									<td nowrap><h5 class="mtb0">95/hr</h5></td>

									<td nowrap><h5 class="mtb0">480</h5></td>
									<td nowrap><h5 class="mtb0">430</h5></td>
									<td nowrap><h5 class="mtb0">500</h5></td>
									<td nowrap><h5 class="mtb0">511</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>
									<td nowrap><h5 class="mtb0">501</h5></td>
									<td nowrap><h5 class="mtb0">474</h5></td>

									<td nowrap><h5 class="mtb0">2824</h5></td>
									<td nowrap><h5 class="mtb0">72</h5></td>
									<td nowrap><h5 class="mtb0">2896</h5></td>

									<td nowrap><h5 class="mtb0">4471</h5></td>
									<td nowrap><h5 class="mtb0">91</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>

									<td nowrap><h5 class="mtb0">100</h5></td>
									<td nowrap><h5 class="mtb0">120</h5></td>
									<td nowrap><h5 class="mtb0">120</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>

									<td nowrap><h5 class="mtb0">13th MONTH</h5></td>

									<td nowrap><h5 class="mtb0">4562</h5></td>
									<td nowrap><h5 class="mtb0">4242</h5></td>

								</tr>
								<tr>
									<td nowrap>
										<span class="dropdown pull-right">
											<a class="dropdown-toggle" href="javascript:void(0);" type="button" data-toggle="dropdown" >
												<i class="fa fa-gear"></i>
											</a>
											<ul class="dropdown-menu" style="left:0px; width: 220px;">
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-pending"></i> Set as Pending
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-approved"></i> Set as Approved
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-ongoing"></i> Set as Ongoing
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-completed"></i> Set as Completed
													</a>
												</li>
												<li>
													<a href="" title="">
														<i class="fa fa-flag fa-xs legend-cancelled"></i> Set as Cancelled
													</a>
												</li>
											</ul>
										</span>
									</td>
									<td nowrap><h5 class="mtb0">131</h5></td>
									<td nowrap><h5 class="mtb0">Christopher Domaub</h5></td>
									<td nowrap><h5 class="mtb0">Web Developer</h5></td>
									<td nowrap><h5 class="mtb0">95/hr</h5></td>

									<td nowrap><h5 class="mtb0">480</h5></td>
									<td nowrap><h5 class="mtb0">430</h5></td>
									<td nowrap><h5 class="mtb0">500</h5></td>
									<td nowrap><h5 class="mtb0">511</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>
									<td nowrap><h5 class="mtb0">501</h5></td>
									<td nowrap><h5 class="mtb0">474</h5></td>

									<td nowrap><h5 class="mtb0">2824</h5></td>
									<td nowrap><h5 class="mtb0">72</h5></td>
									<td nowrap><h5 class="mtb0">2896</h5></td>

									<td nowrap><h5 class="mtb0">4471</h5></td>
									<td nowrap><h5 class="mtb0">91</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>

									<td nowrap><h5 class="mtb0">100</h5></td>
									<td nowrap><h5 class="mtb0">120</h5></td>
									<td nowrap><h5 class="mtb0">120</h5></td>
									<td nowrap><h5 class="mtb0"></h5></td>

									<td nowrap><h5 class="mtb0">13th MONTH</h5></td>

									<td nowrap><h5 class="mtb0">4562</h5></td>
									<td nowrap><h5 class="mtb0">4242</h5></td>

								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
</script>