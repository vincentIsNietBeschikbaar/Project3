<?php
session_start();

echo "Welkom,  " . $_SESSION["user"] . ".<br>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databaseBerichten";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=localhost;dbname=$dbname", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to retrieve records
    $sql = "SELECT * FROM berichten ORDER BY ID DESC LIMIT 10";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Execute the SQL statement
    $stmt->execute();

    // Fetch all rows as associative arrays
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $tweetCount = 0;
    // Check if there are any results
    if ($results) {
        // Loop through the results and echo each chirpText
        foreach ($results as $row) {

            echo "<div id=\"tweets$tweetCount\">" . $row["Poster"] . ":     " . $row['chirpText'] . "<br> </div>";
            $tweetCount += 1;
        }
    } else {
        echo "No results found.";
    }
} catch (PDOException $e) {
    // Handle errors gracefully
    echo "Error: " . $e->getMessage();
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

    <nav id="cloneTweet" class="tweet" data-post-id="1">
        <i onclick="likeTweet(this)" class="fa fa-heart"></i>
        <p class="like-button">
            <span class="likeCounter">0</span>
        </p>
        <nav class="profileBar">
            <p class="naamInTweet">
                <?php echo ($_SESSION["user"]) ?>
            </p>
        </nav>
        <nav class="tweetBox">
            <p class="textInTweet" name="Chirpify">Plaats uw tekst hier</p>
        </nav>
    </nav>

    </nav>
    <a href="plaatstweet.php">Maak een tweet hier</a>

    <button onclick="moveTweets()">Move the tweets</button>

    <script src="../JS/LikeTweet.js"></script>
    <script src="../JS/MakeTweet.js"></script>



</body>

</html>