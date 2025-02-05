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
    <title><?php echo $lang['sendform_title']; ?></title>
</head>

<body>

<!-- PopUp Message sent -->
<div id="popup" class="popup">
    <div class="popup-content">
        <p id="popup-message"></p>
        <p id="popup-message-content"></p>
        <button class="close-btn" id="close-btn" onclick="closePopup()"><?php echo $lang['popup_message_closebtn']; ?></button>
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

<div class="form-section">
    <div class="sendform-section-links" id="sendform-section-links">
            <a href="index.php?lang=<?php echo $lang_code; ?>"><button class="basic-button"><?php echo $lang['loginlinks_btn_home']; ?></button></a>
            <a href="tickets.php?lang=<?php echo $lang_code; ?>"><button class="basic-button"><?php echo $lang['loginlinks_btn_tickets']; ?></button></a>
    </div>

    <div id="divider-line"></div>

    <div class="header">
        <p><?php echo $lang['sendform_formtitle']; ?></p>
    </div>

    <form class="form-container" action="includes/sendformhandler.php?lang=<?php echo $lang_code; ?>" method="post" >

        <div class="form-group">
        <label for="nimi"><?php echo $lang['sendform_label_name']; ?></label>
        <input type="text" name="nimi" placeholder="<?php echo $lang['sendform_placeh_name']; ?>" required>
        </div>
        
        <div class="form-group">
        <label for="taloyhtio"><?php echo $lang['sendform_label_building']; ?></label>
        <input type="text" name="taloyhtio" placeholder="<?php echo $lang['sendform_placeh_building']; ?>" required>
        </div>
        
        <div class="form-group">
        <label for="katuosoite"><?php echo $lang['sendform_label_street']; ?></label>
        <input type="text" name="katuosoite" placeholder="<?php echo $lang['sendform_placeh_street']; ?>">
        </div>
        
        <div class="form-group">
        <label for="kaupunki"><?php echo $lang['sendform_label_city']; ?></label>
        <input type="text" name="kaupunki" placeholder="<?php echo $lang['sendform_placeh_city']; ?>" required>
        </div>
        
        <div class="form-group">
        <label for="puhelinnumero"><?php echo $lang['sendform_label_phone']; ?></label>
        <input type="text" name="puhelinnumero" placeholder="<?php echo $lang['sendform_placeh_phone']; ?>" required>
        </div>

        <div class="form-group">
        <label for="paivamaara"><?php echo $lang['sendform_label_date']; ?></label>
        <input type="date" name="paivamaara" placeholder="" required>
        </div>

        <div class="form-group">
        <label for="vikaseloste"><?php echo $lang['sendform_label_failure']; ?></label>
        <input type="textarea" name="vikaseloste" placeholder="<?php echo $lang['sendform_placeh_failure']; ?>" required>             
        </div>

        <div class="form-buttons">
        <button id="sendform-sendbtn" type="submit"><?php echo $lang['sendform_btn_send']; ?></button>
        <button id="sendform-clearbtn" type="reset"><?php echo $lang['sendform_btn_clear']; ?></button>  
        </div>
    </form>    
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

</div>

<script>
    // Export PHP-language selection to javascript file
    const translations = <?php echo json_encode($lang); ?>;
</script>

<script src="script.js"></script>

</body>
</html>