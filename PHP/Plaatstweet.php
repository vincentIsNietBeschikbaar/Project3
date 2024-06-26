<?php 
session_start(); 

echo "Welkom,  " . $_SESSION["user"] . ".<br>"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") { // check if the submit button is pressed
    $servername = "localhost"; 
    $username = "root"; 
    $password = ""; 
    $dbname = "databaseBerichten"; 

    $amountOfLikes = 0; 
    $originalPoster = $_SESSION["user"]; 
    $chirpifyText = $_POST['makeChirpifyBox']; 

    try { 
        // Create a PDO connection 
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password); 
        // Set the PDO error mode to exception 
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

        // Fetch the last chirp from the database
        $lastChirpStmt = $conn->query("SELECT chirpText FROM berichten ORDER BY id DESC LIMIT 1");
        $lastChirp = $lastChirpStmt->fetchColumn();

        // Check if the last chirp is the same as the new chirp
        if ($lastChirp !== $chirpifyText) {
            // If not the same, insert the new chirp into the database
            $sql = "INSERT INTO berichten (Poster, chirpText, aantalLikes) 
                VALUES ('$originalPoster', '$chirpifyText', '$amountOfLikes')"; 
            $conn->exec($sql);
            echo "Tweet in database gegooit";
        } else {
            echo "Duplicate tweet. Not inserted.";
        }

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
 <img class="cuteDuck" src="../IMG/chirpifyLogo.png" alt="Als je dit ziet, is er denk ik iets fout, er zou hier oorspronkelijk een eend moeten staan..">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
 
        <textarea id="makeChirpField" maxlength="281" class="makeChirpifyBox" name="makeChirpifyBox" cols="30" 
            rows="10"></textarea><br> 
        <input class="makeChirpifyButton" type="submit" value="Zet in database"> 
        <input type="file">
    </form> 
    
    </form>


    <a href="hoofdpagina.php">Bekijk tweets hier</a>
    <a href="profilePicture.php">Selecteer een profielFoto</a>

</body> 
 
</html>