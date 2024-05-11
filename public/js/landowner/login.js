var loginPasswordInput = document.getElementById("login-password");
var icon = document.getElementById("password-icon");

function ShowPassword()
{
    loginPasswordInput.type = "text";
    icon.className = "bx bxs-hide";
}

function hidePassword() 
{
    loginPasswordInput.type = "password";
    icon.className = "bx bxs-show";
}
