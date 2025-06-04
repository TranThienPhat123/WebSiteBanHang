<?php include 'app/views/shares/header.php'; ?>

<h1>Danh sách sản phẩm</h1>
<a href="/project1/Product/add" class="btn btn-success mb-2">Thêm sản phẩm mới</a>
<a href="/project1/Product/cart" class="btn btn-primary mb-2 float-end">Xem giỏ hàng</a>

<ul class="list-group">
    <?php foreach ($products as $product): ?>
        <li class="list-group-item">
            <h2>
                <a href="/project1/Product/show/<?php echo $product->id; ?>">
                    <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </h2>

            <?php
                // Tách chuỗi ảnh bởi dấu phẩy
                $imageList = !empty($product->image)
                    ? explode(',', $product->image)
                    : ['laptopasus.png'];
            ?>

            <div style="margin-bottom: 10px;">
                <?php foreach ($imageList as $img): ?>
                    <?php
                        $img = trim($img);
                        $imgSrc = (preg_match('/^https?:\/\//', $img))
                            ? $img
                            : '/project1/uploads/' . $img;
                    ?>
                    <?php if (!empty($img)): ?>
                        <img src="<?php echo htmlspecialchars($imgSrc, ENT_QUOTES, 'UTF-8'); ?>"
                             alt="product image"
                             style="max-width: 100px; margin-right: 5px; border: 1px solid #ddd;">
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>

            <p><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Giá: <?php echo number_format($product->price, 0, ',', '.'); ?>₫</p>
            <p><strong>Danh mục:</strong> <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>

            <a href="/project1/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning">Sửa</a>
            <a href="/project1/Product/delete/<?php echo $product->id; ?>"
               class="btn btn-danger"
               onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">Xóa</a>

            <!-- Nút thêm vào giỏ -->
            <form action="/project1/Product/addToCart" method="post" class="mt-2 d-inline-block">
                <input type="hidden" name="product_id" value="<?php echo $product->id; ?>">
                <input type="hidden" name="name" value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="price" value="<?php echo $product->price; ?>">
                <input type="hidden" name="image" value="<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn btn-success">Thêm vào giỏ</button>
            </form>
        </li>
    <?php endforeach; ?>
</ul>

<?php include 'app/views/shares/footer.php'; ?>
