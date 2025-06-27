<?php
include_once __DIR__ . "/../Model/callAccounts.php";
include_once __DIR__ . "/../Model/ChirpModel.php";
include_once __DIR__ . "/../View/hoofdpagina.php";

class homePageView{
    public static function execute(){

        if (!$_SESSION['login']){ // redirecting users that aren't logged in
            header("location:../Controllers/loginController.php");
            die;
        }

        $tweets = Chirps::GetChirps();

        $profilePicture = accounts::loadProfilePicture($_SESSION["username"]);
        if ($profilePicture == NULL){ // if the user has no profile picture selected or it fails to load
            $profilePicture = "../IMG/ProfielFotos/Default_pfp.jpg"; // turn profilepicture into the default one
        }
        $_SESSION["profilePicture"] = $profilePicture;

        $existingLikeIDs = Chirps::getExistingLikes($_SESSION["username"]);

        $homeView = new homeView();
        $homeView->display($tweets, $profilePicture, $existingLikeIDs);

        if (isset($_POST['tweetID'])) {
            $tweetID = $_POST["tweetID"];
            
            $result = Chirps::likeChirp($_SESSION["username"], $tweetID, $existingLikeIDs);
        
            $_SESSION['like_status'] = $result ? 'liked' : 'already_liked';
        
            header('Location: ../View/hoofdpagina.php');
            exit;
        }

        if (isset($_POST['chirpToDelete'])){
            $tweetToDelete= $_POST["chirpToDelete"];
            Chirps::deleteChirp($tweetToDelete);
        }
    }
}
homepageView::execute();