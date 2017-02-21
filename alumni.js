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
    placeholder: "Select a Girls Who Code Program",
    alllowClear: true
  });
  
  $("#CollegeType").select2({
    placeholder: "Select a college type",
    allowClear: true
  });
  
  //submit button
  $("#SubmitBtn").click(function(){
    var region = document.getElementById("Region").value;
    var college = document.getElementById("College").value;
    var program = document.getElementById("Program").value;
    var collegeType = document.getElementById("CollegeType").value;
    
    alert(region +" "+ college +" "+program +" "+ collegeType);
  });
});