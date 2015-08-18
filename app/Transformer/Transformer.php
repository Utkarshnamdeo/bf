<?php namespace App\Transformer;

abstract class Transformer{

    abstract function transform($item);

    public function transformCollection(array $collection)
    {
        return array_map([$this, 'transform'], $collection);
    }

}

