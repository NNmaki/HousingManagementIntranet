
// Message sended notification and disclaimer popup and close button funtion:
document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('popup').style.display = 'none';
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');
    if (status === 'success' || status === 'error') {
        const popup = document.getElementById('popup'); 
        const message = document.getElementById('popup-message');
        const messageContent = document.getElementById('popup-message-content');
        if (status === 'success') {
            message.textContent = translations['popup_message_received']; 
            messageContent.textContent = translations['popup_message_contact24']; 
        } else {
            message.textContent = translations['popup_notification_error'];
        }
        popup.style.display = 'flex';       
    } else {
        const popupDisc = document.getElementById('popupDisc');
        popupDisc.style.display = 'flex';
    }
});

function closePopup() {
    document.getElementById('popup').style.display = 'none';
    const url = new URL(window.location.href);
    url.searchParams.delete('status');
    window.history.replaceState({}, document.title, url.toString());
};

function closePopupDisc() {
    document.getElementById('popupDisc').style.display = 'none';
    const url = new URL(window.location.href);
    url.searchParams.delete('status');
    window.history.replaceState({}, document.title, url.toString());
};

// Login success popup:
document.addEventListener("DOMContentLoaded", function () {
    window.showSuccessLoginPopup = function () {
        document.getElementById("successLoginPopup").style.display = "block";
    };
    window.closeLoginPopup = function () {
        document.getElementById("successLoginPopup").style.display = "none";
    };
	if (document.getElementById("loginSuccess")) {
        showLoginSuccessPopup();
    }
});

function showLoginSuccessPopup() {
    document.getElementById("successLoginPopup").style.display = "block";
}

function closeLoginPopup() {
    document.getElementById("successLoginPopup").style.display = "none";
}

// Logout success popup:
document.addEventListener("DOMContentLoaded", function () {
    const logoutButton = document.getElementById("logout-icon"); 
    const logoutPopup = document.getElementById("logoutPopup"); 
    const confirmLogout = document.getElementById("confirmLogout");
    const cancelLogout = document.getElementById("cancelLogout");

    if (logoutButton && logoutPopup) {
        logoutButton.addEventListener("click", function (event) {
            event.preventDefault();
            logoutPopup.style.display = "block"; 
        });

        confirmLogout.addEventListener("click", function () {
            window.location.href = "includes/logout.inc.php";
        });

        cancelLogout.addEventListener("click", function () {
            logoutPopup.style.display = "none";
        });
    }
});

// Confirm logout popup:
document.addEventListener("DOMContentLoaded", function () {
    const logoutButton = document.getElementById("logout-btn"); 
    const logoutPopup = document.getElementById("logoutPopup"); 
    const confirmLogout = document.getElementById("confirmLogout");
    const cancelLogout = document.getElementById("cancelLogout");
    const urlParams = new URLSearchParams(window.location.search);
    const lang = urlParams.get('lang') || 'en'; // Default language if not defined

    if (logoutButton && logoutPopup) {
        logoutButton.addEventListener("click", function (event) {
            event.preventDefault();
            logoutPopup.style.display = "block"; 
        });

        confirmLogout.addEventListener("click", function () {
            window.location.href = `includes/logout.inc.php?lang=${lang}`;
        });

        cancelLogout.addEventListener("click", function () {
            logoutPopup.style.display = "none";
        });
    }
});

// Success signup popup:
document.addEventListener("DOMContentLoaded", function () {
    window.showSuccessSignupPopup = function () {
        document.getElementById("successSignupPopup").style.display = "block";
    };
    window.closeSignupPopup = function () {
        document.getElementById("successSignupPopup").style.display = "none";
    };
	if (document.getElementById("signupSuccess")) {
        showSignupSuccessPopup();
    }
});

function showSignupSuccessPopup() {
    document.getElementById("successSignupPopup").style.display = "block";
}

function closeSignupPopup() {
    document.getElementById("successSignupPopup").style.display = "none";
}


// Success update popup:
document.addEventListener("DOMContentLoaded", function () {
    window.showSuccessUpdatePopup = function () {
        document.getElementById("successUpdatePopup").style.display = "block";
    };
    window.closeUpdatePopup = function () {
        document.getElementById("successUpdatePopup").style.display = "none";
    };
	if (document.getElementById("updateSuccess")) {
        showUpdateSuccessPopup();
    }
});

function showUpdateSuccessPopup() {
    document.getElementById("successUpdatePopup").style.display = "block";
}
         
function closeUpdateSuccessPopup() {
    document.getElementById("successUpdatePopup").style.display = "none";
}
