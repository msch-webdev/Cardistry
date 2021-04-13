'use strict';

$(function ($) {

  // Prüft welche Seite Aktuell aufgerufen wurde und ruft dann die dazugehörige CSS datei auf
  var currentLocation = window.location.pathname;

  if (currentLocation == '/wbsprojekt/undersite/home.php') {
    $('head').append('<link href="http://localhost/wbsprojekt/css/home_style.css"  rel="stylesheet">');
  }
  else if (currentLocation == '/wbsprojekt/undersite/tricks.php' || currentLocation == '/wbsprojekt/undersite/description_sites/description_tricks.php') {
    $('head').append('<link href="http://localhost/wbsprojekt/css/tricks_style.css"  rel="stylesheet">');
  }
  else if (currentLocation == '/wbsprojekt/undersite/magic_tricks.php') {
    $('head').append('<link href="http://localhost/wbsprojekt/css/magic_style.css"  rel="stylesheet">');
  }
  else if (currentLocation == '/wbsprojekt/undersite/karten_decks.php' || currentLocation == '/wbsprojekt/undersite/description_sites/description_karten_decks.php') {
    $('head').append('<link href="http://localhost/wbsprojekt/css/decks_style.css"  rel="stylesheet">');
  }
  else if (currentLocation == '/wbsprojekt/undersite/kontakt.php') {
    $('head').append('<link href="http://localhost/wbsprojekt/css/kontakt_style.css"  rel="stylesheet">');
  }

});



//#################### - Validierung der Forms - #########################

$.validator.addMethod(
  'letterswithbasicpunc',
  function (value, element) {
    return this.optional(element) || /^[a-zäöüß\-.,()'"\s]+$/i.test(value);
  },
  'Nur Buchstaben und Interpunktion erlaubt! addMethod'
);

var settings = {

  errorClass: 'error_required',
  normalizer: function (value) {
    return $.trim(value);
  },

  errorPlacement: function ($errorElement, $element) {
    if ($element.prop('type') === 'radio') {
      $element.parent().children().eq(0).after($errorElement);
    } else {
      $element.before($errorElement);
    }
  },
  submitHandler: function (form) {
    form.submit();
  },
  highlight: function (element, errorClass, validClass) {
    $(element).addClass(errorClass).removeClass(validClass);

    $(element).after().css('border', '2px solid red');
  },
  unhighlight: function (element, errorClass, validClass) {
    $(element).addClass(validClass).removeClass(errorClass);

    $(element).after().css('border', '');
  },
  rules: {
    vorname: {
      pattern: /^[a-zäöüß\-.,()'"\s]+$/i
    },
    nachname: {
      letterswithbasicpunc: true,
    },
    message: {
      minlength: 2,
    },
  },
  messages: {
    vorname: {
      pattern: 'Nur Buchstaben und Interpunktion erlaubt.',
    },
  },
};


$(function ($) {
  // Aufruf der Jquery Validierung
  var $form = $("form");
  if (!$form.checkValidity || $form.checkValidity()) {
    $('form').eq(0).validate(settings);
    $('form').eq(1).validate(settings);
  }

});

