// JavaScript Document
const slider = document.querySelector('.slider');
const slidesContainer = document.querySelector('.slides-container');
const slideWidth = slider.offsetWidth;

function handleTransitionEnd() {
  if (slidesContainer.style.transform === `translateX(-200%)`) {
    slidesContainer.style.transition = 'none';
    slidesContainer.style.transform = 'translateX(0)';
    setTimeout(() => {
      slidesContainer.style.transition = '';
    }, 0);
  }
}

slider.addEventListener('transitionend', handleTransitionEnd);

setInterval(() => {
  slidesContainer.style.transform = `translateX(-100%)`;
}, 5000);