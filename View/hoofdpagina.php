<?php
class homeView {

    public static function display() {
        echo '
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Churpify</title>
        <link rel="stylesheet" href="../CSS/style.css">
        <link rel="icon" href="../IMG/flavicon.ico" type="image/x-icon">
        </head>
        <body>
        <div class="profileContainer">
        </div>
        </div>
        <img  class="ChurpifyLogo" src="../IMG/chirpifyLogo.png" alt="Churpify Logo">
        <a class="makeChirpButton" href="../Controllers/tweetController.php">Maak nieuwe Chirp</a>
        <a class="changeProfilePictureButton" href="../Controllers/profilePicturesController.php">Kies een Profielfoto</a>
        <div class="welcomeText">
        </body>
        </html>
     ';
    }

    public static function makeTweet($chirpPoster, $chirpContent, $likes){
        echo '
            <div class="tweetBox">
            <div class="poster"><strong>' . htmlspecialchars($chirpPoster) . '</strong></div>
            <div class="chirpText">' . (htmlspecialchars($chirpContent)) . '</div>
            <div class="likeSection"
            <form method="post" action="../Controllers/HomePageController.php">
                <input class="unfilledHeart" type="image" src="../IMG/unfilled_Heart.png" name="likePost" alt="likePost" />
            </form
            <span class="likeCounter">' . (htmlspecialchars($likes)) . ' likes' . '</span>
            </div>
            </div>
        ';    
    }

    public static function loadProfilePicture($imgLink){
        echo '
        <div class="profileContainer">
            <img class="profilePicture" src="' . htmlspecialchars($imgLink) .'" alt="">
            <div class="welcomeText">
        </div>
        </div>';
    }

    public static function displayGreeting($username){
        echo "Welkom,  " . $username . "<br>";
    }

}
?>
