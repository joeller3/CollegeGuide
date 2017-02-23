<?
include 'db.php';
//query from db to populate these arrays 
$ALUM_SCHOOLS = ['Brandeis University', 'Columbia University', 'New York City College', 'Brooklyn Manhattan Community College', 'Barnard College', 'Amherst College', 'Oberlin College' ];
$REGIONS = ['Northeast', 'Midwest', 'South', 'West'];
$PROGRAMS = ['IAC', 'Goldman Sachs', 'IBM', 'Google', 'Twitter'];

if (isset($_POST['firstname'])){
		
	$first = $_POST['firstname'];
	$last = $_POST['lastname'];
	$email = $_POST['email'];
	
	$query = "INSERT INTO `alumni` (`user_id`, `firstName`, `lastName`, `email`, `college_id`) VALUES (NULL, '$first', '$last', '$email','2')";
	query($query);
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

    <title>College Directory Form</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="bootstrap-3.3.7-dist/css/starter-template.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
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
						<li><a href="form.php">Form</a></li>
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
			<!-- query db and get the list of colleges that are present then use data as options for a selection (only one choice allowed) -->     
		 <form method="post">
			<div class="form-group">
				<label for="FirstName"> First Name </label>
				<input name="firstname" class="form-control" type="text" id="FirstName" >
				<label for="LastName">Last Name</label>
				<input name="lastname" class="form-control" type="text" id="LastName">
				<label for="Email">Email Address</label>
				<input name="email" class="form-control" type="text" id="Email">
				
				<label for="College" class="col-2 col-form-label">College</label>
				<select name="college" class="input form-control" id="College">
				<?
					foreach ($ALUM_SCHOOLS as $school){
						echo "<option value='$school'>$school</option>";
					}
				?>
				</select>	
				<br></br>
				<button type="submit" class="btn btn-primary" id="FormBtn">Submit</button>		
			</div>
		 </form> 
    </div><!-- /.container -->

   <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/tests/vendor/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap-3.3.7-dist/js/ie10-viewport-bug-workaround.js"></script>	
		<!-- Select 2-->
		<link href="select2-4.0.3/dist/css/select2.min.css" rel="stylesheet" />
		<script src="select2-4.0.3/dist/js/select2.min.js"></script>
			
		<script src="form.js"></script>
  </body>
</html>
