<?php

// Main file for login-function. Script checks if there is any errors, and if not it creates new session with id.

// Language settings
$lang_code = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$lang_code = ($lang_code === 'fi') ? 'fi' : 'en'; // Security check

require_once "lang_{$lang_code}.php"; // Include defined language file

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["kayttajanimi"];
    $pwd = $_POST["salasana"];

    try {
        require_once 'dbconnect.php';
        require_once 'login_model.inc.php';
        require_once 'login_contr.inc.php';

        // Error handlers:
        $errors = [];

        if (is_input_empty($username, $pwd)) {
        $errors["empty_input"] =  $lang['error_allfields'];
        }  

        $result = get_user($pdo, $username);

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = $lang['error_checkuser'];
        }

        if (!is_username_wrong($result) && is_password_wrong($pwd, $result["salasana"])) {
            $errors["login_incorrect"] = $lang['error_check'];
        }

        require_once 'config.php'; // Loads paremeters from config file for setting new session.

        if ($errors) {
            $_SESSION["errors_login"] = $errors;
            header("Location:  ../loginsignup.php?lang=" . $lang_code);
            die();
        }

        // if no errors, create new session id combined with user id
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_kayttajanimi"] = htmlspecialchars  ($result["kayttajanimi"]);
        $_SESSION["last_generation"] = time();

        header("Location: ../loginsignup.php?login=success&lang=" . $lang_code);
        $pdo = null;
        $stmt = null;
        die();
        
    } catch (PDOException $e) {
        die("Kirjautuminen epaonnistui: " . $e->getMessage()); 
    }

} else {
    header("Location:  ../loginsignup.php?lang=" . $lang_code);
        $pdo = null;
    die();
}
