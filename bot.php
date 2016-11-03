<?php
$access_token = 'sn22DbNDh+ShTleIlM7ZXIsiAckFnEelGwl79vpAZCu9A1HuoTEzx1nAr7vl/vxtDCRAEg/MLSjDzUdq0Y/Cj7PViK9uQcyImiGCiJk09Qam0BZ87sd/fp1AAc7+DN0dAI3HgWAy8Gp7APPG4qYblgdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
$myfile = fopen("testfile.txt", "w");
fwrite($myfile, $content);
fclose($myfile);
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	/*foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}*/
}
else
{
	$job=$_GET["job"];
	if($job=="job01")
	{
		//$replytext="ตอบคุณ ".$sourceInfo['displayName']."\n";];
		$pushtext="ได้รับการแจ้งซ่อมจาก ".$_GET["user1"]." อุปกรณ์ ".$_GET["equip"];
		$messages = [
						'type' => 'text',
						'text' =>  $pushtext
					];
		// Make a POST Request to Messaging API to reply to sender
		$url = 'https://api.line.me/v2/bot/message/push';
		$data = [
			'to' => 'C5284c7dfc515bb45cbb338ae3be11356',
			'messages' => [$messages],
		];
		$post = json_encode($data);
		$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		$result = curl_exec($ch);
		curl_close($ch);
		echo $result . "\r\n";
	}
}
echo "OK";

?> 
