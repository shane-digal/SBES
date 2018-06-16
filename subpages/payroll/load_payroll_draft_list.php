<?php
	include("../../includes/get_payrolls.php");

	$status = $_GET['status'];
	$dates = explode(" - ", $_GET['daterange']);
	$pages = 1;

	$page = $_GET['page'];
	$limit = $_GET['limit'];
	$offset = ($page - 1) * $limit;

	$range = ($dates[0] == $dates[1]) ? "" : $_GET['daterange'];

	//$dateRange = "", $status = "", $limit, $offset
	$getPayrolls = getPayrollDraftList($range, $status, $limit, $offset);

	$getPayrolls->bind_result($payroll_id, 
		$project_id, 
		$payroll_start,
		$payroll_end,
		$payroll_status,
		$project_name);
	
?>
<div class="row">
	<div class="col-xs-12">
		<?php while($getPayrolls->fetch()){ ?>
		<div class="row project-row trans300 <?= $payroll_status; ?>">
			<div class="col-xs-6 col-md-1 align-right pull-right">
				<span><i class="fa fa-gear"></i></span>
			</div>
			<span onclick="load_edit_payroll(<?php echo $payroll_id; ?>);">
				<div class="col-xs-6 col-md-1">
					<span><?php printf("#%s", $payroll_id); ?></span>
				</div>
				<div class="col-xs-6 col-md-1">
					<span><?php printf("#%s", $project_name); ?></span>
				</div>
				<div class="col-xs-6 col-md-2">
					<span><?php printf("%s - %s", date("m/d/y", strtotime($payroll_start)),date("m/d/y", strtotime($payroll_end))); ?></span>
				</div>
			</span>
		</div>
		<?php } $getPayrolls->close(); ?>
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
			onClick="load_payroll_list(<?=$a?>);"
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
			onClick="load_payroll_list(<?=$page+1;?>);"
			type="button"
			class="btn-paginate chevs 
			<?=$page >= $pages ? 'disabled' : '';?>"
			<?=$page >= $pages ? 'disabled' : '';?>
		>
			NEXT <i class="ion-chevron-right"></i>
		</button>
	</div>
</div>