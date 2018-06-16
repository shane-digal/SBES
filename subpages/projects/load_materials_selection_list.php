<?php include("../../includes/get_materials.php");?>
<?php
	
	//getEmployeeList($projectID, $positionID, $searchKey = optional)
		if(isset($_GET['key']) && $_GET['key'] != '')
		{
			if(isset($_GET['ids']) && $_GET['ids'] != '')
				$getMaterials 	= getMaterialList($_GET['key'], $_GET['ids']);
			else
				$getMaterials 	= getMaterialList($_GET['key']);
		}
		else
		{
			if(isset($_GET['ids']) && $_GET['ids'] != '')
				$getMaterials 	= getMaterialList("", urldecode($_GET['ids']));
			else
				$getMaterials 	= getMaterialList();
		}
	
	$getMaterials->bind_result(	$id, 
								$name, 
								$metric);
?>
<?php while($getMaterials->fetch()) { ?>
	<div class="row selected-row trans100 pt5 pb5">
		<label class="sel-row-label col-xs-12">
			<div class="sel-empmatlist-action-col">
				<input type="checkbox" name="checkboxes[]" id="<?php echo $id; ?>"/>
			</div>
			<div class="sel-empmatlist-info-col" id="<?php printf('name%s', $id); ?>">
				<span class="emp-data">
					<?php echo $name; ?>
				</span>
			</div>
			<div class="sel-empmatlist-input-col">
				<span class="emp-data">
					<input 	type="number" 
							class="sel-mat-input align-right"
							placeholder="0"
							min="0"
							id="<?php printf('quantity%s', $id); ?>"
					/>
				</span>
			</div>
			<div class="sel-empmatlist-metric-col">
				<span class="emp-data align-center">
					<small class="text-gray" id="<?php printf('metric%s', $id); ?>"><?php echo $metric; ?></small>
				</span>
			</div>
		</label>
	</div>
<?php } $getMaterials->close(); ?>