<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <nav class="signUpBox">

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Gebruikersnaam: <input class="Username" type="text" name="Naam" required><br>
            Wachtwoord: <input type="password" class="Password" name="Wachtwoord" required><br>
            <input onclick="send(this.form)" class="submitButton" type="submit" value="Inloggen" name="Inloggen">
            <a class="WebsiteButton" href="../View/hoofdpagina.php">Ga naar de Website</a>
        </form>
    </nav>
</body>
</html>