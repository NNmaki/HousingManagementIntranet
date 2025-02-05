
<?php

// Määritä oletuskieli
$lang_code = isset($_GET['lang']) ? $_GET['lang'] : 'fi';

// Turvallisuustarkistus - sallitaan vain 'fi' ja 'en'
$lang_code = ($lang_code === 'en') ? 'en' : 'fi';

// Sisällytä kielitiedosto
require_once "includes/lang_{$lang_code}.php";

    require_once 'includes/config.php';
    require_once 'includes/signup_view.inc.php';
    require_once 'includes/login_view.inc.php';

    if (isset($_SESSION["user_id"])) {
        try {
            require_once "includes/dbconnect.php";
            $userinfo = $_SESSION["user_kayttajanimi"];
            $query = "SELECT * FROM users WHERE kayttajanimi = :kayttajanimi";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(":kayttajanimi", $userinfo);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pdo = null;
            $stmt = null;   
        } catch (PDOException $error) {
            die("Lahetys epaonnistui: " . $error->getMessage());
        }
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
    <title><?php echo $lang['profile_title']; ?></title>
</head>

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
    <a href="index.php?lang=<?php echo $lang_code; ?>"><button class="basic-button" id="back-btn"><?php echo $lang['loginlinks_btn_home']; ?></button></a>
    <a href="tickets.php?lang=<?php echo $lang_code; ?>"><button class="basic-button" id="tickets-btn"><?php echo $lang['loginlinks_btn_tickets']; ?></button></a>
    </div>

    <div id="divider-line"></div>

    <div class="header">
        <p><?php echo $lang['profile_form_title']; ?></p>
    </div>

    <div class="results-section-userprofile">
    <form action="update_profile.php?lang=<?php echo $lang_code; ?>" method="post">
        <div class="results-section-userprofile-inner">
            <?php if (isset($_SESSION["user_id"])): ?>
                <?php if (empty($results)): ?>
                    <div class="profile-section-notlogged">
                        <p><?php echo $lang['profile_notlogged']; ?></p>
                        <p><?php echo $lang['profile_notlogged_log']; ?></p>
                    </div>
                <?php else: ?>
                    <?php foreach ($results as $row): ?>
                        <div>
                            <label for="kayttajanimi"><?php echo $lang['signup_label_username']; ?></label><br>
                            <input type="text" id="kayttajanimi" name="kayttajanimi" value="<?= htmlspecialchars($row['kayttajanimi']) ?>" readonly>
                        </div>
                        <div>
                            <label for="sahkoposti"><?php echo $lang['signup_label_email']; ?></label>
                            <input type="text" id="sahkoposti" name="sahkoposti" value="<?= htmlspecialchars($row['email']) ?>" readonly>
                        </div>
                        <div>
                            <label for="katuosoite"><?php echo $lang['signup_label_street']; ?></label>
                            <input type="text" id="katuosoite" name="katuosoite" placeholder="<?php echo $lang['login_placeh_street']; ?>" value="<?= htmlspecialchars($row['katuosoite']) ?>" required>
                        </div>
                        <div>
                            <label for="postinumero"><?php echo $lang['signup_label_post']; ?></label>
                            <input type="text" id="postinumero" name="postinumero" placeholder="<?php echo $lang['login_placeh_zip']; ?>" value="<?= htmlspecialchars($row['postinumero']) ?>" required>
                        </div>
                        <div>
                            <label for="kaupunki"><?php echo $lang['signup_label_city']; ?></label>
                            <input type="text" id="kaupunki" name="kaupunki" placeholder="<?php echo $lang['login_placeh_city']; ?>" value="<?= htmlspecialchars($row['kaupunki']) ?>" required>
                        </div>
                        <div>
                            <label for="puhelinnumero"><?php echo $lang['signup_label_phone']; ?></label>
                            <input type="text" id="puhelinnumero" name="puhelinnumero" placeholder="<?php echo $lang['login_placeh_phone']; ?>" value="<?= htmlspecialchars($row['puhelinnumero']) ?>" required>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php else: ?>
                <div class="profile-section-notlogged">
                <p><?php echo $lang['profile_notlogged']; ?></p>
                <p><?php echo $lang['profile_notlogged_log']; ?></p>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION["user_id"])): ?>
                <div>
                    <button type="submit" class="basic-button" id="profile-save-btn"><?php echo $lang['profile_savebtn']; ?></button>
                    <a href="includes/logout.inc.php?lang=<?php echo $lang_code; ?>" title="Kirjaudu ulos">
                        <button type="button" class="basic-button" id="logout-btn"><?php echo $lang['profile_logoutbtn']; ?></button>
                    </a>
                </div>
            <?php else: ?>
                <a href="loginsignup.php?lang=<?php echo $lang_code; ?>" title="Kirjautumissivulle">
                    <button type="button" id="login-page-btn"><?php echo $lang['profile_login']; ?></button>
                </a>
            <?php endif; ?>
        </div>
    </form>
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

<script>
    // Export PHP-language selection to javascript file
    const translations = <?php echo json_encode($lang); ?>;
</script>

<script src="script.js"></script>

</body>
</html>