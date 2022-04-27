var pwdIcon = document.getElementById("pwdTog");
var pwdInput = document.getElementById('psswd');
pwdIcon.addEventListener("click",function(){
    /* alert("hello") */
    this.classList.toggle("bi-eye-fill");
    this.classList.toggle("bi-eye-slash-fill");
    if(pwdInput.getAttribute("type") === "password"){
        pwdInput.setAttribute("type","text");
    }
    else{
        pwdInput.setAttribute("type","password");
    }
})