<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") { // check if the submit button is pressed
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "databasetweeters";

    echo "<pre>" . print_r($_POST, true) . "</pre>";

    $imageLink = $_POST['imageLink'];

    try {

        if (!empty($imageLink)) {

            // Create a PDO connection 
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // Set the PDO error mode to exception 
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // If not the same, insert the new chirp into the database

            $currentUsername = $_SESSION["user"];

            // Prepare the SQL statement with placeholders
            $stmt = $conn->prepare("UPDATE datavantwitter SET profielFotoLink = '$imageLink' WHERE Naam = :nm");

            // Execute the statement
            $stmt->execute([
                "nm" => $currentUsername
            ]);

            echo "Record updated successfully";


            // Proceed with SQL query
        } else {
            echo "Error: Image link is empty.";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Display Images</title>
    <link rel="stylesheet" href="../CSS/style.css?v=<?php echo time(); ?>">
</head>

<body>

    <form method="post" action="">
        <textarea class="imageLink" name="imageLink" id="imageLink" cols="30" rows="10"></textarea>
        <input class="choosePhotoButton" type="submit" value="Selecteer">
    </form>

    <h1>Selecteer uw profielFoto</h1>
    <a href="hoofdpagina.php">Ga terug naar de hoofdpagina</a> <br>

    <?php
    // Path to the folder containing images
    $folder = '../IMG/Profielfotos';

    // Get all files in the folder
    $files = scandir($folder);

    // Loop through each file
    $PictureID = 1; // Start from 1
    foreach ($files as $file) {
        // Skip '.' and '..' which represent the current and parent directories
        if ($file != "." && $file != "..") {
            // Display the image
            echo "<img id=\"profilePicture$PictureID\" src='$folder/$file' alt='Image' class='ProfilePicImages'>";
            $PictureID += 1; // Increment ID only when image is displayed
        }
    }
    ?>
    <script src="../JS/selectProfilePic.js"></script>
</body>

</html>