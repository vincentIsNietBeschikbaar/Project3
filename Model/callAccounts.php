<?php
include_once __DIR__ . "/dbConnect.php";
session_start();

//Uitgebreide model uitwerking. Volledig OOP datamodel (wel met global pdo object)
class accounts{
    // gebruikerData
    private $ID;
    public $Naam;
    public $Email;
    public $Wachtwoord;

    function __construct(){
        $this->ID = null;
        $this->Naam = "databaseTweeters";
        $this->Email = "";
        $this->Wachtwoord = "";
    }

    //Creates database table if it doesnt exist yet.
    public static function initializeDatabase(){
        global $pdo;
        $pdo->prepare(
            "CREATE TABLE IF NOT EXISTS datavantwitter (
            ID INT AUTO_INCREMENT PRIMARY KEY,
            Naam VARCHAR(30) NOT NULL,
            Email VARCHAR(50) NOT NULL,
            Wachtwoord VARCHAR(50) NOT NULL
            );")->execute();
    }

    public function getID(){
        return $this->ID;
    }

    //Saves any changes.
    public function save() {
        global $pdo;
        if ($this->ID != null) {
            //Id already exists, overwrite existing database entry.
            $stmt = $pdo->prepare("UPDATE datavantwitter SET Naam = :Naam, Email = :Email, Wachtwoord = :Wachtwoord WHERE ID = :ID");
            $stmt->execute([':ID' => $this->ID, ':Naam' => $this->Naam, ':Email' => $this->Email, ':Wachtwoord' => $this->Wachtwoord]);
        }else{
            //No id found yet, insert new, then fetch created id.
            $stmt = $pdo->prepare("INSERT INTO datavantwitter (date, title, body) VALUES (:date, :title, :body)");
            $stmt->execute([':date' => $this->date->format('Y-m-d H:i:s'), ':title' => $this->title, ':body' => $this->body]);
            $idfetchstatement = $pdo->prepare("SELECT LAST_INSERT_ID();");
            $idfetchstatement->execute();
            $this->id = $idfetchstatement->fetchAll()[0]["LAST_INSERT_ID()"];
        }
    }

    public function delete() {
        global $pdo;
        if (!$this->id) {
            throw new Exception("Item doesn't exist in db");
        }

        $stmt = $pdo->prepare("DELETE FROM datavantwitter WHERE ID = :ID");
        $stmt->execute([':ID' => $this->ID]);

        $this->ID = null;
        $this->Naam = null;
        $this->Email = null;
        $this->Wachtwoord = null;
    }

    //Load by id, returns new instance.
    public static function load($ID) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM datavantwitter WHERE ID = :ID");
        $stmt->execute([':ID' => $ID]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        var_dump($data);

        if(count($data) != 1){
            return null;
        }

        //Create a new instance with the data
        return NewsModel::loadSingleResult($data[0]);
    }

    public static function loadProfilePicture($username){
        global $pdo;
        $stmt = $pdo->prepare("SELECT profilePicture FROM datavantwitter WHERE Naam = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['profilePicture'] : null;
    }

    public static function saveProfilePicture($username, $imgLink){
        global $pdo;
        $stmt = $pdo->prepare("UPDATE datavantwitter SET profilePicture = :imgLink WHERE Naam = :username");
        $stmt->bindParam(':imgLink', $imgLink, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        echo $imgLink;
        return $stmt->execute();
    }

    public static function makeAccount($Name, $Email, $Password) {
        global $pdo;

        $stmt = $pdo->prepare("SELECT * FROM datavantwitter WHERE Naam = :Naam");
        $stmt->bindParam(':Naam', $Name);
        $stmt->execute();
        $existingUser = $stmt->fetch();
        if ($existingUser){// if the username already exists
            echo "Deze gebruikersnaam is reeds in gebruik.";
        }else{

            $hashedPassword = password_hash($Password, PASSWORD_BCRYPT); // hashing the password
            $stmt = $pdo->prepare("INSERT INTO datavantwitter (Naam, Email, Wachtwoord) VALUES (:Naam, :Email, :Wachtwoord)");
            $stmt->bindParam(':Naam', $Name);
            $stmt->bindParam(':Email', $Email);
            $stmt->bindParam(':Wachtwoord', $hashedPassword);
            return $stmt->execute();
        }
    }

    public static function login($username, $password){
        global $pdo;
        $stmt = $pdo->prepare("SELECT Wachtwoord FROM datavantwitter WHERE naam = :naam");
        $stmt->bindParam(':naam', $username);
        $stmt->execute();
        // Then fetch the result and compare passwords

            $stmt->bindParam("Naam", $username);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $result["Wachtwoord"])) {
            echo "Hallo, " . $username;

            $_SESSION["username"] = $username;
        } else {
            echo "Wachtwoord of gebruikersnaam is onjuist";
        }
    }

    //Get the latest added story, returns new instance.
    public static function getLatestNewsStory(){
        global $pdo;
        $prepared = $pdo->prepare("SELECT * FROM datavantwitter ORDER BY date DESC LIMIT 1;");
        $prepared->execute();
        $data = $prepfared->fetchAll();

        //No story found
        if(count($data) == 0){
            return null;
        }
        return NewsModel::loadSingleResult($data[0]);
    }

    //utility function to transform a fetched result into an instance of this class.
    public static function loadSingleResult($data){
        if (!isset($data["id"]) || !isset($data["date"])|| !isset($data["title"])|| !isset($data["body"])){
            var_dump($data);
            throw new Exception("Some required elements not found for creating NewsPost");
        }

        $newNewsItem = new NewsModel();
        $newNewsItem->id = $data["id"];
        $newNewsItem->title = $data["title"];
        $newNewsItem->body = $data["body"];
        $newNewsItem->date = new DateTime($data["date"]);
        return $newNewsItem;
    }
}

class Chirps{
        public static function makeChirp($Poster, $ChirpBericht){
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO berichten (Poster, ChirpBericht) VALUES (:Poster, :ChirpBericht)");
        $stmt->bindParam(":Poster", $Poster);
        $stmt->bindParam(":ChirpBericht", $ChirpBericht);
        return $stmt->execute();
    }

    public static function getChirps(){
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM `berichten` ORDER BY `berichten`.`ID` DESC" );  
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
//Voorbeeldgebruik

//Aanmaken nieuw
//$test = new NewsModel();
//$test->body = "test body";
//$test->title = "test title";
//$test->save();

//Ophalen en veranderen
//$test = NewsModel::load(1);
//$test->body = "new body 2";
//$test->save();

//Deleten
//$test = NewsModel::load(1);
//$test->delete();
