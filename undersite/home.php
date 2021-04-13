<?php

require '../bootstrap.php';

$active_page = 'home';

include PATH.'parts/head.php';
?>
  <div id="wrapper-home">
  <noscript class="noscript">
    Bitte Javascript Aktievieren da einige Funktionen sonst nicht gegeben sind.
  </noscript>
  <?php include PATH.'parts/nav.php'; ?>
  <h1 class="hide-h1">Home Cardistry</h1>

  <div id="home_container">

    <section class="vorschau_container">
    <h2 class="none">Platzhalter für valides HTML</h2>
      <section class="vorschau_kategorie col-30">
        <h2>Tricks</h2>
        <div>
          <a class="img-link-trick" href="tricks.php" title="zu den Tricks"></a>
        </div>
      </section>

      <article class="vorschau_article col-40">
      <h2 class="none">Platzhalter für valides HTML</h2>
        <p>Cardistry ist eine Kunstform mit Spielkarten. Die Kunst der Cardistry besteht darin, Spielkarten zu manipulieren und diese Aktionen so beeindruckend wie möglich aussehen zu lassen.</p>
        <p> Das Wort Cardists ist eine Verschmelzung der englischen Wörter: card und artists.
        Während sich die Kartenmagie auf die Manipulation von Spielkarten für Illusionen konzentriert, ist Cardistry die nicht magische Manipulation von Spielkarten mit der Absicht, Kreativität, darstellende Kunst und Geschicklichkeit auszudrücken. </p>
        <p>Cardistry ist die Kunst des Throwing, Cutting, Flipping, Rotating, Shuffling und Fans machen von Spielkarten.</p>
      </article>

    </section>
    <!-- ############################################################################## -->
    <section class="vorschau_container">
    <h2 class="none">Platzhalter für valides HTML</h2>
      
      <article class="vorschau_article col-40">
      <h2 class="none">Platzhalter für valides HTML</h2>
      <p>Unsere Magic Tricks befindet sich leider noch im Aufbau.</p>
      </article>

      <section class="vorschau_kategorie col-30">
        <h2>Magic Tricks</h2>
        
        <div>
          <a class="img-link-magic" href="magic_tricks.php" title="zu den Magic-Tricks"></a>
        </div>
      </section>

    </section>
    <!-- ############################################################################## -->
    <section class="vorschau_container">
    <h2 class="none">Platzhalter für valides HTML</h2>
      <section class="vorschau_kategorie col-30">
        <h2>Karten Decks</h2>
        <div>
          <a class="img-link-decks" href="karten_decks.php" title="zu den Karten Decks"></a>
        </div>

      </section>
      <article class="vorschau_article col-40">
      <h2 class="none">Platzhalter für valides HTML</h2>
      <p>Bei Uns finden Sie eine große Auswahl an Cardistry Karten</p>
      <p>Wir haben Kartenspiele von professionellen Magiern, wie Chris Ramsay, Dan und Dave, The New Deck Order und von Kartenmarken wie Bicycle, Ellusionist, Cartamundi, COPAG 310, Murphy's Magic, NOC Spielkarten, Tally-Ho und USPCC.</p>
      <p>Kurz gesagt, ob Sie nach Karten zum Werfen, zum Fanningoder oder Flourishing, zum Cuts oder Shuffles oder nach andere Formen der Kartenkunst suchen, Überzeugen Sie sich selbst!</p>
      </article>

    </section>
  </div>
<?php
include PATH.'parts/foot.php';
