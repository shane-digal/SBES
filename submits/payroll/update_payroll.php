<?php
	include('../../includes/module.php');

	$data = array();
	$data['success'] = false;
	$is_draft = $_POST["is_draft"];
	$record_count = $_POST["record_count"];
	$days_count = $_POST['days_count'];
	$payroll_id = $_POST['payroll_id'];
	$payroll_start = date_format(date_create($_POST['payroll_start']), 'Y-m-d');
	$payroll_end = date_format(date_create($_POST['payroll_end']), 'Y-m-d');
	$checked_ids = explode(",", $_POST["checked_ids"]);
	$now = date('Y-m-d H:i:s');
	$project_id = 1;
	$status = 'Pending';
	$tables = array();
	$bonuses = array();
	$deductions = array();
	$index = 0;


	if($record_count != 0 && $is_draft == "0") {
		$tables['payroll'] = "rec_payrolls";
		$tables['items'] = "rec_payroll_items";
		$tables['dates'] = "rec_payroll_item_dates";

				
	} else {
		$tables['payroll'] = "rec_payroll_drafts";
		$tables['items'] = "rec_payroll_item_drafts";
		$tables['dates'] = "rec_payroll_item_date_drafts";
	}	
	
	$update_payroll = $con->prepare("UPDATE " . $tables['payroll'] . " SET 
		project_id = ?,
		payroll_start = ?,
		payroll_end = ?,
		payroll_status = ?
		WHERE payroll_id = ?");
		$bind = $update_payroll->bind_param("isssi",
		$project_id,
		$payroll_start,
		$payroll_end,
		$payroll_id);
	$update = $update_payroll->execute();
	
	if($update) {
		$update_payroll->close();
		
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
					$start = date('Y-m-d', strtotime($start. ' + 1 days'));

					$insert_dates = $con->prepare("INSERT INTO " . $tables['dates'] . "
						VALUES (0, ?, ?, ?, ?)");
					$bind = $insert_dates->bind_param("issd",
						$payroll_item_id,
						$day,
						$start,
						$_POST['input_minutes'.$id.$count]);
					$insert = $insert_dates->execute();
					if(!$insert)
						consolePrint($insert_dates->error);
					$count++;
				}while (strtotime($start) <= strtotime($end));

				$data['success'] = true;
			}
		}
	}
	else {
		$data['success'] = false;
		$data['error'] = $update_payroll->error;
		$update_payroll->close();
	}
	die(json_encode($data));
?>




