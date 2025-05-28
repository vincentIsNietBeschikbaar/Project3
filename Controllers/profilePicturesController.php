<?php

require_once "../Model/callAccounts.php";
require_once "../View/profilePictures.php";

class selectProfilePictures{

    public static function execute(){
            
        $View = new profilePicturesView();
        $View->display();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "test";
            $imageLink =  $_POST["imageLink"];
            $username = $_SESSION["username"];
            $newIMGLink = accounts::saveProfilePicture($username,$imageLink);
        }
    }
}

selectProfilePictures::execute();
?>