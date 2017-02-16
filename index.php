<?
$ALUM_SCHOOLS = ['Brandeis University', 'Columbia University', 'New York City College'];
$REGIONS = ['Northeast', 'Midwest', 'South', 'West'];
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>GWC: College Directory</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap-3.3.7-dist/css/starter-template.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
		<script src="select2-4.0.3/src/js/jquery.select2.js"></script>
		
		<!--<script type="text/javascript">-->
		<!--	$(document).ready(function() {-->
		<!--		$(".inputs").select2();-->
		<!--	});-->
		<!--</script>-->

		
  </head>

  <body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Girls Who Code</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
    
	<!--Form-->
    <div class="container">
		
      <div class="starter-template">
        <h1>College Directory</h1>
      </div>
      
      <!-- Form --> 
      <div class="container">
        <h2>Find Alumni</h2>
        <form>
          <div class="form-group"> 
            <label for="College">College</label>
			<select class="inputs form-control" id="inputCollege" placeholder="Select an Institution">
				<option value="" selected disabled>Please Select an Institution</option>
			<?
				foreach ($ALUM_SCHOOLS as $school){
					echo "<option>$school</option>";
				}
			?>
			</select>
          </div>
          <div class="form-group">
            <label for="Region">Region</label>
			<select class="inputs form-control" id="inputRegion" placeholder="Select a Region">
				<option value="" selected disabled>Please Select a Region</option>
				<?
					foreach ($REGIONS as $region){
						echo "<option>$region</option>";
					}
				?>
			</select>
            <!--<input type="region" class="form-control" id="inputRegion" placeholder="Enter Region">-->
          </div>
          <div class="form-group">
            <label for="Program">GWC Program</label>
            <select class="inputs form-control" id="inputProgram" placeholder="Select GWC Program or Club">
			  <option value="" selected disabled >Please Select a Program or Club</option>
              <option>IAC</option>
              <option>Goldman Sachs</option>
              <option>ATT</option>
              <option>Twitter</option>
              <option>Google</option>
            </select>
          </div>
          <div class="form-group">
            <label for="InstitutionType">Institution Type</label>
            <select class="inputs form-control" id="inputInstitutionType">
			  <option value="" selected disabled>Please Select an Institution Type</option>
              <option>4-year College/ University</option>
              <option>2-year College</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div><!-- /form -->
      
    </div><!-- /.container -->
   
   <br></br> 
    
    <div class="container-fluid">
      <!--Table-->
      <table class="table table-striped">
        <thead class="thead-inverse">
          <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>School</th>
            <th>Email</th>
            <th>GWC Program/Club</th>
            <th>LinkedIn</th>
            <th>Graduation Year</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Joelle</td>
            <td>Robinson</td>
            <td>Brandeis University</td>
            <td>joelle@email.com</td>
            <td>IAC 2013</td>
            <td>Joelle's linkedIn</td>
            <td>2018</td>
          </tr>
        </tbody>
      </table>
		</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="bootstrap-3.3.7-dist/js/tests/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap-3.3.7-dist/js/tests/vendor/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap-3.3.7-dist/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
