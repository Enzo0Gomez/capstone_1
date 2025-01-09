<?php
include('../connect/connection.php');
include 'session_login.php';
// Add User
if (isset($_POST['add_user'])) {

  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmpassword = $_POST["confirmpassword"];
  $usertype = $_POST['usertype'];
  $status = $_POST['status'];

  // Check if the email already exists
  $check_query = mysqli_query($connect, "SELECT * FROM user WHERE email ='$email'");
  $rowCount = mysqli_num_rows($check_query);

  if (!empty($email) && !empty($password)) {
    if ($rowCount > 0) {
      echo "<script>alert('User with email already exists!');</script>";
    } elseif ($password !== $confirmpassword) {
      echo "<script>alert('Passwords do not match. Please try again.');</script>";
    } else {
      // Hash the password
      $password_hash = password_hash($password, PASSWORD_BCRYPT);

      // Insert into `user` table
      $userQuery = "INSERT INTO user (email, password, status, user_type) VALUES ('$email', '$password_hash', '$status', '$usertype')";
      if (mysqli_query($connect, $userQuery)) {
        echo "<script>alert('User added successfully!');</script>";
      } else {
        echo "<script>alert('Error: " . mysqli_error($connect) . "');</script>";
      }
    }
  }

  // Redirect back to the user management page
  header("Location: usermanagement.php");
  exit();
}

// Update User
if (isset($_POST['update_user'])) {
  include('../connect/connection.php'); // Ensure database connection

  $user_id = $_POST['user_id'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $usertype = $_POST['usertype'];
  $status = $_POST['status'];

  $sql = "UPDATE user SET 
              email = '$email',
              user_type = '$usertype',
              status = '$status'";

  // Only update the password if a new one is provided
  if (!empty($password)) {
    $password_hash = password_hash($password, PASSWORD_BCRYPT);
    $sql .= ", password = '$password_hash'";
  }

  $sql .= " WHERE user_id = $user_id";

  // Execute the query
  if ($connect->query($sql) === TRUE) {
    echo "<script>alert('User updated successfully!');</script>";
  } else {
    echo "<script>alert('Error: " . $connect->error . "');</script>";
  }

  // Redirect back to the user management page
  header("Location: usermanagement.php");
  exit();
}

// Archive User
if (isset($_POST['user_id'])) {
  $id = $_POST['user_id'];

  $sql_insert = "INSERT INTO archive_user
                  (user_id, email, password, user_type, status)
                  SELECT user_id, email, password, user_type, status
                  FROM user WHERE user_id = ?";
  $stmt_insert = $connect->prepare($sql_insert);
  $stmt_insert->bind_param("i", $id);
  if (!$stmt_insert->execute()) {
    die("ERROR: " . $stmt_insert->error);
  }

  $sql_delete = "DELETE FROM user WHERE user_id = ?";
  $stmt_delete = $connect->prepare($sql_delete);
  $stmt_delete->bind_param("i", $id);
  if (!$stmt_delete->execute()) {
    die("ERROR: " . $stmt_delete->error);
  }

  header("Location: usermanagement.php");
  exit;
}

// Filter Logic
$conditions = [];
$email = isset($_POST['email']) ? $connect->real_escape_string($_POST['email']) : '';
$user_type = isset($_POST['user_type']) ? $connect->real_escape_string($_POST['user_type']) : '';
$status = isset($_POST['status']) ? $connect->real_escape_string($_POST['status']) : '';

if (!empty($email)) {
  $conditions[] = "email LIKE '%$email%'";
}
if (!empty($user_type)) {
  $conditions[] = "user_type = '$user_type'";
}
if (!empty($status)) {
  $conditions[] = "status = '$status'";
}

$whereClause = count($conditions) > 0 ? "WHERE " . implode(" AND ", $conditions) : "";
$sql = "SELECT * FROM user $whereClause";
$result = $connect->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin User Management</title>
  <link rel="icon" type="image/x-icon" href="../image/logo.png">
  <!-- Bootstrap CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      padding: 0;
      overflow: hidden;
      /* This will remove the scrollbar */
      height: 100%;
    }
  </style>
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

  <!-- Vertical Tabs -->
  <?php include 'tabadmin.php'; ?>

  <!-- User Management Section -->
  <div class="container mt-8 px-4">
    <h2 class="mb-6 text-3xl text-center font-semibold text-gray-800">User Management</h2>

    <!-- Filter Section -->
    <form class="mb-6" id="filterForm" method="POST" action="usermanagement.php">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="text-start">
          <button
            class="btn md:w-1/2 py-2 bg-pink-200 hover:bg-pink-500 text-black font-semibold rounded-lg shadow-md transition-all duration-300"
            data-bs-toggle="modal" data-bs-target="#userModal" type="button">Add User</button>
        </div>
        <div class="text-end">
          <div class="relative">
            <button
              class="btn py-2 bg-pink-200 hover:bg-pink-500 text-black font-semibold rounded-lg shadow-md transition-all duration-300"
              type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">Filter User</button>
            <ul class="dropdown-menu absolute right-0 mt-2 w-72 bg-white rounded-md shadow-lg border border-gray-300"
              aria-labelledby="dropdownMenuButton">
              <li class="p-2">
                <input type="text" id="emailFilter" name="email" value="<?php echo htmlspecialchars($email); ?>"
                  class="form-control p-2 rounded-md border-gray-300 focus:outline-none focus:ring-2 focus:ring-pink-400"
                  placeholder="Search by Email...">
              </li>
              <li class="p-2">
                <select id="userTypeFilter" name="user_type" class="form-control p-2 rounded-md border-gray-300">
                  <option value="" disabled <?php echo empty($user_type) ? 'selected' : ''; ?>>Select User Type</option>
                  <option value="Admin" <?php echo $user_type === 'Admin' ? 'selected' : ''; ?>>Admin</option>
                  <option value="Midwife" <?php echo $user_type === 'Midwife' ? 'selected' : ''; ?>>Midwife</option>
                  <option value="Staff" <?php echo $user_type === 'Staff' ? 'selected' : ''; ?>>Staff</option>
                  <option value="Patient" <?php echo $user_type === 'Patient' ? 'selected' : ''; ?>>Patient</option>
                </select>
              </li>
              <li class="p-2">
                <select id="statusFilter" name="status" class="form-control p-2 rounded-md border-gray-300">
                  <option value="" disabled <?php echo empty($status) ? 'selected' : ''; ?>>Select Status</option>
                  <option value="Active" <?php echo $status === 'Active' ? 'selected' : ''; ?>>Active</option>
                  <option value="Inactive" <?php echo $status === 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
              </li>
              <li class="p-2 text-end">
                <button class="btn bg-pink-400 hover:bg-pink-500 text-white font-semibold rounded-lg shadow-md py-2"
                  type="submit" name="filter">Apply Filters</button>
                <button class="btn bg-gray-400 hover:bg-gray-500 text-white font-semibold rounded-lg shadow-md py-2"
                  type="button" onclick="clearFilters()">Clear Filters</button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </form>

    <!-- User Table -->
    <div class="overflow-x-auto">
      <table class="min-w-full table-auto bg-white shadow-lg rounded-lg border border-gray-200">
        <thead class="bg-pink-100 text-black text-sm">
          <tr>
            <th class="px-4 py-2 text-left">User ID</th>
            <th class="px-4 py-2 text-left">Email</th>
            <th class="px-4 py-2 text-left">User Type</th>
            <th class="px-4 py-2 text-left">Status</th>
            <th class="px-9 py-2 text-left">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $email = addslashes($row['email']);
              $user_type = addslashes($row['user_type']);
              $status = addslashes($row['status']);
              echo "<tr class='border-b hover:bg-gray-50 transition-all duration-200'>";
              echo "<td class='py-1 px-4 text-gray-700'>" . $row['user_id'] . "</td>";
              echo "<td class='py-1 px-4 text-gray-700'>" . $row['email'] . "</td>";
              echo "<td class='py-1 px-4 text-gray-700'>" . $row['user_type'] . "</td>";
              echo "<td class='py-1 px-4 text-gray-700'>" . ucfirst($row['status']) . "</td>";
              echo '<td class="py-1 px-4 text-center">
          <div class="flex gap-2">
            <!-- Edit Button -->
            <button class="px-3 py-1 bg-pink-200 text-black text-sm rounded-md shadow hover:bg-pink-600 transition-all duration-200"
              data-bs-toggle="modal" data-bs-target="#editModal" 
              onclick="openEditModal({
                id: \'' . $row['user_id'] . '\',
                email: \'' . $email . '\',
                usertype: \'' . $user_type . '\',
                status: \'' . $status . '\'
              })">
              Edit
            </button>
            <!-- Archive Button -->
            <form action="usermanagement.php" method="POST">
              <input type="hidden" id="archive" name="user_id" value="' . $row['user_id'] . '">
              <button type="submit" class="px-3 py-2 bg-pink-200 hover:bg-gray-500 text-black rounded-lg shadow-md flex items-center gap-2 transition-all duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive"
                   viewBox="0 0 16 16">
                  <path d="M0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1v7.5a2.5 2.5 0 0 1-2.5 2.5h-9A2.5 2.5 0 0 1 1 12.5V5a1 1 0 0 1-1-1zm2 3v7.5A1.5 1.5 0 0 0 3.5 14h9a1.5 1.5 0 0 0 1.5-1.5V5zm13-3H1v2h14zM5 7.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5"/>
                </svg>Archive
              </button>
            </form>
          </div>
        </td>';
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='5' class='py-3 px-4 text-center text-sm text-gray-700'>No users found</td></tr>";
          }
          ?>
        </tbody>
      </table>
    </div>



    <!-- Add User -->
    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header" style="background-color: #FAD5E1;">
            <h5 class="modal-title" id="userModalLabel">Add User Account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal Body -->
          <div class="modal-body">
            <form id="addUserForm" method="POST">
              <!-- Email -->
              <div class="row g-3">
                <div class="col-md-12">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                </div>
              </div>

              <!-- Password and Confirm Password -->
              <div class="mt-2 row g-3">
                <div class="col-md-6">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter password"
                    required>
                </div>
                <div class="col-md-6">
                  <label for="confirmpassword" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" id="confirmpassword" name="confirmpassword"
                    placeholder="Confirm password" required>
                </div>
              </div>

              <!-- User Type -->
              <div class="mt-2 row g-3">
                <div class="col-md-12">
                  <label for="usertype" class="form-label">User Type</label>
                  <select class="form-select" id="usertype" name="usertype" required>
                    <option value="Admin">Admin</option>
                    <option value="Staff">Staff</option>
                    <option value="Midwife">Midwife</option>
                    <option value="Patient">Patient</option>
                  </select>
                </div>
              </div>

              <!-- Status -->
              <div class="mt-2 row g-3">
                <div class="col-md-12">
                  <label for="status" class="form-label">Status</label>
                  <select class="form-select" id="status" name="status" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                  </select>
                </div>
              </div>
            </form>
          </div>

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn" style="background-color: #FAD5E1;" form="addUserForm"
              name="add_user">Save</button>
          </div>
        </div>
      </div>
    </div>





    <!-- Update User -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <!-- Modal Header -->
          <div class="modal-header" style="background-color: #FAD5E1;">
            <h5 class="modal-title" id="editModalLabel">Edit User Account</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <!-- Modal Body -->
          <div class="modal-body">
            <form id="editUserForm" method="POST">
              <input type="hidden" id="edit-user-id" name="user_id"> <!-- Hidden field for user ID -->

              <!-- Email -->
              <div class="row g-3">
                <div class="col-md-12">
                  <label for="edit-email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="edit-email" name="email" placeholder="Enter email"
                    required>
                </div>
              </div>

              <!-- Password and Confirm Password -->
              <div class="mt-2 row g-3">
                <div class="col-md-6">
                  <label for="edit-password" class="form-label">New Password</label>
                  <input type="password" class="form-control" id="edit-password" name="password"
                    placeholder="Enter new password">
                </div>
                <div class="col-md-6">
                  <label for="edit-confirmpassword" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" id="edit-confirmpassword" name="confirmpassword"
                    placeholder="Confirm new password">
                </div>
              </div>

              <!-- User Type -->
              <div class="mt-2 row g-3">
                <div class="col-md-12">
                  <label for="edit-usertype" class="form-label">User Type</label>
                  <select class="form-select" id="edit-usertype" name="usertype" required>
                    <option value="Admin">Admin</option>
                    <option value="Staff">Staff</option>
                    <option value="Client">Client</option>
                    <option value="Patient">Patient</option>
                  </select>
                </div>
              </div>

              <!-- Status -->
              <div class="mt-2 row g-3">
                <div class="col-md-12">
                  <label for="edit-status" class="form-label">Status</label>
                  <select class="form-select" id="edit-status" name="status" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                  </select>
                </div>
              </div>
            </form>
          </div>

          <!-- Modal Footer -->
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn" style="background-color: #FAD5E1;" form="editUserForm"
              name="update_user">Save</button>
          </div>
        </div>
      </div>
    </div>


    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function filterFunction() {
        const input = document.getElementById("myInput");
        const filter = input.value.toUpperCase();
        const dropdownItems = document.querySelectorAll(".dropdown-item");

        dropdownItems.forEach(item => {
          const txtValue = item.textContent || item.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            item.style.display = "block";
          } else {
            item.style.display = "none";
          }
        });
      }
      document.querySelectorAll('.tab-link').forEach(link => {
        link.addEventListener('click', function () {
          document.querySelector('.tab-link.active').classList.remove('active');
          this.classList.add('active');
        });
      });
    </script>

    <script>
      function openEditModal(user) {
        // Populate the modal fields with the user's current data
        document.getElementById('edit-user-id').value = user.id; // User ID for the backend
        document.getElementById('edit-email').value = user.email; // Pre-fill email
        document.getElementById('edit-usertype').value = user.usertype; // Pre-select usertype
        document.getElementById('edit-status').value = user.status; // Pre-select status

      }</script>

    <script>
      function setUserId(userId) {
        document.getElementById('archive').value = userId;
      }

      function clearFilters() {
        document.getElementById('emailFilter').value = '';
        document.getElementById('userTypeFilter').selectedIndex = 0;
        document.getElementById('statusFilter').selectedIndex = 0;
        document.getElementById('filterForm').submit();
      }
    </script>
</body>

</html>