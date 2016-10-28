<?php
$access_token = 'sn22DbNDh+ShTleIlM7ZXIsiAckFnEelGwl79vpAZCu9A1HuoTEzx1nAr7vl/vxtDCRAEg/MLSjDzUdq0Y/Cj7PViK9uQcyImiGCiJk09Qam0BZ87sd/fp1AAc7+DN0dAI3HgWAy8Gp7APPG4qYblgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

?> 
