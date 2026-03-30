<?php
// view/iphone.php
// Expects $products from IphoneController
include __DIR__ . '/../view/header.php';
?>

<h1>iPhones</h1>
<h3>Browse our Apple iPhone collection</h3>

<section class="product-grid">

<?php if (empty($products)): ?>
    <p>No iPhones available.</p>

<?php else: ?>
    <?php foreach ($products as $product): ?>

        <article class="product-card">

            <img src="/assets/img/<?= htmlspecialchars($product->getProductImage()); ?>"
                 alt="<?= htmlspecialchars($product->productName); ?>"
                 class="product-poster">

            <div class="product-body">

                <h2 class="product-title">
                    <?= htmlspecialchars($product->productName); ?>
                </h2>

                <p class="product-desc">
                    <?= htmlspecialchars($product->productDescription); ?>
                </p>

                <div class="product-meta">

                    <span class="product-price">
                        Price: $<?= number_format($product->getPrice(), 2); ?>
                    </span>

                    <span class="product-id">
                        Stock: <?= (int)$product->getStockLevels(); ?>
                    </span>

                </div>

            </div>

        </article>

    <?php endforeach; ?>
<?php endif; ?>

</section>

<?php
include __DIR__ . '/../view/footer.php';
?>