<?php include 'app/views/shares/header.php'; ?>

<h1 class="text-primary mb-4 text-center">📦 Danh sách sản phẩm</h1>

<style>
    .product-card {
        border: 1px solid #dee2e6;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }

    .product-title {
        color: #007bff;
        font-weight: bold;
    }

    .product-price {
        color: #e74c3c;
        font-weight: bold;
    }

    .product-category {
        font-size: 0.9rem;
        color: #6c757d;
    }

    .product-image-wrapper {
        background: linear-gradient(135deg, #f0f8ff, #e0f7fa);
        padding: 10px;
        border-radius: 8px;
        text-align: center;
        height: 200px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 10px;
    }

    .product-image-wrapper img {
        max-height: 160px;
        object-fit: contain;
    }

    .card-footer a {
        margin-right: 5px;
    }
</style>

<div class="row">
    <?php foreach ($products as $product): ?>
        <div class="col-md-4 mb-4">
            <div class="card product-card h-100">
                <div class="card-body">
                    <h5 class="product-title">
                        <a href="/project1/Product/show/<?php echo $product->id; ?>" class="text-decoration-none">
                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </h5>

                    <?php
                        $imageList = !empty($product->image)
                            ? explode(',', $product->image)
                            : ['laptopasus.png'];
                        $img = trim($imageList[0]);
                        $imgSrc = (preg_match('/^https?:\/\//', $img))
                            ? $img
                            : '/project1/uploads/' . $img;
                    ?>

                    <div class="product-image-wrapper">
                        <img src="<?php echo htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8'); ?>"
                             alt="product image"
                             class="img-fluid">
                    </div>

                    <p class="card-text"><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
                    <p class="product-price">Giá: <?php echo number_format($product->price, 0, ',', '.'); ?>₫</p>
                    <p class="product-category"><strong>Danh mục:</strong> <?= htmlspecialchars($product->category_name ?? 'Laptop', ENT_QUOTES, 'UTF-8') ?></p>
                </div>

                <div class="card-footer bg-light d-flex justify-content-start flex-wrap">
                    <a href="/project1/Product/edit/<?php echo $product->id; ?>" class="btn btn-outline-warning btn-sm mb-1">✏️ Sửa</a>
                    <a href="/project1/Product/delete/<?php echo $product->id; ?>"
                       class="btn btn-outline-danger btn-sm mb-1"
                       onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">🗑️ Xóa</a>
                    <a href="/project1/Product/addToCart/<?php echo $product->id; ?>"
                       class="btn btn-outline-primary btn-sm mb-1">🛒 Thêm vào giỏ</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'app/views/shares/footer.php'; ?>
