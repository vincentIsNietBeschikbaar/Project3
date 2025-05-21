<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>

    <nav class="signUpBox">
        <form method="post" action="../Controllers/signUpController.php">
            Gebruikersnaam: <input class="Username" type="text" name="Naam" required maxlength="17"><br>
            Email: <input type="email" class="email" name="Email" required><br>
            Wachtwoord: <input type="password" class="Password" name="Wachtwoord" required minlength="8"><br>
            <input class="submitButton" type="submit" value="Registreren">
        </form>
    </nav>

    <a class="LoggingInButton" href="inloggen.php">Inloggen?</a>
</body>
</html>
