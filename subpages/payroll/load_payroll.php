<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4>PAYROLL</h4>
	</div>
	<div class="col-xs-12 col-md-6">
		<a onclick="load_add_payroll();" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-plus"></i> NEW PAYROLL&emsp;</h5>
		</a>
		<a onclick="load_payroll_draft();" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-folder-o"></i> OPEN DRAFTS&emsp;|&emsp;</h5>
		</a>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="my-container">
			<div class="row">
				<div class="col-xs-12 plr10">
					<div class="col-xs-8 col-sm-4 col-md-1 col-md-offset-2 plr5">
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
					<div class="col-xs-4 visible-xs plr5">
						<button type="button" class="filter-hide-xs-toggler form-control mt25">
							<span class="pull-left">FILTER</span>
							<span class="pull-right"><i class="fa fa-chevron-down"></i></span>
						</button>
					</div>
					<span class="filter-hide-xs">
						<div class="col-xs-12 col-sm-4 col-md-3 plr5">
							<div class="form-group">
								<label>STATUS</label>
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
						<div class="col-xs-12 col-sm-4 col-md-3 plr5">
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
					</span>
					<div class="col-xs-12 col-sm-4 col-md-3 plr5">
						<div class="form-group">
							<label>PROJECT NAME</label>

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
				<div class="col-xs-12 align-right">
					<i class="fa fa-circle-o legend-pending"></i> Pending&emsp;
					<i class="fa fa-circle-o legend-approved"></i> Approved&emsp;
					<i class="fa fa-circle-o legend-ongoing"></i> Ongoing&emsp;
					<i class="fa fa-circle-o legend-completed"></i> Completed&emsp;
				</div>
			</div>
			<div class="row mt20">
				<div class="col-xs-12" id="project-cont">
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#search_daterange").change(function()
	{
		load_payroll_list(1);
	});
	$("#search_limit").change(function()
	{
		load_payroll_list(1);
	});
	$("#search_status").change(function()
	{
		load_payroll_list(1);
	});
	$("#search_key").keyup(function()
	{
		load_payroll_list(1);
	});

	function load_payroll_list(page)
	{
		var limit = $("#search_limit").val();
		var key = encodeURI($("#search_key").val());
		var status = encodeURI($("#search_status").val());
		var daterange = encodeURI($("#search_daterange").val());

		$("#project-cont").load("./subpages/payroll/load_payroll_list.php?limit="+limit+"&status="+status+"&daterange="+daterange+"&key="+key+"&page="+page);
	}


    $(".filter-hide-xs-toggler").click(function()
    {
    	$(this).find("i").toggleClass("fa-chevron-down");
    	$(this).find("i").toggleClass("fa-chevron-up");
    	$(".filter-hide-xs").toggle(200);
    });


    $('#search_daterange').daterangepicker();
    
    load_payroll_list(1);
</script>