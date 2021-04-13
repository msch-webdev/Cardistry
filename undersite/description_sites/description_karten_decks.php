<?php

require '../../bootstrap.php';

$active_page = 'decks_description';

include PATH . 'parts/head.php';

//Hohlt den Namen des Tricks aus der URL die mit übergeben wurde
$url_name = filter_var($_GET["name"], FILTER_SANITIZE_STRING);
$url_id = filter_var($_GET["id"], FILTER_SANITIZE_STRING);

// Hohlt die Daten Der Karten-Decks aus der Datenbank
$decks = db_raw_select("SELECT * FROM `card_decks`");

// Wenn User => Admin ist...
// dann können Tricks bearbeitet werden
if (request_is('post')) {

  $textarea_description = request('textarea-description');
  $img_2 = request('deck_image_2');
  $img_3 = request('deck_image_3');
  $img_4 = request('deck_image_4');
  $action = request('action');


  if ($action === 'create-description') {

    if ($textarea_description === '') {
      $errors['textarea-description'] = 'PHP Feld darf nicht leer sein';
    } else {
      db_update('card_decks', $url_id, ['deck_description' => $textarea_description]);
    }
  }

  if ($action === 'deck_create-image_2') {

    if ($img_2 === '') {
      $errors['deck_image_2'] = 'PHP Feld darf nicht leer sein';
    } else {
      db_update('card_decks', $url_id, ['deck_image_2' => $img_2]);
    }
  }

  if ($action === 'deck_create-image_3') {

    if ($img_3 === '') {
      $errors['deck_image_3'] = 'PHP Feld darf nicht leer sein';
    } else {
      db_update('card_decks', $url_id, ['deck_image_3' => $img_3]);
    }
  }

  if ($action === 'deck_create-image_4') {

    if ($img_4 === '') {
      $errors['deck_image_4'] = 'PHP Feld darf nicht leer sein';
    } else {
      db_update('card_decks', $url_id, ['deck_image_4' => $img_4]);
    }
  }
}
?>
<div id="wrapper-decks-description">

  <noscript class="noscript">
    Bitte Javascript Aktievieren da einige Funktionen sonst nicht gegeben sind.
  </noscript>
  <?php include PATH . 'parts/nav.php'; ?>

  <div class="description-container col-75">

    <?php foreach ($decks as $deck) : ?>
      <?php $deck_name = str_replace('-', ' ', $url_name) ?>
      <?php if ($deck['deck_name'] === $deck_name) : ?>


        <?php for ($i = 2; $i < 5; $i++) : ?>
          <?php if ($deck['deck_image_' . $i] !== NULL) : ?>
            <div class="decks-images">
              <img class="decks-imgs" src="<?= $deck['deck_image_' . $i] ?>" alt="Vorschau Bild Karten Deck">
            </div>
          <?php endif; ?>
        <?php endfor; ?>

        <div class="col-50">
          <h2><?= htmlspecialchars($deck_name) ?></h2>
          <p><?= htmlspecialchars($deck['deck_description']) ?></p>
        </div>

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


        <div class="description-image admin-bereich">
          <label class="images">Bild hinzufügen/ändern</label>

          <input type="text" name="deck_image_2" placeholder="../../images/pic/decks/NAME">
          <button type="submit" name="action" value="deck_create-image_2">Speichern</button>

          <input type="text" name="deck_image_3" placeholder="../../images/pic/decks/NAME">
          <button type="submit" name="action" value="deck_create-image_3">Speichern</button>

          <input type="text" name="deck_image_4" placeholder="../../images/pic/decks/NAME">
          <button type="submit" name="action" value="deck_create-image_4">Speichern</button>
          <?= error_for($errors, 'images'); ?>
        </div>

      </form>
    <?php endif; ?>

  </div>

  <?php
  include PATH . 'parts/foot.php';
