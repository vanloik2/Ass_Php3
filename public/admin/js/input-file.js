function uploadFile(){
    
    var avatar = document.querySelector('input[name=avatar]').files[0];
    var preview = document.querySelector('#previewImage');

    var reader = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);

    if(avatar){
        reader.readAsDataURL(avatar);
    }
}