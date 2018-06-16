<?php 
	include("module.php");

	function getProjectList($searchKey = "", $dateRange = "", $status, $limit, $offset)
	{
		global $con; 
	
		if($status == 'All')
			$status_filter 	= "<>";
		else
			$status_filter 	= "=";

		if($searchKey != "" && $dateRange == "")
		{
			$key 		= "%" . $searchKey . "%";

			$getProjects	= 	$con->prepare("SELECT rec_projects.project_id, 
												rec_projects.project_name, 
												(SELECT COUNT(rec_employees.employee_id) FROM rec_employees WHERE rec_employees.project_id = rec_projects.project_id) as 'employees', 
												rec_projects.project_start, 
												rec_projects.project_end, 
												rec_projects.project_estbudget, 
												rec_projects.project_status 
												FROM rec_projects
												WHERE rec_projects.project_name LIKE ? 
												AND rec_projects.project_status " . $status_filter . " ?
												LIMIT ? OFFSET ?");
			$getProjects	->bind_param("ssii", $key, $status, $limit, $offset);
		}
		
		elseif($searchKey == "" && $dateRange != "")
		{
			$dates					= explode(" - ", $dateRange);
			$start 					= date_format(date_create($dates[0]), 'Y-m-d');
			$end 					= date_format(date_create($dates[1]), 'Y-m-d');

			$getProjects	= 	$con->prepare("SELECT rec_projects.project_id, 
												rec_projects.project_name, 
												(SELECT COUNT(rec_employees.employee_id) FROM rec_employees WHERE rec_employees.project_id = rec_projects.project_id) as 'employees', 
												rec_projects.project_start, 
												rec_projects.project_end, 
												rec_projects.project_estbudget, 
												rec_projects.project_status 
												FROM rec_projects
												WHERE rec_projects.project_start = ?
												AND  rec_projects.project_end = ?
												AND rec_projects.project_status " . $status_filter . " ?
												LIMIT ? OFFSET ?");
			$getProjects	->bind_param("sssii", $start, $end, $status, $limit, $offset);
		}

		elseif($searchKey != "" && $dateRange != "")
		{
			$getProjects	= 	$con->prepare("SELECT rec_projects.project_id, 
												rec_projects.project_name, 
												(SELECT COUNT(rec_employees.employee_id) FROM rec_employees WHERE rec_employees.project_id = rec_projects.project_id) as 'employees', 
												rec_projects.project_start, 
												rec_projects.project_end, 
												rec_projects.project_estbudget, 
												rec_projects.project_status 
												FROM rec_projects
												WHERE rec_projects.project_name LIKE ? 
												AND rec_projects.project_start = ?
												AND  rec_projects.project_end = ?
												AND rec_projects.project_status " . $status_filter . " ?
												LIMIT ? OFFSET ?");
			$getProjects	->bind_param("ssssii", $key, $start, $end, $status, $limit, $offset);
		}
		else
		{
			$getProjects	= 	$con->prepare("SELECT rec_projects.project_id, 
												rec_projects.project_name, 
												(SELECT COUNT(rec_employees.employee_id) FROM rec_employees WHERE rec_employees.project_id = rec_projects.project_id) as 'employees', 
												rec_projects.project_start, 
												rec_projects.project_end, 
												rec_projects.project_estbudget, 
												rec_projects.project_status 
												FROM rec_projects
												WHERE rec_projects.project_status " . $status_filter . " ?
												LIMIT ? OFFSET ?");
			$getProjects	->bind_param("sii", $status, $limit, $offset);
		}

		$getProjects->execute();
		
		return $getProjects;
	}
	
?>