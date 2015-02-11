<?php namespace Smartbit;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class Movie implements Arrayable, Jsonable
{
    use ValidatorTrait;

    private $title;
    private $description;
    private $characters;

    /**
     * @param string $title
     * @param string $description
     * @param array $characters
     */
    public function __construct($title, $description, $characters)
    {
        $this->setTitle($title);
        $this->setDescription($description);
        $this->setCharacters($characters);
    }

    /**
     * Get all actors from the movie as a collection
     *
     * @return Illuminate\Support\Collection
     */
    public function getActors()
    {
        $actors = new Collection;
        $now = Carbon::now();
        foreach ($this->getCharacters() as $character => $actor)
        {
            $age = Carbon::createFromFormat('Y-m-d', $actor->getDateOfBirth())->diffInYears($now);
            $actorWithAge = ['name' => $actor->getName(), 'date-of-birth' => $actor->getDateOfBirth(), 'age' => $age];
            $actors->put(snake_case($actor->getName()), $actorWithAge);
        }

        return $actors;
    }

    /**
     * Get all actors from the movie as a collection ordered by their age descending
     *
     * @return Illuminate\Support\Collection
     */
    public function getActorsByAgeDescending()
    {
        return $this->getActors()->sortByDesc('age');
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $items = [
            $this->getTitle(), $this->getDescription(), $this->getCharacters()
        ];

        return array_map(function($value)
        {
            return $value instanceof Arrayable ? $value->toArray() : $value;

        }, $items);
    }

    /**
     * @param int $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->validateTitle($title);

        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->validateDescription($description);

        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getCharacters()
    {
        return $this->characters;
    }


    /**
     * Add characters to the movie.
     *
     * @param $characters
     * @throws InvalidArgumentException
     */
    public function setCharacters($characters)
    {
        if ( ! is_array($characters))
            throw new InvalidArgumentException('The function accepts an array as argument.', null);

        foreach ($characters as $character => $actor)
        {
            $this->setCharacter($character, $actor);
        }
    }

    private function setCharacter($character, $actor)
    {
        if ( ! $this->getCharacters()) $this->characters = new Collection;

        $this->characters->put($character, $actor);
    }

    private function validateTitle($title)
    {
        $this->validate(
            compact('title'),
            [
                'title' => 'required'
            ],
            [
                'title.required' => 'The title parameter is required.'
            ]
        );
    }

    private function validateDescription($description)
    {
        $this->validate(
            compact('description'),
            [
                'description' => 'required'
            ],
            [
                'description.required' => 'The description parameter is required.'
            ]
        );
    }
}
