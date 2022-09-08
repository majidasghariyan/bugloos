<?php

namespace App\Classes;

//Class for handling teams json data in external API response
class TeamJsonData extends JsonData implements DataInterface
{
    //Get teams data as json from the body of response 
    public function extractData()
    {
        $this->data = null;
        if ($this->hasContent() && $this->hasData()) {
            $this->data = $this->content->{config('link.ext_api.data_key')};
        }
    }

    //Check existence of main data key in the body of response
    public function hasData()
    {
        return property_exists($this->content, config('link.ext_api.data_key'));
    }
}
