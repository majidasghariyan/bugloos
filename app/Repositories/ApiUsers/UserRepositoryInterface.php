<?php

namespace App\Repositories\ApiUsers;

interface UserRepositoryInterface 
{
    public function createUserJson($response);

    public function createUserXml($response);



}