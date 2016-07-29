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

//モードの読み込み
$mode = $_POST['submitButton'];
if($mode == ''){
  //modeなしなら何もしない
}
elseif($mode == 'newCreate'){
  //イベント作成
  include('eventModules/createEvent.php');
}
elseif($mode == 'rootControl'){
  //システム管理者
}
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
<link rel="stylesheet" href="styles/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styles/css/style.css">
<link rel="stylesheet" href="styles/css/jquery-ui.css">
<script src="styles/js/jquery-1.9.1.min.js"></script>
<script src="styles/js/jquery-ui.min.js"></script>
<script src="styles/js/jquery.ui.datepicker-ja.min.js"></script>
<script src="styles/js/bootstrap.min.js"></script>
<script>
$(function() {
  $("#datepickerOne").datepicker();
});
$(function() {
  $("#datepickerTwo").datepicker();
});
$(function() {
  $("#datepickerThree").datepicker();
});
</script>
<title><?php echo $pageTitle; ?></title>
</head>
<body>
<form action="event.php" method="post">
<div id="header">
  <div id="header_body">
    <div id="header_title">
      <h1 id="pageGeneralTitle">イベント出欠確認システム</h1>
    </div>
    <div id="header_button">
      <button type="button" name="new_create_button" data-toggle="modal" data-target="#myModal" id="newCreateButton">イベント作成</button>
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
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">イベント名 <span class="inputMust">※必須</span></h5>
    <input type="text" name="newEventName" value="" class="newCreateText">
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">詳細 <span class="inputMust">※必須</span></h5>
    <textarea name="newEventDetail" class="newCreateDetail"></textarea>
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">日時または候補 <span class="inputMust">※「候補1」は必須</span></h5>
    <span>候補1: </span>
    <input type="text" name="newEventDate1" id="datepickerOne" class="newCreateScheduleDate"><br>
    <span>候補2: </span>
    <input type="text" name="newEventDate2" id="datepickerTwo" class="newCreateScheduleDate"><br>
    <span>候補3: </span>
    <input type="text" name="newEventDate3" id="datepickerThree" class="newCreateScheduleDate"><br>
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">予算</h5>
    <input type="text" name="newEventCost" value="" class="newCreateText">
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">場所</h5>
    <input type="text" name="newEventPlace" value="" class="newCreateText">
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">URL</h5>
    <input type="text" name="newEventUrl" value="" class="newCreateText">
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">作成者</h5>
    <input type="text" name="newEventMaster" value="" class="newCreateText">
  </div>
</div>
<div class="modal-footer">
  <button type="submit" name="submitButton" value="newCreate" class="btn btn-primary">作成</button>
</div>
</div>
</div>
</div>
<!-- イベント一覧 -->
<div id="content_main">
</div>
<!-- 権利など -->
<div id="copyright">
<small>© Otani-lab Project (<?php echo $copyRight; ?>)</small>
</div>
</form>
</body>
</html>
