<?php
include_once __DIR__ . "/dbConnect.php";
class Chirps{
    public static function makeChirp($Poster, $ChirpBericht){
        // saving the chirp the user has just posted.
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO berichten (Poster, ChirpBericht) VALUES (:Poster, :ChirpBericht)");
        $stmt->bindParam(":Poster", $Poster);
        $stmt->bindParam(":ChirpBericht", $ChirpBericht);
        return $stmt->execute();
    }

    public static function getChirps(){
        // getting the chirps to display on the homepage
        global $pdo;
        $stmt = $pdo->prepare("SELECT b.Poster, b.ChirpBericht, b.ID, b.Likes, d.ProfielFoto
FROM berichten b
LEFT JOIN datavantwitter d ON b.Poster = d.Naam
ORDER BY `ID` DESC;" );  
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function likeChirp($username, $PostToLike, $existingLikes){
        global $pdo;

        if (!in_array($PostToLike, $existingLikes)){ // if the user liked the tweet already
            $stmt1 = $pdo->prepare("UPDATE berichten SET Likes = Likes + 1 WHERE ID = :PostID");
            $stmt1->bindParam(':PostID', $PostToLike);
            $stmt1->execute();
            
            $stmt3 = $pdo->prepare("INSERT INTO likedchirps (PostID, Username) VALUES (:PostID, :Username)");
            $stmt3->bindParam(':PostID', $PostToLike);
            $stmt3->bindParam(':Username', $username);
            $stmt3->execute();
        }else{
            echo "liked chirp already";
        }
    }

    public static function getExistingLikes($username){
        
        global $pdo;// getting the chirp the user has already liked, so an user can't like a chirp multiple times
        $stmt = $pdo->prepare("SELECT PostID FROM likedchirps WHERE Username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $existingLikeIDs = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);
        if ($existingLikeIDs){
            return $existingLikeIDs;
        }else{
            return 0;
        }
    }
}