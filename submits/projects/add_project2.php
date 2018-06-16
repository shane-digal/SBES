<?php
	include('../../includes/module.php');

	$data 					= array();
	$data['success']		= false;
	$dir        			= "../../uploads/projects/";
	$prefix 				= '../../uploads/projects/temp/';

	if(isset($_POST['project_name']))
	{
		$project_id 			= $_POST['project_id'];
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

			if($project_id == "0")
			{
				$insert_project 		= $con->prepare("INSERT INTO rec_projects 
												VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
				$bind 					= $insert_project->bind_param("issssssdsss", 
										$project_id,
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
				$insert_project 		= $con->prepare("UPDATE rec_projects SET
												project_contractnum = ?,
												project_name = ?,
												project_description = ?,
												project_client = ?,
												project_start = ?,
												project_end = ?,
												project_estbudget = ?,
												project_lastupdated = ? 
												WHERE project_id = ?");
				$bind 					= $insert_project->bind_param("ssssssdsi", 
											$contract_number,
											$project_name,
											$project_description,
											$client_name,
											$start,
											$end,
											$estimated_budget,
											$now,
											$project_id);
			}
		}
		else
		{
			$foremen_table 		= "rec_project_draft_foremen";
			$employees_table	= "rec_project_draft_employees";
			$mats_table 		= "rec_project_draft_material_plans";

			$insert_project 		= $con->prepare("INSERT INTO rec_project_drafts VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$bind 					= $insert_project->bind_param("issssssdss", 
										$project_id,
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
			$project_id 			= ($project_id != "0") ? $project_id : $insert_project->insert_id;
			
			/**************************************************************************
			 * INSERT EMPLOYEES AND MATERIALS
			 */
			if($insert)
			{
				$data['success'] 	= true;
				$insert_project  	->close();

				if($_POST['is_draft'] != "1")
				{
					$dir        		.=  ($_POST['is_draft'] == "0") ? $project_id.'/' : 'drafts/'.$project_id.'/' ;
					mkdir($dir, 0777);

					if($_POST['is_draft'] == "2")
						deleteRecords($project_id);
				}
				// else if($_POST['is_draft'] == "1")
				// {

				// }
				// else i)
				// {
				// 	//REMOVE EMPLOYEES AND MATERIALS
					
				// }
				

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
					for($i = 0; $i < count($foremen_id); $i++) 
					{
						$insert_foreman	->bind_param("iis", $project_id, $foremen_id[$i], $now);
						$insert_foreman	->execute();
					}
					$insert_foreman		->close();
					
					$insert_employee 	= $con->prepare("INSERT INTO " . $employees_table . "
														VALUES (0, ?, ?, ?)");
					for($i = 0; $i < count($employee_id); $i++) 
					{
						$insert_employee->bind_param("iis", $project_id, $employee_id[$i], $now);
						$insert_employee->execute();
					}
					$insert_employee	->close();

					$insert_materials 	= $con->prepare("INSERT INTO " . $mats_table . "
														VALUES (0, ?, ?, ?)");
					for($i = 0; $i < count($materials); $i++) 
					{
						$insert_materials->bind_param("iid", $project_id, $materials[$i], $quantities[$i]);
						$insert_materials->execute();
					}
					$insert_materials	->close();


					if($_POST['is_draft'] == "0")
					{
						$mask 			=  $prefix.$_SESSION['tmp_project_id'].'_*.*';
						$data['items'] 	= array_map('moveAttachments', glob($mask));
						unset($_SESSION['tmp_project_id']);
					}
				}
			}
			else
			{
				$data['error'] 	= $insert_project->error;
				$insert_project	->close();
			}
		}	
		else
		{
			$data['success']=false;
			$data['error'] 	= 'bind_param() failed: '.$insert_project->error;
			$insert_project->close();
		}
	}

	function deleteRecords($id)
	{
		global $con;

		if($id != "0")
		{
			$update_emp = $con->prepare("UPDATE rec_employees
										SET project_id = 0
										WHERE project_id = ?");
			$update_emp ->bind_param("i", $id);
			$update_emp ->execute();
			$update_emp ->close();

			$remove_f 	= $con->prepare("DELETE FROM rec_project_foremen
										WHERE project_id = ?");
			$remove_f 	->bind_param("i", $id);
			$remove_f 	->execute();
			$remove_f 	->close();

			$remove_e 	= $con->prepare("DELETE FROM rec_project_employees
										WHERE project_id = ?");
			$remove_e 	->bind_param("i", $id);
			$remove_e 	->execute();
			$remove_e 	->close();

			$remove_m 	= $con->prepare("DELETE FROM rec_project_material_plans
										WHERE project_id = ?");
			$remove_m 	->bind_param("i", $id);
			$remove_m 	->execute();
			$remove_m 	->close();
		}
		
	}

	/**************************************************************************
	 * MOVE ATTACHMENTS TO NEWLY CREATED FOLDER AND REMOVE PREFIX
	 */
	function moveAttachments($file)
	{
		global $dir;
		global $prefix;
		$new = preg_replace('/^'.preg_quote($prefix.$_SESSION['tmp_project_id'].'_', '/').'/', '', $file);
		
		rename($file, $dir.$new);
	}

	die(json_encode($data));
?>




