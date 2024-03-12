const chirpButton = document.getElementById("makeChirpButton");
const chirpToClone = document.getElementById("cloneTweet");
const scrollContainer = document.documentElement; // You may need to adjust this based on your specific scroll container

let increaseAmount = 0;

chirpButton.onclick = function () {
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
  let tweetText = prompt();
  if (tweetText.length > 281) 
    tweetText = tweetText.substring(0, 281);
    return tweetText;
}
