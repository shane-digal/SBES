<?php
	include('../../includes/module.php');


	$data           = array();

	$max_size       = 1024*2000;
	$extensions     = array('jpeg', 'jpg', 'png');
	$dir            = '../../uploads/employees/images/';
	$data['count']  = 0;
	$file_num       = 1;

	if ($_SERVER['REQUEST_METHOD'] == 'POST' and isset($_FILES['imageAvatar']))
	{

		if(!isset($_SESSION['tmp_project_id']) || $_SESSION['tmp_project_id'] != "")
			$_SESSION['tmp_project_id'] = tempID(10);

		$dir .= $_SESSION['tmp_project_id']. '_';

		// loop all files
		// foreach ( $_FILES['imageAvatar']['name'] as $i => $name )
		// {
			// if file not uploaded then skip it
			if ( !is_uploaded_file($_FILES['imageAvatar']['tmp_name']) )
				// continue; //$error .= 'no file uploaded /';
				die(json_encode($data));
			// skip large files
			if ( $_FILES['imageAvatar']['size'] >= $max_size )
				// continue; //$error .= 'large size on file' . $file_num . '/';
				die(json_encode($data));
			// skip unprotected files
			if( !in_array(pathinfo($_FILES["imageAvatar"]["name"], PATHINFO_EXTENSION), $extensions) )
				// continue; //$error .= 'error on file' . $file_num . '/';
				die(json_encode($data));
			$target_file = $dir . basename($_FILES["imageAvatar"]["name"]);
			// now we can move uploaded files
			if( move_uploaded_file($_FILES["imageAvatar"]["tmp_name"], $target_file) ){
				// $data['url'] = $target_file;
				$data['url'] = str_replace('../../', '' , $target_file);
				$data['count']++;
			}

			$file_num++;
		// }

	}

	die(json_encode($data));
?>