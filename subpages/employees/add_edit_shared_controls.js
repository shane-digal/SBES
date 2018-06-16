
$.ajax({
  url : "http://localhost/sbes/api?q=GetBonuses",
  method: "POST",
  dataType: 'json',
  success: function(response){
    $('.bonuses-list').empty();
    var cbox;
    $.each(response.values, function(key, v){
      cbox = 	'<label class="label-data">' +
          '<input type="checkbox" name="bonus[]" value="'+v.bonus_id+'"  checked/> ' +  v.bonus_name +
          '</label>';
      $('.bonuses-list').append(cbox);
    });
  }
});

$.ajax({
  url : "http://localhost/sbes/api?q=GetDeductions",
  method: "POST",
  dataType: 'json',
  success: function(response){
    var cbox;
    $.each(response.values, function(key, v){
    cbox = 	'<label class="label-data">' +
        '<input type="checkbox" name="deduction[]" value="'+v.deduction_id+'"  checked/> ' +  v.deduction_name +
        '</label>';

    $('.deduction-list').append(cbox);
    });
  }
});

$.ajax({
  url : "http://localhost/sbes/api?q=GetApprovedProjects",
  method: "POST",
  dataType: 'json',
  success: function(response){
    var cbox;
    $.each(response.values, function(key, v){
    cbox = 	'<option value="'+v.project_id+'">' + v.project_name + '</option>';
    $('#assignment').append(cbox);
    });
  }
});

$.ajax({
  url : "http://localhost/sbes/api?q=GetAllPositions",
  method: "POST",
  dataType: 'json',
  success: function(response){
    var cbox;
    $.each(response.values, function(key, v){
    cbox = 	'<option value="'+v.position_id+'">' + v.position_name + '</option>';
    $('#position').append(cbox);
    });
  }
});

$('.my-cb').click(function(){
  var idx = $(this).data('index');
  var isDisabled = !$(this).prop('checked');
  $($('.from-time')[idx]).prop('disabled', isDisabled);
  $($('.to-time')[idx]).prop('disabled', isDisabled);
});

$('.timepicker').change(function(){
});

$("#employee_avatar").change(function(){
  readURL(this,'#employee_avatar_display');
  $(this).val() ?
    $("#employee_avatar_remove_cont").html(
      "<button onclick='removeURL();' type='button' class='img-remove-btn enTrans'>"+
        "<i class='fa fa-times'></i>"+
      "</button>"
    ) : removeURL('featured');
});

function readURL(input,targetObj) {

    if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function (e) {
				$(targetObj).css('background', 'url("' + e.target.result + '")');
			}
			const varsamp = reader.readAsDataURL(input.files[0]);
    }
}

function removeURL(targetObj){
  var oldPath = "https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png";

  $("#employee_avatar").val("");
  $("#employee_avatar_remove_cont").html("");
  $("#employee_avatar_display").css('background', 'url("'+oldPath+'") #676767');
}