<?php

namespace App\Classes;

use App\Models\Api_User;

class TeamsXMLCollection extends Collection
{
    public array $teams;

    //Map extracted data to Team models collection based on YAML mapper
    public function create()
    {
        $mapper = $this->mapper;
        $keys = array_keys($mapper);
        $array_indexes = array_keys(array_column($mapper, 'type'), 'array');
        $string_indexes = array_keys(array_column($mapper, 'type'), 'string');
        $date_indexes = array_keys(array_column($mapper, 'type'), 'date');
        $html_indexes = array_keys(array_column($mapper, 'type'), 'html');
        $this->teams = array_map(function ($item) use ($mapper, $keys, $array_indexes, $string_indexes, $date_indexes, $html_indexes) {
            $team = [];
            foreach ($array_indexes as $index) 
            {
                $team[$mapper[$keys[$index]]['key']] = isset($item->{$keys[$index]}) ? json_encode($item->{$keys[$index]}) : null;
            }
            foreach ($string_indexes as $index) 
            {
                $team[$mapper[$keys[$index]]['key']] = isset($item->{$keys[$index]}) ? $item->{$keys[$index]} : null;
            }
            foreach ($date_indexes as $index) 
            {
                $team[$mapper[$keys[$index]]['key']] = isset($item->{$keys[$index]}) ? date('Y-m-d', strtotime($item->{$keys[$index]})) : null;
            }
            foreach ($html_indexes as $index) 
            {
                $team[$mapper[$keys[$index]]['key']] = isset($item->{$keys[$index]}) ? trim(strip_tags($item->{$keys[$index]})) : null;
            }
            return new Api_User($team);
        }, $this->data_object->data);
    }
}