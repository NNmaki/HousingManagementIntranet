<?php

// This file handles database connection for tickets system
// credentials for local enviroment:
// $dbaddr = "mysql:host=localhost;dbname=_SUPERSECRET_";
// $dbuser = "_SUPERSECRET_";
// $dbpwd = "_SUPERSECRET_";

// credentials for hosting provider login:
$dbaddr = "mysql:host=localhost;dbname=_SUPERSECRET_";
$dbuser = "_SUPERSECRET_";
$dbpwd = "_SUPERSECRET_";

// ALSO REMEMBER TO CHANGE DOMAIN IN COOKIE PARAMS @ config.php

try {
    $pdo = new PDO($dbaddr, $dbuser, $dbpwd);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    echo "Yhteys epaonnistui: " . $error ->getMessage();
}


// Optional method to configure database connetion:

// $host = '_SUPERSECRET_';
// $dbname = '_SUPERSECRET_';
// $dbusername = '_SUPERSECRET_';
// $dbpassword = '_SUPERSECRET_';

// try {
//     $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Yhteysvirhe tietokantaan: " . $e->getMessage());
// }