window.onload = function () {
    const form = document.getElementsByTagName("form")[0];

    document.querySelectorAll(".navigator").forEach((button) => {
        button.addEventListener("click", function() {
            form.querySelector("input[name='nextQuestionId']").value = button.id;
            form.submit();
        });
    });
}