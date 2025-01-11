<?php
include('../connect/connection.php');

$sql = "SELECT baby_id, patient_ib, babyname, baby_dateB, time_delivery, deliveryType, baby_weight, baby_length FROM baby_info";
$result = $connect->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Baby Profilling</title>
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header class="px-4 py-2 bg-pink-200 shadow-md flex justify-between items-center">
        <!-- Logo and Brand Name -->
        <a href="#" class="flex items-center space-x-2">
            <img src="../image/logo.png" alt="Logo" class="h-14 w-14 object-cover rounded-full">
            <span class="text-xl font-semibold text-gray-800">Maternal and Neonatal Healthcare</span>
        </a>
        <!-- Profile Section -->
        <div class="flex items-center">
            <img src="../image/dan.jpg" alt="Profile Picture" class="w-12 h-12 rounded-full object-cover">
        </div>
    </header>
    <?php include 'tabadmin.php'; ?>
    <div class="container mt-2">
        <h2 class="text-2xl font-semibold mb-4 text-center">Baby Profiling</h2>

        <!-- Search Form -->
        <form class="mb-4" role="search">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <div class="flex justify-start">
                    <button class="btn w-1/2 bg-pink-200 hover:bg-pink-300 text-black py-2 px-4 rounded"
                        data-bs-toggle="modal" data-bs-target="#userModal" type="button">Add Baby</button>
                </div>
                <div class="flex justify-end">
                    <div class="relative">
                        <button class="btn bg-pink-200 hover:bg-pink-300 text-black py-2 px-4 rounded dropdown-toggle"
                            type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Filter Baby
                        </button>
                        <ul class="dropdown-menu absolute bg-white shadow-md rounded-lg mt-2"
                            aria-labelledby="dropdownMenuButton">
                            <li>
                                <input type="text" id="myInput"
                                    class="form-control w-full px-3 py-2 rounded-md border border-gray-300"
                                    placeholder="Search..." onkeyup="filterFunction()">
                            </li>
                            <li><a class="dropdown-item text-black px-4 py-2" href="#about">About</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
        <div class="container mx-auto mt-8">
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white shadow-md rounded-lg border border-gray-200">
                    <thead class="bg-pink-200">
                        <tr>
                            <th class="px-4 py-2 text-left">Baby Name</th>
                            <th class="px-4 py-2 text-left">Date of Birth</th>
                            <th class="px-4 py-2 text-left">Time of Delivery</th>
                            <th class="px-4 py-2 text-left">Type of Delivery</th>
                            <th class="px-4 py-2 text-left">Birth Weight</th>
                            <th class="px-4 py-2 text-left">Birth Length</th>
                            <th class="px-4 py-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='hover:bg-gray-50'>";
                                echo "<td class='px-6 py-4 text-gray-700'>" . $row['babyname'] . "</td>";
                                echo "<td class='px-6 py-4 text-gray-700'>" . $row['baby_dateB'] . "</td>";
                                echo "<td class='px-6 py-4 text-gray-700'>" . $row['time_delivery'] . "</td>";
                                echo "<td class='px-6 py-4 text-gray-700'>" . $row['deliveryType'] . "</td>";
                                echo "<td class='px-6 py-4 text-gray-700'>" . $row['baby_weight'] . "</td>";
                                echo "<td class='px-6 py-4 text-gray-700'>" . $row['baby_length'] . "</td>";
                                echo "<td class='px-6 py-4'>
                                <div class='relative inline-block text-left'>
                                    <button class='text-gray-600 bg-transparent border-none p-2 text-xl' onclick='toggleDropdown(this)'>
                                        <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-three-dots-vertical\" viewBox=\"0 0 16 16\">
                                            <path d=\"M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0m0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0\" />
                                        </svg>
                                    </button>
                                    <div class='hidden absolute right-0 mt-2 w-48 bg-white shadow-lg rounded-md'>
                                        <a href='#' class='block px-4 py-2 text-gray-700 hover:bg-gray-100'>View Medical History</a>
                                        <a href='#' class='block px-4 py-2 text-gray-700 hover:bg-gray-100'>Edit Baby Profile</a>
                                    </div>
                                </div>
                            </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' class='px-6 py-4 text-center text-gray-700'>No records found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            // Toggle dropdown visibility
            function toggleDropdown(button) {
                const dropdown = button.nextElementSibling;
                dropdown.classList.toggle('hidden');
            }
        </script>


    </div>
    <!-- Modal for Adding/Editing User -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-pink-100">
                    <h5 class="modal-title" id="userModalLabel">Add Baby Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- User Form -->
                    <form id="userForm" class="p-6">
                        <div class="space-y-4">
                            <!-- Dropdown for Patient -->
                            <div class="w-full">
                                <div class="relative">
                                    <label for="babyname" class="block mb-2 text-sm font-medium">Mother Name</label>
                                    <button id="selectedPatientBtn"
                                        class="w-full btn btn-secondary dropdown-toggle bg-pink-100 text-black border border-gray-300 py-2 px-4 rounded-md"
                                        type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Select Patient
                                    </button>
                                    <ul class="dropdown-menu w-full bg-white shadow-lg rounded-md border border-gray-300"
                                        id="patientDropdown">
                                        <?php
                                        try {
                                            // Fetch patient names from the database
                                            $query = "SELECT patient_id, first_name, middle_name, last_name FROM patient";
                                            $stmt = $pdo->query($query);

                                            if ($stmt->rowCount() > 0) {
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $fullName = htmlspecialchars($row['first_name']) . ' ' .
                                                        (!empty($row['middle_name']) ? htmlspecialchars($row['middle_name']) . ' ' : '') .
                                                        htmlspecialchars($row['last_name']);
                                                    // Include patient_id as a data attribute for identification
                                                    echo '<li><a class="dropdown-item text-black px-4 py-2 hover:bg-pink-100 cursor-pointer" href="#" data-patient-id="' . $row['patient_id'] . '" data-full-name="' . $fullName . '">' . $fullName . '</a></li>';
                                                }
                                            } else {
                                                echo '<li><span class="dropdown-item text-black px-4 py-2">No patients found</span></li>';
                                            }
                                        } catch (PDOException $e) {
                                            echo '<li><span class="dropdown-item text-danger text-black px-4 py-2">Error: ' . htmlspecialchars($e->getMessage()) . '</span></li>';
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                            <!-- Hidden ID for Patient -->
                            <input type="text" id="patient_id" name="patient_id" class="hidden" value="">

                            <div class="space-y-2">
                                <label for="babyname" class="block text-sm font-medium text-gray-700">Baby Name</label>
                                <input type="text"
                                    class="form-input w-full py-2 px-4 rounded-md border border-gray-300 focus:ring-pink-500"
                                    id="babyname" placeholder="Baby Name" required>
                            </div>

                            <!-- Date of Birth -->
                            <div class="space-y-2">
                                <label for="date" class="block text-sm font-medium text-gray-700">Date of Birth</label>
                                <input type="date"
                                    class="form-input w-full py-2 px-4 rounded-md border border-gray-300 focus:ring-pink-500"
                                    id="date" required>
                            </div>
                        </div>

                        <div class="mt-4 space-y-4">
                            <!-- Time of Delivery -->
                            <div class="space-y-2">
                                <label for="time" class="block text-sm font-medium text-gray-700">Time of
                                    Delivery</label>
                                <input type="time"
                                    class="form-input w-full py-2 px-4 rounded-md border border-gray-300 focus:ring-pink-500"
                                    id="time" required>
                            </div>

                            <!-- Type of Delivery -->
                            <div class="space-y-2">
                                <label for="deliveryType" class="block text-sm font-medium text-gray-700">Type of
                                    Delivery</label>
                                <select
                                    class="form-select w-full py-2 px-4 rounded-md border border-gray-300 focus:ring-pink-500"
                                    id="deliveryType" aria-label="Type of Delivery" required>
                                    <option selected disabled>Choose...</option>
                                    <option value="1">Normal</option>
                                    <option value="2">Cesarean</option>
                                    <option value="3">Assisted</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-4 space-y-4">
                            <!-- Birth Weight -->
                            <div class="space-y-2">
                                <label for="weight" class="block text-sm font-medium text-gray-700">Birth Weight
                                    (kg)</label>
                                <input type="number" step="0.01"
                                    class="form-input w-full py-2 px-4 rounded-md border border-gray-300 focus:ring-pink-500"
                                    id="weight" placeholder="Birth Weight (kg)" required>
                            </div>

                            <!-- Birth Length -->
                            <div class="space-y-2">
                                <label for="length" class="block text-sm font-medium text-gray-700">Birth Length
                                    (cm)</label>
                                <input type="number" step="0.1"
                                    class="form-input w-full py-2 px-4 rounded-md border border-gray-300 focus:ring-pink-500"
                                    id="length" placeholder="Birth Length (cm)" required>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <div class="mt-6">
                            <button type="submit"
                                class="w-full py-2 bg-pink-100 text-black font-bold rounded-md hover:bg-pink-200">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // User Form Submit Handler
        document.getElementById('userForm').addEventListener('submit', function (e) {
            e.preventDefault();
            const userData = {
                username: document.getElementById('username').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value,
                userType: document.getElementById('usertype').value,
                status: document.getElementById('status').value,
            };
            console.log("User Data:", userData);
            alert("User saved successfully!");

            // Close Modal
            const modalEl = document.getElementById('userModal');
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
            modalInstance.hide();
        });


        function toggleTab(event) {
            const button = event.currentTarget; // The clicked button
            const dropdownMenu = button.nextElementSibling; // The dropdown menu next to the button

            // Close all other dropdown menus
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.classList.add('hidden');
                }
            });

            // Toggle the visibility of the clicked dropdown menu
            dropdownMenu.classList.toggle('hidden');
        }


        // Add an event listener for when a patient is selected from the dropdown
        document.querySelectorAll('.dropdown-item').forEach(function (item) {
            item.addEventListener('click', function () {
                // Get the full name and patient id from the data attributes
                var fullName = this.getAttribute('data-full-name');
                var patientId = this.getAttribute('data-patient-id');

                // Update the button text with the selected full name
                document.getElementById('selectedPatientBtn').textContent = fullName;
            });
        });
        // Close the dropdown menu when clicking outside
        document.addEventListener('click', (e) => {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (!menu.contains(e.target) && !menu.previousElementSibling.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
        });



        // Close the dropdown if clicked outside
        window.addEventListener('click', function (event) {
            const dropdowns = document.querySelectorAll('.dropdown-menu');
            dropdowns.forEach(dropdown => {
                if (!dropdown.contains(event.target) && !event.target.closest('.relative')) {
                    dropdown.classList.add('hidden');
                }
            });
        });





        // Select dropdown items and hidden input field
        const patientDropdown = document.getElementById("patientDropdown");
        const selectedPatientBtn = document.getElementById("selectedPatientBtn");
        const patientIdInput = document.getElementById("patient_id");

        // Add event listener to handle dropdown item clicks
        patientDropdown.addEventListener("click", function (e) {
            // Check if a dropdown item was clicked
            if (e.target && e.target.matches("a.dropdown-item")) {
                // Fetch patient name and ID from data attributes
                const fullName = e.target.getAttribute("data-full-name");
                const patientId = e.target.getAttribute("data-patient-id");

                // Update the button text to the selected patient's name
                selectedPatientBtn.textContent = fullName;

                // Set the hidden input value to the selected patient_id
                patientIdInput.value = patientId;

                // Close the dropdown (if needed)
                patientDropdown.classList.remove("show");
            }
        });


    </script>
</body>

</html>