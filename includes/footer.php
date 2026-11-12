    <!-- Semantic Brutalist Footer -->
    <footer class="site-footer">
        <p class="copyright">Copyright &copy; Adrian Santiago 2026 All rights Reserved</p>
    </footer>

    <!-- GSAP & ScrollTrigger Core -->
    <script src="<?= $basePath ?? '' ?>assets/js/vendor/gsap.min.js"></script>
    <script src="<?= $basePath ?? '' ?>assets/js/vendor/ScrollTrigger.min.js"></script>
    <script>
        if (typeof gsap === 'undefined') {
            document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"><\/script>');
            document.write('<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"><\/script>');
        }
    </script>

    <!-- Core Interaction Script -->
    <script src="<?= $basePath ?? '' ?>assets/js/main.js"></script>
</body>
</html>
