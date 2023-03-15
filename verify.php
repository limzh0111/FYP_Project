<?php
// verify.php - 验证处理代码

require_once 'components/connect.php';

if (isset($_GET['token'])) {
    $verification_token = $_GET['token'];

    // 检查验证令牌是否存在于数据库中
    $stmt = $conn->prepare("SELECT * FROM users WHERE verification_token = :verification_token");
    $stmt->bindParam(':verification_token', $verification_token);
    $stmt->execute();

    $user = $stmt->fetch();

    if ($user) {
        // 更新数据库中的用户验证状态
        $stmt = $conn->prepare("UPDATE users SET verified = 1 WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user['id']);

        if ($stmt->execute()) {
            echo "Email verification successful! You can now login.";
            // Redirect to user_login.php
            // 重定向到 user_login.php
            header("Location: user_login.html");
        } 
        
        else {
            echo "Error updating user verification status";
        }
    } 
    
    else {
        echo "Invalid verification token";
    }
} 

else {
    echo "Invalid verification token";
}
?>
