<?php
include_once __DIR__ . "../Model/callAccounts.php";
include_once __DIR__ . "../View/signUp.php";

class signUpController{
    public static function execute(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Haal de waarden op uit het formulier
            $Naam = $_POST["Naam"];
            $Email = $_POST["Email"];
            $Wachtwoord = $_POST["Wachtwoord"];
            // Wachtwoord hashen
            $hashedPassword = password_hash($Wachtwoord, PASSWORD_DEFAULT);

            tweeters::initializeDatabase();
            tweeters::makeAccount(Naam,Email,Wachtwoord);
        }
    }
}

NewsPageController::execute();