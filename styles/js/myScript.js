//予定日のカレンダー
$(function() {
  $("#newCreateEventDate").datepicker();
});

//締切日のカレンダー
$(function() {
  $("#newCreateEventLimitDate").datepicker();
});

//divのリンク化
jQuery('.wrap').click(function() {
    location.href = jQuery(this).attr('data-target');
});
