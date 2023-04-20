function previewImage() {
	var url = document.getElementById("url").value;
	var img = document.createElement("img");
	img.style.width = "100px";
	img.style.height = "100px";
	var div = document.getElementById("photo");
	div.innerHTML = "";
	var match = /\.(jpeg|jpg|gif|png)(\?.*)?$/i;
	if (match.test(url)){
		img.src = url ;
		div.appendChild(img)
	}
}

var input = document.getElementById("url");
input.addEventListener("input", previewImage);