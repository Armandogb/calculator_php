
<!DOCTYPE html>

<html>

	<head>
		<title>Calculator</title>
		<link rel="stylesheet" type="text/css" href="css/app.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<script src="js/app.js"></script>
	</head>

	<body>

	<div class='wrapper'>

		<div class="calc">

			<img src="/img/calculator.png">

			<div class="screen">
				<form class ="the_calc" action="calc.php" method="get">
				  <input class="digits" type="text" name="digits" value="<?php echo $_GET['answer'] ?>">
				</form>
			</div>
			<div class="row1 buts">
				<div class="but1">
				</div>
				<div class="but2">
				</div>
				<div class="but3">
				</div>
				<div class="but4">
				</div>
				<div class="but5">
				</div>
				<div class="but6">
				</div>
			</div>
			<div class="row2 buts">
				<div class="but1">
				</div>
				<div class="but2 click" href="7">
				</div>
				<div class="but3 click" href="8">
				</div>
				<div class="but4 click" href="9">
				</div>
				<div class="but5 click" href="/">
				</div>
				<div class="but6 click" href="^">
				</div>
			</div>
			<div class="row3 buts">
				<div class="but1">
				</div>
				<div class="but2 click" href="4">
				</div>
				<div class="but3 click" href="5">
				</div>
				<div class="but4 click" href="6">
				</div>
				<div class="but5 click" href="x">
				</div>
				<div class="but6 click" href="-">
				</div>
			</div>
			<div class="row4 buts">
				<div class="but1">
				</div>
				<div class="but2 click" href="1">
				</div>
				<div class="but3 click" href="2">
				</div>
				<div class="but4 click" href="3">
				</div>
				<div class="but5 click" href="+">
				</div>
				<div class="but6 submit">
				</div>
			</div>
			<div class="row5 buts">
				<div class="but1 clear">
				</div>
				<div class="but2 click" href="0">
				</div>
				<div class="but3 click" href="00">
				</div>
				<div class="but4 click" href=".">
				</div>
				<div class="but5 click" href="+">
				</div>
				<div class="but6 submit">
				</div>
			</div>

		</div>

	</div>

	</body>
</html>


