<?php
function makeEchoTags($event, $name){
////
$date = preg_split("/\//", $event[2]);
if($event[3] == ''){
  $event[3] = "指定なし";
}
if($event[4] == ''){
  $event[4] = '指定なし';
}
////

  $echo = <<<EOT
<div class="eventContent" class="wrap" data-toggle="modal" data-target="#myModal_$name">
  <div class="eventHeader">
    <div style="float: left;">
      <h3 class="eventTitle">$event[0]</h3>
    </div>
    <div style="float: right; margin:28px 16px 2px 5px;">
      <span>作成者： $event[5]</span>
    </div>
  </div>
  <hr class="eventCollumHr">
  <div class="eventCollum">
    <div class="eventDate">
      <span>開催日： $date[0]年 $date[1]月 $date[2]日</span>
    </div>
    <div class="eventStatement">
      <p>$event[1]</p>
    </div>
  </div>
  <hr class="eventCollumHr">
  <div class="eventFooter">
    <div style="text-align: right; margin-right: 30px;">
      <span>締切日：$event[3]</span>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal_$name">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">$event[0]</h3>
        <span>$event[5]</span>
      </div>
      <div class="modal-body" id="modal-body-origin">
        <div class="eventAbout">
          <div class="eventAboutDate">
            <p>開催日： <span>$event[2]</span></p>
          </div>
          <div class="eventAboutDetail">
            <p>$event[1]</p>
          </div>
          <hr class="eventAboutHr">
          <div class="eventAboutCost">
            <p>予算： $event[4]</p>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" name="submitButton" value="newCreate" class="btn btn-primary">確認</button>
      </div>
    </div>
  </div>
</div>
EOT;

  //
  $echo = $echo."\n";

  //
  return $echo;
}

function noEvent(){
  $echo = <<<EOT
<div>
  <p>イベントを作成しよう！<p>
</div>
EOT;

  //
  $echo = $echo."\n";

  //
  return $echo;
}

//////////////////////////////////////
//////////////////////////////////////

$eventPath = 'events';
$eventList = array();
$eventEcho = array();
/*
$eventEcho[0] <<<EOT
<div>
~~~
</div>
EOT;
*/
///////////////////////
//ファイルの読み込み
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

//
return $eventEcho;
 ?>
