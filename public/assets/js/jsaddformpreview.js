function previewImage() {
	let url = document.getElementById("url").value;
	let img = document.createElement("img");
	img.style.width = "100px";
	img.style.height = "100px";
	img.style.margin = "5px";
	let div = document.getElementById("photo");
	div.innerHTML = "";
	img.src = url;
	div.appendChild(img)

}

let input = document.getElementById("url");
input.addEventListener("input", previewImage);