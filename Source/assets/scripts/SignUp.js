const password = document.querySelector("input[name=password]");
const confirm_password = document.querySelector("input[name=confirm_password]");
const show_password = document.getElementById("show-password");
$(show_password).change(function(){
    if(password.type === "password"){
        password.type = "text";
        confirm_password.type = "text";
    }else{
        password.type = "password";
        confirm_password.type = "password";
    }
})