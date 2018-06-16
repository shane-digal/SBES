<?php
	include('../../includes/module.php');

	$data 					= array();
	$data['success']		= false;
	$dir        			= "../../uploads/projects/";
	$prefix 				= '../../uploads/projects/temp/';


	if(isset($_POST['project_name']))
	{
		$id 					= 0;
		$contract_number		= $_POST['contract_number'];
		$project_name			= $_POST['project_name'];
		$project_description	= $_POST['project_description'];
		$client_name			= $_POST['client_name'];
		$dates					= explode(" - ", $_POST['project_duration']);
		$start 					= date_format(date_create($dates[0]), 'Y-m-d');
		$end 					= date_format(date_create($dates[1]), 'Y-m-d');
		$estimated_budget		= $_POST['estimated_budget'];
		$foremen_id 			= explode(",", $_POST['foremen_id']);
		$employee_id			= explode(",", $_POST['employee_id']);
		$all_ids 				= $_POST['foremen_id'] . ',' .  $_POST['employee_id'];
		$materials 				= explode(",", $_POST['project_materials']);
		$quantities 			= explode(",", $_POST['material_qtys']);
		$status					= "Pending";
		$now 					= date('Y-m-d H:i:s');

		if($_POST['is_draft'] == "0")
		{
			$foremen_table 		= "rec_project_foremen";
			$employees_table	= "rec_project_employees";
			$mats_table 		= "rec_project_material_plans";

			$insert_project 		= $con->prepare("INSERT INTO rec_projects VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$bind 					= $insert_project->bind_param("issssssdsss", 
										$id,
										$contract_number,
										$project_name,
										$project_description,
										$client_name,
										$start,
										$end,
										$estimated_budget,
										$status,
										$now,
										$now);
		}
		else
		{
			$foremen_table 		= "rec_project_draft_foremen";
			$employees_table	= "rec_project_draft_employees";
			$mats_table 		= "rec_project_draft_material_plans";

			$insert_project 		= $con->prepare("INSERT INTO rec_project_drafts VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$bind 					= $insert_project->bind_param("issssssdss", 
										$id,
										$contract_number,
										$project_name,
										$project_description,
										$client_name,
										$start,
										$end,
										$estimated_budget,
										$now,
										$now);
		}
		if($bind)
		{
			$insert 				= $insert_project->execute();
			
			if($insert)
			{
				$data['success'] 	= true;

				$project_id 		= $insert_project->insert_id;
				$insert_project  	->close();

				$dir        		.=  ($_POST['is_draft'] == "0") ? $project_id . '/' : 'drafts/'. $project_id . '/' ;
				mkdir($dir, 0777);

				$add_employees 		= $con->prepare("UPDATE rec_employees
													SET project_id = ?
													WHERE employee_id IN (" . $all_ids . ")");
				$bind 				= $add_employees->bind_param("i", $project_id);
					
				if(!$bind)
				{
					$data['success']=false;
					$data['error'] 	= 'bind_param() failed: ' . $add_employees->error;
				}
				else 
				{
					$data['success'] 	= true;
					$add_employees		->execute();
					$add_employees 		->close();
					
					$insert_foreman 	= $con->prepare("INSERT INTO " . $foremen_table . "
														VALUES (0, ?, ?, ?)");

					for($i = 0; $i < count($foremen_id); $i++) {
						$insert_foreman	->bind_param("iis", $project_id, $foremen_id[$i], $now);
						$insert_foreman	->execute();
					}

					$insert_foreman		->close();
					
					$insert_employee 	= $con->prepare("INSERT INTO " . $employees_table . "
														VALUES (0, ?, ?, ?)");

					for($i = 0; $i < count($employee_id); $i++) {
						$insert_employee->bind_param("iis", $project_id, $employee_id[$i], $now);
						$insert_employee->execute();
					}

					$insert_employee	->close();

					$insert_materials 	= $con->prepare("INSERT INTO " . $mats_table . "
														VALUES (0, ?, ?, ?)");

					for($i = 0; $i < count($materials); $i++) {
						$insert_materials->bind_param("iid", $project_id, $materials[$i], $quantities[$i]);
						$insert_materials->execute();
					}

					$insert_materials	->close();

					//$insert 				= $insert_project->execute();
					$mask 	=  $prefix . $_SESSION['tmp_project_id'] . '_*.*';
					//array_map('moveAttachments', glob($mask));
					$data['items'] 	= array_map('moveAttachments', glob($mask));
					unset($_SESSION['tmp_project_id']);
				}
			}
			else
			{
				$data['error'] 		= $insert_project->error;
				$insert_project->close();
			}

		}	
		else
		{
			$data['success']=false;
			$data['error'] 	= 'bind_param() failed: ' . $insert_project->error;
			$insert_project->close();
		}
	}

	//MOVE ATTACHMENTS TO NEWLY CREATED FOLDER AND REMOVE PREFIX
	function moveAttachments($file)
	{
		global $dir;
		global $prefix;
		$new = preg_replace('/^' . preg_quote($prefix . $_SESSION['tmp_project_id'] . '_', '/') . '/', '', $file);
		
		rename($file, $dir.$new);
	}

	die(json_encode($data));
?>




