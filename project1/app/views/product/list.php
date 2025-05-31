<?php include 'app/views/shares/header.php'; ?>

<h1>Danh sách sản phẩm</h1>
<a href="/project1/Product/add" class="btn btn-success mb-2">Thêm sản phẩm mới</a>

<ul class="list-group">
    <?php foreach ($products as $product): ?>
        <li class="list-group-item">
            <h2>
                <a href="/project1/Product/show/<?php echo $product->id; ?>">
                    <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </h2>

            <?php
    // Nếu có ảnh: tách chuỗi ảnh bởi dấu phẩy
    $imageList = !empty($product->image)
        ? explode(',', $product->image)
        : ['laptopvictus.png'];
?>

<div style="margin-bottom: 10px;">
    <?php foreach ($imageList as $img): ?>
        <?php $img = trim($img); ?>
        <?php if (!empty($img)): ?>
            <img src="/project1/uploads/<?php echo htmlspecialchars($img, ENT_QUOTES, 'UTF-8'); ?>"
                 alt="laptopasus.png"
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
        </li>
    <?php endforeach; ?>
</ul>

<?php include 'app/views/shares/footer.php'; ?>
