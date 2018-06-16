<?php 
	include("module.php");

	function getProjectList($searchKey = "", $dateRange = "", $status, $limit, $offset) 
	{
		global $con; 
		
		$status_filter = ($status == 'All') ? "<>" : "=";

		if($searchKey != "" && $dateRange == "")
		{
			$key 		= "%".$searchKey."%";

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
												WHERE (rec_projects.project_start BETWEEN ? AND ?)
												AND  (rec_projects.project_end BETWEEN ? AND ?)
												AND rec_projects.project_status " . $status_filter . " ?
												LIMIT ? OFFSET ?");
			$getProjects	->bind_param("sssssii", $start, $end, $start, $end, $status, $limit, $offset);
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
												AND (rec_projects.project_start BETWEEN ? AND ?)
												AND  (rec_projects.project_end BETWEEN ? AND ?)
												AND rec_projects.project_status " . $status_filter . " ?
												LIMIT ? OFFSET ?");
			$getProjects	->bind_param("ssssssii", $key, $start, $end, $start, $end, $status, $limit, $offset);
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

	function getProjectDraftList($searchKey = "", $dateRange = "", $limit, $offset) 
	{
		global $con; 
		
		if($searchKey != "" && $dateRange == "")
		{
			$key 		= "%".$searchKey."%";

			$getProjects	= 	$con->prepare("SELECT rec_project_drafts.project_id, 
												rec_project_drafts.project_name, 
												(SELECT COUNT(rec_employees.employee_id) FROM rec_employees WHERE rec_employees.project_id = rec_project_drafts.project_id) as 'employees', 
												rec_project_drafts.project_start, 
												rec_project_drafts.project_end, 
												rec_project_drafts.project_estbudget
												FROM rec_project_drafts
												WHERE rec_project_drafts.project_name LIKE ? 
												LIMIT ? OFFSET ?");
			$getProjects	->bind_param("sii", $key, $limit, $offset);
		}
		elseif($searchKey == "" && $dateRange != "")
		{
			$dates					= explode(" - ", $dateRange);
			$start 					= date_format(date_create($dates[0]), 'Y-m-d');
			$end 					= date_format(date_create($dates[1]), 'Y-m-d');

			$getProjects	= 	$con->prepare("SELECT rec_project_drafts.project_id, 
												rec_project_drafts.project_name, 
												(SELECT COUNT(rec_employees.employee_id) FROM rec_employees WHERE rec_employees.project_id = rec_project_drafts.project_id) as 'employees', 
												rec_project_drafts.project_start, 
												rec_project_drafts.project_end, 
												rec_project_drafts.project_estbudget
												FROM rec_project_drafts
												WHERE (rec_project_drafts.project_start BETWEEN ? AND ?)
												AND  (rec_project_drafts.project_end BETWEEN ? AND ?)
												LIMIT ? OFFSET ?");
			$getProjects	->bind_param("ssssii", $start, $end, $start, $end, $limit, $offset);
		}
		elseif($searchKey != "" && $dateRange != "")
		{
			$getProjects	= 	$con->prepare("SELECT rec_project_drafts.project_id, 
												rec_project_drafts.project_name, 
												(SELECT COUNT(rec_employees.employee_id) FROM rec_employees WHERE rec_employees.project_id = rec_project_drafts.project_id) as 'employees', 
												rec_project_drafts.project_start, 
												rec_project_drafts.project_end, 
												rec_project_drafts.project_estbudget
												FROM rec_project_drafts
												WHERE rec_project_drafts.project_name LIKE ? 
												AND (rec_project_drafts.project_start BETWEEN ? AND ?)
												AND  (rec_project_drafts.project_end BETWEEN ? AND ?)
												LIMIT ? OFFSET ?");
			$getProjects	->bind_param("ssssssii", $key, $start, $end, $start, $end, $limit, $offset);
		}
		else
		{
			$getProjects	= 	$con->prepare("SELECT rec_project_drafts.project_id, 
												rec_project_drafts.project_name, 
												(SELECT COUNT(rec_employees.employee_id) FROM rec_employees WHERE rec_employees.project_id = rec_project_drafts.project_id) as 'employees', 
												rec_project_drafts.project_start, 
												rec_project_drafts.project_end, 
												rec_project_drafts.project_estbudget
												FROM rec_project_drafts
												LIMIT ? OFFSET ?");
			$getProjects	->bind_param("ii", $limit, $offset);
		}
		
		$getProjects->execute();

		return $getProjects;
	}
?>