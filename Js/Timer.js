$('document').ready(function () {
  var Timer = $('#Vrem').text(), int;
  int = setInterval(function () {
    if (Timer > 0) {
      Timer--;
      $('#Vrem').text(Timer);
    } else {
     clearInterval(int);
     $(".Box").remove();
     $('.boxT').append('<a href="/">Главная</a>');
    }
    if (Timer == 55) {
      $('#r').append('<a id="SIL" href="#">Главная реклама</a>');
    }
    $('#SIL').click(function () {
      clearInterval(int);
      $(".Box").remove();
      $('.boxT').append('<a href="/">Главная</a>');
      $('#SIL').remove();
    })
  }, 1000);
});
