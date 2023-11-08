<?php
namespace App\Helpers;

class ImaggaAPI {

    public $APIKEY;

    public $API_SECRET_KEY;
    
    public $API_TOKEN;

    public $API_URL;

    function __construct()
    {
        $this->APIKEY = 'acc_4cdc71d527cb61f';

        $this->API_SECRET_KEY = '910c3173e666148670a889a123049494';

        $this->API_TOKEN = '';

        $this->API_URL = 'https://api.imagga.com/v2';
        
    }


    public function get_image_colors($image_url, $image_id=0,$list=false)
    { 
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->API_URL.'/colors');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_USERPWD, $this->APIKEY.':'.$this->API_SECRET_KEY);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, 1);
        $fields = [
            'image' => new \CurlFile($image_url, 'image/jpeg', 'image.jpg')
        ];
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

        $response = curl_exec($ch);
        curl_close($ch);

        $json_response = json_decode($response);

        $imageColors = array();
        $imageListColors = array();

        if(!empty($json_response))
        {
            $resutl = $json_response->result;
            
            if(!empty($resutl->colors))
            {
                foreach($resutl->colors as $key => $data)
                {
                    if(is_array($data) && !empty($data))
                    {  
                        foreach($data as $keyy => $datas)
                        {
                            $name = $datas->closest_palette_color_parent;

                            if(!empty($name) && !in_array($name, $imageColors))
                            {
                                $imageColors[] = $name;

                                if($list == true)
                                {
                                    $imageListColors[] = array('image_id' => $image_id, 'name' => $name); 
                                }
                            }
                        }
                    }  
                }
            }
        }

        if($list == true)
        { 
            return $imageListColors;
        }else{
            return $imageColors;
        } 

    }

    public function get_image_design_patterns($image_url, $image_id=0,$list=false)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->API_URL.'/tags?image_url='.urlencode($image_url));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_USERPWD, $this->APIKEY.':'.$this->API_SECRET_KEY);

        $response = curl_exec($ch);
        curl_close($ch);

        $imageTags = array();
        $imageTagsList = array();

        $json_response = json_decode($response);

        if(!empty($json_response))
        {
            $resutl = $json_response->result;
            
            if(!empty($resutl->tags))
            {
                foreach($resutl->tags as $key => $data)
                {
                    $name = $data->tag->en;
                    $imageTags[] = $name;

                    if($list == true)
                    {
                        $imageTagsList[] = array('image_id' => $image_id, 'name' => $name); 
                    }
                }
            }
        } 

        if($list == true)
        { 
            return $imageTagsList;
        }else{
            return $imageTags;
        }  
    }

    public static function instance()
    { 
        return new ImaggaAPI();
    }

}