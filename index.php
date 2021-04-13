<?php

require 'bootstrap.php';

$active_page = 'index';

include PATH.'parts/head.php';
?>


<div id="wrapper-index">
<noscript class="noscript">
    Bitte Javascript Aktievieren da einige Funktionen sonst nicht gegeben sind.
    <?php if (auth_user()) : ?>
        
        <a href="<?= BASE_URL.'auth/logout.php' ?>">Logout</a>
        
    <!-- // ansonsten zeige links -->
    <?php else : ?>
        <a href="auth/login.php">Login</a>
    <?php endif; ?>
    
</noscript>
<?php 
    include PATH.'parts/nav.php'; 
?>
    

    <div id="video_background">
        <video id="bg_video"  preload="auto" autoplay loop="loop" muted="muted"> 
            <source src="images/video/Riffle_Fan.mp4" type="video/mp4"> 
            Video not supported 
        </video>
    </div>

    <h1>Cardistry</h1>
<?php
include PATH.'parts/foot.php';
