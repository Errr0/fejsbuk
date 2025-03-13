function createAdminContent(){
    const contentDiv = document.createElement('div');
    contentDiv.classList.add('window-content');
        
    contentDiv.textContent = 'Admin';
    // contentDiv.innerHTML = ;
    return contentDiv;
}

function createProfileContent(){
    const contentDiv = document.createElement('div');
    contentDiv.classList.add('window-content');
        
    contentDiv.textContent = 'Profile';
    // contentDiv.innerHTML = ;
    return contentDiv;
}

function createFriandsContent(){
    const contentDiv = document.createElement('div');
    contentDiv.classList.add('window-content');
        
    contentDiv.textContent = 'Friends';
    // contentDiv.innerHTML = ;
    return contentDiv;
}