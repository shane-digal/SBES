<?php 
    include('module.php');

    $_SESSION['deductions'] = array();
	$_SESSION['bonuses'] =  array();
	$index 				= 0;

	$getDeductions 		= $con->prepare("SELECT deduction_id,
												deduction_name,
												deduction_percent,
												deduction_amount
												FROM lib_deductions");
	$bind 				= $getDeductions->execute();
	$getDeductions		->store_result();
	$getDeductions		->bind_result($deduction_id,
										$deduction_name,
										$deduction_percent,
										$deduction_amount);
	$deduction_count	= $getDeductions->num_rows();

	while($getDeductions->fetch()){
		$_SESSION['deductions'][$index]['id'] 		= $deduction_id;
		$_SESSION['deductions'][$index]['name'] 	= $deduction_name;
		$_SESSION['deductions'][$index]['percent'] 	= $deduction_percent;
		$_SESSION['deductions'][$index]['amount'] 	= $deduction_amount;
		$index++;
	}
	$getDeductions->close();
	$index				= 0;

	$getBonuses 		= $con->prepare("SELECT bonus_id,
												bonus_name,
												bonus_percent,
												bonus_amount
												FROM lib_bonuses");
	$bind 				= $getBonuses->execute();
	$getBonuses	        ->store_result();
	$getBonuses		    ->bind_result($bonus_id,
										$bonus_name,
										$bonus_percent,
										$bonus_amount);
	$bonus_count		= $getBonuses->num_rows();

	while($getBonuses->fetch()){
		$_SESSION['bonuses'][$index]['id'] 		= $bonus_id;
		$_SESSION['bonuses'][$index]['name'] 	= $bonus_name;
		$_SESSION['bonuses'][$index]['percent'] = $bonus_percent;
		$_SESSION['bonuses'][$index]['amount'] 	= $bonus_amount;
		$index++;
	}
	$getBonuses->close();
?>