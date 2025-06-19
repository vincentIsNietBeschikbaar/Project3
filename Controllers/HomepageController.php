<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
include_once __DIR__ . "/../Model/callAccounts.php";
    include_once __DIR__ . "/../Model/ChirpModel.php";
    include_once __DIR__ . "/../View/hoofdpagina.php";

class homePageView{
    public static function execute(){
        $tweets = Chirps::GetChirps();

        $profilePicture = accounts::loadProfilePicture($_SESSION["username"]);
        if ($profilePicture == NULL){ // if the user has no profile picture selected or it fails to load
            $profilePicture = "../IMG/ProfielFotos/Default_pfp.jpg"; // turn profilepicture into the default one
        }
        $_SESSION["ProfielFoto"] = $profilePicture;


        $existingLikeIDs = Chirps::getExistingLikes($_SESSION["username"]);

        $homeView = new homeView();
        $homeView->display($tweets, $profilePicture, $existingLikeIDs);

        if (isset($_POST['tweetID'])) { // if the user likes a tweet
            $tweetID = $_POST["tweetID"];
    
            $result = Chirps::likeChirp($_SESSION["username"],$tweetID, $existingLikeIDs); // updating the chirp's like record
            //var_dump($result);
        }
    }
}
homepageView::execute();