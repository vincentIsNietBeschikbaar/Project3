const chirpButton = document.getElementById("ChirpButton"); // the button where you place a tweet
const chirpToClone = document.getElementById("cloneTweet"); // the tweet that is used to create other tweets
const fieldToPlace = document.getElementById("makeChirpField")// field to make tweets

const scrollContainer = document.documentElement; // You may need to adjust this based on your specific scroll container

let increaseAmount = 300; 

chirpButton.onclick = function(){

  console.log("user pressed button")
  let newChirp = chirpToClone.cloneNode(true);
  chirpToClone.after(newChirp);
 
  newChirp.style.position = "absolute"; // Change position to relative
 
  newChirp.style.top = increaseAmount + "px"; // Set the top position
 
  increaseAmount += 300;
 
  // Scroll to the bottom of the page after adding a new chirp
 
  // Ensure vertical scrolling is enabled
 
  let textToChirp = maketweetText();

  let tweetTextElement = newChirp.querySelector(".textInTweet");
  tweetTextElement.textContent = textToChirp;

};
 
function maketweetText() { 
  console.log(fieldToPlace.value)
  const tweetText = fieldToPlace.value
  if (tweetText.length > 281)
    tweetText = tweetText.substring(0, 281);
    return tweetText;
}

const tweets = document.getElementById("tweets");



