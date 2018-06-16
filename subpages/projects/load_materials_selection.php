<div class="row">
	<div class="col-xs-12">
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		<h4 class="modal-title text-gray"><i class="fa fa-list-ol"></i> SELECT MATERIALS</h4>
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
		<button class="my-btn trans300" onclick="javascript:add_selected()">
			<i class="fa fa-user-plus"></i>&emsp;ADD SELECTED EMPLOYEES
		</button>
	</div>
</div>

<script type="text/javascript">
	function load_materials_selection_list()
	{
		if(i_count != 0)
		{
			var item_ids 	= encodeURIComponent(items.join());

			$("#selection_list_cont").load("./subpages/projects/load_materials_selection_list.php?ids=" + item_ids);
		}
		else
		{
			$("#selection_list_cont").load("./subpages/projects/load_materials_selection_list.php");	
		}
	}

	function add_selected(){
		var item = $('[name="checkboxes[]"]').length;

		for(var a = 0; a < item; a++)
		{
			if($('[name="checkboxes[]"]')[a].checked)
			{
				var id 		= $('[name="checkboxes[]"]')[a].id;
				var name 	= encodeURIComponent($('#name' + id).text());
				var quantity= $('#quantity' + id).val();
				var metric 	= $('#metric' + id).text();
				var list 	= "items";
				items[i_count++] = id;

				$('#selected_material_cont').append($('<div>').load('./subpages/projects/load_selected_material.php?id=' + id + '&name=' + name + '&quantity=' + quantity + "&metric=" + metric + "&list=" + list));
			}
		}
		$('#myModal').modal('toggle');
	}

	$('#search_key').keyup(function(){
		if($(this).val().trim() != "")
		{
			var key = $(this).val().trim();

			$("#selection_list_cont").load("./subpages/projects/load_materials_selection_list.php?key="+key);
		}
		else
		load_employees_selection_list();
	});

	load_materials_selection_list();
</script>