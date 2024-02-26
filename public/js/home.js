var orderBtn = document.getElementById("orderBtn");
orderBtn.addEventListener("click",()=>{orderBtnChange()})
function orderBtnChange(){
    if(orderBtn.innerText == "ASC"){
        orderBtn.innerText = "DESC";
        orderBtn.value = "DESC";
    }else{
        orderBtn.innerText = "ASC";
        orderBtn.value = "ASC";
    }
    getRestaurants();
}