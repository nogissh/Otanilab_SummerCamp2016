//予定日のカレンダー
$(function() {
  $("#newCreateEventDate").datepicker();
  $("#newCreateEventDate_01").datepicker();
  $("#newCreateEventDate_02").datepicker();
  $("#newCreateEventDate_03").datepicker();
  $("#newCreateEventDate_04").datepicker();
  $("#newCreateEventDate_05").datepicker();
  $("#newCreateEventDate_06").datepicker();
  $("#newCreateEventDate_07").datepicker();
  $("#newCreateEventDate_08").datepicker();
  $("#newCreateEventDate_09").datepicker();
});

//締切日のカレンダー
$(function() {
  $("#newCreateEventLimitDate").datepicker();
});

//divのリンク化
jQuery('.wrap').click(function() {
    location.href = jQuery(this).attr('data-target');
});
