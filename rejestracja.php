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
        <h2>Rejestracja</h2><br/>
        <form method="post">
        <input required type="text" name="login" placeholder="login"><br/>
        <input required type="text" name="haslo" placeholder="hasło"><br/>
        <input required type="text" name="haslo2" placeholder="powtórz haslo"><br/>
        <button name="dodaj_konto">Zarejestruj się</button>
        </form>
        <?php
            if(isset($_POST['dodaj_konto'])){
                $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
                $sql = "SELECT `id`, `name`, `admin` FROM `users` WHERE `name` = '".$_POST['login']."'";// AND `password` = '".sha1($_POST['haslo'])."'";
                $result = mysqli_fetch_array(mysqli_query($conn, $sql));
                
                if($result){
                    echo "login zajęty";
                } else {
                    if($_POST['haslo'] != $_POST['haslo2']){
                        echo "hasła się nie pokrywają";
                    } else{
                        $sql = "INSERT INTO `users` (`id`, `name`, `password`, `admin`) VALUES (NULL, '".$_POST['login']."', '".sha1($_POST['haslo'])."', '0')";
                        mysqli_query($conn, $sql);
                        mysqli_close($conn);
                        //echo "utworzono";
                        header('location: index.php');
                    }
                }
                mysqli_close($conn);
            }
        ?>
    </div>
    <div id="footer">
        <p>by AN</p>
    </div>
</body>
</html>