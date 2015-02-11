<?php namespace spec\Smartbit;

use Smartbit\Movie;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MovieCollectionSpec extends ObjectBehavior
{
    function it_initializes()
    {
        $this->shouldHaveType('Smartbit\MovieCollection');
    }

    function it_adds_a_movie_to_the_collection(Movie $movie)
    {
        $this->add($movie);
    }

    function it_fetch_the_collection_as_an_array()
    {
        $this->getCollection()->toArray()->shouldBeArray();
    }
}
