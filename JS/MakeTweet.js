const chirpToClone = document.getElementById("cloneTweet"); // the tweet that is used to create other tweets

const scrollContainer = document.documentElement; // You may need to adjust this based on your specific scroll container

let increaseAmount = 300;

function makeTweet(tweetText, Poster) {
  let newChirp = chirpToClone.cloneNode(true);
  chirpToClone.after(newChirp);

  newChirp.style.position = "absolute"; // Change position to relative

  newChirp.style.top = increaseAmount + "px"; // Set the top position

  increaseAmount += 300;

  // Scroll to the bottom of the page after adding a new chirp

  // Ensure vertical scrolling is enabled

  let tweetTextElement = newChirp.querySelector(".textInTweet");
  let profileBar = newChirp.querySelector(".profileBar")

  tweetTextElement.appendChild(tweetText);
  profileBar.appendChild(Poster);
}

// tweetcount makes a new id name for each tweet
let tweetcount = 0
// the amount to lower a tweet

function moveTweets() {

  while (tweetcount < 10) {

    let currentTweet = document.getElementById('tweets' + tweetcount)
    let currentPoster = document.getElementById('Poster'+ tweetcount)
    tweetcount += 1;

    currentPoster.style.top = 0;
    currentPoster.style.zIndex = 5;
    currentPoster.style.marginLeft = 5%

    console.log(currentTweet);

    makeTweet(currentTweet, currentPoster);

  }
}

