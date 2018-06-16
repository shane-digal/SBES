<?php
    $title = "Employees | SBES";
?>
<?php include("includes/header.php");?>

<div class="content-wrapper">
    <section id="main-content-container" class="content container-fluid">
    </section>
</div>
<?php include("includes/footer.php");?>
<script type="text/javascript">
	function load_employee()
	{
		$("#main-content-container").load("./subpages/employees/load_employee.php");
	}
	function load_add_employee()
	{
		$("#main-content-container").load("./subpages/employees/load_add_employee.php");
	}
	function load_employee_profile(employee_id)
	{
		$("#main-content-container").load("./subpages/employees/load_employee_profile.php?employee_id="+employee_id);
	}

	load_employee();
	// load_employee_profile(1);
</script>