<?php

require_once('app/config/database.php');
require_once('app/models/ProductModel.php');
require_once('app/models/CategoryModel.php');


class ProductController
{
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
    }

    public function index()
    {
        $products = $this->productModel->getProducts();
        include 'app/views/product/list.php';
    }

    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include 'app/views/product/show.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }

    public function add()
    {
        $categories = (new CategoryModel($this->db))->getCategories();
        include_once 'app/views/product/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'] ?? '';
            $description = $_POST['description'] ?? '';
            $price = $_POST['price'] ?? '';
            $category_id = $_POST['category_id'] ?? null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {                 
                $image = $this->uploadImage($_FILES['image']);             
            } else {
                $image = "";
            }

            $result = $this->productModel->addProduct($name, $description, $price, $category_id, $image);
            
            if (is_array($result)) {
                $errors = $result;
                $categories = (new CategoryModel($this->db))->getCategories();
                include 'app/views/product/add.php';
            } else {
                header('Location: /project1/Product');
            }
        }
    }
    public function edit($id)
    {
        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getCategories();
        
        if ($product) {
            include 'app/views/product/edit.php';
        } else {
            echo "Không thấy sản phẩm.";
        }
    }
    public function update()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy dữ liệu từ form
        $id = $_POST['id'] ?? null;
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? 0;
        $category_id = $_POST['category_id'] ?? 0;
        $image = $_POST['existing_image'] ?? '';

        // Kiểm tra xem có ảnh mới được tải lên hay không
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadedImage = $this->uploadImage($_FILES['image']);

            if ($uploadedImage !== false) {
                $image = $uploadedImage;
            }
            // Nếu upload thất bại thì vẫn giữ nguyên ảnh cũ
        }

        // Cập nhật sản phẩm vào cơ sở dữ liệu
        $result = $this->productModel->updateProduct($id, $name, $description, $price, $category_id, $image);

        if ($result) {
            header('Location: /project1/Product');
            exit;
        } else {
            echo "Có lỗi xảy ra khi cập nhật sản phẩm.";
        }
    }
}



    public function delete($id)
    {
        if ($this->productModel->deleteProduct($id)) {
            header('Location: /project1/Product');
        } else {
            echo "Đã xảy ra lỗi khi xóa sản phẩm.";
        }
    }
    private function uploadImage($file)
{
    $target_dir = "uploads/";

    // Kiểm tra và tạo thư mục nếu chưa tồn tại
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Lấy tên file an toàn (loại bỏ ký tự đặc biệt)
    $filename = basename($file["name"]);
    $filename = preg_replace("/[^a-zA-Z0-9\._-]/", "_", $filename);

    $target_file = $target_dir . $filename;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra file có phải hình ảnh không
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        throw new Exception("File không phải là hình ảnh.");
    }

    // Kiểm tra dung lượng ảnh
    if ($file["size"] > 10 * 1024 * 1024) {
        throw new Exception("Hình ảnh có kích thước quá lớn.");
    }

    // Kiểm tra định dạng
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedTypes)) {
        throw new Exception("Chỉ cho phép định dạng JPG, JPEG, PNG, GIF.");
    }

    // Di chuyển file vào thư mục uploads/
    if (!move_uploaded_file($file["tmp_name"], $target_file)) {
        throw new Exception("Có lỗi khi tải ảnh lên.");
    }

    // ✅ Trả về tên file ảnh để lưu vào DB (KHÔNG trả về đường dẫn đầy đủ)
    return $filename;
}

public function search() {
    $keyword = $_GET['keyword'] ?? '';

    // Gọi model để tìm kiếm
    $products = $this->productModel->searchByKeyword($keyword);

    // Truyền kết quả sang view
    include 'app/views/product/list.php';
}

public function addToCart($id) {
    $product = $this->productModel->getProDuctById($id); // Lấy thông tin mới nhất từ DB

    // Lấy ảnh đầu tiên từ danh sách (nếu có nhiều ảnh cách nhau bằng dấu phẩy)
    $imageList = !empty($product->image)
        ? explode(',', $product->image)
        : ['default.png'];

    $image = trim($imageList[0]);

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] += 1;
        $_SESSION['cart'][$id]['image'] = $image; // Cập nhật ảnh nếu đã sửa
    } else {
        $_SESSION['cart'][$id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'image' => $image
        ];
    }

    header("Location: /project1/Product/cart");
    exit;
}

    public function cart()     
    {         
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];         
        include 'app/views/product/Cart.php';     
    }      
    public function checkout()     
    {         
        include 'app/views/product/Checkout.php';     
    
    }
    public function processCheckout()
    {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        // Kiểm tra giỏ hàng
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo "Giỏ hàng trống.";
            return;
        }

        // Bắt đầu giao dịch
        $this->db->beginTransaction();

        try {
            // Lưu thông tin đơn hàng vào bảng orders
            $query = "INSERT INTO orders (name, phone, address) VALUES (:name, :phone, :address)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':phone', $phone);
            $stmt->bindParam(':address', $address);
            $stmt->execute();
            $order_id = $this->db->lastInsertId();

            // Lưu chi tiết đơn hàng vào bảng order_details
            $cart = $_SESSION['cart'];
            foreach ($cart as $product_id => $item) {
                $query = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (:order_id, :product_id, :quantity, :price)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':order_id', $order_id);
                $stmt->bindParam(':product_id', $product_id);
                $stmt->bindParam(':quantity', $item['quantity']);
                $stmt->bindParam(':price', $item['price']);
                $stmt->execute();
            }

            // Xóa giỏ hàng sau khi đặt hàng thành công
            unset($_SESSION['cart']);

            // Commit giao dịch
            $this->db->commit();

            // Chuyển hướng đến trang xác nhận đơn hàng
            header('Location: /project1/Product/orderConfirmation');
            } catch (Exception $e) {
            // Rollback giao dịch nếu có lỗi
            $this->db->rollBack();
            echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage();
            }
        }
    }

    public function orderConfirmation()
    {
        include 'app/views/product/orderConfirmation.php';
    }
}

?>
    

