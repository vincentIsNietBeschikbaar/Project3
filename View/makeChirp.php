<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuwe Chirp maken</title>
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="icon" href="../IMG/flavicon.ico" type="image/x-icon">
</head>
<body>
  <form method="post" action="../Controllers/tweetController.php"> 
 
        <textarea required id="makeChirpField" maxlength="281" class="makeChirpifyBox" name="ChirpBericht" cols="30" 
            rows="10"></textarea><br> 
        <input class="makeChirpifyButton" type="submit" value="Zet in database"> 
        <input type="file">

        <a  class="viewChirpsButton" href="hoofdpagina.php">Bekijk Chirps hier</a> 
        
</body>
</html>