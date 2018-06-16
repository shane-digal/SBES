<?php 
	include('../../includes/module.php');


	$data           = array();

	$max_size       = 1024*2000;
	$extensions     = array('jpeg', 'jpg', 'png', 'doc', 'docx', 'pdf');
	$project_id 	= $_POST['project_id'];

	$dir            = '../../uploads/projects/';

	$data['count']  = 0;
	$file_num       = 1;

	if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_FILES['files']))
	{
		if($project_id == 0)
		{
			if(!isset($_SESSION['tmp_project_id']) || $_SESSION['tmp_project_id'] != "")
			{
				$_SESSION['tmp_project_id'] = tempID(10);
				$dir .= 'temp/'.$_SESSION['tmp_project_id'].'_';
			}
		}
		else
		{
			$dir 	.= $project_id.'/';
		}

		// loop all files
		foreach ( $_FILES['files']['name'] as $i => $name )
		{
			// if file not uploaded then skip it
			if ( !is_uploaded_file($_FILES['files']['tmp_name'][$i]) )
				continue; //$error .= 'no file uploaded /';
			// skip large files
			if ( $_FILES['files']['size'][$i] >= $max_size )
				continue; //$error .= 'large size on file' . $file_num . '/';
			// skip unprotected files
			if( !in_array(pathinfo($name, PATHINFO_EXTENSION), $extensions) )
				continue; //$error .= 'error on file' . $file_num . '/';

			$target_file = $dir . basename($_FILES["files"]["name"][$i]);
			// now we can move uploaded files
			if( move_uploaded_file($_FILES["files"]["tmp_name"][$i], $target_file) )
			$data['count']++;

			$file_num++;
		}
	}
	die(json_encode($data));
?>