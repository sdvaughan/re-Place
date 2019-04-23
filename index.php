<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<style>
	p.sansserif {
		font-family: "Agency FB", sans-serif;
		font-weight: bold;
	}
	label {
		display: inline-block;
		width: 50px;
		margin-right: 30px;
		text-align: right;
	}
</style>
	<h1 style="color: #800000; font-family: Arial;">re/Place</h1>
</head>

<body>
        <canvas id="mainCanvas" width="500" height="500" style="border:3px solid #000000;"></canvas><br><br>
	
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
            echo "var canvas = document.getElementById('mainCanvas'); var context = canvas.getContext('2d'); ";

            while($row = mysqli_fetch_assoc($retval)) {


                $x = $row['xCoord'];
                $y = $row['yCoord'];
                $size = $row['size'];
                $type = $row['type'];
                $rad = $size/2;
                $triH = $size * sqrt(3) / 2;

                if ($type == 0) {
	                echo "context.beginPath(); context.arc($x, $y, $rad, 0, 2 * Math.PI, false); context.lineWidth = 5; context.strokeStyle = '#003300'; context.stroke();";
                }
                if ($type == 1) {
                        echo "context.beginPath(); context.rect($x-($size/2),$y-($size/2),$size,$size); context.lineWidth = 5; context.strokeStyle = '#003300'; context.stroke();";
                }

                if ($type == 2) {
                        echo "context.strokeStyle = '#003300'; context.lineWidth = 5; context.save(); context.beginPath(); context.moveTo($x + ($size/2), $y + ($triH/2)); context.lineTo($x, $y - ($triH/2)); context.lineTo($x - ($size/2), $y + ($triH/2)); context.lineTo($x + ($size/2), $y + ($triH/2)); context.stroke(); context.closePath(); context.save();";
                }
            }

            echo " </script>";
            mysqli_close($conn);
        ?>


	<p class="sansserif">please work</p>
        <iframe style="display:none" name="hidden-form"></iframe>
	<form action="/draw.php" method="post" onsubmit="setTimeout(function () { window.location.reload(); }, 20)">
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
                        <span class="validity"></span>
                </div>
                <div>
                        <input style="margin-left:30px;" type="submit">
                </div>
        </form>
</body>
</html>
