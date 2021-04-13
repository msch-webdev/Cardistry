<?php

const PATH = 'C:/xampp/htdocs/wbsprojekt/';
const BASE_URL = 'http://localhost/wbsprojekt/';
const LOGIN_URL = 'http://localhost';

const LIB_PATH = PATH.'lib/';
require_once LIB_PATH.'authentication.php';
require_once LIB_PATH.'database.php';
require_once LIB_PATH.'request.php';
require_once LIB_PATH.'response.php';
require_once LIB_PATH.'session.php';
require_once LIB_PATH.'view.php';


$database = db_connect([
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'wbsprojekt'
]);

session_start();

$errors = [];
