<?php 
	include('../../includes/module.php');

	if(isset($_SESSION['tmp_project_id'])) unset($_SESSION['tmp_project_id']);
?>

<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4>REGISTER NEW PROJECT</h4>
	</div>
	<div class="col-xs-12 col-md-6">
		<a onclick="load_project();" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-chevron-left"></i> RETURN TO LIST&emsp;</h5>
		</a>
		<a onclick="add_project(1);" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-folder-open-o"></i> SAVE TO DRAFTS&emsp;|&emsp;</h5>
		</a>
		<a onclick="add_project(0);" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-plus-square-o"></i> CREATE PROJECT&emsp;|&emsp;</h5>
		</a>
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
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group">
								<label class="mt10">CONTRACT NUMBER</label>
								<input 
									type="text" 
									class="form-control pull-right" 
									placeholder="Enter contract number..."
									name="contract_number" 
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
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-12">
								<div class="sel-emp-action-col">
									<a onclick="removeSelectedRow(this);" href="javascript:void(0);" class="red-href">
										<small><i class="fa fa-times"></i></small>
									</a>
								</div>
								<div class="sel-emp-info-col">
									<label class="emp-data">
										DIGOMAUB, HARVEY CHARLES
									</label>
									<label class="emp-data">
										<small class="text-gray">(SOFTWARE DEVELOPER)</small>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<hr class="mt5 mb0"/>
						<label class="mt10">EMPLOYEES</label>
						<label class="mt10 pull-right">
							<a class="open-modal" data-load="employees" href="javascriot:void(0);">
								SELECT EMPLOYEES <small><i class="fa fa-plus"></i></small>
							</a>
						</label>
					</div>
					<div class="col-xs-12" id="selected_employee_cont">
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-12">
								<div class="sel-emp-action-col">
									<a onclick="removeSelectedRow(this);" href="javascript:void(0);" class="red-href">
										<small><i class="fa fa-times"></i></small>
									</a>
								</div>
								<div class="sel-emp-info-col">
									<label class="emp-data">
										DIGOMAUB, HARVEY CHARLES
									</label>
									<label class="emp-data">
										<small class="text-gray">(SOFTWARE DEVELOPER)</small>
									</label>
								</div>
							</div>
						</div>
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
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-12">
								<div class="sel-mat-action-col">
									<a onclick="removeSelectedRow(this);" href="javascript:void(0);" class="red-href">
										<small><i class="fa fa-times"></i></small>
									</a>
								</div>
								<div class="sel-mat-info-col">
									<label class="emp-data">
										Lumber (Narra) 2x2x10
									</label>
								</div>
								<div class="sel-mat-input-col">
									<label class="emp-data">
										<input 	type="number" 
												class="sel-mat-input align-right"
												placeholder="0"
												min="0"
										/>
									</label>
									<label class="emp-data align-right">
										<small class="text-gray">pcs</small>
									</label>
								</div>
							</div>
						</div>
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
								<input name="files[]" multiple="multiple" type="file" class="hidden" id="attach_files">
								UPLOAD FILES <i class="fa fa-image"></i>
							</form>
						</label>
					</div>
					<div class="col-xs-12" id="attached_files_cont">
						<!--<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-12">
								<div class="row selected-row trans100 pt5 pb5">
									<div class="col-xs-12">
										<div class="sel-emp-action-col">
											<a onclick="removeSelectedItem(this);" href="javascript:void(0);" class="red-href">
												<small><i class="fa fa-times"></i></small>
											</a>
										</div>
										<div class="sel-emp-info-col">
											<label class="emp-data">
												DIGOMAUB, HARVEY CHARLES
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>-->
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
  	var bar = $('.bar');

  	$('#upload_progress').hide();

	function removeSelectedRow(obj)
	{
		var id = $(obj).attr('id');
		var n  = $(obj).attr('name');

		if(n == "foremen")
			removeForeman(id);
		else if(n == "workers")
			removeEmployee(id);
		else
			removeItem(id);
		
		$(obj).closest(".selected-row").remove();
	}


	function removeSelectedItem(obj) {
		$(obj).closest(".selected-row").remove();
	}

	function removeForeman(element) {	
		var index = foremen.indexOf(element);
	    if (index > -1) {
		    foremen.splice(index, 1);
		    f_count--;
		}
	}

	function removeEmployee(element) {
		var index = workers.indexOf(element);
	    if (index > -1) {
		    workers.splice(index, 1);
		    w_count--;
		}
	}

	function removeItem(element) {
		var index = items.indexOf(element);
	    if (index > -1) {
		    items.splice(index, 1);
		    i_count--;
		}
	}

	$(".open-modal").click(function()
	{
		var load = "./subpages/projects/load_"+$(this).data('load')+"_selection.php";
		$("#selection_cont").load(load,function(){
			$("#myModal").modal('show');
		});
	});

	$('#project_form').ajaxForm({

	    /* set data type json */
	    dataType:'json',

	    beforeSend: function() {
	    },

	    /* complete call back */
	    complete: function(data) {
	      //$('#upload_progress').hide();
	      	if(data.responseJSON.success)
	      	{
	      		alert('Project successfully added.');
	      		load_project();
	      		//alert(data.responseJSON.items);
	      	}
	      	else
	      	{
	      		alert(data.responseJSON.error);
	      	}
	      
	    }

	 });

	$('#attachment_form').ajaxForm({

	    /* set data type json */
	    dataType:'json',

	    /* reset before submitting */
	    beforeSend: function() {
	      //status.fadeOut();
	      $('#upload_progress').show();

	      bar.width('0%');
	      percent.html('0%');
	    },

	    /* progress bar call back*/
	    uploadProgress: function(event, position, total, percentComplete) {
	      var pVel = percentComplete + '%';
	      bar.width(pVel);
	      percent.html(pVel);
	    },

	    /* complete call back */
	    complete: function(data) {
	      $('#upload_progress').hide();
	      alert(data.responseJSON.count);
	    }

	  });

	function add_project(number){
		var	foremen_ids	= foremen.join();
		var	worker_ids	= workers.join()
		var mat_ids 	= items.join();
		var mat_qty 	= "";
		var qtys 		= "";		
		var x 			= 0;
		
		$('input[name*="quantities"]').each(function ()
		{
			if(x != 0)
				mat_qty += ",";
			mat_qty+=$(this).val();
			x++;
		});

		$('#material_qtys').val(mat_qty);
		$('#project_materials').val(mat_ids);
		$('#employee_id').val(worker_ids);
		$('#foremen_id').val(foremen_ids);
		$('#is_draft').val(number);

		$('#project_form').submit();
	}

	$('#attach_files').change(function()
	{
        var files 	= $('#attach_files')[0].files;

        for (var i = 0; i < files.length; ++i) {
          	var n = encodeURIComponent(files[i].name);
          	
         	$('#attached_files_cont').append($('<div>a').load('/subpages/projects/load_attached_files.php?name='+n));

         	$('#attachment_form').submit();
        }
	});

    $('#search_daterange').daterangepicker();
</script>