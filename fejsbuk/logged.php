<?php
session_start();
if(isset($_SESSION["password"]) && isset($_SESSION["name"]) && isset($_SESSION["id"]) && isset($_SESSION["admin"])){
    $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
    $sql = "SELECT `id`, `name`, `admin` FROM `users` WHERE `name` = '".$_SESSION["name"]."' AND `password` = '".sha1($_SESSION["password"])."'";
    $result = mysqli_fetch_array(mysqli_query($conn, $sql));
    mysqli_close($conn);
    if(!$result){
        header("location: index.php");
    }
}else{
    header("location: index.php");
}      

if(isset($_POST['logout'])){
    session_destroy();
    header('location: index.php');
} 
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Fejsbuk</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div id="head">
    <div style="float: left;">
        <h1>FaceBuk</h1>
    </div>
    <div style="float: right; margin-top: 10px;">
        <form method="post">
            <button name="logout" class="form_button">Wyloguj</button>
        </form>
        <?php
        if($_SESSION["admin"]){
            echo "<form action=\"admin.php\" method=\"post\">";
            echo "<button class=\"form_button\">Admin</button>";
            echo "</form>";
        }
        ?>
    </div>
</div>

<div id="body">
    <div id="content">
        <h2>Wiadomości</h2>
    </div>
    <div id ="profile">
        <h2>Profil</h2>
        <button class="fa-solid fa-gear top_right_button" style="float: right;"></button>
    </div>
    <div id ="friends">
        <h2>Znajomi</h2>
    </div>
</div>
<!-- Button to create new windows -->
<button class="add-window-btn" id="addWindowBtn">Dodaj Okno</button>

<script>
let windowCount = 0;

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
    contentDiv.textContent = 'Przesuń i dostosuj mnie!';

    windowDiv.appendChild(titleBar);
    windowDiv.appendChild(contentDiv);

    // Add resizing handles for all edges & corners
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

        // Max-width and max-height limit for resizing
        const maxWidth = window.innerWidth;  // Browser width
        const maxHeight = window.innerHeight; // Browser height

        // Resizing from the right
        if (position.includes("right")) {
            const newWidth = startWidth + (e.clientX - startX);
            if (newWidth <= maxWidth) {
                windowElement.style.width = `${newWidth}px`;
            }
        }

        // Resizing from the left
        if (position.includes("left")) {
            const newWidth = startWidth - (e.clientX - startX);
            if (newWidth > 100) {  // Prevent shrinking too much
                windowElement.style.width = `${newWidth}px`;
                windowElement.style.left = `${startLeft + (e.clientX - startX)}px`;
            }
        }

        // Resizing from the bottom
        if (position.includes("bottom")) {
            const newHeight = startHeight + (e.clientY - startY);
            if (newHeight <= maxHeight) {
                windowElement.style.height = `${newHeight}px`;
            }
        }

        // Resizing from the top
        if (position.includes("top")) {
            const newHeight = startHeight - (e.clientY - startY);
            if (newHeight > 100) {  // Prevent shrinking too much
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
</script>




</body>
</html>
