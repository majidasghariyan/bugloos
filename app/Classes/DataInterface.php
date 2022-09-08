<?php

namespace App\Classes;

/*
An interface that ensures that each specific type of response must
 have its own method for existence checking and extracting data.
 */ 
interface DataInterface
{
    public function extractData();
    public function hasData();
}