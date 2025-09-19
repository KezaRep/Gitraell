<?php
include("../Database/DB_Connect.php");
session_start();

// Khai báo biến lỗi
$error_username = $error_email = $error_password = $error_password1 = $error_password2 = "";
$username = $email = $password = $password1 = $password2 = "";

// Đăng ký
if (isset($_POST['sign-up'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password1 = $_POST['password1'];
    $password2 = $_POST['password2'];

    // Kiểm tra username
    if (empty($username)) {
        $error_username = "⚠ Vui lòng nhập tên đăng nhập";
    } else {
        $valid = true;
        for ($i = 0; $i < strlen($username); $i++) {
            $c = $username[$i];
            if (!(($c >= 'a' && $c <= 'z') || ($c >= 'A' && $c <= 'Z') || ($c >= '0' && $c <= '9'))) {
                $valid = false;
                break;
            }
        }
        if (!$valid) $error_username = "⚠ Tên đăng nhập không được chứa ký tự đặc biệt";
    }

    // Kiểm tra email
    if (empty($email)) $error_email = "⚠ Vui lòng nhập email";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $error_email = "⚠ Email không hợp lệ";

    // Kiểm tra password
    if (empty($password1)) $error_password1 = "⚠ Vui lòng nhập mật khẩu";
    elseif (strlen($password1) < 8) $error_password1 = "⚠ Mật khẩu phải chứa ít nhất 8 kí tự";

    if (empty($password2)) $error_password2 = "⚠ Vui lòng xác nhận mật khẩu";
    elseif ($password1 != $password2) $error_password2 = "⚠ Mật khẩu xác nhận cần trùng với mật khẩu";

    // Nếu không có lỗi, lưu vào DB
    if (empty($error_username) && empty($error_email) && empty($error_password1) && empty($error_password2)) {
        // Check username/email đã tồn tại
        $stmt = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $error_username = "⚠ Username hoặc email đã tồn tại";
        } else {
            $hash = password_hash($password1, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hash);
            $stmt->execute();
            $success_signup = true;
        }
        $stmt->close();
    }
}

// Đăng nhập
if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username)) $error_username = "⚠ Vui lòng nhập tên đăng nhập";
    if (empty($email)) $error_email = "⚠ Vui lòng nhập email";
    if (empty($password)) $error_password = "⚠ Vui lòng nhập mật khẩu";

    if (empty($error_username) && empty($error_email) && empty($error_password)) {
        $stmt = $conn->prepare("SELECT password FROM users WHERE username=? AND email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($hash);
        if ($stmt->num_rows == 1) {
            $stmt->fetch();
            if (password_verify($password, $hash)) {
                $_SESSION['username'] = $username;
                header("/Gitraell/index.php"); // chuyển tới trang sau khi login
                exit;
            } else {
                $error_password = "⚠ Mật khẩu không đúng";
            }
        } else {
            $error_username = "⚠ Username hoặc email không tồn tại";
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập / Đăng ký</title>
    <link rel="stylesheet" href="/Gitraell/CSS/Login_Signup/Login.css">
</head>
<body>
<div class="container" id="container">
    <div class="form-container sign-up">
        <form action="" method="post">
            <h1>Đăng kí tài khoản</h1>
            <input type="text" name="username" placeholder="Tên đăng nhập" value="<?php echo htmlspecialchars($username); ?>">
            <div class="error"><?php echo $error_username; ?></div>

            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="error"><?php echo $error_email; ?></div>

            <input type="password" name="password1" placeholder="Mật khẩu">
            <div class="error"><?php echo $error_password1; ?></div>

            <input type="password" name="password2" placeholder="Xác nhận mật khẩu">
            <div class="error"><?php echo $error_password2; ?></div>

            <input type="submit" name="sign-up" value="Đăng kí tài khoản">
            <?php if(isset($success_signup)) echo "<p style='color:green;'>Đăng ký thành công!</p>"; ?>
        </form>
    </div>

    <div class="form-container sign-in">
        <form action="" method="post">
            <h1>Đăng nhập</h1>
            <input type="text" name="username" placeholder="Tên đăng nhập" value="<?php echo htmlspecialchars($username); ?>">
            <div class="error"><?php echo $error_username; ?></div>

            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="error"><?php echo $error_email; ?></div>

            <input type="password" name="password" placeholder="Mật khẩu">
            <div class="error"><?php echo $error_password; ?></div>

            <input type="submit" name="login" value="Đăng nhập">
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
                <button type="button" id="sign-up">Đăng kí</button>
            </div>
        </div>
    </div>
</div>
<script src="/Gitraell/JS/Login_Signup/Login.js"></script>
</body>
</html>
