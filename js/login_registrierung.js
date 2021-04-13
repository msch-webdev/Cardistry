'use strict';

$(function ($) {

  // Clickhandler für Login => X Button zum Schließen
  $('.X').on('click', function () {

    $('.nav-form').css({
      'display': 'none',
    });

  });

  // Clickhandler für Login Button um Css umzustellen
  $('#login_btn').on('click', function () {

    $('.nav-form').css({
      'display': 'flex',
    });

  });
});