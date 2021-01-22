const loginForm = document.getElementById("loginForm");
const loginButton = document.getElementById("loginbutton");
// const loginErrorMsg = document.getElementById("login-error-msg");

loginButton.addEventListener("click", (e) => {
    e.preventDefault();
    const username = loginForm.username.value;
    const password = loginForm.password.value;

    if (username === "admin" && password === "ad123") {
        alert("You have successfully logged in.");
        
        window.location.href = "main.php";
    } else {
      
      window.location.href = "login1.html";
        alert("Invalid Credentials");
    }
})