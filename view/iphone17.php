<?php
// view/iphone.php
include __DIR__ . '/../view/header.php';
?>

<!-- iphone video -->
<section class="iphone-hero">
    <video autoplay muted playsinline class="iphone-video">
        <source src="assets/vid/iphone17.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</section>

<!-- PRODUCTS SECTION -->
<section class="product-section">
    <h2>Iphone 17</h2>

    <div class="product-grid">
        <?php if (empty($products)): ?>
            <p>No Iphone 17 available</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <?php $stock = (int)$product->getStockLevels(); ?>
                <article class="product-card"
                    data-name="<?= htmlspecialchars($product->productName); ?>"
                    data-price="$<?= number_format($product->getPrice(), 2); ?>"
                    data-image="assets/img/<?= htmlspecialchars($product->getProductImage()); ?>"
                    data-customdesc="This is a premium iPhone 17 with upgraded AI camera, longer battery life, and pro-level performance.">

                    <img src="assets/img/<?= htmlspecialchars($product->getProductImage()); ?>"
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
                                STOCK: <?= $stock; ?>
                            </p>

                            <?php if ($stock <= 0): ?>
                                <p class="stock-warning">OUT OF STOCK</p>
                            <?php elseif ($stock <= 3): ?>
                                <p class="stock-warning low-stock">LOW STOCK</p>
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
        modalDesc.textContent = card.dataset.customdesc; 
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