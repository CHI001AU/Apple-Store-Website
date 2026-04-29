<?php
// view/applewatch11.php
include __DIR__ . '/../view/header.php';
?>
 
<!-- apple watch video -->
<section class="hero-ultra3">
    <video autoplay muted playsinline class="hero-video-ultra3">
        <source src="/assets/vid/ultra3.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

     <!-- TEXT OVER VIDEO -->
        <!-- TEXT OVER VIDEO -->
    <div class="hero-text-ultra3 scroll-animate">
        <img src="assets/img/ultra3logo.png" alt="Ultra 3 Logo">
        <p>Personal beast</p>
    </div>
</section>


   

<!-- PRODUCTS SECTION BELOW VIDEO -->
<section class="product-section">
    <h2></h2>

    <div class="product-grid">
        <?php if (empty($products)): ?>
            <p>No apple watches avalible </p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <article class="product-card">
                    <img src="/assets/img/<?= htmlspecialchars($product->getProductImage()); ?>"
                         alt="<?= htmlspecialchars($product->productName); ?>"
                         class="product-poster">

                    <div class="product-body">
                        <h3 class="product-title">
                            <?= htmlspecialchars($product->productName); ?>
                        </h3>
                        <p class="product-desc">
                            <?= htmlspecialchars($product->productDescription); ?>
                        </p>
                        <span class="product-price">
                            $<?= number_format($product->getPrice(), 2); ?>
                        </span>
                    </div>
                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<?php
include __DIR__ . '/../view/footer.php';
?>