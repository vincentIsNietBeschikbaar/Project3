<?php
require_once "../Model/callAccounts.php";
require_once "../View/login.php";

class login{

    public static function execute(){
            $loginView = new loginView();
            $loginView->display();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // get values from the form
            $Name = $_POST["Naam"];
            $Password = $_POST["Wachtwoord"];
            accounts::initializeDatabase();
            accounts::login($Name,$Password);
        }
    }
}

login::execute();