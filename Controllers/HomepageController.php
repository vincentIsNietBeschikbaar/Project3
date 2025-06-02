<?php
    include_once __DIR__ . "/../Model/callAccounts.php";
    include_once __DIR__ . "/../View/hoofdpagina.php";

    //session_start();
echo "          Welkom,  " . $_SESSION["username"] . ".<br>";

class homePageView{

    public static function execute(){

        $homeView = new homeView();
        $homeView->display();

        $profilePicture = accounts::loadProfilePicture($_SESSION["username"]);
        

        echo '    
        <div class="profileContainer">
            <img class="profilePicture" src="' . htmlspecialchars($profilePicture) .'" alt="">
            <div class="welcomeText">
        </div>
        </div>';


        /*$tweets = Chirps::GetChirps();
          foreach($tweets as $tweet){
        var_dump ($tweet); */
    }
}
homepageView::execute();