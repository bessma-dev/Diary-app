<?php
session_start();
include "includes/db.php";

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {

        $error = " ";

    } else {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: dashboard.php");
            exit;

        } else {

            $error = "Account doesn't exist";
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
<div class="box">

<h2>Your thoughts, your plans organized in one simple place<h2>
    <h2>💛🧡💜</h2>
    <br>
    <h2> Login</h2>

     <?php if ($error): ?>
    <div class="error">
        <?php echo $error; ?>
    </div>
<?php endif; ?>
<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <button name="login">Login</button>
</form>

<br>

<a href="register.php">Create account</a>

</div>
</div>

</body>
</html>