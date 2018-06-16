<?php
	// error_reporting(E_ALL);
	// ini_set('display_errors', 1);
	include("module.php");

	function getEmployeeList($project_id, $offset, $limit,  $searchKey = ""){
		global $con;

		$key 		= "%" . $searchKey . "%";

		$getEmployees	= 	$con->prepare("	SELECT re.employee_id,
											setFullName(re.employee_id) as fullName,
											re.employee_imagepath,
											re.employee_empstatus,
											lep.position_name,
											re.employee_wage,
    										COALESCE(rp.project_name, 'None') as project_name
										FROM rec_employees re
										LEFT JOIN lib_employee_positions lep
											ON re.position_id = lep.position_id
										LEFT JOIN rec_projects rp
											ON re.project_id = rp.project_id
										WHERE
											IF( ? != 0 , re.project_id = ? , re.project_id >= 0)
										AND (setFullName(re.employee_id) LIKE ?)
										AND employee_empstatus != 'DEACTIVATED'
										ORDER BY re.employee_lname
										LIMIT ? , ? ");
		$getEmployees	->bind_param("iisii", $project_id, $project_id,   $key, $offset, $limit);

		$getEmployees->execute();

		return $getEmployees;
	}

	function getEmployeeCount($project_id,  $searchKey = ""){
		global $con;

			$key 		= "%" . $searchKey . "%";

		$getEmployees	= 	$con->prepare("SELECT employee_id FROM rec_employees
		 									WHERE IF(? != 0 , project_id = ? , project_id != -1)
											 AND (setFullName(employee_id) LIKE ? ) ");
		$getEmployees	->bind_param("iis", $project_id, $project_id,  $key);

		$getEmployees->execute();
		$getEmployees->store_result();

		return $getEmployees->num_rows;
	}

?>