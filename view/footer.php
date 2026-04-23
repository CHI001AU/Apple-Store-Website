</main>
<footer class="site-footer">
    <div class="container">
        <p>&copy; <?php echo date('Y'); ?> Apple  </p>
    </div>
</footer>
<script>
const elements = document.querySelectorAll('.scroll-animate');

function checkScroll() {
    const triggerBottom = window.innerHeight * 0.85;

    elements.forEach(el => {
        const boxTop = el.getBoundingClientRect().top;

        if (boxTop < triggerBottom) {
            el.classList.add('active');
        }
    });
}

window.addEventListener('scroll', checkScroll);
window.addEventListener('load', checkScroll);
</script>
</body>
</html>