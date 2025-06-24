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
        // loading the profilePicture from the database when the user visits the homepage
        global $pdo;
        $stmt = $pdo->prepare("SELECT profielFoto FROM datavantwitter WHERE Naam = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['profielFoto'] : null;
    }
     
    public static function saveProfilePicture($username, $imgLink){
        // saving the profilePicture when the user selects a new one
        global $pdo;
        $stmt = $pdo->prepare("UPDATE datavantwitter SET profielFoto = :imgLink WHERE Naam = :username");
        $stmt->bindParam(':imgLink', $imgLink, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        return $stmt->execute();
    }

    public static function makeAccount($Name, $Email,$Password) {
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

        $stmt->bindParam("Naam", $username);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $result["Wachtwoord"])) { // if the password is correct
            $_SESSION['login'] = true;
            echo "Hallo, " . $username;
            $_SESSION["username"] = $username;
        } else {
            echo "Wachtwoord of gebruikersnaam is onjuist";
        }
    }
}
