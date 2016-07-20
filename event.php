<?php
//初期変数
$page_url = 'event.php';
$page_title = '出欠確認システム - Otanilab Project';
$copyright = 'Toshiki Ohnogi, Noriko Otani';


//イベントの取得
$contents = 0;


//
content_header($page_title);
content_main();
content_footer($copyright);


//////固定関数
//本体
function content_main(){
//メインコンテンツスタイルの指定開始
echo '<div id="content_main">';
//コンテンツ開始
  //タイトルバーを表示
  content_titlebar();

  //ページ紹介のエリアを出力
  //content_statement();

  //イベント一覧を出力（イベントの数だけ繰り返す）
  //イベントがなければ，その旨を表示する
  if(count($contents) <= 0){
    //イベントがないとき
    content_none();
  }
  elseif (count($contents) > 0) {
    //イベントがあるとき
    content_event();
  }

//コンテンツ終了
//メインコンテンツスタイルの指定終了
echo "</div>";
}

//イベントをひとつづつ表示
function content_event(){
  echo <<<EOT
<div class="event_content">
  <div class="event_header">
    <div class="event_title">
      <h2 class="event_name">イベント名</h2>
    </div>
  </div>
  <hr class="event_collum_hr">
  <div class="event_statement">
    <div>
      <p>aaa</p>
    </div>
  </div>
</div>
EOT;
}

function content_none(){
  echo <<<EOT
<div id="event_none">
  <div id="event_none_content">
    <p>イベントがありません．</p>
  </div>
</div>
EOT;
}

//
function content_titlebar(){
  $send_source = <<<EOT
<div>
  <p>aa</p>
</div>
EOT;
  $option1 = "opacity:'0.7', duration:'0.7', backgroundColor:'#000', noClickHide:'0'";
  $option2 = "top:'50px', left:'50px', width:'450px', height:'', noHideButton:'1'";

  echo <<<EOT
<div id="header">
  <div id="header_body">
    <div id="header_title">
      <h1>イベント出欠確認システム</h1>
    </div>
    <div id="header_button">
      <input type="button" name="new_create_button" value="イベントを作成する" id="new_create_button" onclick="">
    </div>
  </div>
</div>
EOT;
}

//ヘッダー
function content_header($page_title){
  echo <<<EOT
<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/smartdialog.js"></script>
<title>$page_title</title>
</head>
<body>
EOT;
}

//フッター
function content_footer($copyright){
  echo <<<EOT
<div id="copyright">
 <small>$copyright</small>
</div>
</body>
</html>
EOT;
}
 ?>
