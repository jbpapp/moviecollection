<?php

namespace spec\Smartbit;

use Carbon\Carbon;
use Smartbit\Actor;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MovieSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            'The Shawshank Redemption',
            'The best rated movie on IMDB.',
            [
                'Ellis Boyd' => new Actor('Jane Doe', '1986-12-12'),
                'Andy Dufresne' => new Actor('John Doe', '1978-01-03')
            ]
        );
        $this->shouldHaveType('Smartbit\Movie');
    }

    function it_can_fetch_the_title_of_the_movie()
    {
        $this->getTitle()->shouldBe('The Shawshank Redemption');
    }

    function it_can_fetch_the_description_of_the_movie()
    {
        $this->getDescription()->shouldBe('The best rated movie on IMDB.');
    }

    function it_can_fetch_the_actors_from_the_movie_ordered_by_their_age_descending()
    {
        $this->getActorsByAgeDescending()->toArray()->shouldBeArray();
        $this->getActorsByAgeDescending()->fetch('name')->first()->shouldBe('John Doe');
        $this->getActorsByAgeDescending()->fetch('name')->last()->shouldBe('Jane Doe');
    }

    function it_throws_an_exception_when_the_title_is_invalid()
    {
        $this->shouldThrow('Smartbit\Exceptions\InvalidArgumentException')->duringSetTitle(null);
    }

    function it_throws_an_exception_when_the_description_is_invalid()
    {
        $this->shouldThrow('Smartbit\Exceptions\InvalidArgumentException')->duringSetDescription(null);
    }
}
