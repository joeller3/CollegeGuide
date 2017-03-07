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


  $("#directoryTable").DataTable(
    //{
    //  dom: 'Bfrtip',
    //  buttons: [
    //    'copy', 'csv', 'excel', 'pdf', 'print'
    //  ]
    //}
  );
});
