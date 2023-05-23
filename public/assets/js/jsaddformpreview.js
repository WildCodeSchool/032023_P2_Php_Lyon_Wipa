async function previewImage() {
    var url = document.getElementById("url").value;
    var img = document.createElement("img");
    img.style.width = "100px";
    img.style.height = "100px";
    img.style.margin = "5px";
    var div = document.getElementById("photo");
    div.innerHTML = "";

    try {
        const response = await fetch(url, { method: 'HEAD' });
        if (response.ok) {
            const contentType = response.headers.get('Content-Type');
            if (contentType && contentType.startsWith('image/')) {
                img.src = url;
                div.appendChild(img);
            }
        }
    } catch (error) {
        console.error('Erreur lors de la récupération de l\'image:', error);
    }
}

let input = document.getElementById("url");
input.addEventListener("input", previewImage);