// k: vanilla js < 5 KB, defer loaded
document.addEventListener('DOMContentLoaded', () => {
  // k: scroll-top visibility
  const top = document.getElementById('scroll-top');
  window.addEventListener('scroll', () => {
    top.classList.toggle('hidden', window.scrollY < 200);
  });
  // k: mobile nav toggle
  const nav = document.getElementById('mobile-nav');
  const btn = document.getElementById('nav-toggle');
  btn?.addEventListener('click', () => nav.classList.toggle('hidden'));
});