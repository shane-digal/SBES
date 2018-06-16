<?php
	include('../../includes/module.php');

	$data 					= array();
	$data['success']		= false;
	$prefix 				= '../../uploads/projects/temp/';

	if(isset($_POST['filename']))
	{
		if(isset($_POST['project_id']) && $_POST['project_id'] != 0)
		{
			$prefix 				= '../../uploads/projects/'.$_POST['project_id'].'/';
			$file 					= $prefix.$_POST['filename'];
		}
		else
		{
			$file					= $prefix.$_SESSION['tmp_project_id'].'_'.$_POST['filename'];
		}
		
		if(unlink($file))
			$data['success']	= true;
	}
	die(json_encode($data));
?>




