<?php
echo <<<EOT
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
EOT;
 ?>
