
$(function () {
    $(".check").on("click", function () {
     var q1 = $("input:radio[name='q1']:checked").val();
     var q2 = $("input:radio[name='q2']:checked").val();
     if (q1 == undefined || q2 == undefined) {
      alert("チェックしてください");
      return false;
     }
     var result = q1 + q2;
     $(".result_area").hide();
     //$(".check").attr("href", "#" + result);
     $(".result_area").each(function () {
      var id = $(this).attr("id");
      if (result == id) {
       $(this).show();
      }
     });
     $("html,body").animate({
      scrollTop: $('.result_wrap').offset().top
     });
     return false;
    });
   });