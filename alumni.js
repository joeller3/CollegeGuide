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

  $("#directoryTable").DataTable({
    dom: 'Bfrtip',
    buttons: [
      {
        extend: 'copyHtml5',
        exportOptions: {
          columns: ':contains("Office")'
        }
      },
        'excelHtml5',
        'csvHtml5',
        'pdfHtml5'
    ]
  } );
});
