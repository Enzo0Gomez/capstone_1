<?php
include('../connect/connection.php');
include 'session_login.php';
$sql = "SELECT baby_id, baby_firstname,baby_middlename ,baby_lastname, baby_dateB, time_delivery, deliveryType, baby_weight, baby_length FROM baby_info";
$result = $connect->query($sql);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Use proper connection variable (assuming $conn is the correct one)
    $search = $conn->real_escape_string($_GET['search'] ?? '');

    // Retrieve patient_id based on the search query
    $query = "SELECT id FROM patient WHERE first_name LIKE '%$search%' LIMIT 1"; // Adjust column name 'id' to match your patient table
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $patient_id = $row['id']; // Replace 'id' with the actual column name for patient_id
    } else {
        echo "Error: No matching patient found.";
        exit();
    }

    // Collect baby info from POST request
    $baby_firstname = $conn->real_escape_string($_POST['baby_firstname']);
    $baby_middlename = $conn->real_escape_string($_POST['baby_middlename']);
    $baby_lastname = $conn->real_escape_string($_POST['baby_lastname']);
    $baby_dateB = $conn->real_escape_string($_POST['baby_dateB']);
    $time_delivery = $conn->real_escape_string($_POST['time_delivery']);
    $deliveryType = $conn->real_escape_string($_POST['deliveryType']);
    $baby_weight = $conn->real_escape_string($_POST['baby_weight']);
    $baby_length = $conn->real_escape_string($_POST['baby_length']);

    // SQL query to insert data into baby_info, linking patient_id
    $sql = "INSERT INTO baby_info (patient_id, baby_firstname, baby_middlename, baby_lastname, baby_dateB, time_delivery, deliveryType, baby_weight, baby_length)
            VALUES ('$patient_id', '$baby_firstname', '$baby_middlename', '$baby_lastname', '$baby_dateB', '$time_delivery', '$deliveryType', '$baby_weight', '$baby_length')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!";
        header("Location: babyprofiling.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


$name = isset($_POST['baby_firstname']) ? $connect->real_escape_string($_POST['baby_firstname']) : '';
$type = isset($_POST['deliveryType']) ? $connect->real_escape_string($_POST['deliveryType']) : '';
$date= isset($_POST['baby_dateB']) ? $connect->real_escape_string($_POST['baby_dateB']) : '';

$conditions = [];

if (!empty($name)) {
    $conditions[] = "(first_name LIKE '%$name%' OR middle_name LIKE '%$name%' OR last_name LIKE '%$name%')";
}

if (!empty($type)) {
    $conditions[] = "status = '$type'";
}

if (!empty($date)) {
    $conditions[] = "age = '$date'";
}

$query = "SELECT * FROM baby_info WHERE 1=1"; 

if (count($conditions) > 0) {
    $query .= " AND " . implode(" AND ", $conditions);
}

$result = $connect->query($query);

$name = isset($_POST['baby_firstname']) ? $connect->real_escape_string($_POST['baby_firstname']) : '';
$type = isset($_POST['deliveryType']) ? $connect->real_escape_string($_POST['deliveryType']) : '';
$date= isset($_POST['baby_dateB']) ? $connect->real_escape_string($_POST['baby_dateB']) : '';


$query = "SELECT * FROM baby_info WHERE 1=1"; 

if (!empty($name)) {
    $query .= " AND (first_name LIKE '%$name%' OR middle_name LIKE '%$name%' OR last_name LIKE '%$name%')";
}
if (!empty($type)) {
    $query .= " AND status = '$type'";
}
if (!empty($date)) {
    $query .= " AND age = '$date'";
}

$result = $connect->query($query);

function displayPatientTable($connect, $query)
{
    $result = $connect->query($query);
}

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
                    <div class="relative">
                        <button
                            class="w-full py-2 bg-pink-300 hover:bg-pink-600 text-black font-semibold rounded-lg shadow-md transition-all duration-300"
                            type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Filter Patient
                        </button>
                        <ul class="dropdown-menu absolute right-0 mt-2 w-full md:w-72 bg-white rounded-lg shadow-lg border border-gray-200"
                            aria-labelledby="dropdownMenuButton">
                            <li class="p-3">
                                <input type="text" id="nameFilter" name="name"
                                    value="<?php echo htmlspecialchars($name); ?>"
                                    class="w-full p-2 rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400"
                                    placeholder="Search by Name (First, Middle, Last)...">
                            </li>
                            <li class="p-3">
                                <select id="statusFilter" name="ty"
                                    class="w-full p-2 rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400">
                                    <option value="" disabled <?php echo empty($type) ? 'selected' : ''; ?>>Select Status
                                    </option>
                                    <option value="Normal" <?php echo $status === 'Normal' ? 'selected' : ''; ?>>Normal
                                    </option>
                                    <option value="Cesarean" <?php echo $status === 'Cesarean' ? 'selected' : ''; ?>>Cesarean
                                    </option>
                                    <option value="Assisted" <?php echo $status === 'Assisted' ? 'selected' : ''; ?>>Assisted
                                    </option>
                                </select>
                            </li>
                            <li class="p-3">
                                <input type="number" id="dateFilter" name="baby_dateB" value="<?php echo htmlspecialchars($date); ?>"
                                    class="w-full p-2 rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400"
                                    placeholder="Filter by Date Birthday">
                            </li>
                            <li class="p-3 flex justify-between">
                                <button
                                    class="px-2 py-2 bg-pink-500 hover:bg-pink-600 text-white font-semibold rounded-lg shadow-md"
                                    type="submit" name="filter">
                                    Apply Filters
                                </button>
                                <button
                                    class="px-2 py-2 bg-gray-400 hover:bg-gray-500 text-white font-semibold rounded-lg shadow-md"
                                    type="button" onclick="clearFilters()">
                                    Clear Filters
                                </button>
                            </li>
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
                                $baby_name = $row['baby_firstname'] . ' ' . ($row['baby_middlename'] ? $row['baby_middlename'] . ' ' : '') . $row['baby_lastname'];
                                echo "<tr class='hover:bg-gray-50'>";
                                echo "<td class='px-6 py-4 text-gray-700'>".  $baby_name . "</td>";
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
        <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #FAD5E1;">
                        <h5 class="modal-title" id="userModalLabel">Add Baby Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form -->
                        <form id="userForm" method="POST" onsubmit="console.log('Form is submitting');">
                            <div class="row g-3">
                                    
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" id="firstname" name="baby_firstname" placeholder="Baby First Name" onkeyup="searchBabyName()" required>
                                    <label for="baby_firstname">Baby First Name</label>
                                    <div id="search-results"></div>
                                </div>

                                <!-- Baby First Name -->
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" id="baby_firstname" name="baby_firstname" placeholder="Baby First Name" required>
                                    <label for="baby_firstname">Baby First Name</label>
                                </div>
                                <!-- Baby Middle Name -->
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" id="baby_middlename" name="baby_middlename" placeholder="Baby Middle Name">
                                    <label for="baby_middlename">Baby Middle Name</label>
                                </div>
                                <!-- Baby Last Name -->
                                <div class="col-md-6 form-floating">
                                    <input type="text" class="form-control" id="baby_lastname" name="baby_lastname" placeholder="Baby Last Name" required>
                                    <label for="baby_lastname">Baby Last Name</label>
                                </div>
                                <!-- Date of Birth -->
                                <div class="col-md-6 form-floating">
                                    <input type="date" class="form-control" id="baby_dateB" name="baby_dateB" required>
                                    <label for="baby_dateB">Date of Birth</label>
                                </div>
                            </div>
                            <div class="mt-2 row g-3">
                                <!-- Time of Delivery -->
                                <div class="col-md-6 form-floating">
                                    <input type="time" class="form-control" id="time_delivery" name="time_delivery" required>
                                    <label for="time_delivery">Time of Delivery</label>
                                </div>
                                <!-- Type of Delivery -->
                                <div class="col-md-6 form-floating">
                                    <select class="form-select" id="deliveryType" name="deliveryType" required>
                                        <option selected disabled>Choose...</option>
                                        <option value="Normal">Normal</option>
                                        <option value="Cesarean">Cesarean</option>
                                        <option value="Assisted">Assisted</option>
                                    </select>
                                    <label for="deliveryType">Type of Delivery</label>
                                </div>
                            </div>
                            <div class="mt-2 row g-3">
                                <!-- Birth Weight -->
                                <div class="col-md-6 form-floating">
                                    <input type="number" class="form-control" id="baby_weight" name="baby_weight" placeholder="Birth Weight (kg)" step="0.01" min="0" required>
                                    <label for="baby_weight">Birth Weight (kg)</label>
                                </div>
                                <!-- Birth Length -->
                                <div class="col-md-6 form-floating">
                                    <input type="number" class="form-control" id="baby_length" name="baby_length" placeholder="Birth Length (cm)" step="0.1" min="0" required>
                                    <label for="baby_length">Birth Length (cm)</label>
                                </div>
                            </div>
                            <div class="mt-4">
                                <!-- Save Button -->
                                <button type="submit" name="add" class="btn w-100" style="background-color: #FAD5E1; color:#000;">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        
        // Function to clear filters
        function clearFilters() {
            window.location.href = "babyprofiling.php";
            // Reset text inputs
            document.getElementById('nameFilter').value = '';
            document.getElementById('dateFilter').value = '';
            document.getElementById('statusFilter').selectedIndex = 0;
            document.getElementById('search').submit();
        }
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
            function searchBabyName() {
            const query = document.getElementById('baby_firstname').value;
            const resultsDiv = document.getElementById('search-results');
            resultsDiv.innerHTML = ''; // Clear previous results

            if (query.length > 0) {
                fetch(`search.php?search=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(name => {
                            const div = document.createElement('div');
                            div.textContent = name;
                            resultsDiv.appendChild(div);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }
        }

    </script>
</body>

</html>