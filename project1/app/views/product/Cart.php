<?php include 'app/views/shares/header.php'; ?>

<h2 class="text-center text-primary mt-4">Giỏ hàng của bạn</h2>

<?php if (!empty($cart)): ?>
    <ul class="list-group my-4">
        <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $item):
                $img = $item['image'] ?? 'default.png';
                $imgSrc = preg_match('/^https?:\/\//', $img)
                    ? $img
                    : '/project1/uploads/' . $img;

                $itemTotal = $item['price'] * $item['quantity'];
                $total += $itemTotal;
        ?>
            <li class="list-group-item d-flex align-items-center justify-content-between flex-wrap">
                <div class="d-flex align-items-center">
                    <img src="<?php echo htmlspecialchars($imgSrc); ?>"
                        alt="Ảnh sản phẩm"
                        style="max-width: 100px; margin-right: 15px; border: 1px solid #ddd;">
                    <div>
                        <strong class="text-info"><?php echo htmlspecialchars($item['name']); ?></strong><br>
                        <span class="text-dark">Đơn giá: <span class="text-danger fw-bold"><?php echo number_format($item['price'], 0, ',', '.'); ?>₫</span></span><br>

                        <form action="/project1/Product/updateQuantity" method="post" class="d-flex align-items-center mt-2">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>">
                            <button type="submit" name="action" value="decrease" class="btn btn-outline-secondary btn-sm">-</button>
                            <span class="mx-2"><?= $item['quantity'] ?></span>
                            <button type="submit" name="action" value="increase" class="btn btn-outline-secondary btn-sm">+</button>
                        </form>
                    </div>
                </div>
                <div>
                    <span class="fw-bold">Thành tiền:</span> <span class="text-danger"><?php echo number_format($itemTotal, 0, ',', '.'); ?>₫</span>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Hiển thị tổng -->
    <div class="text-end pe-4 mb-3">
        <h5>Tổng tiền: <span class="text-danger"><?php echo number_format($total, 0, ',', '.'); ?>₫</span></h5>
    </div>

<?php else: ?>
    <p class="text-center mt-4">Giỏ hàng của bạn đang trống.</p>
<?php endif; ?>

<!-- Nút điều hướng -->
<div class="text-center mt-4">
    <a href="/project1/Product" class="btn btn-outline-primary me-2">
        🛒 Tiếp tục mua sắm
    </a>
    <a href="/project1/Product/checkout" class="btn btn-success">
        💳 Thanh toán
    </a>
</div>

<?php include 'app/views/shares/footer.php'; ?>
