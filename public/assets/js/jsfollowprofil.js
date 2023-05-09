const followForms = document.querySelectorAll(".bi-dash-square-fill, .bi-plus-square-fill");
const notification = document.getElementById("notification");

const refreshFollowing = document.getElementById("contact-tab");
if (typeof refreshFollowing !== 'undefined') {
    refreshFollowing.addEventListener('click', function (event1) {
        window.location.reload();
    });
}

for (let i = 0; i < followForms.length; i++) {
    let followForm = followForms[i];

    followForm.addEventListener('click', function (event) {
        let photoUser = this.dataset.photoUser;
        let photoUserId = this.dataset.photoUserId;
        let followButton = event.target;

        fetch("user/follow", {
            method: "POST",
            body: "followedId=" + photoUserId,
            headers: { "Content-Type": "application/x-www-form-urlencoded" }
        }).then((response) => {
            if (followForm.className.match(/plus/g)) {
                for (form of followForms) {
                    if (form.dataset.photoUserId == photoUserId) {
                        form.className = "bi bi-dash-square-fill";
                    }
                };
                let notification = document.createElement('div');
                notification.classList.add('follow-notification');
                notification.textContent = `You are following ${photoUser}.`;
                followButton.parentNode.insertBefore(notification, followButton);
                followButton.style.display = 'none';
                setTimeout(() => {
                    notification.remove();
                    followButton.style.display = 'block';
                }, 1000); // remove the notification after 2 seconds

            } else if (followForm.className.match(/dash/g)) {
                for (form of followForms) {
                    if (form.dataset.photoUserId == photoUserId) {
                        form.className = "bi bi-plus-square-fill";
                    }
                };
                let notification = document.createElement('div');
                notification.classList.add('follow-notification');
                notification.textContent = `You stopped following ${photoUser}.`;
                followButton.parentNode.insertBefore(notification, followButton);
                followButton.style.display = 'none';
                setTimeout(() => {
                    notification.remove();
                    followButton.style.display = 'block';
                }, 1000); // remove the notification after 2 seconds
            }
        });
    });
}

