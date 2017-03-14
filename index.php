<?
/**
@author Joelle Robinson <joelle.robinson@girlswhocode.com> Girls Who Code  ESI
 **/
include 'db.php';

//retrieve colleges in db
$query = "SELECT Institution_Name FROM institutions ORDER BY Institution_Name";
$result = query($query);
$ALUM_SCHOOLS = array();
foreach ($result as $row){
	array_push($ALUM_SCHOOLS, $row[0]);
}
//retrieve programs from db
$query = "SELECT program_name FROM programs ORDER BY program_name";
$result = query($query);
$PROGRAMS = array();
foreach ($result as $row){
	array_push($PROGRAMS, $row[0]);
}
//states for colleges
$STATES = [
	'AL', 'AK','AS','AZ','AR','CA', 'CO','CT','DE', 'DC', 'FL', 'GA','GU','HI','ID','IL','IN','IA','KS',
	'KY','LA','ME','MD', 'MH', 'MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND',
	'OH','OK','OR','PA','PR','RI','SC','SD','TN','TX','UT','VT','VA','VI','WA','WV','WI','WY'
];

/**
generate table with alumni data. If no user input is given via the form
(i.e. page load) the table displays all alumni and their respective schools
 **/
function genTable(){
	$institutionFilter = $typeFilter = $programFilter = $stateFilter = '';
	//used to distinguish between filters for query
	$flags = [false, false, false, false];
	$count = 0;

	$query = 'SELECT institutions.Institution_Name, programs.program_name, firstName, lastName, email, linkedin FROM alums INNER JOIN institutions ON alums.Institution_ID = institutions.Institution_ID INNER JOIN programs ON alums.program_id = programs.program_id WHERE ';
	//college filter
	if (isset($_POST['colleges'])) {
		$colleges = $_POST['colleges'];
		if(count($colleges) > 1){
			$institutionFilter = "(institutions.Institution_Name = '" . implode("' OR institutions.Institution_Name = '",$colleges) . "')";
		}else{
			$institutionFilter = "(institutions.Institution_Name = '". $colleges[0] . "') ";
		}
		$flags[0] = true;
		$count++;
	}

	//institution type filter
	/**
	Institutional – an accreditation type which normally applies to an entire institution, including freestanding single–purpose institutions. Typically can be used to establish eligibility to participate in Title IV programs.

	Specialized – an accreditation type which normally applies to the evaluation of programs, departments, or schools which usually are parts of a total collegiate or other postsecondary institution.

	Internship/Residency – an accreditation type which is granted to locations which provide
	**/

	if (isset($_POST['types'])){
		if((count($_POST['types']) > 1)){
			$typeFilter = "(institutions.Accreditation_Type = '" . implode("' OR institutions.Accreditation_Type = '",$input) . "')";
		}else{
			$typeFilter = " (institutions.Accreditation_Type = '". $_POST['types'][0]. "') ";
		}
		$flags[1] = true;
		$count++;
	}

	//GWC program and club filter
	if (isset($_POST['programs'])){
		$programs = $_POST['programs'];
		if((count($programs)) > 1){
			$programFilter = "(programs.program_name = '". implode ("' OR programs.program_name = '", $programs) . "')";
		}else{
			$programFilter = " (programs.program_name = '" . $programs[0] . "' ) ";
		}
		$flags[2] = true;
		$count++;
	}

	//states filter
	if (isset($_POST['states'])){
		$states = $_POST['states'];
		if(count($states) > 1){
			$stateFilter = "(institutions.Institution_State = '". implode ("' OR institutions.Institution_State = '", $states) . "')";
		}else{
			$stateFilter = "(institutions.Institution_State = '". $_POST['states'][0]."' )";
		}
		$flags[3] = true;
		$count++;
	}

	$filters = [$institutionFilter, $typeFilter, $programFilter, $stateFilter];
	$first = $count;
	$isquery = false;
	//concatenate filters into query
	for ($i = 0; $i < 4; $i++){
		if ($flags[$i]){ //if there is user input at this filter
			if($count == $first || ($count == $first && $count == 1) ){
				$query .= $filters[$i];
				$count--;
			}else if ($count > 0){
				//not first
				$query = $query . " AND " . $filters[$i];
				$count--;
			}
			$isquery = true;
		}
	}

	if ($isquery){ //query db with user inputs
		$result = query($query);
		populateTable($result);
	}else { //query db for all alumni and their respective schools
		$query = 'SELECT institutions.Institution_Name, programs.program_name, firstName, lastName, email, linkedin FROM alums INNER JOIN institutions ON alums.Institution_ID = institutions.Institution_ID INNER JOIN programs ON alums.program_id = programs.program_id';
		$result = query($query);
		populateTable($result);
	}
}
//populate table with results
function populateTable($result){
	foreach ($result as $row){
		$college = $row[0];
		$first = $row[1];
		$last = $row[2];
		$email = $row[3];
		$program = $row[4];
		$linkedin = $row[5];
		echo "<tr> <td>$college</td> <td>$first</td> <td>$last</td> <td>$email</td> <td>$program</td> <td><a href='$linkedin'>$linkedin</a></td> </tr>";
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
            <li><a href="/homepage.php">Home</a></li>
            <li><a href="/map.php">College Map</a></li>
            <li class="active"><a href="/index.php">College Directory</a></li>
						<li><a href="form.php">Form</a></li>
						<!-- <li><a href="updatedb.php">db script</a></li> -->
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
						<select multiple="multiple" name="colleges[]" class="input form-control" id="College">
							<?
								foreach ($ALUM_SCHOOLS as $school){
									echo "<option value='$school'>$school</option>";
								}
							?>
						</select>
        	</div>
					<div class="form-group">
						<label for="State">State</label>
						<select multiple="multiple" name="states[]" class="input form-control" id="State">
						<?
							foreach ($STATES as $state){
								echo "<option value='$state'>$state</option>";
							}
						?>
						</select>
					</div>
          <div class="form-group">
            <label for="Program">GWC Program</label>
            <select multiple="multiple" name="programs[]" class="input form-control" id="Program"> <!-- changed to a single program-->
							<?
								foreach ($PROGRAMS as $program){
									echo "<option value='$program'>$program</option>";
								}
							?>
            </select>
          </div>
          <div class="form-group">
            <label for="InstitutionType">Institution Type</label>
            <select multiple="multiple" name="types[]" class="input form-control" id="CollegeType">
							<option value='Institutional'>Institutional</option>
							<option value='Specialized'>Specialized</option>
							<option value='Internship/Residency'>Internship/Residency</option>
							<!--<option value="4">4-year Bachelor's Degree</option>
              <option value="2">2-year Associate's Degree</option>-->
            </select>
          </div>
          <button type="submit" class="btn btn-primary" id="SubmitBtn" >Submit</button>
        </form>
      </div><!-- /form -->

    </div><!-- /.container -->

   <br></br>

    <div class="container-fluid">
      <!--Table-->
      <table class="table table-striped" id="directoryTable">
        <thead class="thead-inverse">
          <tr>
						<th>School</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>GWC Program/Club</th>
            <th>LinkedIn</th>
          </tr>
        </thead>
        <tbody>
					<?
						//generate table upon user entering filters
						//otherwise, generates table of all alumni in college
						genTable();
					?>
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

		<!--Data Tables /HTML Buttons-->
		<link href="DataTables-1.10.13/media/css/dataTables.bootstrap.css" rel="stylesheet"/>
		<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet"/>
		<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet"/>
		<script src="DataTables-1.10.13/media/js/jquery.dataTables.min.js"></script>
		<script src="DataTables-1.10.13/media/js/jquery.dataTables.js"></script>
		<script src="DataTables-1.10.13/media/js/dataTables.bootstrap.js"></script>
		<script src="DataTables-1.10.13/extensions/Buttons/js/dataTables.buttons.min.js"></script>
		<script src="bootstrap-3.3-2.7/docs/assets/js/vendor/jszip.min.js"></script>
		<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
		<script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
		<script src="alumni.js"></script>
  </body>
</html>
