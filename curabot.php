<?php
// username imam_momka_bot | Cura Bot
require_once ('token.php');
$telegram = 'https://api.telegram.org/bot' . $token;
$last_update = 0;

while (true) {
	$update = file_get_contents($telegram."/getupdates?timeout=30&offset=".$last_update);
	$update = json_decode($update, TRUE);
    foreach($update["result"] as $key => $value){
         if ($last_update < $value['update_id']){
            $last_update = $value['update_id'];
            $chat_id= $value["message"]["chat"]["id"];
            $msg = strtolower($value["message"]["text"]);
            if($msg === "/start"){
                answer($telegram, $chat_id, "Otkud ti ovaj broj?");
            } else{
                answer($telegram, $chat_id, "Izvini, ali imam momka");
            }
         }
    }
}


function answer($telegram, $cID, $msg){
	$url = $telegram."/sendMessage?chat_id=".$cID."&text=".urlencode($msg);
	file_get_contents($url);
}

?>