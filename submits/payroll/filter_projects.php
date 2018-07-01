<?php
	include('../../includes/module.php');

	$data = array();
	$data['success'] = false;
	$status = $_POST["project_status"];
	$filter = '';
	$index = 0;

	if($status != 'All' && $status !='') {
		$getProjects = $con->prepare("SELECT project_id, project_name FROM rec_projects WHERE project_status = ?");
		$bind = $getProjects->bind_param("s", $status);
		if($getProjects === false) {
			$data['error'] = $getProjects->error;
			// die($data);
		} 
	}
	else
		$getProjects = $con->prepare("SELECT project_id, project_name FROM rec_projects");

	$getProjects->execute();
	$getProjects->bind_result($project_id, $project_name);
	
	while($getProjects->fetch()) {
		$data['element'][$index++] = '<option value="'.$project_id.'">'.$project_name.'</option>';
	}

	$data['count'] = $index;
	$getProjects->close();
	
	die(json_encode($data));
?>




