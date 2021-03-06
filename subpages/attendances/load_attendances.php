<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4>ATTENDANCES</h4>
	</div>
	<div class="col-xs-12 col-md-6">
		<a onclick="load_add_employee();" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-plus-square-o"></i> IMPORT ATTENDANCE&emsp;</h5>
		</a>
	</div>
</div>
<div class="row">
	<div class="col-xs-12">
		<div class="my-container">
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
								<option value="0">All</option>
							</select>
						</div>
					</div>
					<div class="col-xs-12 col-sm-4 col-md-3 plr5">
						<div class="form-group">
							<label>EMPLOYEE</label>

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
					<i class="fa fa-circle-o legend-verified"></i> Verified&emsp;
					<i class="fa fa-circle-o legend-unverified"></i> Unverified&emsp;
				</div>
			</div>
			<div class="row mt20">
				<div class="col-xs-12" id="employee-cont">
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#search_limit").change(function()
	{
		load_attendance_list(1);
	});
	$("#search_project").change(function()
	{
		load_attendance_list(1);
	});
	$("#search_key").on("input",function()
	{
		load_attendance_list(1);
	});

	function load_attendance_list(page)
	{
		var limit = $("#search_limit").val();
		var key = encodeURI($("#search_key").val());
		var project = encodeURI($("#search_project").val());

		$("#employee-cont").load("./subpages/attendances/load_attendance_list.php?limit="+limit+"&project="+project+"&key="+key+"&page="+page);
	}
    
    load_attendance_list(1);

	$.ajax({
		url : "http://localhost/sbes/api?q=GetApprovedProjects",
		method: "POST",
		dataType: 'json',
		success: function(response){
			var cbox;
			$.each(response.values, function(key, v){
			cbox = 	'<option value="'+v.project_id+'">' + v.project_name + '</option>';
			$('#search_project').append(cbox);
			});
		}
	});
</script>