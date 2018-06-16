<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4>TRANSFERRAL</h4>
	</div>
	<div class="col-xs-12 col-md-6">
		<a onclick="" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-plus"></i> ADD TRANSACTION&emsp;</h5>
		</a>
		<a href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-print"></i> PRINT&emsp;|&emsp;</h5>
		</a>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="my-container">
			<div class="nav-tabs-custom my-nav-tabs">
				<ul class="nav nav-tabs">
					<li><a href="inventory.php"><b>INVENTORY</b></a></li>
					<li><a href="acquisition.php"><b>ACQUISITION</b></a></li>
					<li><a href="issuance.php"><b>ISSUANCE</b></a></li>
					<li class="active"><a href="transferral.php"><b>TRANSFERRAL</b></a></li>
				</ul>
				<div class="tab-content no-padding">
					<div class="tab-pane active relative pad15" id="transferral-tab">
						<div class="row">
							<div class="col-xs-12 plr10">
								<div class="col-xs-6 col-sm-3 col-md-2 col-lg-1 plr5">
									<div class="form-group">
										<label>LIMIT</label>
										<select 
											class="form-control"
											id="search_limit"
										>
											<option>10</option>
											<option selected="selected">15</option>
											<option>20</option>
											<option>25</option>
											<option>50</option>
											<option>100</option>
											<option>200</option>
										</select>
									</div>
								</div>
								<div class="col-xs-6 col-sm-3 col-md-2 plr5">
									<div class="form-group">
										<label>STATUS</label>
										<select 
											class="form-control"
											id="search_status"
										>
											<option value="">All</option>
											<option>Pending</option>
											<option>Approved</option>
											<option>Closed</option>
											<option>Declined</option>
										</select>
									</div>
								</div>
								<div class="col-xs-6 col-sm-3 col-md-2 plr5">
									<div class="form-group">
										<label>FROM PROJECT</label>
										<select 
											class="form-control"
											id="search_fromproject"
										>
											<option value="">All</option>
											<option>Project 1</option>
											<option>Project 2</option>
											<option>Project 3</option>
											<option>Project 4</option>
											<option>Project 5</option>
										</select>
									</div>
								</div>
								<div class="col-xs-6 col-sm-3 col-md-2 plr5">
									<div class="form-group">
										<label>TO PROJECT</label>
										<select 
											class="form-control"
											id="search_toproject"
										>
											<option value="">All</option>
											<option>Project 1</option>
											<option>Project 2</option>
											<option>Project 3</option>
											<option>Project 4</option>
											<option>Project 5</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-2 plr5">
									<div class="form-group">
										<label>DATE RANGE</label>

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
								<div class="col-xs-12 col-sm-6 col-md-2 col-lg-3 plr5">
									<div class="form-group">
										<label>INVENTORY</label>

										<div class="input-group">
											<input 
												type="text" 
												class="form-control pull-right" 
												placeholder="Search by name..."
												id="search_key"
											>
											<div class="input-group-addon">
												<i class="fa fa-search"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row mt20">
							<div class="col-xs-12" id="transferral-cont">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

    $('#search_daterange').daterangepicker();
    

	function load_transferral_list(page)
	{
		var limit = $("#search_limit").val();
		var key = encodeURI($("#search_key").val());
		var fromproject = encodeURI($("#search_fromproject").val());
		var toproject = encodeURI($("#search_toproject").val());
		var daterange = encodeURI($("#search_daterange").val());

		$("#transferral-cont").load("./subpages/transferral/load_transferral_list.php?limit="+limit+"&fromproject="+fromproject+"&toproject="+toproject+"&daterange="+daterange+"&key="+key+"&page="+page);
	}

	load_transferral_list(1);
</script>