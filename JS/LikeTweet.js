let heart = document.getElementById('heart')
heart.addEventListener("click", toggleHeart);

function toggleHeart() {
    this.classList.toggle('fa-heart');
    this.classList.toggle('fa-heart-o');
}