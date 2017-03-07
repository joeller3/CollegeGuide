$(document).ready(function() {

  $("#College").select2({
    placeholder: "Select an Institution",
    allowClear: true
  });

  $("#Program").select2({
    placeholder: "Select a GWC Program or Club",
    allowClear: true
  });
});
