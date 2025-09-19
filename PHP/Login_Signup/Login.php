<?php
include("../Database/DB_Connect.php");

//Chạy session
session_start();

//Khai báo biến lỗi
$error_username = "";
$error_email = "";
$error_password = "";
$error_password1 = "";
$error_password2 = "";

//Khai báo biến dữ liệu
$username = isset($_POST['username']) ? $_POST['username'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
if (isset($_POST['login'])) {
    if (empty($username)) {
        $error_username = '⚠ Vui lòng nhập tên đăng nhập';
    } else {
        $valid = true;
        $username_length = strlen($username);
        for ($i = 0; $i < $username_length; $i++) {
            $char = $username[$i];
            if (!(($char >= 'a' && $char <= 'z') || ($char >= 'A' && $char <= 'Z') || ($char >= '0' && $char <= '9'))) {
                $valid = false;
                break;
            }
        }
        if (!$valid) {
            $error_username = '⚠ Tên đăng nhập không được chứa ký tự đặc biệt';
        }
    }
    if (empty($email)) {
        $error_email = '⚠ Vui lòng nhập email';
    }
    if (empty($password)) {
        $error_password = '⚠   Vui lòng nhập mật khẩu';
    } else {
        $valid = true;
        $password_length = strlen($password);
        if ($password_length < 8) {
            $error_password = '⚠ Mật khẩu phải chứa ít nhất 8 kí tự';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/Gitraell/CSS/Login_Signup/Login.css">
    <title>Đăng kí tài khoản</title>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="" method="post">
                <h1>Đăng kí tài khoản</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Hoặc đăng kí tài khoản Gitraell</span>
                <input type="text" name="username" placeholder="Tên đăng nhập">
                <input type="email" name="email" placeholder="Email">
                <input type="password" name="password1" placeholder="Mật khẩu">
                <input type="password" name="password2" placeholder="Xác nhận mật khẩu">
                <input type="submit" name="sign-up" value="Đăng kí tài khoản" class="signup">
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="" method="post">
                <h1>Đăng nhập </h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Hoặc dùng tài khoản Gitraell</span>
                <input type="text" name="username" placeholder="Tên đăng nhập">
                <div class="error"><?php echo $error_username ?></div>
                <input type="email" name="email" placeholder="Email">
                <div class="error"><?php echo $error_email ?></div>

                <input type="password" name="password" placeholder="Mật khẩu">
                <div class="error"><?php echo $error_password ?></div>

                <a href="#">Quên mật khẩu?</a>
                <input type="submit" name="login" value="Đăng nhập" class="login">
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Xin chào!</h1>
                    <p>Đăng kí tài khoản để sử dụng dịch vụ</p>
                    <button type="button" id="login">Đăng nhập </button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Chào mừng trở lại!</h1>
                    <p>Nhập thông tin của bạn để sử dụng dịch vụ của Gitraell</p>
                    <button type="button" id="register">Đăng kí</button>
                </div>

            </div>
        </div>
    </div>

    <script src="/Gitraell/JS/Login_Signup/Login.js"></script>
</body>

</html>