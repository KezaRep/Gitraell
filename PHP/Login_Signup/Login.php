<?php
include("../Database/DB_Connect.php");
session_start();

// Biến lỗi
$error_username = "";
$error_email = "";
$error_password = "";
$error_password1 = "";
$error_password2 = "";
$success_msg = "";

// Biến dữ liệu
$username = isset($_POST['username']) ? $_POST['username'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$password1 = isset($_POST['password1']) ? $_POST['password1'] : '';
$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';

$show_signup = false; // Biến để giữ form đang hiển thị

// Xử lý đăng nhập
if (isset($_POST['login'])) {
    if (empty($username))
        $error_username = '⚠ Vui lòng nhập tên đăng nhập';
    if (empty($email))
        $error_email = '⚠ Vui lòng nhập email';
    if (empty($password))
        $error_password = '⚠ Vui lòng nhập mật khẩu';

    if (!$error_username && !$error_email && !$error_password) {
        $stmt = $con->prepare("SELECT * FROM users WHERE username=? AND email=? AND password=?");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $_SESSION['username'] = $username;
            header("Location: ../../index.php");
            exit;
        } else {
            $error_password = "⚠ Sai tên đăng nhập, email hoặc mật khẩu";
        }
    }
}

// Xử lý đăng ký
if (isset($_POST['sign-up'])) {
    $show_signup = true; // giữ form signup
    // Kiểm tra username
    if (empty($username)) {
        $error_username = '⚠ Vui lòng nhập tên đăng nhập';
    } else {
        $valid = true;
        for ($i = 0; $i < strlen($username); $i++) {
            $char = $username[$i];
            if (!(($char >= 'a' && $char <= 'z') || ($char >= 'A' && $char <= 'Z') || ($char >= '0' && $char <= '9'))) {
                $valid = false;
                break;
            }
        }
        if (!$valid)
            $error_username = '⚠ Tên đăng nhập không được chứa ký tự đặc biệt';
    }

    // Kiểm tra email
    if (empty($email))
        $error_email = '⚠ Vui lòng nhập email';
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $error_email = '⚠ Email không hợp lệ';

    // Kiểm tra mật khẩu
    if (empty($password1))
        $error_password1 = '⚠ Vui lòng nhập mật khẩu';
    elseif (strlen($password1) < 8)
        $error_password1 = '⚠ Mật khẩu phải chứa ít nhất 8 ký tự';

    // Kiểm tra xác nhận mật khẩu
    if (empty($password2))
        $error_password2 = '⚠ Vui lòng xác nhận mật khẩu';
    elseif ($password1 != $password2)
        $error_password2 = '⚠ Mật khẩu xác nhận cần trùng với mật khẩu';

    // Nếu không lỗi, chèn vào DB
    if (!$error_username && !$error_email && !$error_password1 && !$error_password2) {
        // Kiểm tra username hoặc email đã tồn tại chưa
        $stmt_check = $con->prepare("SELECT * FROM users WHERE username=? OR email=?");
        $stmt_check->bind_param("ss", $username, $email);
        $stmt_check->execute();
        $res_check = $stmt_check->get_result();
        if ($res_check->num_rows > 0) {
            $error_username = "⚠ Username hoặc email đã tồn tại";
        } else {
            $stmt = $con->prepare("INSERT INTO users(username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password1);
            if ($stmt->execute()) {
                $_SESSION['username'] = $username;
                $success_msg = "✅ Đăng ký thành công!";
            } else {
                echo "⚠ Lỗi khi đăng ký: " . $con->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $show_signup ? "Đăng ký tài khoản" : "Đăng nhập"; ?></title>
    <link rel="stylesheet" href="/Gitraell/CSS/Login_Signup/Login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="container <?php echo $show_signup ? 'active' : ''; ?>" id="container">
        <!-- Form Sign Up -->
        <div class="form-container sign-up">
            <form action="" method="post">
                <h1>Đăng ký tài khoản</h1>
                <?php if ($success_msg): ?>
                    <div class="success"><?php echo $success_msg; ?></div>
                <?php endif; ?>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Hoặc đăng ký tài khoản Gitraell</span>
                <input type="text" name="username" placeholder="Tên đăng nhập"
                    value="<?php echo htmlspecialchars($username); ?>">
                <div class="error"><?php echo $error_username; ?></div>
                <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
                <div class="error"><?php echo $error_email; ?></div>
                <input type="password" name="password1" placeholder="Mật khẩu"
                    value="<?php echo htmlspecialchars($password1); ?>">
                <div class="error"><?php echo $error_password1; ?></div>
                <input type="password" name="password2" placeholder="Xác nhận mật khẩu"
                    value="<?php echo htmlspecialchars($password2); ?>">
                <div class="error"><?php echo $error_password2; ?></div>
                <input type="submit" name="sign-up" value="Đăng ký tài khoản">
            </form>
        </div>

        <!-- Form Sign In -->
        <div class="form-container sign-in">
            <form action="" method="post">
                <h1>Đăng nhập</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>Hoặc dùng tài khoản Gitraell</span>
                <input type="text" name="username" placeholder="Tên đăng nhập"
                    value="<?php echo htmlspecialchars($username); ?>">
                <div class="error"><?php echo $error_username; ?></div>
                <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
                <div class="error"><?php echo $error_email; ?></div>
                <input type="password" name="password" placeholder="Mật khẩu"
                    value="<?php echo htmlspecialchars($password1); ?>">
                <div class="error"><?php echo $error_password; ?></div>
                <a href="#">Quên mật khẩu?</a>
                <input type="submit" name="login" value="Đăng nhập">
            </form>
        </div>

        <!-- Toggle Panel -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Xin chào!</h1>
                    <p>Đăng ký tài khoản để sử dụng dịch vụ</p>
                    <button type="button" id="loginBtn">Đăng nhập</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Chào mừng trở lại!</h1>
                    <p>Nhập thông tin của bạn để sử dụng dịch vụ của Gitraell</p>
                    <button type="button" id="signupBtn">Đăng ký</button>
                </div>
            </div>
        </div>
    </div>

    <script src="/Gitraell/JS/Login_Signup/Login.js"></script>

</body>

</html>