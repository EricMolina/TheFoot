var addBtn = document.getElementById("addBtn");
var opForm = document.getElementById("opForm");

addBtn.addEventListener('click',()=>{
    if(addBtn.innerText == "Comentar"){
        addBtn.innerText = "Cerrar";
        opForm.style.display = "block";
    }else{
        opForm.style.display = "none";
        addBtn.innerText = "Comentar"
    }
})