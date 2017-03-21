
<?
/**
*Manages db connection and interaction
**/

//debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//connect to db
$user = 'girlsw5_jeff';
$password = '?I(#DaWol[kV';
$db = 'girlsw5_alumnicollege';
$host = '173.205.126.123';
$link = mysqli_connect(
   $host,
   $user,
   $password,
   $db
);

//Check if db link is connected
if (!$link){
   echo "Error: Unable to connect to MySQL." . PHP_EOL;
   echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
   echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
   exit;
}

/**
query db and pulls result set
@return 2d array - result set
**/
function query($query){
   global $link;
   return mysqli_fetch_all(mysqli_query($link, $query));
}

//insert into db
//@return boolean - insertion success
function insertQuery($query){
   global $link;
   return mysqli_query($link, $query);
}

?>
