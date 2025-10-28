/* Lightweight hero animation controller
   - Auto-rotates feature cards
   - Accessible previous/next controls
   - Keeps transitions smooth and subtle to feel like a high-quality hero
*/
(function(){
  const stage = document.getElementById('featureStage');
  if(!stage) return;

  const cards = Array.from(stage.querySelectorAll('.feature-card'));
  const titleEl = document.getElementById('featureTitle');
  const prevBtn = document.getElementById('prevFeature');
  const nextBtn = document.getElementById('nextFeature');
  let idx = 0;
  let timer = null;
  const delay = 4800;

  function show(i){
    cards.forEach((c, j)=>{
      c.classList.toggle('active', j===i);
    });
    const t = cards[i].getAttribute('data-title') || '';
    if(titleEl) titleEl.textContent = t;
    idx = i;
  }

  function next(){ show((idx+1) % cards.length); }
  function prev(){ show((idx-1+cards.length) % cards.length); }

  if(nextBtn) nextBtn.addEventListener('click', ()=>{ next(); restart(); });
  if(prevBtn) prevBtn.addEventListener('click', ()=>{ prev(); restart(); });

  function start(){ timer = setInterval(next, delay); }
  function stop(){ if(timer) clearInterval(timer); timer = null; }
  function restart(){ stop(); start(); }

  // init
  show(0);
  start();

  // Pause on hover to let user interact
  stage.addEventListener('mouseenter', stop);
  stage.addEventListener('mouseleave', start);

  // Respect user motion preference
  const mq = window.matchMedia('(prefers-reduced-motion: reduce)');
  if(mq.matches){ stop(); }
})();
