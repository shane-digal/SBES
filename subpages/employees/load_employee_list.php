<?php
	$key = (isset($_GET['key']) ? $_GET['key'] : '');
	$project = (isset($_GET['project']) ? $_GET['project'] : 0);
	$pages = 1;

	$page = $_GET['page'] ;
	$limit = $_GET['limit'];
	$offset = ($page - 1)*$limit;

	$employeeList = array();

	include('../../includes/get_employees.php');
	$empCount = 100;	
	$empCount = getEmployeeCount($project, $key);
	$pages = ($empCount / $limit) +1;
	
	$employeeObj =  getEmployeeList($project,  $offset, $limit, $key);
	$employeeObj->bind_result(	$emp_id, 
								$emp_name, 
								$emp_img, 
								$pos_name, 
								$status,
								$wage,
								$proj_name
							);
?>
<div class="row">
	<div class="col-xs-12">
		<?php

			while($employeeObj->fetch())
			{
		?>

		<div class="row employee-row trans300 Pending">
			<div class="col-xs-12">
				<div class="employee-action-cont align-right pull-right">
					<span><i class="fa fa-gear"></i></span>
					<span class="employee-data-toggler hidden-sm hidden-md hidden-lg"><i class="fa fa-chevron-down"></i></span>
				</div>
				<span onclick="load_employee_profile(<?= $emp_id ?>);">
					<div class="employee-img-cont">
						<div class="img img100" style="background:url('http://127.0.0.1/sbes/resources/theme/dist/img/user2-160x160.jpg');">
						</div>
					</div>
					<div class="employee-text-cont">
						<div class="col-xs-12 col-sm-8 plr0">
							<span class="emp-data"> <?= $emp_name ?> <span>
							<span class="emp-data text-gray"><?=$status?> (<?= $pos_name ?>)</span>
						</div>
						<div class="extra-details col-xs-12 col-sm-4 hidden-xs plr0">
							<span class="emp-data align-right-md"><?= $proj_name ?></span>
							<span class="emp-data text-gray align-right-md">&#8369; <?= $wage ?> /hr</span>
						</div>
					</div>
				</span>
			</div>
		</div>
		<?php
			}
			$employeeObj->close();
		?>
	</div>
</div>
<div class="row mt30">
	<div class="col-xs-12 align-center">
		<button
			onClick="load_employee_list(<?=$page-1;?>);"
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
			onClick="load_employee_list(<?=$a?>);"
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
			onClick="load_employee_list(<?=$page+1;?>);"
			type="button"
			class="btn-paginate chevs 
			<?=$page >= $pages-1 ? 'disabled' : '';?>"
			<?=$page >= $pages-1 ? 'disabled' : '';?>
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