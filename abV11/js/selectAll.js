const selectAll = document.getElementById("selectAll")
const allcheck = document.querySelectorAll(".check");
selectAll.addEventListener("click",function(){
    if(this.checked === true){
        for(let i = 0; i < allcheck.length; i++){
            allcheck[i].checked = true
        }
    }else if(this.checked === true){
        for(let i = 0; i < allcheck.length; i++){
            allcheck[i].checked = false
        }   
    }    
})
allcheck.forEach(element => {
    element.addEventListener("click",function(){
        if(this.checked == false){
            if(selectAll.checked == true){
                console.log("hello");
                selectAll.checked = false
            }
        }
    })
})