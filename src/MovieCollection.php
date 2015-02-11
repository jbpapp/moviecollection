<?php namespace Smartbit;

use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Collection;
use Smartbit\Exceptions\InvalidArgumentException;

class MovieCollection implements Jsonable
{

    private $collection;

    public function __construct()
    {
        $this->collection = new Collection;
    }

    public function add($movie)
    {
        if (is_array($movie))
        {
            array_map([$this, 'addMovie'], $movie);
        }

        $this->addMovie($movie);
    }

    public function toJson($options = 0)
    {
        return json_encode($this->collection->toArray(), $options);
    }

    /**
     * Get number of movies in collection
     *
     * @return int
     */
    public function count()
    {
        return $this->collection->count();
    }

    /**
     * @param $movie
     * @throws InvalidArgumentException
     */
    private function addMovie($movie)
    {
        if ( ! $this->collection) $this->collection = new Collection;

        $this->collection->put(str_random(12), $movie);
    }

    /**
     * @return mixed
     */
    public function getCollection()
    {
        return $this->collection;
    }
}