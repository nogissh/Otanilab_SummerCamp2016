<?php
//
$defaultList = array();

if($handle = opendir("members")){
  while (false != ($file = readdir($handle))) {
    if($file != '.' && $file != '..' && $file != '.DS_Store'){
      array_push($defaultList, $file);
    }
    //echo "$file\n";
  }

  //逆順にする
  $defaultList = array_reverse($defaultList, true);
}

return $defaultList;
 ?>
