const followForms = document.querySelectorAll(".bi-dash-square-fill, .bi-plus-square-fill");

for (let i = 0; i < followForms.length; i++) {
    let followForm = followForms[i]

    followForm.addEventListener('click', function (event) {
        let photoUser = this.dataset.photoUser;
        let photoUserId = this.dataset.photoUserId;

        fetch("user/follow",
            {
                method: "POST",
                //datas posted with a key-value pair
                body: "followedId=" + photoUserId,
                headers:
                    { "Content-Type": "application/x-www-form-urlencoded" }

            }).then((response) => {
                //start following this user
                if (followForm.className.match(/plus/g)) {
                    for (form of followForms) {
                        if (form.dataset.photoUserId == photoUserId) {
                            console.log(form.dataset.photoUserId + ' ' + photoUserId);
                            form.className = "bi bi-dash-square-fill";
                        }
                    };
                    alert("You are following " + photoUser);
                }
                //stop following this user
                else if (followForm.className.match(/dash/g)) {
                    for (form of followForms) {
                        if (form.dataset.photoUserId == photoUserId) {
                            form.className = "bi bi-plus-square-fill";
                        }
                    };
                    alert("You stopped following " + photoUser);
                }
            });
    });
}

