<?php
    include_once __DIR__ . "/../Model/callAccounts.php";
    include_once __DIR__ . "/../View/hoofdpagina.php";

    session_start();
echo "          Welkom  " . $_SESSION["username"] . ".<br>";

class homePageView{
    public static function execute(){
        $tweets = Chirps::GetChirps();
          foreach($tweets as $tweet){
        foreach($tweet as $tweetContent){
            echo"$tweetContent" . "<br>";
    }};


            $homeView = new homeView();
            $homeView->display();
    }
    public static function cloneTweet($Poster, $tweetContent) {
    echo '<div class="tweetBox">
            <div>' . htmlspecialchars($Poster) . '</div>
            <p>' . htmlspecialchars($tweetContent) . '</p>

            <img src="../IMG/unfilled_Heart.png" alt="Een niet gevuld hartje" class="tweetBox">
            <img src="../IMG/filledHeart.png" alt="Een gevuld hartje" class="tweetBox">

            <div class="tweetBox"></div> <!-- likeCounter -->
        </div>';
}

}


    homepageView::execute();
