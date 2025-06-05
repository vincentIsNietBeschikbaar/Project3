<?php 
include_once __DIR__ . "/../Model/callAccounts.php";
include_once __DIR__ . "/../View/makeChirp.php";

session_start();

class NewChirp{

  public static function execute(){
        $makeChirpView = new makeChirpView();
        $makeChirpView->display();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Haal de waarden op uit het formulier
            $Poster = $_SESSION["username"];
            $ChirpBericht = $_POST["ChirpBericht"];
$status = Chirps::makeChirp($Poster, $ChirpBericht);
            accounts::initializeDatabase();
            


            if ($status){
                echo "Tweet succesvol naar de database gestuurd!";
            }
        }
    }
}
NewChirp::execute();