<?php
	$key = $_GET['key'];
	$project = $_GET['project'];
	$pages = 1;

	$page = $_GET['page'];
	$limit = $_GET['limit'];
	$offset = ($page - 1)*$limit;
?>
<div class="row">
	<div class="col-xs-12">
		<div class="row employee-row trans300 Pending">
			<div class="col-xs-12">
				<div class="employee-action-cont align-right pull-right">
					<span><i class="fa fa-gear"></i></span>
					<span class="employee-data-toggler hidden-sm hidden-md hidden-lg"><i class="fa fa-chevron-down"></i></span>
				</div>
				<span onclick="load_employee_profile(1);">
					<div class="employee-img-cont">
						<div class="img img100" style="background:url('http://127.0.0.1/sbes/resources/theme/dist/img/user2-160x160.jpg');">
						</div>
					</div>
					<div class="employee-text-cont">
						<div class="col-xs-12 col-sm-8 plr0">
							<span class="emp-data">Digomaub, Harvey Charles</span>
							<span class="emp-data text-gray">Software Developer (Regular)</span>
						</div>
						<div class="extra-details col-xs-12 col-sm-4 hidden-xs plr0">
							<span class="emp-data align-right-md">Project 1</span>
							<span class="emp-data text-gray align-right-md">&#8369; 250.00/hr</span>
						</div>
					</div>
				</span>
			</div>
		</div>
		<div class="row employee-row trans300 Verified">
			<div class="col-xs-12">
				<div class="employee-action-cont align-right pull-right">
					<span><i class="fa fa-gear"></i></span>
					<span class="employee-data-toggler hidden-sm hidden-md hidden-lg"><i class="fa fa-chevron-down"></i></span>
				</div>
				<span onclick="load_employee_profile(1);">
					<div class="employee-img-cont">
						<div class="img img100" style="background:url('http://127.0.0.1/sbes/resources/theme/dist/img/user2-160x160.jpg');">
						</div>
					</div>
					<div class="employee-text-cont">
						<div class="col-xs-12 col-sm-8 plr0">
							<span class="emp-data">Digomaub, Harvey Charles</span>
							<span class="emp-data text-gray">Software Developer (Contractual)</span>
						</div>
						<div class="extra-details col-xs-12 col-sm-4 hidden-xs plr0">
							<span class="emp-data align-right-md">Project 1</span>
							<span class="emp-data text-gray align-right-md">&#8369; 250.00/hr</span>
						</div>
					</div>
				</span>
			</div>
		</div>
		<div class="row employee-row trans300 Unverified">
			<div class="col-xs-12">
				<div class="employee-action-cont align-right pull-right">
					<span><i class="fa fa-gear"></i></span>
					<span class="employee-data-toggler hidden-sm hidden-md hidden-lg"><i class="fa fa-chevron-down"></i></span>
				</div>
				<span onclick="load_employee_profile(1);">
					<div class="employee-img-cont">
						<div class="img img100" style="background:url('http://127.0.0.1/sbes/resources/theme/dist/img/user2-160x160.jpg');">
						</div>
					</div>
					<div class="employee-text-cont">
						<div class="col-xs-12 col-sm-8 plr0">
							<span class="emp-data">Digomaub, Harvey Charles</span>
							<span class="emp-data text-gray">Software Developer (Regular)</span>
						</div>
						<div class="extra-details col-xs-12 col-sm-4 hidden-xs plr0">
							<span class="emp-data align-right-md">Project 2</span>
							<span class="emp-data text-gray align-right-md">&#8369; 250.00/hr</span>
						</div>
					</div>
				</span>
			</div>
		</div>
	</div>
</div>
<div class="row mt30">
	<div class="col-xs-12 align-center">
		<button
			onClick="load_project_list(<?=$page-1;?>);"
			type="button"
			class="btn-paginate chevs 
			<?=$page <= 1 ? 'disabled' : '';?>"
			<?=$page <= 1 ? 'disabled' : '';?>
		>
			<i class="ion-chevron-left"></i> PREV
		</button>
<?php
	for($a = 1; $a<=$pages;$a++)
	{
?>
		<button
			onClick="load_project_list(<?=$a?>);"
			type="button"
			class="btn-paginate nums 
			<?=$a == $page ? 'active' : '';?>"
		>
			<?=$a;?>	
		</button>
<?php
	}
?>
		<button
			onClick="load_project_list(<?=$page+1;?>);"
			type="button"
			class="btn-paginate chevs 
			<?=$page >= $pages ? 'disabled' : '';?>"
			<?=$page >= $pages ? 'disabled' : '';?>
		>
			NEXT <i class="ion-chevron-right"></i>
		</button>
	</div>
</div>
<script type="text/javascript">
	$(".employee-data-toggler ").click(function()
	{
		$(this).closest(".employee-row").find(".extra-details").toggleClass("hidden-xs");
	});
</script>