<?php include("../../includes/get_employees.php");?>
<?php
	
	//getEmployeeList($projectID, $positionID, $searchKey = optional)
	if(isset($_GET['key']) && $_GET['key'] != '')
	{
		if(isset($_GET['ids']) && $_GET['ids'] != '')
			$getForemen 	= getEmployeeList(0, 1, $_GET['key'], $_GET['ids']);
		else
			$getForemen 	= getEmployeeList(0, 1, $_GET['key']);
	}
	else
	{
		if(isset($_GET['ids']) && $_GET['ids'] != '')
			$getForemen 	= getEmployeeList(0, 1, "", urldecode($_GET['ids']));
		else
			$getForemen 	= getEmployeeList(0, 1);
	}

	$getForemen->bind_result(	$employee_id, 
								$employee_fname, 
								$employee_mname, 
								$employee_lname, 
								$employee_imagepath, 
								$position);
	
?>
	<?php while($getForemen->fetch()) { ?>
		<div class="row selected-row trans100 pt5 pb5">
			<label class="sel-row-label col-xs-12">
				<div class="sel-emplist-action-col">
					<input type="checkbox" name="checkboxes[]" id="<?php echo $employee_id; ?>"/>
				</div>
				<div class="sel-emplist-info-col">
					<span class="emp-data" id="<?php printf('name%s', $employee_id); ?>">
						<?php printf("%s, %s %s", $employee_lname, $employee_fname, $employee_mname); ?>
					</span>
					<span class="emp-data">
						<small class="text-gray">
							<?php printf("(%s)", $position); ?>
						</small>
						<input type="hidden" id="<?php printf('position%s', $employee_id); ?>" 
							value="<?php echo $position; ?>">
					</span>
				</div>
				<div class="sel-emplist-img-col">
					<div class="img img100" style="background:url('./resources/img/blank-user.png');">
					</div>
				</div>
			</label>
		</div>
	<?php } $getForemen->close(); ?>
		