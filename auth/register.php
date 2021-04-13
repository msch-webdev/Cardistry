<?php
declare(strict_types=1);

require '../bootstrap.php';

$active_page = 'register';

if (request_is('post')) {

    $vorname = request('vorname');
    $nachname = request('nachname');
    $email = request('email');
    $password = request('password');
    $password_confirmation = request('password_confirmation');


    if ($vorname === '') {
        $errors['vorname'] = 'vorname cannot be empty.';
    }
    if ($nachname === '') {
        $errors['nachname'] = 'nachname cannot be empty.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Please provide a valid email address.';
    }

    if ($email === '') {
        $errors['email'] = 'Email cannot be empty.';
    }

    if ($password !== $password_confirmation) {
        $errors['password'] = 'The passwords do not match.';
    }

    if (mb_strlen($password) < 6) {
        $errors['password'] = 'Password must be at least 6 characters long.';
    }

    if ($password === '') {
        $errors['password'] = 'Password cannot be empty.';
    }

    if (!$errors) {
        $user = db_raw_first(
            "SELECT * FROM `users` WHERE `email` = " . db_prepare($email)
        );

        if ($user) {
            $errors['email'] = 'This email already exists in our database.';
        }
    }

    if (!$errors) {
        db_insert('users', [
            'vorname' => $vorname,
            'nachname' => $nachname,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);

        redirect(BASE_URL.'auth/login.php');
    }
}

include PATH.'parts/head.php';
?>
<h1>Register</h1>

<form action="<?= BASE_URL.'auth/register.php' ?>" method="post">
    <div class="form-group">
        <?= error_for($errors, 'vorname') ?>
        <label for="vorname">Vorname</label>
        <input type="text" name="vorname" id="vorname">
    </div>

    <div class="form-group">
        <?= error_for($errors, 'nachname') ?>
        <label for="nachname">Nachname</label>
        <input type="text" name="nachname" id="nachname">
    </div>

    <div class="form-group">
        <?= error_for($errors, 'email') ?>
        <label for="email">Email</label>
        <input type="text" name="email" id="email">
    </div>

    <div class="form-group">
        <?= error_for($errors, 'password') ?>
        <label for="password">Password</label>
        <input type="text" name="password" id="password">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Password Confirmation</label>
        <input type="text" name="password_confirmation" id="password_confirmation">
    </div>

    <div class="form-group">
        <button type="submit">Register</button>
    </div>
</form>

<div>
    Already have an account? Then go to the <a href="<?= BASE_URL.'auth/login.php' ?>">login page</a>.
</div>
<?php
include PATH.'parts/foot.php';
