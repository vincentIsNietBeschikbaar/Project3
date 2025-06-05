<?php
class profilePicturesView{
    public static function display(){
        $profilePictureFolder = "../IMG/Profielfotos";
        $files = glob("$profilePictureFolder/*.png");
        
        foreach($files as $image){
            echo "<img src=\"$image\" width=\"5%\" alt=\"Profielfoto\"> ";
        }
        echo '<form method="post" action="../Controllers/profilePicturesController.php">';
        foreach($files as $image){
            echo '<input type="radio" id="input" name="imageLink" value="' . htmlspecialchars($image) . '"> ';
        }
        echo '<input class="submitButton" type="submit" value="opslaan" name="submit">';
        echo '</form>';

        echo '<a href="../Controllers/homePageController.php">Ga terug</a>';
    }
}
?>