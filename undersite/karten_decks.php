<?php

require '../bootstrap.php';

$active_page = 'karten_decks';

include PATH . 'parts/head.php';

// Wenn User => Admin ist...
// dann können Tricks bearbeitet werden
if (request_is('post')) {

  $deck_name = request('deck-name');
  $deck_price = request('deck-price');
  $img_1 = request('image_1');
  $action = request('action');



  if ($deck_name === '') {
    $errors['deck-name'] = 'PHP Feld darf nicht leer sein';
  }

  if ($deck_price === '') {
    $errors['deck-price'] = 'PHP Feld darf nicht leer sein';
  }

  if ($img_1 === '') {
    $errors['image_1'] = 'PHP Feld darf nicht leer sein';
  }

  if (!$errors) {
    db_insert('card_decks', [
      'deck_name' => $deck_name,
      'price' => $deck_price,
      'deck_image_1' => $img_1,
    ]);
  }

  
  if ($action === 'delete') {
    $id_delete = request('id-delete');
    db_delete('card_decks', $id_delete);
  }
}

// Hohlt die Daten Der Karten-Decks aus der Datenbank
$decks = db_raw_select("SELECT * FROM `card_decks`");

?>
<div id="wrapper-decks">

  <noscript class="noscript">
    Bitte Javascript Aktievieren da einige Funktionen sonst nicht gegeben sind.
  </noscript>

  <?php include PATH . 'parts/nav.php'; ?>

  <section class="decks-container">
    <h2>Karten Decks</h2>

    <?php foreach ($decks as $deck) : ?>
      <?php $deck_name = str_replace(' ', '-', $deck['deck_name']) ?>
      <article class="deck-article col-30">
        <h2 class="none">Platzhalter für valides HTML</h2>
        <div class="article-container">
          <img class="article-img" src="<?= htmlspecialchars($deck['deck_image_1']) ?>" alt="Bild von <?= htmlspecialchars($deck['deck_name']) ?>">
          <p class="article-name"><?= htmlspecialchars($deck['deck_name']) ?></p>
          <p class="article-price"><?= htmlspecialchars($deck['price']) ?>€</p>
          <a class="article-btn" href="description_sites/description_karten_decks.php?name=<?= $deck_name ?>&id=<?= $deck['id'] ?>" title="<?= htmlspecialchars($deck['deck_name']) ?>">Zum Produkt</a>
          <?php if (auth_user('title') == 1) : ?>
            <form action="#" method="post">
              <input type="hidden" name="id-delete" value="<?= $deck['id'] ?>">
              <button class="delete" type="submit" name="action" value="delete">Produkt Löschen</button>
            </form>
          <?php endif; ?>

        </div>
      </article>
    <?php endforeach; ?>

  </section>


  <div class="col-20">
    <?php if (auth_user('title') == 1) : ?>
      <form action="#" method="post">

        <div class="description-edit admin-bereich">
          <h4>Admin bereich</h4>
          <h4>Ein Neues Deck Hinzufügen</h4>

          <label class="deck-name">Deck Name</label>
          <input type="text" name="deck-name">
          <?= error_for($errors, 'deck-name'); ?>

          <label class="deck-price">Deck Preis</label>
          <input type="text" name="deck-price">
          <?= error_for($errors, 'deck-price'); ?>

          <label class="images">Bild hinzufügen/ersetzten</label>
          <input type="text" name="image_1" placeholder="../images/pic/decks/NAME">
          <button type="submit">Speichern</button>
          <?= error_for($errors, 'images'); ?>
        </div>

      </form>
    <?php endif; ?>

  </div>

  <?php
  include PATH . 'parts/foot.php';
