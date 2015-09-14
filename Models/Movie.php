<?php 

class Movie
{	
	/**
	 * Api url with access token
	 * 
	 * @var string
	 */
	private $tmdb_url_with_access_token = "https://api.themoviedb.org/3/discover/movie?api_key=37c97fc83dcc6d702bbf627a6cd4657c";

	/**
	 * Genre of movie
	 * 
	 * @var String
	 */
	private $genre;

	/**
	 * Year of movie release
	 * 
	 * @var Integer
	 */
	private $primary_release_year;

	/**
	 * Movie title
	 * 
	 * @var String
	 */
	private $original_title;

	/**
	 * Movie summary
	 * 
	 * @var String
	 */
	private $overview;

	/**
	 * Path to image on tmdb website or, if null, default image
	 * 
	 * @var String
	 */
	private $image_path;


	/**
	 * Set genre and primary_release_year values
	 * 
	 * @param  String 	$genre 	Movie genre
	 * 
	 * @param  String 	$primary_release_year 	Movie release year
	 */
	public function __construct($genre, $primary_release_year)
	{
		$this->genre = $genre;

		$this->primary_release_year = $primary_release_year;
	}

	/**
	 * Get a random movie
	 * 
	 * @return array 	random movie
	 */
	public function getRandomMovie()
	{
		$sortBy = $this->getSortBy();

		//Make sure a movie is recieved
		while(empty($results))
		{
			$randomVoteAverage = $this->getRandomVoteAverage();

			$tmdb_url = $this->tmdb_url_with_access_token 
				. "&with_genres=" . $this->genre 
				. "&primary_release_year=" . $this->primary_release_year 
				. "&vote_average.lte=" . $randomVoteAverage
				. "&sort_by=" . $sortBy;

			$tmdb_json = file_get_contents($tmdb_url);

			$tmdb_array = json_decode($tmdb_json, true);

			$results = $tmdb_array["results"];
		}
		
		$count = count($results);

		$randomIndex = $this->getRandomIndex($count);

		$movie = $results[$randomIndex];

		return $movie;
	}

	/**
	 * Set the title
	 * 
	 * @param array $movie movie
	 */
	public function setOriginalTitle($movie)
	{
		$this->original_title = $movie["original_title"];
	}

	/**
	 * Get the title
	 * 
	 * @return string 	original title
	 */
	public function getOriginalTitle()
	{
		return $this->original_title;
	}

	/**
	 * Set the overview
	 * 
	 * @param array $movie movie
	 */
	public function setOverview($movie)
	{
		$this->overview = $movie["overview"];
	}

	/**
	 * Get the overview
	 * 
	 * @return string 	overview
	 */
	public function getOverview()
	{
		return $this->overview;
	}

	/**
	 * Set the image path
	 * 
	 * @param array $movie movie
	 */
	public function setImagePath($movie)
	{
		$this->image_path = ($movie["poster_path"]) ? "http://image.tmdb.org/t/p/original" . $movie["poster_path"] : "Images/no-poster.jpg";
	}

	/**
	 * get the image path
	 * 
	 * @return string 	path to image
	 */
	public function getImagePath()
	{
		return $this->image_path;
	}
	
	/**
	 * Get a random vote average
	 * 
	 * @return float 	random number between 0 and 10
	 */
	private function getRandomVoteAverage()
	{
		$randomVoteAverage = rand(0, 100) / 10;

		return $randomVoteAverage;
	}

	/**
	 * Get a random index value
	 * 
	 * @return integer 	random number between 1 and 19
	 */
	private function getRandomIndex($count)
	{
		$randomIndex = rand(0, ($count - 1));

		return $randomIndex;
	}


	/**
	 * Get a random sort type for the JSON return to add randomness to the results (there is a 20 result limit from tmdb)
	 * 
	 * @return $sortBy 	randomly generated sort parameter
	 */
	private function getSortBy()
	{
		$num = rand(0, 13);

		switch ($num)
		{
			case 0:
				$sortBy = "popularity.asc";

			case 1:
				$sortBy = "popularity.desc";

			case 2:
				$sortBy = "release_date.asc";

			case 3:
				$sortBy = "release_date.desc";

			case 4:
				$sortBy = "revenue.asc";

			case 5:
				$sortBy = "revenue.desc";

			case 6:
				$sortBy = "primary_release_date.asc";

			case 7:
				$sortBy = "primary_release_date.desc";

			case 8:
				$sortBy = "original_title.asc";

			case 9:
				$sortBy = "original_title.desc";

			case 10:
				$sortBy = "vote_average.asc";

			case 11:
				$sortBy = "vote_average.desc";

			case 12:
				$sortBy = "vote_count.asc";

			case 13:
				$sortBy = "vote_count.desc";
		}

		return $sortBy;
	}

}

?>