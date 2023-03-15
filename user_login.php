<?php
require_once 'components/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($name) || empty($password)) {
        echo "Error! Please enter username and password";
        header("Location: user_login.html");
        exit;
    }

    // 检查用户名和密码是否匹配
    $stmt = $conn->prepare("SELECT * FROM users WHERE name = :name");
    $stmt->bindParam(':name', $name);
    $stmt->execute();
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        if (isset($user['verified']) && $user['verified'] == 1) {
         
            // 用户已通过验证，执行登录逻辑
            session_start(); // 启动会话

            echo "Login successful!";
            // 执行登录后的操作
            // 例如，将用户信息存储在会话中，重定向到用户的个人资料页面等

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['name'];
            $_SESSION['email'] = $user['email'];

            // 重定向到用户的个人资料页面
            header("Location: home.php");
            exit;
        } else {
            // 用户的电子邮件尚未通过验证
        echo "Error! Your email is not verified yet.";
        }
    } else {
        echo "Invalid username or password";
        // 提示用户用户名或密码无效
    }
}
?>
