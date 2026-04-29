<?php
// view/home.php
include __DIR__ . '/../view/header.php';


$randomProducts = $products ?? [];
shuffle($randomProducts);
$randomProducts = array_slice($randomProducts, 0, 4);
?>

<h3>Check out some of our latest products!</h3>

<!-- SOUND CARD -->
<div class="sound-card" style="width: 250px; cursor: pointer;">
    <img src="assets/img/iphonesound.png"
        alt="Play Music"
        style="width: 100%; border-radius: 8px;"
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

<!-- PRODUCT GRID -->
<section class="product-grid">

    <?php if (empty($randomProducts)): ?>
        <p>No products available.</p>
    <?php else: ?>
        <?php foreach ($randomProducts as $product): ?>
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
                </div>
            </article>
        <?php endforeach; ?>
    <?php endif; ?>

</section>

<!-- MODAL POPUP -->
<div id="productModal" class="modal">
    <div class="modal-content">

        <span class="close">&times;</span>

        <div class="modal-layout">

            <div class="modal-left">
                <img id="modalImage" src="" class="modal-img">
            </div>

            <div class="modal-right">
                <h2 id="modalTitle"></h2>
                <p id="modalDesc"></p>
                <span id="modalPrice"></span>

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

function closeModal() {
    modal.style.display = "none";
}

closeBtn.onclick = closeModal;

window.onclick = (e) => {
    if (e.target === modal) closeModal();
};
</script>

<?php
include __DIR__ . '/../view/footer.php';
?>