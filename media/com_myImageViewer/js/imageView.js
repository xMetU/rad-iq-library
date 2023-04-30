window.onload = function () {
    // Makes the images redirect to the focused image view when clicked
    const tableBody = document.getElementById("images");

    tableBody.querySelectorAll("img").forEach((image) => {
        image.parentElement.addEventListener("click", function (e) {
            e.preventDefault();
            window.location.href += `focusImage&id=${image.id}`;
        });
    });
};