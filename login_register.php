<?php
session_start();
require_once 'database.php';

if (isset($_POST['forgot'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['forgot_error'] = 'Password dan konfirmasi password tidak sama!';
        $_SESSION['forgot_data'] = ['username' => $username, 'email' => $email];
        $_SESSION['active_form'] = 'forgot';
        header("Location: index.php");
        exit();
    }

    // cek akun
    $checkAkun = $conn->query(
        "SELECT * FROM users WHERE username='$username' AND email='$email'"
    );

    if ($checkAkun->num_rows == 0) {
        $_SESSION['forgot_error'] = 'Username atau Email tidak terdaftar!';
        $_SESSION['forgot_data'] = ['username' => $username, 'email' => $email];
        $_SESSION['active_form'] = 'forgot';
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $conn->query(
            "UPDATE users SET password='$hashedPassword' 
             WHERE username='$username' AND email='$email'"
        );

        $_SESSION['success'] = 'Password berhasil direset. Silakan login!';
    }

    header("Location: index.php");
    exit();
}

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email sudah terdaftar!';
        $_SESSION['active_form'] = 'register';
    } else {
        $conn->query("INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')");
    }

    header("Location: index.php");
    exit();
}

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Siapkan statement untuk mencegah SQL Injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username); // Bind parameter

    // Eksekusi statement
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Simpan data ke session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            // SIMPAN LOG LOGIN
            $log = $conn->prepare("
                INSERT INTO login (user_id, username, email, role)
                VALUES (?, ?, ?, ?)
            ");
            $log->bind_param(
                "isss",
                $user['id'],
                $user['username'],
                $user['email'],
                $user['role']
            );
            $log->execute();

            // Redirect berdasarkan role
            if ($user['role'] === 'admin') {
                header("Location: Admin/dashboard_admin.php"); 
            } else if ($user['role'] === 'dokter') {
                header("Location: Dokter/dashboard_dokter.php"); 
            } else {
                header("Location: Pasien/dashboard_pasien.php"); 
            }
            exit();
        }
    }

    // Jika login gagal
    $_SESSION['login_error'] = 'Username atau Password Salah';
    $_SESSION['active_form'] = 'login';
    header("Location: index.php");
    exit();
}

?>