<?
$ALUM_SCHOOLS = ['Brandeis University', 'Columbia University', 'New York City College', 'Brooklyn Manhattan Community College', 'Barnard College', 'Amherst College', 'Oberlin College' ];
$REGIONS = ['Northeast', 'Midwest', 'South', 'West'];
$PROGRAMS = ['IAC', 'Goldman Sachs', 'IBM', 'Google', 'Twitter'];

//User input values 
if ($_POST['colleges'] || $_POST['regions'] || $_POST['types'] || $_POST['programs']){
		
	$InputColleges = $_POST['colleges'];
	$InputRegions = $_POST['regions'];
	$InputTypes = $_POST['types'];
	$InputPrograms = $_POST['programs'];
	
	print_r($InputColleges);
	print_r($InputPrograms);
	print_r($InputRegions);
	print_r($InputTypes);
	//foreach ($InputColleges as $input){
	//	echo $input;
	//}
	//
	//foreach ($InputPrograms as $input){
	//	echo "<p>$input</p>";
	//}
	//
	//foreach ($InputRegions as $input){
	//	echo "<p>$input</p>";
	//}
	//
	//foreach ($InputTypes as $input){
	//	echo "<p>$input</p>";
	//}
}
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
		
		<?
			include 'db.php';
		?>
		
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
          <a class="navbar-brand" href="/homepage.php">Girls Who Code</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/homepage.php">Home</a></li>
            <li><a href="/map.php">College Map</a></li>
            <li><a href="/index.php">College Directory</a></li>
						<li><a href="db.php">DB</a></li>
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
        <form method="post">
          <div class="form-group"> 
            <label for="College">College</label>
			<select multiple="multiple" name="colleges[]" class="input form-control" id="College" placeholder="Select an Institution">
			<?
				foreach ($ALUM_SCHOOLS as $school){
					echo "<option value='$school'>$school</option>";
				}
			?>
			</select>
          </div>
          <div class="form-group">
            <label for="Region">Region</label>
			<select multiple="multiple" name="regions[]" class="input form-control" id="Region" placeholder="Select a Region">
				<?
					foreach ($REGIONS as $region){
						echo "<option value='$region'>$region</option>";
					}
				?>
			</select>
          </div>
          <div class="form-group">
            <label for="Program">GWC Program</label>
            <select multiple="multiple" name="programs[]" class="input form-control" id="Program" placeholder="Select GWC Program or Club">
							<?
								foreach ($PROGRAMS as $program){
									echo "<option value='$program'>$program</option>";
								}
							?>
            </select>
          </div>
          <div class="form-group">
            <label for="InstitutionType">Institution Type</label>
            <select multiple="multiple" name="types" class="input form-control" id="CollegeType">
              <option value="4yr">4-year College/ University</option>
              <option value="2yr">2-year College</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary" id="SubmitBtn" >Submit</button>
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
    <!--<script>window.jQuery || document.write('<script src="bootstrap-3.3.7-dist/js/tests/vendor/jquery.min.js"><\/script>')</script>-->
    <script src="bootstrap-3.3.7-dist/js/tests/vendor/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap-3.3.7-dist/js/ie10-viewport-bug-workaround.js"></script>	
		<!-- Select 2-->
		<link href="select2-4.0.3/dist/css/select2.min.css" rel="stylesheet" />
		<script src="select2-4.0.3/dist/js/select2.min.js"></script>
			
		<script src="alumni.js"></script>
  </body>
</html>
