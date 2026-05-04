<?php
// view/iphone.php
// Expects $products from IphoneController
include __DIR__ . '/../view/header.php';
?>

<h1>Macbooks</h1>
<h3>Browse our latest Macbooks</h3>
<!-- PRODUCTS SECTION -->
<section class="product-section">
    <h2>Macbook</h2>

    <div class="product-grid">
        <?php if (empty($products)): ?>
            <p>No Iphone 17 available</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <?php $stock = (int)$product->getStockLevels(); ?>
                <article class="product-card"
                    data-name="<?= htmlspecialchars($product->productName); ?>"
                    data-price="$<?= number_format($product->getPrice(), 2); ?>"
                    data-image="/assets/img/<?= htmlspecialchars($product->getProductImage()); ?>"
                    data-desc="<?= htmlspecialchars($product->productDescription); ?>">

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

                        <p class="product-stock <?=
                            $stock < 10 ? 'stock-red' :
                            ($stock < 25 ? 'stock-orange' : '');
                        ?>">
                            <?php if ($stock <= 0): ?>
                                OUT OF STOCK
                            <?php elseif ($stock < 25): ?>
                                LOW STOCK: <?= $stock; ?>
                            <?php else: ?>
                                Stock: <?= $stock; ?>
                            <?php endif; ?>
                    </div>

                </article>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>

<!-- POPUP MODAL -->
<div id="productModal" class="modal">
    <div class="modal-content">

        <span class="close">&times;</span>

        <div class="modal-layout">

            <div class="modal-left">
                <img id="modalImage" src="" alt="" class="modal-img">
            </div>

            <div class="modal-right">
                <h2 id="modalTitle"></h2>
                <p id="modalDesc"></p>
                <span id="modalPrice"></span>
                <p id="modalStock"></p>
                <button class="buy-btn">Buy Now</button>
            </div>

        </div>
    </div>
</div>

<!-- JS -->
<script>
const modal = document.getElementById("productModal");
const modalTitle = document.getElementById("modalTitle");
const modalDesc = document.getElementById("modalDesc");
const modalPrice = document.getElementById("modalPrice");
const modalImage = document.getElementById("modalImage");
const closeBtn = document.querySelector(".close");

document.querySelectorAll(".product-card").forEach(card => {
    card.addEventListener("click", () => {

        modalTitle.textContent = card.dataset.name;
        modalDesc.textContent = card.dataset.desc; 
        modalPrice.textContent = card.dataset.price;
        modalImage.src = card.dataset.image;

        modal.style.display = "flex";
    });
});

closeBtn.onclick = () => modal.style.display = "none";

window.onclick = (e) => {
    if (e.target === modal) modal.style.display = "none";
};
</script>

<?php
include __DIR__ . '/../view/footer.php';
?>