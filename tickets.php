<?php

// Language settings
$lang_code = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$lang_code = ($lang_code === 'fi') ? 'fi' : 'en'; // Security check

require_once "includes/lang_{$lang_code}.php"; // Include defined language file
require_once 'includes/config.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';

try {
    require_once "includes/dbconnect.php";

    $query = "SELECT * FROM tickets ORDER BY created_at DESC;";

    $stmt = $pdo->prepare($query);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdo = null;
    $stmt = null;   

} catch (PDOException $error) {
    die("Lahetys epaonnistui: " . $error->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Karla:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=flash_on" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title><?php echo $lang['tickets_title']; ?></title>
</head>

<script src="script.js"></script>

<body>

<!-- PopUp confirm logout -->
<div id="logoutPopup" class="logout-popup">
    <div class="logout-popup-content">
        <p><?php echo $lang['popup_confirm_content']; ?></p>
        <button id="confirmLogout" class="basic-button"><?php echo $lang['popup_logout_yesbtn']; ?></button>
        <button id="cancelLogout" class="basic-button"><?php echo $lang['popup_logout_nobtn']; ?></button>
    </div>
</div>
<!-- PopUp confirm logout -->

<header class="sticky-header">
        <i><a href="index.php?lang=<?php echo $lang_code; ?>" title="<?php echo $lang['back_to_start']; ?>"><img src="images/nhmlogo_header.png"></a></i>
        <p id="output_username"><?php output_username(); ?></p>
        <nav id="nav-language">
            <a href="index.php?lang=fi">Suomi</a> | <a href="index.php?lang=en">English</a>
        </nav>
        <div class="icons">
            <a href="loginsignup.php?lang=<?php echo $lang_code; ?>" title="<?php echo $lang['login_icon']; ?>" id="login-icon"><i class="fa-solid fa-right-to-bracket fa-xl"></i></a>
            <a href="index.php?lang=<?php echo $lang_code; ?>" title="<?php echo $lang['back_to_start_icon']; ?>"><i class="fa-solid fa-house-flag fa-xl"></i></a>
            <a href="userprofile.php?lang=<?php echo $lang_code; ?>" title="<?php echo $lang['profile_page_icon']; ?>"><i class="fa-regular fa-user fa-xl"></i></a>
            <a href="includes/logout.inc.php?lang=<?php echo $lang_code; ?>" title="<?php echo $lang['logout_icon']; ?>" id="logout-icon"><i class="fa-solid fa-right-from-bracket fa-xl"></i></a>
        </div>    
</header>

<div class="header-section">
    <a href="index.php?lang=<?php echo $lang_code; ?>">
    <img id="logo" src="images/nhmlogo.png">
    </a>
</div>

<div class="form-section">
    <div class="sendform-section-links" id="sendform-section-links">
        <a href="index.php?lang=<?php echo $lang_code; ?>"><button class="basic-button"><?php echo $lang['tickets_btn_home']; ?></button></a>
        <a href="sendform.php?lang=<?php echo $lang_code; ?>"><button class="basic-button"><?php echo $lang['tickets_btn_request']; ?></button></a>
    </div>

    <div id="divider-line"></div>

        <div class="header">
        <p><?php echo $lang['tickets_formtitle']; ?></p>
    </div>

    <div class="results-section-tickets">
    <?php if (empty($results)): ?>
        <div>
            <p>Ei hakutuloksia</p>
        </div>
    <?php else: ?>
        
        
        <?php foreach ($results as $row): ?>
    <div>
        <h3><?= htmlspecialchars($row["nimi"]) ?> - <?= htmlspecialchars($row["kaupunki"]) ?></h3>
        <p><strong><?php echo $lang['tickets_building']; ?></strong>: <?= htmlspecialchars($row["taloyhtio"]) ?></p>
        <p><strong><?php echo $lang['tickets_street']; ?></strong>: <?= htmlspecialchars($row["katuosoite"]) ?></p>
        <p><strong><?php echo $lang['tickets_failure']; ?></strong>: <?= htmlspecialchars($row["vikaseloste"]) ?></p>
        <p><strong><?php echo $lang['tickets_date']; ?></strong>: <?= htmlspecialchars($row["paivamaara"]) ?></p>
    </div>
<?php endforeach; ?>




        
    <?php endif; ?>
    </div>
</div>
   
<div class="footer-section">
    <div class="footer-el">
        <img id="logo-footer" src="images/nhmlogo.png">
    </div>
    <div class="footer-el">
        <p>Nico's Housing Management</p>
        <p>Siltakatu 5 B</p>
        <p>30540 Kuopio</p>
    </div>
    <div class="footer-el">
        <p>Email: info@housingmanagement.com</p>
        <p>Web: housingmanagement.com</p>
        <p>p. +358 40 123 4567</p>
    </div> 
</div>

</body>
</html>