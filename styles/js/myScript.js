//予定日のカレンダー
$(function() {
  $("#decideDate").datepicker();
});

//締切日のカレンダー
$(function() {
  $("#limitDate").datepicker();
});

//divのリンク化
jQuery('.wrap').click(function() {
    location.href = jQuery(this).attr('data-target');
});
