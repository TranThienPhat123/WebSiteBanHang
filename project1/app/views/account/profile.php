<div class="container mt-5" style="max-width: 600px;">
    <div class="card shadow p-4">
        <h3 class="card-title text-center mb-4">Thông tin tài khoản</h3>
        <form action="/project1/account/updateProfile" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($account->username) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Số điện thoại:</label>
                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($account->phone) ?>">
            </div>
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($account->email) ?>">
            </div>
            <div class="form-group">
                <label>Ảnh đại diện hiện tại:</label><br>
                <?php if (!empty($account->avatar)): ?>
                    <img src="/project1/<?= $account->avatar ?>" alt="Avatar" style="max-width: 120px; border-radius: 50%;">
                <?php else: ?>
                    <p class="text-muted">Chưa có ảnh đại diện.</p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label>Thay ảnh đại diện mới:</label>
                <input type="file" name="avatar" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-danger btn-block mt-3">Cập nhật</button>
        </form>
    </div>
</div>