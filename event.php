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

//
$eventEcho = include('eventModules/echoEvent.php');
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
<link rel="stylesheet" href="styles/css/jquery-ui.css">
<link rel="stylesheet" href="styles/css/bootstrap.min.css">
<link rel="stylesheet" href="styles/css/style.css">
<script src="styles/js/jquery-1.9.1.min.js"></script>
<script src="styles/js/jquery-ui.min.js"></script>
<script src="styles/js/jquery.ui.datepicker-ja.min.js"></script>
<script src="styles/js/bootstrap.min.js"></script>
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
    <input type="text" name="newEventDate" style="text-align: right;" id="newCreateEventDate" class="newCreateTextNarrow"><br>
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
</div>
<div class="modal-footer">
  <button type="submit" name="submitButton" value="newCreate" id="confirmCreateButton" class="btn btn-primary">作成</button>
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
