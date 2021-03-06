<?
include 'db.php';
//query from db to populate these arrays
//retrieve colleges in db
$query  = 'SELECT Institution_Name FROM institutions ORDER BY Institution_Name';
$result = query($query);
$ALUM_SCHOOLS = array();
foreach ($result as $row){
	array_push($ALUM_SCHOOLS, $row[0]);
}

$query = "SELECT program_name FROM programs ORDER BY program_name";
$result = query($query);
$PROGRAMS = array();
foreach ($result as $row){
	array_push($PROGRAMS, $row[0]);
}

if (isset($_POST['firstname'])){
	$first = $_POST['firstname'];
	$last = $_POST['lastname'];
	$email = $_POST['email'];
	$school = $_POST['college'][0];
	$program = $_POST['program'][0];
	$linkedin = $_POST['linkedin'];

	$query = "SELECT Institution_ID FROM institutions WHERE Institution_Name = '$school';";
  $result = query($query);
	$collegeId = $result[0][0];

	$query = "SELECT program_id FROM programs WHERE program_name = '$program';";
	$result = query($query);
	$programId = $result[0][0];

	$query  = "INSERT INTO `alums` (`alum_id`, `Institution_ID`, `program_id`, `firstName`, `lastName`, `email`, `linkedin`) VALUES (NULL, '$collegeId', '$programId', '$first', '$last', '$email', '$linkedin')";

	if(insertQuery($query)){
		echo "<script type='text/javascript'>alert('Thank you! You have just been added Girls Who Code's College Directory!');</script>";
	}else{
		echo "<script type='text/javascript'>alert('Something went wrong, please try again.');</script>";
	}
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
		<link href="example.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
		<div class="header-top">
			<nav class="row">
				<li>
					<a href="https://girlswhocode.com/">
						<img alt="Girls Who Code Logo" src="https://3zjc852t4swp1lmezl171oga-wpengine.netdna-ssl.com/wp-content/themes/girlswhocode/images/header-logo.png" >
					</a>
				</li>
			</nav>
		</div><!--/header-top-->
		<div class="header-bottom" style="background-image: url('https://3zjc852t4swp1lmezl171oga-wpengine.netdna-ssl.com/wp-content/uploads/2016/05/gwc_homepage-1170x580.jpg')">
		</div><!--/header-bottom-->
		<div class="header-call-to-action">
			<div class="row text-center">
				 Add yourself to the Collegiate Alumni Directory to be a resource for alumni!<a href="https://girlswhocode.com/alumni/directory/index.php" style="color: #ede813"> Go to the directory to start connecting</a>!
			</div>
		</div>

	<!--Form-->
    <div class="container">
		<div class="starter-template">
			<h2>Share Your Contact Information with the Girls Who Code Community</h2>
		</div>
      <!-- Form -->
		 <form method="post">
			<div class="form-group">
				<label for="FirstName"> First Name </label>
				<input name="firstname" class="form-control" type="text" id="FirstName" required="required">
				<label for="LastName">Last Name</label>
				<input name="lastname" class="form-control" type="text" id="LastName" required="required">
				<label for="Email">Email Address</label>
				<input name="email" class="form-control" type="text" id="Email" required="required">
				<!-- check if it is a valid url -->
				<label for="LinkedIn"> LinkedIn</label>
				<input name="linkedin" class="form-control" type="text" id="LinkedIn">

				<label for="Program" class="col-2 col-form-label">GWC Program</label>
				<select name="program[]" class="form-control" id="Program" placeholder="Select a GWC Program or Club" style="width:100%">
					<option></option>
					<?
						foreach ($PROGRAMS as $program){
							echo "<option value='$program'>$program</option>";
						}
					?>
				</select>
				<label for="College" class="col-2 col-form-label">College</label>
				<select name="college[]" class="input form-control" id="College" style="width:100%">
					<option></option>
					<?
						foreach ($ALUM_SCHOOLS as $school){
							echo "<option value='$school'>$school</option>";
						}
					?>
				</select>
				<br></br>
				<button type="submit" class="btn btn-primary" id="SubmitBtn" onclick="confirmation">Submit</button>
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
