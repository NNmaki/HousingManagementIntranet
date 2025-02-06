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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <title><?php echo $lang['login_title']; ?></title>
</head> 

<body>

<!-- PopUp succes login -->
<div id="successLoginPopup" class="login-popup">
    <div class="login-popup-content">
        <p><?php echo $lang['popup_successlogin_title']; ?></p>
        <p><?php echo $lang['popup_successlogin_welcome']; ?> <?php output_username_only(); ?></p> 
        
        <button class="basic-button" onclick="closeLoginPopup()">OK</button>
    </div>
</div>
<!-- PopUp success login -->

<!-- PopUp confirm logout -->
<div id="logoutPopup" class="logout-popup">
    <div class="logout-popup-content">
        <p><?php echo $lang['popup_confirm_content']; ?></p>
        <button id="confirmLogout" class="basic-button"><?php echo $lang['popup_logout_yesbtn']; ?></button>
        <button id="cancelLogout" class="basic-button"><?php echo $lang['popup_logout_nobtn']; ?></button>
    </div>
</div>
<!-- PopUp confirm logout -->

<!-- PopUp succes signup -->
        <div id="successSignupPopup" class="signup-popup">
        <div class="signup-popup-content">
            <p><?php echo $lang['popup_signup_title']; ?></p>
            <p><?php echo $lang['popup_signup_welcome']; ?></p> 
            <button class="basic-button" onclick="closeSignupPopup()">OK</button>
        </div>
    </div>
<!-- PopUp succes signup -->

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
    
    <div class="header">
        <p>NICO'S HOME MANAGEMENT - INTRANET</p>
    </div>

    <div id="divider-line"></div>

    <div class="login-section-login" id="login-section-login">
    <div class="login-group-profile">
        <?php if (!isset($_SESSION["user_id"])): ?>
            <form action="includes/login.inc.php?lang=<?php echo $lang_code; ?>" method="post">
                <h2><?php echo $lang['login_login']; ?></h2>
                <div class="login-group">
                    <label for="kayttajanimi"><?php echo $lang['login_label_username']; ?></label>
                    <input type="text" name="kayttajanimi" placeholder="<?php echo $lang['login_placeh_username']; ?>">
                </div>
                <div class="login-group">
                    <label for="salasana"><?php echo $lang['login_label_password']; ?></label>
                    <input type="password" name="salasana" placeholder="<?php echo $lang['login_placeh_password']; ?>">
                </div>
                <button id="login-btn"><?php echo $lang['login_btn_login']; ?></button>
            </form>
        <?php else: ?>
            <h2><?php echo $lang['login_logged_in_as']; ?></h2>
            <h1><?php output_username_only(); ?></h1>
            <div class="profile-buttons">
                <a href="userprofile.php?lang=<?php echo $lang_code; ?>" title="Tarkastele tietojasi">
                    <button type="button" class="basic-button" id="profile-btn"><?php echo $lang['login_btn_user']; ?></button>
                </a>
                <a href="includes/logout.inc.php?lang=<?php echo $lang_code; ?>" title="Kirjaudu ulos">
                    <button type="button" class="basic-button" id="logout-btn"><?php echo $lang['login_btn_logout']; ?></button>
                </a>
            </div>
        <?php endif; ?>
    </div>
    <?php check_login_errors(); ?>
    </div>

    <?php if (!isset($_SESSION["user_id"])): ?>
    <div id="divider-line"></div>
    <div class="login-section-signup" id="login-section-signup">
        <form action="includes/signup.inc.php?lang=<?php echo $lang_code; ?>" method="post">
            <h2><?php echo $lang['signup_register']; ?></h2>
            <div class="login-group">

            <label for="kayttajanimi"><?php echo $lang['signup_label_username']; ?></label>
            <input type="text" name="kayttajanimi" placeholder="<?php echo $lang['login_placeh_username']; ?>">
            </div>
        
            <div class="login-group">
            <label for="salasana"><?php echo $lang['signup_label_password']; ?></label>
            <input type="password" name="salasana" placeholder="<?php echo $lang['login_placeh_password']; ?>">
            </div>
        
            <div class="login-group">
            <label for="sahkoposti"><?php echo $lang['signup_label_email']; ?></label>
            <input type="text" name="sahkoposti" placeholder="<?php echo $lang['login_placeh_email']; ?>">
            </div>
        
            <button id="signup-btn"><?php echo $lang['signup_btn_register']; ?></button>
        </form>
    
        <?php
    check_signup_errors();
    ?>

    <?php else: ?>
            <div></div>
    <?php endif; ?>
    
       <div id="divider-line"></div>

        <div class="login-section-links" id="login-section-links">
            <a href="index.php?lang=<?php echo $lang_code; ?>"><button class="basic-button"><?php echo $lang['loginlinks_btn_home']; ?></button></a>
            <a href="tickets.php?lang=<?php echo $lang_code; ?>"><button class="basic-button"><?php echo $lang['loginlinks_btn_tickets']; ?></button></a>
        </div>

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