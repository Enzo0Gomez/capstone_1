<?php
include 'session_login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Appointment</title>
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
    <div class="container mx-auto mt-6">
        <h2 class="mb-6 text-2xl font-semibold text-center text-gray-800">Appointments</h2>

        <!-- Search and Action Bar -->
        <form class="mb-4 flex flex-wrap gap-2 items-center justify-between" role="search">

            <!-- Add Appointment Button -->
            <div class="w-full md:w-1/4">
                <button
                    class="w-full py-2 px-4 rounded-md bg-pink-200 text-gray-800 font-semibold hover:bg-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-400"
                    data-bs-toggle="modal" data-bs-target="#userModal" type="button">
                    Add Appointment
                </button>
            </div>

            <!-- Filter Dropdown -->
            <div class="w-full md:w-1/4">
                <div class="relative">
                    <button
                        class="w-full py-2 px-4 rounded-md bg-pink-200 text-gray-800 font-semibold hover:bg-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-400 dropdown-toggle"
                        type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter Appointment
                    </button>
                    <ul class="dropdown-menu absolute w-full p-2 mt-1 bg-white border border-gray-300 rounded-md shadow-md hidden"
                        aria-labelledby="dropdownMenuButton">
                        <li>
                            <input type="text" id="myInput" class="w-full p-2 border border-gray-300 rounded-md"
                                placeholder="Search..." onkeyup="filterFunction()">
                        </li>
                        <li><a class="dropdown-item" href="#about">About</a></li>
                    </ul>
                </div>
            </div>
        </form>

        <!-- Appointments Table -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full text-sm text-center bg-white rounded-md shadow-md">
                <thead class="bg-pink-200 text-gray-800">
                    <tr>
                        <th class="py-2 px-4 border-b">Patient Name</th>
                        <th class="py-2 px-4 border-b">Service</th>
                        <th class="py-2 px-4 border-b">Doctor</th>
                        <th class="py-2 px-4 border-b">Time Appointment</th>
                        <th class="py-2 px-4 border-b">Date of Appointment</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">John Doe</td>
                        <td class="py-2 px-4 border-b">Dental Checkup</td>
                        <td class="py-2 px-4 border-b">Dr. Smith</td>
                        <td class="py-2 px-4 border-b">10:00 AM</td>
                        <td class="py-2 px-4 border-b">2024-12-25</td>
                        <td class="py-2 px-4 border-b">
                            <div class="flex justify-evenly">
                                <!-- Approve Button -->
                                <button
                                    class="bg-green-500 hover:bg-green-600 text-white py-1 px-2 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400"
                                    title="Approve">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-check-lg" viewBox="0 0 16 16">
                                        <path
                                            d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425z" />
                                    </svg>
                                </button>
                                <!-- Reject Button -->
                                <button
                                    class="bg-red-500 hover:bg-red-600 text-white py-1 px-2 rounded-md focus:outline-none focus:ring-2 focus:ring-red-400"
                                    title="Reject">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-x-circle" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                        <path
                                            d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                                    </svg>
                                </button>
                                <!-- Edit Button -->
                                <button
                                    class="bg-blue-500 hover:bg-blue-600 text-white py-1 px-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"
                                    title="Edit" data-bs-toggle="modal" data-bs-target="#editModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-pencil" viewBox="0 0 16 16">
                                        <path
                                            d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-9.792 9.792a.5.5 0 0 1-.168.11l-4 1.5a.5.5 0 0 1-.65-.65l1.5-4a.5.5 0 0 1 .11-.168l9.792-9.792zm-8.386 10.21l-.646.647a.5.5 0 0 1-.707 0l-.646-.647 1.293-1.293.707.707 1.293-1.293.646.647-.707.707-1.293 1.293z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>




    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #FAD5E1;">
                    <h5 class="modal-title" id="userModalLabel">Add Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Appointment Form -->
                    <form id="appointmentForm">
                        <div class="row g-3">
                            <!-- Patient Name -->
                            <div class="col-md-6">
                                <label for="patientname" class="form-label">Patient Name</label>
                                <select class="form-select" id="patientname" required>
                                    <option value="" disabled selected>Select Patient</option>
                                    <option value="John Doe">John Doe</option>
                                    <option value="Jane Smith">Jane Smith</option>
                                    <option value="Michael Brown">Michael Brown</option>
                                </select>
                            </div>
                            <!-- Service -->
                            <div class="col-md-6">
                                <label for="services" class="form-label">Services</label>
                                <select class="form-select" id="services" required>
                                    <option value="" disabled selected>Select Service</option>
                                    <option value="Consultation">Consultation</option>
                                    <option value="Dental Cleaning">Dental Cleaning</option>
                                    <option value="Therapy">Therapy</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2 row g-3">
                            <!-- Doctor -->
                            <div class="col-md-6">
                                <label for="doctor" class="form-label">Doctor</label>
                                <select class="form-select" id="doctor" required>
                                    <option value="" disabled selected>Select Doctor</option>
                                    <option value="Dr. Park Sieun">Dr. Park Sieun</option>
                                    <option value="Dr. Bae Sumin">Dr. Bae Sumin</option>
                                    <option value="Dr. Yoon Seeun">Dr. Yoon Seeun</option>
                                </select>
                            </div>
                            <!-- Time of Appointment -->
                            <div class="col-md-6">
                                <label for="appointmentTime" class="form-label">Time of Appointment</label>
                                <input type="time" id="appointmentTime" class="form-control" required>
                            </div>
                        </div>
                        <div class="mt-2 row g-3">
                            <!-- Date of Appointment -->
                            <div class="col-md-12">
                                <label for="appointmentDate" class="form-label">Date of Appointment</label>
                                <input type="date" id="appointmentDate" class="form-control" required>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn w-100"
                                style="background-color: #FAD5E1; color:#000;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #FAD5E1;">
                    <h5 class="modal-title" id="userModalLabel">Edit Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Appointment Form -->
                    <form id="appointmentForm">
                        <div class="row g-3">
                            <!-- Patient Name -->
                            <div class="col-md-6">
                                <label for="patientname" class="form-label">Patient Name</label>
                                <select class="form-select" id="patientname" required>
                                    <option value="" disabled selected>Select Patient</option>
                                    <option value="John Doe">John Doe</option>
                                    <option value="Jane Smith">Jane Smith</option>
                                    <option value="Michael Brown">Michael Brown</option>
                                </select>
                            </div>
                            <!-- Service -->
                            <div class="col-md-6">
                                <label for="services" class="form-label">Services</label>
                                <select class="form-select" id="services" required>
                                    <option value="" disabled selected>Select Service</option>
                                    <option value="Consultation">Consultation</option>
                                    <option value="Dental Cleaning">Dental Cleaning</option>
                                    <option value="Therapy">Therapy</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-2 row g-3">
                            <!-- Doctor -->
                            <div class="col-md-6">
                                <label for="doctor" class="form-label">Doctor</label>
                                <select class="form-select" id="doctor" required>
                                    <option value="" disabled selected>Select Doctor</option>
                                    <option value="Dr. Park Sieun">Dr. Park Sieun</option>
                                    <option value="Dr. Bae Sumin">Dr. Bae Sumin</option>
                                    <option value="Dr. Yoon Seeun">Dr. Yoon Seeun</option>
                                </select>
                            </div>
                            <!-- Time of Appointment -->
                            <div class="col-md-6">
                                <label for="appointmentTime" class="form-label">Time of Appointment</label>
                                <input type="time" id="appointmentTime" class="form-control" required>
                            </div>
                        </div>
                        <div class="mt-2 row g-3">
                            <!-- Date of Appointment -->
                            <div class="col-md-12">
                                <label for="appointmentDate" class="form-label">Date of Appointment</label>
                                <input type="date" id="appointmentDate" class="form-control" required>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn w-100"
                                style="background-color: #FAD5E1; color:#000;">Save</button>
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
                patientname: document.getElementById('patientname').value,
                services: document.getElementById('services').value,
            };
            console.log("User Data:", userData);
            alert("User saved successfully!");

            // Close Modal
            const modalEl = document.getElementById('userModal');
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
            modalInstance.hide();
        });
        document.querySelectorAll('.tab-link').forEach(link => {
            link.addEventListener('click', function () {
                document.querySelector('.tab-link.active').classList.remove('active');
                this.classList.add('active');
            });
        });


        function toggleTab() {
            const tabContent = document.getElementById('tabContent');
            // Toggle display
            if (tabContent.style.display === 'none' || tabContent.style.display === '') {
                tabContent.style.display = 'block';
            } else {
                tabContent.style.display = 'none';
            }
        }
    </script>
</body>

</html>