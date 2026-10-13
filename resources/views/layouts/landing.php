<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($title ?? 'SIM DOSEN - Universitas Muhammadiyah Bengkulu') ?></title>
  <meta name="description" content="Sistem Informasi Manajemen Dosen (SIM DOSEN) Universitas Muhammadiyah Bengkulu. Portal tridharma perguruan tinggi, bimbingan mahasiswa, dan rekam kinerja dosen terpadu.">
  <link rel="stylesheet" href="<?= asset('css/app.css') ?>?v=<?= time() ?>">
  <link rel="icon" type="image/png" href="<?= asset('logoumb.png') ?>" onerror="this.href='<?= base_url('../assets/logoumb.png') ?>'">
  <script>
    window.BASE_URL = "<?= rtrim(base_url(), '/') ?>";
  </script>
</head>
<body class="landing-body">

  <!-- NAVBAR COMPONENT REUSABLE -->
  <?php partial('navbar'); ?>

  <!-- MAIN LANDING CONTENT -->
  <main class="landing-main-content">
    <?= $content ?>
  </main>

  <!-- FOOTER COMPONENT REUSABLE -->
  <?php partial('footer'); ?>

  <!-- SCRIPT LANDING INTERAKTIF -->
  <script>
    (function() {
      // 1. Mobile Menu Toggle
      const toggleBtn = document.getElementById('landingMobileToggle');
      const mobileMenu = document.getElementById('landingMobileMenu');
      if (toggleBtn && mobileMenu) {
        toggleBtn.addEventListener('click', function() {
          mobileMenu.classList.toggle('is-open');
        });

        // Tutup menu mobile ketika link diklik
        const mobileLinks = mobileMenu.querySelectorAll('.landing-mobile-link');
        mobileLinks.forEach(link => {
          link.addEventListener('click', function() {
            mobileMenu.classList.remove('is-open');
          });
        });

        // Tutup menu mobile ketika klik di luar
        document.addEventListener('click', function(e) {
          if (mobileMenu.classList.contains('is-open') && !mobileMenu.contains(e.target) && !toggleBtn.contains(e.target)) {
            mobileMenu.classList.remove('is-open');
          }
        });
      }

      // 2. Sticky Navbar Shadow Effect on Scroll
      const header = document.getElementById('landingHeader');
      if (header) {
        window.addEventListener('scroll', function() {
          if (window.scrollY > 20) {
            header.classList.add('is-scrolled');
          } else {
            header.classList.remove('is-scrolled');
          }
        });
      }

      // 3. FAQ Accordion Toggle
      const faqItems = document.querySelectorAll('.landing-faq-item');
      faqItems.forEach(item => {
        const questionBtn = item.querySelector('.faq-question-btn');
        if (questionBtn) {
          questionBtn.addEventListener('click', function() {
            const isOpen = item.classList.contains('is-open');
            // Tutup item lain
            faqItems.forEach(other => other.classList.remove('is-open'));
            if (!isOpen) {
              item.classList.add('is-open');
            }
          });
        }
      });

      // 4. Smooth Anchor Scroll
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
          const targetId = this.getAttribute('href');
          if (targetId && targetId !== '#') {
            const targetEl = document.querySelector(targetId);
            if (targetEl) {
              e.preventDefault();
              targetEl.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
              });
            }
          }
        });
      });

      // 5. Developer Showcase Background Slideshow (Assets Person Slideshow)
      const devSlides = document.querySelectorAll('.dev-slide-img');
      const devDots = document.querySelectorAll('.dev-dot-btn');
      if (devSlides.length > 1) {
        let currentSlide = 0;
        function showSlide(index) {
          devSlides.forEach((slide, i) => {
            slide.classList.toggle('is-active', i === index);
          });
          devDots.forEach((dot, i) => {
            dot.classList.toggle('is-active', i === index);
          });
          currentSlide = index;
        }

        let slideInterval = setInterval(function() {
          let next = (currentSlide + 1) % devSlides.length;
          showSlide(next);
        }, 4500);

        devDots.forEach((dot, i) => {
          dot.addEventListener('click', function() {
            clearInterval(slideInterval);
            showSlide(i);
            slideInterval = setInterval(function() {
              let next = (currentSlide + 1) % devSlides.length;
              showSlide(next);
            }, 4500);
          });
        });
      }
    })();
  </script>
  <script src="<?= asset('js/app.js') ?>"></script>
</body>
</html>
