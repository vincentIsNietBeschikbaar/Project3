<?php
include_once __DIR__ . "/../Model/callAccounts.php";
include_once __DIR__ . "/../View/signUp.php";

class login{
    public static function execute(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Haal de waarden op uit het formulier
            $Name = $_POST["Naam"];
            $Email = $_POST["Email"];
            $Password = $_POST["Wachtwoord"];
            // Wachtwoord hashen

            tweeters::initializeDatabase();
            $status = tweeters::makeAccount($Name,$Email,$Password);

            if ($status){
                echo "account is aangemaakt. U kunt nu naar de inlogpagina";
            }
        }
    }
}

login::execute();