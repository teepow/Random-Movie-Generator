<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="css/styles.css">
	<title>Random Movie Generator</title>
</head>
<body>
<div class="container">
	<h1><?php echo (isset($heading)) ? $heading : $title; ?></h1>
	<img src="<?php echo $image_path ?>" width="400" height="550" alt="Poster">
	<p><?php echo (isset($message)) ? $message : $overview; ?></p>

	<form action="" method="GET">
		<p>Select a year</p>
		<input type="number" name="year" min="1920" max="2015" value="<?php echo $year ?>"><br><br>
		<button type="submit" name="genre" value="35">Comedy</button>
		<button type="submit" name="genre" value="28">Action</button>
		<button type="submit" name="genre" value="18">Drama</button>
	</form>
</div>
</body>
</html>