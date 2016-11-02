<?php
$access_token = '6AHZeq++0ib7lwzyTgJJdOJON151Ugy/L3EXVepD5tBAj/MhR5iwoQxufCbcEyGXjVP7YP7xLAOeNDCKeoLmtpaIt1dxiuz+Hs5oYxOMTPQ4I61ttgUzX10Dc3ofzQ8BEYxql2nC1c23Wy9TRpIL+QdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
//$myfile = fopen("testfile.txt", "w");
//fwrite($myfile, $content);
//fclose($myfile);
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) 
{
	// Loop through each event
	foreach ($events['events'] as $event) 
	{
		
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') 
		{
			
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			$textArr=explode(" ",$text);
			if(strtoupper($textArr[0])=="ROBOT")
			{
				/*
				$userId=$event['source']['userId'];
				$url = 'https://api.line.me/v2/bot/profile/'.$userId;
				$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				curl_close($ch);
				$sourceInfo = json_decode($result, true);
				*/
				if(strtoupper($textArr[1])=="HY")
				{
					switch(strtoupper($textArr[2]))
					{
						case "Z3" :
							$content_scada = file_get_contents('http://118.175.86.109/line/q.php?z=z3');
							$scada_data = json_decode($content_scada, true);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext="����§ҹ�����Ţͧ�ç��ͧ 1500 ź.�./��.(z3) ʶҹտ���ʧ � ".$scada_data['DateTimeZ3']." �ѧ���\n";
							$replytext.="1. �дѺ��Ӷѧ����ʢ�Ҵ 3,000 ź.�. ��� ".number_format($scada_data['Z3HY_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z3HY_LE1_PV'],2)." ����\n";
							$replytext.="2. �س�Ҿ��� pH ".$scada_data['Z3HY_PH']." ������� ".number_format($scada_data['Z3HY_TB'],2)." NTU ����չ������� ".number_format($scada_data['Z3HY_CL'],2)." mg/l";
							$messages = [[
								'type' => 'text',
								'text' =>  $replytext
								]];
												
							break;
						case "Z4" :
							$content_scada = file_get_contents('http://118.175.86.109/line/q.php?z=z4');
							$scada_data = json_decode($content_scada, true);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext="����§ҹ�����Ţͧ�ç��ͧ 2000 ź.�./��. (z4) ʶҹտ���ʧ � ".$scada_data['DateTimeZ4']." �ѧ���\n";
							$replytext.="1. �س�Ҿ��� pH ".number_format($scada_data['Z4HY_PH'],2)." ������� ".number_format($scada_data['Z4HY_TB'],2)." NTU ����չ������� ".number_format($scada_data['Z4HY_CL'],2)." mg/l";
							$messages = [[
								'type' => 'text',
								'text' =>  $replytext
								]];
												
							break;
						case "Z6" :
							$content_scada = file_get_contents('http://118.175.86.109/line/q.php?z=z6');
							$scada_data = json_decode($content_scada, true);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext="����§ҹ�����Ţͧ�ç�٧ 1 (z6) ʶҹտ���ʧ � ".$scada_data['DateTimeZ6']." �ѧ���\n";
							$replytext.="1. �ѵ�ҡ�è��� ʨ.�ǹ�ѧ ".number_format($scada_data['Z6HY_FE2_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z6HY_PE2_PV'],2)." ���� �Ţ�ҵâ�� ".$scada_data['Z6HY_FE2_TOT2']."\n";
							$replytext.="2. �ѵ�ҡ�è��� ʨ.��ҹ��� ".number_format($scada_data['Z6HY_FE1_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z6HY_PE1_PV'],2)." ���� �Ţ�ҵâ�� ".$scada_data['Z6HY_FE1_TOT1']."\n";
							$replytext.="3. �дѺ��Ӷѧ����ʢ�Ҵ 3,000 ź.�. ��� ".number_format($scada_data['Z6HY_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z6HY_LE1_PV'],2)." ����\n";
							$replytext.="4. �дѺ��Ӷѧ�٧��Ҵ 250 ź.�. ��� ".number_format($scada_data['Z6HY_LE2_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z6HY_LE2_PV'],2)." ����";
							$messages = [[
								'type' => 'text',
								'text' =>  $replytext
								]];
							break;
						case "Z7" :
							$content_scada = file_get_contents('http://118.175.86.109/line/q.php?z=z7');
							$scada_data = json_decode($content_scada, true);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext="����§ҹ�����Ţͧ�ç�٧ 2 (z7) ʶҹտ���ʧ � ".$scada_data['DateTimeZ7']." �ѧ���\n";
							$replytext.="1. �ѵ�ҡ�è��ª���� �.�ҭ��ǹԪ �Ҵ�˭�-��ӹ��� ".number_format($scada_data['Z7HY_FE1_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z7HY_PE1_PV'],2)." ���� �Ţ�ҵâ�� ".$scada_data['Z7HY_FE1_TOT1']."\n";
							$replytext.="2. �ѵ�ҡ�è��� ʾ.⤡�٧������ ".number_format($scada_data['Z7HY_FE2_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z7HY_PE2_PV'],2)." ���� �Ţ�ҵâ�� ".$scada_data['Z7HY_FE2_TOT2']."\n";
							$replytext.="3. �дѺ��Ӷѧ����ʢ�Ҵ 6,000 ź.�. ��� ".number_format($scada_data['Z7HY_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z7HY_LE1_PV'],2)." ����";
							$messages = [[
								'type' => 'text',
								'text' =>  $replytext
								]];
							break;
						case "Z8" :
							$content_scada = file_get_contents('http://118.175.86.109/line/q.php?z=z8');
							$scada_data = json_decode($content_scada, true);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext="����§ҹ�����Ţͧ�ç�٧ 3 (z8) ʶҹտ���ʧ � ".$scada_data['DateTimeZ8']." �ѧ���\n";
							$replytext.="1. �ѵ�ҡ�è����Ҵ�˭�⫹�٧ ".number_format($scada_data['Z8HY_FE1_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z8HY_PE1_PV'],2)." ���� �Ţ�ҵâ�� ".$scada_data['Z8HY_FE1_TOT1']."\n";
							$replytext.="2. �ѵ�ҡ�è����Ҵ�˭�⫹��� ".number_format($scada_data['Z8HY_FE2_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z8HY_PE2_PV'],2)." ���� �Ţ�ҵâ�� ".$scada_data['Z8HY_FE2_TOT2']."\n";
							$replytext.="3. �ѵ�ҡ�è���ʾ.⤡�٧������� ".number_format($scada_data['Z8HY_FE3_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z8HY_PE3_PV'],2)." ���� �Ţ�ҵâ�� ".$scada_data['Z8HY_FE3_TOT3']."\n";
							$replytext.="4. �дѺ��Ӷѧ����ʢ�Ҵ 3,500 ź.�. ��� ".number_format($scada_data['Z8HY_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z8HY_LE1_PV'],2)." ����";
							$messages = [[
								'type' => 'text',
								'text' =>  $replytext
								]];
							
							break;
						case "Z9" :
							$content_scada = file_get_contents('http://118.175.86.109/line/q.php?z=z9');
							$scada_data = json_decode($content_scada, true);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext="����§ҹ�����Ţͧ�ç�٧ 4 (z9) ʶҹտ���ʧ � ".$scada_data['DateTimeZ9']." �ѧ���\n";
							$replytext.="1. �ѵ�ҡ�è��� ���.ʧ��Ҽ�ҹ��� GRP?800 ��� �.ž����������� ".number_format($scada_data['Z9HY_FE1_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z9HY_PE1_PV'],2)." ���� �Ţ�ҵâ�� ".$scada_data['Z9HY_FE1_TOT1']."\n";
							$replytext.="2. �дѺ��Ӷѧ����ʢ�Ҵ 3,500 ź.�. ��� ".number_format($scada_data['Z9HY_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z9HY_LE1_PV'],2)." ����\n";
							$replytext.="3. �س�Ҿ��� pH ".number_format($scada_data['Z9HY_PH'],2)." ������� ".number_format($scada_data['Z9HY_TB'],2)." NTU ����չ������� ".number_format($scada_data['Z9HY_CL'],2)." mg/l";
							$messages = [[
								'type' => 'text',
								'text' =>  $replytext
								]];
												
							break;
						case "Z11" :
							$content_scada = file_get_contents('http://118.175.86.109/line/q.php?z=z11');
							$scada_data = json_decode($content_scada, true);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext="����§ҹ�����Ţͧʶҹը��¹�Ӻ�ҹ��� (z11) � ".$scada_data['DateTimeZ11']." �ѧ���\n";
							$replytext.="1. �ѵ�ҡ�è��� ����Ѻ ".number_format($scada_data['Z0HY_DC_BP_FE1_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z0HY_DC_BP_PE1_PV'],2)." ���� �Ţ�ҵâ�� ".$scada_data['Z0HY_DC_BP_TOT1']."\n";
							$replytext.="2. �ѵ�ҡ�è��� ��ͨ��� ".number_format($scada_data['Z0HY_DC_BP_FE2_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z0HY_DC_BP_PE2_PV'],2)." ���� �Ţ�ҵâ�� ".$scada_data['Z0HY_DC_BP_TOT2']."\n";
							$replytext.="3. �дѺ��Ӷѧ����ʢ�Ҵ 1,000 ź.�. ��� ".number_format($scada_data['Z0HY_DC_BP_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z0HY_DC_BP_LE1_PV'],2)." ����\n";
							$replytext.="4. �дѺ��Ӷѧ�٧��Ҵ 250 ź.�. ��� ".number_format($scada_data['Z0HY_DC_BP_LE2_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z0HY_DC_BP_LE2_PV'],2)." ����\n";
							$replytext.="5. �س�Ҿ��� ����չ������� ".number_format($scada_data['Z0HY_DC_BP_CL'],2)." mg/l";
							$messages = [[
								'type' => 'text',
								'text' =>  $replytext
								]];
												
							break;
						case "Z12" :
							$content_scada = file_get_contents('http://118.175.86.109/line/q.php?z=z12');
							$scada_data = json_decode($content_scada, true);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext="����§ҹ�����Ţͧʶҹը��¹�ӹ������ (z12) � ".$scada_data['DateTimeZ12']." �ѧ���\n";
							$replytext.="1. �ѵ�ҡ�è��� ����Ѻ ".number_format($scada_data['Z0HY_DC_NM_FE2_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z0HY_DC_NM_PE1_PV'],2)." ���� �Ţ�ҵâ�� ".$scada_data['Z0HY_DC_NM_TOT2']."\n";
							$replytext.="2. �ѵ�ҡ�è��� ��ͨ��� ".number_format($scada_data['Z0HY_DC_NM_FE1_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z0HY_DC_NM_PE2_PV'],2)." ���� �Ţ�ҵâ�� ".$scada_data['Z0HY_DC_NM_TOT1']."\n";
							$replytext.="3. �дѺ��Ӷѧ����ʢ�Ҵ 200 ź.�. ��� ".number_format($scada_data['Z0HY_DC_NM_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z0HY_DC_NM_LE1_PV'],2)." ����\n";
							$replytext.="4. �дѺ��Ӷѧ�٧��Ҵ 100 ź.�. ��� ".number_format($scada_data['Z0HY_DC_NM_LE2_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z0HY_DC_NM_LE2_PV'],2)." ����\n";
							$replytext.="5. �س�Ҿ��� ����չ������� ".number_format($scada_data['Z0HY_DC_NM_CL'],2)." mg/l";
							$messages = [[
								'type' => 'text',
								'text' =>  $replytext
								]];
												
							break;
						case "Z13" :
							$content_scada = file_get_contents('http://118.175.86.109/line/q.php?z=z13');
							$scada_data = json_decode($content_scada, true);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext="����§ҹ�����Ţͧʶҹ������ç�ѹ������� (z13) � ".$scada_data['DateTimeZ13']." �ѧ���\n";
							$replytext.="1. �ç�ѹ����� ".number_format($scada_data['Z0HY_DC_BT_PE1_PV'],2)." ���� �ç�ѹ���͡ ".number_format($scada_data['Z0HY_DC_BT_PE2_PV'],2)." ����";
							$messages = [[
								'type' => 'text',
								'text' =>  $replytext
								]];
												
							break;
						case "Z14" :
							$content_scada = file_get_contents('http://118.175.86.109/line/q.php?z=z14');
							$scada_data = json_decode($content_scada, true);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext="����§ҹ�����Ţͧʶҹը��¹�Ӥǹ�ѧ (z14) � ".$scada_data['DateTimeZ14']." �ѧ���\n";
							$replytext.="1. �ѵ�ҡ�è��� ��ͨ��� ".number_format($scada_data['Z14KL_FE1_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z14KL_PE1_PV'],2)." ���� �Ţ�ҵâ�� ".$scada_data['Z14KL_FE1_TOT']."\n";
							$replytext.="2. �дѺ��Ӷѧ����ʢ�Ҵ 1500 ź.�. ��� ".number_format($scada_data['Z14KL_LE2_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z14KL_LE2_PV'],2)." ����\n";
							$replytext.="3. �дѺ��Ӷѧ�٧��Ҵ 300 ź.�. ��� ".number_format($scada_data['Z14KL_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z14KL_LE1_PV'],2)." ����";
							$messages = [[
								'type' => 'text',
								'text' =>  $replytext
								]];
												
							break;
						
						default :
					
							//$replytext="���ʴդ�Ѻ ".$sourceInfo['displayName']." ������ Robot �Ф�Ѻ\n";
							$replytext="���ʴդ�Ѻ ������ Robot �Ф�Ѻ\n";
							$replytext.="㹢�й�������ö�������Ţͧ�Ң��Ҵ�˭���ѧ���\n";
							$replytext.="1. �ç��ͧ 1500 ź.�./��. ʶҹտ���ʧ(z3) ����͡ robot hy z3\n";
							$replytext.="2. �ç��ͧ 2000 ź.�./��. ʶҹտ���ʧ(z4) ����͡ robot hy z4\n";
							$replytext.="3. �ç�٧ 1 ʶҹտ���ʧ(z6) ����͡ robot hy z6\n";
							$replytext.="4. �ç�٧ 2 ʶҹտ���ʧ(z7) ����͡ robot hy z7\n";
							$replytext.="5. �ç�٧ 3 ʶҹտ���ʧ(z8) ����͡ robot hy z8\n";
							$replytext.="6. �ç�٧ 4 ʶҹտ���ʧ(z9) ����͡ robot hy z9\n";
							$replytext.="7. ʶҹը��¹�Ӻ�ҹ���(z11) ����͡ robot hy z11\n";
							$replytext.="8. ʶҹը��¹�ӹ������(z12) ����͡ robot hy z12\n";
							$replytext.="9. Booster Pump �������(z13) ����͡ robot hy z13\n";
							$replytext.="10. ʶҹը��¹�Ӥǹ�ѧ(z14) ����͡ robot hy z14";
							$messages = [[
								'type' => 'text',
								'text' =>  $replytext
								]];
					}	
				}
				elseif(strtoupper($textArr[1])=="SK")
				{
					switch(strtoupper($textArr[2]))
					{
						case "JORM" :
							$content_scada = file_get_contents('http://118.175.86.109/line/q_sk.php?z=Jorm');
							$scada_data = json_decode($content_scada, true);
							$percentLe1=number_format($scada_data['Z1SK_LE1_VOLUME']/12000*100,2);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext="����ҳ����ѹ��� ".$scada_data['DateTime']."\n";
							$replytext.="- ����ҳ��Ӷѧ�����ʧ��Ң�Ҵ 12,000 ź.�. ".$percentLe1."% ��� ".number_format($scada_data['Z1SK_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z1SK_LE1_AINPUT_PV'],2)." ���� �ѵ�ҡ�è���������ͧ ".number_format($scada_data['Z1SK_FE2_AINPUT_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z1SK_PE2_AINPUT_PV'],2)." ����\n";
							$replytext.="- ����ҳ��Ӷѧ����������ç��Ҵ 12,600 ź.�. ��� ".number_format($scada_data['Z2SK_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z2SK_LE1_AINPUT_PV'],2)." ����\n";
							$replytext.="- ����ҳ��Ӷѧ�����⤡�٧��Ҵ 7,000 ź.�. ��� ".number_format($scada_data['Z3NN_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z3NN_LE1_AINPUT_PV'],2)." ����";
							$messages = [[
								'type' => 'text',
								'text' =>  $replytext
								]];					
							break;
						case "Z1" : $content_scada = file_get_contents('http://118.175.86.109/line/q_sk.php?z=z1');
							$tmp=file_get_contents('http://118.175.86.109/line/pumprun.php?z=z1sk');
							file_put_contents("z1sk.jpg", fopen("http://118.175.86.109/line/z1sk.jpg", 'r'));
							resize("z1sk.jpg","thumb_z1sk.jpg",240);
							$scada_data = json_decode($content_scada, true);
							$percentLe1=number_format($scada_data['Z1SK_LE1_VOLUME']/12000*100,2);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext1="�������ç�ٺ����ӹѡ�ҹ ʧ��� � ".$scada_data['DateTime'];
							$replytext2="�дѺ���㹶ѧ��\n";
							$replytext2.="-����ҳ��Ӷѧ�����ʧ��Ң�Ҵ 12,000 ź.�. ��� ".number_format($scada_data['Z1SK_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z1SK_LE1_AINPUT_PV'],2)." ���� �Դ�� ".$percentLe1."%";
							$replytext3="�ѵ�ҡ�è���\n";
							$replytext3.="-����������ͧ ".number_format($scada_data['Z1SK_FE2_AINPUT_PV'],0)." ź.�./��.\n";
							$replytext3.="-���¢�������ç ".number_format($scada_data['Z1SK_FE1_AINPUT_PV'],0)." ź.�./��.\n";
							$replytext3.="-�Ѻ���ŧ�ѧ����� ".number_format($scada_data['Z1SK_FE3_AINPUT_PV'],0)." ź.�./��.";
							$replytext4="�ç�ѹ���鹷��\n";
							$replytext4.="-�ç�ѹ����������ͧ ".number_format($scada_data['Z1SK_PE2_AINPUT_PV'],2)." ����\n";
							$replytext4.="-�ç�ѹ���¢�������ç ".number_format($scada_data['Z1SK_PE1_AINPUT_PV'],2)." ����";
							$messages = [[
									'type' => 'text',
									'text' =>  $replytext1
								],
								[
									'type' => 'text',
									'text' =>  $replytext2
								],
								[
									'type' => 'text',
									'text' =>  $replytext3
								],
								[
									'type' => 'text',
									'text' =>  $replytext4
								],
								[
									'type' => 'image',
									'originalContentUrl' =>  'https://immense-lake-22116.herokuapp.com/z1sk.jpg',
									'previewImageUrl' =>  'https://immense-lake-22116.herokuapp.com/thumb_z1sk.jpg'
								]];
							break;
						case "Z2" :$content_scada = file_get_contents('http://118.175.86.109/line/q_sk.php?z=z2');
							$scada_data = json_decode($content_scada, true);
							$percentLe1=number_format($scada_data['Z2SK_LE1_VOLUME']/12600*100,2);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext1="�����Ŷѧ����������ç � ".$scada_data['DateTime'];
							$replytext2="�дѺ���㹶ѧ��\n";
							$replytext2.="-����ҳ��Ӷѧ����������ç��Ҵ 12,600 ź.�. ��� ".number_format($scada_data['Z2SK_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z2SK_LE1_AINPUT_PV'],2)." ���� �Դ�� ".$percentLe1."%";
							$messages = [[
									'type' => 'text',
									'text' =>  $replytext1
								],
								[
									'type' => 'text',
									'text' =>  $replytext2
								]];
							break;
						case "Z3" :$content_scada = file_get_contents('http://118.175.86.109/line/q_sk.php?z=z3');
							$tmp=file_get_contents('http://118.175.86.109/line/pumprun.php?z=z3nn');
							file_put_contents("z3nn.jpg", fopen("http://118.175.86.109/line/z3nn.jpg", 'r'));
							resize("z3nn.jpg","thumb_z3nn.jpg",240);
							$scada_data = json_decode($content_scada, true);
							$percentLe1=number_format($scada_data['Z3NN_LE1_VOLUME']/7000*100,2);
							$percentLe2=number_format($scada_data['Z3NN_LE2_VOLUME']/250*100,2);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext1="������ʶҹ������ç�ѹ⤡�٧ � ".$scada_data['DateTime'];
							$replytext2="�дѺ���㹶ѧ��\n";
							$replytext2.="-����ҳ��Ӷѧ�����⤡�٧��Ҵ 7,000 ź.�. ��� ".number_format($scada_data['Z3NN_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z3NN_LE1_AINPUT_PV'],2)." ���� �Դ�� ".$percentLe1."%\n";
							$replytext2.="-����ҳ��Ӷѧ�٧⤡�٧��Ҵ 250 ź.�. ��� ".number_format($scada_data['Z3NN_LE2_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z3NN_LE2_AINPUT_PV'],2)." ���� �Դ�� ".$percentLe2."%";
							$replytext3="�ѵ�ҡ�è���\n";
							$replytext3.="-����ŧ�ѧ�����ʧ��� ".number_format($scada_data['Z3NN_FE1_AINPUT_PV'],0)." ź.�./��.\n";
							$replytext3.="-���¾�鹷��⫹�٧ ".number_format($scada_data['Z3NN_FE2_AINPUT_PV'],0)." ź.�./��.\n";
							$replytext3.="-�Ѻ���ŧ�ѧ����� ".number_format($scada_data['Z3NN_FE4_AINPUT_PV'],0)." ź.�./��.";
							$replytext4="�ç�ѹ���鹷��\n";
							$replytext4.="-�ç�ѹ����ŧ�ѧ�����ʧ��� ".number_format($scada_data['Z3NN_PE1_AINPUT_PV'],2)." ����\n";
							$replytext4.="-�ç�ѹ���¨��¾�鹷��⫹�٧ ".number_format($scada_data['Z3NN_PE2_AINPUT_PV'],2)." ����\n";
							$replytext4.="-�ç�ѹ�����ԧ˹�� ".number_format($scada_data['Z3NN_PE3_AINPUT_PV'],2)." ����";
							$messages = [[
									'type' => 'text',
									'text' =>  $replytext1
								],
								[
									'type' => 'text',
									'text' =>  $replytext2
								],
								[
									'type' => 'text',
									'text' =>  $replytext3
								],
								[
									'type' => 'text',
									'text' =>  $replytext4
								],
								[
									'type' => 'image',
									'originalContentUrl' =>  'https://immense-lake-22116.herokuapp.com/z3nn.jpg',
									'previewImageUrl' =>  'https://immense-lake-22116.herokuapp.com/thumb_z3nn.jpg'
								]];
							break;
						case "Z4" :$content_scada = file_get_contents('http://118.175.86.109/line/q_sk.php?z=z4');
							$tmp=file_get_contents('http://118.175.86.109/line/pumprun.php?z=z4th');
							file_put_contents("z4th.jpg", fopen("http://118.175.86.109/line/z4th.jpg", 'r'));
							resize("z4th.jpg","thumb_z4th.jpg",240);
							$scada_data = json_decode($content_scada, true);
							$percentLe1=number_format($scada_data['Z4TH_LE1_VOLUME']/4000*100,2);
							//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
							$replytext1="������ʶҹ������ç�ѹ��ҹҧ��� � ".$scada_data['DateTime'];
							$replytext2="�дѺ���㹶ѧ��\n";
							$replytext2.="-����ҳ��Ӷѧ����ʷ�ҹҧ�����Ҵ 4,000 ź.�. ��� ".number_format($scada_data['Z4TH_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z4TH_LE1_AINPUT_PV'],2)." ���� �Դ�� ".$percentLe1."%";
							$replytext3="�ѵ�ҡ�è���\n";
							$replytext3.="-�����ԧ˹�� ".number_format($scada_data['Z4TH_FE3_AINPUT_PV'],0)." ź.�./��.\n";
							$replytext3.="-�Ѻ��ӷ�� GRP?800 ".number_format($scada_data['Z4TH_FE1_AINPUT_PV'],0)." ź.�./��.\n";
							$replytext3.="-Ѻ��ӷ�� PE?630 ".number_format($scada_data['Z4TH_FE2_AINPUT_PV'],0)." ź.�./��.";
							$replytext4="�ç�ѹ���鹷��\n";
							$replytext4.="-�ç�ѹ�����ԧ˹�� ".number_format($scada_data['Z4TH_PE2_AINPUT_PV'],2)." ����";
							$messages = [[
									'type' => 'text',
									'text' =>  $replytext1
								],
								[
									'type' => 'text',
									'text' =>  $replytext2
								],
								[
									'type' => 'text',
									'text' =>  $replytext3
								],
								[
									'type' => 'text',
									'text' =>  $replytext4
								],
								[
									'type' => 'image',
									'originalContentUrl' =>  'https://immense-lake-22116.herokuapp.com/z4th.jpg',
									'previewImageUrl' =>  'https://immense-lake-22116.herokuapp.com/thumb_z4th.jpg'
								]];
							break;
						default :
							$replytext="㹢�й�������ö�������Ţͧ�Ң�ʧ�����ѧ���\n";
							$replytext.="1. �ç�ٺ����ӹѡ�ҹ ����͡ robot sk z1\n";
							$replytext.="2. �ѧ����������ç ����͡ robot sk z2\n";
							$replytext.="3. ʶҹ������ç�ѹ⤡�٧ ����͡ robot sk z3\n";
							$replytext.="4. ʶҹ������ç�ѹ��ҹҧ��� ����͡ robot sk z4";
							$messages = [[
								'type' => 'text',
								'text' =>  $replytext
								]];
					}
				}
				else
				{
					$replytext="���ʴդ�Ѻ ������ Robot �Ф�Ѻ\n";
					$replytext.="㹢�й�������ö����������ѧ���\n";
					$replytext.="1. �Ң��Ҵ�˭� ����͡ robot hy\n";
					$replytext.="2. �Ң�ʧ��� ����͡ robot sk";
					$messages = [[
						'type' => 'text',
						'text' =>  $replytext
						]];
				}
				
				// Build message to reply back
				/*
				$messages = [
					'type' => 'text',
					'text' =>  $replytext
				];
				*/
				// Make a POST Request to Messaging API to reply to sender
				$url = 'https://api.line.me/v2/bot/message/reply';
				$data = [
					'replyToken' => $replyToken,
					'messages' => $messages,
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
	}
}
else
{
	$content_scada = file_get_contents('http://118.175.86.109/line/q_sk.php?z=Jorm');
	$scada_data = json_decode($content_scada, true);
	//$replytext="�ͺ�س ".$sourceInfo['displayName']."\n";
	$pushtext="����ҳ����ѹ��� ".$scada_data['DateTime']."\n";
	$pushtext.="- ����ҳ��Ӷѧ�����ʧ��Ң�Ҵ 12,000 ź.�. ��� ".number_format($scada_data['Z1SK_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z1SK_LE1_AINPUT_PV'],2)." ���� �ѵ�ҡ�è���������ͧ ".number_format($scada_data['Z1SK_FE2_AINPUT_PV'],0)." ź.�./��. �ç�ѹ ".number_format($scada_data['Z1SK_PE2_AINPUT_PV'],2)." ����\n";
	$pushtext.="- ����ҳ��Ӷѧ����������ç��Ҵ 12,600 ź.�. ��� ".number_format($scada_data['Z2SK_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z2SK_LE1_AINPUT_PV'],2)." ����\n";
	$pushtext.="- ����ҳ��Ӷѧ�����⤡�٧��Ҵ 7,000 ź.�. ��� ".number_format($scada_data['Z3NN_LE1_VOLUME'],0)." ź.�. ���� ".number_format($scada_data['Z3NN_LE1_AINPUT_PV'],2)." ����";
	$messages = [
					'type' => 'text',
					'text' =>  $pushtext
				];
	// Make a POST Request to Messaging API to reply to sender
	$url = 'https://api.line.me/v2/bot/message/push';
	$data = [
		'to' => 'xxxxxxxxxxxxc01',
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
echo "OK";
function resize($images,$new_images,$width)
{
	$size=GetimageSize($images);
	$height=round($width*$size[1]/$size[0]);
	$images_orig = ImageCreateFromJPEG($images);
	$photoX = ImagesX($images_orig);
	$photoY = ImagesY($images_orig);
	$images_fin = ImageCreateTrueColor($width, $height);
	ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
	ImageJPEG($images_fin,$new_images);
	//ImageJPEG($images_fin,$new_images);
	ImageDestroy($images_orig);
	ImageDestroy($images_fin);
}