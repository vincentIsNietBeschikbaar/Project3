<?php 
session_start();
include_once __DIR__ . "/../Model/callAccounts.php";
include_once __DIR__ . "/../View/makeChirp.php";

class makeChirp{
  public static function execute(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Haal de waarden op uit het formulier
            $Poster = $_SESSION["username"];
            $ChirpBericht = $_POST["ChirpBericht"];

            tweeters::initializeDatabase();
            $status = tweeters::makeChirp($Poster, $ChirpBericht);

            if ($status){
                echo "Tweet succesvol naar de database gestuurd!";
        }
    }
        }
}
makeChirp::execute();