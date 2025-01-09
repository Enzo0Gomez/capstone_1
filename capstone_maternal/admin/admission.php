<?php
include 'session_login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Admission</title>
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Bootstrap CSS -->
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
    <div class="container mx-auto mt-6">

        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Admission</h2>

        <!-- Search Form -->
        <form class="mb-6 flex flex-wrap gap-4 items-center justify-between" role="search">
            <!-- Search Input -->
            <div class="w-full md:w-2/5">
                <input
                    class="w-full p-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400"
                    type="search" placeholder="Search" aria-label="Search">
            </div>
            <!-- Search Button -->
            <div class="w-full md:w-1/4">
                <button
                    class="w-full py-2 px-4 rounded-md bg-pink-200 text-gray-800 font-semibold hover:bg-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-400"
                    type="submit">
                    Search
                </button>
            </div>
            <!-- Add Patient Button -->
            <div class="w-full md:w-1/4 text-right">
                <button
                    class="w-full py-2 px-4 rounded-md bg-pink-200 text-gray-800 font-semibold hover:bg-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-400"
                    data-bs-toggle="modal" data-bs-target="#userModal" type="button">
                    Add Patient
                </button>
            </div>
        </form>

        <!-- Patient Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-center bg-white rounded-md shadow-md">
                <thead class="bg-pink-200 text-gray-800">
                    <tr>
                        <th class="py-2 px-4 border-b">Patient ID</th>
                        <th class="py-2 px-4 border-b">Patient Name</th>
                        <th class="py-2 px-4 border-b">Date</th>
                        <th class="py-2 px-4 border-b">Time</th>
                        <th class="py-2 px-4 border-b">Bed Assignment</th>
                        <th class="py-2 px-4 border-b">Admitting Physician</th>
                        <th class="py-2 px-4 border-b">Reason for Admission</th>
                        <th class="py-2 px-4 border-b">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-100">
                        <td class="py-2 px-4 border-b">12345</td>
                        <td class="py-2 px-4 border-b">John Doe</td>
                        <td class="py-2 px-4 border-b">2024-01-03</td>
                        <td class="py-2 px-4 border-b">10:00 AM</td>
                        <td class="py-2 px-4 border-b">A1</td>
                        <td class="py-2 px-4 border-b">Dr. Smith</td>
                        <td class="py-2 px-4 border-b">Routine Checkup</td>
                        <td class="py-2 px-4 border-b">
                            <div class="flex justify-center items-center space-x-4">
                                <!-- Add to Cart Button -->
                                <button
                                    class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-green-400"
                                    id="addtocart" data-bs-toggle="modal" data-bs-target="#addToCartModal">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
                                        class="bi bi-cart-plus" viewBox="0 0 16 16">
                                        <path
                                            d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9z" />
                                        <path
                                            d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1zm3.915 10L3.102 4h10.796l-1.313 7zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0m7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0" />
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
                <div class="modal-header" style="background-color: #FAD5E1; color:#000;">
                    <h5 class="modal-title" id="userModalLabel">Add Admission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Admission Form -->
                    <form id="admissionForm">
                        <div class="row g-3">
                            <!-- Patient Name -->
                            <div class="col-md-6">
                                <label for="patientName" class="form-label">Patient Name</label>
                                <input type="text" class="form-control" id="patientName"
                                    placeholder="Enter patient name" required>
                            </div>
                            <!-- Date -->
                            <div class="col-md-3">
                                <label for="admissionDate" class="form-label">Date</label>
                                <input type="date" class="form-control" id="admissionDate" required>
                            </div>
                            <!-- Time -->
                            <div class="col-md-3">
                                <label for="admissionTime" class="form-label">Time</label>
                                <input type="time" class="form-control" id="admissionTime" required>
                            </div>
                        </div>
                        <div class="mt-2 row g-3">
                            <!-- Bed Assignment -->
                            <div class="col-md-6">
                                <label for="bedAssignment" class="form-label">Bed Assignment</label>
                                <input type="text" class="form-control" id="bedAssignment"
                                    placeholder="Enter bed assignment" required>
                            </div>
                            <!-- Admitting Physician -->
                            <div class="col-md-6">
                                <label for="admittingPhysician" class="form-label">Admitting Physician</label>
                                <input type="text" class="form-control" id="admittingPhysician"
                                    placeholder="Enter physician name" required>
                            </div>
                        </div>
                        <div class="mt-2 row g-3">
                            <!-- Reason for Admission -->
                            <div class="col-12">
                                <label for="reasonForAdmission" class="form-label">Reason for Admission</label>
                                <input type="comment" class="form-control" id="reasonForAdmission"
                                    placeholder="Enter reason for admission" required>
                            </div>
                        </div>
                        <!-- Save Button -->
                        <div class="mt-3">
                            <button type="submit" class="btn w-100"
                                style="background-color: #FAD5E1; color:#000;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="addToCartModalLabel">Add to Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Add to Cart Form -->
                    <div class="mb-3 row">
                        <div class="col-md-6">
                            <label for="itemSelect" class="form-label">Select Item/Service</label>
                            <select id="itemSelect" class="form-select">
                                <option selected>Select Item/Service</option>
                                <option value="Pap Smear">Pap Smear</option>
                                <option value="Gloves">Gloves</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="quantityInput" class="form-label">Quantity</label>
                            <div class="input-group">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="changeQuantity(-1)">-</button>
                                <input type="number" id="quantityInput" class="text-center form-control" value="1"
                                    min="1">
                                <button class="btn btn-outline-secondary" type="button"
                                    onclick="changeQuantity(1)">+</button>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn w-100" style="background-color: #FAD5E1; color:#000;"
                                onclick="addItem()">ADD</button>
                        </div>
                    </div>

                    <!-- Item/Service Table -->
                    <div class="mt-4 table-responsive">
                        <table class="table text-center align-middle table-bordered table-striped">
                            <thead class="table-light">
                                <tr>
                                    <th>Id</th>
                                    <th>Item/Service</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody id="cartTableBody">
                                <tr>
                                    <td>1</td>
                                    <td>Pap Smear</td>
                                    <td>$80.00</td>
                                    <td>1</td>
                                    <td>$80.00</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm">Remove</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Gloves</td>
                                    <td>$10.00</td>
                                    <td>8</td>
                                    <td>$80.00</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm">Remove</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn" style="background-color: #FAD5E1; color:#000;">Proceed</button>
                </div>
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
        document.querySelectorAll('.tab-link').forEach(link => {
            link.addEventListener('click', function () {
                document.querySelector('.tab-link.active').classList.remove('active');
                this.classList.add('active');
            });
        });


        // Toggle the display of the tab content
        function toggleTab() {
            const tabContent = document.getElementById('tabContent');
            if (tabContent.style.display === "none" || tabContent.style.display === "") {
                tabContent.style.display = "block"; // Show content
            } else {
                tabContent.style.display = "none"; // Hide content
            }
        }
        function changeQuantity(amount) {
            const quantityInput = document.getElementById('quantityInput');
            let quantity = parseInt(quantityInput.value) || 1;
            quantity = Math.max(1, quantity + amount);
            quantityInput.value = quantity;
        }

        function addItem() {
            alert('Item added to cart!');
        }
    </script>

</body>

</html>