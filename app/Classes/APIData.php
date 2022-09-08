<?php

namespace App\Classes;

use Illuminate\Http\Client\Response;

//Parent of all external API's responses
class APIData
{
    protected $response;
    protected $content;
    public $data;

    //Constructor save response data for child classes
    public function __construct(Response $response)
    {
        $this->response = $response;
        $this->content = $response->object();
    }

    //Checking of successful request and non empty response existence
    protected function hasContent()
    {
        return ($this->response->ok() && ($this->response->body() <> ''));
    }
}
