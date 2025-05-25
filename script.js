// Script to detect image orientation and add class accordingly
document.addEventListener('DOMContentLoaded', () => {
    const images = document.querySelectorAll('.image-wrapper img');
    images.forEach(img => {
        if (img.naturalWidth >= img.naturalHeight) {
            img.classList.add('landscape');
        } else {
            img.classList.add('portrait');
        }
    });
});
