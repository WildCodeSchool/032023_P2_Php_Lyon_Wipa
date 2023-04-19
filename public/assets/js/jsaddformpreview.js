function previewImage() {
	var url = document.getElementById("picture").value;
	console.log(url);
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