           <?php
        include_once __DIR__ . "/../Model/callAccounts.php";
        include_once __DIR__ . "/../View/hoofdpagina.php";

            session_start();
echo "          Welkom,  " . $_SESSION["username"] . ".<br>";

class homePage{

    public static function execute(){
            $page = new page();
            $page->display();
    }}
    homepage::execute();
    ?>
    