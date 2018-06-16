<?php
	include('../../includes/module.php');
	$project_id = $_GET['project_id'];

	$getDetails = $con->prepare("SELECT project_id,
								project_name,
								project_description,
								project_client,
								project_start,
								project_end,
								project_estbudget
								FROM rec_projects
								WHERE project_id = ?");
	$getDetails	->bind_param("i", $project_id);
	$getDetails ->execute();
	$getDetails ->bind_result($project_id,
								$project_name,
								$project_description,
								$project_client,
								$project_start,
								$project_end,
								$project_estbudget);
	$getDetails ->fetch();
	$getDetails ->close();
?>
<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4><i class="fa fa-circle-o legend-ongoing"></i> PROJECT PROFILE</h4>
	</div>
	<div class="col-xs-12 col-md-6">
		<a onclick="load_project();" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-chevron-left"></i> RETURN TO LIST&emsp;</h5>
		</a>
		<a onclick="update_project(<?php echo $project_id.',1'; ?>)"	href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-pencil"></i> UPDATE PROJECT&emsp;|&emsp;</h5>
		</a>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 plr10">
		<div class="col-xs-12 col-md-4 plr5">
			<div class="my-container mt10">
				<div class="row">
					<div class="col-xs-12">
						<h4 class="mt0 mb0"><small><i class="fa fa-briefcase"></i> PROJECT DETAILS</small></h4>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label class="mt10">PROJECT NAME</label>
							<span class="emp-data"><?php echo $project_name; ?></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label class="mt10">PROJECT DESCRIPTION</label>
							<span class="emp-data">
								<?php echo $project_description; ?>
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label class="mt10">PROJECT CLIENT</label>
							<span class="emp-data"><?php echo $project_client; ?></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group mb0">
							<label class="mt10">PROJECT DURATION:</label>
							<span class="emp-data"><?php echo displayDuration($project_start, $project_end); ?></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label class="mt10">PROJECT EST. BUDGET:</label>
							<span class="emp-data"><b>&#8369;</b> <?php echo displayMoney($project_estbudget); ?></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label class="mt10">PROJECT TOTAL EXPENSES:</label>
							<span class="emp-data"><b>&#8369;</b> 1,250,235.75</span>
						</div>
					</div>
				</div>
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
					</div>
					<div class="col-xs-12" id="selected_foremen_cont">
						<?php 
							$position 	= 1;
							$getForemen = $con->prepare("SELECT rec_employees.employee_fname,
														rec_employees.employee_mname,
														rec_employees.employee_lname,
														lib_employee_positions.position_name
														FROM rec_employees 
														INNER JOIN lib_employee_positions
														ON rec_employees.position_id = lib_employee_positions.position_id
														WHERE rec_employees.project_id = ?
														AND rec_employees.position_id = ?");
							$getForemen ->bind_param("ii", $project_id, $position);
							$getForemen ->execute();
							$getForemen ->bind_result($employee_fname,
														$employee_mname,
														$employee_lname,
														$position_name);

							while($getForemen->fetch()){
						?>
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-12">
								<label class="emp-data">
									<?php printf("%s, %s %s", $employee_lname, $employee_fname, $employee_mname); ?>
								</label>
								<label class="emp-data">
									<small class="text-gray"><?php printf("(%s)", $position_name); ?></small>
								</label>
							</div>
						</div>
						<?php } $getForemen->close(); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<hr class="mt5 mb0"/>
						<label class="mt10">EMPLOYEES</label>
					</div>
					<div class="col-xs-12" id="selected_employee_cont">
						<?php 
							$position 	= 2;
							$getEmps	= $con->prepare("SELECT rec_employees.employee_id,
														rec_employees.employee_fname,
														rec_employees.employee_mname,
														rec_employees.employee_lname,
														lib_employee_positions.position_name
														FROM rec_employees 
														INNER JOIN lib_employee_positions
														ON rec_employees.position_id = lib_employee_positions.position_id
														WHERE rec_employees.project_id = ?
														AND rec_employees.position_id = ?");
							$getEmps 	->bind_param("ii", $project_id, $position);
							$getEmps	->execute();
							$getEmps 	->bind_result($employee_id,
														$employee_fname,
														$employee_mname,
														$employee_lname,
														$position_name);

							while($getEmps->fetch()){

							/*$foremen[$f_index]['id']		= $employee_id;
							$foremen[$f_index]['name']		= $employee_lname.', '.$employee_fname.' '.$employee_mname;
							$foremen[$f_index]['position']	= $position_name;
							$f_index++;*/
						?>
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-12">
								<label class="emp-data">
									<?php printf("%s, %s %s", $employee_lname, $employee_fname, $employee_mname); ?>
								</label>
								<label class="emp-data">
									<small class="text-gray"><?php printf("(%s)", $position_name); ?></small>
								</label>
							</div>
						</div>
						<?php } $getEmps->close(); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<hr class="mt5 mb0"/>
						<label class="mt10">MATERIALS</label>
					</div>
					<div class="col-xs-12" id="selected_material_cont">
						<?php 
							$position 	= 2;
							$getMats	= $con->prepare("SELECT rec_project_material_plans.projectmatplan_qty,
														lib_materials.material_name,
														lib_materials.material_metric
														FROM rec_project_material_plans 
														INNER JOIN lib_materials
														ON rec_project_material_plans.material_id 
														= lib_materials.material_id
														WHERE rec_project_material_plans.project_id = ?");
							$getMats 	->bind_param("i", $project_id);
							$getMats	->execute();
							$getMats 	->bind_result($projectmatplan_qty,
														$material_name,
														$material_metric);

							while($getMats->fetch()){
						?>
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-9">
								<label class="emp-data">
									<?php echo $material_name; ?>
								</label>
							</div>
							<div class="col-xs-3">
								<label class="emp-data align-right">
									<?php echo $projectmatplan_qty; ?> 
									<small class="text-gray"><?php echo $material_metric; ?></small>
								</label>
							</div>
						</div>
						<?php } $getMats->close(); ?>
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
					<div class="col-xs-12">
						<p class="text-info"><small>May contain contracts, awards, or notice to proceed images</small></p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 plr10">
					<?php
				    	$dir = "../../uploads/projects/".$project_id."/";
				    
	    				foreach (glob($dir."*.*") as $files) 
	    				{
	    					//fa-file-text-o, fa-file-archive-o, fa-file-o, fa-file-image-o
	    					$del = $project_id.','.displayFilename($dir,$files)
					?>		
						<div class="col-xs-4 col-sm-6 col-md-4 plr5 mt5 attached-file">
							<a href="<?php echo $files; ?>" download>
								<span class="emp-file-attachments">
									<i class="fa fa-file-text-o file-type"></i>
									<i class="fa fa-trash file-remover" onclick="removeSelectedItem('<?php echo $del; ?>');"></i>
								</span>
								<span class="emp-file-attachment-text">
									<?php echo displayFilename($dir,$files); ?>
								</span>
							</a>
						</div>
					<?php
    					}
					?>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<label class="mt10 my-btn trans300 align-center">
							<form id="attachment_form" action="../submits/projects/upload_attachment.php" method="post" enctype="multipart/form-data">
								<input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
								<input name="files[]" multiple="multiple" type="file" class="hidden" id="attach_files">
								UPLOAD FILES <i class="fa fa-image"></i>
							</form>
						</label>
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
				<div class="row">
					<div class="col-xs-12">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h5 class="modal-title text-gray"><i class="fa fa-file"></i> VIEW ATTACHMENT</h5>
					</div>
				</div>
				<div class="row mt20">
					<div class="col-xs-12">
						<img style="width: 100%;" src="" id="img-attachment-cont"/>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#attach_files').change(function()
	{
	    var files 	= $('#attach_files')[0].files;

	    for (var i = 0; i < files.length; ++i) {
	      	var n = encodeURIComponent(files[i].name);
			
	     	$('#attachment_form').submit();

	     	//$('#attached_files_cont').append($('<div>a').load('/subpages/projects/load_attached_files.php?name='+n));

	    }
	});

	$('#attachment_form').ajaxForm({

	    /* set data type json */
	    dataType:'json',

	    /* reset before submitting */
	    beforeSend: function() {
	      //status.fadeOut();
	      //$('#upload_progress').show();

	      //bar.width('0%');
	      //percent.html('0%');
	    },

	    /* progress bar call back*/
	    uploadProgress: function(event, position, total, percentComplete) {
	      //var pVel = percentComplete + '%';
	      //bar.width(pVel);
	      //percent.html(pVel);
	    },

	    /* complete call back */
	    complete: function(data) {
	      //$('#upload_progress').hide();
	      //alert(data.responseJSON.count);
	    }

	});

	function removeSelectedItem(obj) {
		var ans = confirm("Remove uploaded file?");

		if(ans) {
			$(obj).closest(".attached-file").remove();
			deleteAttachment(obj);
		}
	}

	function deleteAttachment(obj) {
		var file	= obj.split(",");

		$.ajax({
			url: '../../submits/projects/delete_attachment.php',
	        type: 'POST',
	        data: {project_id: file[0], filename: file[1]},
	        datatype: 'json',
	        encode : true
		})
		.done(function(data) {
			data = jQuery.parseJSON(data);
			
			if(!data.success)
			{
				alert("An error occured when deleting the file.");
			}
			else
			{
				alert("Successfully deleted file.");
			}
		});
	}

	$(".attachment-modal").click(function() {	
		var img_path = $(this).data("path");

		$("img#img-attachment-cont").attr("src",img_path);
		$("#myModal").modal('show');
	});

    $('#search_daterange').daterangepicker();
</script>