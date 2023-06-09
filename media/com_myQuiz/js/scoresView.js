window.onload = function () {
    // Makes the images redirect to the focused image view when clicked
    const tableBody = document.getElementById("attempts");
    
    tableBody.querySelectorAll(".row").forEach((row) => {
        row.addEventListener("click", function () {
            attemptNumber = row.children[1].innerHTML.split(" ")[1];
            window.location.href = `?task=Display.summary&quizId=${row.id}&attemptNumber=${attemptNumber}`;
        });
    });
};