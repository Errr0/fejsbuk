<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Fejsbuk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="head">
        <div style="float: left;">
            <h1>FaceBuk</h1>
        </div>
        <div style="float: right; margin-top: 10px;">
            <form action="login.php" method="post">
                <button class="form_button">Logowanie</button>
            </form>
            <form action="register.php" method="post">
                <button class="form_button">Rejestracja</button>
            </form>

            <i class="fa-solid fa-arrow-right-to-bracket"></i>
        </div>
    </div>

    <div id="login">
        <br/>
        <form method="post" style="margin-top: 20px;">
            <h2>Logowanie</h2>
            <input required type="text" name="name" placeholder="login" maxlength="16"><br/>
            <input required type="password" name="password" placeholder="haslo" maxlength="32"><br/>
            <button name="login" class="form_button">Zaloguj się</button>
        </form>
        <p id="output">
        <?php
            if(isset($_POST['login'])){
                $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
                $sql = "SELECT `id`, `name`, `admin` FROM `users` WHERE `name` = '".$_POST['name']."' AND `password` = '".sha1($_POST['password'])."'";
                $result = mysqli_fetch_array(mysqli_query($conn, $sql));
                mysqli_close($conn);
                if($result){
                    session_start();
                    $_SESSION["id"] = $result['id'];
                    $_SESSION["name"] = $result['name'];
                    $_SESSION["password"] = $_POST['password'];
                    $_SESSION["admin"] = $result['admin'];
                    header("location: logged.php");
                } else {
                    echo "Błędny login lub hasło";
                }
            }
        ?>
        </p>
    </div>
</body>
</html>