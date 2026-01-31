<?php
session_start();

$forgotData = $_SESSION['forgot_data'] ?? [];

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? '',
    'forgot' => $_SESSION['forgot_error'] ?? ''
];
$activeForm = $_SESSION['active_form'] ?? 'login';

unset(
    $_SESSION['login_error'],
    $_SESSION['register_error'],
    $_SESSION['forgot_error'],
    $_SESSION['active_form']
);

session_destroy();

function showError($errors) {
    return !empty($errors) ? "<p class='error-message'>$errors</p>" : '';
}
function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Login & Register</title>
</head>
<body>
    <div class="container">
        <div class="form-box <?= isActiveForm('login', $activeForm); ?>" id="login-form">
            <form action="login_register.php" method="post">
                <h2>Login</h2>
                <?= showError($errors['login']); ?>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" class="password" name="password" placeholder="Password" required>
                <i class="far fa-eye toggle-password"></i>
                <a class="forgot" href="#" onclick="showForm('forgot-form')">Forgot Password?</a>
                <button type="submit" class="login" name="login">Login</button>
                <p>Don't have an account? <a href="#" onclick="showForm('register-form')">Register</a></p>
            </form>
        </div>
        <div class="form-box <?= isActiveForm('register', $activeForm); ?>" id="register-form">
            <form action="login_register.php" method="post">
                <h2>Register</h2>
                <?= showError($errors['register']); ?>
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" class="password" name="password" placeholder="Password" required>
                <i class="far fa-eye toggle-password"></i>
                <select name="role" required>
                    <option value="">--Select Role--</option>
                    <option value="Pasien">Pasien</option>
                    <option value="Dokter">Dokter</option>
                    <option value="Admin">Admin</option>
                </select>
                <button type="submit" name="register">Register</button>
                <p>Already have an account? <a href="#" onclick="showForm('login-form')">Login</a></p>
            </form>
        </div>
        <div class="form-box <?= isActiveForm('forgot', $activeForm); ?>" id="forgot-form">
            <form action="login_register.php" method="post">
                <h2 class="change">Change Password</h2>
                <?= showError($errors['forgot']); ?>
                <input type="text" name="username" value="<?= htmlspecialchars($forgotData['username'] ?? '') ?>"  placeholder="Username" required>
                <input type="email" name="email" value="<?= htmlspecialchars($forgotData['email'] ?? '') ?>" placeholder="Email" required>
                <input type="password" class="password" name="password" placeholder="Password" required>
                <i class="far fa-eye toggle-password"></i>
                <input type="password" class="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                <i class="far fa-eye toggle-password"></i>
                <button type="submit" name="forgot">Change Password</button>
                <p>Return? <a href="#" onclick="showForm('login-form')">Login</a></p>
            </form>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>