<?php
include("../Database/DB_Connect.php");
session_start();
$sql = "SELECT * FROM users";
$result = mysqli_query($con, $sql); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="/Gitraell/CSS/Login_Signup/Login.css">
</head>

<body>
    <?php
    // Include header , menu , ...
    include("../Header_Footer/Header.php"); ?>
    

        <div class="center-form">

            <div class="form-container">
                <form method="POST" action="">
                <h3>Đăng nhập tài khoản</h3>
                <table>
                    <tr>
                        <td><input type="text" name="username" id="username" placeholder="Nhập tên đăng nhập" value="" class="information">
                        </td>
                    </tr>
                    <tr>
                        <td><input type="password" name="password" id="password" placeholder="Vui lòng nhập mật khẩu"
                                value="" class="information"></td>
                    </tr>
                    <tr>
                        <td class="confirm" colspan="2">
                            <input type="submit" name="login" value="Đăng nhập" onclick="" class="login">
                        </td></tr>
                        <td colspan="2" class="confirm">
                            Chưa có tài khoản? <a href="Signup.php">Đăng kí</a>
                        </td>
                </table>
                 </form>
            </div>
        </div>
   

</body>

</html>