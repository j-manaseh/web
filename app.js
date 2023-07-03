const menu = document.querySelector('#menu');
const menuLinks = document.querySelector('.nav_menu');

menu.addEventListener('click', function(){
  menu.classList.toggle('is-active');
  menuLinks.classList.toggle('active');
});


function changeBg() {
  var navbar = document.getElementById('navbar')
  var scrollValue = window.scrollY;
  if(scrollValue < 100) {
    navbar.classList.remove('bgColor');
  } else {
    navbar.classList.add('bgColor');
  }
}

window.addEventListener('scroll', changeBg);



