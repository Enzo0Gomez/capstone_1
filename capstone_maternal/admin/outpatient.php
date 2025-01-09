<?php
include 'session_login.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Outpatient</title>
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <!-- Bootstrap CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
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

        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Outpatient</h2>

        <!-- Search Form -->
        <form class="mb-6 flex flex-wrap gap-1 items-center justify-between" role="search">
            <!-- Search Input -->
            <div class="w-full md:w-2/5 flex items-right gap-2">
                <!-- Search Input -->
                <input
                    class="w-full p-2 rounded-md border border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400"
                    type="search" placeholder="Search" aria-label="Search">

                <!-- Search Button -->
                <button
                    class="py-2 px-4 rounded-md bg-pink-200 text-gray-800 font-semibold hover:bg-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-400"
                    type="submit">
                    Search
                </button>
            </div>

            <div class="w-40  text-right">
                <button
                    class="w-full py-2 px-4 rounded-md bg-pink-200 text-gray-800 font-semibold hover:bg-pink-200 focus:outline-none focus:ring-2 focus:ring-pink-400"
                    data-bs-toggle="modal" data-bs-target="#userModal" type="button">
                    Add Patient
                </button>
            </div>
        </form>
        <!-- User Table -->
        <div class="w-full">
            <table class="min-w-full text-sm text-center bg-white rounded-md shadow-md">
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
                            <div class="relative">
                                <!-- Dropdown Button -->
                                <button class="bg-transparent text-gray-800 text-lg font-semibold focus:outline-none"
                                    type="button" onclick="toggleTab()">
                                    ...
                                </button>
                                <!-- Dropdown Menu -->
                                <div class="absolute hidden bg-pink-100 text-left w-40 rounded-md shadow-lg"
                                    id="tabContent">
                                    <ul class="mb-0 list-none">
                                        <li><a class="dropdown-item text-black py-2 px-4 block" href="#"
                                                data-bs-toggle="modal" data-bs-target="#billingModal">
                                                <i class="bi bi-person"></i> Patient Bill</a>
                                        </li>
                                        <li><a class="dropdown-item text-black py-2 px-4 block" href="#"
                                                data-bs-toggle="modal" data-bs-target="#addToCartModal">
                                                <i class="bi bi-cart"></i> Add Item/Service Medicine</a>
                                        </li>
                                        <li><a class="dropdown-item text-black py-2 px-4 block" href="#">
                                                <i class="bi bi-calendar-plus"></i> View</a>
                                        </li>
                                        <li><a class="dropdown-item text-black py-2 px-4 block" href="#">
                                                <i class="bi bi-heart"></i> Transaction</a>
                                        </li>
                                    </ul>
                                </div>
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
                <div class="modal-header " style="background-color: #FAD5E1;">
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

    <!-- Add to Cart Modal -->
    <div class="modal fade" id="addToCartModal" tabindex="-1" aria-labelledby="addToCartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title" id="addToCartModalLabel">Add to Cart</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
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
                            <button class="btn btn-primary w-100" onclick="addItem()">ADD</button>
                        </div>
                    </div>

                    <!-- Item/Service Table -->
                    <div>
                        <h6 class="text-muted">Item/Service</h6>
                        <table class="table text-center align-middle table-bordered">
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
                                    <td><button class="btn btn-danger btn-sm">Remove</button></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Gloves</td>
                                    <td>$10.00</td>
                                    <td>8</td>
                                    <td>$80.00</td>
                                    <td><button class="btn btn-danger btn-sm">Remove</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Proceed</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Patient Billing Modal -->
    <div class="modal fade" id="billingModal" tabindex="-1" aria-labelledby="billingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="billingModalLabel">Viewing Patient Total Billing</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="price-breakdown">
                        <div class="mb-2 d-flex justify-content-between">
                            <span>Order # 123456789</span>
                            <span>Date: 02.14.2024</span>
                        </div>
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <th>Services Applied</th>
                                    <td class="text-end">$500.00</td>
                                </tr>
                                <tr>
                                    <td> &nbsp; Pap Smear</td>
                                    <td class="text-end">$500.00</td>
                                </tr>
                                <tr>
                                    <th>Item Name</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td> &nbsp; Syringe 1x</td>
                                    <td class="text-end">$5.00</td>
                                </tr>
                                <tr>
                                    <td> &nbsp; Gloves 10x</td>
                                    <td class="text-end">$10.00</td>
                                </tr>
                                <tr>
                                    <th>Medicine Name</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td> &nbsp; Cephalexin 1x</td>
                                    <td class="text-end">$5.00</td>
                                </tr>
                                <tr>
                                    <td> &nbsp; Vitamin C 1x</td>
                                    <td class="text-end">$10.00</td>
                                </tr>
                                <tr class="border-top">
                                    <th class="total-bill">Total Bill</th>
                                    <td class="text-end total-bill">$1030.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-pink" data-bs-dismiss="modal">Print</button>
                    <button type="button" class="btn btn-pink" data-bs-toggle="modal"
                        data-bs-target="#paymentModal">Payment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="mb-3 d-flex justify-content-between">
                        <span class="label">Total Bill</span>
                        <span>$1030.00</span>
                    </div>
                    <div class="mb-3">
                        <label for="paymentMode" class="label">Mode of Payment</label>
                        <select id="paymentMode" class="form-select">
                            <option value="gcash">GCash</option>
                            <option value="cash">Cash</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cashPayment" class="label">Cash Payment</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="text" id="cashPayment" class="form-control" placeholder="Enter cash amount">
                        </div>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <span class="label">Reference No.</span>
                        <span class="fw-bold">109405090090</span>
                    </div>
                    <div class="mb-3 d-flex justify-content-between">
                        <span class="label">Change</span>
                        <span id="changeAmount">$20.00</span>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-pink" data-bs-toggle="modal"
                        data-bs-target="#paymentconfirmationModal">Proceed to Payment</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="paymentconfirmationModal" tabindex="-1" aria-labelledby="paymentconfirmationModal"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="paymentconfirmationModal">Payment Confirmation Bill Breakdown</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="price-breakdown">
                        <div class="mb-2 d-flex justify-content-between">
                            <span>Order # 123456789</span>
                            <span>Date: 02.14.2024</span>
                        </div>
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <th>Services Applied</th>
                                    <td class="text-end">$500.00</td>
                                </tr>
                                <tr>
                                    <td> &nbsp; Pap Smear</td>
                                    <td class="text-end">$500.00</td>
                                </tr>
                                <tr>
                                    <th>Item Name</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td> &nbsp; Syringe 1x</td>
                                    <td class="text-end">$5.00</td>
                                </tr>
                                <tr>
                                    <td> &nbsp; Gloves 10x</td>
                                    <td class="text-end">$10.00</td>
                                </tr>
                                <tr>
                                    <th>Medicine Name</th>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td> &nbsp; Cephalexin 1x</td>
                                    <td class="text-end">$5.00</td>
                                </tr>
                                <tr>
                                    <td> &nbsp; Vitamin C 1x</td>
                                    <td class="text-end">$10.00</td>
                                </tr>
                                <tr class="border-top">
                                    <th class="total-bill">Sub Total Bill</th>
                                    <td class="text-end total-bill">$1030.00</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="modal-body">
                            <div class="mb-3 d-flex justify-content-between">
                                <span class="label">Total Bill</span>
                                <span>$1030.00</span>
                            </div>
                            <div class="mb-3">
                                <label for="paymentMode" class="label">Mode of Payment</label>
                                <select id="paymentMode" class="form-select">
                                    <option value="gcash">GCash</option>
                                    <option value="cash">Cash</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cashPayment" class="label">Cash Payment</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="cashPayment" class="form-control"
                                        placeholder="Enter cash amount">
                                </div>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <span class="label">Reference No.</span>
                                <span class="fw-bold">109405090090</span>
                            </div>
                            <div class="mb-3 d-flex justify-content-between">
                                <span class="label">Change</span>
                                <span id="changeAmount">$20.00</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-pink" data-bs-dismiss="modal">Confirm</button>
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
        //add item/services/medicine
        function changeQuantity(amount) {
            const quantityInput = document.getElementById('quantityInput');
            let value = parseInt(quantityInput.value) + amount;
            quantityInput.value = value > 0 ? value : 1;
        }

        function addItem() {
            alert('Item added to the table (Implement JS logic to append).');
        }
    </script>

</body>

</html>