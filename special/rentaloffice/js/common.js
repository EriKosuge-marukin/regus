$('.accordion-header').click(function() {
  $(this).next().slideToggle();
  $(this).toggleClass('active');
});