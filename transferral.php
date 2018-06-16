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
	function load_transferral()
	{
		$("#main-content-container").load("./subpages/transferral/load_transferral.php");
	}

	load_transferral();
</script>