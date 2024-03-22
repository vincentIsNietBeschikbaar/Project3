<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "databaseBerichten";


    $amountOfLikes = 5000;
    $originalPoster = $_SESSION["user"];
    $chirpifyText = $_POST['makeChirpifyBox'];

    try {
        // Maak een PDO-verbinding
        $conn = new PDO("mysql:host=;dbname=$dbname", $username, $password);

        // Stel de PDO-foutmodus in op exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL-query om een nieuw record in te voegen
        $sql = "INSERT INTO berichten (Poster, chirpText, aantalLikes)
            VALUES ('$originalPoster', '$chirpifyText', '$amountOfLikes')";

        // Gebruik exec() omdat er geen resultaten worden geretourneerd
        $conn->exec($sql);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../CSS/style.css?v=<?php echo time(); ?>">
</head>

<body>

    <?php
    echo "Welkom,  " . $_SESSION["user"] . ".<br>";
    ?>

    <nav>
        <p class="homeBar">Home</p>
    </nav>


    <nav id="cloneTweet" class="tweet" data-post-id="1">
        <i id="heart" class="fa fa-heart-o"></i>
        <p class="like-button">
            <span class="likeCounter">0</span>
        </p>
        <nav class="profileBar">
            <p class="naamInTweet">
                <?php echo ($_SESSION["user"]) ?>
            </p>
        </nav>
        <nav class="tweetBox">
            <p class="textInTweet" name="Chirpify">Ik ben <?php  echo ($_SESSION["user"]) ?>, een gebruiker op Churpify, de 100% werkende versie van Twitter (of X)</p>
        </nav>
    </nav>

    <nav>
         <button  id="ChirpButton">Plaats</button>

    </nav>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

        <textarea id="makeChirpField" maxlength="281" class="makeChirpifyBox" name="makeChirpifyBox" cols="30"
            rows="10"></textarea><br>
        <input class="makeChirpifyButton"  type="submit" value="Zet in database">

    </form>

    <script src="../JS/MakeTweet.js?v=<?php echo time(); ?>"></script>
    <script src="../JS/LikeTweet.js"></script>
</body>

</html>