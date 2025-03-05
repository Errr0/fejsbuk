<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Fejsbuk</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="header">
        <div style="float: left;">
            <h1>FaceBuk</h1>
        </div>
        <div style="float: right;">
            <form action="login.php">
                <button class="form_button">Logowanie</button>
            </form>
            <form action="register.php">
                <button class="form_button">Rejestracja</button>
            </form>
            <!-- <button class="fa-solid fa-circle-user icon_button"></button> -->
            <!-- <button class="fa-solid fa-gear icon_button"></button> -->
        </div>
    </div>
    <div id="container">
        <div id="login">
            <form method="post" style="margin-top: 20px;">
                <h2>Rejestracja</h2>
                <input required type="text" name="login" placeholder="login" maxlength="16"><br/>
                <input required type="password" name="haslo" placeholder="haslo" maxlength="32"><br/>
                <input required type="password2" name="haslo" placeholder="powtórz haslo" maxlength="32"><br/>
                <button name="loguj" class="form_button">Zarejestruj się</button>
            </form>
            
        </div>
    </div>
</body>
</html>