<?php
declare(strict_types=1);

require '../bootstrap.php';

$active_page = 'login';

if (request_is('post')) {
    
    $email = request('email');
    $password = request('password');
    $site = request('seite');
    

    if ($email === '') {
        $errors['email'] = 'Please enter your email address.';
    }

    if ($password === '') {
        $errors['password'] = 'Please enter your password.';
    }

    if (!$errors) {
        $user = db_raw_first(
            "SELECT * FROM `users` WHERE `email` = " . db_prepare($email)
        );

        if (!$user) {
            $errors['email'] = 'Your login credentials are incorrect';
        }
    }

    if (!$errors) {
        if (!password_verify($password, $user['password'])) {
            $errors['email'] = 'Your login credentials are incorrect';
        }
    }

    if (!$errors) {
        login($user);
        redirect(LOGIN_URL.$site);
    }
}

include PATH.'parts/head.php';
?>

<?php 
    include PATH.'parts/nav.php'; 
?>

<!-- Hierher verlinkt nur wenn JS ausgeschalten wurde -->
<div class="" >

    <form action="#" method="post">
        <div class="">
            <?= error_for($errors, 'email') ?>
            <label for="email">Email</label>
            <input type="text" name="email" id="email" required>
        </div>

        <div class="">
            <?= error_for($errors, 'password') ?>
            <label for="password">Password</label>
            <input type="text" name="password" id="password" required>
        </div>

        <input type="hidden" name="seite" value="<?= $site;?>">

        <div class="">
            <button type="submit">Login</button>
        </div>
    </form>
        
</div>
<div>
    Don't have an account? Then go to the <a href="<?= BASE_URL.'auth/register.php' ?>">registration page</a>.
</div>
<?php
include PATH.'parts/foot.php';
