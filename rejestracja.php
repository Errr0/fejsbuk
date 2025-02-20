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
    </div>
    <div id="footer">
        <p>by AN</p>
    </div>
</body>
</html>