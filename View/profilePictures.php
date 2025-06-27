<?php
class profilePicturesView{
    public static function display(){

        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <link rel="stylesheet" href="../CSS/style.css">

        </head>
        <body>

        </body>
        </html>';

        $profilePictureFolder = "../IMG/Profielfotos";
        $files = glob("$profilePictureFolder/*.png");
      
        foreach($files as $image){ // echoing all the profile pictures
            echo "<img src=\"$image\" width=\"5%\" alt=\"Profielfoto\"> ";
        }
        echo '<form method="post" action="../Controllers/profilePicturesController.php">';
        foreach($files as $image){ // echoing all the confirm buttons
            echo '<input class="profilePicButton" type="radio" id="input" name="imageLink" value="' . htmlspecialchars($image) . '"> ';
        }
        echo '<input class="linkButton" type="submit" value="opslaan" name="submit">';
        echo '</form>';

        echo '<a href="../Controllers/HomepageController.php" class="linkButton">Ga terug</a>';
    }
}
?>