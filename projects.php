<?php
    $title = "Projects | SBES";
?>
<?php include("includes/header.php");?>

<div class="content-wrapper">
    <section id="main-content-container" class="content container-fluid">
    </section>
</div>
<?php include("includes/footer.php");?>
<script type="text/javascript">
	function load_project()
	{
		$("#main-content-container").load("./subpages/projects/load_project.php");
	}

	function load_project_draft()
	{
		$("#main-content-container").load("./subpages/projects/load_project_draft.php");
	}

	function load_add_project()
	{
		$("#main-content-container").load("./subpages/projects/load_add_project.php");
	}
	function load_project_profile(project_id)
	{
		var project_id = encodeURI(project_id);
		$("#main-content-container").load("./subpages/projects/load_project_profile.php?project_id="+project_id)
	}

	//load_project_draft();
	load_add_project();
	//load_project();
	//load_project_profile(1);
</script>