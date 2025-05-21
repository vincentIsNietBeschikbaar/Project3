<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <div class="profileContainer">
        <img class="profilePicture" src="../IMG/Profielfotos/Default_pfp.jpg" alt="">
        <div class="welcomeText">
            <?php
            echo "Welkom, " . $_SESSION["user"] . "<br>";
            ?>
        </div>
    </div>

    <a class="makeChirpButton" href="../View/plaatstweet.php">Maak nieuwe Chirp</a>
    <a class="changeProfilePictureButton" href="../View/profilePicture.php">Kies een nieuwe Profielfoto</a>
</body>
</html>