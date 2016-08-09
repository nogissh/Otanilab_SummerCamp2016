<?php
/*////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
上部でPHPの処理，下部でHTMLを出力．
必要に応じてHTMLタグ中でPHPを適用し，変数などを出力．
//////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////*/

function makeEchoTags($event, $name){
  ////
  $trueCount = 0;
  $falseCount = 0;
  $memberList = array();
  ////
  $date = preg_split("/\//", $event[2]);
  if($event[3] == ''){
    $event[3] = "指定なし";
  }
  if($event[4] == ''){
    $event[4] = '指定なし';
  }

  //デフォルトメンバーを取得
  $defaultList = include("eventModules/readMember.php");

  ////メンバーリストを取得
  if($handle = opendir("events/".$name."/member")){
    //echo "into";
    while (false != ($member = readdir($handle))) {
      //echo "into roop";
      if($member != '.' && $member != '..' && $member != '.DS_Store'){
        //echo "into push";
        array_push($memberList, $member);
      }
      //echo "$memberList\n";
    }
  }

  ////
  $entryTrue = "";
  $entryFalse = "";
  if(count($memberList) > 0){
    //参加登録が1人以上いれば処理
    foreach($memberList as $member){
      if($file = file_get_contents('events/'.$name.'/member/'.$member)){
        if(strpos($file, "true") !== false){
          $trueCount += 1;
          $echoTrue = <<<EOT
<div class="entryTrueElement">
  <span>$member</span>
</div>
EOT;
          $entryTrue = $entryTrue.$echoTrue."\n";
        }
        elseif(strpos($file, "false") !== false){
          $falseCount += 1;
          $echoFalse = <<<EOT
<div class="entryFalseElement">
  <span>$member</span>
</div>
EOT;
          $entryFalse = $entryFalse.$echoFalse."\n";
        }
        else{
          echo "into error";
        }
      }
      else{
        //echo "error";
        break;
      }
    }
    if($entryTrue !== ""){
      $trueCount = (string)$trueCount."人";
    }
    if($entryFalse !== ""){
      $falseCount = (string)$falseCount."人";
    }
  }


  ////
  if($entryTrue == ''){
    $entryTrue = <<<EOT
<div style="margin-top: 10px; margin-left: 12px;">
  <span>メンバーはいません</span>
</div>
EOT;
  }
  if($entryFalse == ''){
    $entryFalse = <<<EOT
<div style="margin-top: 10px; margin-left: 12px;">
  <span>メンバーはいません</span>
</div>
EOT;
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
      </div>
      <div class="modal-body" id="modal-body-origin">
        <div class="eventAbout">
          <div class="eventAboutDate">
            <p>開催日： <span>$event[2]</span></p>
          </div>
          <div class="eventAboutDetail">
            <p>$event[1]</p>
          </div>
          <div class="eventAboutCost">
            <p>予算： $event[4]</p>
          </div>
          <hr class="eventAboutHr">
          <div class="eventApplied">
            <div style="padding-left: 15px;">
              <h5 style="float: left;">参加</h5>
              <span style="float: left; margin-top:9px; margin-left: 15px;">$trueCount</span>
            </div>
            <div class="eventAppliedList">
$entryTrue
            </div>
            <div style="margin-top: 15px; padding-left: 15px;">
              <h5 style="float: left;">不参加</h5>
              <span style="float: left; margin-top:9px; margin-left: 15px;">$falseCount</span>
            </div>
            <div class="eventAppliedList">
$entryFalse
            </div>
          </div>
          <hr class="eventAboutHr">
          <div class="eventEntry">
            <h4 class="eventEntryTitle">学籍番号または名前を入力してください</h4>
            <div class="eventParticipationTextPosition">
              <input type="text" name="eventParticipator_$name" value="" maxlength="7" class="eventParticipationText">
            </div>
            <div class="eventEntryButton">
              <input type="radio" name="entry_$name" value="true" id="radioYes_$name">
              <label for="radioYes_$name" class="eventParticipationButtonYes">参加する！</label>
              <input type="radio" name="entry_$name" value="false" class="eventParticipationButtonNo" id="radioNo_$name">
              <label for="radioNo_$name" class="eventParticipationButtonNo">参加しない...</label>
            </div>
            <div class="eventEntrySubmit">
              <button type="submit" name="submitButton" value="eventEntry_$name" class="submitButton" id="entrySubmit_$name">出欠を送信</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="reset" data-dismiss="modal" aria-label="Close" class="btn btn-primary">閉じる</button>
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

//宣言
$eventPath = 'events';
$eventList = array();
$eventEcho = array();

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

//イベントが１件以上なら表示のフロー
//なければない案内を
if(count($eventList) == 0){
  array_push($eventEcho, noEvent());
}
else{
  foreach($eventList as $eventName){
    if($eventName == '.DS_Store'){
      if(count($eventList) == 1){
        array_push($eventEcho, noEvent());
      }
      continue;
    }
    $eventData = file_get_contents($eventPath.'/'.$eventName.'/event.csv', true);
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
