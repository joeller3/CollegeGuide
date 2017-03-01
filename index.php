<?
/**
 *@author Joelle Robinson <joelle.robinson@girlswhocode.com>
 *Girls Who Code  ESI
 **/
include 'db.php';

//retrieve colleges in db
$query = "SELECT name FROM colleges ORDER BY name";
$result = query($query);

$ALUM_SCHOOLS = getResults($result, 'name');


/** TODO : MAKE THIS INTO A FUNCTION IN DB.PHP FOR UNIVERSAL USE
	UTILIZE WITH QUERY FUNCTION AND OUTPUT AN ARRAY OF ANS
**/
function getResults($result, $tag){
	$data = array();
	while ($row = $result->fetch_assoc()){
		array_push($data, $row[$tag]);
	}
	mysqli_free_result($result);
	return $data;
}


$REGIONS = ['New England', 'Mid East', 'Great Lakes', 'Plains', 'Southeast', 'Southwest', 'Rocky Mountains', 'Far West', 'Outlying Areas'];

$PROGRAMS = ['IAC', 'Goldman Sachs', 'IBM', 'Google', 'Twitter'];

//--------------------------------------------------------------------
function genTable(){
	$collegeFilter = $typeFilter = $programFilter = $regionFilter = '';
	
	$flags = [false, false, false, false];
	$count = 0;
	
	$query = "SELECT firstName, lastName, email, program, name FROM alumni, colleges WHERE (alumni.college_id = colleges.college_id) AND ";

	//college filter
	if (isset($_POST['colleges'])) {
		
		$input = $_POST['colleges'];
		
		//get ids of selected colleges 
		if(count($input) > 1){
			$list_colleges = implode("' OR name = '",$input);
		}else{
			$list_colleges =  $input[0];
		}
		//query for college ids to relate to college names 
		$collegeFilter = "SELECT college_id
							FROM colleges
							WHERE name = '$list_colleges';";
		$result = query($collegeFilter);
		
		$collegeFilter = '';

		if ($result) {
			$rows = mysqli_num_rows($result);
			$tmp = 1;        
			while ($row = $result->fetch_assoc()){
				if ($tmp++ == $rows){
						$collegeFilter .=  " (colleges.college_id = '$row[college_id]') ";
				}else{
						$collegeFilter .=  " (colleges.college_id = '$row[college_id]') OR ";
				}
			}
			mysqli_free_result($result);
			$flags[0] = true;
			$count++; 
		}
	}
	
	//institution type filter
	if (isset($_POST['types'])){
		if((count($_POST['types']) > 1)){
			$typeFilter = " (colleges.highest_degree = 2) OR (colleges.highest_degree = 4) ";
		}else{
			$typeFilter = " (colleges.highest_degree = '". $_POST['types'][0]. "') ";
		}
		
		$flags[1] = true;
		$count++; 
	}
	
	//GWC program and club filter
	if (isset($_POST['programs'])){
		$programFilter = " (alumni.program = '".$_POST['programs'][0] . "' ) ";
		$flags[2] = true;
		$count++;
	}
	
	//region filter 
	if (isset($_POST['regions'])){
		$regionFilter = " (colleges.region = '". $_POST['regions'][0]."' ) ";
		$flags[3] = true;
		$count++; 
	}
	
	$filters = [$collegeFilter, $typeFilter, $programFilter, $regionFilter];
	$first = $count;
	$isquery = false;
	//concatenate filters into query
	for ($i = 0; $i < 4 ; $i++){
		if ($flags[$i]){
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
	
	if ($isquery){
		$result = query($query);
		if ($result){
			while ($row = $result->fetch_assoc()){
				populateTable($row);
			}
		}
	}else {
		$query = 'SELECT firstName, lastName, email, program, name FROM alumni, colleges WHERE (alumni.college_id = colleges.college_id) ORDER BY name';
			$result = query($query);
		if ($result){
			while ($row = $result->fetch_assoc()){
				populateTable($row);
			}
		}
	}
	
}


//populate table with results 
function populateTable($row){
	$first = $row['firstName'];
	$last = $row['lastName'];
	$college = $row['name'];
	$email = $row['email'];
	$program = $row['program'];
	echo "<tr> <td>$college</td> <td>$first</td> <td>$last</td> <td>$email</td> <td>$program</td> <td>LinkedIn</td> </tr>";
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
			<li><a href="updatedb.php">db script</a></li>
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
            <label for="Region">Region</label>
			<select multiple="multiple" name="regions[]" class="input form-control" id="Region">
				<?
					foreach ($REGIONS as $region){
						echo "<option value='$region'>$region</option>";
					}
				?>
			</select>
          </div>
          <div class="form-group">
            <label for="Program">GWC Program</label>
            <select name="programs[]" class="input form-control" id="Program"> <!-- changed to a single program-->
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
              <option value="4">4-year Bachelor's Degree</option>
              <option value="2">2-year Associate's Degree</option>
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
		
		<!--Data Tables-->
		<link href="DataTables-1.10.13/media/css/dataTables.bootstrap.css" rel="stylesheet"/>
		<script src="DataTables-1.10.13/media/js/jquery.dataTables.js"></script>
		<script src="DataTables-1.10.13/media/js/dataTables.bootstrap.js"></script>
		<script src="alumni.js"></script>
		<!--
		<script src="//code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>	
		<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
		<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/pdfmake.min.js"></script>
		<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.24/build/vfs_fonts.js"></script>
		<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
		<script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>

		<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet"/>
		<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet"/>
		
		-->

  </body>
</html>
