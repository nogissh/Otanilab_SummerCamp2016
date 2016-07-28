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

//現在取得
$nowDate = date(Y/m/d);
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
  $title  = $_POST['newEventName'];
  $master = $_POST['newEventMaster'];
  $detail = $_POST['newEventDetail'];

}
elseif($mode == 'rootControl'){
  //システム管理者
}

//イベントの読み込み

//初期変数
$thisPage = 'event.php';
$pageTitle = '出欠確認システム - Otanilab Project';
$copyRight = 'Toshiki Ohnogi, Noriko Otani';
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
<script src="styles/js/jquery-1.9.1.min.js"></script>
<script src="styles/js/bootstrap.min.js"></script>
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
    <h5 class="newCreateTitle">イベントの名前</h5>
    <input type="text" name="newEventName" value="" class="newCreateText">
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">イベント作成者</h5>
    <input type="text" name="newEventMaster" value="" class="newCreateText">
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">イベントの日時</h5>
<?php
//Year
echo '      <select name="eventYear">'."\n";
for($y = $nowYear; $y < $nowYear + 5; $y++){
  if($y == $nowYear){
    $selected = ' selected';
  }
  else{
    $selected = '';
  }
  echo '        <option value="'.$y.'"'.$selected.'>'.$y.'</option>'."\n";
}
echo '      </select>'."\n";

//Month
echo '      <select name="eventMonth">'."\n";
for($m = 1; $m < 12 + 1; $m++){
  if($m == $nowMonth){
    $selected = ' selected';
  }
  else{
    $selected = '';
  }
  echo '        <option value="'.$m.'"'.$selected.'>'.$m.'</option>'."\n";
}
echo '      </select>'."\n";

//Day
echo '      <select name="eventDay">'."\n";
for($d = 1; $d < 31 + 1; $d++){
  if($d == $nowDay){
    $selected = ' selected';
  }
  else{
    $selected = '';
  }
  echo '        <option value="'.$d.'"'.$selected.'>'.$d.'</option>'."\n";
}
echo '      </select>'."\n";
 ?>
  </div>
  <div class="newCreateLayout">
    <h5 class="newCreateTitle">イベントの詳細</h5>
    <textarea name="newEventDetail" class="newCreateDetail"></textarea>
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
