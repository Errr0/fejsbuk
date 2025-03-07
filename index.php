<?php
    session_start();
    if(isset($_SESSION["id"]) && $_SESSION["id"]){
        header('location: zalogowany.php');
    } else {
        session_destroy();
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
        <h2>Logowanie</h2><br/>
        <form method="post">
        <input required type="text" name="login" placeholder="login"><br/>
        <input required type="password" name="haslo" placeholder="haslo"><br/>
        <button name="loguj">Zaloguj się</button>
        </form>
        <?php
        // admin password d033e22ae348aeb5660fc2140aec35850c4da997
            if(isset($_POST['loguj'])){
                $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
                $sql = "SELECT `id`, `name`, `admin` FROM `users` WHERE `name` = '".$_POST['login']."' AND `password` = '".sha1($_POST['haslo'])."'";//openssl_encrypt($_POST['haslo'], "AES-128-ECB", $_POST['login']."maslohaslo")
                $result = mysqli_fetch_array(mysqli_query($conn, $sql));
                mysqli_close($conn);
                if($result){
                    session_start();
                    $_SESSION["id"] = $result[0];
                    $_SESSION["name"] = $result[1];
                    $_SESSION["admin"] = $result[2];
                    header("location: zalogowany.php");
                } else {
                    echo "Błędny login lub hasło";
                }
            }
        ?>
    </div>
    <div id="footer">
        <p>by AN</p>
    </div>
</body>
</html>