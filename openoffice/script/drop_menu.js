// JavaScript Document


$(document).ready(function(){
  var $gnavMenu = $('#gNav .Mega');
    $gnavMenu.hover(function(){
        $(">ol:not(:animated)",this).slideDown("fast");
        $(this).addClass('onNav');
    },
    function(){
        $(">ol",this).slideUp("fast");
        $(this).removeClass('onNav');
});

});