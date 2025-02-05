
<?php

// This file handles information submitted via sendform.php

// Language settings
$lang_code = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$lang_code = ($lang_code === 'fi') ? 'fi' : 'en'; // Security check

require_once "lang_{$lang_code}.php"; // Include defined language file
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nimi = $_POST["nimi"];
    $taloyhtio = $_POST["taloyhtio"];
    $katuosoite = $_POST["katuosoite"];
    $kaupunki = $_POST["kaupunki"];
    $puhelinnumero = $_POST["puhelinnumero"];
    $paivamaara = $_POST["paivamaara"];
    $vikaseloste = $_POST["vikaseloste"];
    
    try {
        require_once "dbconnect.php";

        $query = "INSERT INTO tickets (nimi, taloyhtio, katuosoite, kaupunki, puhelinnumero, paivamaara, vikaseloste) VALUES (?, ?, ?, ?, ?, ?, ?);";

        $stmt = $pdo->prepare($query);
        $stmt->execute([$nimi, $taloyhtio, $katuosoite, $kaupunki, $puhelinnumero, $paivamaara, $vikaseloste]);

        header("Location: ../sendform.php?status=success&lang=" . $lang_code);

        $pdo = null;
        $stmt = null;

        die();

    } catch (PDOException $error) {
        die("Lahetys epaonnistui: " . $error->getMessage());
        header("Location: ../sendform.php?status=error&lang=" . $lang_code);
        exit();
    }
} else {
    header("Location: ../sendform.php?status=error&lang=" . $lang_code);
    exit();
}