
     <?
     
     /*
 *      SELECT college_id
						FROM colleges
						WHERE name = 'Brandeis University'
                        OR
                        name = 'Amherst College'
                        OR 
                        name = 'Elon University';
                        
SELECT firstName, lastName, email, name
FROM alumni, colleges
WHERE alumni.college_id = colleges.college_id;

SELECT firstName, lastName, email, name
FROM alumni, colleges
WHERE alumni.college_id = colleges.college_id
AND colleges.college_id = 2;
       
*/
    //PHP7 DB functions:
    //mysqli_fetch_array() - Fetch a result row as an associative, a numeric array, or both
    //mysqli_fetch_row() - Get a result row as an enumerated array
    //mysqli_fetch_object() - Returns the current row of a result set as an object
    //mysqli_query() - Performs a query on the database
    //mysqli_data_seek() - Adjusts the result pointer to an arbitrary row in the result
     
        //phpinfo();
        
        //debugging 
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
        //connect to db
        $user = 'root';
        $password = 'root';
        $db = 'alumni_test';
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
    
        }
        
        //use to query the db 
        function query($query){
            global $link;
            return mysqli_query($link, $query); 
        }
        
        //$result->free();
        //$link->close();       
    ?>