<?php
include("../../Database/DB_Conect.php");
$sql = "SELECT * FROM users";
$result = mysqli_query($con, $sql); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../CSS/Login_Signup.css">
</head>

<body>
    <?php
    // Include header , menu , ...
    ?>
    <form method="POST" action="">
        <div>
            <table>
                <tr>
                    <td>Username:</td>
                    <td><input type="text" name="username" id="username" placeholder="Nhập tên đăng nhập" value=""></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" name="password" id="password" placeholder="Vui lòng nhập mật khẩu" value=""></td>
                </tr>
                <tr>
                    <td class="confirm" colspan="2" >
                        <input type="submit" name="login" value="Đăng nhập" onclick="">
                        <input type="button" value="Đăng kí" onclick="window.location.href='Signup.php'">
                    </td>
            </table>
        </div>
    </form>

</body>

</html>