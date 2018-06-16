<?php 
	include('../../includes/module.php');

	$edit_or_draft 			= 0; // 1 = edit, 2 = draft

	$project_start			= "2017-12-12";
	$project_end 			= "2017-12-12";
	$project_id 			= 0;
	$create 				= "CREATE";

	if(isset($_GET['project_id']))
	{ 
		//unset($_SESSION['tmp_project_id']);
		//unset($_GET['new']);
		$edit_or_draft 		= $_GET['update_draft'];
		$project_id 		= $_GET['project_id'];
		$create 			= ($edit_or_draft != 1) ? "SAVE" : "UPDATE";
		$table 				= ($edit_or_draft != 1) ? "rec_project_drafts" : "rec_projects";
		
		$get_project_details= $con->prepare("SELECT project_contractnum,
													project_name,
													project_description,
													project_client,
													project_start,
													project_end,
													project_estbudget
											FROM 	$table
											WHERE 	project_id = ?");

		$get_project_details->bind_param("i", $project_id);
		$get_project_details->execute();
		$get_project_details->bind_result(	$project_contractnum,
											$project_name,
											$project_description,
											$project_client,
											$project_start,
											$project_end,
											$project_estbudget);
		$get_project_details->fetch();
	}
?>
<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4>REGISTER NEW PROJECT</h4>
	</div>
	<div class="col-xs-12 col-md-6">
		<a onclick="load_project();" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-chevron-left"></i> RETURN TO LIST&emsp;</h5>
		</a>
		<?php if($edit_or_draft == 0) { ?>
		<a onclick="add_project(1);" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-folder-open-o"></i> SAVE TO DRAFTS&emsp;|&emsp;</h5>
		</a>
		<?php } if($edit_or_draft != 2) { ?>
		<a onclick="add_project(0);" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-plus-square-o"></i> <?php echo $create; ?> PROJECT&emsp;|&emsp;</h5>
		</a>
		<?php } else { ?>
		<a onclick="add_project(2);" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-plus-square-o"></i> <?php echo $create; ?> PROJECT&emsp;|&emsp;</h5>
		</a>
		<?php } ?>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 plr10">
		<div class="col-xs-12 col-md-4 plr5">
			<div class="my-container mt10">
				<form id="project_form" action="../../submits/projects/add_project.php" method="post">
					<div class="row">
						<div class="col-xs-12">
							<h4 class="mt0 mb0"><small><i class="fa fa-briefcase"></i> PROJECT DETAILS</small></h4>
						</div>
					</div>
					<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label class="mt10">CONTRACT NUMBER</label>
								<input 
									type="text" 
									class="form-control pull-right" 
									placeholder="Enter contract number..."
									name="contract_number" 
									value="<?php if(isset($project_contractnum)) echo $project_contractnum; ?>" 
								>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label class="mt10">PROJECT NAME</label>
								<input 
									type="text" 
									class="form-control pull-right" 
									placeholder="Enter project name..."
									name="project_name" 
									value="<?php if(isset($project_name)) echo $project_name; ?>" 
								>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label class="mt10">PROJECT DESCRIPTION</label>
								<textarea
									class="form-control pull-right" 
									placeholder="Enter project name..."
									rows="5"
									name="project_description">
<?php if(isset($project_description)) echo $project_description; ?>

								</textarea> 
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label class="mt10">PROJECT CLIENT</label>
								<input 
									type="text" 
									class="form-control pull-right" 
									placeholder="Enter client name..."
									name="client_name" 
									value="<?php if(isset($project_client)) echo $project_client; ?>" 
								/>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group mb0">
								<label class="mt10">PROJECT DURATION:</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="fa fa-calendar"></i>
									</div>
									<input 
										type="text" 
										class="form-control pull-right" 
										id="search_daterange"
										name="project_duration" 
									>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label class="mt10">PROJECT EST. BUDGET:</label>
								<div class="input-group">
									<div class="input-group-addon">
										<b>&#8369;</b>
									</div>
									<input 
										type="number" 
										class="form-control pull-right align-right"
										placeholder="0.00"
										min="0"
										step="0.1" 
										name="estimated_budget" 
										value="<?php if(isset($project_estbudget)) echo $project_estbudget; ?>" 
									>
								</div>
							</div>
						</div>
					</div>
					<input type='hidden' name="foremen_id" id="foremen_id" value="0" />
					<input type='hidden' name="employee_id" id="employee_id" value="0" />
					<input type='hidden' name="project_materials" id="project_materials" value="0" />
					<input type='hidden' name="material_qtys" id="material_qtys" value="0" />
					<input type='hidden' name="is_draft" id="is_draft" value="0" />
				</form>
			</div>
		</div>
		<div class="col-xs-12 col-md-4 plr5">
			<div class="my-container mt10">
				<div class="row">
					<div class="col-xs-12">
						<h4 class="mt0 mb0"><small><i class="fa fa-users"></i> EMPLOYEES</small></h4>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<label class="mt10">FOREMEN</label>
						<label class="mt10 pull-right">
							<a class="open-modal" data-load="foremen" href="javascriot:void(0);">
								SELECT FOREMEN <small><i class="fa fa-plus"></i></small>
							</a>
						</label>
					</div>
					<div class="col-xs-12" id="selected_foremen_cont">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<hr class="mt5 mb0"/>
						<label class="mt10">EMPLOYEES</label>
						<label class="mt10 pull-right">
							<a class="open-modal" data-load="employees" href="javascript:void(0);">
								SELECT EMPLOYEES <small><i class="fa fa-plus"></i></small>
							</a>
						</label>
					</div>
					<div class="col-xs-12" id="selected_employee_cont">
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<hr class="mt5 mb0"/>
						<label class="mt10">MATERIALS</label>
						<label class="mt10 pull-right">
							<a class="open-modal" data-load="materials" href="javascriot:void(0);">
								SELECT MATERIALS <small><i class="fa fa-plus"></i></small>
							</a>
						</label>
					</div>
					<div class="col-xs-12" id="selected_material_cont">
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-4 plr5">
			<div class="my-container mt10">
				<div class="row">
					<div class="col-xs-12">
						<h4 class="mt0 mb0"><small><i class="fa fa-file"></i> ATTACHMENTS</small></h4>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<label class="mt10 my-btn trans300">
							<form id="attachment_form" action="../submits/projects/upload_attachment.php" method="post" enctype="multipart/form-data">
								<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
								<input name="files[]" multiple="multiple" type="file" class="hidden" id="attach_files">
								UPLOAD FILES <i class="fa fa-image"></i>
							</form>
						</label>
					</div>
					<div class="col-xs-12" id="attached_files_cont">
					</div>
					<div class="col-xs-12">
						<div id="upload_progress">
						    <div class="bar">
						    <div class="percent">0%</div >
						</div >
					  </div>
					</div>
					<div class="col-xs-12">
						<p class="text-info"><small>You may upload contracts, awards, or notice to proceed images</small></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content br13">
			<div class="modal-body plr15" id="selection_cont">
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var foremen = Array();
	var workers = Array();
	var items 	= Array();

	var f_count = 0;
	var w_count = 0;
	var i_count = 0;

  	var percent = $('.percent');
  	var bar 	= $('.bar');

  	var prj_id 	= 0;

  	var edit_or_draft = <?php echo json_encode($edit_or_draft); ?>;

	if(edit_or_draft != 0)
	{
		var start_date 	= "<?php echo date_format(date_create($project_start), 'm/d/Y'); ?>";
		var end_date 	= "<?php echo date_format(date_create($project_end), 'm/d/Y'); ?>";
		prj_id 			= <?php echo json_encode($project_id); ?>;

		$('#search_daterange').daterangepicker(
		{		
		    startDate: start_date,
		    endDate: end_date
		});

		$('#selected_foremen_cont').append($('<div>').load('./subpages/projects/load_foremen.php?id='+prj_id+'&edit='+edit_or_draft));
		$('#selected_employee_cont').append($('<div>').load('./subpages/projects/load_employees.php?id='+prj_id+'&edit='+edit_or_draft));
		$('#selected_material_cont').append($('<div>').load('./subpages/projects/load_materials.php?id='+prj_id+'&edit='+edit_or_draft));
	}
	else
	{
		$('#search_daterange').daterangepicker();
	}
    
</script>
<script type="text/javascript" src="subpages/projects/js/add_project_functions.js"></script>