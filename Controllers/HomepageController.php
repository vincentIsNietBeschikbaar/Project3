<?php
    include_once __DIR__ . "/../Model/callAccounts.php";
    include_once __DIR__ . "/../View/hoofdpagina.php";

    session_start();
echo "          Welkom,  " . $_SESSION["username"] . ".<br>";

class homePageView{

    public static function execute(){
        $tweets = Chirps::GetChirps();
          foreach($tweets as $tweet){
        var_dump ($tweet);
    };

            $homeView = new homeView();
            $homeView->display();
    }}
    homepageView::execute();