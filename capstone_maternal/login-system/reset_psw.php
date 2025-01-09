<?php session_start();
include('../connect/connection.php');
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="style.css">

    <link rel="icon" href="Favicon.png">
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />

    <title>Login Form</title>
</head>

<body class="bg-pink-300 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a class="text-lg font-bold text-gray-800" href="#">Password Reset Form</a>
            <button class="text-gray-800 md:hidden focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow flex items-center justify-center">
        <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Reset Your Password</h2>
            <form action="#" method="POST" class="space-y-4">
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500  lg:text-lg h-10 px-4 py-4"
                            required>
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M10 4a6 6 0 015.995 5.775L16 10a6 6 0 01-11.995.225L4 10a6 6 0 016-6zm0-2a8 8 0 108 8 8.004 8.004 0 00-8-8zm0 12a6.978 6.978 0 003.874-1.218l-1.485-1.485A4.978 4.978 0 0110 14a5 5 0 01-4.889-4H4.111a7 7 0 006 5zm6.584-9.085l-1.485-1.485A6.978 6.978 0 0010 4a6.978 6.978 0 00-3.874 1.218L4.639 5.7a8.003 8.003 0 0112.944 2.787z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- Submit Button -->
                <div>
                    <button type="submit" name="reset"
                        class="w-full bg-pink-500 text-white py-2 px-4 rounded-md hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:ring-offset-2">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>


</html>
<?php
if (isset($_POST["reset"])) {
    include('../connect/connection.php');
    $psw = $_POST["password"];

    $token = $_SESSION['token'];
    $Email = $_SESSION['email'];

    $hash = password_hash($psw, PASSWORD_DEFAULT);

    $sql = mysqli_query($connect, "SELECT * FROM user WHERE email='$Email'");
    $query = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);

    if ($Email) {
        $new_pass = $hash;
        mysqli_query($connect, "UPDATE user SET password='$new_pass' WHERE email='$Email'");
        ?>
        <script>
            window.location.replace("login.php");
            alert("<?php echo "your password has been succesful reset" ?>");
        </script>
        <?php
    } else {
        ?>
        <script>
            alert("<?php echo "Please try again" ?>");
        </script>
        <?php
    }
}

?>
<script>
    const toggle = document.getElementById('togglePassword');
    const password = document.getElementById('password');

    toggle.addEventListener('click', function () {
        if (password.type === "password") {
            password.type = 'text';
        } else {
            password.type = 'password';
        }
        this.classList.toggle('bi-eye');
    });
</script>