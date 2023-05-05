let userBox = document.querySelector('.header .header-2 .user-box');

document.querySelector('#user-btn').onclick = () => {
  userBox.classList.toggle('active');
  navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .header-2 .navbar');

document.querySelector('#menu-btn').onclick = () => {
  navbar.classList.toggle('active');
  userBox.classList.remove('active');
}

window.onscroll = () => {
  userBox.classList.remove('active');
  navbar.classList.remove('active');

  if (window.scrollY > 60) {
    document.querySelector('.header .header-2').classList.add('active');
  } else {
    document.querySelector('.header .header-2').classList.remove('active');
  }
}

var swiper = new Swiper(".books-slider", {
  loop:true,
  centeredSlides: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});

var swiper = new Swiper(".products-slider", {
  watchSlidesProgress: true,
  slidesPerView: 3,
});


// Redirect to home page after 3 seconds
setTimeout(function(){
  window.location.href = "home.html";
}, 3000);
