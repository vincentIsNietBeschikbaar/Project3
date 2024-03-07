const chirpButton = document.getElementsByName("makeChirpButton")
const chirpToClone = document.getElementById("cloneTweet")

function maakChirp(){
    const anumber = 3
    document.writea(anumber)
}

chirpButton.onclick = function() {
    
    let newChirp = chirpToClone.cloneNode(true)

    chirpToClone.after(newChirp)
}