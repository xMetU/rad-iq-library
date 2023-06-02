window.onload = function () {
    const form = document.getElementsByTagName("form")[0];

    form.submit();

    form.addEventListener("submit", () => console.log("SUBMITTED"));

    document.querySelectorAll(".navigator").forEach((button) => {
        button.addEventListener("click", function() {
            form.submit();
        });
    });
}