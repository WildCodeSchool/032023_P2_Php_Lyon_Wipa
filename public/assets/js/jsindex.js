
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

thumbnailImage.addEventListener('click', function (event) {
event.preventDefault();

let photoUrl = this.parentNode.dataset.photoUrl;
let photoTitle = this.parentNode.dataset.photoTitle;
let photoPrompt = this.parentNode.dataset.photoPrompt;
let photoDescription = this.parentNode.dataset.photoDescription;
let photoDate = this.parentNode.dataset.photoDate;

document.getElementById('popup-image').setAttribute('src', photoUrl);
document.getElementById('popup-title').textContent = photoTitle;
document.getElementById('popup-prompt').textContent = photoPrompt;
document.getElementById('popup-description').textContent = photoDescription;
document.getElementById('popup-date').textContent = photoDate;

document.getElementById('popup-container').style.display = 'block';
});
document.getElementById('popup-container').addEventListener('click', function () { 
this.style.display = 'none';
})};

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

document.getElementById('popup-image').setAttribute('src', photoUrl);
document.getElementById('popup-title').textContent = photoTitle;
document.getElementById('popup-prompt').textContent = photoPrompt;
document.getElementById('popup-description').textContent = photoDescription;
document.getElementById('popup-date').textContent = photoDate;

document.getElementById('popup-container').style.display = 'block';
});
document.getElementById('popup-container').addEventListener('click', function () { 
this.style.display = 'none';
})};
