<?php
class profilePicturesView {
    public static function display() {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Profielfoto kiezen</title>
            <link rel="stylesheet" href="../CSS/style.css">
        </head>
        <body>';

        $profilePictureFolder = "../IMG/Profielfotos";
        $files = glob("$profilePictureFolder/*.png");

        echo '<form method="post" action="../Controllers/profilePicturesController.php">';
        echo '<div class="profile-container">';

        foreach($files as $image) {
            echo '<div class="profile">';
            echo "<img src=\"$image\" alt=\"Profielfoto\">";
            echo '<input class="profilePicButton" type="radio" name="imageLink" value="' . htmlspecialchars($image) . '">';
            echo '</div>';
        }

        echo '</div>'; // close .profile-container
        echo '<input class="linkButton" type="submit" value="Opslaan" name="submit">';
        echo '</form>';

        echo '<a href="../Controllers/HomepageController.php" class="linkButton">Ga terug</a>';

        echo '</body></html>';
    }
}
?>
