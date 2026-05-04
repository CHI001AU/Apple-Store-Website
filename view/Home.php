<?php
// view/home.php
include __DIR__ . '/../view/header.php';


$randomProducts = $products ?? [];
shuffle($randomProducts);
$randomProducts = array_slice($randomProducts, 0, 4);
?>

<h3>Check out some of our latest products!</h3>



<!-- PRODUCTS SECTION -->
<section class="product-section">
    <h2>Featured Products</h2>
    <div class="product-grid">
        <?php if (empty($products)): ?>
            <p>No Iphone 17 available</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <?php $stock = (int)$product->getStockLevels(); ?>

                <article class="product-card <?= $stock <= 0 ? 'out-of-stock' : ''; ?>"
                    data-name="<?= htmlspecialchars($product->productName); ?>"
                    data-price="$<?= number_format($product->getPrice(), 2); ?>"
                    data-image="/assets/img/<?= htmlspecialchars($product->getProductImage()); ?>"
                    data-desc="<?= htmlspecialchars($product->productDescription); ?>"
                    data-stock="<?= $stock; ?>">

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
                <p id="modalStock" class="product-stock"></p>
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
const modalStock = document.getElementById("modalStock");
const closeBtn = document.querySelector(".close");

document.querySelectorAll(".product-card").forEach(card => {
    const stock = parseInt(card.dataset.stock);

    if (stock > 0) {
        card.addEventListener("click", () => {
            modalTitle.textContent = card.dataset.name;
            modalDesc.textContent = card.dataset.desc; 
            modalPrice.textContent = card.dataset.price;
            modalImage.src = card.dataset.image;
            modalStock.classList.remove("stock-red", "stock-orange");
            if (stock <= 0) {
                modalStock.textContent = "OUT OF STOCK";

            } else if (stock < 10) {
                modalStock.textContent = "LOW STOCK: " + stock;
                modalStock.classList.add("stock-red");

            } else if (stock < 25) {
                modalStock.textContent = "LOW STOCK: " + stock;
                modalStock.classList.add("stock-orange");

            } else {
                modalStock.textContent = "Stock: " + stock;
            }
            modal.style.display = "flex";
        });
    }
});

closeBtn.onclick = () => modal.style.display = "none";

window.onclick = (e) => {
    if (e.target === modal) modal.style.display = "none";
};
</script>

<!-- SOUND CARD -->
<div class="sound-card" style="width: 250px; cursor: pointer;">
    <img src="assets/img/iphonesound.png"
        alt="Play Music"
        style="width: 100%; border-radius: px;"
        onclick="toggleAudio()">

    <audio id="iphonesounds">
        <source src="assets/aud/iphonesounds.mp3" type="audio/mp3">
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
<?php
include __DIR__ . '/../view/footer.php';
?>