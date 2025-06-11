<?php include 'app/views/shares/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">🧾 Thanh toán đơn hàng</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="/project1/Product/processCheckout">
                        <div class="form-group">
                            <label for="name">👤 Họ tên:</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">📞 Số điện thoại:</label>
                            <input type="text" id="phone" name="phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address">🏠 Địa chỉ:</label>
                            <textarea id="address" name="address" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-block">💳 Thanh toán</button>
                    </form>
                    <a href="/project1/Product/cart" class="btn btn-link d-block text-center mt-3">← Quay lại giỏ hàng</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'app/views/shares/footer.php'; ?>
