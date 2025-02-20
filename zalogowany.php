<?php
    session_start();
    if(!isset($_SESSION['id'])){
        header(header: 'location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>FejsBuk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="banner">
        <div style="float: left;">
            <h1>FejsBuk</h1>
        </div>
        <div style="float: right;">
            <form action="index.php" method="post">
                <button name="logowanie">Logowanie</button>
            </form>
            <form action="rejestracja.php" method="post">
                <button name="rejestracja">Rejestarcja</button>
            </form>
        </div>
    </div>
    <div id="content">

    </div>
    <div id="footer">
        <p>by AN</p>
    </div>
</body>
</html>