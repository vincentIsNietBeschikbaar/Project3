let id = 1;
let imageLinkTag = document.getElementById("imageLink");

while (id < 20) { // get all of the images
    let profilePicture = document.getElementById('profilePicture' + id);
    
    if (profilePicture) {
        profilePicture.addEventListener('click', function () {// when user clicks on a profile picture
            let selectedProfilePic = profilePicture;
            selectedProfilePic.style.opacity = .5;

            let imageURL = selectedProfilePic.getAttribute('src');

            imageLinkTag.innerHTML = imageURL; // puts the link in the textarea so PHP can put it in the database
        });
    } else if (!imageLinkTag) {
        // user is probrably on the mainpage
    }else{
        // error on loading a image
        console.log("Error on ProfilePicture ", id);
    }
    id += 1;
}