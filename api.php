
<?php
$image_url = 'https://rangs.manageprojects.in/img/1.jpeg';

if(isset($_GET['image']))
{
    $image_url = $_GET['image'];
}
 
 echo '<img src="'.$image_url.'" height="200" width="300">';
$api_credentials = array(
    'key' => 'acc_4cdc71d527cb61f',
    'secret' => '910c3173e666148670a889a123049494'
);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.imagga.com/v2/tags?image_url='.urlencode($image_url));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_USERPWD, $api_credentials['key'].':'.$api_credentials['secret']);

$response = curl_exec($ch);
curl_close($ch);

$json_response = json_decode($response);
/// echo "<pre>";
//print_r($json_response);
//var_dump($json_response);

echo "<br>";
echo "<h3>Tag</h3>";
if(!empty($json_response))
{
    $resutl = $json_response->result;
    
    if(!empty($resutl->tags))
    {
        foreach($resutl->tags as $key => $data)
        {
            echo $data->tag->en.",  ";
        }
    }
}



 
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.imagga.com/v2/colors");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_USERPWD, $api_credentials['key'].':'.$api_credentials['secret']);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, 1);
$fields = [
    'image' => new \CurlFile($image_url, 'image/jpeg', 'image.jpg')
];
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);

$response = curl_exec($ch);
curl_close($ch);

$json_response = json_decode($response);
echo "<br>";
echo "<h3>Colors</h3>";
if(!empty($json_response))
{
    $resutl = $json_response->result;
    
    if(!empty($resutl->colors))
    {
        foreach($resutl->colors as $key => $data)
        {
            if(is_array($data) && !empty($key))
            {
                echo "<h5>". str_replace("_"," ",$key)."</h5>";
            
            
                foreach($data as $keyy => $datas)
                {
                    echo $datas->closest_palette_color_parent.",  ";
                }
            } 
            
            echo "<br>";
        }
    }
}

