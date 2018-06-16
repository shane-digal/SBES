<?php
	include('includes/module.php');
	
	$title = "Payroll | SBES";
	
	$getSettings = $con->prepare(
		"SELECT * FROM lib_settings LIMIT 1");
	$getSettings->execute();
	$getSettings->store_result();
	$getSettings->bind_result(
		$overtime_rate,
		$deminimis_cap,
		$minutes_allowance);
	$getSettings->fetch();
	$getSettings->close();

	$_SESSION['overtime_rate'] = $overtime_rate;
	$_SESSION['deminimis_cap'] = $deminimis_cap;
	$_SESSION['minutes_allowance'] = $minutes_allowance;
?>
<?php include("includes/header.php");?>

<div class="content-wrapper">
    <section id="main-content-container" class="content container-fluid">
    </section>
</div>
<?php include("includes/footer.php");?>
<script type="text/javascript">
	function load_payroll() {
		$("#main-content-container").load("./subpages/payroll/load_payroll.php");
	}
	function load_payroll_profile(id) {
		$("#main-content-container").load("./subpages/payroll/load_payroll_profile.php?payroll_id="+id);
	}
	function load_add_payroll() {
		$("#main-content-container").load("./subpages/payroll/load_add_payroll.php");
	}
	function load_payroll_drafts() {
		$("#main-content-container").load("./subpages/payroll/load_payroll_drafts.php");
	}
	function load_edit_payroll(id) {
		$("#main-content-container").load("./subpages/payroll/load_edit_payroll.php?payroll_id="+id);
	}

	//load_edit_payroll(22);
	//load_payroll_profile(1);
	load_payroll();
</script>