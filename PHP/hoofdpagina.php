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
        // Loop through the results and echo everything we need for the chirpify
        foreach ($results as $row) {

            // each tweetContent and Poster we loop though gets it's own ID that's generated with the tweetcounter.
            // ID="tweets1", ID="tweets2", ID="tweets3", ID="tweets4" etc
            echo "<div id=\"tweets$tweetCount\">" . $row['chirpText'] . " </div>";
            echo "<div id=\"Poster$tweetCount\">" . $row['Poster'] . " </div>";

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


        <nav class="profileBar" name="profileBar"></nav>

        <nav class="tweetBox" name="tweetBox">

            <img src="../IMG/unfilled_Heart.png" alt="Een niet gevuld hartje" id="unfilledHeart" class="unfilled_Heart"
                name="unfilled_Heart"></img>
            <img src="../IMG/filledHeart.png" alt="Een gevuld hartje" id="filledHeart" class="filled_Heart"
                name="filled_Heart"></img>


            <p class="textInTweet" name="Chirpify"></p>

            <p class="likeCounter" name="likeCounter">0</p>
            <button class="deleteButton" id="deleteButton">Verwijder</button>
        </nav>

    </nav>

    </nav>
    <a class="makeTweetButton" href="plaatstweet.php">Maak een tweet hier</a>

    <script src="../JS/MakeTweet.js"></script>

</body>

</html>