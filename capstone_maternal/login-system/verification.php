<?php session_start() ?>

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
    <script src="https://cdn.tailwindcss.com"></script>


    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <link rel="icon" href="Favicon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Verification</title>
</head>

<body class="bg-pink-200 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a class="text-lg font-bold text-gray-800" href="#">Verification Account</a>
            <button class="md:hidden text-gray-800 focus:outline-none">
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
            <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Verification Account</h2>
            <form action="#" method="POST" class="space-y-6">
                <!-- OTP Code Field -->
                <div>
                    <label for="otp" class="block text-sm font-medium text-gray-700">OTP Code</label>
                    <input type="text" id="otp" name="otp_code"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-pink-500 focus:ring-pink-500  lg:text-lg h-10 px-4 py-4 "
                        required autofocus>
                </div>
                <!-- Submit Button -->
                <div>
                    <button type="submit" name="verify"
                        class="w-full bg-pink-500 text-white py-2 px-4 rounded-md hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-400 focus:ring-offset-2">
                        Verify
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
<?php
include('../connect/connection.php');
if (isset($_POST["verify"])) {
    $otp = $_SESSION['otp'];
    $email = $_SESSION['mail'];
    $otp_code = $_POST['otp_code'];

    if ($otp != $otp_code) {
        ?>
        <script>
            alert("Invalid OTP code");
        </script>
        <?php
    } else {
        mysqli_query($connect, "UPDATE user SET status = 1 WHERE email = '$email'");
        ?>
        <script>
            alert("Verfiy account done, you may sign in now");
            window.location.replace("login.php");
        </script>
        <?php
    }

}

?>