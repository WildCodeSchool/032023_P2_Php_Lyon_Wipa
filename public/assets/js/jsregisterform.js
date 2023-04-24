function reportWindowSize() {
    const width = window.innerWidth;

    if (width >= 768) {
        document.getElementsByName("username")[0].placeholder = "";
        document.getElementsByName("password1")[0].placeholder = "";
        document.getElementsByName("password2")[0].placeholder = "";
    }
    else {
        document.getElementsByName("username")[0].placeholder = "Username";
        document.getElementsByName("password1")[0].placeholder = "Enter a password";
        document.getElementsByName("password2")[0].placeholder = "Retype your password";
    }
}

window.onload = reportWindowSize;
window.onresize = reportWindowSize;