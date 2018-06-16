<?php
	include('../../includes/module.php');

	$project_id = $_GET['id'];
	$edit 		= $_GET['edit'];
	$list 		= 'foremen';
	$position_id= 1;

	$table 		= ($edit == 1) ? "rec_project_foremen" : "rec_project_draft_foremen";

	$getDetails = $con->prepare("SELECT $table.employee_id,
								rec_employees.employee_fname,
								rec_employees.employee_mname,
								rec_employees.employee_lname,
								lib_employee_positions.position_name
								FROM $table
								INNER JOIN rec_employees
								ON $table.employee_id = rec_employees.employee_id
								INNER JOIN lib_employee_positions
								ON rec_employees.position_id = lib_employee_positions.position_id
								WHERE $table.project_id = ?
								AND rec_employees.position_id = ?");
	$getDetails ->bind_param("ii", $project_id, $position_id);
	$getDetails ->execute();
	$getDetails ->bind_result($id,
								$fname,
								$mname,
								$lname,
								$position);
	while($getDetails->fetch()){

	$name 	= $lname.', '.$fname.' '.$mname; 
?>
<div class="row selected-row trans100 pt5 pb5">
	<div class="col-xs-12">
		<div class="sel-emp-action-col">
			<a onclick="removeSelectedRow(this);" href="javascript:void(0);" id="<?php echo $id; ?>" 
				name="<?php echo $list; ?>" class="red-href">
				<small><i class="fa fa-times"></i></small>
			</a>
		</div>
		<div class="sel-emp-info-col">
			<label class="emp-data">
				<?php printf("%s", $name); ?>
			</label>
			<label class="emp-data">
				<small class="text-gray">(<?php printf("%s", $position); ?>)</small>
			</label>
		</div>
	</div>
</div>
<script type="text/javascript">
	var id 				= '<?php echo $id; ?>';
	foremen[f_count++] 	= id;
	//alert(foremen[f_count-1]);
</script>
<?php } $getDetails->close(); ?> 