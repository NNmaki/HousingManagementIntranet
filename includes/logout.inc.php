<?php

// File handles what happens if user logs out

// Language settings
$lang_code = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$lang_code = ($lang_code === 'fi') ? 'fi' : 'en'; // Security check

require_once "lang_{$lang_code}.php"; // Include defined language file

session_start();
session_unset();
session_destroy();
header("Location: ../loginsignup.php?lang=" . $lang_code);

die();