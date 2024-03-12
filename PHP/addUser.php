<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratieformulier</title>

    <link rel="stylesheet" href="../CSS/style.css">
</head>

<body>

    <?php
    // Databaseconfiguratie
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "databasetweeters";

    // Controleer of het formulier is ingediend
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Haal de waarden op uit het formulier
        $Naam = $_POST["Naam"];
        $Email = $_POST["Email"];
        $Wachtwoord = $_POST["Wachtwoord"];

        try {
            // Maak een PDO-verbinding
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

            // Stel de PDO-foutmodus in op exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL-query om een nieuw record in te voegen
            $sql = "INSERT INTO datavantwitter (Naam, Email, Wachtwoord)
                VALUES ('$Naam', '$Email', '$Wachtwoord')";

            // Gebruik exec() omdat er geen resultaten worden geretourneerd
            $conn->exec($sql);

            echo "New record created successfully";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Sluit de databaseverbinding
        $conn = null;
    }
    ?>

    <!-- HTML-formulier -->
    <nav class="signUpBox" >

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Gebruikersnaam: <input class="Username" type="text" name="Naam" required><br>
            Email: <input type="email" class="email" name="Email" required><br>
            Wachtwoord: <input type="password" class="Password" name="Wachtwoord" required><br>
            <input class="submitButton" type="submit" value="Registreren">
        </form>

        </form>

    </nav>

    <a class="LoggingInButton" href="inloggen.php">Inloggen?</a>

</body>
<html>