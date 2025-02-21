<?php
    session_start();
    if(!isset($_SESSION['name'])){
        header('location: index.php');
    }
    if(isset($_POST['wyloguj'])){
        session_destroy();
        header('location: index.php');
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

            <form method="post">
                <button name="wyloguj">Wyloguj</button>
            </form>
            <form action="opcje.php" method="post">
                <button name="opcje">Opcje</button>
            </form>
            <?php
                if($_SESSION['admin']){
                    echo "<form action=\"admin.php\" method=\"post\">";
                    echo "<button name=\"admin\">Admin</button>";
                    echo "</form>";
                }
            ?>
        </div>
    </div>
    <div id="content">
        ZALOGOWANO
    </div>
    <div id="footer">
        <p>by AN</p>
    </div>
</body>
</html>