<?php

require_once "../Model/callAccounts.php";
require_once "../View/profilePictures.php";

class login{

    public static function execute(){
            $View = new profilePicturesView();
            $View->display();

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                /*
                $Name = $_POST["Naam"];
                $Password = $_POST["Wachtwoord"];
                accounts::initializeDatabase();
                accounts::login($Name,$Password);
                */

            }
    }
}

login::execute();
?>