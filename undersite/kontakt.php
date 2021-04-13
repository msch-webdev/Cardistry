<?php

require '../bootstrap.php';

$active_page = 'kontakt';

include PATH . 'parts/head.php';

//----------------------- PHP - Validierung -------------------------------------
$errors = [];

if (request_is('post')) {

  $vorname = request('vorname');
  $nachname = request('nachname');
  $email = request('email');
  $gender = request('gender');
  $subject = request('subject');
  $check = request('check');
  $text = request('textarea');



  if ($vorname === '') {
    $errors['vorname'] = 'PHP Bitte geben Sie Ihren  Ihre vorname ein';
  }
  if ($nachname === '') {
    $errors['nachname'] = 'PHP Bitte geben Sie Ihren  Ihre Nachname ein';
  }

  if ((strpos($email, '@') === false)) {
    $errors['email'] = "PHP Es fehlt ein @ ZEICHEN!";
  }

  if ($email === '') {
    $errors['email'] = 'PHP Bitte geben Sie Ihre E-mail ein';
  }

  if ($gender === '') {
    $errors['gender'] = 'PHP Bitte wählen Sie aus was sie sind';
  }

  if ($check === '') {
    $errors['check'] = 'PHP Bitte ein grund angeben';
  }

  if ($subject === '') {
    $errors['subject'] = 'PHP Bitte wählen Sie ihr Anliegen aus ';
  }
  if ($subject === '') {
    $errors['textarea'] = 'PHP Bitte Schreib mir was';
  }

  if (!$errors) {
    db_insert('kontakt', [
      'vorname' => $vorname,
      'nachname' => $nachname,
      'email' => $email,
      'check' => $check,
      'gender' => $gender,
      'subject' => $subject,
      'text' => $text
    ]);
  }
}

?>

<div class="wrapper-kontakt">
  <?php include PATH . 'parts/nav.php'; ?>

  <noscript class="noscript">
    Bitte Javascript Aktievieren da einige Funktionen sonst nicht gegeben sind.
  </noscript>

  <div class="kontakt-container">
    <h2>Kontakt</h2>
    <p>Wenn Du uns was Mitteilen möchtest dann nutzte unser Kontaktformular.</p>
    <form action="#" method="post" id="forms">

      <div class="vorname">
        <label for="vorname">Vorname <span class="required">*</span></label>
        <input class="field" type="text" name="vorname" id="vorname" required>
        <?php if (isset($errors['vorname'])) : ?>
          <div class="error"><?= $errors['vorname'] ?></div>
        <?php endif; ?>
      </div>

      <!-- ######################################################################### -->
      <div class="nachname">
        <label for="nachname">Nachname <span class="required">*</span></label>
        <input type="text" name="nachname" id="nachname" required>
        <?php if (isset($errors['vorname'])) : ?>
          <div class="error"><?= $errors['nachname'] ?></div>
        <?php endif; ?>
      </div>

      <!-- ######################################################################### -->
      <div class="email-kontakt">
        <label for="email-kontakt">Email <span class="required">*</span></label>
        <input type="email" name="email" id="email-kontakt" required>
        <?php if (isset($errors['email'])) : ?>
          <div class="error"><?= $errors['email'] ?></div>
        <?php endif; ?>
      </div>

      <!-- ######################################################################### -->
      

      <!-- ######################################################################### -->
      <div class="gender_box" id="gender">
        <label class="radio">Geschlecht <span class="required">*</span></label>

        <p>Mänlich</p>
        <input type="radio" name="gender" id="male" value="Männlich" required>

        <p>Weiblich</p>
        <input type="radio" name="gender" id="female" value="Weiblich" required>

        <p>Diverse</p>
        <input type="radio" name="gender" id="divers" value="Diverses" required>

        <?php if (isset($errors['gender'])) : ?>
          <div class="error"><?= $errors['gender'] ?></div>
        <?php endif; ?>
      </div>

      <!-- ######################################################################### -->
      <div class="subject">
        <label for="subject">Subject <span class="required">*</span></label>
        <select name="subject" id="subject" required>
          <option value="" disabled selected>--Bitte wählen--</option>
          <option value="Anliegen1">Anliegen1</option>
          <option value="Anliegen2">Anliegen2</option>
          <option value="Anliegen3">Anliegen3</option>
        </select>
        <?php if (isset($errors['subject'])) : ?>
          <div class="error"><?= $errors['subject'] ?></div>
        <?php endif; ?>
      </div>

      <!-- ######################################################################### -->
      <div class="textarea-kontakt">
        <label class="textarea" for="textarea">Deine Nachricht an uns <span class="required">*</span></label>
        <textarea name="textarea" cols="30" rows="10" id="textarea" required></textarea>
        <?php if (isset($errors['textarea'])) : ?>
          <div class="error"><?= $errors['textarea'] ?></div>
        <?php endif; ?>
      </div>

      <!-- ######################################################################### -->
      <div class="sonst">
        <label class="sonst_label">AGB´s bestätigen <span class="required">*</span></label>

        <input type="checkbox" name="check" id="check" value="A" required>

        <?php if (isset($errors['check'])) : ?>
          <div class="error"><?= $errors['check'] ?></div>
        <?php endif; ?>
      </div>
      <input class="submit-btn" type="submit" value="Absenden">
    </form>
  </div>
  <?php
  include PATH . 'parts/foot.php';
