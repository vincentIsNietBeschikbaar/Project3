<?php
class page {
    public static function display() {
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="icon" href="../IMG/flavicon.ico" type="image/x-icon">
            <link rel="stylesheet" href="../CSS/style.css">
        </head>
        <body>
            <nav class="signUpBox">
                <form method="post" action="../Controllers/loginController.php">
                    Gebruikersnaam: <input class="Username" type="text" name="Naam" required><br>
                    Wachtwoord: <input type="password" class="Password" name="Wachtwoord" required><br>
                    <input class="submitButton" type="submit" value="Inloggen" name="Inloggen">
                    <a class="WebsiteButton" href="../View/hoofdpagina.php">Ga naar de Website</a>
                </form>
            </nav>
        </body>
        </html>
        ';
    }
}
?>
