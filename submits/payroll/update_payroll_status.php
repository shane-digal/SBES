<?php
	include('../../includes/module.php');

	$data = array();
	$data['success'] = false;
    $id = $_POST['item_id'];
    $status = $_POST['item_status'];

    $update_payroll = $con->prepare("UPDATE rec_payroll_items 
        SET payrollitem_status = ?
        WHERE payrollitem_id = ?");
    $update_payroll->bind_param("si", 
        $status,
        $id);
    $update = $update_payroll->execute();

    if($update)
        $data['success'] = true;
    else 
        $data['error'] = $update_payroll->error;
    $update_payroll->close();

    die(json_encode($data));
?>




