<?php
// Include database connection
include '../../connect/connection.php';

$id = $_GET['patient_id'] ?? null; 
$patientData = null;

if ($id) {
    $stmt = $connect->prepare("SELECT * FROM patient WHERE patient_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $patientData = $result->fetch_assoc();
    } else {
        echo "<script>alert('Patient not found');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical View</title>
    <link rel="icon" type="image/x-icon" href="../../image/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-pink-100 text-gray-900 font-sans">

    <div class="max-w-6xl mx-auto p-6 bg-white shadow-md rounded-md mt-8">

        <!-- Basic Information Section -->
        <div class="mb-8">
            <h2 class="text-3xl font-semibold text-pink-600 mb-4">View Patient Information</h2>
            <h2 class="text-2xl font-semibold text-pink-600 mb-4">Basic Information</h2>

            <div class="grid grid-cols-3 gap-4">
                <!-- Grid items -->
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">First Name</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['first_name'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Middle Name</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['middle_name'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Last Name</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['last_name'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Birthday</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['date_of_birth'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Age</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['age'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Sex</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['sex'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Civil Status</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['status'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Contact No.</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['contact_no'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Address</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['home_address'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Email</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['email'] ?? '-') ?></span>
                </div>
            </div>
            <a href="../patientprofiling.php">
                <button type="button" class="flex text-white bg-pink-700 hover:bg-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-8 dark:bg-pink-600 dark:hover:bg-pink-700 dark:focus:ring-pink-800">Back to Patient Profile</button>
            </a>
        </div>

    </div>

</body>

</html>
