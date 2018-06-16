<?php 
	include("module.php");

	function getPayrollList($dateRange = "", $status, $limit, $offset) {
		global $con; 
		
		$status_filter = ($status == 'All') ? "<>" : "=";

		if($dateRange == "") {
			$getPayrolls = $con->prepare("SELECT rec_payrolls.payroll_id, 
				rec_payrolls.project_id, 
				rec_payrolls.payroll_start,
				rec_payrolls.payroll_end,
				rec_payrolls.payroll_status,
				rec_projects.project_name
				FROM rec_payrolls
				INNER JOIN rec_projects
				ON rec_payrolls.project_id = rec_projects.project_id
				WHERE payroll_status " . $status_filter . " ?
				LIMIT ? OFFSET ?");
			$getPayrolls->bind_param("sii", $status, $limit, $offset);
		}
		/* elseif($searchKey == "" && $dateRange != "") {
			$dates					= explode(" - ", $dateRange);
			$start 					= date_format(date_create($dates[0]), 'Y-m-d');
			$end 					= date_format(date_create($dates[1]), 'Y-m-d');

			$getPayrolls	= 	$con->prepare("SELECT rec_projects.project_id, 
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
			$getPayrolls	->bind_param("sssssii", $start, $end, $start, $end, $status, $limit, $offset);
		}
		elseif($searchKey != "" && $dateRange != "")
		{
			$getPayrolls	= 	$con->prepare("SELECT rec_projects.project_id, 
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
			$getPayrolls	->bind_param("ssssssii", $key, $start, $end, $start, $end, $status, $limit, $offset);
		}
		else
		{
			$getPayrolls	= 	$con->prepare("SELECT rec_projects.project_id, 
												rec_projects.project_name, 
												(SELECT COUNT(rec_employees.employee_id) FROM rec_employees WHERE rec_employees.project_id = rec_projects.project_id) as 'employees', 
												rec_projects.project_start, 
												rec_projects.project_end, 
												rec_projects.project_estbudget, 
												rec_projects.project_status 
												FROM rec_projects
												WHERE rec_projects.project_status " . $status_filter . " ?
												LIMIT ? OFFSET ?");
			$getPayrolls	->bind_param("sii", $status, $limit, $offset);
		}*/
		
		$getPayrolls->execute();

		return $getPayrolls;
	}

	function getPayrollDraftList($dateRange = "", $status, $limit, $offset) {
		global $con; 
		
		$status_filter = ($status == 'All') ? "<>" : "=";

		if($dateRange == "") {
			$getPayrolls = $con->prepare("SELECT rec_payroll_drafts.payroll_id, 
				rec_payroll_drafts.project_id, 
				rec_payroll_drafts.payroll_start,
				rec_payroll_drafts.payroll_end,
				rec_payroll_drafts.payroll_status,
				rec_projects.project_name
				FROM rec_payroll_drafts
				INNER JOIN rec_projects
				ON rec_payroll_drafts.project_id = rec_projects.project_id
				WHERE payroll_status " . $status_filter . " ?
				LIMIT ? OFFSET ?");
			$getPayrolls->bind_param("sii", $status, $limit, $offset);
		}
		/* elseif($searchKey == "" && $dateRange != "") {
			$dates					= explode(" - ", $dateRange);
			$start 					= date_format(date_create($dates[0]), 'Y-m-d');
			$end 					= date_format(date_create($dates[1]), 'Y-m-d');

			$getPayrolls	= 	$con->prepare("SELECT rec_projects.project_id, 
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
			$getPayrolls	->bind_param("sssssii", $start, $end, $start, $end, $status, $limit, $offset);
		}
		elseif($searchKey != "" && $dateRange != "")
		{
			$getPayrolls	= 	$con->prepare("SELECT rec_projects.project_id, 
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
			$getPayrolls	->bind_param("ssssssii", $key, $start, $end, $start, $end, $status, $limit, $offset);
		}
		else
		{
			$getPayrolls	= 	$con->prepare("SELECT rec_projects.project_id, 
												rec_projects.project_name, 
												(SELECT COUNT(rec_employees.employee_id) FROM rec_employees WHERE rec_employees.project_id = rec_projects.project_id) as 'employees', 
												rec_projects.project_start, 
												rec_projects.project_end, 
												rec_projects.project_estbudget, 
												rec_projects.project_status 
												FROM rec_projects
												WHERE rec_projects.project_status " . $status_filter . " ?
												LIMIT ? OFFSET ?");
			$getPayrolls	->bind_param("sii", $status, $limit, $offset);
		}*/
		
		$getPayrolls->execute();

		return $getPayrolls;
	}

	/*
	function getProjectDraftList($searchKey = "", $dateRange = "", $limit, $offset) 
	{
		global $con; 
		
		if($searchKey != "" && $dateRange == "")
		{
			$key 		= "%".$searchKey."%";

			$getPayrolls	= 	$con->prepare("SELECT rec_project_drafts.project_id, 
												rec_project_drafts.project_name, 
												(SELECT COUNT(rec_employees.employee_id) FROM rec_employees WHERE rec_employees.project_id = rec_project_drafts.project_id) as 'employees', 
												rec_project_drafts.project_start, 
												rec_project_drafts.project_end, 
												rec_project_drafts.project_estbudget
												FROM rec_project_drafts
												WHERE rec_project_drafts.project_name LIKE ? 
												LIMIT ? OFFSET ?");
			$getPayrolls	->bind_param("sii", $key, $limit, $offset);
		}
		elseif($searchKey == "" && $dateRange != "")
		{
			$dates					= explode(" - ", $dateRange);
			$start 					= date_format(date_create($dates[0]), 'Y-m-d');
			$end 					= date_format(date_create($dates[1]), 'Y-m-d');

			$getPayrolls	= 	$con->prepare("SELECT rec_project_drafts.project_id, 
												rec_project_drafts.project_name, 
												(SELECT COUNT(rec_employees.employee_id) FROM rec_employees WHERE rec_employees.project_id = rec_project_drafts.project_id) as 'employees', 
												rec_project_drafts.project_start, 
												rec_project_drafts.project_end, 
												rec_project_drafts.project_estbudget
												FROM rec_project_drafts
												WHERE (rec_project_drafts.project_start BETWEEN ? AND ?)
												AND  (rec_project_drafts.project_end BETWEEN ? AND ?)
												LIMIT ? OFFSET ?");
			$getPayrolls	->bind_param("ssssii", $start, $end, $start, $end, $limit, $offset);
		}
		elseif($searchKey != "" && $dateRange != "")
		{
			$getPayrolls	= 	$con->prepare("SELECT rec_project_drafts.project_id, 
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
			$getPayrolls	->bind_param("ssssssii", $key, $start, $end, $start, $end, $limit, $offset);
		}
		else
		{
			$getPayrolls	= 	$con->prepare("SELECT rec_project_drafts.project_id, 
												rec_project_drafts.project_name, 
												(SELECT COUNT(rec_employees.employee_id) FROM rec_employees WHERE rec_employees.project_id = rec_project_drafts.project_id) as 'employees', 
												rec_project_drafts.project_start, 
												rec_project_drafts.project_end, 
												rec_project_drafts.project_estbudget
												FROM rec_project_drafts
												LIMIT ? OFFSET ?");
			$getPayrolls	->bind_param("ii", $limit, $offset);
		}
		
		$getPayrolls->execute();

		return $getPayrolls;
	}*/
?>