<?php

// Controller file of MVC-architechture and handles user inputs, functions and sends/updates data to View or controller

declare(strict_types=1);
function is_input_empty(string $username, string $pwd) {
   
    if (empty($username) || empty($pwd)) {
        return true;
    } else {
        return false;
    }
};
function is_username_wrong(bool | array $result) {
   
    if (!$result) {
        return true;
    } else {
        return false;
    }
}
function is_password_wrong(string $pwd, string $hashedPwd) {
   
    if (!password_verify($pwd, $hashedPwd)) {
        return true;
    } else {
        return false;
    }
}

