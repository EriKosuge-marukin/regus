$(function() {
  var $children = $('.children');
  var original = $children.html();

  $('.parent').change(function() {
    var val1 = $(this).val();
    $children.html(original).find('option').each(function() {
      var val2 = $(this).data('val');
      if (val1 != val2) {
        $(this).not('optgroup,.msg').remove();
      }
    });

    if ($(this).val() === '') {
      $children.attr('disabled', 'disabled');
    } else {
      $children.removeAttr('disabled');
    }

  });
  $('.children').change(function() {
  });

  $('#slct_location').click(function() {
    if ($('select[name=slct_pulldown]').val() != null) {
      window.location.href = 'https://www.regus-office.jp/' + $('select[name=slct_pulldown]').val();
    }else{
      window.location.href = 'https://www.regus-office.jp/';
    }
  });
  $('#slct_location2').click(function() {
    if ($('select[name=slct_pulldown2]').val() != null) {
      window.location.href = 'https://www.regus-office.jp/' + $('select[name=slct_pulldown2]').val();
    }else{
      window.location.href = 'https://www.regus-office.jp/';
    }
  });
});
