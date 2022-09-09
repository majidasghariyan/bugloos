<?php

namespace App\Repositories\ApiUsers;

use App\Models\Api_User;
use App\Repositories\ApiUsers\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Yaml\Yaml;
use App\Classes\TeamJsonData;
use App\Classes\TeamsJsonCollection;
use App\Classes\TeamsXMLCollection;
use App\Classes\TeamXMLData;


class UserRepository implements UserRepositoryInterface
{
   //save json data in database 
    public function createUserJson($response)
    {

        $json_response = new TeamJsonData($response);
        $json_response->extractData();
        
        //Parse YAML file and get json mapper from it
        $mapper = Yaml::parseFile(config_path('mappers/team.yaml'))['json'];
        
        //Get teams data and save into database
        $collection = new TeamsJsonCollection($json_response, $mapper);
        $collection->create();
        DB::beginTransaction();
        foreach($collection->teams as $team)
        {
            $team->save();
        }
        DB::commit();
    }

    //save xml data in database
    public function createUserXml($response)
    {

        $xml_response = new TeamXMLData($response);
        $xml_response->extractData();

        //Parse YAML file and get xml mapper from it
        $mapper = Yaml::parseFile(config_path('mappers/team.yaml'))['xml'];

        //Get teams data and save into database
        $collection = new TeamsXMLCollection($xml_response, $mapper);
        $collection->create();
        DB::beginTransaction();
        foreach ($collection->teams as $team) {
            $team->save();
        }
        DB::commit();
        
    }


}