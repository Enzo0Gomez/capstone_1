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

    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <link rel="icon" href="Favicon.png">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Login Form</title>
</head>

<body class="bg-pink-300 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-md py-4">
        <div class="container mx-auto flex justify-between items-center px-4">
            <a class="text-lg font-bold text-gray-800" href="#">User Password Recover</a>
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
            <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">Password Recover</h2>
            <form action="#" method="POST" class="space-y-4">
                <!-- Email Address Field -->
                <div>
                    <label for="email_address" class="block text-sm font-medium text-gray-700">E-Mail Address</label>
                    <input type="text" id="email_address" name="email"
                        class="mt-2 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 lg:text-lg h-10 px-4 py-4"
                        required>

                </div>
                <!-- Submit Button -->
                <div>
                    <button type="submit" name="recover"
                        class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2">
                        Recover
                    </button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>

<?php
if (isset($_POST["recover"])) {
    include('../connect/connection.php');
    $email = $_POST["email"];

    $sql = mysqli_query($connect, "SELECT * FROM user WHERE email='$email'");
    $query = mysqli_num_rows($sql);
    $fetch = mysqli_fetch_assoc($sql);

    if (mysqli_num_rows($sql) <= 0) {
        ?>
        <script>
            alert("<?php echo "Sorry, no emails exists " ?>");
        </script>
        <?php
    } else if ($fetch["status"] == 0) {
        ?>
            <script>
                alert("Sorry, your account must verify first, before you recover your password !");
                window.location.replace("index.php");
            </script>
        <?php
    } else {
        // generate token by binaryhexa 
        $token = bin2hex(random_bytes(50));

        //session_start ();
        $_SESSION['token'] = $token;
        $_SESSION['email'] = $email;

        require "Mail/phpmailer/PHPMailerAutoload.php";
        $mail = new PHPMailer;

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'tls';

        // h-hotel account
        $mail->Username = 'ryandorona29@gmail.com';
        $mail->Password = 'grqu rfnw xluy cvkk';

        // send by h-hotel email
        $mail->setFrom('email', 'Password Reset');
        // get email from input
        $mail->addAddress($_POST["email"]);


        // HTML body
        $mail->isHTML(true);
        $mail->Subject = "Recover your password";
        $mail->Body = "<b>Dear User</b>
            <h3>We received a request to reset your password.</h3>
            <p>Kindly click the below link to reset your password</p>
            http://localhost/capstone_maternal/login-System/reset_psw.php
            <br><br>
            <p>With regrads,</p>
            <b>Programming with Lam</b>";

        if (!$mail->send()) {
            ?>
                <script>
                    alert("<?php echo " Invalid Email " ?>");
                </script>
            <?php
        } else {
            ?>
                <script>
                    window.location.replace("notification.html");
                </script>
            <?php
        }
    }
}


?>