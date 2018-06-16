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
	function load_acquisition()
	{
		$("#main-content-container").load("./subpages/acquisition/load_acquisition.php");
	}

	load_acquisition();
</script>