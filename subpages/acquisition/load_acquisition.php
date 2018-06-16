<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4>ACQUISITION</h4>
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
					<li class="active"><a href="acquisition.php"><b>ACQUISITION</b></a></li>
					<li><a href="issuance.php"><b>ISSUANCE</b></a></li>
					<li><a href="transferral.php"><b>TRANSFERRAL</b></a></li>
				</ul>
				<div class="tab-content no-padding">
					<div class="tab-pane active relative pad15" id="acquisition-tab">
						<div class="row">
							<div class="col-xs-12 plr10">
								<div class="col-xs-4 col-sm-4 col-md-2 col-lg-1 col-md-offset-4 col-lg-offset-5 plr5">
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
								<div class="col-xs-8 col-sm-4 col-md-3 plr5">
									<div class="form-group">
										<label>PROJECT</label>
										<select 
											class="form-control"
											id="search_project"
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
								<div class="col-xs-12 col-sm-4 col-md-3 plr5">
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
							<div class="col-xs-12" id="inventory-cont">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">

	function load_acquisition_list(page)
	{
		var limit = $("#search_limit").val();
		var key = encodeURI($("#search_key").val());
		var project = encodeURI($("#search_project").val());

		$("#inventory-cont").load("./subpages/acquisition/load_acquisition_list.php?limit="+limit+"&project="+project+"&key="+key+"&page="+page);
	}

	load_acquisition_list(1);
</script>