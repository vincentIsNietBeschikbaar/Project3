<?php
    include_once __DIR__ . "/../Model/callAccounts.php";
    include_once __DIR__ . "/../View/hoofdpagina.php";

    class homePageView{

    public static function execute(){
        $homeView = new homeView();
        $homeView->display();
        $tweets = Chirps::GetChirps();

        $homeView->displayGreeting($_SESSION["username"]);


        foreach ($tweets as $tweet) {
            // calling a function in the view that echos the tweets
            $homeView->makeTweet($tweet['Poster'], $tweet['ChirpBericht'], $tweet['Likes']);
        }

        $profilePicture = accounts::loadProfilePicture($_SESSION["username"]);
        if ($profilePicture == NULL){ // if the user has no profile picture selected
            $profilePicture = "../IMG/ProfielFotos/Default_pfp.jpg";
        }
        $homeView->loadProfilePicture($profilePicture); // calling function to echo profile picture

        if ($_SERVER["REQUEST_METHOD"] == "POST") { // if the user likes a tweet
            // get values from the form
            
        }

    }
}
homepageView::execute();



