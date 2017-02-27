
<?


//$ch = curl_init("https://api.data.gov/ed/collegescorecard/v1/schools?school.degrees_awarded.highest=2,3,4&_fields=school.state,school.name,location.lon,location.lat&_sort=name&_per_page=1&api_key=APAOLg9pyslYMGQq5x5zRVKbwxrjhXX6WGfDeNjk");
$ch = curl_init("https://api.data.gov/ed/collegescorecard/v1/schools?school.degrees_awarded.highest=2,3,4&_fields=school.state,school.name,location.lon,location.lat,school.degrees_awarded.highest&_sort=name&_per_page=3&api_key=APAOLg9pyslYMGQq5x5zRVKbwxrjhXX6WGfDeNjk");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$json = curl_exec($ch);

$collegeData = json_decode($json);
print_r($collegeData);
echo '<br></br>';
/**
foreach($collegeData->results as $college){ 
    $name = $college->school.name;
    $lon = $college->location.lon;
    $lat = $college->location.lat;
    $state = $college->school.state;
    $degree = $college->school.degrees_awarded.highest;
    echo "<h1>$name</h1>";
}

$query = "INSERT INTO `colleges` (`college_id`, `name`, `highest_degree`, `state`, `longitude`, `latitude`) VALUES (NULL, '$name', '$degree', '$state','$lon', '$lat')";


echo "<p>$query</p>";**/


/**
$API_SCHOOLS;

$ch = curl_init("https://api.data.gov/ed/collegescorecard/v1/schools?_fields=school.name&_sort=name&_per_page=50&api_key=APAOLg9pyslYMGQq5x5zRVKbwxrjhXX6WGfDeNjk");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch);

//https://api.data.gov/ed/collegescorecard/v1/schools?_fields=school.state,school.name,school.degrees_awarded.highest,location.lon,location.lat&_sort=name&_per_page=2&api_key=APAOLg9pyslYMGQq5x5zRVKbwxrjhXX6WGfDeNjk


foreach($data as $school){
	
}

curl_close($ch);

**/


?>