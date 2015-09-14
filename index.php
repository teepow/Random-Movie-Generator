<?php 
	
	//If both fields have values
	if(!empty($_GET["year"]) && !empty($_GET["genre"])) {
		
		//Set year and genre
		$year = $_GET["year"];
		$genre = $_GET["genre"];

		//Include Movie class
		include 'Models/Movie.php';

		//Instantiate new Movie
		$movie = new Movie($genre, $year);

		//Generate random movie
		$movie->setMovie();

		//Set values
		$movie->setOriginalTitle();
		$movie->setOverview();
		$movie->setImagePath();

		//Get values
		$title = $movie->getOriginalTitle();
		$overview = $movie->getOverview();
		$image_path = $movie->getImagePath();

	//If a year was not chosen
	} else if (!empty($_GET["genre"]) && empty($_GET["year"])) {
		
		$message = "Please select a year";
		$heading = "Random Movie Generator";
		$image_path = "Images/no-poster.jpg";

	//No values set
	} else {
		
		$message = "Select a year and then click a genre.";
		$heading = "Random Movie Generator";
		$image_path = "Images/no-poster.jpg";
	}

	//Include view
	include 'Views/show-movie.php';

?>