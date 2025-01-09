<?php session_start(); ?>

<?php
ini_set('display_errors', 1);  // Display errors
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../connect/connection.php');
if (isset($_POST["register"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmpassword = $_POST["confirmPassword"];
    $firstName = $_POST["firstName"];
    $middleName = $_POST["middleName"];
    $lastName = $_POST["lastName"];
    $dateOfBirth = $_POST["date_of_birth"];
    $age = $_POST["age"];
    $sex = $_POST["sex"];
    $status = $_POST["status"];
    $homeAddress = $_POST["home_address"];
    $contactNo = $_POST["contact_no"];

    $guardianfirstName = $_POST["guardianfirstname"];
    $guardianmiddleName = $_POST["guardianmiddlename"];
    $guardianlastName = $_POST["guardianlastname"];
    $guardiandateOfBirth = $_POST["guardiandate_of_birth"];
    $guardianage = $_POST["guardianage"];
    $guardiansex = $_POST["guardiansex"];
    $guardianrelationship = $_POST["guardianrelationship"];
    $guardianemail = $_POST["guardianemail"];
    $guardianhomeAddress = $_POST["guardianhome_address"];
    $guardiancontactNo = $_POST["guardiancontact_no"];

    $check_query = mysqli_query($connect, "SELECT * FROM user WHERE email ='$email'");
    $rowCount = mysqli_num_rows($check_query);

    if (!empty($email) && !empty($password)) {
        if ($rowCount > 0) {
            echo "<script>alert('User with email already exists!');</script>";
        } elseif ($password !== $confirmpassword) {
            echo "<script>alert('Passwords do not match. Please try again.');</script>";
        } else {
            $password_hash = password_hash($password, PASSWORD_BCRYPT);

            // Insert into `user` table
            $userQuery = "INSERT INTO user (email, password, status, user_type) VALUES ('$email', '$password_hash', 'active', 'patient')";
            $userResult = mysqli_query($connect, $userQuery);

            if ($userResult) {
                // Insert into `patient` table
                $patientQuery = "INSERT INTO patient (first_name, middle_name, last_name, date_of_birth, age, sex, status, email, home_address, contact_no) 
                                 VALUES ('$firstName', '$middleName', '$lastName', '$dateOfBirth', '$age', '$sex', '$status', '$email', '$homeAddress', '$contactNo')";
                $patientResult = mysqli_query($connect, $patientQuery);

                if ($patientResult) {
                    // Retrieve the `patient_id` of the newly inserted patient
                    $patientId = mysqli_insert_id($connect);

                    // Insert into `guardian` table
                    $guardianQuery = "INSERT INTO guardian (patient_id, first_name, middle_name, last_name, date_of_birth, age, guardiansex, relationship_to_patient, email, home_address, contact_no) 
                                      VALUES ('$patientId', '$guardianfirstName', '$guardianmiddleName', '$guardianlastName', '$guardiandateOfBirth', '$guardianage', '$guardiansex', '$guardianrelationship', '$guardianemail', '$guardianhomeAddress', '$guardiancontactNo')";
                    $guardianResult = mysqli_query($connect, $guardianQuery);

                    if ($guardianResult) {
                        $otp = rand(100000, 999999);
                        $_SESSION['otp'] = $otp;
                        $_SESSION['mail'] = $email;

                        require "Mail/phpmailer/PHPMailerAutoload.php";
                        $mail = new PHPMailer;

                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->Port = 587;
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = 'tls';

                        $mail->Username = 'ryandorona29@gmail.com';
                        $mail->Password = 'grqu rfnw xluy cvkk';

                        $mail->setFrom('email account', 'OTP Verification');
                        $mail->addAddress($email);

                        $mail->isHTML(true);
                        $mail->Subject = "Your verify code";
                        $mail->Body = "<p>Dear user $firstName, </p> <h3>Your verify OTP code is $otp <br></h3>";

                        if (!$mail->send()) {
                            echo "<script>alert('Register Failed, Invalid Email');</script>";
                        } else {
                            echo "<script>alert('Register Successfully, OTP sent to $email');</script>";
                            echo "<script>window.location.replace('verification.php');</script>";
                        }
                    } else {
                        echo "<script>alert('Failed to insert guardian details.');</script>";
                    }
                } else {
                    echo "<script>alert('Failed to insert patient details.');</script>";
                }
            } else {
                echo "<script>alert('Failed to insert user details.');</script>";
            }

        }
    }
}
?>
<!-- Add this JavaScript for client-side validation and improved UX -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const dateOfBirthInput = document.getElementById('date_of_birth');
        const ageInput = document.getElementById('age');
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');
        const togglePassword = document.createElement('button');

        // Calculate age from date of birth
        dateOfBirthInput.addEventListener('change', function () {
            const birthDate = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            ageInput.value = age;
        });

        // Guardian Date of Birth and Age Calculation
        const guardianDateOfBirthInput = document.getElementById('guardiandate_of_birth');
        const guardianAgeInput = document.getElementById('guardianage');

        guardianDateOfBirthInput.addEventListener('change', function () {
            const birthDate = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            guardianAgeInput.value = age;
        });

        // Password visibility toggle
        function setupPasswordToggle(passwordInput) {
            const toggleBtn = document.createElement('button');
            toggleBtn.type = 'button';
            toggleBtn.innerHTML = '<i class="bi bi-eye"></i>';
            toggleBtn.className = 'absolute right-3 bottom-0.5 top-15.5 transform -translate-y-3/4';

            passwordInput.parentElement.style.position = 'relative';
            passwordInput.parentElement.appendChild(toggleBtn);

            toggleBtn.addEventListener('click', () => {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                toggleBtn.innerHTML = type === 'password' ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
            });
        }

        setupPasswordToggle(passwordInput);
        setupPasswordToggle(confirmPasswordInput);

        // Client-side form validation
        form.addEventListener('submit', function (e) {
            let isValid = true;
            const errors = {};

            // Email validation
            const email = document.getElementById('email').value;
            if (!email.match(/^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/)) {
                errors.email = 'Please enter a valid email address';
                isValid = false;
            }

            // Password validation
            const password = passwordInput.value;
            if (password.length < 8) {
                errors.password = 'Password must be at least 8 characters long';
                isValid = false;
            }

            if (password !== confirmPasswordInput.value) {
                errors.confirmPassword = 'Passwords do not match';
                isValid = false;
            }
            //display error
            if (!isValid) {
                e.preventDefault();
                Object.keys(errors).forEach(key => {
                    const input = document.getElementById(key);

                    // Create the error message container
                    let errorDiv = input.parentElement.querySelector('.error-message');
                    if (!errorDiv) {
                        errorDiv = document.createElement('div');
                        errorDiv.className = 'error-message text-red-500 text-sm absolute mt-1';
                        input.parentElement.style.position = 'relative'; // Ensure the parent has relative positioning
                        input.parentElement.appendChild(errorDiv);
                    }

                    // Update the error message
                    errorDiv.textContent = errors[key];
                });
            }
        });
    });
</script>



<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
<!------ Include the above in your HEAD tag ---------->

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="../image/logo.png">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <link rel="icon" href="Favicon.png">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <title>Register Form</title>
</head>

<body class=" bg-pink-200">
    <main class="max-w-8xl mx-auto p-6 bg-pink-100">
        <div class="flex justify-center">
            <div class="w-150 max-w-7xl">
                <div class="bg-white shadow-lg rounded-lg p-9">
                <div class="flex items-center space-x-4 p-9 bg-white max-w-md mx-auto">
                        <img src="../image/logo.png" alt="Logo" class="ml-5 h-12">
                        <h3 class="text-2xl font-semibold text-gray-800">Registration Form</h3>
                    </div>

                    <form action="" method="post" class="space-y-5">
                        <h3 class="bg-pink-200 text-2xl rounded-lg font-semibold text-center mb-2 text-gray-700">Account
                            Information</h3>

                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-4">
                            <div class="form-group">
                                <label for="email" class="text-sm font-medium text-gray-700">Email Address</label>
                                <input type="email" id="email" name="email"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Enter your email address">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                                <input type="password" id="password" name="password"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword" class="text-sm font-medium text-gray-700">Confirm
                                    Password</label>
                                <input type="password" id="confirmPassword" name="confirmPassword"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Confirm Password">
                            </div>

                        </div>

                        <h3 class="bg-pink-200 text-2xl rounded-lg font-semibold text-center mb-4 text-gray-700">Patient
                            Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
                            <div class="form-group">
                                <label for="firstName" class="text-sm font-medium text-gray-700">First Name</label>
                                <input type="text" id="firstName" name="firstName"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="First Name">
                            </div>
                            <div class="form-group">
                                <label for="middleName" class="text-sm font-medium text-gray-700">Middle Name</label>
                                <input type="text" id="middleName" name="middleName"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Middle Name">
                            </div>
                            <div class="form-group">
                                <label for="lastName" class="text-sm font-medium text-gray-700">Last Name</label>
                                <input type="text" id="lastName" name="lastName"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Last Name">
                            </div>
                            <div class="form-group">
                                <label for="date_of_birth" class="text-sm font-medium text-gray-700">Date of
                                    Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                            </div>
                            <div class="form-group">
                                <label for="age" class="text-sm font-medium text-gray-700">Age</label>
                                <input type="number" id="age" name="age"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Age">
                            </div>
                            <div class="form-group">
                                <label for="sex" class="text-sm font-medium text-gray-700">Sex</label>
                                <select id="sex" name="sex"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                                    <option value="">Select Sex</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status" class="text-sm font-medium text-gray-700">Marital Status</label>
                                <select id="status" name="status"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                                    <option value="">Select your Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="home_address" class="text-sm font-medium text-gray-700">Home Address</label>
                                <input type="text" id="home_address" name="home_address"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Home Address">
                            </div>
                            <div class="form-group">
                                <label for="contact_no" class="text-sm font-medium text-gray-700">Contact Number</label>
                                <input type="tel" id="contact_no" name="contact_no"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Contact Number">
                            </div>
                        </div>


                        <!-- Guardian Section -->
                        <h3 class="text-2xl bg-pink-200 rounded-lg font-semibold text-center mt-10 mb-8 text-gray-700">
                            Guardian to
                            Contact
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-3">
                            <div class="form-group col-span-1">
                                <label for="guardianfirstname" class="text-sm font-medium text-gray-700">First
                                    Name</label>
                                <input type="text" id="guardianfirstname" name="guardianfirstname"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="First Name">
                            </div>
                            <div class="form-group col-span-1">
                                <label for="guardianmiddlename" class="text-sm font-medium text-gray-700">Middle
                                    Name</label>
                                <input type="text" id="guardianmiddlename" name="guardianmiddlename"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Middle Name">
                            </div>
                            <div class="form-group col-span-1">
                                <label for="guardianlastname" class="text-sm font-medium text-gray-700">Last
                                    Name</label>
                                <input type="text" id="guardianlastname" name="guardianlastname"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Last Name">
                            </div>
                            <div class="form-group col-span-1">
                                <label for="guardiandate_of_birth" class="text-sm font-medium text-gray-700">Date of
                                    Birth</label>
                                <input type="date" id="guardiandate_of_birth" name="guardiandate_of_birth"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                            </div>
                            <div class="form-group col-span-1">
                                <label for="guardianage" class="text-sm font-medium text-gray-700">Age</label>
                                <input type="number" id="guardianage" name="guardianage"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Age">
                            </div>

                            <div class="form-group col-span-1">
                                <label for="guardiansex" class="text-sm font-medium text-gray-700">Sex</label>
                                <select id="guardiansex" name="guardiansex"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500">
                                    <option value="">Select Sex</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div class="form-group col-span-1">
                                <label for="guardianemail" class="text-sm font-medium text-gray-700">Email
                                    Address</label>
                                <input type="email" id="guardianemail" name="guardianemail"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Enter your email address">
                            </div>

                            <div class="form-group col-span-1">
                                <label for="guardianhome_address" class="text-sm font-medium text-gray-700">Home
                                    Address</label>
                                <input type="text" id="guardianhome_address" name="guardianhome_address"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Home Address">
                            </div>

                            <div class="form-group col-span-1">
                                <label for="guardiancontact_no" class="text-sm font-medium text-gray-700">Contact
                                    Number</label>
                                <input type="tel" id="guardiancontact_no" name="guardiancontact_no"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Contact Number">
                            </div>

                            <div class="form-group col-span-1">
                                <label for="guardianrelationship" class="text-sm font-medium text-gray-700">Relationship
                                    to Patient</label>
                                <input type="text" id="guardianrelationship" name="guardianrelationship"
                                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-pink-500"
                                    placeholder="Relationship">
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="text-center mt-8">
                            <a href="login.php">
                                <button type="submit"
                                    class="px-6 py-3 bg-pink-500 text-white font-semibold rounded-md shadow-md hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-500">Back
                                    Login</button>
                                <button type="submit" name="register"
                                    class="px-6 py-3 ml-5 bg-pink-500 text-white font-semibold rounded-md shadow-md hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-pink-500">Submit</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
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