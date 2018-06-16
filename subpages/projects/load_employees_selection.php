<div class="row">
	<div class="col-xs-12">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title text-gray"><i class="fa fa-users"></i> SELECT EMPLOYEES</h4>
	</div>
</div>
<div class="row mt20">
	<div class="col-xs-12">
		<div class="form-group">
			<div class="input-group">
				<input 
					type="text" 
					class="form-control pull-right" 
					placeholder="Search employee by name..."
					id="search_key"
				>
				<div class="input-group-addon">
					<i class="fa fa-search"></i>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xs-12" id="selection_list_cont">


	</div>
</div>
<div class="row mt20">
	<div class="col-xs-12">
		<button class="my-btn trans300" onclick="javascript:add_selected();">
			<i class="fa fa-user-plus"></i>&emsp;ADD SELECTED EMPLOYEES
		</button>
	</div>
</div>

<script type="text/javascript">
	function load_employees_selection_list()
	{
		if(w_count != 0)
		{
			var worker_ids 	= encodeURIComponent(workers.join());

			$("#selection_list_cont").load("./subpages/projects/load_employees_selection_list.php?ids=" + worker_ids);
		}
		else
		{
			$("#selection_list_cont").load("./subpages/projects/load_employees_selection_list.php");	
		}
	}

	function add_selected(){
		var items = $('[name="checkboxes[]"]').length;

		for(var a = 0; a < items; a++)
		{
			if($('[name="checkboxes[]"]')[a].checked)
			{
				var id 		= $('[name="checkboxes[]"]')[a].id;
				var name 	= encodeURIComponent($('#name' + id).text());
				var position= $('#position' + id).val();
				var list 	= "workers";
				workers[w_count++] = id;

				$('#selected_employee_cont').append($('<div>').load('./subpages/projects/load_selected_employees.php?id=' + id + '&name=' + name + '&position=' + position + "&list=" + list));
			}
		}
		$('#myModal').modal('toggle');
	}

	$('#search_key').keyup(function(){
		if($(this).val().trim() != "")
		{
			var key = $(this).val().trim();

			$("#selection_list_cont").load("./subpages/projects/load_employees_selection_list.php?key="+key);
		}
		else
		load_employees_selection_list();
	});
	load_employees_selection_list();
</script>