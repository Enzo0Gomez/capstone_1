<?php
include('../connect/connection.php');
$sql = "SELECT * FROM announcements ORDER BY date_time DESC";
$result = $connect->query($sql);

include 'session_login.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <!-- Bootstrap CSS -->
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

    <?php include 'tabadmin.php'; ?> <!-- vertical tabs -->

    <!-- Main Content -->
    <div class="container mx-auto mt-6 space-y-2 px-4">
        <!-- Welcome Card -->
        <div class="bg-pink-200 mb-2 p-2 rounded-sm shadow-md text-center">
            <h1 class="text-2xl font-semibold text-gray-800">Welcome, Admin </h1>
            <p class="text-gray-600">Here's an Overview for Today</p>
        </div>

        <!-- Dashboard Sections -->
        <div class="grid grid-cols-1 mt-5 lg:grid-cols-12 gap-6">
            <!-- Announcements Section -->
            <div class="lg:col-span-3 flex justify-center">
                <img src="../image/logo.png" alt="Logo" class="w-48 h-48 object-cover rounded-lg ">
            </div>

            <div class="lg:col-span-5 bg-pink-100 p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Announcements</h3>
                <ul class="space-y-3">
                    <?php
                    // Check if there are any announcements
                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<li class="flex justify-between items-center bg-pink-50 p-4 rounded-lg shadow hover:bg-pink-100 transition-all">';
                            echo '<div>';
                            echo '<p class="font-semibold">' . $row["title"] . '</p>';
                            echo '<p class="text-sm text-gray-600">' . $row["description"] . '</p>';
                            echo '</div>';
                            echo '<span class="text-sm bg-pink-300 text-white px-3 py-1 rounded-full">' . date('h:i A', strtotime($row["date_time"])) . '</span>';
                            echo '<a href="announcement/delete_announcement.php?id=' . $row["id"] . '" class="text-red-500 ml-4 hover:underline">Delete</a>';
                            echo '</li>';
                        }
                    } else {
                        echo '<li class="text-gray-600">No announcements available.</li>';
                    }
                    ?>
                </ul>
                <button
                    class="mt-4 w-full bg-pink-400 text-white font-semibold py-2 rounded-lg shadow hover:bg-pink-500 transition"
                    id="openModal" data-bs-toggle="modal" data-bs-target="#announcementModal">
                    Create Announcements
                </button>
            </div>
        </div>

        <!-- Analytics Section (Moved to Bottom) -->
        <div class="grid grid-cols-1 mt-5 lg:grid-cols-12">
            <div class="lg:col-span-9 grid grid-cols-5 sm:grid-cols-4 gap-6">
                <div class="bg-pink-100 p-6 text-center rounded-lg shadow-md">
                    <h6 class="text-sm text-gray-600">Patients Served</h6>
                    <p class="text-2xl font-bold text-gray-800">120</p>
                </div>
                <div class="bg-pink-100 p-6 text-center rounded-lg shadow-md">
                    <h6 class="text-sm text-gray-600">Expected Patients</h6>
                    <p class="text-2xl font-bold text-gray-800">50</p>
                </div>
                <div class="bg-pink-100 p-6 text-center rounded-lg shadow-md">
                    <h6 class="text-sm text-gray-600">Active Users</h6>
                    <p class="text-2xl font-bold text-gray-800">15</p>
                </div>
                <div class="bg-pink-100 p-6 text-center rounded-lg shadow-md">
                    <h6 class="text-sm text-gray-600">Total Patients</h6>
                    <p class="text-2xl font-bold text-gray-800">170</p>
                </div>
            </div>
        </div>
    </div>



<div class="modal fade" id="announcementModal" tabindex="-1" aria-labelledby="announcementModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #FAD1E8;">
                <h5 class="modal-title" id="announcementModalLabel">Create Announcement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="announcement/save_announcement.php" method="POST">
                    <div class="mb-3 form-floating">
                        <input type="text" class="form-control" id="announcementTitle" name="announcementTitle"
                            placeholder="Title" required>
                        <label for="announcementTitle">Title</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <textarea class="form-control" id="announcementDescription" name="announcementDescription"
                            placeholder="Description" required></textarea>
                        <label for="announcementDescription">Description</label>
                    </div>
                    <div class="mb-3 form-floating">
                        <input type="datetime-local" class="form-control" id="announcementDateTime"
                            name="announcementDateTime" required>
                        <label for="announcementDateTime">Date and Time</label>
                    </div>
                    <button type="submit" class="btn w-100" style="background-color: #FAD5E1;">Save
                        Announcement</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function showTab(tabId) {
        // Handle active button styling
        var allLinks = document.querySelectorAll('.tab-menu .tab-link');
        allLinks.forEach(function (link) {
            link.classList.remove('active');
        });

        // Mark the clicked tab as active
        var activeLink = document.querySelector('.tab-menu .tab-link[onclick="showTab(\'' + tabId + '\')"]');
        if (activeLink) {
            activeLink.classList.add('active');
        }
    }
    document.querySelectorAll('.tab-link').forEach(link => {
        link.addEventListener('click', function () {
            document.querySelector('.tab-link.active').classList.remove('active');
            this.classList.add('active');
        });
    });  // User Form Submit Handler
    document.getElementById('appointmentForm').addEventListener('submit', function (e) {
        e.preventDefault();
        const userData = {
            patientname: document.getElementById('patientname').value,
            services: document.getElementById('services').value,
            doctor: document.getElementById('doctor').value,
            appointmentTime: document.getElementById('appointmentTime').value,
            appointmentDate: document.getElementById('appointmentDate').value,
        };
        console.log("Appointment Data:", userData);
        alert("Appointment saved successfully!");

        const modalEl = document.getElementById('userModal');
        const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
        modalInstance.hide();
    });

    // No custom modal handling is needed because Bootstrap manages it automatically.
    document.addEventListener('DOMContentLoaded', function () {
        // Add any additional custom event handlers here if needed
        console.log('Page is fully loaded and ready.');
    });
    function toggleSubMenu(button) {
        const subMenu = button.nextElementSibling;
        const isVisible = subMenu.style.display === 'block';

        document.querySelectorAll('.sub-menu').forEach(menu => menu.style.display = 'none');
        subMenu.style.display = isVisible ? 'none' : 'block';
    }
</script>

</body>

</html>