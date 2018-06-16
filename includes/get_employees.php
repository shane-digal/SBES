<?php 
	include("module.php");

	function getEmployeeList($project_id, $position_id, $searchKey = "", $ids = "0")
	{
		global $con; 

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
										 	WHERE rec_employees.project_id = ?
										 	AND rec_employees.position_id = ?
										 	AND (rec_employees.employee_fname LIKE ? OR 
										 		rec_employees.employee_mname LIKE ? OR
										 		rec_employees.employee_lname LIKE ?)
										 	AND rec_employees.employee_id NOT IN ($ids)
									 		ORDER BY rec_employees.employee_lname");
			$getEmployees	->bind_param("iisss", $project_id, $position_id, $key, $key, $key);
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
											 	WHERE rec_employees.project_id = ?
											 	AND rec_employees.position_id = ?
											 	AND rec_employees.employee_id NOT IN ($ids)
											 	ORDER BY rec_employees.employee_lname");
			$getEmployees	->bind_param("ii", $project_id, $position_id);
		}

		$getEmployees->execute();
		
		return $getEmployees;
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