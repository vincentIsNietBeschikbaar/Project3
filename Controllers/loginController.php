<?php
require_once "../Model/callAccounts.php";
require_once "../View/login.php";

class signUp{

    public static function execute(){
            $page = new page();
            $page->display();

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