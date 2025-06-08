<?php 
require_once('app/config/database.php'); 
require_once('app/models/AccountModel.php');
class AccountController {
    private $accountModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }

    function register(){
        include_once 'app/views/account/register.php';
    }

    public function login() {
        include_once 'app/views/account/login.php';
    }

    function save(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $email = $_POST['email'] ?? '';
            $phone = $_POST['phone'] ?? '';
            // Xử lý upload avatar
            $avatar = '';
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                $uploadDir = 'uploads/avatars/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $avatar = $uploadDir . basename($_FILES['avatar']['name']);
                move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar);
            }

            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';

            $errors = [];

            if(empty($username)){
                $errors['username'] = "Vui long nhap userName!";
            }
            if(empty($fullName)){
                $errors['fullname'] = "Vui long nhap fullName!";
            }
            if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "Email không hợp lệ!";
            }
            if(empty($phone)){
                $errors['phone'] = "Vui lòng nhập số điện thoại!";
            }
            if(empty($password)){
                $errors['password'] = "Vui long nhap password!";
            }
            if($password != $confirmPassword){
                $errors['confirmPass'] = "Mat khau va xac nhan chua dung";
            }
            // Kiểm tra username đã được đăng ký chưa?
            $account = $this->accountModel->getAccountByUsername($username);
            if($account){
                $errors['account'] = "Tai khoan nay da co nguoi dang ky!";
            }

            if(count($errors) > 0){
                include_once 'app/views/account/register.php';
            } else {
                $password = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
                $result = $this->accountModel->save($username, $fullName, $email, $phone, $avatar, $password);
                if($result){
                    header('Location: /project1/account/login');
                    exit;
                }
            }
        }
    }

    function logout(){
        session_start();
        unset($_SESSION['username']);
        unset($_SESSION['role']);
        unset($_SESSION['email']);
        unset($_SESSION['phone']);
        unset($_SESSION['avatar']);
        header('Location: /project1/product');
        exit;
    }
    function profile() {
        if (!isset($_SESSION['username'])) {
            header('Location: /project1/account/login');
            exit;
        }
    
        $account = $this->accountModel->getAccountByUsername($_SESSION['username']);
        include 'app/views/account/profile.php';
    }
    
    function updateProfile() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['username'])) {
        header('Location: /project1/account/login');
        exit;
    }
    
        $email = $_POST['email'] ?? '';
        $phone = $_POST['phone'] ?? '';
        $avatar = null;
    
        // Xử lý upload ảnh
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "public/uploads/avatars/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            $fileName = uniqid() . "_" . basename($_FILES['avatar']['name']);
            $targetFile = $targetDir . $fileName;
    
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['avatar']['type'], $allowedTypes)) {
                move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFile);
                $avatar = $targetFile;
            }
        }
    
        $this->accountModel->updateProfile($_SESSION['username'], $email, $phone, $avatar);
        header("Location: /project1/account/profile");
    }

    public function checkLogin(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $account = $this->accountModel->getAccountByUsername($username);
            if ($account) {
                $pwd_hashed = $account->password;
                if (password_verify($password, $pwd_hashed)) {
                    session_start();
                    $_SESSION['username'] = $account->username;
                    $_SESSION['email'] = $account->email ?? '';
                    $_SESSION['phone'] = $account->phone ?? '';
                    $_SESSION['avatar'] = $account->avatar;
                    header('Location: /project1/product');
                    exit;
                } else {
                    echo "Password incorrect.";
                }
            } else {
                echo "Không tìm thấy tài khoản bạn đã đăng nhập!!!Vui lòng đăng ký tài khoản trước khi đăng nhập";
            }
        }
    }
}
 