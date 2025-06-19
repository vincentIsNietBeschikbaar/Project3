<?php 
echo $_SESSION["ProfilePicture"];
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once __DIR__ . "/../Model/callAccounts.php";
include_once __DIR__ . "/../Model/ChirpModel.php";
include_once __DIR__ . "/../View/makeChirp.php";


class NewChirp{

  public static function execute(){
        $makeChirpView = new makeChirpView();
        $makeChirpView->display();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Haal de waarden op uit het formulier
            $Poster = $_SESSION["username"];
            $ChirpBericht = $_POST["ChirpBericht"];
$ProfilePicture = isset($_SESSION["profilePicture"]);

            $status = Chirps::makeChirp($Poster, $ChirpBericht, $ProfilePicture);
            accounts::initializeDatabase();

            if ($status){
                echo "Tweet succesvol naar de database gestuurd!";
            }
        }
    }
}
NewChirp::execute();