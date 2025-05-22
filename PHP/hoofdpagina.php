<?php
session_start();

echo "          Welkom,  " . $_SESSION["user"] . ".<br>";

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databaseBerichten";
$userdbName = "databasetweeters";

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // The second Conn is to get the profile picture the user selected
    $conn2 = new PDO("mysql:host=$servername;dbname=$userdbName", $username, $password);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL query to retrieve records
    // the last number is the amount of tweets that SQL generates
    $sql = "SELECT chirpText, Poster, aantalLikes FROM berichten ORDER BY ID DESC LIMIT 15";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    // Execute the SQL statement
    $stmt->execute();

    // Fetch all rows as associative arrays
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch the profielFotoLink separately
    $profielFotoLinkSql = "SELECT ID, profielFotoLink FROM datavantwitter WHERE Naam = '" . $_SESSION['user'] . "'";
    $profielFotoLinkStmt = $conn2->prepare($profielFotoLinkSql);
    $profielFotoLinkStmt->execute();
    $profielFotoLinkRow = $profielFotoLinkStmt->fetch(PDO::FETCH_ASSOC);
    $profielFotoLink = $profielFotoLinkRow['profielFotoLink'];


    $userIsAdmin = false;
    $ID = $profielFotoLinkRow['ID'];
    $adminUserIDs = array(19,90219085,90219083,90219101);// these users are admins

    foreach ($adminUserIDs as $adminID) { // if the user is an admin, the deleteButton is send to javascript
        if ($ID == $adminID) {
            $userIsAdmin = true;
        }
    }


    $tweetCount = 0;
    // Check if there are any results
    if ($results) {
        // Loop through the results and echo everything we need for the chirpify

        foreach ($results as $row) {

            // each tweetContent and Poster we loop through gets its own ID that's generated with the tweetcounter.
            // ID="tweets1", ID="tweets2", ID="tweets3", ID="tweets4" etc
            echo "<div  class=\"tweetText\" id=\"tweets$tweetCount\">" . $row['chirpText'] . " </div>";
            echo "<div id=\"Poster$tweetCount\">" . $row['Poster'] . " </div>";
            echo "<div id=\"aantalLikes$tweetCount\">" . $row['aantalLikes'] . " </div>";

            if ($userIsAdmin == true){
                echo "<button id=\"deleteButton$tweetCount\" class=\"deleteButton\" type='button'>Verwijder</button>";
            }

            $tweetCount += 1;
        }
        // Output the profielFotoLink outside the loop
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

    <img class="profilePicture" src="<?php
    if ($profielFotoLink) {
        echo $profielFotoLink;
    } ?>" alt="De profielfoto">

    <nav id="ProfilePictureParent"></nav>

    <nav id="cloneTweet" class="tweet" data-post-id="1">
        <nav class="profileBar" name="profileBar"></nav>

        <nav class="tweetBox" name="tweetBox">

            <img src="../IMG/unfilled_Heart.png" alt="Een niet gevuld hartje" id="unfilledHeart" class="unfilled_Heart"
                name="unfilled_Heart"></img>
            <img src="../IMG/filledHeart.png" alt="Een gevuld hartje" id="filledHeart" class="filled_Heart"
                name="filled_Heart"></img>

            <p class="textInTweet" name="Chirpify"></p>

            <nav class="likeCounter" name="likeCounter"></nav>
        </nav>
    </nav>

    </nav>
    <br>
    <br>
    <a class="makeTweetLink" href="plaatstweet.php">Maak een tweet hier</a>
    <br>
    <br>
    <a class="makeProfilePicLink" href="profilePicture.php">Verander uw profielFoto hier</a>

    <script src="../JS/MakeTweet.js? <?php echo filemtime('../JS/MakeTweet.js'); ?>"></script>
    <script src="../JS/selectProfilePic.js? <?php echo filemtime('../JS/selectProfilePic.js'); ?>"></script>
</body>
</html>