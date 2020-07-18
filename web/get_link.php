<?php
if(isset($_GET['site_id']) && !empty($_GET['site_id'])) $site_id = $_GET['site_id'];
else die('Error Site ID');

$token = "46su045no9rtx60xr1li9yb97847e1snnpk24"; //Ваш API ключ
$url = base64_decode("aHR0cHM6Ly9pYi1hcGkub25saW5lL2FwaV92MS9nZXRfcGFydG5lcl9saW5rLw==")."/".$token."/".$site_id;
if(!file_exists(md5($url).'.json')||filectime(md5($url).'.json')<time()-5*60){
    $urldata = file_get_contents($url);
    if($urldata)if(!file_put_contents(md5($url).'.json',$urldata)) die("File write error (create file '".md5($url).".json' with 666 permission)");
}
$urldata = json_decode(file_get_contents(md5($url).'.json'),1);
if(isset($urldata['link'])) {
    $params = array();
    if(isset($_GET['subid']) && !empty($_GET['subid'])) $params["subid"] = $_GET['subid'];
    if(isset($_GET['tds_subid']) && !empty($_GET['tds_subid'])) $params["tds_subid"] = $_GET['tds_subid'];
    header("Location: " . $urldata['link'] ."&". http_build_query($params));
} else die('Error');
