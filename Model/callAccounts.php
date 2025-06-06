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

    public static function loadProfilePicture($username){
        global $pdo;
        $stmt = $pdo->prepare("SELECT profielFoto FROM datavantwitter WHERE Naam = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['profielFoto'] : null;
    }

    public static function saveProfilePicture($username, $imgLink){
        global $pdo;
        $stmt = $pdo->prepare("UPDATE datavantwitter SET profielFoto = :imgLink WHERE Naam = :username");
        $stmt->bindParam(':imgLink', $imgLink, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
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

    public static function likeChirp($userID, $PostToLike){
        global $pdo;
        $stmt = $pdo->prepare("UPDATE berichten SET Likes = Likes + 1 WHERE :ID = $PostToLike");
        echo "success";
        return $stmt->execute();
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
