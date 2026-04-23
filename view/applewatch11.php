<?php
// view/applewatch11.php
include __DIR__ . '/../view/header.php';
?>
 
 
<!-- apple watch video -->
<section class="hero-series11">
    <video autoplay muted playsinline class="hero-video-series11">
        <source src="/assets/vid/applewatchseries11.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- TEXT OVER VIDEO -->
    <div class="hero-text-series11 scroll-animate">
        <h1>Apple Watch Series 11</h1>
        <p>The ultimate way to watch your health.</p>
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