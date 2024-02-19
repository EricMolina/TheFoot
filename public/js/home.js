var orderBtn = document.getElementById("orderBtn");
orderBtn.addEventListener("click",()=>{orderBtnChange()})
function orderBtnChange(){
    if(orderBtn.innerText == "ASC"){
        orderBtn.innerText = "DESC";
    }else{
        orderBtn.innerText = "ASC";
    }
}