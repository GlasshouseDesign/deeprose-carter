/* Deeprose & Carter: site interactions */
(function () {
  var doc = document.documentElement;
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  doc.classList.add('js');

  /* Header shrinks once the page is scrolled */
  var header = document.querySelector('.top');
  function onScroll() { header.classList.toggle('scrolled', window.scrollY > 60); }
  window.addEventListener('scroll', onScroll, { passive: true });
  onScroll();

  /* Mobile menu */
  var toggle = document.querySelector('.menu-toggle');
  var menu = document.getElementById('mnav');
  if (!toggle || !menu || !header) return;
  function setMenu(open) {
    toggle.setAttribute('aria-expanded', String(open));
    document.body.classList.toggle('menu-open', open);
    if (open) {
      menu.hidden = false;
      requestAnimationFrame(function () { menu.classList.add('open'); });
      menu.querySelector('a').focus();
    } else {
      menu.classList.remove('open');
      setTimeout(function () { if (!menu.classList.contains('open')) menu.hidden = true; }, 350);
    }
  }
  toggle.addEventListener('click', function () { setMenu(toggle.getAttribute('aria-expanded') !== 'true'); });
  menu.addEventListener('click', function (e) { if (e.target.closest('a')) setMenu(false); });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape' && toggle.getAttribute('aria-expanded') === 'true') { setMenu(false); toggle.focus(); }
  });
  window.addEventListener('resize', function () {
    if (window.innerWidth > 1100 && toggle.getAttribute('aria-expanded') === 'true') setMenu(false);
  });

  /* "Watch our story" opens the brand film */
  var box = document.getElementById('filmbox');
  var film = box.querySelector('video');
  document.querySelectorAll('[data-film]').forEach(function (btn) {
    btn.addEventListener('click', function () {
      if (btn.dataset.film && film.getAttribute('src') !== btn.dataset.film) film.src = btn.dataset.film;
      box.showModal();
      film.currentTime = 0;
      var p = film.play();
      if (p && p.catch) p.catch(function () {});
    });
  });
  box.querySelector('.filmclose').addEventListener('click', function () { box.close(); });
  box.addEventListener('click', function (e) { if (e.target === box) box.close(); });
  box.addEventListener('close', function () { film.pause(); });

  /* Photo gallery lightbox */
  document.querySelectorAll('[data-lightbox]').forEach(function (gal) {
    var items = Array.prototype.slice.call(gal.querySelectorAll('a'));
    if (!items.length) return;
    var lb = document.createElement('dialog');
    lb.className = 'lightbox';
    lb.setAttribute('aria-label', 'Photo viewer');
    lb.innerHTML = '<figure><img alt=""><figcaption></figcaption></figure><span class="lb-count"></span>' +
      '<button class="lb-btn lb-close" type="button" aria-label="Close">&times;</button>' +
      '<button class="lb-btn lb-prev" type="button" aria-label="Previous photo">&#8249;</button>' +
      '<button class="lb-btn lb-next" type="button" aria-label="Next photo">&#8250;</button>';
    document.body.appendChild(lb);
    var img = lb.querySelector('img'), cap = lb.querySelector('figcaption'), count = lb.querySelector('.lb-count'), idx = 0;
    function show(i) {
      idx = (i + items.length) % items.length;
      var a = items[idx];
      img.src = a.href;
      img.alt = (a.querySelector('img') || {}).alt || '';
      cap.textContent = a.dataset.caption || '';
      count.textContent = (idx + 1) + ' / ' + items.length;
    }
    items.forEach(function (a, i) {
      a.addEventListener('click', function (e) { e.preventDefault(); show(i); lb.showModal(); });
    });
    lb.querySelector('.lb-close').addEventListener('click', function () { lb.close(); });
    lb.querySelector('.lb-prev').addEventListener('click', function () { show(idx - 1); });
    lb.querySelector('.lb-next').addEventListener('click', function () { show(idx + 1); });
    lb.addEventListener('click', function (e) { if (e.target === lb || e.target.tagName === 'FIGURE') lb.close(); });
    lb.addEventListener('keydown', function (e) {
      if (e.key === 'ArrowLeft') show(idx - 1);
      if (e.key === 'ArrowRight') show(idx + 1);
    });
  });

  /* Hero card entrance */
  var card = document.querySelector('.card');
  if (card && !reduceMotion) card.classList.add('intro-anim');

  /* Placeholder link for pages that don't exist yet */
  document.querySelectorAll('a[href="#blog"]').forEach(function (a) {
    a.addEventListener('click', function (e) { e.preventDefault(); a.blur(); });
  });

  /* Quote form: list chosen files, and stop double submits */
  document.querySelectorAll('.cf-drop input[type=file]').forEach(function (input) {
    var out = input.parentNode.querySelector('.cf-drop-files');
    input.addEventListener('change', function () {
      out.textContent = Array.prototype.map.call(input.files, function (f) { return f.name; }).join(', ');
    });
  });
  document.querySelectorAll('form.cf').forEach(function (form) {
    form.addEventListener('submit', function () {
      var btn = form.querySelector('.cf-submit');
      btn.disabled = true;
      btn.textContent = 'Sending…';
    });
  });
  var done = document.getElementById('enquiry-sent');
  if (done) done.focus({ preventScroll: true });

  if (reduceMotion || !('IntersectionObserver' in window)) return;

  /* Scroll reveals: text fades up, photos wipe in, siblings stagger */
  var groups = [
    ['.eyebrow, h2, .lede, .pull, .who, .story p, .stats > div, .people > div', 'reveal'],
    ['.tile, .step, .review, .chips span, details, .btnrow, .cta-band .ctas, .sd-card, .option, .ticks li, .cp-details dl > div', 'reveal'],
    ['.proj, .dgrid figure, .photo, .pg-item, .option .ph, .cp-img', 'reveal-img']
  ];
  var targets = [];
  groups.forEach(function (g) {
    document.querySelectorAll('main section.pad ' + g[0].split(', ').join(', main section.pad ')).forEach(function (el) {
      if (el.closest('.card')) return;
      el.classList.add(g[1]);
      var sibs = Array.prototype.filter.call(el.parentNode.children, function (c) { return c.classList.contains(g[1]); });
      el.style.setProperty('--d', Math.min(sibs.indexOf(el), 7) * 0.08 + 's');
      targets.push(el);
    });
  });
  var io = new IntersectionObserver(function (entries) {
    entries.forEach(function (en) {
      if (!en.isIntersecting) return;
      en.target.classList.add('in');
      io.unobserve(en.target);
    });
  }, { rootMargin: '0px 0px -8% 0px', threshold: 0.12 });
  targets.forEach(function (el) { io.observe(el); });

  /* Stats count up when they come into view (numbers only; placeholders stay as written) */
  var counters = document.querySelectorAll('[data-count]');
  var cio = new IntersectionObserver(function (entries) {
    entries.forEach(function (en) {
      if (!en.isIntersecting) return;
      var el = en.target, end = parseFloat(el.dataset.count), suffix = el.dataset.suffix || '', t0 = null;
      function step(t) {
        if (!t0) t0 = t;
        var k = Math.min((t - t0) / 1200, 1), eased = 1 - Math.pow(1 - k, 3);
        el.textContent = Math.round(end * eased) + suffix;
        if (k < 1) requestAnimationFrame(step);
      }
      requestAnimationFrame(step);
      cio.unobserve(el);
    });
  }, { threshold: 0.6 });
  counters.forEach(function (el) { cio.observe(el); });
})();
