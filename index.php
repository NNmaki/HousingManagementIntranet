<?php

// Language settings
$lang_code = isset($_GET['lang']) ? $_GET['lang'] : 'en';
$lang_code = ($lang_code === 'fi') ? 'fi' : 'en'; // Security check


require_once "includes/lang_{$lang_code}.php"; // Include defined language file
require_once 'includes/config.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/login_view.inc.php';
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
    <title><?php echo $lang['title']; ?></title>
</head>

<body>

<!-- PopUp disclaimer-->
<div id="popupDisc" class="popupDisc">
    <div class="popupDisc-content">
        <p id="popupDisc-content">
            <span class="material-symbols-outlined">flash_on</span>
            <span class="material-symbols-outlined">flash_on</span>
            <span class="material-symbols-outlined">flash_on</span>
            <span class="material-symbols-outlined">flash_on</span>
            <span class="material-symbols-outlined">flash_on</span>
        </p>
        <p>
        <p><strong>Attention!</strong></p>  <p>This is not a real-life solution, this is a practice project made for educational purposes. The information submitted via the form will not be processed in any way. However, please do not submit any real personal information.
        This website also uses cookies to manage sessions, but they are not collected or used further.</p><br>
        <button class="basic-button" id="close-disc-btn" onclick="closePopupDisc()" >OK</button>
        <p><strong>Huomio!</strong></p><p>Tämä ei ole oikea yritys eikä sovellus, vaan opiskelutarkoituksessa tehty harjoitustyö. Lomakkeella jätettyjä tietoja ei käsitellä millään tavalla. Älä kuitenkaan jätä lomakkeella salasanoja tai oikeita henkilötietojasi.<br>
        Tämä sivusto käyttää myös evästeitä hallinnoimaan istuntoja, mutta niitä ei kerätä eikä käytetä jatkossa.</p>
        <button class="basic-button" id="close-disc-btn" onclick="closePopupDisc()" >OK</button>
    </div>
</div>
<!-- PopUp disclaimer-->

<!-- PopUp Message sent -->
<div id="popup" class="popup">
    <div class="popup-content">
        <p id="popup-message"></p>
        <p id="popup-message-content"></p>
        <button class="basic-button" id="close-btn" onclick="closePopup()"><?php echo $lang['popup_message_closebtn']; ?></button>
    </div>
</div>
<!-- PopUp Message sent -->

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

<div class="fp-header">
    <p><?php echo $lang['fp-header-title']; ?></p>
</div>

<div class="fp-main-section">    
    <div class="fp-main-section-inner">
        <div class="fp-main-container">
        <a href="loginsignup.php?lang=<?php echo $lang_code; ?>">
        <img src="images/kirjaudu.png" alt="Kirjaudu tai rekisteröidy Ikoni">
        <h2><?php echo $lang['login']; ?></h2>
        <p><?php echo $lang['login_desc']; ?></p>
        <p><?php echo $lang['register_info']; ?></p>
        </a>
        </div>
        
        <div class="fp-main-container">
        <a href="sendform.php?lang=<?php echo $lang_code; ?>">
        <img src="images/jatailmoitus.png" alt="Jätä Ilmoitus Ikoni">
        <h2><?php echo $lang['submit_notice']; ?></h2>
        <p><?php echo $lang['submit_notice_desc']; ?></p>
        <p><?php echo $lang['notice_info']; ?></p>
        </a>
        </div>
    </div>
</div>
    
<div class="footer-section">
    <div class="footer-el">
</div>

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

<div class="footer-el">
</div>

<script>
    // Export PHP-language selection to javascript file
    const translations = <?php echo json_encode($lang); ?>;
</script>

<script src="script.js"></script>

</body>
</html>