<?php

namespace App\Repositories\ApiUsers;

interface UserRepositoryInterface 
{
    /**
     * 
     * function for json data
     * 
     */
    public function createUserJson($response);

    /**
     * 
     * function for xml data
     * 
     */

    public function createUserXml($response);



}