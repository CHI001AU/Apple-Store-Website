<?php
// view/iphone.php
include __DIR__ . '/../view/header.php';
?>
 
 
<!-- apple watch video -->
<section class="hero">
    <video autoplay muted playsinline class="hero-video">
        <source src="/assets/vid/applewatchse3.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>

<!-- Text -->

<!-- <section 
<div class="fade in section">
    <p> Scroll down to see affect </p>
    </div> -->

   

<!-- PRODUCTS SECTION BELOW VIDEO -->
<section class="product-section">
    <h2>Explore Apple watch se 3</h2>

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