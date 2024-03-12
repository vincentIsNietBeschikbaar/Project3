<body>
    <nav class="signUpBox">

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Gebruikersnaam: <input class="Username" type="text" name="Naam" required><br>
            Wachtwoord: <input type="password" class="Password" name="Wachtwoord" required><br>
            <input class="submitButton" type="submit" value="Inloggen">
        </form>

    </nav>

    <?php

    try {
        $db = new PDO("mysql:host=localhost;dbname=databasetweeters", "root", "");

        if (isset($_POST['Inloggen'])) {
            $username = filter_input(INPUT_POST, "Naam", FILTER_SANITIZE_STRING);
            $Wachtwoord = $_POST['Wachtwoord'];

            $query = $db->prepare("SELECT * FROM gebruikers WHERE username = :user");

            $query->bindParam("user", $Naam);
            $query->execute();

            if ($query->rowCount() == 1) {
                $result = $query->fetch(PDO::FETCH_ASSOC);
                if (password_verify($Wachtwoord, $result["Wachtwoord"])) {
                    echo "Juiste gegevens";
                } else {
                    echo "Onjuiste gegevens";
                }
            } else {
                echo "Onjuiste gegevens";
            }
            echo "<br>";
        } else{
            echo "kan inlogknop niet vinden";
        }
    } catch (PDOException $e) {
        die("Error!:" . $e->getMessage());
    }


    ?>

</body>