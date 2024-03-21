document.addEventListener("DOMContentLoaded", function() {
    let heart = document.getElementById('heart');
    if (heart) {
        heart.addEventListener("click", toggleHeart);
    }
});

function toggleHeart() {
    this.classList.toggle('fa-heart');
    this.classList.toggle('fa-heart-o');
}