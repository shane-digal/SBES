$('.timepicker').timepicker({
  showInputs: false,
  timeFormat: 'HH:mm'
});

var finalEmpData = {
  firstname: empData.firstname,
  lastname: empData.lastname,
  middlename: empData.middlename,
  status: empData.employee_empstatus,
  wage: empData.employee_wage,
  imgurl: empData.imgpath,
  assignment: empData.project_id,
  remarks: empData.emp_remarks,
  position: empData.position_id,
  employee_id: empData.emp_id
};

$('.from-time').val('8:00 AM');
$('.to-time').val('5:00 PM');

function return_to_emp_profile() {
  load_employee_profile(empData.emp_id);
}

function submitUpdatedEmployee() {
  $('#submit-btn').click();
}

$('#form-new_employee').submit(function (e) {
  var values = $(this).serializeArray();
  var formData = new FormData($(this)[0]);
  var imgUrl = '';
  $.ajax({
      url: "http://localhost/sbes/apis/classes/employee_submit_img.php",
      method: "POST",
      data: formData,
      dataType: 'json',
      async: false,
      cache: false,
      contentType: false,
      processData: false,
      success: (response) => {
        imgUrl = response.url;
        e.preventDefault();
      },
      error: (a, b, c) => {
        e.preventDefault();
      }
    })
    .then(
      $.ajax({
        url: "http://localhost/sbes/api?q=UpdateEmployee",
        method: "POST",
        data: values,
        dataType: 'json',
        success: function (response) {
          updateImageRequest(imgUrl);
        }
      })
    );

  e.preventDefault();
});


function updateImageRequest(imgUrl) {
  if (imgUrl) {
    $.ajax({
      url: "http://localhost/sbes/api?q=UpdateEmployeeImage",
      method: "POST",
      data: {
        newImgUrl: imgUrl,
        oldImgUrl: finalEmpData.imgurl,
        empId: finalEmpData.employee_id
      },
      dataType: 'json',
      success: function (response) {
        alert('This employee is now updated.');
        load_employee_profile(finalEmpData.employee_id);
      }
    });
  } else {
    alert('This employee is now updated.');
    load_employee_profile(finalEmpData.employee_id);
  }
}

$.ajax({
  url: "http://localhost/sbes/api?q=GetBonuses",
  method: "POST",
  dataType: 'json',
  success: function (response) {
    $('.bonuses-list').empty();
    var cbox;
    $.each(response.values, function (key, v) {
      cbox = '<label class="label-data">' +
        '<input type="checkbox" name="bonus[]" value="' + v.bonus_id + '" /> ' + v.bonus_name +
        '</label>';
      $('.bonuses-list').append(cbox);
    });
    $.each(empBonusData.values, function (key, val) {
      $('input[name="bonus[]"][value="' + val.bonus_id + '"]').prop('checked', true);
    });
  }
});

$.ajax({
  url: "http://localhost/sbes/api?q=GetDeductions",
  method: "POST",
  dataType: 'json',
  success: function (response) {
    var cbox;
    $.each(response.values, function (key, v) {
      cbox = '<label class="label-data">' +
        '<input type="checkbox" name="deduction[]" value="' + v.deduction_id + '" /> ' + v.deduction_name +
        '</label>';

      $('.deduction-list').append(cbox);
    });
    $.each(empDeductionData.values, function (key, val) {
      $('input[name="deduction[]"][value="' + val.deduction_id + '"]').prop('checked', true);
    });

  }
});

$.ajax({
  url: "http://localhost/sbes/api?q=GetApprovedProjects",
  method: "POST",
  dataType: 'json',
  success: function (response) {
    var cbox;
    $.each(response.values, function (key, v) {
      cbox = '<option value="' + v.project_id + '">' + v.project_name + '</option>';
      $('#assignment').append(cbox);
    });
    $('#assignment').val(finalEmpData.assignment).change();
  }
});

$.ajax({
  url: "http://localhost/sbes/api?q=GetAllPositions",
  method: "POST",
  dataType: 'json',
  success: function (response) {
    var cbox;
    $.each(response.values, function (key, v) {
      cbox = '<option value="' + v.position_id + '">' + v.position_name + '</option>';
      $('#position').append(cbox);
    });
    $('#position').val(finalEmpData.position).change();
  }
});

$('.my-cb').click(function () {
  var idx = $(this).data('index');
  var isDisabled = !$(this).prop('checked');
  $($('.from-time')[idx]).prop('disabled', isDisabled);
  $($('.to-time')[idx]).prop('disabled', isDisabled);
});

$('.timepicker').change(function () {
});

$("#employee_avatar").change(function () {
  readURL(this, '#employee_avatar_display');
  showCloseIcon();
});

function showCloseIcon(override = false, hasImage = false) {
  if (!override) {
    $("#employee_avatar").val() ?
      $("#employee_avatar_remove_cont").html(
        "<button onclick='removeURL();' type='button' class='img-remove-btn enTrans'>" +
        "<i class='fa fa-times'></i>" +
        "</button>"
      ) : removeURL('featured');
  } else {
    if (hasImage) {
      $("#employee_avatar_remove_cont").html(
        "<button onclick='removeURL();' type='button' class='img-remove-btn enTrans'>" +
        "<i class='fa fa-times'></i>" +
        "</button>");
    }
  }

}

function readURL(input, targetObj) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $(targetObj).css('background', 'url("' + e.target.result + '")');
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function removeURL(targetObj) {
  var oldPath = "https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png";

  $("#employee_avatar").val("");
  $("#employee_avatar_remove_cont").html("");
  $("#employee_avatar_display").css('background', 'url("' + oldPath + '") #676767');
}

var oldImage = '';

function load_employee_details() {
  $('#for-hidden-data').html('');
  $.each(finalEmpData, function (key, val) {
    $('input[name="' + key + '"]').val(val);
    $('select[name="' + key + '"]').val(val).change();
    if (key == 'position') {
      $('#position').val(val).change();
    }

    $('textarea[name="' + key + '"]').val(val);
    if (key == 'remarks' && val == 'NONE') {
      $('textarea[name="' + key + '"]').val('');
    }

    if (key === 'employee_id') {
      $('#for-hidden-data').append(`<input type='hidden' name='${key}' value='${val}'>`);
    }

    if (key === 'imgurl') {
      $('#employee_avatar_display').css('background', `url('${val}') #676767`);
      const hasImage = (val === 'BLANK' || val == null);
      showCloseIcon(true, !hasImage);
    }


  });

  $.each(empScheduleData.values, function (key, val) {
    $('input[name="schedule_days[]"][value="' + val.empschedule_day + '"').click();
    $('.' + val.empschedule_day + '.from-time').val(val.empschedule_in);
    $('.' + val.empschedule_day + '.to-time').val(val.empschedule_out);
  });
}
load_employee_details();
