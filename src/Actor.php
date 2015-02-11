<?php namespace Smartbit;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

class Actor implements Arrayable, Jsonable
{

    use ValidatorTrait;

    private $name;
    private $dateOfBirth;

    /**
     * Builds a new Actor instance.
     *
     * @param $name
     * @param $dateOfBirth
     */
    public function __construct($name, $dateOfBirth)
    {
        $this->setName($name);
        $this->setDateOfBirth($dateOfBirth);
    }

    public function toArray()
    {
        $items = [
            $this->getName(), $this->getDateOfBirth()
        ];

        return array_map(function($value)
        {
            return $value instanceof Arrayable ? $value->toArray() : $value;

        }, $items);
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    /**
     * Returns the name of the actor.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the name of the actor.
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->validateName($name);

        $this->name = $name;
    }

    /**
     * Returns the actor's birth date.
     *
     * @return string
     */
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }

    /**
     * Sets the actor's birth date.
     *
     * @param string $dateOfBirth
     */
    public function setDateOfBirth($dateOfBirth)
    {
        $this->validateDateOfBirth($dateOfBirth);

        $this->dateOfBirth = $dateOfBirth;
    }

    private function validateName($name)
    {
        $this->validate(
            compact('name'),
            [
                'name' => 'required'
            ],
            [
                'name.required' => 'The name parameter is required.'
            ]
        );
    }

    private function validateDateOfBirth($dateOfBirth)
    {
        $this->validate(
            compact('dateOfBirth'),
            [
                'dateOfBirth' => 'required|date|date_format:Y-m-d'
            ],
            [
                'dateOfBirth.required' => 'The date of birth parameter is required.',
                'dateOfBirth.date' => 'The date of birth parameter should be a valid date.',
                'dateOfBirth.date_format' => 'The date of birth field should have the yyyy-mm-dd format.'
            ]
        );
    }
}
