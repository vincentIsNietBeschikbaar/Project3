const chirpButton = document.getElementById("makeChirpButton")
const chirpToClone = document.getElementById("cloneTweet")

let increaseAmount = -200
let tweetcount = 1

chirpButton.onclick = function() {

    console.log("Cloning tweet")
    let newChirp = chirpToClone.cloneNode(true)
    chirpToClone.after(newChirp)

    newChirp.style.position = "absolute";
    newChirp.style.top = increaseAmount + "px"; // Set the top position

    increaseAmount -= 250
    console.log(increaseAmount)


}