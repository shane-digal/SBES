<?php 
	$name = $_GET['name'];
?>
<div class="row selected-row trans100 pt5 pb5">
	<div class="col-xs-12">
		<div class="sel-emp-action-col">
			<a onclick="removeSelectedItem(this);" href="javascript:void(0);" class="red-href" name="<?php echo $name; ?>">
				<small><i class="fa fa-times"></i></small>
			</a>
		</div>
		<div class="sel-emp-info-col">
			<label class="emp-data">
				<?php echo $name; ?>
			</label>
		</div>
	</div>
</div>
