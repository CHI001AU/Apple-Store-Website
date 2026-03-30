<?php
// view/home.php
// Expects $products to be provided by the controller
        include __DIR__ . '/../view/header.php';
?>
<h3>Check out some of our latest products!</h3>
<!-- The code below will link the image to the audio and hiding the slider which will play the audio -->

<div class="sound-card" style="width: 250px; cursor: pointer;"> 
    <img src="assets\img\iphonesound.png" 
         alt="Play Music" 
         style="width: 100%; border-radius: 8px;"
         onclick="toggleAudio()">

    <audio id="iphonesounds">
        <source src="assets\aud\iphonesounds.mp3" type="audio/mp3">
    </audio>
</div>

<script>
    function toggleAudio() {
        var audio = document.getElementById("iphonesounds");
        if (audio.paused) {
            audio.play();
        } else {
            audio.pause();
        }
    }
</script>

<section class="product-grid">
    <?php if (empty($products)): ?>
        <p>No products available.</p>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
            <article class="product-card">
                <img src="/assets/img/<?= htmlspecialchars($product->getProductImage()); ?>"
                    alt="<?= htmlspecialchars($product->productName); ?>"
                    class="product-poster">
                <div class="product-body">
                    <h2 class="product-title"><?php echo htmlspecialchars($product->productName); ?></h2>
                    <p class="product-desc"><?php echo htmlspecialchars($product->productDescription); ?></p>
                    <div class="product-meta">
                        <span class="product-price">Price: $<?php echo number_format($product->getPrice(), 2); ?></span>
                        <span class="product-id">Stock: <?php echo (int)$product->getStockLevels(); ?></span>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>
</section>

<?php
        include __DIR__ . '/../view/footer.php';
?>