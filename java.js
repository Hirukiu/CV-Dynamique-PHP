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
const items = document.querySelectorAll('.carousel-item');
const carousel = document.querySelector('.carousel');

carousel.addEventListener('scroll', () => {
  let activeIndex = Math.round(carousel.scrollLeft / carousel.clientWidth);
  items.forEach((item, index) => {
    item.classList.toggle('active', index === activeIndex);
  });
});
