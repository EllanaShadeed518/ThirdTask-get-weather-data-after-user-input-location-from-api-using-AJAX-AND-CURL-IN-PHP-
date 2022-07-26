<?php
$API_KEY="b3aaf699260ae84eedc6580f158f7e7e";
//$API_URL="http://api.openweathermap.org/data/2.5/forecast?lat=60.99&lon=30.9&dt=1586468027&appid=b3aaf699260ae84eedc6580f158f7e7e";
$API_URL="api.openweathermap.org/data/2.5/forecast?lat=".$_POST['lat']."&lon=".$_POST['long']."&lang=en&appid=".$API_KEY;

//PHP can be used to make HTTP requests using the cURL library
$ch=curl_init();//Initialize a cURL session/ch for “cURL handle

curl_setopt($ch,CURLOPT_HEADER,false);//The curl_setopt() function is used to set the curl value//false to not  include the header in the output.
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//true to return the transfer as a string of the return value of curl_exec() instead of outputting it directly.
curl_setopt($ch,CURLOPT_URL,$API_URL);//set cUrl option 
curl_setopt($ch,CURLOPT_FOLLOWLOCATION,TRUE);//true to follow any "Location: " header that the server sends as part of the HTTP header
curl_setopt($ch,CURLOPT_VERBOSE,FALSE);//true to output verbose information.
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,FALSE);//false to stop cURL from verifying the peer's certificate
$RESPONSE=curl_exec($ch);//Execute the given cURL session.
//This function should be called after initializing a cURL session and all the options for the session are set.
curl_close($ch);//Closes a cURL session and frees all resources

$DATA=json_decode($RESPONSE);//to convert json object to php object
$output['data']=$DATA;
header('Content-Type: application/json; charset=UTF-8');
echo json_encode($output);//to make json object
exit;
?>

