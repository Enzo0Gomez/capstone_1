<?php
// Include database connection
include('../../../connect/connection.php');

// Ensure patient_id is provided
$patient_id = $_GET['patient_id'] ?? null; 

if ($patient_id) {
    // Change the query to select by patient_id, assuming that 'patient_id' is the primary key for the records.
    $stmt = $connect->prepare("SELECT * FROM patient_health_records WHERE patient_id = ?");
    $stmt->bind_param("i", $patient_id);
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
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.js"></script>
</head>

<body class="bg-pink-100 text-gray-900 font-sans">

    <div class="max-w-4xl mx-auto p-6 bg-white shadow-md rounded-md mt-8">

        <!-- Basic Information Section -->
        <div class="mb-8">
            <h2 class="text-3xl font-semibold text-pink-600 mb-4">Medical View Information</h2>
            <h2 class="text-2xl font-semibold text-pink-600 mb-4">Basic Information</h2>

            <!-- 5x5 Grid -->
            <div class="grid grid-cols-3 gap-4">
                <!-- Grid items -->
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Number of Pregnancies</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['number_of_pregnancies'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Previous Birth Type</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['previous_birth_type'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Number of Miscarriages</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['number_of_miscarriages'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Expected Due Date</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['expected_due_date'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Last Menstrual Period</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['last_menstrual_period'] ?? '-') ?></span>
                </div>

                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Previous Delivery Complications</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['previous_delivery_complications'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Fetal Heart Rate</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['fetal_heart_rate'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Fetal Anatomy Scan</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['fetal_anatomy_scan'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Hemoglobin</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['hemoglobin'] ?? '-') ?></span>
                </div>
            </div>
        </div>

        <!-- Life Status Section -->
        <div>
            <h2 class="text-2xl font-semibold text-pink-600 mb-4">Life Status</h2>

            <!-- 5x5 Grid for Life Status -->
            <div class="grid grid-cols-3 gap-4">
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Are you under medical treatment now? If so, what is the
                        condition being treated?</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['medical_treatment_details'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Are you taking any medications? If so, please specify.</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['medication_details'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Have you ever had a serious illness or surgical operation?</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['serious_illness_details'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Have you ever been hospitalized? If so, when and why?</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['hospitalization_details'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Blood Type</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['blood_type'] ?? '-') ?></span>
                </div>

                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Latest Blood Pressure</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['blood_pressure'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Do you use alcohol or other substances?</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['alcohol_use'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Do you use tobacco products?</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['tobacco_use'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Are you in good health?</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['good_health'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Are you allergic to any of the following?</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['allergies'] ?? '-') ?></span>
                </div>

                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Do you have or have you had any of the following? Check which
                        apply</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['conditions'] ?? '-') ?></span>
                </div>
                <div class="flex flex-col">
                    <p class="font-medium text-gray-700">Upload Health Report Image</p>
                    <span class="text-gray-600"><?= htmlspecialchars($patientData['health_report_image'] ?? '-') ?></span>
                </div>
            </div>
        </div>
        <button type="button" class="flex text-white bg-pink-700 hover:bg-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 mt-8 dark:bg-pink-600 dark:hover:bg-pink-700 dark:focus:ring-pink-800">Edit Button</button>
    </div>

</body>

</html>
