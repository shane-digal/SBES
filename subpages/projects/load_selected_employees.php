<?php
	$id 		= $_GET['id'];
	$name 		= $_GET['name'];
	$position 	= $_GET['position'];
	$list 		= $_GET['list'];
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