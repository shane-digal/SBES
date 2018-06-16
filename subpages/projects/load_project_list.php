<?php
	include("../../includes/get_projects.php");

	$key 			= $_GET['key'];
	$status 		= $_GET['status'];
	$dates			= explode(" - ", $_GET['daterange']);
	$pages 			= 1;

	$page 			= $_GET['page'];
	$limit 			= $_GET['limit'];
	$offset 		= ($page - 1)*$limit;

	$range 			= ($dates[0] == $dates[1]) ? "" : $_GET['daterange'];

	//$searchKey = "", $dateRange = "", $status = "", $limit, $offset
	$getProjects 	= getProjectList($key, $range, $status, $limit, $offset);

	$getProjects 	->bind_result(	$project_id, 
									$project_name, 
									$employee_count, 
									$project_start, 
									$project_end, 
									$project_estbudget, 
									$project_status);
	
?>
<div class="row">
	<div class="col-xs-12">
		<?php while($getProjects->fetch()){ ?>
		<div class="row project-row trans300 <?= $project_status; ?>">
			<div class="col-xs-6 col-md-1 align-right pull-right">
				<span><i class="fa fa-gear"></i></span>
			</div>
			<span onclick="load_project_profile(<?php echo $project_id; ?>);">
				<div class="col-xs-6 col-md-1">
					<span><?php printf("#%s", $project_id); ?></span>
				</div>
				<div class="col-xs-10 col-md-5">
					<span><?php echo $project_name; ?></span>
				</div>
				<div class="col-xs-2 col-md-1 align-right">
					<span><?php echo $employee_count; ?> <i class="fa fa-users"></i></span>
				</div>
				<div class="col-xs-6 col-md-2">
					<span><?php printf("%s - %s", $project_start, $project_end); ?></span>
				</div>
				<div class="col-xs-6 col-md-2 align-right">
					<span>&#8369; <?php echo displayMoney($project_estbudget); ?></span>
				</div>
			</span>
		</div>
		<?php } $getProjects->close(); ?>
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