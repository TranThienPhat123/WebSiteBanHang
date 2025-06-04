<?php include 'app/views/shares/header.php'; ?>

<h1>Giỏ hàng</h1>

<?php if (!empty($cart)): ?>
    <ul class="list-group">
    <?php foreach ($_SESSION['cart'] as $item): ?>
    <?php
        $img = $item['image'] ?? 'default.png';
        $imgSrc = preg_match('/^https?:\/\//', $img)
            ? $img
            : '/project1/uploads/' . $img;
    ?>
    <li class="list-group-item d-flex align-items-center">
        <img src="<?php echo htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8'); ?>"
             alt="Ảnh sản phẩm"
             style="max-width: 80px; margin-right: 10px; border: 1px solid #ccc;">
        <div>
            <strong><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></strong><br>
            Giá: <?php echo number_format($item['price'], 0, ',', '.'); ?>₫ <br>
            Số lượng: <?php echo $item['quantity']; ?>
        </div>
    </li>
<?php endforeach; ?>

    </ul>
<?php else: ?>
    <p>Giỏ hàng của bạn đang trống.</p>
<?php endif; ?>

<a href="/project1/Product" class="btn btn-secondary mt-2">Tiếp tục mua sắm</a>
<a href="/project1/Product/checkout" class="btn btn-secondary mt-2">Thanh Toán</a>

<?php include 'app/views/shares/footer.php'; ?>
