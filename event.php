<?php
/*////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
上部でPHPの処理，下部でHTMLを出力．
必要に応じてHTMLタグ中でPHPを適用し，変数などを出力．
//////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////*/
//eventModulesディレクトリ有無の確認
//$moduelCheck = include('eventModules/readFile.php');
//if(!$moduleCheck){ exit('ERROR: Directory "eventModules" does not exist.');}

//初期変数
$thisPage = 'event.php';
$pageTitle = '出欠確認システム - Otanilab Project';
$copyRight = 'Toshiki Ohnogi, Noriko Otani';

//現在取得
date_default_timezone_set('Asia/Tokyo');  //タイムゾーンを指定
$nowDate = date(Y-m-d);
$nowYear = date(Y);
$nowMonth = date(m);
$nowDay = date(d);

//最初の処理

//モードの読み込み
$mode = $_POST['submitButton'];
if($mode == ''){
  //modeなしなら何もしない
}
elseif($mode == 'newCreate'){
  //イベント作成
  include('eventModules/eventCreate.php');
}
elseif(strpos($mode, 'eventEntry') !== false){
  //イベント参加処理
  include('eventModules/eventEntry.php');
}
elseif($mode == 'rootControl'){
  //システム管理者
}
elseif($mode == 'newMember'){
  $studentNumber = $_POST['newMemberNumber'];
  $familyName = $_POST['newMemberFamily'];
  $firstName = $_POST['newMemberFirst'];
  $newMail = $_POST['newMemberMail'];

  $handle = fopen('members/'.$studentNumber, "w");
  fwrite($handle, $familyName."\n");
  fwrite($handle, $firstName."\n");
  fwrite($handle, $newMail."\n");
  fclose($handle);
}
elseif($mode == 'deleteEvent'){
  $target = $_POST['listEvent'];
}
elseif($mode == 'deleteMember'){
  $target = $_POST['defaultMember'];
  unlink('members/'.$target);
}

//
$eventEcho = include('eventModules/eventEcho.php');
/*////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
PHPここまで，
//////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////*/
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" href="styles/css/animate.css">
<link rel="stylesheet" href="styles/css/jquery-ui.css">
<link rel="stylesheet" href="styles/css/bootstrap.min.css">
<link rel="stylesheet" href="styles/css/style.css">
<script src="styles/js/jquery-1.9.1.min.js"></script>
<script src="styles/js/animatedModal.min.js"></script>
<script src="styles/js/jquery-ui.min.js"></script>
<script src="styles/js/jquery.ui.datepicker-ja.min.js"></script>
<script src="styles/js/bootstrap.min.js"></script>
<script src="styles/js/readmore.js"></script>
<script src="styles/js/myScript.js"></script>
<title><?php echo $pageTitle; ?></title>
</head>
<body>
<form action="event.php" method="post" id="eventForm">
<div id="header">
  <div id="header_body">
    <div id="header_title">
      <h1 id="pageGeneralTitle">イベント出欠確認システム</h1>
    </div>
    <div id="header_button">
      <button type="button" name="newCreateButton" data-toggle="modal" data-target="#myModal" id="newCreateButton">イベント作成</button>
      <button type="button" name="rootControl" data-toggle="modal" data-target="#rootModal" id="rootControlButton">>_</button>
    </div>
  </div>
</div>
<!-- イベント作成画面 -->
<div class="modal fade" id="myModal">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">イベントを作成する</h4>
</div>
<div class="modal-body" id="modal-body-origin">
  <h3 class="newCreateTitleBig">作成者情報を入力</h3>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">あなたの名前　<span class="inputMust">※必須</span></h5>
    <input type="text" name="newEventMaster" value="" id="newCreateEventMaster" class="newCreateTextNarrow">
  </div>
  <hr class="newCreateHr">
  <h3 class="newCreateTitleBig">タイトルと説明文を入力</h3>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">イベント名 <span class="inputMust">※必須</span></h5>
    <input type="text" name="newEventName" maxlength="20" value=""  id="newCreateEventTitle" class="newCreateText">
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">詳細 <span class="inputMust">※必須</span></h5>
    <textarea name="newEventDetail" id="newCreateEventDetail" class="newCreateDetail"></textarea>
  </div>
  <hr class="newCreateHr">
  <h3 class="newCreateTitleBig">追加情報の入力</h3>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">日時 <span class="inputMust">※必須</span></h5>
    <span>候補1：</span><input type="text" name="newEventDate" style="text-align: right;" id="newCreateEventDate" class="newCreateTextNarrow"><br>
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">予算</h5>
    <input type="text" name="newEventCost" value="" style="text-align: right;" class="newCreateTextNarrow">
    <span>円</span>
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">場所</h5>
    <input type="text" name="newEventPlace" maxlength="60" value="" class="newCreateText">
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">URL</h5>
    <input type="text" name="newEventUrl" maxlength="200" value="" class="newCreateText">
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">申請締切日</h5>
    <input type="text" name="newEventLimit" style="text-align: right;" id="newCreateEventLimitDate" class="newCreateTextNarrow">
  </div>
  <hr class="newCreateHr">
  <div class="newCreateSelectbox">
    <h5>メールを送信</h5>
    <select name="mail2send" class="form-control">
      <option value="noSend">メールを送信しない</option>
      <option value="otanilab">大谷研究室全体</option>
      <option value="s-otanilab">卒研生宛</option>
      <option value="j-otanilab">事例研生宛</option>
    </select>
  </div>
  <div id="newCreateSubmit">
    <button type="submit" name="submitButton" value="newCreate" class="submitButton" id="confirmCreateButton">イベントを作成</button>
  </div>
</div>
<div class="modal-footer">
  <button type="reset" name="submitButton" data-dismiss="modal" aria-label="Close" class="btn btn-primary">閉じる</button>
</div>
<script>
function checkCreateSubmit() {
  var titleValue = parseInt((document.forms.eventForm.newCreateEventTitle.value).length);
  var detailValue = parseInt((document.forms.eventForm.newCreateEventDetail.value).length);
  var dateValue = parseInt((document.forms.eventForm.newCreateEventDate.value).length);
  var masterValue = parseInt((document.forms.eventForm.newCreateEventMaster.value).length);

  if(titleValue > 0 && detailValue > 0 && dateValue > 0 && masterValue > 0){
    console.log("into");
    $("#confirmCreateButton").prop("disabled", false);
  }
  else{
    $("#confirmCreateButton").prop("disabled", true);
  }
  //&& detailValue > 0 && dateValue > 0 && limitdateValue > 0
}
//
setInterval('checkCreateSubmit()', 1);
</script>
</div>
</div>
</div>
<!-- 管理者ページ -->
<div class="modal fade" id="rootModal">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">管理者用</h4>
</div>
<div class="modal-body" id="modal-body-origin">
<?php
//宣言
$eventList = array();

//ファイルの読み込み
if($handle = opendir("events")){
  //echo "Directory handle: $handle\n";
  //echo "Files:\n";

  while (false != ($file = readdir($handle))) {
    if($file != '.' && $file != '..' && $file != '.DS_Store'){
      //echo $file;
      array_push($eventList, $file);
    }
    //echo "$file\n";
  }

  //逆順にする
  $eventList = array_reverse($eventList, true);
}

//optionタグ生成
$echoOption = "";
foreach($eventList as $name){
  $handle = file_get_contents("events/".$name."/event.csv");
  $event = preg_split("/\n/", $handle); //改行で項目区切り
  $echoOption = $echoOption.'<option value="'.$name.'">'.$event[0].'</option>'."\n";
}

//タグを吐き出し
echo <<<EOT
<div>
  <h4>イベントを削除する</h4>
</div>
<div>
  <select size="8" name="listEvent">
$echoOption
  </select>
  <button type="submit" name="submitButton" value="deleteEvent">削除する</button>
</div>
EOT;
////////////////////////
////////////////////////
//宣言
$memberList = array();

//ファイルの読み込み
if($handle = opendir("members")){
  //echo "Directory handle: $handle\n";
  //echo "Files:\n";

  while (false != ($file = readdir($handle))) {
    if($file != '.' && $file != '..' && $file != '.DS_Store'){
      //echo $file;
      array_push($memberList, $file);
    }
    //echo "$file\n";
  }

  //逆順にする
  $memberList = array_reverse($memberList, true);
}

//optionタグ生成
$echoOption = "";
foreach($memberList as $name){
  $file = file_get_contents('members/'.$name);
  $info = preg_split("/\n/", $file); //改行で項目区切り
  $echoOption = $echoOption.'<option value="'.$name.'">'.$info[0].$info[1].'</option>'."\n";
}


//タグを吐き出し
echo <<<EOT
<div>
  <h5>デフォルトメンバーの管理</h5>
  <select size="8" name="defaultMember">
$echoOption
  </select>
  <button type="submit" name="submitButton"  value="deleteMember">除名</button>
  <h5>メンバーの追加</h5>
  <span>学籍番号</span><input type="text" name="newMemberNumber" class="newCreateTextNarrow"><br>
  <span>姓</span><input type="text" name="newMemberFamily" class="newCreateTextNarrow"><br>
  <span>名</span><input type="text" name="newMemberFirst" class="newCreateTextNarrow"><br>
  <span>メールアドレス</span><input type="text" name="newMemberMail" class="newCreateTextNarrow"><br>
  <button type="submit" name="submitButton" value="newMember">追加</button>
</div>
EOT;

 ?>
</div>
<div class="modal-footer">
  <button type="reset" name="submitButton" data-dismiss="modal" aria-label="Close" class="btn btn-primary">閉じる</button>
</div>
</div>
</div>
</div>
<!-- イベント一覧 -->
<div id="content_main">
<?php
  foreach($eventEcho as $echo){
    echo $echo;
  }
 ?>
</div>
<!-- 権利など -->
<div id="footer">
  <div id="footerCopyright">
    <small id="copyright">© Otani-lab Project (<?php echo $copyRight; ?>)</small>
  </div>
</div>
</form>
</body>
</html>
