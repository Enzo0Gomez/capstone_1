<?php
include('../../../connect/connection.php'); // Ensure this path is correct
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Health Records</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body>
    <div class="container mx-auto mt-10">
        <div class="shadow-lg rounded-lg overflow-hidden">
            <div class="bg-pink-500 text-white p-4">
                <h1 class="text-xl font-bold">Patient Health Records</h1>
            </div>
            <div class="p-4">
                <table class="min-w-full bg-white shadow-md rounded-lg border border-gray-200">
                    <thead class="bg-pink-100 text-black">
                        <tr>
                            <th class="px-4 py-2 text-left">Patient Name</th>
                            <th class="px-4 py-2 text-left">Created</th>
                            <th class="px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php
                        // Check if patient_id is passed via URL
                        if (isset($_GET['patient_id'])) {
                            $patient_id = $_GET['patient_id'];

                            // SQL Query for fetching records for the specific patient
                            $sql = "
                            SELECT 
                                phr.record_id, 
                                phr.patient_id,
                                p.first_name,
                                p.last_name,
                                p.middle_name,
                                phr.created_at
                            FROM 
                                patient_health_records phr
                            INNER JOIN 
                                patient p
                            ON 
                                phr.patient_id = p.patient_id
                            WHERE 
                                phr.patient_id = ?  -- Filter by the specific patient_id
                            ORDER BY 
                                phr.created_at DESC"; // Order by created_at (optional)

                            // Prepare and bind statement to avoid SQL injection
                            $stmt = $connect->prepare($sql);
                            $stmt->bind_param("i", $patient_id); // Bind the patient_id to the query
                            $stmt->execute();
                            $result = $stmt->get_result();

                            // Check if records exist for the given patient_id
                            if ($result->num_rows > 0) {
                                // Render table rows
                                while ($row = $result->fetch_assoc()) {
                                    $recordId = $row['record_id']; // Hidden field
                                    $fullName = $row['first_name'] . ' ' . ($row['middle_name'] ? $row['middle_name'] . ' ' : '') . $row['last_name'];
                                    $created = $row['created_at'];

                                    echo "
                                    <tr class='border-b'>
                                        <td class='px-4 py-2 text-gray-700'>$fullName</td>
                                        <td class='px-4 py-2 text-gray-700'>$created</td>
                                        <td class='px-4 py-2'>
                                            <a href='medical_history_view.php?record_id=$recordId' 
                                            class='px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-700'>
                                            View
                                            </a>
                                        </td>
                                    </tr>";
                                }
                            } else {
                                // If no records found for this patient
                                echo "<tr><td colspan='3' class='px-4 py-2 text-center text-gray-500'>No health records found for this patient.</td></tr>";
                            }

                            // Close the statement
                            $stmt->close();
                        } else {
                            echo "<tr><td colspan='3' class='px-4 py-2 text-center text-gray-500'>No patient ID provided.</td></tr>";
                        }

                        // Close database connection
                        $connect->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
