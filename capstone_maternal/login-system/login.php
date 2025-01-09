<?php
session_start(); // Start the session to manage user data
require '../connect/connection.php';

if (isset($_POST["login"])) {
    $email = mysqli_real_escape_string($connect, trim($_POST['email']));
    $password = trim($_POST['password']);

    $sql = mysqli_query($connect, "SELECT * FROM user WHERE email = '$email'");
    $count = mysqli_num_rows($sql);

    if ($count > 0) {
        $fetch = mysqli_fetch_assoc($sql);
        $hashpassword = $fetch["password"];
        $status = $fetch["status"];
        $user_type = $fetch["user_type"];

        if ($status == 0) {
            echo "<script>alert('Your account is inactive. Please verify your email or contact support.');</script>";
        } else if (password_verify($password, $hashpassword)) {
            // Set session variables
            $_SESSION['user_id'] = $fetch['user_id']; // Store user ID
            $_SESSION['user_type'] = $user_type; // Store user type
            $_SESSION['logged_in'] = true; // Flag to indicate login status

            if ($user_type == 'Admin') {
                header("Location: ../admin/dashboard.php");
                echo "<script>alert('Login successfully');</script>";
                exit();
            } else if ($user_type == 'patient') {
                header("Location: ../patient/patientdashboard.php");
                echo "<script>alert('Login successfully');</script>";
                exit();
            } else if ($user_type == 'staff') {
                header("Location: ../staff/staffdashboard.php");
                echo "<script>alert('Login successfully');</script>";
                exit();
            } else if ($user_type == 'midwife') {
                header("Location: ../midwife/midwifedashboard.php");
                echo "<script>alert('Login successfully');</script>";
                exit();
            } else {
                echo "<script>alert('User type is not recognized.');</script>";
            }
        } else {
            echo "<script>alert('Email or password invalid, please try again.');</script>";
        }
    } else {
        echo "<script>alert('No account found with this email.');</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maternal & Neonatal Healthcare</title>
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <!-- Including Bootstrap CSS -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!-- Including Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <!-- Including jQuery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-pink-100 font-sans flex flex-col min-h-screen">

    <div class="flex-grow flex flex-col md:flex-row items-center justify-center p-6 bg-pink-100">
        <!-- Left Panel -->
        <div class="hidden md:flex flex-col items-center bg-pink-200 p-8 rounded-l-lg shadow-md max-w-md">
            <h1 class="text-2xl font-bold mb-4 text-gray-800">Maternal & Neonatal Healthcare</h1>
            <p class="text-gray-600 mb-6">Welcome back! Please login to your account.</p>
            <img src="../image/logo.png" alt="Maternal Healthcare" class="w-80 h-auto">
        </div>

        <!-- Right Panel -->
        <div class="bg-white p-8 rounded-lg md:rounded-l-none shadow-md w-full max-w-lg">
            <form action="" method="post">
                <!-- Email Field -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                        </svg>
                        <input type="text" id="email" name="email" placeholder="Email"
                            class="bg-transparent focus:outline-none ml-3 w-full">
                    </div>
                </div>

                <!-- Password Field -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="flex items-center border rounded-lg px-3 py-2 bg-gray-50">
                        <i class="bi bi-lock text-gray-400"></i>
                        <input type="password" id="password" name="password" placeholder="Password"
                            class="bg-transparent focus:outline-none ml-3 w-full">
                        <button type="button" id="togglePassword" class="text-gray-400 ml-2">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <input type="checkbox" id="rememberMe" name="rememberMe"
                        class="h-4 w-4 text-pink-500 border-gray-300 rounded">
                    <label for="rememberMe" class="ml-2 text-sm text-gray-600">Remember Me</label>
                </div>

                <!-- Forgot Password -->
                <div class="flex justify-between items-center mb-6">
                    <a href="recover_psw.php" class="text-pink-500 text-sm">Forgot Password?</a>
                </div>

                <!-- Login Button -->
                <button type="submit" name="login"
                    class="w-full bg-pink-500 text-white py-2 rounded-lg hover:bg-pink-600 transition">Login</button>

                <!-- Create Account -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600">Don’t Have an Account? <a href="register.php"
                            class="text-pink-500 font-semibold">Create Account</a></p>
                </div>
            </form>

            <!-- Back to Landing Page -->
            <div class="mt-6 text-center">
                <a href="../landingPage.php" class="text-gray-500 hover:text-pink-500 transition">Back to Home</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-100 py-4 text-center w-full mt-auto">
        <div class="container mx-auto">
            <div class="flex items-center justify-center space-x-2 mb-2">
                <img src="../image/logo.png" alt="Logo" class="w-8">
                <span class="text-sm text-gray-600">© 2024 Maternal & Neonatal Healthcare</span>
            </div>
            <div class="flex justify-center space-x-4">
                <a href="https://facebook.com" class="text-gray-600 hover:text-gray-800" aria-label="Facebook">
                    <i class="bi bi-facebook text-xl"></i>
                </a>
                <a href="https://twitter.com" class="text-gray-600 hover:text-gray-800" aria-label="Twitter">
                    <i class="bi bi-twitter text-xl"></i>
                </a>
                <a href="mailto:info@example.com" class="text-gray-600 hover:text-gray-800" aria-label="Email">
                    <i class="bi bi-envelope text-xl"></i>
                </a>
            </div>
        </div>
    </footer>
</body>

</html>


<!-- Password Toggle Script -->
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const icon = this.querySelector('i');
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }
    });
</script>

</html>