function createAdminWindow() {
    var windowId = "adminWindow";
    var oldWindow = document.getElementById(windowId)
    if(oldWindow){
        oldWindow.remove();
    }

    var output = createWindow(windowId, "Admin", 400, 400);
    var windowDiv = output[0];
    var titleBar = output[1];

    windowDiv.appendChild(createAdminContent());
    document.getElementById("body").appendChild(windowDiv);
    makeDraggable(windowDiv, titleBar);
}

function createProfileWindow() {
    var windowId = "profileWindow";
    var oldWindow = document.getElementById(windowId);
    if(oldWindow){
        oldWindow.remove();
    }

    var output = createWindow(windowId, "Profile", 50, 50);
    var windowDiv = output[0];
    var titleBar = output[1];

    windowDiv.appendChild(createProfileContent());
    document.getElementById("body").appendChild(windowDiv);
    makeDraggable(windowDiv, titleBar);
}

function createFriendsWindow() {
    var windowId = "friandsWindow";
    var oldWindow = document.getElementById(windowId);
    if(oldWindow){
        oldWindow.remove();
    }

    var output = createWindow(windowId, "Znajomi", 50, 50);
    var windowDiv = output[0];
    var titleBar = output[1];

    windowDiv.appendChild(createProfileContent());
    document.getElementById("body").appendChild(windowDiv);
    makeDraggable(windowDiv, titleBar);
}

document.getElementById('friendsButton').addEventListener('click', createFriendsWindow);
document.getElementById('adminButton').addEventListener('click', createAdminWindow);
document.getElementById('profileButton').addEventListener('click', createProfileWindow);
// document.getElementById('optionsButton').addEventListener('click', createAdminWindow);