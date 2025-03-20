async function createAdminContent(){
    const contentDiv = document.createElement('div');
    contentDiv.classList.add('window-content');
        
    contentDiv.textContent = 'Admin';
    // contentDiv.innerHTML = 
    return contentDiv;
}

async function createPasswordChangeContent(){
    const contentDiv = document.createElement('div');
    contentDiv.classList.add('window-content');
    contentDiv.innerHTML = "<form method=\"post\">"
    + "<input required type=\"password\" name=\"password\" placeholder=\"haslo\" maxlength=\"32\">"
    + "<input required type=\"password\" name=\"password2\" placeholder=\"powtórz haslo\" maxlength=\"32\">"
    + "<button name=\"changePassword\" class=\"form_button\">Zmień hasło</button>"
    + "</form>";
    return contentDiv;
}

async function createProfileContent(){
    const contentDiv = document.createElement('div');
    contentDiv.classList.add('window-content');
    var userData = await getProfileData();
    contentDiv.innerHTML = "<h2>"+userData.name+"</h2>"
    + "<button id=\"changePasswordButton\" class=\"form_button\">Zmień hasło</button>"
    + "<button id=\"deleteAccountButton\" class=\"form_button\" onclick=\"deleteAccount()\">Usuń konto</button>";
    return contentDiv;
}

async function createFriandsContent(){
    const contentDiv = document.createElement('div');
    contentDiv.classList.add('window-content');
        
    contentDiv.textContent = 'Friends';
    // contentDiv.innerHTML = ;
    return contentDiv;
}