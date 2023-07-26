function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('preview-image').src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}

function previewAdditionalImage(input, imageIndex) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector('#preview-additional-image' + imageIndex).setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}