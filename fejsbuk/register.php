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
            <h2>Rejestracja</h2>
            <input required type="text" name="name" placeholder="login" maxlength="16"><br/>
            <input required type="password" name="password" placeholder="haslo" maxlength="32"><br/>
            <input required type="password" name="password2" placeholder="powtórz haslo" maxlength="32"><br/>
            <button name="register" class="form_button">Zarejestruj się</button>
        </form>
        <p id="output">
        <?php
            if(isset($_POST['register'])){
                $conn = mysqli_connect("localhost", "root", "", "fejsbuk");
                $sql = "SELECT `id`, `name`, `admin` FROM `users` WHERE `name` = '".$_POST['name']."'";
                $result = mysqli_fetch_array(mysqli_query($conn, $sql));
                if($result){
                    echo "login zajęty";
                } else {
                    if($_POST['password'] != $_POST['password2']){
                        echo "hasła muszą być takie same";
                    } else{
                        $sql = "INSERT INTO `users` (`id`, `name`, `password`, `admin`) VALUES (NULL, '".$_POST['name']."', '".sha1($_POST['password'])."', '0')";
                        mysqli_query($conn, $sql);
                        mysqli_close($conn);
                        header('location: index.php');
                    }
                }
                mysqli_close($conn);
            }
        ?>
        </p>
    </div>
</body>
</html>