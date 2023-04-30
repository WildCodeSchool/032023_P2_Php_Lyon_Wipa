
// Get all the images at the same size based on the smallest image

window.onload = function () {
    const images = document.querySelectorAll('.img-fit');
    let minWidth = Infinity;
    let minHeight = Infinity;
    images.forEach(image => {
        const width = image.clientWidth;
        const height = image.clientHeight;
        if (width < minWidth) {
            minWidth = width;
        }
        if (height < minHeight) {
            minHeight = height;
        }
    });
    images.forEach(image => {
        image.style.width = minWidth + 'px';
        image.style.height = minHeight + 'px';
    });
};

// Get a pop-up on click on the image with all informations

let thumbnailImages = document.querySelectorAll('.pop-up-image');

for (let i = 0; i < thumbnailImages.length; i++) {
    let thumbnailImage = thumbnailImages[i];
    console.log(thumbnailImage);

    thumbnailImage.addEventListener('click', function (event) {
        event.preventDefault();

        let photoUrl = this.parentNode.dataset.photoUrl;
        let photoTitle = this.parentNode.dataset.photoTitle;
        let photoPrompt = this.parentNode.dataset.photoPrompt;
        let photoDescription = this.parentNode.dataset.photoDescription;
        let photoDate = this.parentNode.dataset.photoDate;
        let photoUser = this.parentNode.dataset.photoUser;
        let photoUserId = this.parentNode.dataset.photoUserId;

        document.getElementById('popup-image').setAttribute('src', photoUrl);
        document.getElementById('popup-title').textContent = photoTitle;
        document.getElementById('popup-prompt').textContent = photoPrompt;
        document.getElementById('popup-description').textContent = photoDescription;
        document.getElementById('popup-date').textContent = photoDate;
        if (typeof photoUser !== 'undefined') {
            document.getElementById('popup-username').textContent = photoUser;
            document.getElementById('popup-user-id').textContent = photoUserId;
        }


        document.getElementById('popup-container').style.display = 'block';
    });
    document.getElementById('popup-close-btn').addEventListener('click', function () {
        document.getElementById('popup-container').style.display = 'none';
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


