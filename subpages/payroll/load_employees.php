<?php
	include('../../includes/module.php');
	
	$employees=array();
	$employee_count=0;
	$start=$_GET['start'];
	$end=$_GET['end'];
	

	$start = str_replace('/', '.', $start);
	$start = date('Y-m-d', strtotime($start));

	$end = str_replace('/', '.', $end);
	$end = date('Y-m-d', strtotime($end));

	$getDetails = $con->prepare("SELECT rec_employees.employee_id,
								rec_employees.employee_fname,
								rec_employees.employee_mname,
								rec_employees.employee_lname,
								rec_employees.employee_wage,
								lib_employee_positions.position_name
								FROM rec_employees
								INNER JOIN lib_employee_positions
								ON rec_employees.position_id = lib_employee_positions.position_id
								WHERE rec_employees.employee_id IN 
									(SELECT DISTINCT 
									employee_id 
									FROM rec_attendances)");
	$getDetails ->execute();
	$getDetails ->bind_result($id,
								$fname,
								$mname,
								$lname,
								$wage,
								$position);
								
	while($getDetails->fetch()){
		$employees[$employee_count]['id']		= $id; 
		$employees[$employee_count]['name']		= $fname.' '.$lname; 
		$employees[$employee_count]['wage']		= $wage; 
		$employees[$employee_count]['position']	= $position; 
		$employee_count++;
	}

	$getDetails->close();

	for($i=0; $i<$employee_count; $i++)
	{
?>

<tr>
	<td nowrap>
		<input type="checkbox" class="id-checkbox"/>
	</td>
	<td nowrap><h5 class="mtb0"><?php echo $employees[$i]['id']; ?></h5></td>
	<td nowrap><h5 class="mtb0"><?php echo $employees[$i]['name']; ?></h5></td>
	<td nowrap><h5 class="mtb0"><?php echo $employees[$i]['position'] ?></h5></td>
	<td nowrap>
		<h5 class="mtb0">
			<input type="number" class="form-control payroll-input" step="0.1" id="<?php echo 'input_wage'.$employees[$i]['id']; ?>" value="<?php echo $employees[$i]['wage'] ?>" placeholder="Hourly rate..." />	
		</h5>
	</td>

	<!-- dates -->
	<?php 
		$input_count 	= 1;
		$basic_pay 		= 0;
		do{
		
		$minutes 		= 0;
		$ot 			= "OT";
		$start_text 	= $start . '%';
		$get_minutes 	= $con->prepare("SELECT TIMESTAMPDIFF(minute , attendance_in ,attendance_out) AS 'Minutes'  FROM rec_attendances WHERE employee_id = ? AND attendance_in LIKE ? AND attendance_remark <> ?");
		$get_minutes 	->bind_param("iss", $employees[$i]['id'], $start_text, $ot);
		$get_minutes 	->execute();
		$get_minutes 	->bind_result($minutes_worked);
		while($get_minutes->fetch())
		{
			$minutes 	+= $minutes_worked;
		}

		$get_minutes	->close();
		$basic_pay 		= ($minutes/60)*$employees[$i]['wage'];
	?>
		<td nowrap><h5 class="mtb0"><input type="number" id="<?php echo 'input_minutes'.$employees[$i]['id'].$input_count++; ?>" onchange="calculateBasic(<?php echo $employees[$i]['id']; ?>);" class="form-control payroll-input" step="0.1" value="<?= $minutes; ?>" placeholder="Minutes worked..." />	</h5></td>
	<?php 
		$start = date('Y-m-d', strtotime($start. ' + 1 days'));
	}while(strtotime($start) <= strtotime($end)); ?>

	<!-- total time -->
	<td nowrap>
		<h5 class="mtb0">
			<input type="number" class="form-control payroll-input" step="0.1" value="2824" placeholder="Minutes worked..." />	
		</h5>
	</td>
	<td nowrap>
		<h5 class="mtb0">
			<input type="number" class="form-control payroll-input" id="<?php echo 'input_totaltime'.$employees[$i]['id']; ?>" step="0.1" value="72" placeholder="Minutes worked..." />	
		</h5>
	</td>
	<td nowrap><h5 class="mtb0" id="<?php echo 'input_basic'.$employees[$i]['id']; ?>"><?php echo displayMoney($basic_pay); ?></h5></td>

	<!-- EARNINGS -->
	<td nowrap><h5 class="mtb0">4471</h5></td>
	<td nowrap><h5 class="mtb0">91</h5></td>
	<td nowrap>
		<h5 class="mtb0">
			<input type="number" class="form-control payroll-input" step="0.1" value="72" placeholder="Minutes worked..." />	
		</h5>
	</td>

	<!-- DEDUCTIONS -->
	<?php for($d=0; $d<count($_SESSION['deductions']); $d++) { 
		if($_SESSION['deductions'][$d]['amount'] != 0)
			$deduction = $_SESSION['deductions'][$d]['amount'];
		else
			$deduction = ($employees[$i]['wage']*(8*30))*($_SESSION['deductions'][$d]['percent']/100);
		$name = preg_replace('/\s+/', '', $_SESSION['deductions'][$d]['name']);
	?>
	<td nowrap>
		<h5 class="mtb0">
			<input type="checkbox" class="<?php echo $name.'-checkbox'; ?>"/> <?php echo $deduction; ?>
		</h5>
	</td>
	<?php } ?>
 
	<!-- BONUSES -->
	<?php for($b=0; $b<count($_SESSION['bonuses']); $b++) { 
		if($_SESSION['bonuses'][$b]['amount'] != 0)
			$bonus 		= $_SESSION['bonuses'][$b]['amount'];
		else
			$bonus		= ($employees[$i]['wage']*(8*30))*($_SESSION['bonuses'][$b]['percent']/100);

		$name = preg_replace('/\s+/', '', $_SESSION['bonuses'][$b]['name']);
	?>
	<td nowrap>
		<h5 class="mtb0">
			<input type="checkbox" class="<?php echo $name.'-checkbox'; ?>"/> <?php echo $bonus; ?>
		</h5>
	</td>
	<?php } ?>

	<!-- TOTALS -->
	<td nowrap><h5 class="mtb0">4562</h5></td>
	<td nowrap><h5 class="mtb0">4242</h5></td> 

</tr>
<?php } ?>