// JavaScript Document

(function ($) {
        $.boxLink = function (options) {
                var o = $.extend({
                        targetBox: 'boxLink',//targetBox
                        hover: 'hover'//addClass
                }, options);
                $('.'+o.targetBox).hover(function () {
                        $(this).addClass(o.hover);
                }, function () {
                        $(this).removeClass(o.hover);
                });
                $('.'+o.targetBox).click(function () {
                        var boxUrl = $(this).find('a').attr('href');
                        if ($(this).find('a').attr('target') == '_blank') {
                                window.open(boxUrl);
                        } else window.location = boxUrl;
                        return false;
                });
                $(window).unload(function () {
                        $(this).removeClass(o.hover);
                });
        };
        $(function () {
                $.boxLink();
        });
})(jQuery);