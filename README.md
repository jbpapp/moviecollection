# Moviecollection test app

## Installation

Clone the repo and install the dependencies with composer:
	
	composer install

## Tests

The classes are unit tested with PHPSPec. You may run the tests via command line:

	vendor/bin/phpspec run

![PHPSPec tests](https://sc-cdn.scaleengine.net/i/84585738e5537776fa539c60c9230741.png 'Tests are green')

## Actor class

	$timRobbins = new Smartbit\Actor('Tim Robbins', '1958-10-18');
	$morganFreeman = new Smartbit\Actor('Morgan Freeman', '1937-06-01');
	echo $timRobbins->getName(); // prints Tim Robbins
	echo $timRobbins->getDateOfBirth(); // prints 1958-10-18
	echo $timRobbins->toJson(); // prints ["Tim Robbins","1958-10-18"]

## Movie class

	$theShawshankRedemption = new Smartbit\Movie(
	    'The Shawshank Redemption',
	    'The best rated movie on IMDB.',
	    [
	        'Andy Dufresne' => $timRobbins,
	        'Ellis Boyd' => $morganFreeman
	    ]
	);
	echo $theShawshankRedemption->getTitle() // prints The Shawshank Redemption
	echo $theShawshankRedemption->getDescription() // prints The best rated movie on IMDB.
	echo $theShawshankRedemption->getCharacters()->first()->getName() // prints Tim Robbins
	echo $theShawshankRedemption->getActorsByAgeDescending()->first()['name']; // prints Morgan Freeman

## MovieCollection class

	$myCollection = new MoviceCollection;
	$myCollection->add($theShawnshankRedemption); // Adds a movie to the collection
	$myCollection->add([$several, $movie, $object]); // Adds several movies to the collection
	echo $myCollection->getCollection()->toJson() // Prints out the collection as JSON
	echo $myCollection->getCollection()->first()->getTitle() // Prints The Shawshank Redemption


