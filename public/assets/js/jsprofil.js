// Get all the images at the same size
window.onload = function () {
    const images = document.querySelectorAll('.img-fit');
    const containerWidth = document.querySelectorAll('.container').clientWidth;
    const numOfImages = images.length;
    const imageWidth = 256;
    const imageHeight = 256;
    const totalWidth = numOfImages * imageWidth;
    if (totalWidth <= containerWidth) {
        // If the total width of all images is less than or equal to the container width, we can center the images.
        const marginLeft = Math.floor((containerWidth - totalWidth) / 2);
        images.forEach(image => {
            image.style.marginLeft = marginLeft + 'px';
        });
    }
    images.forEach(image => {
        image.style.width = imageWidth + 'px';
        image.style.height = imageHeight + 'px';
        image.style.marginRight = '0';
    });
    // Remove the right margin from all images except the last one
    images[numOfImages - 1].style.marginRight = '0';
};
// Get a pop-up on click on the image with all informations

let thumbnailImages = document.querySelectorAll('.pop-up-image');

for (let i = 0; i < thumbnailImages.length; i++) {
    let thumbnailImage = thumbnailImages[i];

    thumbnailImage.addEventListener('click', function (event) {
        event.preventDefault();

        let photoUrl = this.parentNode.dataset.photoUrl;
        let photoTitle = this.parentNode.dataset.photoTitle;
        let photoPrompt = this.parentNode.dataset.photoPrompt;
        let photoDescription = this.parentNode.dataset.photoDescription;
        let photoDate = this.parentNode.dataset.photoDate;
        let photoUser = this.parentNode.dataset.photoUser;


        document.getElementById('popup-image').setAttribute('src', photoUrl);
        document.getElementById('popup-title').textContent = photoTitle;
        document.getElementById('popup-prompt').textContent = photoPrompt;
        document.getElementById('popup-description').textContent = photoDescription;
        document.getElementById('popup-date').textContent = photoDate;
        if (typeof photoUser !== 'undefined') {
        document.getElementById('popup-username').textContent = photoUser;
        }


        document.getElementById('popup-container').style.display = 'block';
    });
    document.getElementById('popup-container').addEventListener('click', function () {
        this.style.display = 'none';
    })
};

// Get a pop-up on click on the edit button with all informations

let thumbnailEdits = document.querySelectorAll('.edit-button');

for (let i = 0; i < thumbnailEdits.length; i++) {
    let thumbnailEdit = thumbnailEdits[i];

    thumbnailEdit.addEventListener('click', function (event) {
        event.preventDefault();

        let photoUrl = this.parentNode.dataset.photoUrl;
        let photoTitle = this.parentNode.dataset.photoTitle;
        let photoPrompt = this.parentNode.dataset.photoPrompt;
        let photoDescription = this.parentNode.dataset.photoDescription;
        let photoDate = this.parentNode.dataset.photoDate;
        let photoId = this.parentNode.dataset.photoId;

        document.getElementById('popup-image-edit').setAttribute('src', photoUrl);
        document.getElementById('popup-title-edit').value = photoTitle;
        document.getElementById('popup-prompt-edit').value = photoPrompt;
        document.getElementById('popup-description-edit').value = photoDescription;
        document.getElementById('popup-date-edit').textContent = photoDate;
        document.getElementById('photoIdEdit').setAttribute('value', photoId);
        document.getElementById('photoIdDelete').setAttribute('value', photoId);

        document.getElementById('popup-container-edit').style.display = 'block';
    });
    document.getElementById('popup-close-btn').addEventListener('click', function () {
        document.getElementById('popup-container-edit').style.display = 'none';
    })
    document.getElementById('popup-close-edit-btn').addEventListener('click', function () {
        document.getElementById('popup-container-edit').style.display = 'none';
    })
};