<?php

namespace App\Classes;

class TeamXMLData extends XMLData implements DataInterface
{
    private $xml_data;

    //Get teams data as converted xml to json from the body of response
    public function extractData()
    {
        $this->data = null;
        $this->xml_data = simplexml_load_string($this->response->body());
        if ($this->hasContent() && $this->hasData()) {
            $xml = $this->xml_data->{config('link.ext_api.data_key')};
            $this->data = json_decode(json_encode($xml))->item;
        }
    }

    //Check existence of main data key in the body of response
    public function hasData()
    {
        return property_exists($this->xml_data, config('link.ext_api.data_key'));
    }
}
