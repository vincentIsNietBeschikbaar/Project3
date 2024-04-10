const chirpToClone = document.getElementById("cloneTweet"); // the tweet that is used to create other tweets

const scrollContainer = document.documentElement; // You may need to adjust this based on your specific scroll container

let increaseAmount = 300;

function fillHearts(unfilledHeart, filledHeart, amountOfHearts) { // function for the like/unlike system
  unfilledHeart.addEventListener('click', function () {// user likes the tweet
    console.log(amountOfHearts.innerHTML);
    amountOfHearts.innerHTML = +amountOfHearts.innerHTML + 1
    unfilledHeart.style.visibility = "hidden";
    filledHeart.style.visibility = "visible";
  })

  filledHeart.addEventListener('click', function () {// user unlikes the tweet
    console.log("Liking the tweet")
    unfilledHeart.style.visibility = "visible";
    filledHeart.style.visibility = "hidden";
  })
}

function deleteTweet(deleteButton) {
    deleteButton.addEventListener('click', function () {// moderator deletes a tweet
    deleteButton.parentElement.parentElement.remove();
  })
}

function makeTweet(tweetText, Poster, currentamountofLikes, deleteButton) {
  let newChirp = chirpToClone.cloneNode(true);
  chirpToClone.after(newChirp);

  newChirp.style.position = "absolute"; // Change position to relative

  newChirp.style.top = increaseAmount + "px"; // Set the top position

  increaseAmount += 300;

  // Scroll to the bottom of the page after adding a new chirp

  // Ensure vertical scrolling is enabled
  let tweetTextElement = newChirp.querySelector(".textInTweet"); // calling variables we need to put in the tweet
  let profileBar = newChirp.querySelector(".profileBar")

  let tweetBox = newChirp.querySelector(".tweetBox")
  let filledHeart = tweetBox.querySelector(".filled_Heart")
  let unfilledHeart = tweetBox.querySelector(".unfilled_Heart")
  let likeCounter = tweetBox.querySelector(".likeCounter")

  if (deleteButton) {// if the user is an admin, the deleteButton shows up and is parented under tweetbox
    tweetBox.appendChild(deleteButton);
    deleteTweet(deleteButton);
  }

  tweetTextElement.appendChild(tweetText);
  profileBar.appendChild(Poster);
  likeCounter.appendChild(currentamountofLikes)

  fillHearts(unfilledHeart, filledHeart, currentamountofLikes);// calling function for the like/unlike system
}

// tweetcount makes a new id name for each tweet
let tweetcount = 0

while (tweetcount < 15) {

  let currentTweet = document.getElementById('tweets' + tweetcount)
  let currentPoster = document.getElementById('Poster' + tweetcount)
  let currentamountofLikes = document.getElementById('aantalLikes' + tweetcount)

  tweetcount += 1;

  currentPoster.style.top = 0;
  currentPoster.style.zIndex = 5;
  currentPoster.style.marginLeft = 5;

  if (document.getElementById('deleteButton' + tweetcount)) {
    let deleteButton = document.getElementById('deleteButton' + tweetcount)
    makeTweet(currentTweet, currentPoster, currentamountofLikes, deleteButton);

  } else {
    makeTweet(currentTweet, currentPoster, currentamountofLikes);
  }
}