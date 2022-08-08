function uploadFile(){
    
    var image = document.querySelector('#image_upload').files[0];
    var preview = document.querySelector('#previewImage');

    var reader = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);

    if(image){
        reader.readAsDataURL(image);
    }
}