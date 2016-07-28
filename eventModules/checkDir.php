<?php
//
function checkDirectories(){
  $eventPath = '../events';
  $memberPath = '../members';

  //
  if(!file_exists($eventPath)){
    mkdir('event', 0755);
    mkdir('event/open', 0755);
    mkdir('event/close', 0755);
  }
  if(!file_exists($memberPath)){
    mkdir('member', 0755);
  }
}

function readEvent(){

}

function readMember(){

}
 ?>
