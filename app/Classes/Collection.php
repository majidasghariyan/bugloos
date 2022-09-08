<?php

namespace App\Classes;

abstract class Collection
{
    protected APIData $data_object;
    protected array $mapper;

    //Set child object requirements for convert data to Model collections 
    public function __construct(APIData $data_obj, array $mapper)
    {
        $this->data_object = $data_obj;
        $this->mapper = $mapper;
    }

    /*Abstract function that ensures that each specific type of Model collection
     must have its own method for mapping data to models*/
    public abstract function create();
}