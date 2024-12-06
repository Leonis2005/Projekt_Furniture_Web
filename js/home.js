let closer = document.querySelector('#closer');

closer.onclick = () => {
    closer.style.display = 'none';
    navbar.classList.remove('active');
    cart.classList.remove('active');
    loginForm.classList.remove('active')
}

let navbar = document.querySelector('.navbar');

document.querySelector('#menu-btn').onclick = () => {
    closer.style.display = 'block';
    navbar.classList.toggle('active');
    
}

let cart = document.querySelector('.shopping-cart');

document.querySelector('#cart-btn').onclick = () => {
    closer.style.display = 'block';
    cart.classList.toggle('active');

}

let currentIndex = 0;
const slides = document.querySelectorAll('.slider-slide');
const totalSlides = slides.length;

document.querySelector('.next').addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % totalSlides;
    updateSlides();
});

document.querySelector('.prev').addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    updateSlides();
});

function updateSlides() {
    const newTransformValue = `translateX(-${currentIndex * 100}%)`;
    document.querySelector('.slider-wrapper').style.transform = newTransformValue;
}

