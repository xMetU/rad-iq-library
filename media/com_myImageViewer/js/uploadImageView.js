window.onload = function () {
    // Makes the images redirect to the focused image view when clicked
    const tableBody = document.getElementById("image-list");

    tableBody.querySelectorAll("button").forEach((button) => {
        button.onclick = function (e) {
            // TODO: implement "are you sure" prompt
        };
    });
};