//SEE PASSWORD FUNCTION 
const seePass = document.getElementById("see-pass")

seePass.addEventListener("change", function(){
    const loginPass = document.getElementById("login-pass")

    if(loginPass.type === 'password'){
        loginPass.type = 'text'
    }
    else{
        loginPass.type = 'password'
    }
})
