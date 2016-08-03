<?php
//
$eventPath = 'events';

//イベントリストの読み込み
if($handle = opendir($eventPath)){
  //echo "Directory handle: $handle\n";
  //echo "Files:\n";

  while (false != ($file = readdir($handle))) {
    if($file != '.' && $file != '..'){
      array_push($eventList, $file);
    }
    //echo "$file\n";
  }

  //逆順にする
  $eventList = array_reverse($eventList, true);
}

if(count($eventList) == 0){
  array_push($eventEcho, noEvent());
}
else{
  foreach($eventList as $eventName){
    $eventData = file_get_contents($eventPath.'/'.$eventName, true);
    //echo 'eventName:'.$eventName."\n";
    //echo 'event:'.$event."\n";
    $event = preg_split("/\n/", $eventData); //改行で項目区切り
    $event[1] = str_replace(",", "<br>", $event[1]); //カンマを改行に変換
    $event[1] = str_replace("#comma", ",", $event[1]); //カンマタグをカンマに変換

    array_push($eventEcho, makeEchoTags($event, $eventName));
  }
}
 ?>
