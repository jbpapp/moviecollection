<?php

namespace spec\Smartbit;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ActorSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(
            'Tim Robbins', '1958-10-18'
        );
        $this->shouldHaveType('Smartbit\Actor');
    }

    function it_fetches_the_name_of_the_actor()
    {
        $this->getName()->shouldBe('Tim Robbins');
    }

    function it_fetches_the_date_of_birth_of_the_actor()
    {
        $this->getDateOfBirth()->shouldBe('1958-10-18');
    }

    function it_throws_an_exception_when_the_name_is_invalid()
    {
        $this->shouldThrow('Smartbit\Exceptions\InvalidArgumentException')->duringSetName(null);
    }

    function it_throws_an_exception_when_the_birth_date_is_invalid()
    {
        $this->shouldThrow('Smartbit\Exceptions\InvalidArgumentException')->duringSetDateOfBirth(null);
        $this->shouldThrow('Smartbit\Exceptions\InvalidArgumentException')->duringSetDateOfBirth('Tim Robbins');
    }
}
