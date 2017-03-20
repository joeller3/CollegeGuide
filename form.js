$(document).ready(function() {

  $("#College").select2({
    placeholder: "Select an Institution",
    allowClear: true,
    initSelection: function(element, callback) {
    }
  });

  $("#Program").select2({
    placeholder: "Select a GWC Program or Club",
    allowClear: true,
  });
});

function confirmation(){
  alert("Thank you! You've been added to the directory");
}
