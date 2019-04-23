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
	<p class="sansserif">please work</p>
        <iframe style="display:none" name="hidden-form"></iframe>
	<form action="/draw.php" method="post" >
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
