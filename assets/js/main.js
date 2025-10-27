// Interactive features for LT Software site
document.addEventListener('DOMContentLoaded', function () {
  console.log('LT Software interactive loaded');

  // IntersectionObserver for fade-up animations and lazy loading images
  const io = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('in-view');
        if (e.target.tagName === 'IMG' && e.target.dataset && e.target.dataset.src) {
          e.target.src = e.target.dataset.src;
          e.target.removeAttribute('data-src');
        }
        io.unobserve(e.target);
      }
    });
  }, { threshold: 0.12 });

  document.querySelectorAll('.fade-up').forEach(el => io.observe(el));
  document.querySelectorAll('img[data-src]').forEach(img => io.observe(img));

  // Testimonials simple carousel
  (function testimonialsCarousel(){
    const slides = Array.from(document.querySelectorAll('.testimonials .slide'));
    if (!slides.length) return;
    let idx = 0;
    function show(i){ slides.forEach((s, j)=> s.classList.toggle('active', i===j)); }
    show(idx);
    setInterval(()=>{ idx = (idx+1)%slides.length; show(idx); }, 5000);
  })();

  // Product modal: fill and open modal when clicking .product-learn
  const modalEl = document.getElementById('productModal');
  if (modalEl) {
    const modalTitle = modalEl.querySelector('.modal-title');
    const modalBody = modalEl.querySelector('.modal-body');
    document.querySelectorAll('[data-product]').forEach(btn => {
      btn.addEventListener('click', function(e){
        e.preventDefault();
        const id = this.dataset.product;
        const title = this.dataset.title || 'Product';
        const desc = this.dataset.desc || '';
        modalTitle.textContent = title;
        modalBody.innerHTML = '<p>' + desc + '</p>';
        const bsModal = new bootstrap.Modal(modalEl);
        bsModal.show();
      });
    });
  }

  // Back to top
  const back = document.getElementById('back-to-top');
  if (back) {
    const toggle = () => back.style.display = (window.scrollY > 300) ? 'block' : 'none';
    toggle(); window.addEventListener('scroll', toggle);
    back.addEventListener('click', () => window.scrollTo({top:0, behavior:'smooth'}));
  }
});
