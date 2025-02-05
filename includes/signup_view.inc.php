<?php

// View file of MVC-architechture and handles showing information and data to user (data sended by controller file)

declare(strict_types=1);

function check_signup_errors() {
    if (isset($_SESSION['errors_signup'])) {
        $errors = $_SESSION['errors_signup'];
        echo '<br>';
        echo "<div class='error-container'>";
        foreach ($errors as $error) {
            echo '<p class="form-error">' . $error . '</p>'; 
        }
        echo '</div>';
        unset($_SESSION['errors_signup']);

    } else if (isset($_GET["signup"]) && $_GET["signup"] === "success") {
        echo "<div id='signupSuccess' data-success='true' style='display:none;'></div>";
    }
} 


