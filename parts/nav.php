<?php
$site = $_SERVER['REQUEST_URI'];
?>

<nav>
   <ul class="nav">
      <li>
         <a href="<?= BASE_URL.'undersite/tricks.php' ?>" class="<?= $active_page === 'tricks' ? 'active' : '' ?>">Tricks</a>
         <?php if ($active_page === 'tricks_description') : ?>
            <ul>
               <li class="active">Beschreibung</li>
            </ul>
         <?php endif ?>
      </li>
      <li>
         <a href="<?= BASE_URL.'undersite/magic_tricks.php' ?>" class="<?= $active_page === 'magic_tricks' ? 'active' : '' ?>">Magic Tricks</a>
      </li>
      <li>
         <a href="<?= BASE_URL.'undersite/karten_decks.php' ?>" class="<?= $active_page === 'karten_decks' ? 'active' : '' ?>">Karten Decks</a>
         <?php if ($active_page === 'decks_description') : ?>
            <ul>
               <li class="active">Beschreibung</li>
            </ul>
         <?php endif ?>
      </li>
      <li>
         <a href="<?= BASE_URL.'undersite/home.php' ?>" class="<?= $active_page === 'home' ? 'active' : '' ?>">Cardistry</a>
      </li>
      <li>
         <a href="<?= BASE_URL.'undersite/kontakt.php' ?>" class="<?= $active_page === 'kontakt' ? 'active' : '' ?>">Kontakt</a>
      </li>
      <li>
         <ul class="">
            <!-- wenn User eingelogt dann zeige links -->
            <?php if (auth_user()) : ?>
               <li>
                  <a href="<?= BASE_URL.'auth/logout.php' ?>">Logout</a>
               </li>
            <!-- // ansonsten zeige links -->
            <?php else : ?>
               <li>
                  <div>
                     <a id="login_btn" href="#">Login</a>
                     
                     <div class="nav-form">
                        <div class="nav-form-container">
                           <div class="X-btn">
                              <button type="button" class="X">x</button>
                           </div>
                           <form action="<?= BASE_URL.'auth/login.php' ?>" method="post">
                              <!-- hiden imputfeld ,speichert die aktuelle seite wo login gedrückt wurde und giebt es im formular mit zum login validierung
                              dort wird es im redireckt übergeben -->
                              <div class="login">
                                 <?= error_for($errors, 'email') ?>
                                 <label for="email">Email</label>
                                 <input type="text" name="email" id="email" required>
                              </div>

                              <div class="login">
                                 <?= error_for($errors, 'password') ?>
                                 <label for="password">Password</label>
                                 <input type="text" name="password" id="password" required>
                              </div>

                              <input type="hidden" name="seite" value="<?= $site;?>">

                              <button type="submit">Login</button>
                              
                           </form>
                           <span>Don't have an account?<a href="<?= BASE_URL.'auth/register.php' ?>" class="reg <?= $active_page === 'register' ? 'active' : '' ?>">Register</a></span>
                        </div>
                     </div>
                     
                  </div>
               </li>
            <?php endif; ?>
         </ul>
      </li>
   </ul>
</nav>


<!-- class $active -->





