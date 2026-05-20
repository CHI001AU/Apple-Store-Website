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
    <video id="scrollVideo" preload="auto" muted playsinline class="iphone-video" width="100%">
        <source src="assets/vid/iphone17pro.mp4" type="video/mp4">
    </video>
</section>
 <!-- Iphone details -->
    <!-- <img src="/assets/img/iphone17procolors.png" alt="iPhone 17 Details" class="hero-media">
</section> -->


<!-- <section 
<div class="fade in section">
    <p> Scroll down to see affect </p>
    </div> -->

   

<!-- PRODUCTS SECTION BELOW VIDEO -->
<section class="product-section">
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

<script>
document.addEventListener('DOMContentLoaded', () => {
    const video = document.getElementById('scrollVideo');
    
    if (!video) {
        console.error("Video element with ID 'scrollVideo' not found.");
        return;
    }

    // Force essential attributes for autoplay via JS
    video.muted = true;
    video.setAttribute('muted', '');
    video.setAttribute('playsinline', '');

    const handlePlay = (entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                // Browsers require a 'Promise' check for .play()
                const playPromise = video.play();
                if (playPromise !== undefined) {
                    playPromise.catch(error => {
                        console.log("Autoplay was prevented. User must interact first.", error);
                    });
                }
            } else {
                video.pause();
            }
        });
    };

    const observer = new IntersectionObserver(handlePlay, { 
        threshold: 0.3 // Trigger when 30% visible
    });

    observer.observe(video);
});
</script>

<?php
include __DIR__ . '/../view/footer.php';
?>
