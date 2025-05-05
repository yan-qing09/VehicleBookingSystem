function validateImage() {
    var fileInput = document.getElementById('exampleInputImage');
    var fileSize = fileInput.files[0].size;
    var fileType = fileInput.files[0].type;

    if (fileSize > 5 * 1024 * 1024) {
        alert('File size exceeds the limit (5MB). Please choose a smaller file.');
        return false;
    }

    if (!(fileType === 'image/jpeg' || fileType === 'image/png' || fileType === 'image/gif')) {
        alert('Invalid file type. Please choose a JPEG, PNG, or GIF image.');
        return false;
    }

    return true;
}

function onSubmit() {
    return validateImage();
}
