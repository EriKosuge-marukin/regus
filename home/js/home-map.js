$(function () {
  $(".tab").click(function () {
    $(".tab, .tab-contents").removeClass("active");
    $(this).addClass("active");
    const index = $(".tab").index(this);
    $(".tab-contents").eq(index).addClass("active");
    $("img[usemap]").rwdImageMaps();
  });
});
