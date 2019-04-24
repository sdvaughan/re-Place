<html>
	<style>
		table, th, td {
			border: 1px solid black;
			border-collapse: collapse;	
		}
	</style>
<body>


	<?php
            $dbhost = 'localhost';
            $dbuser = 'shapesDBUser';
            $dbpass = 'passForDB00!';
            $dbname = 'rePlace';

            $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

            if(! $conn ) {
              echo "error connect\n";
              die('Could not connect: ' . mysql_error());
            }

	    $query = "SELECT * FROM `shapes` ORDER BY time DESC";
            $retval = mysqli_query( $conn, $query );
            if(! $retval ) {
                    echo "Error return\n";
                    die('Could not enter data: ' . mysql_error());
            }
            echo "<h2 style=\"text-align: center\">Entry List:</h2><table style=\"width:75%; margin-left: auto; margin-right: auto;\"";
            echo "<tr><th>X Position</th><th>Y Position</th><th>Size</th><th>Shape</th><th>Filled</th><th>Artist (IP)</th><th>Time</th></tr>";

            while($row = mysqli_fetch_assoc($retval)) {


                $x = $row['xCoord'];
                $y = $row['yCoord'];
                $size = $row['size'];
		$type = $row['type'];
		$fillraw = $row['fill'];
                $ip = $row['ip'];
		$time = $row['time'];

		if ($type == 0) {
			$shape = "Circle";
		} else if ($type == 1) {
			$shape = "Square";
		} else if ($type == 2) {
			$shape = "Triangle";
		}

		if ($fillraw == 1) {
			$fill = "True";
		} else {
			$fill = "False";
		}
		

		echo "<tr><td>$x</td><td>$y</td><td>$size</td><td>$shape</td><td>$fill</td><td>$ip</td><td>$time</td></tr>";

	    }

	    echo "</table>";
            mysqli_close($conn);
	?>
</body>
</html>
