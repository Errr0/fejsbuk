let windowCount = 0;



function createAdminWindow() {
    windowCount++;

    const windowDiv = document.createElement('div');
    windowDiv.classList.add('custom-window');
    windowDiv.id = `adminWindow-${windowCount}`;
    windowDiv.style.top = `${50 + windowCount * 20}px`;
    windowDiv.style.left = `${50 + windowCount * 20}px`;

    const titleBar = document.createElement('div');
    titleBar.classList.add('window-title');
    titleBar.innerHTML = `<span>Admin</span>`;

    const closeBtn = document.createElement('button');
    closeBtn.classList.add('close-btn');
    closeBtn.innerHTML = '&times;';
    closeBtn.addEventListener('click', () => {
        windowDiv.remove();
    });

    titleBar.appendChild(closeBtn);

    const contentDiv = document.createElement('div');
    contentDiv.classList.add('window-content');
    contentDiv.textContent = '';//text in the window

    windowDiv.appendChild(titleBar);
    windowDiv.appendChild(contentDiv);

    const positions = ["top", "right", "bottom", "left", "top-left", "top-right", "bottom-left", "bottom-right"];
    positions.forEach(pos => {
        const handle = document.createElement("div");
        handle.classList.add("resize-handle", pos);
        windowDiv.appendChild(handle);
        makeResizable(windowDiv, handle, pos);
    });

    document.getElementById("body").appendChild(windowDiv);
    makeDraggable(windowDiv, titleBar);
}


function createWindow() {
    windowCount++;

    const windowDiv = document.createElement('div');
    windowDiv.classList.add('custom-window');
    windowDiv.id = `window-${windowCount}`;
    windowDiv.style.top = `${50 + windowCount * 20}px`;
    windowDiv.style.left = `${50 + windowCount * 20}px`;

    const titleBar = document.createElement('div');
    titleBar.classList.add('window-title');
    titleBar.innerHTML = `<span>Okno ${windowCount}</span>`;

    const closeBtn = document.createElement('button');
    closeBtn.classList.add('close-btn');
    closeBtn.innerHTML = '&times;';
    closeBtn.addEventListener('click', () => {
        windowDiv.remove();
    });

    titleBar.appendChild(closeBtn);

    const contentDiv = document.createElement('div');
    contentDiv.classList.add('window-content');
    contentDiv.textContent = '';//text in the window

    windowDiv.appendChild(titleBar);
    windowDiv.appendChild(contentDiv);

    const positions = ["top", "right", "bottom", "left", "top-left", "top-right", "bottom-left", "bottom-right"];
    positions.forEach(pos => {
        const handle = document.createElement("div");
        handle.classList.add("resize-handle", pos);
        windowDiv.appendChild(handle);
        makeResizable(windowDiv, handle, pos);
    });

    document.getElementById("body").appendChild(windowDiv);
    makeDraggable(windowDiv, titleBar);
}

function makeDraggable(windowElement, titleBar) {
    let isDragging = false;
    let offsetX, offsetY;

    titleBar.addEventListener('mousedown', (e) => {
        isDragging = true;
        offsetX = e.clientX - windowElement.offsetLeft;
        offsetY = e.clientY - windowElement.offsetTop;
        titleBar.style.cursor = "grabbing";
    });

    document.addEventListener('mousemove', (e) => {
        if (isDragging) {
            windowElement.style.left = e.clientX - offsetX + 'px';
            windowElement.style.top = e.clientY - offsetY + 'px';
        }
    });

    
    document.addEventListener('mouseup', () => {
        isDragging = false;
        titleBar.style.cursor = "grab";
        console.log(window.innerHeight-110)
        console.log(windowElement.style.top)
        if(parseInt(windowElement.style.top) < 0){
            windowElement.style.top = '0px'
        } else if(parseInt(windowElement.style.top) > window.innerHeight-150){
            windowElement.style.top = window.innerHeight - 150 +'px'
            console.log(windowElement.style.top)
        }
        // if(parseInt(windowElement.style.right) < 0){
        //     windowElement.style.left = '0px'
        // } else if(parseInt(windowElement.style.left) > window.innerWidth-10){
        //     windowElement.style.right = window.innerWidth +'px'
        // }
    });
}

function makeResizable(windowElement, handle, position) {
    let isResizing = false;
    let startX, startY, startWidth, startHeight, startTop, startLeft;

    handle.addEventListener('mousedown', (e) => {
        e.preventDefault();
        isResizing = true;

        startX = e.clientX;
        startY = e.clientY;
        startWidth = parseInt(window.getComputedStyle(windowElement).width);
        startHeight = parseInt(window.getComputedStyle(windowElement).height);
        startTop = windowElement.offsetTop;
        startLeft = windowElement.offsetLeft;

        document.addEventListener('mousemove', resize);
        document.addEventListener('mouseup', stopResize);
    });

    function resize(e) {
        if (!isResizing) return;
        const computedStyles = window.getComputedStyle(windowElement);

        const maxWidth = parseInt(computedStyles.maxWidth, 10);
        const maxHeight = parseInt(computedStyles.maxHeight, 10);
        const minWidth = parseInt(computedStyles.minWidth, 10);
        const minHeight = parseInt(computedStyles.minHeight, 10);

        // console.log(maxWidth, maxHeight, minWidth, minHeight);

        if (position.includes("right")) {
            const newWidth = startWidth + (e.clientX - startX);
            if (newWidth <= maxWidth && newWidth >= minWidth) {
                windowElement.style.width = `${newWidth}px`;
            }
        }

        if (position.includes("left")) {
            const newWidth = startWidth - (e.clientX - startX);
            if (newWidth <= maxWidth && newWidth >= minWidth) {
                windowElement.style.width = `${newWidth}px`;
                windowElement.style.left = `${startLeft + (e.clientX - startX)}px`;
            }
        }

        if (position.includes("bottom")) {
            const newHeight = startHeight + (e.clientY - startY);
            if (newHeight <= maxHeight && newHeight > minHeight) {
                windowElement.style.height = `${newHeight}px`;
            }
        }

        if (position.includes("top")) {
            const newHeight = startHeight - (e.clientY - startY);
            if (newHeight <= maxHeight && newHeight > minHeight) {
                windowElement.style.height = `${newHeight}px`;
                windowElement.style.top = `${startTop + (e.clientY - startY)}px`;
            }
        }
    }

    function stopResize() {
        isResizing = false;
        document.removeEventListener('mousemove', resize);
        document.removeEventListener('mouseup', stopResize);
    }
}


document.getElementById('addWindowBtn').addEventListener('click', createWindow);
document.getElementById('adminButton').addEventListener('click', createAdminWindow);