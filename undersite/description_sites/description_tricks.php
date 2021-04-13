<?php

require '../../bootstrap.php';

$active_page = 'tricks_description';

include PATH . 'parts/head.php';

//Hohlt den Namen des Tricks aus der URL die mit übergeben wurde
$url_name = filter_var($_GET["name"], FILTER_SANITIZE_STRING);
$url_id = filter_var($_GET["id"], FILTER_SANITIZE_STRING);


$trick_name = str_replace('-', ' ', $url_name);


// Wenn User => Admin ist...
// dann können Tricks bearbeitet werden
if (request_is('post')) {

  $textarea_description = request('textarea-description');
  $textarea_tutorial = request('textarea-tutorial');
  $videoLink = request('videoLink');
  $img_1 = request('image_1');
  $img_2 = request('image_2');
  $img_3 = request('image_3');
  $img_4 = request('image_4');
  $action = request('action');


  if ($action === 'create-description') {

    if ($textarea_description === '') {
      $errors['textarea-description'] = 'PHP Feld darf nicht leer sein';
    } else {
      db_update('cardistry_tricks', $url_id, ['description' => $textarea_description]);
    }
  }

  if ($action === 'create-tutorial') {

    if ($textarea_tutorial === '') {
      $errors['textarea-tutorial'] = 'PHP Feld darf nicht leer sein';
    } else {
      db_update('cardistry_tricks', $url_id, ['tutorial' => $textarea_tutorial]);
    }
  }

  if ($action === 'create-videoLink') {

    if ($videoLink === '') {
      $errors['videoLink'] = 'PHP Feld darf nicht leer sein';
    } else {
      db_update('cardistry_tricks', $url_id, ['videoLink' => $videoLink]);
    }
  }

  if ($action === 'create-image_1') {

    if ($img_1 === '') {
      $errors['imgage_1'] = 'PHP Feld darf nicht leer sein';
    } else {
      db_update('cardistry_tricks', $url_id, ['image_1' => $img_1]);
    }
  }

  if ($action === 'create-image_2') {

    if ($img_2 === '') {
      $errors['imgage_2'] = 'PHP Feld darf nicht leer sein';
    } else {
      db_update('cardistry_tricks', $url_id, ['image_2' => $img_2]);
    }
  }

  if ($action === 'create-image_3') {

    if ($img_3 === '') {
      $errors['imgage_3'] = 'PHP Feld darf nicht leer sein';
    } else {
      db_update('cardistry_tricks', $url_id, ['image_3' => $img_3]);
    }
  }

  if ($action === 'create-image_4') {

    if ($img_4 === '') {
      $errors['imgage_4'] = 'PHP Feld darf nicht leer sein';
    } else {
      db_update('cardistry_tricks', $url_id, ['image_4' => $img_4]);
    }
  }
}


// Hohlt die Daten Der Tricks aus der Datenbank
$tricks = db_raw_select("SELECT * FROM `cardistry_tricks`");

?>
<div class="wrapper-description">
  <noscript class="noscript">
    Bitte Javascript Aktievieren da einige Funktionen sonst nicht gegeben sind.
  </noscript>
  <?php include PATH . 'parts/nav.php'; ?>

  <div class="description-container col-75">

    <?php foreach ($tricks as $trick) : ?>
      <?php if ($trick['trick_name'] === $trick_name) : ?>

        <!-- Einbettung durch Datenbank, link aus Youtube(einbetten) -->
        <iframe width="560" height="315" src="<?= $trick['videoLink'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <div class="col-50">
          <h2><?= htmlspecialchars($trick_name) ?></h2>
          <p><?= htmlspecialchars($trick['description']) ?></p>
        </div>

        <div class="tutorial-text">
          <h3>Tutorial</h3>
          <p><?= htmlspecialchars($trick['tutorial']) ?></p>
        </div>

        <?php for ($i = 1; $i < 5; $i++) : ?>
          <?php if ($trick['image_' . $i] !== NULL) : ?>
            <div class="images">
              <img class="imgs" src="<?= $trick['image_' . $i] ?>" alt="Vorschau Bild Tutorial">
            </div>
          <?php endif; ?>
        <?php endfor; ?>

      <?php endif; ?>
    <?php endforeach; ?>



  </div>

  <div class="col-20">
    <?php if (auth_user('title') == 1) : ?>
      <form action="#" method="post">
        <div class="description-edit admin-bereich">
          <h4>Admin bereich</h4>
          <label class="textarea">Beschreibung bearbeiten</label>
          <textarea name="textarea-description" cols="20" rows="10"></textarea>
          <?= error_for($errors, 'textarea-description'); ?>
          <button type="submit" name="action" value="create-description">Speichern</button>
        </div>

        <div class="description-edit admin-bereich">
          <label class="textarea">Tutorial bearbeiten</label>
          <textarea name="textarea-tutorial" cols="20" rows="10"></textarea>
          <?= error_for($errors, 'textarea-tutorial'); ?>
          <button type="submit" name="action" value="create-tutorial">Speichern</button>
        </div>

        <!-- Video link muss volle adresse haben
              z.B https://www.youtube.com/embed/BNC_DD9XccI    
        -->
        <div class="description-edit admin-bereich">
          <label class="videoLink" for="videoLink">Video link hinzufügen</label>
          <input type="text" name="videoLink" id="videoLink">
          <?= error_for($errors, 'videoLink'); ?>
          <button type="submit" name="action" value="create-videoLink">Speichern</button>
        </div>

        <div class="description-image admin-bereich">
          <label class="images">Bild hinzufügen/ändern</label>
          <input type="text" name="image_1" placeholder="../../images/pic/basic_grips/Pfad">
          <button type="submit" name="action" value="create-image_1">Speichern</button>

          <input type="text" name="image_2" placeholder="../../images/pic/basic_grips/Pfad">
          <button type="submit" name="action" value="create-image_2">Speichern</button>

          <input type="text" name="image_3" placeholder="../../images/pic/basic_grips/Pfad">
          <button type="submit" name="action" value="create-image_3">Speichern</button>

          <input type="text" name="image_4" placeholder="../../images/pic/basic_grips/Pfad">
          <button type="submit" name="action" value="create-image_4">Speichern</button>
          <?= error_for($errors, 'images'); ?>
        </div>

      </form>
    <?php endif; ?>

  </div>


  <!-- Footer bereich -->
  <?php
  include PATH . 'parts/foot.php';
