<?php
include_once __DIR__ . "/../Model/callAccounts.php";
include_once __DIR__ . "/../View/signUp.php";

class signUp{
    public static function execute(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Haal de waarden op uit het formulier
            $Naam = $_POST["Naam"];
            $Email = $_POST["Email"];
            $Wachtwoord = $_POST["Wachtwoord"];
            // Wachtwoord hashen

            tweeters::initializeDatabase();
            $status = tweeters::makeAccount($Naam,$Email,$Wachtwoord);

            if ($status){
                
            }

        }
    }
}

signUp::execute();