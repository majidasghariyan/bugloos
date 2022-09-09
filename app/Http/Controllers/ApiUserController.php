<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Exception;
use App\Classes\TeamJsonData;
use App\Classes\TeamsJsonCollection;
use App\Classes\TeamsXMLCollection;
use App\Classes\TeamXMLData;

use Symfony\Component\Yaml\Yaml;
use App\Repositories\ApiUsers\UserRepositoryInterface;

class ApiUserController extends Controller
{

     /**
     * Variable to hold injected dependency
     */

    private $repository;

    /**
     * 
     * Initializing the instances and variables
     *
     */
  
    public function __construct(UserRepositoryInterface $userRepository){
      $this->repository = $userRepository;
    }

    /**
     * 
     *  get json data from api  
     * 
     */

    public function jsonIndex()
    {
        try
        {
            $response = Http::get(config('link.ext_api.url'));

            $this->repository->createUserJson($response);

            return 'successful';

        } catch (Exception $exc) {
            DB::rollBack();
            return 'failed';
        }
        
    }

    /**
     * 
     * get xml data from api 
     * 
     */

    public function xmlIndex()
    {
        try
        {
            //Get response from external API and extract xml from it
            $response = Http::get(config('link.ext_api.url') . '.xml');

            $this->repository->createUserXml($response);

            return 'successful';
        } 
        catch (Exception $exc) 
        {
            DB::rollBack();
            return 'failed';
        }
    }

}
