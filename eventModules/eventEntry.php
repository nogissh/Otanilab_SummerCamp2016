<?php
//エントリーのイベント名を取得
$mode = $_POST['submitButton'];
$eventName = substr((string)$mode, 11, 10);

//エントリーの名前を取得
$getName = $_POST['eventParticipator_'.$eventName];

//エントリーの種類を取得
$getEntry = $_POST['entry_'.$eventName];


//memberディレクトリに書き込み
$handle = fopen("events/".$eventName."/member/".$getName, "w");
fwrite($handle, $getEntry."\n");
fclose($handle);

return true;
 ?>
