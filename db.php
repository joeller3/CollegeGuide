<html>
    <head>
        <title>
            DB Test
        </title>
    </head>
    <body>
        <h1>DB TEST</h1>
     <?
//     PHP7 DB functions:
    //mysqli_fetch_array() - Fetch a result row as an associative, a numeric array, or both
    //mysqli_fetch_row() - Get a result row as an enumerated array
    //mysqli_fetch_object() - Returns the current row of a result set as an object
    //mysqli_query() - Performs a query on the database
    //mysqli_data_seek() - Adjusts the result pointer to an arbitrary row in the result
     
        //phpinfo();
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
        $user = 'root';
        $password = 'root';
        $db = 'alumni';
        $port = 8889;
        $host = 'localhost';
        $socket = 'localhost:/Applications/MAMP/tmp/mysql/mysql.sock';
          
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
    
        }else {
           // echo "<p> Connected Woot Woot! </p>";
        }
        
        $result = mysqli_query($link, "SELECT * FROM alumni");
        
        if ($result){
            printf("Select returned %d rows.\n", mysqli_num_rows($result));
            
             /* fetch associative array */
            while ($row = $result->fetch_assoc()) {
                printf ("%s (%s)\n", $row["firstname"], $row["alumni_id"]);
            }
            mysqli_free_result($result);
        }
        
        //$result->free();
        //$link->close();
         
    ?>
    </body>
</html>