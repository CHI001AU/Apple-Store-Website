<?php
// view/iphone.php
include __DIR__ . '/../view/header.php';
?>

<!-- Colors for the iphone 17 pro page  -->
<body style="background-color: Black;">
<body class="iphone-17-pro">
<!-- Welcome image -->
 <section class="hero-media" >
    <img src="assets/img/iphone17prowelcome.png" alt="iPhone 17 Details" class="hero-media"> 
</section>

<!-- Video -->
<section class="iphone17pro-hero">
    <video autoplay muted playsinline class="iphone-video">
        <source src="/assets/vid/iphone17pro.mp4" type="video/mp4">
    </video>
<!-- Iphone details -->
    <!-- <img src="/assets/img/iphone17procolors.png" alt="iPhone 17 Details" class="hero-media">
</section> -->


<!-- <section 
<div class="fade in section">
    <p> Scroll down to see affect </p>
    </div> -->

   

<!-- PRODUCTS SECTION BELOW VIDEO -->
<section class="product-section">
    <h2>Iphone 17</h2>

    <div class="product-grid">
        <?php if (empty($products)): ?>
            <p>No Iphone 17 avalible </p>
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