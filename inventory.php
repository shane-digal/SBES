<?php
    $title = "Inventory | SBES";
?>
<?php include("includes/header.php");?>

<div class="content-wrapper">
    <section id="main-content-container" class="content container-fluid">
    </section>
</div>
<?php include("includes/footer.php");?>
<script type="text/javascript">
	function load_inventory()
	{
		$("#main-content-container").load("./subpages/inventory/load_inventory.php");
	}

	load_inventory();
	// load_employee_profile(1);
</script>