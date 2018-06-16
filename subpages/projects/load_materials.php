<?php
	include('../../includes/module.php');

	$project_id = $_GET['id'];
	$edit 		= $_GET['edit'];
	$list 		= 'items';

	$table 		= ($edit == 1) ? "rec_project_material_plans" : "rec_project_draft_material_plans";

	$getItems = $con->prepare("SELECT $table.projectmatplan_id, 
								$table.material_id, 
								$table.projectmatplan_qty,
								lib_materials.material_name,
								lib_materials.material_metric
								FROM $table 
								INNER JOIN lib_materials
								ON $table.material_id = lib_materials.material_id
								WHERE project_id = ?");
	$getItems ->bind_param("i", $project_id);
	$getItems ->execute();
	$getItems ->bind_result($projectmatplan_id, 
								$id, 
								$quantity,
								$name,
								$metric);
	while($getItems->fetch()){
?>
<div class="row selected-row trans100 pt5 pb5">
	<div class="col-xs-12">
		<div class="sel-mat-action-col">
			<a onclick="removeSelectedRow(this);" href="javascript:void(0);" class="red-href"
			 id="<?php echo $id; ?>">
				<small><i class="fa fa-times"></i></small>
			</a>
		</div>
		<div class="sel-mat-info-col">
			<label class="emp-data">
				<?php echo $name; ?>
			</label>
		</div>
		<div class="sel-mat-input-col">
			<label class="emp-data">
				<input 	type="number" 
						class="sel-mat-input align-right"
						placeholder="0"
						min="0"
						value="<?php echo $quantity; ?>"
						name="quantities[]" 
				/>
			</label>
			<label class="emp-data align-right">
				<small class="text-gray"><?php echo $metric; ?></small>
			</label>
		</div>
	</div>
</div>
<script type="text/javascript">
	var id 				= '<?php echo $id; ?>';
	items[i_count++] 	= id;
	//alert(workers[w_count-1]);
</script>
<?php } $getItems->close(); ?>