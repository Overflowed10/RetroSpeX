function registerUser(){
    document.getElementById("register-user-btn").disabled = true;
    setTimeout(function(){
            document.getElementById("register-user-btn").disabled = false;
        }, 2000);
}

document.getElementById("register-user-btn").addEventListener("click", registerUser);