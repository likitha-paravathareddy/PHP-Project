<?php
require 'vendor/autoload.php';
use MongoDB\Client;
try {
$client=new MongoDB\Client("mongodb://172.18.0.3:27017/?compressors=disabled&gssapiServiceName=mongodb");
$db=$client->darwinbox;
$result=$db->selectCollection("users");

}
catch (Exception $e){
    echo $e;
}
?>