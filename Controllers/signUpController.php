<?php
require_once "../Model/callTweets.php";
require_once "../Model/callAccounts.php";
require_once "../View/signUp.php";

class signUp{
    public static function execute(){
        $page = new signUpView();
        $page->display();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Haal de waarden op uit het formulier
            $Name = $_POST["Naam"];
            $Email = $_POST["Email"];
            $Password = $_POST["Wachtwoord"];
            // Wachtwoord hashen

            accounts::initializeDatabase();
            $status = accounts::makeAccount($Name,$Email,$Password);

            if ($status){
                echo "account is aangemaakt. U kunt nu naar de inlogpagina";
            }
        }
    }
}

signUp::execute();