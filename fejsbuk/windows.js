async  function createAdminWindow() {
    var windowId = "adminWindow";
    var oldWindow = document.getElementById(windowId)
    if(oldWindow){
        oldWindow.remove();
    }

    var output = createWindow(windowId, "Admin", 400, 400);
    var windowDiv = output[0];
    var titleBar = output[1];

    windowDiv.appendChild(await createAdminContent());
    document.getElementById("body").appendChild(windowDiv);
    makeDraggable(windowDiv, titleBar);
}

async  function createPasswordChangeWindow() {
    var windowId = "passwordChangeWindow";
    var oldWindow = document.getElementById(windowId)
    if(oldWindow){
        oldWindow.remove();
        console.log("aaaa");
    }

    var output = createWindow(windowId, "Zmiana Hasła", 300, 200, 400, 250);
    var windowDiv = output[0];
    var titleBar = output[1];

    windowDiv.appendChild(await createPasswordChangeContent());
    document.getElementById("body").appendChild(windowDiv);
    makeDraggable(windowDiv, titleBar);
}

async function createProfileWindow() {
    var windowId = "profileWindow";
    var oldWindow = document.getElementById(windowId);
    if(oldWindow){
        oldWindow.remove();
    }

    var output = createWindow(windowId, "Profil", 50, 50, 400, 300);
    var windowDiv = output[0];
    var titleBar = output[1];

    windowDiv.appendChild(await createProfileContent());
    document.getElementById("body").appendChild(windowDiv);
    console.log(document.getElementById('changePasswordButton'));
    document.getElementById('changePasswordButton').addEventListener('click', createPasswordChangeWindow);
    makeDraggable(windowDiv, titleBar);
}

async function createFriendsWindow() {
    var windowId = "friandsWindow";
    var oldWindow = document.getElementById(windowId);
    if(oldWindow){
        oldWindow.remove();
    }

    var output = createWindow(windowId, "Znajomi", 50, 50);
    var windowDiv = output[0];
    var titleBar = output[1];

    windowDiv.appendChild(await createProfileContent());
    document.getElementById("body").appendChild(windowDiv);
    makeDraggable(windowDiv, titleBar);
}

// document.getElementById('friendsButton').addEventListener('click', createFriendsWindow);
adminButton = document.getElementById('adminButton');
if(adminButton){
    adminButton.addEventListener('click', createAdminWindow);
}
document.getElementById('profileButton').addEventListener('click', createProfileWindow);
// document.getElementById('optionsButton').addEventListener('click', createAdminWindow);