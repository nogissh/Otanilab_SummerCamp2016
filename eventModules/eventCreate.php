<?php
///////////////////////////////////////////////
//POSTを取得する
$title  = $_POST['newEventName'];
$detail = $_POST['newEventDetail'];
$date = $_POST['newEventDate'];
$place = $_POST['newEventPlace'];
$master = $_POST['newEventMaster'];
$cost = $_POST['newEventCost'];
$url = $_POST['newEventUrl'];
$limit = $_POST['newEventLimit'];
///////////////////////////////////////////////

//////detailの処理
///半角の「,」を「#comma」に
$detail = str_replace(",", "#comma", $detail);

///改行
$detail = htmlspecialchars($detail);
#$detail = nl2br($detail);
$detail = str_replace("\r\n", ",", $detail);
$detail = str_replace("\n", ",", $detail);
//$detail = str_replace("<br />", ",", $detail);
//echo $detail;

/*/////////////////////////////////////////////
///////////////////////////////////////////////
ファイル名：エポックタイム

出力順
0:タイトル
1:詳細
2:予定日
3:締切日
4:予算
5:作成者
/////////////////////////////////////////////*/
////書込処理
$eventID = time(); //エポックタイムをIDとする
//イベントのディレクトリ作成
mkdir('events/'.(string)$eventID, 0777);

//イベントのファイル作成と書き込み
$handle = fopen('events/'.(string)$eventID.'/event.csv', 'w');
fwrite($handle, $title."\n");
fwrite($handle, $detail."\n");
fwrite($handle, $date."\n");
fwrite($handle, $limit."\n");
fwrite($handle, $cost."\n");
fwrite($handle, $master."\n");
//fwrite($handle, $place."\n");
//fwrite($handle, $url."\n");
fclose($handle);

//メンバーディレクトリを作成
mkdir('events/'.(string)$eventID.'/member', 0777);

///////////////////////////////////////////////
///////////////////////////////////////////////

 ?>
