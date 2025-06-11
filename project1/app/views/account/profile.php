<!-- Hồ sơ người dùng giao diện đẹp tối màu -->
<div class="profile-wrapper">
    <div class="profile-card">
        <h2 class="profile-title">Thông tin cá nhân</h2>

        <div class="profile-avatar-section">
            <img src="/project1/<?= $account->avatar ?>" alt="Avatar" class="profile-avatar">
            <div class="profile-avatar-buttons">
                <label class="btn-upload">
                    Đổi hình đại diện
                    <input type="file" name="avatar" hidden>
                </label>
            </div>
        </div>

        <form action="/project1/account/updateProfile" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Tên đăng nhập</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($account->username) ?>" readonly>
            </div>

            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($account->phone) ?>">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($account->email) ?>">
            </div>

            <button type="submit" class="btn-save">Lưu thay đổi</button>
        </form>
    </div>
</div>

<!-- CSS cho giao diện hiện đại giống ảnh 2 -->
<style>
    body {
        background-color: #f2f4f8;
        font-family: 'Segoe UI', sans-serif;
        color: #fff;
        margin: 0;
        padding: 0;
    }

    .profile-wrapper {
        display: flex;
        justify-content: center;
        padding: 40px 16px;
    }

    .profile-card {
        background-color: #1a1b21;
        border-radius: 12px;
        padding: 30px;
        max-width: 500px;
        width: 100%;
        box-shadow: 0 0 20px rgba(0,0,0,0.4);
    }

    .profile-title {
        font-size: 20px;
        margin-bottom: 24px;
        border-bottom: 1px solid #2e2e3b;
        padding-bottom: 10px;
        text-align: center;
    }

    .profile-avatar-section {
        text-align: center;
        margin-bottom: 25px;
    }

    .profile-avatar {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #4b4b63;
        box-shadow: 0 0 8px rgba(255, 255, 255, 0.1);
    }

    .profile-avatar-buttons {
        margin-top: 12px;
    }

    .btn-upload {
        background-color: #34364a;
        color: #fff;
        padding: 6px 14px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 14px;
        display: inline-block;
        transition: background 0.3s;
    }

    .btn-upload:hover {
        background-color: #4d5066;
    }

    .form-group {
        margin-bottom: 18px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        color: #aaa;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: none;
        background-color: #2a2b3a;
        color: #fff;
        font-size: 14px;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: 2px solid #4f5bd5;
    }

    .btn-save {
        background-color: #3b82f6;
        border: none;
        padding: 12px;
        border-radius: 8px;
        width: 100%;
        color: white;
        font-weight: bold;
        cursor: pointer;
        font-size: 15px;
        transition: background 0.3s;
    }

    .btn-save:hover {
        background-color: #2563eb;
    }
</style>
