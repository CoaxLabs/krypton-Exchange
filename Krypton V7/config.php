<?php

define('DB_IP','127.0.0.1');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','krypton');

try {
    $bdd;
    $bdd = new PDO("mysql:host=" . DB_IP . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
}
catch(PDOException $e)
{
    die("ERROR: Could not connect.".$e->getMessage());
}

