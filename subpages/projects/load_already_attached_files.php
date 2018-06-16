<?php 
	include('../../includes/module.php');

	$project_id = $_GET['id'];
	$edit 		= $_GET['edit'];

	$prefix 	= '';
	$concat 	= '';
	$mask		= '';

	if($_GET['id'] == 0)
	{
		if(isset($_SESSION['tmp_project_id']))
		{
			$prefix	= '../../uploads/projects/temp/';
			$mask 	=  $prefix.$_SESSION['tmp_project_id'].'_*.*';
		}
	}
	else
	{	
		if($edit == 1)
			$prefix	= '../../uploads/projects/'.$_GET['id'].'/';
		else
			$prefix	= '../../uploads/projects/drafts/'.$_GET['id'].'/';
		$mask 	=  $prefix.'*.*';
	}	

	$files	= glob($mask);

	if($mask != "")
	foreach ($files as $key => $value) {
		if(isset($_SESSION['tmp_project_id']))
			$concat = $_SESSION['tmp_project_id'].'_';

		$new = preg_replace('/^' . preg_quote($prefix.$concat, '/') . '/', '', $value);
?>
<div class="row selected-row trans100 pt5 pb5">
	<div class="col-xs-12">
		<div class="sel-emp-action-col">
			<a onclick="removeSelectedItem(this);" href="javascript:void(0);" class="red-href" name="<?php echo $new; ?>">
				<small><i class="fa fa-times"></i></small>
			</a>
		</div>
		<div class="sel-emp-info-col">
			<label class="emp-data">
				<?php echo $new; ?>
			</label>
		</div>
	</div>
</div>
<?php }?>
