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