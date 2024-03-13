var likeButton = document.getElementById("likeButton");
var likeCount = 0;

function likeTweet() {
  likeButton.classList.toggle("liked");
  likeCount += likeButton.classList.contains("liked") ? 1 : -1;
  
  var likeCounterElement = document.querySelector(".like-counter");
  likeCounterElement.textContent = likeCount;
}
