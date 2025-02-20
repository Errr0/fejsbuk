<?php
    session_start();
    if(!isset($_SESSION['admin'])){
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
            <form action="zalogowany.php" method="post">
                <button name="cofnij">Cofnij</button>
            </form>
        </div>
    </div>
    <div id="content">
        <div style="float: left;">
        <form method="post">
            <input type="text", name="login">
            <button name="szukaj">Szukaj</button>
        </form>
        <?php
            $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
            $sql = "SELECT `id`, `name`, `password`, `admin` FROM `users`".(isset($_POST['szukaj']) && $_POST['login']!="" ? "WHERE `name` = '".$_POST['login']."'" : "");// WHERE `name` = '".$_POST['login']."'";// AND `password` = '".sha1($_POST['haslo'])."'";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_array($result)){
                echo $row[1]."<br/>";
            }
        ?>
        </div>
    </div>
    <div id="footer">
        <p>by AN</p>
    </div>
</body>
</html>