<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<style>
	table, th, td {
		border: 1px solid black;
		border-collapse: collapse;
		background-color:#ffffff;
	}
	form {
		width: 300px;
		margin: 0 auto;
	}
	p.sansserif {
		font-family: "Agency FB", sans-serif;
		font-weight: bold;
		text-align: center;
	}
	label {
		display: inline-block;
		width: 70px;
		margin-right: 30px;
		text-align: right;
	}
	canvas {
		padding-left: 0;
		padding-right: 0;
		margin-left: auto;
		margin-right: auto;
		display: block;
		width: 500px;
	}
</style>
	<h1 style="color: #800000; font-family: Arial; text-align: center;">re/Place</h1>
</head>

<body bgcolor="#7ec0ee">
	<p class="sansserif">Submit a shape below, and watch it appear on screen as you collaborate with others!</p>	
        <canvas id="mainCanvas" width="500" height="500" style="border:3px solid #000000;"></canvas>
	
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

	    $query = "SELECT * FROM `shapes`";
            $retval = mysqli_query( $conn, $query );
            if(! $retval ) {
                    echo "Error return\n";
                    die('Could not enter data: ' . mysql_error());
            }
            echo "<script> ";
            echo "var canvas = document.getElementById('mainCanvas'); var context = canvas.getContext('2d'); context.fillStyle = \"white\"; context.fillRect(0,0,canvas.width,canvas.height); context.fillStyle = \"black\"; context.strokeStyle = \"black\";";

            while($row = mysqli_fetch_assoc($retval)) {


                $x = $row['xCoord'];
                $y = $row['yCoord'];
                $size = $row['size'];
		$type = $row['type'];
		$fill = $row['fill'];
		#echo "document.write($fill);";
                $rad = $size/2;
                $triH = $size * sqrt(3) / 2;

                if ($type == 0) {
			echo "context.beginPath(); context.arc($x, $y, $rad, 0, 2 * Math.PI, false); context.lineWidth = 5; context.strokeStyle = '#003300';";
                }
                if ($type == 1) {
                        echo "context.beginPath(); context.rect($x-($size/2),$y-($size/2),$size,$size); context.lineWidth = 5; context.strokeStyle = '#003300';";
                }

                if ($type == 2) {
                        echo "context.strokeStyle = '#003300'; context.lineWidth = 5; context.save(); context.beginPath(); context.moveTo($x + ($size/2), $y + ($triH/2)); context.lineTo($x, $y - ($triH/2)); context.lineTo($x - ($size/2), $y + ($triH/2)); context.lineTo($x + ($size/2), $y + ($triH/2));";
		}
		if ($fill == 0) {
			echo "context.stroke(); context.closePath(); context.save();";
		} else {
			echo "context.fill(); context.closePath(); context.save();";
		}
            }

            echo " </script>";
            mysqli_close($conn);
        ?>

        <iframe style="display:none" name="hidden-form"></iframe><br>
	<form action="/draw.php" method="post" target="hidden-form" onsubmit="setTimeout(function(){window.location.reload();},100)">
                <div>
                        <label for="xCoord">X:</label>
                        <input style="width:60px;" name="xCoord" type="number" min="0" max="500" required>
                        <input style="margin-left:10px;" name="type" type="radio"  value="0" required>Circle<br>
                        <label for="yCoord">Y:</label>
                        <input style="width:60px;" name="yCoord" type="number" min="0" max="500" required>
                        <input style="margin-left:10px;" name="type" type="radio" value="1" required>Square<br>
                        <label for="size">Size:</label>
                        <input style="width:60px;" name="size" type="number" min="1" max="100" required>
			<input style="margin-left:10px;" name="type" type="radio" value="2" required>Triangle<br><br>
			<input style="margin-left:105px;" type="checkbox" name="fill" value="1">Fill shape<br><br>
                        <span class="validity"></span>
                </div>
                <div>
                        <input style="margin-left:105px;" type="submit">
                </div>
	</form>

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

	    $query = "SELECT * FROM `shapes` ORDER BY time DESC LIMIT 15";
            $retval = mysqli_query( $conn, $query );
            if(! $retval ) {
                    echo "Error return\n";
                    die('Could not enter data: ' . mysql_error());
            }
            echo "<br><h2 style=\"text-align: center\">Entry List:</h2><table style=\"width:75%; margin-left: auto; margin-right: auto;\"";
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
	
	<br><p style="text-align: center"><a href="/entries.php">View all entries >></a></p><br>

</body>
</html>
