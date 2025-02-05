<?php

// Main file for signup-system. Script checks if there is any errors, and if not it creates user (with set_user() and create_user() -functions on signup_model.inc.php and signup_contr.in.php files included)

// Language settings
$lang_code = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$lang_code = ($lang_code === 'fi') ? 'fi' : 'en'; // Security check


require_once "lang_{$lang_code}.php"; // Include defined language file;

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST["kayttajanimi"];
    $pwd = $_POST["salasana"];
    $email = $_POST["sahkoposti"];

    try {
        
        require_once 'dbconnect.php';
        require_once 'signup_model.inc.php';
        require_once 'signup_contr.inc.php';

        // Error handlers:
        $errors = [];

        if (is_input_empty($username, $pwd, $email)) {
        $errors["empty_input"] = $lang['error_allfields'];
        }  
        if (is_email_invalid($email)) {
        $errors["invalid_email"] = $lang['error_checkemail'];
        }
        if (is_username_taken($pdo, $username)) {
        $errors["username_taken"] = $lang['error_usernametaken'];
        }
        if (is_email_registered($pdo, $email)) {
        $errors["email_used"] = $lang['error_emailused'];
        } 

        require_once 'config.php';

        if ($errors) {
            $_SESSION["errors_signup"] = $errors;
            
            $signupData = [                     // not in use
                "kayttajanimi" => $username,    // not in use
                "sahkoposti" => $email          // not in use
            ];

            $_SESSION["signup_data"] = $signupData;
            header("Location:  ../loginsignup.php?lang=" . $lang_code);
            die();
        }

        // If no errors, create user and crab signup=success
        create_user($pdo, $pwd, $username, $email);
        header("Location:  ../loginsignup.php?signup=success&lang=" . $lang_code);
        $pdo = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        die("Rekisteroityminen epaonnistui: " . $e->getMessage());
    }

} else {
    header("Location:  ../loginsignup.php?lang=" . $lang_code);
    die();
}