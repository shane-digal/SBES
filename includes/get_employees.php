<?php
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


	function getEmployeeEditList($project_id, $position_id, $searchKey = "", $ids = "0")
	{
		global $con;
		$zero 	= 0;
		if($searchKey != "")
		{
			$key 		= "%" . $searchKey . "%";

			$getEmployees	= 	$con->prepare("	SELECT rec_employees.employee_id,
												rec_employees.employee_fname,
												rec_employees.employee_mname,
												rec_employees.employee_lname,
												rec_employees.employee_imagepath,
												lib_employee_positions.position_name
										 	FROM rec_employees
										 	INNER JOIN lib_employee_positions
										 	ON rec_employees.position_id = lib_employee_positions.position_id
										 	WHERE
										 	(rec_employees.project_id = ? OR rec_employees.project_id = ?)
										 	AND rec_employees.position_id = ?
										 	AND (rec_employees.employee_fname LIKE ? OR
										 		rec_employees.employee_mname LIKE ? OR
										 		rec_employees.employee_lname LIKE ?)
										 	AND rec_employees.employee_id NOT IN ($ids)
									 		ORDER BY rec_employees.employee_lname");
			$getEmployees	->bind_param("iiisss", $project_id, $zero, $position_id, $key, $key, $key);
		}
		else
		{
			$getEmployees	= 	$con->prepare("	SELECT rec_employees.employee_id,
													rec_employees.employee_fname,
													rec_employees.employee_mname,
													rec_employees.employee_lname,
													rec_employees.employee_imagepath,
													lib_employee_positions.position_name
											 	FROM rec_employees
											 	INNER JOIN lib_employee_positions
											 	ON rec_employees.position_id = lib_employee_positions.position_id
											 	WHERE
											 	(rec_employees.project_id = ? OR rec_employees.project_id = ?)
											 	AND rec_employees.position_id = ?
											 	AND rec_employees.employee_id NOT IN ($ids)
											 	ORDER BY rec_employees.employee_lname");
			$getEmployees	->bind_param("iii", $project_id, $zero, $position_id);
		}

		$getEmployees->execute();

		return $getEmployees;
	}

?>