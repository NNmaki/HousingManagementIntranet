<?php

// Model file of MVC-architechture and handles interacting with database (queries) (getting or writing data for database.

declare(strict_types=1);

function get_user(object $pdo, string $username) {
    $query = "SELECT * FROM users WHERE kayttajanimi = :kayttajanimi;";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":kayttajanimi", $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
}