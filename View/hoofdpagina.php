<?php
class homeView {

    public function display($tweets, $imgLink) { // the arguments are an array of tweets and an path to the profilePicture
        ?>
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

        <?php 
        $this->displayGreeting();
        $this->loadProfilePicture($imgLink);
        
        foreach ($tweets as $tweet){
            $this->makeTweet($tweet['Poster'], $tweet['ChirpBericht'], $tweet['Likes'], $tweet['ID']);
        }
        ?>
        </body>
        </html>
     <?php
    }

    public function makeTweet($chirpPoster, $chirpContent, $likes, $tweetID){
        // function that generates a tweet and takes the poster, tweetcontent, likes and and ID as arguments
        echo '
            <div class="tweetBox">
            <div class="poster"><strong>' . htmlspecialchars($chirpPoster) . '</strong></div>
            <div class="chirpText">' . (htmlspecialchars($chirpContent)) . '</div>

                <form method="post" action="../Controllers/HomepageController.php">
                    <input type="hidden" name="tweetID" value="' . htmlspecialchars($tweetID) . '">
                    <input type="image" src="../IMG/unfilled_Heart.png" name="likePost" alt="Like">
                </form>
            </form>

            <span class="likeCounter">' . (htmlspecialchars($likes)) . ' likes' . '</span>
            </div>
        ';
    }

    public static function loadProfilePicture($imgLink){
        echo '
        <div class="profileContainer">
            <img class="profilePicture" src="' . htmlspecialchars($imgLink) .'" alt="">
            <div class="welcomeText"> </div>
        </div>';
    }

    public static function displayGreeting(){
        echo "Welkom,  " . $_SESSION["username"] . "<br>";
    }
}
?>