// Mobile nav toggle
const btn = document.getElementById('mobile-menu-btn');
const menu = document.getElementById('mobile-menu');
if(btn){
  btn.addEventListener('click', () => {
    menu.classList.toggle('hidden');
  });
}

// Scroll to top
const topBtn = document.getElementById('scroll-top');
if(topBtn){
  window.addEventListener('scroll', () => {
    topBtn.classList.toggle('opacity-0', window.scrollY < 400);
  });
  topBtn.addEventListener('click', () => window.scrollTo({top:0, behavior:'smooth'}));
}

// Lazy load images (native)
if('loading' in HTMLImageElement.prototype){
  document.querySelectorAll('img[data-src]').forEach(img => {
    img.src = img.dataset.src;
  });
}