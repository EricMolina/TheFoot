var file = document.getElementById("file");
var profilePreview = document.getElementById("profilePreview");
file.addEventListener("change",()=>{getImg()})

function getImg(){
    if (file.files && file.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            profilePreview.style.visibility = "visible";
            profilePreview.src = e.target.result;
        };
        reader.readAsDataURL(file.files[0]);
    }else{
        profilePreview.style.visibility = "hidden";
    }
}
