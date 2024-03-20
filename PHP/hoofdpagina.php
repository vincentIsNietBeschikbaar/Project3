<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../CSS/style.css">
</head>
 
<body>
    <nav>
        <p class="homeBar">Home</p>
    </nav>
 
    <nav class="actions">
        <button class="makeChirpButton" id="makeChirpButton">Maak een Chirp</button>
    </nav>


    <nav id="cloneTweet" class="tweet" data-post-id="1">
        <i onclick="likeTweet(this)" class="fa fa-heart"></i>
        <p class="like-button">
            <span class="likeCounter">0</span>
        </p>
        <nav class="profileBar">
            <p class="naamInTweet"><?php echo $_SESSION["user"] ?> </p>
        </nav>
        <nav class="tweetBox">
            <p class="textInTweet">Ik ben <?php echo $_SESSION["user"] ?>, een gebruiker op Churpify, de 100% werkende versie van Twitter (of X)</p>
        </nav>
    </nav>

    <script src="../JS/MakeTweet.js"></script>
    <script src="../JS/likeTweet.js"></script>

    <?php
    // Echo session variables that were set on previous page
    echo "Welkom,  " . $_SESSION["user"] . ".<br>";
    ?>

</body>

</html>