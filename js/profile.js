function showIdentity() {
    var identitySection = document.getElementById("identitySection");
    var settingsSection = document.getElementById("settingsSection");
    var changepassSection = document.getElementById("changepassSection");
    var notificationsSection = document.getElementById("notificationsSection");

    identitySection.style.display = "block";
    settingsSection.style.display = "none";
    changepassSection.style.display = "none";
    notificationsSection.style.display = "none";
}

function showSettings() {
    var identitySection = document.getElementById("identitySection");
    var settingsSection = document.getElementById("settingsSection");
    var changepassSection = document.getElementById("changepassSection");
    var notificationsSection = document.getElementById("notificationsSection");

    identitySection.style.display = "none";
    settingsSection.style.display = "block";
    changepassSection.style.display = "none";
    notificationsSection.style.display = "none";
}

function showChangePassword() {
    var identitySection = document.getElementById("identitySection");
    var settingsSection = document.getElementById("settingsSection");
    var changepassSection = document.getElementById("changepassSection");
    var notificationsSection = document.getElementById("notificationsSection");

    identitySection.style.display = "none";
    settingsSection.style.display = "none";
    changepassSection.style.display = "block";
    notificationsSection.style.display = "none";
}

function showNotifications() {
    var identitySection = document.getElementById("identitySection");
    var settingsSection = document.getElementById("settingsSection");
    var changepassSection = document.getElementById("changepassSection");
    var notificationsSection = document.getElementById("notificationsSection");

    identitySection.style.display = "none";
    settingsSection.style.display = "none";
    changepassSection.style.display = "none";
    notificationsSection.style.display = "block";
}


window.onload = function() {
    checkAnchor();
};


function checkAnchor() {
    var hash = window.location.hash;

    if (hash === "#settings") {
        showSettings();
    } else if (hash === "#changepass") {
        showChangePassword();
    } else if (hash === "#notifications") {
        showNotifications();
    } else {
        showIdentity();
    }
}