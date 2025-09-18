<?php
include("../Database/DB_Connect.php");
session_start();
// Khai báo biến lỗi 
$error_user = '';
$error_password1 = '';
$error_password2 = '';
$error_email = '';
$error_phone = '';
$error_birthday = '';
$success = false;
// Xử lý khi người dùng nhấn đăng kí
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password_confirm = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';

$isSubmit = ($_SERVER['REQUEST_METHOD'] == 'POST' && count($_POST) > 0);
if ($isSubmit) {
    if (empty($username)) {
        $error_user = 'Vui lòng nhập tên đăng nhập';
    } else {
        // Kiểm tra username đã tồn tại chưa
        $sql_check_user = "SELECT * FROM users WHERE username='$username'";
        $result_check_user = mysqli_query($con, $sql_check_user);
        if (mysqli_num_rows($result_check_user) > 0) {
            $error_user = 'Tên đăng nhập đã tồn tại, vui lòng chọn tên khác';
        }
    }
    if (empty($password)) {
        $error_password1 = 'Vui lòng nhập mật khẩu';
    } elseif (strlen($password) < 8) {
        $error_password1 = 'Mật khẩu phải có ít nhất 8 ký tự';
    }
    if (empty($password_confirm)) {
        $error_password2 = 'Vui lòng xác nhận mật khẩu';
    } elseif ($password !== $password_confirm) {
        $error_password2 = 'Mật khẩu xác nhận không khớp';
    }
    if (empty($email)) {
        $error_email = 'Vui lòng nhập email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = 'Email không hợp lệ';
    }
    if (empty($phone)) {
        $error_phone = 'Vui lòng nhập số điện thoại';
    }
    if (empty($error_user) && empty($error_password1) && empty($error_password2) && empty($error_email) && empty($error_phone)) {
        $sql_insert = "INSERT INTO users (username, password, email, phone, birthday) VALUES ('$username','$password','$email','$phone','$birthday')";
        $result_insert = mysqli_query($con, $sql_insert);
        if ($result_insert) {
            $success = true;
            // Chuyển hướng đến trang đăng nhập sau khi đăng ký thành công
            header("Location: Login.php");
            exit();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng kí</title>
    <link rel="stylesheet" href="/Gitraell/CSS/Login_Signup/Signup.css">
</head>

<body>
    <?php include("../Header_Footer/Header.php"); ?>

    <div class="center-form">
        <div class="form-container">
        <form method="POST" action="">
            <h3>Đăng Kí Tài Khoản</h3>
            <table>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Nhập tên đăng nhập" value="<?php echo htmlspecialchars($username); ?>">
                        <div class="error"><?php echo $error_user; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Nhập mật khẩu">
                        <div class="error"><?php echo $error_password1; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>Confirm Password:</td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Xác nhận mật khẩu">
                        <div class="error"><?php echo $error_password2; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>
                        <input type="email" name="email" placeholder="Nhập email của bạn" value="<?php echo htmlspecialchars($email); ?>">
                        <div class="error"><?php echo $error_email; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>Phone:</td>
                    <td>
                        <input type="text" name="phone" placeholder="Nhập số điện thoại" value="<?php echo htmlspecialchars($phone); ?>">
                        <div class="error"><?php echo $error_phone; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>Birthday:</td>
                    <td>
                        <input type="date" name="birthday" value="<?php echo htmlspecialchars($birthday); ?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="confirm">
                        <input type="submit" name="signup" value="Đăng kí ngay" class="signup">
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="confirm">
                        Đã có tài khoản? <a href="Login.php">Đăng nhập</a>
                    </td>
                </tr>
            </table>
        </form>
        </div>
    </div>
</body>
</html>