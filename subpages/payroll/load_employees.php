<?php
	include('../../includes/module.php');
	
	$employees = array();
	$employee_ids = array();
	$employee_count = 0;
	$start = $_GET['start'];
	$end = $_GET['end'];
	$overtime_rate = $_SESSION['overtime_rate']/100;
	$deminimis_cap = $_SESSION['deminimis_cap'];
	$minutes_allowance = $_SESSION['minutes_allowance'];

	$start = str_replace('/', '.', $start);
	$start = date('Y-m-d', strtotime($start));

	$end = str_replace('/', '.', $end);
	$end = date('Y-m-d', strtotime($end));

	$getDetails = $con->prepare(
		"SELECT rec_employees.employee_id,
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
	$getDetails ->bind_result(
		$id,
		$fname,
		$mname,
		$lname,
		$wage,
		$position);
								
	while($getDetails->fetch()){
		$employees[$employee_count]['id'] = $id; 
		$employees[$employee_count]['name'] = $fname.' '.$lname; 
		$employees[$employee_count]['wage'] = $wage; 
		$employees[$employee_count]['position']	= $position; 
		$employee_ids[$employee_count] = $id;
		$employee_count++;
	}

	$getDetails->close();

	for($i=0; $i<$employee_count; $i++)
	{
		$minutesOT = 0;
		$totalMinutes = 0;

		$employee_id = $employees[$i]['id'];
?>

<tr>
	<td nowrap>
		<input type="checkbox" class="id-checkbox" id="<?= 'checkbox'.$employee_id; ?>" 
			onclick="checkEmployees(this);" value="<?= $employee_id ?>"/>
	</td>
	<td nowrap><h5 class="mtb0"><?php echo $employee_id; ?></h5></td>
	<td nowrap><h5 class="mtb0"><?php echo $employees[$i]['name']; ?></h5></td>
	<td nowrap><h5 class="mtb0"><?php echo $employees[$i]['position'] ?></h5></td>
	<td nowrap>
		<h5 class="mtb0">
			<input type="number" class="form-control payroll-input" step="0.1" id="<?= 'input_wage'.$employee_id; ?>" value="<?= $employees[$i]['wage'] ?>"  onchange="calculateBasic(<?php echo $employee_id ?>);" placeholder="Hourly rate..." />	
		</h5>
	</td>

	<!-- dates -->
	<?php 
		$input_count = 1;
		$basic_pay = 0;

		do {
		//GET DAY EQUIVALENT OF DATE
		$filter = strtoupper(date('D',strtotime($start)));

		$minutes = 0;
		$ot = "OT";
		$start_filter = $start . '%';

		$getMinutes = $con->prepare(
			"SELECT TIMESTAMPDIFF(minute, attendance_in, attendance_out),
			attendance_day, 
			attendance_remark
			AS 'Minutes'  FROM rec_attendances 
			WHERE employee_id = ? AND attendance_in LIKE ?");
		$getMinutes->bind_param(
			"is", 
			$employee_id, 
			$start_filter);
		$getMinutes->execute();
		$getMinutes->store_result();
		$getMinutes->bind_result(
			$minutesWorked,
			$attendanceDay,
			$attendanceRemark);
		
		if($getMinutes->num_rows != 0) {
			while($getMinutes->fetch()) {
				if($attendanceRemark != 'OT') {
					$minutes += $minutesWorked;
					$totalMinutes += $minutesWorked;					
				}
				else
					$minutesOT += $minutesWorked;
			}
		}
		else 
			$minutesWorked = 0;
		
		$getMinutes->close();
		$basic_pay = ($minutes/60) * $employees[$i]['wage'];
		$ot_pay = ($minutesOT/60) * ($employees[$i]['wage'] * $overtime_rate);
		$deminimis = ($deminimis_cap < ($basic_pay + $ot_pay)) ?
			($basic_pay + $ot_pay) - $deminimis_cap : 0;
		$gross_pay = $basic_pay + $ot_pay;
	?>
		<td nowrap>
			<h5 class="mtb0">
				<input type="number" id="<?= 'input_minutes'.$employee_id.$input_count; ?>" name="<?= 'input_minutes'.$employee_id.$input_count++; ?>" onchange="calculateBasic(<?php echo $employee_id ?>);" class="form-control payroll-input" step="0.1" value="<?= $minutes; ?>" placeholder="Minutes worked..." />	</h5></td>
	<?php 
		$start = date('Y-m-d', strtotime($start. ' + 1 days'));
	}while(strtotime($start) <= strtotime($end)); $start = $_GET['start']; ?>

	<!-- total time -->
	<td nowrap>
		<input type="number" class="form-control payroll-input" id="<?= 'input_regular_time'.$employee_id; ?>" name="<?= 'input_regular_time'.$employee_id; ?>" step="0.1" onchange="calculateTotalMinutesAndPay(<?php echo $employee_id ?>);" value="<?= $minutesWorked; ?>" placeholder="Minutes worked..." />	
	</td>
	<td nowrap>	
		<input type="number" class="form-control payroll-input" id="<?= 'input_OT'.$employee_id; ?>" name="<?= 'input_OT'.$employee_id; ?>" step="0.1" onchange="calculateTotalMinutesAndPay(<?php echo $employee_id ?>);"  value="<?= $minutesOT; ?>" placeholder="Minutes worked..." />	
	</td>
	<td nowrap>
		<input type="number" class="form-control payroll-input" id="<?= 'total_time'.$employee_id; ?>"  name="<?= 'total_time'.$employee_id; ?>"	value="<?= $minutesOT; ?>" readonly/>	
	</td>

	<!-- EARNINGS -->
	<td nowrap><h5 class="mtb0"><input type="number" id="<?= 'input_basic'.$employee_id; ?>" name="<?= 'input_basic'.$employee_id; ?>" class="form-control payroll-input" step="0.1" value="<?= $basic_pay; ?>" placeholder="Minutes worked..." /></td>
	<td nowrap><h5 class="mtb0"><input type="number" id="<?= 'input_ot_pay'.$employee_id; ?>" name="<?= 'input_ot_pay'.$employee_id; ?>" class="form-control payroll-input" step="0.1" value="<?= $ot_pay; ?>" placeholder="Minutes worked..." /></td>
	<td nowrap>
		<h5 class="mtb0">
			<input type="number" id="<?= 'deminimis'.$employee_id; ?>" name="<?= 'deminimis'.$employee_id; ?>" class="form-control payroll-input" step="0.1" value="<?= $deminimis ?>" placeholder="Minutes worked..." />	
		</h5>
	</td>

	<!-- DEDUCTIONS -->
	<?php for($d = 0; $d < count($_SESSION['deductions']); $d++) { 
		if($_SESSION['deductions'][$d]['amount'] != 0)
			$deduction = $_SESSION['deductions'][$d]['amount'];
		else
			$deduction = ($employees[$i]['wage']*(8*30))*($_SESSION['deductions'][$d]['percent']/100);
		$name = preg_replace('/\s+/', '', $_SESSION['deductions'][$d]['name']);
		$deduction_id = $_SESSION['deductions'][$d]['id']; 
		$deduction_values = $deduction_id . ',' . $deduction . ',' . $employee_id;
	?>
	<td nowrap>
		<h5 class="mtb0">
			<input type="checkbox" class="<?= $name.'-checkbox' ?>" name="deduction[]" value="<?= $deduction_values ?>" onclick="checkDeduction(this);"/> <?php echo $deduction; ?>
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
		$bonus_id = $_SESSION['bonuses'][$b]['id']; 
		$bonus_values = $bonus_id . ',' . $bonus . ',' . $employee_id;
	?>
	<td nowrap>
		<h5 class="mtb0">
			<input type="checkbox" class="<?= $name.'-checkbox'; ?>" name="bonus[]" value="<?= $bonus_values; ?>" onclick="checkBonus(this);"/> <?php echo $bonus; ?>
		</h5>
	</td>
	<?php } ?>

	<!-- TOTALS -->
	<td nowrap><input type="number" id="<?= 'gross_pay'.$employee_id; ?>" name="<?= 'gross_pay'.$employee_id; ?>" class="form-control payroll-input" value="<?= $gross_pay ?>" readonly/></td>
	<td nowrap><input type="number" id="<?= 'net_pay'.$employee_id; ?>" name="<?= 'net_pay'.$employee_id; ?>" class="form-control payroll-input" value="<?= $gross_pay ?>" readonly/></td> 

</tr>
<?php } ?>
<script>$('#record_count').val(<?php echo $employee_count; ?>);</script>
<script>$('#all_ids').val("<?php echo implode(",",$employee_ids); ?>");</script>


