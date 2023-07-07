//SEE PASSWORD FUNCTION 
const seePass = document.getElementById("see-pass")

seePass.addEventListener("change", function(){
    const signPass = document.getElementById("signup-pass")
    const conPass = document.getElementById("signup-conpass")

    if(signPass.type === 'password' || conPass.type === 'password'){
        signPass.type = 'text'
        conPass.type = 'text'
    }
    else{
        signPass.type = 'password'
        conPass.type = 'password'
    }
})
