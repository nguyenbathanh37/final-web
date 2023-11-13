const password = document.querySelector("input[name=password]");
const show_password = document.getElementById("show-password");
$(show_password).change(function(){
    if(password.type === "password"){
        password.type = "text";
    }else{
        password.type = "password";
    }
})