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

        <div style="float: right; margin-top: 10px;">
            <form action="index.php" method="post">
                <button class="form_button">Cofnij</button>
            </form>
            <form method="post">
                <button name="wyloguj" class="form_button">Wyloguj</button>
            </form>
        </div>
        <!-- <div style="float: right;">
            <form method="post" style="float: right;">
                <button name="log-out" class="fa-solid fa-arrow-right-from-bracket icon_button" title="wyloguj się"></button>
            </form>

            <form action="index.php" method="post" style="float: right;">
                <button class="fa-solid fa-circle-arrow-left icon_button" title="cofnij"></button>
            </form>

            <form action="admin.php" method="post" style="float: right;">
                <button class="fa-solid fa-screwdriver icon_button" title="admin"></button>
            </form>
            
            <button class="fa-solid fa-gear icon_button"></button> -->
        </div> 
    </div>

    <div id="content">
        Profil
    </div>
</body>
</html>