function previewImage() {
    var url = document.getElementById("url").value;
    var img = document.createElement("img");
    img.style.width = "100px";
    img.style.height = "100px";
    img.style.margin = "5px" ;
    var div = document.getElementById("photo");
    div.innerHTML = "";
    var xhr = new XMLHttpRequest();
    xhr.open('HEAD', url);
    xhr.onreadystatechange = function() {
        if (this.readyState === this.DONE) {
            if (this.status === 200) {
                var contentType = xhr.getResponseHeader('Content-Type');
                if (contentType && contentType.startsWith('image/')) {
                    img.src = url;
                    div.appendChild(img);
                }
            }
        }
    };
    xhr.send();
}

let input = document.getElementById("url");
input.addEventListener("input", previewImage);