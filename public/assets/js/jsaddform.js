function reportWindowSize() {
    const width = window.innerWidth;

    if (width >= 768) {
        document.getElementsByName("title")[0].placeholder = "";
        document.getElementsByName("picture")[0].placeholder = "";
        document.getElementsByName("prompt")[0].placeholder = "";
        document.getElementsByName("description")[0].placeholder = "";
    }
    else {
        document.getElementsByName("title")[0].placeholder = "Title";
        document.getElementsByName("picture")[0].placeholder = "Picture://URL";
        document.getElementsByName("prompt")[0].placeholder = "Your prompt";
        document.getElementsByName("description")[0].placeholder = "Comment";
    }
}

window.onload = reportWindowSize;
window.onresize = reportWindowSize;