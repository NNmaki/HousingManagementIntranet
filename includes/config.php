
<?php

// Config file which starts session and create cookie and session id. Some cases overrides servers php.ini parameters

ini_set('session.auto_start', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.use_strict_mode', 1);

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => 'localhost',      // choose this for local environment
    // 'domain' => 'nnmaki.com',    // choose this for published
    'path' => '/',
    'secure' => true,
    'httponly' => true,
]);

session_start();

if (isset($_SESSION["user_id"])) {
    if (!isset($_SESSION['last_regeneration'])) { 
        regenerate_session_id_loggedin();
    } else {
        $interval = 60 * 10;
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id_loggedin();
        }
    }
} else {
    if (!isset($_SESSION['last_regeneration'])) { 
        regenerate_session_id();
    } else {
        $interval = 60 * 10;
        if (time() - $_SESSION['last_regeneration'] >= $interval) {
            regenerate_session_id();
        }
    }
}
function regenerate_session_id_loggedin() {
    session_regenerate_id(true); 
    $userId = $_SESSION["user_id"];
    $newSessionId = session_id() . "_" . $userId; // Create unique ID
    $_SESSION["custom_session_id"] = $newSessionId; // Save unique ID to session. 
    $_SESSION["last_generation"] = time();
}
function regenerate_session_id() {
    session_regenerate_id(true);
    $_SESSION["last_generation"] = time();
}


// Alkuperainen koodi joka antoi virheilmoituksen etta sessiota ei voi kaynnistaa kun vanha on kaynnissa:
// function regenerate_session_id_loggedin() {
//     session_regenerate_id(true);
//     $userId = $_SESSION["user_id"];
//     $newSessionId = session_create_id();
//     $sessionId = $newSessionId . "_" . $userId;
//     session_id($sessionId);
//     $_SESSION["last_generation"] = time();
// }




