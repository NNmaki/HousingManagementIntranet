<?php

// View file of MVC-architechture and handles showing information and data to user (data sended by controller file)

declare(strict_types=1);

$lang_code = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$lang_code = ($lang_code === 'fi') ? 'fi' : 'en'; // Security check

require_once "lang_{$lang_code}.php";

function output_username() {
    global $lang;
    if(isset($_SESSION["user_id"])) {
        echo $lang['logged_in_as'] . $_SESSION["user_kayttajanimi"];
    } else {
        echo $lang['not_logged_in'];
    }
}
function output_username_only() {
    global $lang;
    if(isset($_SESSION["user_id"])) {
        echo $_SESSION["user_kayttajanimi"];
    } else {
        echo $lang['not_logged_in'];
    }
}
function check_login_errors() {
    if (isset($_SESSION['errors_login'])) {
        $errors = $_SESSION["errors_login"];
        echo "<br>";
        echo "<div class='error-container'>";
        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>'; 
        }
        echo "</div>";
        unset($_SESSION["errors_login"]);
    } else if  (isset($_GET['login']) && $_GET ['login'] === "success") {
        echo "<div id='loginSuccess' data-success='true' style='display:none;'></div>";
    }
} 
