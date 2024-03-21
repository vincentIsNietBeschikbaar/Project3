<?php
    session_start();
?>

<body>

    <?php

    try {
        $db = new PDO("mysql:host=localhost;dbname=databasetweeters", "root", "");

        if (isset($_POST['Inloggen'])) {

            $username = filter_input(INPUT_POST, "Naam", FILTER_SANITIZE_STRING);
            $Wachtwoord = $_POST['Wachtwoord'];

            $query = $db->prepare("SELECT Wachtwoord FROM datavantwitter WHERE Naam = :user");

            $query->bindParam("user", $username);

            $query->execute();

            if ($query->rowCount() == 1) {
                $result = $query->fetch(PDO::FETCH_ASSOC);


                if (password_verify($Wachtwoord, $result["Wachtwoord"])) {
                    echo "Hallo, " . $username;
                    startSession($username);
                    
                } else {
                    echo "Wachtwoord of gebruikersnaam is onjuist";
                }
            } else {
                echo $query->rowCount();
            }
            echo "<br>";
        } else {
            echo "kan inlogknop niet vinden";
        }


    } catch (PDOException $e) {
        die("Error!:" . $e->getMessage());
    }


    function startSession($user){
        $_SESSION["user"] = $user;
    }
    ?>

    <nav class="signUpBox">

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            Gebruikersnaam: <input class="Username" type="text" name="Naam" required><br>
            Wachtwoord: <input type="password" class="Password" name="Wachtwoord" required><br>
            <input onclick="send(this.form)" class="submitButton" type="submit" value="Inloggen" name="Inloggen">

        </form>
    </nav>
</body>