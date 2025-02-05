<?php

declare(strict_types=1);

// Model file of MVC-architechture and handles interacting with database (queries) (getting or writing data for database).

function get_username(object $pdo, string $username) {
    $query = "SELECT kayttajanimi FROM users WHERE kayttajanimi = :kayttajanimi;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":kayttajanimi", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function get_email(object $pdo, string $email) {
    $query = "SELECT email FROM users WHERE email = :sahkoposti;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":sahkoposti", $email);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function set_user(object $pdo, string $username, string $pwd, string $email) {
    $query = "INSERT INTO users (kayttajanimi, salasana, email) VALUES 
    (:kayttajanimi, :salasana, :sahkoposti);";
     $stmt = $pdo->prepare($query);
    $options = [
        'cost' => 12
    ];
    $hashedPwd = password_hash($pwd, PASSWORD_BCRYPT, $options);
     $stmt->bindParam(":kayttajanimi", $username);
     $stmt->bindParam(":salasana", $hashedPwd);
     $stmt->bindParam(":sahkoposti", $email);
     $stmt->execute();
}