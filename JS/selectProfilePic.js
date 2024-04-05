let id = 1;
let imageLinkTag = document.getElementById("imageLink");

while (id < 13) {
    let profilePicture = document.getElementById('profilePicture' + id);
    
    if (profilePicture) {
        profilePicture.addEventListener('click', function () {
            let selectedProfilePic = profilePicture;
            selectedProfilePic.style.opacity = .5;

            let imageURL = selectedProfilePic.getAttribute('src');
            let imageName = imageURL.split('/').pop(); // Get the last part of the URL which should be the file name
            console.log('Image Name:', imageName);

            imageLinkTag.innerHTML = imageURL;
            console.log(imageLinkTag);
        });
    } else {
        console.log("Error on ProfilePicture ", id);
    }
    id += 1;
}