<?php
    include_once __DIR__ . "/../Model/callAccounts.php";
    include_once __DIR__ . "/../View/hoofdpagina.php";

    //session_start();
    class homePageView{

    public static function execute(){

            $homeView = new homeView();
            $homeView->display();

        $tweets = Chirps::GetChirps();
        echo "          Welkom,  " . $_SESSION["username"] . "<br>";
          foreach ($tweets as $tweet) {
    echo '
    <div class="tweetBox">
        <div class="poster"><strong>' . htmlspecialchars($tweet['Poster']) . '</strong></div>
        <div class="chirpText">' . (htmlspecialchars($tweet['ChirpBericht'])) . '</div>
        <div class="likeSection">
            <img src="../IMG/unfilled_Heart.png" alt="Leeg hartje" class="unfilledHeart" />
            <img src="../IMG/filledHeart.png" alt="Gevuld hartje" class="filledHeart" />
            <span class="likeCounter">0 likes</span>
        </div>
    </div>';
}

            $profilePicture = accounts::loadProfilePicture($_SESSION["username"]);

            if ($profilePicture == NULL){
                $profilePicture = "../IMG/ProfielFotos/Default_pfp.jpg";
            }

                    echo '     
        <div class="profileContainer">
            <img class="profilePicture" src="' . htmlspecialchars($profilePicture) .'" alt="">
            <div class="welcomeText">
        </div>
        </div>';
    }
}
homepageView::execute();