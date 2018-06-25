$('.timepicker').timepicker({
  showInputs: false,
  timeFormat: 'HH:mm'
});

$('.from-time').val('8:00 AM');
$('.to-time').val('5:00 PM');

function addAdditionalDetails(emp_id, val){
  $.ajax({
    url : "http://localhost/sbes/api?q=InsertDeductions&emp_id="+emp_id,
    method: "POST",
    data: val,
    dataType: 'json'
  });
  $.ajax({
    url : "http://localhost/sbes/api?q=InsertBonuses&emp_id="+emp_id,
    method: "POST",
    data: val,
    dataType: 'json'
  });
  $.ajax({
    url : "http://localhost/sbes/api?q=InsertSchedule&emp_id="+emp_id,
    method: "POST",
    data: val,
    dataType: 'json'
  });

  alert("Employee Added!");
  load_employee();
}

function submitNewEmployee(){
  $('#submit-btn').click();
}

$('#form-new_employee').submit(function(e){
  const values = $(this).serializeArray();
  var formData = new FormData($(this)[0]);
  let imgUrl = '';
  e.preventDefault();
  $.ajax({
    url : "http://localhost/sbes/apis/classes/employee_submit_img.php",
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
    error: (a,b,c) => {
      e.preventDefault();
    }
  });
  e.preventDefault();
  values.push({ name: "imgUrl", value: imgUrl });

  $.ajax({
    url : "http://localhost/sbes/api?q=InsertNewEmployee",
    method: "POST",
    data: values,
    dataType: 'json',
    success: function(response){
      e.preventDefault();
      var emp_id = response.values;
      addAdditionalDetails(emp_id, values);
    }
  });
  e.preventDefault();
});
