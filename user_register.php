<?php
require 'PHPMailer/PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer/PHPMailer-master/src/SMTP.php';
require 'PHPMailer/PHPMailer-master/src/Exception.php';

require_once 'components/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $contact = isset($_POST['contact']) ? $_POST['contact'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    if (empty($name) || empty($contact) || empty($email) || empty($password) || empty($confirm_password)) {
        echo "Error! Please fill in all fields";
        header("Location: user_register.html");
        exit;
    }

    if ($password !== $confirm_password) {
        echo "Error! Confirm password does not match";
        header("Location: user_register.html");
        exit;
    }

    // Check if username already exists
    if ($stmt = $conn->prepare('SELECT id FROM users WHERE name = :name')) {
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        if ($stmt->fetch()) {
            echo '<script>alert("Username already exists, please choose another!");</script>';
            echo '<script>window.location.href = "user_register.html";</script>';
            exit;
        }
        $stmt->closeCursor();
} else {
    echo 'Could not prepare statement for username check!';
    exit;
}

// Check if email already exists
if ($stmt = $conn->prepare('SELECT id FROM users WHERE email = :email')) {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Email is incorrect, please enter a valid email!");</script>';
        echo '<script>window.location.href = "user_register.html";</script>';
        exit;
    }
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        echo '<script>alert("Email already exists, please choose another!");</script>';
        echo '<script>window.location.href = "user_register.html";</script>';
        exit;
    }
    $stmt->closeCursor();
} else {
    echo 'Could not prepare statement for email check!';
    exit;
}

    // Generate a unique verification token
$verification_token = bin2hex(random_bytes(32));

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Store user registration data and verification token in the database
if ($stmt = $conn->prepare("INSERT INTO users (name, contact, email, password, verification_token) VALUES (:name, :contact, :email, :password, :verification_token)")) {
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->bindParam(':verification_token', $verification_token);
    $stmt->execute();
        // Send verification email
        $to = $email;
        $subject = "Email Verification";
        $message = "Thank you for registering. Please click the following link to verify your email: \n";
        $message .= "http://localhost/order/verify.php?token=" . urlencode($verification_token);

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Set SMTP server address
        $mail->SMTPAuth = true;
        $mail->Username = 'limzh0111@gmail.com'; // Set sender email address
        $mail->Password = 'ckhwkwxjhlgffvxy'; // Set sender email password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        //$mail->SMTPDebug = 2;

        $mail->setFrom('limzh0111@gmail.com', 'Lim Zhong Hong'); // Set sender name and email
        $mail->addAddress($to); // Set recipient email
        $mail->Subject = $subject; // Set email subject
        $mail->Body = $message; // Set email content

        if ($mail->send()) {
            // Perform a page redirect to user_login.html
            header("refresh:0.1;url=user_login.html");
            echo "Registration successful. Verification email sent!";
        } else {
            echo "Error sending verification email: " . $mail->ErrorInfo;
        }
    } else {
        echo "Error registering user";
    }
}
?>

