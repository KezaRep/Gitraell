<?php
include("../Database/DB_Connect.php");

//Chạy session
session_start();

//Khai báo biến lỗi
$error_username = ""; 
$error_email ="";
$error_password1 ="";
$error_password2 ="";

//Khai báo biến dữ liệu
$username = isset($_POST['username']) ? $_POST['username'] : '';
$email = isset($_POST['email']) ? $_POST['email'] :
$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
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
            <form>
                <h1>Đăng kí tài khoản</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Hoặc đăng kí tài khoản Gitraell</span>
                <input type="text" placeholder="Tên đăng nhập">
                <input type="email" placeholder="Email">
                <input type="password1" placeholder="Mật khẩu">
                <input type="password2" placeholder="Xác nhận mật khẩu">
                <input type="submit" name="signup" value="Đăng kí tài khoản" class="signup">
            </form>
        </div>
        <div class="form-container sign-in">
            <form>
                <h1>Đăng nhập </h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Hoặc dùng tài khoản Gitraell</span>
                <input type="text" placeholder="Nhập tên đăng nhập">

                <input type="email" placeholder="Email">
                <input type="password" placeholder="Mật khẩu">
                <a href="#">Quên mật khẩu?</a>
                <input type="submit" name="logins" value="Đăng nhập" class="login">
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