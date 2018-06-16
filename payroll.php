<?php
    $title = "Payroll | SBES";
?>
<?php include("includes/header.php");?>

<div class="content-wrapper">
    <section id="main-content-container" class="content container-fluid">
    </section>
</div>
<?php include("includes/footer.php");?>
<script type="text/javascript">
	function load_payroll()
	{
		$("#main-content-container").load("./subpages/payroll/load_payroll.php");
	}
	function load_payroll_profile()
	{
		$("#main-content-container").load("./subpages/payroll/load_payroll_profile.php");
	}
	function load_add_payroll()
	{
		$("#main-content-container").load("./subpages/payroll/load_add_payroll.php");
	}

	//load_payroll();
	load_add_payroll();
</script>