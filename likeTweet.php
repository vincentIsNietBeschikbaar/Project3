<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "databaseberichten";

try {
  // Connect to database
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Get user ID and tweet ID from request
  $userID = $_SESSION['user']; // Assuming user ID is in session
  $tweetID = (int)$_POST['tweetID']; // Get tweet ID from AJAX request

  // Check if user already liked this tweet
  $sql = "SELECT * FROM likes WHERE userID = :userID AND tweetID = :tweetID";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
  $stmt->bindParam(':tweetID', $tweetID, PDO::PARAM_INT);
  $stmt->execute();

  if ($stmt->rowCount() == 0) {
    // User hasn't liked this tweet yet, insert a new like record
    $sql = "INSERT INTO likes (userID, tweetID) VALUES (:userID, :tweetID)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    $stmt->bindParam(':tweetID', $tweetID, PDO::PARAM_INT);
    $stmt->execute();

    // Update like count in `berichten` table
    $sql = "UPDATE berichten SET aantalLikes = aantalLikes + 1 WHERE ID = :tweetID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tweetID', $tweetID, PDO::PARAM_INT);
    $stmt->execute();

    echo "Liked!";
  } else {
    echo "Already liked!";
  }
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
}

$conn = null;
?>
