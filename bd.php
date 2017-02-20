<html>
    <head>
        <title>
            DB Test
        </title>
    </head>
    <body>
        <h1>DB TEST</h1>
     <?
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
        
       if (!$link){
        echo "Error: Unable to connect to MySQL." . PHP_EOL;
        echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
            //
            //echo "<p> not connected </p>";
            //die('Not Connected :' . mysql_error());
        }else {
            echo "<p> Connected Woot Woot! </p>";
            
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
        
    ?>
    </body>
</html>