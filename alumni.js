$(document).ready(function() {

  //Form input values
  $("#College").select2({
    placeholder: "Select an Institution",
    allowClear: true
  });

  $("#Region").select2({
    placeholder: "Select a region",
    allowClear: true
  });

  $("#Program").select2({
    placeholder: "Select a Girls Who Code Program or Club",
    allowClear: true
  });

  $("#CollegeType").select2({
    placeholder: "Select a college type",
    allowClear: true
  });

  $("#State").select2({
    placeholder: "Select a state",
    allowClear: true
  });

  //table w/ query results + export button functionality
  $("#directoryTable").DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copyHtml5',
      'excelHtml5',
      'csvHtml5',
      'pdfHtml5'
    ]
  });
});
