<?php
    include_once __DIR__ . "/../Model/callAccounts.php";
    include_once __DIR__ . "/../View/hoofdpagina.php";

class homePageView{
    public static function execute(){
        $tweets = Chirps::GetChirps();

        $profilePicture = accounts::loadProfilePicture($_SESSION["username"]);
        if ($profilePicture == NULL){ // if the user has no profile picture selected or it fails to load
            $profilePicture = "../IMG/ProfielFotos/Default_pfp.jpg"; // turn profilepicture into the default one
        }

        $homeView = new homeView();
        $homeView->display($tweets, $profilePicture);

        if (isset($_POST['tweetID'])) { // if the user likes a tweet
            $tweetID = $_POST["tweetID"];
            echo "test";

            $result = Chirps::likeChirp($_SESSION["username"],$tweetID); // updating the chirp's like record
            var_dump($result);
            header('Location: ../Controllers/HomepageController.php');

        }
    }
}
homepageView::execute();