<?php
	$project_id = $_GET['project_id'];
?>
<div class="row">
	<div class="col-xs-12 col-md-6">
		<h4><i class="fa fa-circle-o legend-ongoing"></i> PROJECT PROFILE</h4>
	</div>
	<div class="col-xs-12 col-md-6">
		<a onclick="load_project();" href="javascript:void(0);">
			<h5 class="pull-right"><i class="fa fa-chevron-left"></i> RETURN TO LIST&emsp;</h5>
		</a>
		<a href="javascript:void(0);">
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
							<span class="emp-data">Sample Project 1</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label class="mt10">PROJECT DESCRIPTION</label>
							<span class="emp-data">
								Sample project description<br/>
								Sample project description<br/>
								Sample project description<br/>
								Sample project description<br/>
								Sample project description<br/>
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label class="mt10">PROJECT CLIENT</label>
							<span class="emp-data">Kliyinti Di Sampul</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group mb0">
							<label class="mt10">PROJECT DURATION:</label>
							<span class="emp-data">10/23/2017 - 10/23/2017</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="form-group">
							<label class="mt10">PROJECT EST. BUDGET:</label>
							<span class="emp-data"><b>&#8369;</b> 1,250,235.75</span>
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
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-12">
								<label class="emp-data">
									DIGOMAUB, HARVEY CHARLES
								</label>
								<label class="emp-data">
									<small class="text-gray">(SOFTWARE DEVELOPER)</small>
								</label>
							</div>
						</div>
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-12">
								<label class="emp-data">
									DIGOMAUB, HARVEY CHARLES
								</label>
								<label class="emp-data">
									<small class="text-gray">(SOFTWARE DEVELOPER)</small>
								</label>
							</div>
						</div>
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-12">
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
				<div class="row">
					<div class="col-xs-12">
						<hr class="mt5 mb0"/>
						<label class="mt10">EMPLOYEES</label>
					</div>
					<div class="col-xs-12" id="selected_employee_cont">
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-12">
								<label class="emp-data">
									DIGOMAUB, HARVEY CHARLES
								</label>
								<label class="emp-data">
									<small class="text-gray">(SOFTWARE DEVELOPER)</small>
								</label>
							</div>
						</div>
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-12">
								<label class="emp-data">
									DIGOMAUB, HARVEY CHARLES
								</label>
								<label class="emp-data">
									<small class="text-gray">(SOFTWARE DEVELOPER)</small>
								</label>
							</div>
						</div>
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-12">
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
				<div class="row">
					<div class="col-xs-12">
						<hr class="mt5 mb0"/>
						<label class="mt10">MATERIALS</label>
					</div>
					<div class="col-xs-12" id="selected_material_cont">
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-9">
								<label class="emp-data">
									Lumber (Narra) 2x2x10
								</label>
							</div>
							<div class="col-xs-3">
								<label class="emp-data align-right">
									13 <small class="text-gray">pcs</small>
								</label>
							</div>
						</div>
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-9">
								<label class="emp-data">
									Lumber (Narra) 2x2x10
								</label>
							</div>
							<div class="col-xs-3">
								<label class="emp-data align-right">
									13 <small class="text-gray">pcs</small>
								</label>
							</div>
						</div>
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-9">
								<label class="emp-data">
									Lumber (Narra) 2x2x10
								</label>
							</div>
							<div class="col-xs-3">
								<label class="emp-data align-right">
									13 <small class="text-gray">pcs</small>
								</label>
							</div>
						</div>
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-9">
								<label class="emp-data">
									Lumber (Narra) 2x2x10
								</label>
							</div>
							<div class="col-xs-3">
								<label class="emp-data align-right">
									13 <small class="text-gray">pcs</small>
								</label>
							</div>
						</div>
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-9">
								<label class="emp-data">
									Lumber (Narra) 2x2x10
								</label>
							</div>
							<div class="col-xs-3">
								<label class="emp-data align-right">
									13 <small class="text-gray">pcs</small>
								</label>
							</div>
						</div>
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-9">
								<label class="emp-data">
									Lumber (Narra) 2x2x10
								</label>
							</div>
							<div class="col-xs-3">
								<label class="emp-data align-right">
									13 <small class="text-gray">pcs</small>
								</label>
							</div>
						</div>
						<div class="row selected-row trans100 pt5 pb5">
							<div class="col-xs-9">
								<label class="emp-data">
									Lumber (Narra) 2x2x10
								</label>
							</div>
							<div class="col-xs-3">
								<label class="emp-data align-right">
									13 <small class="text-gray">pcs</small>
								</label>
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
					<div class="col-xs-12">
						<p class="text-info"><small>May contain contracts, awards, or notice to proceed images</small></p>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 plr10">
<?php
				    $dir = "./uploads/projects/";

    				foreach (glob($dir.$project_id."_*.{jpg,gif,png}") as $images) 
    				{
?>
					    <div class="col-xs-4 col-sm-3 col-md-4 pad5">
					        <div class="img img100 attachment-modal" 
					        	style="background:url('<?=$images?>');"
					        	data-path="<?=$images?>"
				        	>
					        </div>
					    </div>
<?php
    				}

				    $temporary_langsa = "./uploads/projects/1_123455.png";
?>
						
					    <div class="col-xs-4 col-sm-3 col-md-4 pad5">
					        <div class="img img100 attachment-modal" 
					        	style="background:url('<?=$temporary_langsa?>');"
								data-path="<?=$temporary_langsa?>"
				        	>
					        </div>
					    </div>
					    <div class="col-xs-4 col-sm-3 col-md-4 pad5">
					        <div class="img img100 attachment-modal" 
					        	style="background:url('<?=$temporary_langsa?>');"
								data-path="<?=$temporary_langsa?>"
				        	>
					        </div>
					    </div>
					    <div class="col-xs-4 col-sm-3 col-md-4 pad5">
					        <div class="img img100 attachment-modal" 
					        	style="background:url('<?=$temporary_langsa?>');"
								data-path="<?=$temporary_langsa?>"
				        	>
					        </div>
					    </div>
					    <div class="col-xs-4 col-sm-3 col-md-4 pad5">
					        <div class="img img100 attachment-modal" 
					        	style="background:url('<?=$temporary_langsa?>');"
								data-path="<?=$temporary_langsa?>"
				        	>
					        </div>
					    </div>
					    <div class="col-xs-4 col-sm-3 col-md-4 pad5">
					        <div class="img img100 attachment-modal" 
					        	style="background:url('<?=$temporary_langsa?>');"
								data-path="<?=$temporary_langsa?>"
				        	>
					        </div>
					    </div>
					    <div class="col-xs-4 col-sm-3 col-md-4 pad5">
					        <div class="img img100 attachment-modal" 
					        	style="background:url('<?=$temporary_langsa?>');"
								data-path="<?=$temporary_langsa?>"
				        	>
					        </div>
					    </div>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<label class="mt10 my-btn trans300 align-center">
							<input type="file" class="hidden" multiple>
							UPLOAD FILES <i class="fa fa-image"></i>
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
	function removeSelectedRow(obj)
	{
		$(obj).closest(".selected-row").remove();
	}

	$(".attachment-modal").click(function()
	{	
		var img_path = $(this).data("path");

		$("img#img-attachment-cont").attr("src",img_path);
		$("#myModal").modal('show');
	});

    $('#search_daterange').daterangepicker();
</script>