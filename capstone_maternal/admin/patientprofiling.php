<?php
include('../connect/connection.php');
include 'session_login.php';
// Add Patient Profile
if (isset($_POST['add_patient'])) {

    // Retrieve form data
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $date_of_birth = $_POST['date_of_birth'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $status = $_POST['status'];
    $email = $_POST['email'];
    $home_address = $_POST['home_address'];
    $contact_no = $_POST['contact_no'];

    // Insert query
    $query = "INSERT INTO patient (first_name, middle_name, last_name, date_of_birth, age, sex, status, email, home_address, contact_no) 
              VALUES ('$first_name', '$middle_name', '$last_name', '$date_of_birth', '$age', '$sex', '$status', '$email', '$home_address', '$contact_no')";

    if (mysqli_query($connect, $query)) {

        echo "<script>alert('Patient added successfully!');</script>";
        // Redirect to patient table
        header("Location: patientprofiling.php");
    } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
    }
    // Redirect to patient table
    header("Location: patientprofiling.php");
}

// Update Patient
if (isset($_POST['update_patient'])) {

    $patient_id = $_POST['patient_id'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $status = $_POST['status'];
    $date_of_birth = $_POST['date_of_birth'];
    $contact_no = $_POST['contact_no'];
    $home_address = $_POST['home_address'];

    $sql = "UPDATE patient SET 
    first_name = '$first_name',
    middle_name = '$middle_name',
    last_name = '$last_name',
    age = $age,
    sex = '$sex',
    status = '$status',
    date_of_birth = '$date_of_birth',
    contact_no = '$contact_no',
    home_address = '$home_address' 
    WHERE patient_id = '$patient_id'";

    if ($connect->query($sql) === TRUE) {
        echo "<script>alert('Patient updated successfully!');</script>";
        // Redirect to patient table
        header("Location: patientprofiling.php");
    } else {
        echo "<script>alert('Error: " . $connect->error . "');</script>";
    }

    // Redirect to patient table
    header("Location: patientprofiling.php");
    exit();
}

// Upload CSV
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) {
    if ($_FILES['csv_file']['error'] === UPLOAD_ERR_OK) {
        $file = fopen($_FILES['csv_file']['tmp_name'], 'r');
        // Skip the header row
        fgetcsv($file);

        while (($data = fgetcsv($file, 1000, ",")) !== FALSE) {
            $sql = "INSERT INTO patient (first_name, middle_name, last_name, date_of_birth, age, sex, status, email, home_address, contact_no) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute($data);
        }

        fclose($file);
        echo "<script>alert('CSV data imported successfully!');</script>";
    } else {
        echo "<script>alert('Error uploading file.');</script>";
    }
}

// Initialize filter variables
$name = isset($_POST['name']) ? $connect->real_escape_string($_POST['name']) : '';
$status = isset($_POST['status']) ? $connect->real_escape_string($_POST['status']) : '';
$age = isset($_POST['age']) ? $connect->real_escape_string($_POST['age']) : '';

// Filter Logic
$conditions = [];

// Filter by name (First, Middle, Last)
if (!empty($name)) {
    $conditions[] = "(first_name LIKE '%$name%' OR middle_name LIKE '%$name%' OR last_name LIKE '%$name%')";
}

// Filter by status
if (!empty($status)) {
    $conditions[] = "status = '$status'";
}

// Filter by age
if (!empty($age)) {
    $conditions[] = "age = '$age'";
}

// Build the query
$query = "SELECT * FROM patient WHERE 1=1"; // 1=1 to ensure valid query even without filters

// Append conditions to the query
if (count($conditions) > 0) {
    $query .= " AND " . implode(" AND ", $conditions);
}

// Execute the query
$result = $connect->query($query);

// Filter Logic
/// Initialize filter variables
$name = isset($_POST['name']) ? $connect->real_escape_string($_POST['name']) : '';
$status = isset($_POST['status']) ? $connect->real_escape_string($_POST['status']) : '';
$age = isset($_POST['age']) ? $connect->real_escape_string($_POST['age']) : '';

// Build the query
$query = "SELECT * FROM patient WHERE 1=1"; // Default to include all rows

// Add conditions if filters are applied
if (!empty($name)) {
    $query .= " AND (first_name LIKE '%$name%' OR middle_name LIKE '%$name%' OR last_name LIKE '%$name%')";
}
if (!empty($status)) {
    $query .= " AND status = '$status'";
}
if (!empty($age)) {
    $query .= " AND age = '$age'";
}

// Execute the query
$result = $connect->query($query);

// Function to display the patient table
function displayPatientTable($connect, $query)
{
    $result = $connect->query($query);
}
// Archive User
if (isset($_POST['patient_id'])) {
    $id = $_POST['patient_id'];

    $sql_insert = "INSERT INTO archive_patient
(patient_id, first_name, middle_name, last_name, date_of_birth, age, sex, status, email, home_address, contact_no)
SELECT patient_id, first_name, middle_name, last_name, date_of_birth, age, sex, status, email, home_address, contact_no
FROM patient WHERE patient_id = ?";
    $stmt_insert = $connect->prepare($sql_insert);
    $stmt_insert->bind_param("i", $id);
    if (!$stmt_insert->execute()) {
        die("ERROR: " . $stmt_insert->error);
    }

    $sql_delete = "DELETE FROM patient WHERE patient_id = ?";
    $stmt_delete = $connect->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id);
    if (!$stmt_delete->execute()) {
        die("ERROR: " . $stmt_delete->error);
    }

    header("Location: patientprofiling.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Patient Profiling</title>
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <!-- Bootstrap CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Header -->
    <header class="px-4 py-2 bg-gradient-to-r from-pink-300 to-pink-200 shadow-md flex justify-between items-center">
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
        <h2 class="text-3xl font-semibold text-center text-gray-800 mb-6">Patient Profiling</h2>

        <!-- Filter Section -->
        <form class="mb-8" role="search" method="POST" action="patientprofiling.php">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <button
                    class="btn w-25 md:w-1/1 py-2 bg-pink-200 hover:bg-pink-500 text-black font-semibold rounded-lg shadow-md transition-all duration-300"
                    data-bs-toggle="modal" data-bs-target="#userModal" type="button">
                    Add User
                </button>
                <div class="text-end">
                    <div class="relative flex items-center">
                        <button
                            class="btn w-45 md:w-auto py-2 bg-pink-200 hover:bg-pink-500 text-black font-semibold rounded-lg shadow-md transition-all duration-300"
                            data-bs-toggle="modal" data-bs-target="#csvModal" type="button">
                            Add Bulk
                        </button>
                        <button
                            class="btn w-45 md:w-auto py-2 bg-pink-200 hover:bg-pink-500 text-black font-semibold rounded-lg shadow-md transition-all duration-300 ml-auto"
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
                                <select id="statusFilter" name="status"
                                    class="w-full p-2 rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400">
                                    <option value="" disabled <?php echo empty($status) ? 'selected' : ''; ?>>Select
                                        Status
                                    </option>
                                    <option value="Single" <?php echo $status === 'Single' ? 'selected' : ''; ?>>Single
                                    </option>
                                    <option value="Married" <?php echo $status === 'Married' ? 'selected' : ''; ?>>Married
                                    </option>
                                    <option value="Divorced" <?php echo $status === 'Divorced' ? 'selected' : ''; ?>>
                                        Divorced
                                    </option>
                                    <option value="Widowed" <?php echo $status === 'Widowed' ? 'selected' : ''; ?>>Widowed
                                    </option>
                                </select>
                            </li>
                            <li class="p-3">
                                <input type="number" id="ageFilter" name="age"
                                    value="<?php echo htmlspecialchars($age); ?>"
                                    class="w-full p-2 rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400"
                                    placeholder="Filter by Age...">
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

        <!-- Patient Table -->
        <div class="container">
            <table class="min-w-full bg-white shadow-md rounded-lg border border-gray-200">
                <thead class="bg-pink-100 text-black">
                    <tr>
                        <th class="px-4 py-2 text-left">Patient Name</th>
                        <th class="px-4 py-2 text-left">Date of Birth</th>
                        <th class="px-4 py-2 text-left">Age</th>
                        <th class="px-4 py-2 text-left">Sex</th>
                        <th class="px-4 py-2 text-left">Contact</th>
                        <th class="px-4 py-2 text-left">Address</th>
                        <th class="px-4 py-2 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php
                    $showModal = false;
                    if ($result->num_rows > 0) {
                        // Start rendering the table rows
                        while ($row = $result->fetch_assoc()) {
                            $fullName = $row['first_name'] . ' ' . ($row['middle_name'] ? $row['middle_name'] . ' ' : '') . $row['last_name'];
                            $dob = $row['date_of_birth'];
                            $age = $row['age'];
                            $sex = ucfirst($row['sex']);
                            $contact = $row['contact_no'];
                            $address = $row['home_address'];
                            $patient_id = $row['patient_id'];


                            // Check if patient health records exist
                            $queryHealthRecords = "SELECT * FROM patient_health_records WHERE patient_id = ?";
                            $stmtHealth = $connect->prepare($queryHealthRecords);
                            $stmtHealth->bind_param("i", $patient_id);
                            $stmtHealth->execute();
                            $healthRecordsResult = $stmtHealth->get_result();
                            $showModal = true;

                            // Debugging output
                            if (!$healthRecordsResult) {
                                die("Error in query: " . $connect->error);
                            }
                            // Determine link behavior
                            if ($healthRecordsResult->num_rows > 0) {
                                // Link to medical_history_view.php
                                $patientHistoryLink = "<a class='block px-4 py-2 hover:bg-gray-100' href='patient_profile_action/medical_history/medical_history_table.php?patient_id=$patient_id'>Patient History</a>";
                            } else {
                                // Link triggers the modal
                                $patientHistoryLink = "<a class='block px-4 py-2 hover:bg-gray-100' href='#' data-bs-toggle='modal' data-bs-target='#patientHistoryModal'>Patient History</a>";
                            }
                            $stmtHealth->close();

                            echo "
                            <tr class='border-b'>
                                <td class='px-4 py-2 text-gray-700'>$fullName</td>
                                <td class='px-4 py-2 text-gray-700'>$dob</td>
                                <td class='px-4 py-2 text-gray-700'>$age</td>
                                <td class='px-4 py-2 text-gray-700'>$sex</td>
                                <td class='px-4 py-2 text-gray-700'>$contact</td>
                                <td class='px-4 py-2 text-gray-700'>$address</td>
                                <td class='px-4 py-2'>
                                    <div class='relative'>
                                        <button class='bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2' type='button' onclick='toggleDropdown(this)'>
                                            Actions
                                        </button>
                                        <div class='hidden absolute right-0 mt-2 w-48 bg-white rounded shadow-md z-10' data-dropdown>
                                            <ul class='text-sm text-gray-700'>
                                                <li><a class='block px-4 py-2 hover:bg-gray-100' href='patient_profile_action/patient_information.php?patient_id=$patient_id'>Patient Information</a></li>
                                                <li>
                                                    <a class='block px-4 py-2 hover:bg-gray-100' href='#' data-bs-toggle='modal' data-bs-target='#editModal'
                                                        onclick='openEditModal({
                                                            patient_id: \"$patient_id\",
                                                            first_name: \"{$row['first_name']}\",
                                                            middle_name: \"{$row['middle_name']}\",
                                                            last_name: \"{$row['last_name']}\",
                                                            email: \"{$row['email']}\",
                                                            date_of_birth: \"{$row['date_of_birth']}\",
                                                            age: \"{$row['age']}\",
                                                            sex: \"{$row['sex']}\",
                                                            status: \"{$row['status']}\",
                                                            contact_no: \"{$row['contact_no']}\",
                                                            home_address: \"{$row['home_address']}\"
                                                        })'>
                                                        Edit Profile
                                                    </a>
                                                </li>
                                                <li><form action='patientprofiling.php' method='POST'>
                                                    <input type='hidden' id='archive' name='patient_id' value='$patient_id'>
                                                        <button type='submit' class='block px-4 py-2 hover:bg-gray-100'>
                                                            Archive
                                                        </button>
                                                    </form>
                                                </li>
                                                <li><a class='block px-4 py-2 hover:bg-gray-100' href='#' data-bs-toggle='modal' data-bs-target='#transactionHistoryModal'>Transaction History</a></li>
                                                <li>$patientHistoryLink</li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                        }
                    } else {
                        // If no records found
                        echo "<tr><td colspan='7' class='px-4 py-2 text-center text-gray-500'>No patient data available.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!--Transaction  Modal -->
    <div class="modal fade" id="transactionHistoryModal" tabindex="-1" aria-labelledby="transactionHistoryLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionHistoryLabel">Transaction History</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Transaction Table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Service Type</th>
                                <th>Items Used</th>
                                <th>Medicine Used</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>001</td>
                                <td>Pap Smear</td>
                                <td>Gloves, Syringe</td>
                                <td>Ibuprofen</td>
                                <td>March 09, 2024</td>
                                <td>10:00 AM</td>
                                <td>Paid</td>
                                <td>
                                    <button data-bs-toggle="modal" data-bs-target="#billingModal"> View</button>
                                </td>
                            </tr>
                            <!-- Add more rows as needed -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--Add Patient Modal -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header" style="background-color: #FAD5E1;">
                    <h5 class="modal-title" id="userModalLabel">Add Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Patient Form -->
                    <form id="userForm" method="POST">
                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        placeholder="First Name" required>
                                    <label for="first_name">First Name</label>
                                </div>
                            </div>
                            <!-- Middle Name -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="middle_name" id="middle_name"
                                        placeholder="Middle Name">
                                    <label for="middle_name">Middle Name</label>
                                </div>
                            </div>
                            <!-- Last Name -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                        placeholder="Last Name" required>
                                    <label for="last_name">Last Name</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                        placeholder="Date of Birth" required>
                                    <label for="date_of_birth">Date of Birth</label>
                                </div>
                            </div>
                            <!-- Age -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="number" class="form-control" name="age" id="age" placeholder="Age"
                                        required>
                                    <label for="age">Age</label>
                                </div>
                            </div>
                            <!-- Date of Birth -->

                            <!-- Sex -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select class="form-select" name="sex" id="sex" required>
                                        <option value="" disabled selected>Select...</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <label for="sex">Sex</label>
                                </div>
                            </div>
                            <!-- Civil Status -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <select class="form-select" name="status" id="status" required>
                                        <option value="" disabled selected>Select...</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Divorced">Divorced</option>
                                    </select>
                                    <label for="status">Civil Status</label>
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control" name="home_address" id="home_address"
                                        placeholder="Address" required>
                                    <label for="home_address">Address</label>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="email" name="email" id="email" class="form-control"
                                        placeholder="Email Address" required>
                                    <label for="email">Email Address</label>
                                </div>
                            </div>
                            <!-- Phone Number -->
                            <div class="col-md-4">
                                <div class="form-floating">
                                    <input type="text" id="contact_no" name="contact_no" class="form-control"
                                        placeholder="Phone Number" required>
                                    <label for="contact_no">Phone Number</label>
                                </div>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button type="submit" name="add_patient" class="btn w-100"
                                style="background-color: #FAD5E1;" form="userForm">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Patient Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header bg-pink border-0 " style="background-color: #FAD5E1;">
                    <h5 class="modal-title" id="editModalLabel">Edit Patient</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Patient Form -->
                    <form id="editPatientForm" method="POST">
                        <!-- Hidden field for patient ID -->
                        <input type="hidden" id="edit-patient-id" name="patient_id">
                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" id="edit-firstname" name="first_name"
                                    placeholder="First Name" required>
                                <label for="edit-firstname">First Name</label>
                            </div>
                            <!-- Middle Name -->
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" id="edit-middlename" name="middle_name"
                                    placeholder="Middle Name" required>
                                <label for="edit-middlename">Middle Name</label>
                            </div>
                            <!-- Last Name -->
                            <div class="col-md-6 form-floating">
                                <input type="text" class="form-control" id="edit-lastname" name="last_name"
                                    placeholder="Last Name" required>
                                <label for="edit-lastname">Last Name</label>
                            </div>
                            <!-- Email -->
                            <div class="col-md-6 form-floating">
                                <input type="email" class="form-control" id="edit-email" name="email"
                                    placeholder="Email Address" required>
                                <label for="edit-email">Email Address</label>
                            </div>
                            <!-- Age -->
                            <div class="col-md-6 form-floating">
                                <input type="number" class="form-control" id="edit-age" name="age" placeholder="Age"
                                    required>
                                <label for="edit-age">Age</label>
                            </div>
                            <!-- Date of Birth -->
                            <div class="col-md-6 form-floating">
                                <input type="date" class="form-control" id="edit-date-of-birth" name="date_of_birth"
                                    placeholder="Date of Birth" required>
                                <label for="edit-date-of-birth">Date of Birth</label>
                            </div>
                            <!-- Sex -->
                            <div class="col-md-6 form-floating">
                                <select class="form-select" id="edit-sex" name="sex" required>
                                    <option value="" disabled selected>Select...</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                                <label for="edit-sex">Sex</label>
                            </div>
                            <!-- Civil Status -->
                            <div class="col-md-6 form-floating">
                                <select class="form-select" id="edit-status" name="status" required>
                                    <option value="" disabled selected>Select...</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                                <label for="edit-status">Civil Status</label>
                            </div>
                            <!-- Contact -->
                            <div class="col-md-6 form-floating">
                                <input type="tel" class="form-control" id="edit-contact" name="contact_no"
                                    placeholder="Contact" required>
                                <label for="edit-contact">Contact</label>
                            </div>
                            <!-- Address -->
                            <div class="col-md-12 form-floating">
                                <input type="text" class="form-control" id="edit-address" name="home_address"
                                    placeholder="Address" required>
                                <label for="edit-address">Address</label>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="mt-4">
                            <button name="update_patient" type="submit" class="btn  w-100"
                                style="background-color: #FAD5E1;">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Transcation History Modal -->
    <div class="modal fade" id="billingModal" tabindex="-1" aria-labelledby="billingModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header" style="background-color: #FAD5E1; color:#000;">
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
                    <button type="button" class="btn" style="background-color: #FAD5E1; color:#000;"
                        data-bs-dismiss="modal">Print</button>
                    <button type="button" class="btn" style="background-color: #FAD5E1; color:#000;"
                        data-bs-toggle="modal" data-bs-target="#paymentModal">Payment</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Upload CSV Modal -->
    <div class="modal fade" id="csvModal" tabindex="-1" aria-labelledby="csvModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="csvModalLabel">Upload CSV File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="csv_file" class="form-label">Select CSV File</label>
                            <input type="file" class="form-control" id="csv_file" name="csv_file" accept=".csv"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if ($showModal): ?>
        <!-- Modal for creating new health record -->
        <div class="modal fade" id="patientHistoryModal" tabindex="-1" aria-labelledby="patientHistoryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="patientHistoryModalLabel">Add Patient Health Record</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        No existing health record found for this patient. Do you want to create a new health record?
                    </div>
                    <div class="modal-footer">
                        <a href="patient_profile_action/medical_history/medical_history_add.php?patient_id=<?= htmlspecialchars($patient_id) ?>"
                            class="btn btn-success">Yes</a>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Automatically show the modal using Bootstrap JS
            const modal = new bootstrap.Modal(document.getElementById('patientHistoryModal'));
            modal.show();
        </script>
    <?php endif; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleDropdown(button) {
            // Get the parent element of the button
            const parent = button.closest('.relative');
            // Find the dropdown within the parent
            const dropdown = parent.querySelector('[data-dropdown]');

            // Toggle the dropdown visibility
            dropdown.classList.toggle('hidden');
        }

        // Optional: Close the dropdown when clicking outside
        document.addEventListener('click', (event) => {
            const dropdowns = document.querySelectorAll('[data-dropdown]');
            dropdowns.forEach((dropdown) => {
                if (!dropdown.contains(event.target) && !dropdown.previousElementSibling.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        });

        // Function to clear filters
        function clearFilters() {
            window.location.href = "patientprofiling.php";
            // Reset text inputs
            document.getElementById('nameFilter').value = '';
            document.getElementById('ageFilter').value = '';
            document.getElementById('statusFilter').selectedIndex = 0;
            document.getElementById('search').submit();
        }

        function openEditModal(patient) {
            // Populate modal fields with patient data
            document.getElementById('edit-patient-id').value = patient.patient_id; // Patient ID
            document.getElementById('edit-firstname').value = patient.first_name; // First Name
            document.getElementById('edit-middlename').value = patient.middle_name; // Middle Name
            document.getElementById('edit-lastname').value = patient.last_name; // Last Name
            document.getElementById('edit-email').value = patient.email; // Last Name
            document.getElementById('edit-age').value = patient.age; // Age
            document.getElementById('edit-date-of-birth').value = patient.date_of_birth; //
            document.getElementById('edit-sex').value = patient.sex; // Sex
            document.getElementById('edit-status').value = patient.status; // Civil Status
            document.getElementById('edit-contact').value = patient.contact_no; // Contact
            document.getElementById('edit-address').value = patient.home_address; // Address
        }
        function setUserId(userId) {
            document.getElementById('archive').value = userId;
        }

    </script>

</body>

</html>