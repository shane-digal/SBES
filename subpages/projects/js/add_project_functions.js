$('#upload_progress').hide();

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
      	if(data.responseJSON.success) {
      		var action = (edit_or_draft==1) ? 'updated.': 'added.';
  			
  			alert('Project successfully '+action);

      		load_project();
      		//alert(data.responseJSON.items);
      	}
      	else {
      		alert(data.responseJSON.error);
      	}
    }
});

$('#attachment_form').ajaxForm( {

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
      //alert(data.responseJSON.count);
    }
});

$('#attach_files').change(function()
{
    var files 	= $('#attach_files')[0].files;

    for (var i = 0; i < files.length; ++i) {
      	var n = encodeURIComponent(files[i].name);
		
     	$('#attachment_form').submit();

     	$('#attached_files_cont').append($('<div>a').load('/subpages/projects/load_attached_files.php?name='+n));

    }
});

$('#attached_files_cont').append($('<div>a').load('/subpages/projects/load_already_attached_files.php?id='+prj_id+'&edit='+edit_or_draft));

function removeSelectedItem(obj) {
	var ans = confirm("Remove uploaded file?");

	if(ans) {
		var filename	= $(obj).attr('name');

		$(obj).closest(".selected-row").remove();
		deleteAttachment(filename);
	}
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

function addForeman() {
	var id 		= $('[name="checkboxes[]"]')[a].id;
	var name 	= encodeURIComponent($('#name' + id).text());
	var position= $('#position' + id).val();
	var list 	= "foremen";
	foremen[f_count++] = id;

	$('#selected_foremen_cont').append($('<div>').load('./subpages/projects/load_selected_employees.php?id=' + id + '&name=' + name + '&position=' + position + "&list=" + list));
}

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
	alert(id);
}

function add_project(number) {
	var	foremen_ids	= foremen.join();
	var	worker_ids	= workers.join()
	var mat_ids 	= items.join();
	var mat_qty 	= "";
	var qtys 		= "";		
	var x 			= 0;
	
	$('input[name*="quantities"]').each(function () {
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
 
function deleteAttachment(name)
{
	$.ajax({
		url: '../../submits/projects/delete_attachment.php',
        type: 'POST',
        data: {filename: name},
        datatype: 'json',
        encode : true
	})
	.done(function(data) {
		data = jQuery.parseJSON(data);
		
		if(!data.success)
		{
			alert("An error occured when deleting the file.");
		}
	});
}