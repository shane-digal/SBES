<?php
	$id 		= $_GET['id'];
	$name 		= $_GET['name'];
	$quantity 	= $_GET['quantity'];
	$metric 	= $_GET['metric'];
	$list 		= $_GET['list'];
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