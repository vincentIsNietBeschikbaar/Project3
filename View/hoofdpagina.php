<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Churpify</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="icon" href="../IMG/flavicon.ico" type="image/x-icon">

</head>
<body>
<img  class="ChurpifyLogo" src="../IMG/chirpifyLogo.png" alt="Churpify Logo">
    <div class="profileContainer">
        <img class="profilePicture" src="../IMG/Profielfotos/Default_pfp.jpg" alt="">
        <div class="welcomeText">
            <?php
            session_start();
echo "          Welkom,  " . $_SESSION["username"] . ".<br>";
            ?>
        </div>
    </div>

    <a class="makeChirpButton" href="../View/plaatstweet.php">Maak nieuwe Chirp</a>
    <a class="changeProfilePictureButton" href="../View/profilePicture.php">Kies een (nieuwe) Profielfoto</a>
    <nav id="cloneTweet" class="tweet" data-post-id="1">
        <nav class="profileBar" name="profileBar"></nav>

        <nav class="tweetBox" name="tweetBox">

            <img src="../IMG/unfilled_Heart.png" alt="Een niet gevuld hartje" id="unfilledHeart" class="unfilled_Heart"
                name="unfilled_Heart">
            <img src="../IMG/filledHeart.png" alt="Een gevuld hartje" id="filledHeart" class="filled_Heart"
                name="filled_Heart">

            <p class="textInTweet" name="Chirpify"></p>

            <nav class="likeCounter" name="likeCounter"></nav>
        </nav>
    </nav>
</body>
</html>