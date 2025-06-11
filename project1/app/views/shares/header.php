<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Quản lý sản phẩm</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
  <style>
    .product-image {
      max-width: 100px;
      height: auto;
    }

    .navbar-custom {
      background: linear-gradient(to right, #6a11cb, #2575fc);
    }

    .navbar-custom .nav-link,
    .navbar-custom .navbar-brand {
      color: white !important;
      font-weight: 500;
    }

    .navbar-custom .nav-link:hover {
      color: #ffd700 !important;
    }

    .btn-outline-primary {
      color: #2575fc;
      border-color: #2575fc;
      background-color: white;
    }

    .btn-outline-primary:hover {
      background-color: #2575fc;
      color: white;
      border-color: #2575fc;
    }

    .dropdown-toggle::after {
      margin-left: 6px;
    }

    .user-info img {
  width: 28px;       /* nhỏ gọn */
  height: 28px;
  border-radius: 50%;
  object-fit: cover;
  margin-right: 6px;
}

.user-info {
  display: flex;
  align-items: center; /* căn giữa theo chiều dọc */
}

.user-info span {
  color: white;
  font-weight: 500;
}

body {
        background: linear-gradient(to bottom right, #d3e5ff, #f3e8ff);
    }

  </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-custom">
  <a class="navbar-brand" href="#">Quản lý sản phẩm</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <!-- Menu trái -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/project1/Product/">Danh sách sản phẩm</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/project1/Product/add">Thêm sản phẩm</a>
      </li>
    </ul>

    <!-- Menu phải -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="btn btn-outline-primary mr-2 mt-1" href="/project1/Product/cart">🛒 Xem giỏ hàng</a>
      </li>
      <form class="form-inline my-2 my-lg-0" action="/project1/product/search" method="GET">
    <input class="form-control mr-sm-2" type="search" name="keyword" placeholder="Tìm sản phẩm..." aria-label="Search">
    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Tìm</button>
</form>
      <?php if (SessionHelper::isLoggedIn()): ?>
        <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle d-flex align-items-center user-info" href="#" id="userDropdown"
     role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <img src="/project1/<?php echo htmlspecialchars($_SESSION['avatar'] ?? 'assets/default-avatar.png'); ?>" alt="Avatar">
    <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
  </a>
  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
    <a class="dropdown-item" href="/project1/account/profile">Hồ sơ người dùng</a>
    <a class="dropdown-item" href="/project1/account/logout">Logout</a>
  </div>
</li>

      <?php else: ?>
        <li class="nav-item">
          <a class="nav-link" href="/project1/account/login">Login</a>
        </li>
      <?php endif; ?>
    </ul>
  </div>
</nav>

<div class="container mt-4">
  <!-- Nội dung chính -->
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
