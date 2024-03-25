const chirpToClone = document.getElementById("cloneTweet"); // the tweet that is used to create other tweets
const fieldToPlace = document.getElementById("makeChirpField")// field to make tweets

const scrollContainer = document.documentElement; // You may need to adjust this based on your specific scroll container

let increaseAmount = 300;

function useless() {
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
}



function maketweetText() {
  console.log(fieldToPlace.value)
  const tweetText = fieldToPlace.value
  if (tweetText.length > 281)
    tweetText = tweetText.substring(0, 281);
  return tweetText;
}


let tweetcount = 0
let amountToLower = 0


function moveTweets() {

  while (tweetcount < 10) {

    console.log("tweets" + tweetcount)
    let currentTweet = document.getElementById('tweets' + tweetcount)

    amountToLower += 200;

    currentTweet.style.color = "#FF0000";
    tweetcount += 1;

  }
}

