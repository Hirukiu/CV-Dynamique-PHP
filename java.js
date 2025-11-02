document.addEventListener("DOMContentLoaded", () => {
    const buttons = document.querySelectorAll(".choice button");
    const specialBooks = document.querySelectorAll(".create, .update, .delete");
    buttons.forEach(button => {
        button.addEventListener("click", () => {

            specialBooks.forEach(book => book.classList.remove("active"));

            document.querySelector(`.${button.dataset.action}`).classList.add("active");
        });
    });
});
