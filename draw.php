<html>
        <body>
        <?php
                echo "IS THIS WORKING\n";
            $dbhost = 'localhost';			#credentials
            $dbuser = 'shapesDBUser';
            $dbpass = 'passForDB00!';
            $dbname = 'rePlace';
            # echo "before conn";
            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            # echo "maybe\n"; 
            if(! $conn ) {
        #           echo "didn't connect";
               die('Could not connect: ' . mysql_error());
            }
            # echo "after conn\n"; 
            $x = $_POST['xCoord'];			#grabbing data from POST
            $y = $_POST['yCoord'];
            $size = $_POST["size"];
            $type = $_POST["type"];
            $time = date('Y-m-d H:i:s');
            $ip = $_SERVER['REMOTE_ADDR'];

         #   echo $time;

            $sql = "INSERT INTO `shapes` VALUES ($x, $y, $size, $type, \"$time\", \"$ip\")";	#forming SQL query
          #  echo $sql;
          #  echo "Before db select";
          #  echo "after db select";
            $retval = mysqli_query( $conn, $sql );	#querying database
          #  echo $retval;
            if(! $retval ) {
        #           echo "query didnt work"; 
        #           echo mysqli_error($conn);
	            mysqli_close($conn);
                    die('Could not enter data: ' . mysql_error());
            }
            mysqli_close($conn);	#close connection
        ?>
        </body>
</html>
                                                                                                                                   37,8          Bot

