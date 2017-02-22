$(document).ready(function() {
  
  $("#College").select2({
    placeholder: "Select an Institution",
    allowClear: true
  });
  
  // form submit button
  $("#FormBtn").click(function(){
    var firstname = $('#FirstName').val();
    var lastname = $('#LastName').val();
    var email = $('#Email').val();
    var college = $('#College').val();
    
    alert(firstname +" "+ lastname +" "+ email +" "+ college);
  });
});