<?php

require '../bootstrap.php';

$active_page = 'tricks';

include PATH . 'parts/head.php';



if (request_is('post')) {

  $new_trick = trim(request('new_trick'));
  $title = trim(request('title_trick'));
  $group = request('gruppe');

  $action = request('action');

  if ($new_trick === '') {
    $errors['name'] = 'Der Name darf nicht leer sein.';
  }

  if ($title === '') {
    $errors['title'] = 'Der Titel darf nicht leer sein.';
  }

  if (!$errors) {
    db_insert('cardistry_tricks', [
      'trick_name' => $new_trick,
      'link_title' => $title,
      'gruppe' => $group,
    ]);
  }


  if ($action === 'delete') {
    $id_delete = request('id-delete');
    db_delete('cardistry_tricks', $id_delete);
  }
}

// Hohlt die Daten Der Tricks aus der Datenbank
$tricks = db_raw_select("SELECT * FROM `cardistry_tricks`");




?>
<div id="wrapper-tricks">
  <noscript class="noscript">
    Bitte Javascript Aktievieren da einige Funktionen sonst nicht gegeben sind.
  </noscript>
  <?php include PATH . 'parts/nav.php'; ?>


  <section id="tricks_overview_container">
    <h2>Cardistry Tricks </h2>
    <div class="overview_container">
      <!-- ###################Anfänger################################ -->
      <section class="col-50 anfaenger">
        <h3>Anfänger Übungen</h3>
        <ol>
          <?php foreach ($tricks as $trick) : ?>
            <?php if ($trick['gruppe'] === 'basic') : ?>
              <?php $trick_name = str_replace(' ', '-', $trick['trick_name']) ?>
              <li><a href="description_sites/description_tricks.php?name=<?= $trick_name ?>&id=<?= $trick['id'] ?>" title="<?= htmlspecialchars($trick['link_title']) ?>"><?= htmlspecialchars($trick['trick_name']) ?></a>
                <?php if (auth_user('title') == 1) : ?>
                  <form action="#" method="post">
                    <input type="hidden" name="id-delete" value="<?= $trick['id'] ?>">
                    <button class="delete" type="submit" name="action" value="delete">Löschen</button>
                  </form>
                <?php endif; ?>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ol>
      </section>

      <!-- Wenn User => Admin ist...
      dann können neue Tricks hinzugefügt werden -->
      <?php if (auth_user('title') == 1) : ?>

        <div class="admin-bereich">
          <h4>Admin bereich</h4>
          <form action="#" method="post">
            <div class="form-group">
              <label for="name">Neuer Trick</label>
              <input type="text" name="new_trick" id="name">
              <?= error_for($errors, 'name'); ?>
            </div>

            <div class="form-group">
              <label for="title">Link Titel</label>
              <input type="text" name="title_trick" id="title">
              <?= error_for($errors, 'title'); ?>
            </div>

            <input type="hidden" name="gruppe" value="basic">


            <button type="submit">Speichern</button>


          </form>
        </div>
      <?php endif; ?>


      <!-- ###################Fortgeschrittene################################ -->
      <section class="col-50 fortgeschritten">
        <h3>Fortgeschrittene Übungen</h3>
        <ol>
          <?php foreach ($tricks as $trick) : ?>
            <?php if ($trick['gruppe'] === 'advanced') : ?>
              <?php $trick_name = str_replace(' ', '-', $trick['trick_name']) ?>
              <li><a href="description_sites/description_tricks.php?name=<?= $trick_name ?>&id=<?= $trick['id'] ?>" title="<?= htmlspecialchars($trick['link_title']) ?>"><?= htmlspecialchars($trick['trick_name']) ?></a>
                <?php if (auth_user('title') == 1) : ?>
                  <form action="#" method="post">
                    <input type="hidden" name="id-delete" value="<?= $trick['id'] ?>">
                    <button class="delete" type="submit" name="action" value="delete">Löschen</button>
                  </form>
                <?php endif; ?>
              </li>

            <?php endif; ?>
          <?php endforeach; ?>
        </ol>
      </section>

      <?php if (auth_user('title') == 1) : ?>
        <div class="admin-bereich">
          <form action="#" method="post">
            <div class="form-group">

              <label for="name">Neuer Trick</label>
              <input type="text" name="new_trick" id="name">
              <?= error_for($errors, 'name'); ?>
            </div>

            <div class="form-group">
              <label for="title">Link Titel</label>
              <input type="text" name="title_trick" id="title">
              <?= error_for($errors, 'title'); ?>
            </div>

            <input type="hidden" name="gruppe" value="advanced">


            <button type="submit">Speichern</button>


          </form>
        </div>
      <?php endif; ?>



      <!-- Wenn nur User angemeldet ist werden die Profi Tricks angezeigt -->
      <!-- ###################Profis################################ -->
      <?php if (auth_user()) : ?>

        <section class="col-50 profi">
          <h3>Profie Übungen</h3>
          <ol>
            <?php foreach ($tricks as $trick) : ?>
              <?php if ($trick['gruppe'] === 'profi') : ?>
                <?php $trick_name = str_replace(' ', '-', $trick['trick_name']) ?>
                <li><a href="description_sites/description_tricks.php?name=<?= $trick_name ?>&id=<?= $trick['id'] ?>" title="<?= htmlspecialchars($trick['link_title']) ?>"><?= htmlspecialchars($trick['trick_name']) ?></a>
                  <?php if (auth_user('title') == 1) : ?>
                    <form action="#" method="post">
                      <input type="hidden" name="id-delete" value="<?= $trick['id'] ?>">
                      <button class="delete" type="submit" name="action" value="delete">Löschen</button>
                    </form>
                  <?php endif; ?>
                </li>

              <?php endif; ?>
            <?php endforeach; ?>
          </ol>
        </section>

        <?php if (auth_user('title') == 1) : ?>
          <div class="admin-bereich">
            <form action="#" method="post">

              <div class="form-group">
                <label for="name">Neuer Trick:</label>
                <input type="text" name="new_trick" id="name">
                <?= error_for($errors, 'name'); ?>
              </div>

              <div class="form-group">
                <label for="title">Link Titel:</label>
                <input type="text" name="title_trick" id="title">
                <?= error_for($errors, 'title'); ?>
              </div>

              <input type="hidden" name="gruppe" value="profi">


              <button type="submit">Speichern</button>


            </form>
          </div>
        <?php endif; ?>


      <?php endif; ?>
    </div>
  </section>

  <?php
  include PATH . 'parts/foot.php';
