<?php
include_once __DIR__ . "/../Model/callAccounts.php";
include_once __DIR__ . "/../View/login.php";

class signUp{
    public static function execute(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // get values from the form
            $Name = $_POST["Naam"];
            $Password = $_POST["Wachtwoord"];
            tweeters::initializeDatabase();
            tweeters::login($Name,$Password);
        }
    }
}

signUp::execute();