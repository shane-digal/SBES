<?php
	include('../../includes/module.php');

	$data = array();
	$data['success'] = false;
	$is_draft = $_POST["is_draft"];
	$record_count = $_POST["record_count"];
	$days_count = $_POST['days_count'];
	
	$payroll_start = new DateTime($_POST['payroll_start']);
	$payroll_start->modify('+1 day');
	$payroll_start = date_format($payroll_start, 'Y-m-d');
	$payroll_end = new DateTime($_POST['payroll_end']);
	$payroll_end->modify('+1 day');
	$payroll_end = date_format($payroll_end, 'Y-m-d');
	date_add($payroll_end,date_interval_create_from_date_string("1 day"));
	$checked_ids = explode(",", $_POST["checked_ids"]);
	$now = date('Y-m-d H:i:s');
	$project_id = 1;
	$status = 'Pending';
	$tables = array();
	$bonuses = array();
	$deductions = array();
	$index = 0;

	if($record_count != 0 && ($is_draft == "0" || $is_draft == "2")) {
		$tables['payroll'] = "rec_payrolls";
		$tables['items'] = "rec_payroll_items";
		$tables['dates'] = "rec_payroll_item_dates";
		
		if(isset($_POST['payroll_id']) && $_POST['payroll_id'] != '') {
			//DELETE FROM DRAFTS BEFORE SAVING PAYROLL IF DRAFT IS SAVED
			$delete_payroll = $con->prepare("DELETE FROM rec_payroll_drafts 
				WHERE payroll_id = ?");
			$delete_payroll->bind_param("i", $_POST['payroll_id']);
			$delete_payroll->execute();
			$delete_payroll->close();
		}
	} else {
		$tables['payroll'] = "rec_payroll_drafts";
		$tables['items'] = "rec_payroll_item_drafts";
		$tables['dates'] = "rec_payroll_item_date_drafts";
	}	
	
	$add_payroll = $con->prepare("INSERT INTO " . $tables['payroll'] . " VALUES (0, ?, ?, ?, ?, ?, ?)");
		$bind = $add_payroll->bind_param("isssss",
		$project_id,
		$payroll_start,
		$payroll_end,
		$status,
		$now,
		$now);
	$insert = $add_payroll->execute();
	
	if($insert) {
		$payroll_id = $add_payroll->insert_id;
		$add_payroll->close();
		
		foreach($checked_ids as $id) {
			if(isset($_POST['bonus']) && $_POST['bonus'] != ' ') {
				foreach($_POST['bonus'] as $bonus) {
					$values = explode(",", $bonus);
					$e_id = $values[2];

					if($id == $e_id) $bonuses[$index++] = $values[0];
				}
				$index = 0;
			}

			if(isset($_POST['deduction']) && $_POST['deduction'] != ' ') {
				foreach($_POST['deduction'] as $deduction) {
					$values = explode(",", $deduction);
					$e_id = $values[2];

					if($id == $e_id) $deductions[$index++] = $values[0];
				}
			}
			
			$bonuses = (!empty($bonuses)) ? implode(",", $bonuses) : '';
			$deductions = (!empty($deductions)) ? implode(",", $deductions) : '';
			$regular_time = $_POST['input_regular_time'.$id];
			$overtime = $_POST['input_OT'.$id];
			$basic_pay = $_POST['input_basic'.$id];
			$ot_pay = $_POST['input_ot_pay'.$id];
			$deminimis = $_POST['deminimis'.$id];
			$thirteenth_month = (isset($_POST['bonus'.$id]) && 
				count($_POST['bonus'.$id]) != 0) ?
				array_sum($_POST['bonus'.$id]) : 0;
			$gross_pay = $_POST['gross_pay'.$id];
			$net_pay = $_POST['net_pay'.$id];

			$insert_items = $con->prepare("INSERT INTO  " . $tables['items'] . "
				VALUES (0, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$bind = $insert_items->bind_param("iissddddddddss",
				$payroll_id,
				$id,
				$bonuses,
				$deductions,
				$regular_time,
				$overtime,
				$basic_pay,
				$ot_pay,
				$deminimis,
				$thirteenth_month,
				$gross_pay,
				$net_pay,
				$status,
				$now);
			$insert = $insert_items->execute();
			if(!$insert) {
				$data['success'] = false;
				$data['error'] = $insert_items->error;
				$insert_items->close();				
			}	
			else {
				$payroll_item_id = $insert_items->insert_id;
				$insert_items->close();

				$start = $payroll_start;
				$end = $payroll_end;
				$count = 1;

				do {
					$day = strtoupper(date('D',strtotime($start)));
					

					$insert_dates = $con->prepare("INSERT INTO " . $tables['dates'] . "
						VALUES (0, ?, ?, ?, ?)");
					$bind = $insert_dates->bind_param("issd",
						$payroll_item_id,
						$day,
						$start,
						$_POST['input_minutes'.$id.$count]);
					$insert = $insert_dates->execute();
					if(!$insert) {
						$data['success'] = false;
						$data['error'] = $_POST['input_minutes'.$id.$count];
					}
					$insert_dates->close();
					
					$start = date('Y-m-d', strtotime($start. ' + 1 days'));
					$count++;
				}while (strtotime($start) <= strtotime($end));

				$data['success'] = true;
			}
		}
	}
	else {
		$data['success'] = false;
		$data['error'] = $add_payroll->error;
		$add_payroll->close();
	}
	
	die(json_encode($data));
?>




