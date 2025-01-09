<?php
include('../connect/connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <title>Patient Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100%;
        }
    </style>
</head>
<body class="bg-gray-100">

    <header class="px-4 py-3 shadow-md bg-pink-100 flex justify-between items-center">
        <!-- Logo and Brand Name (Left) -->
        <a class="flex items-center space-x-2 text-gray-800 no-underline" href="#">
            <img class="h-12" src="image/logo.png" alt="Logo">
            <span class="font-semibold text-lg">Maternal and Neonatal Healthcare</span>
        </a>

        <!-- Profile Section (Right) -->
        <div class="flex items-center space-x-2">
            <span class="font-semibold text-gray-800">Welcome, </span>
            <img src="image/dan.jpg" alt="Profile Picture" class="w-10 h-10 rounded-full object-cover">
        </div>
    </header>

    <div class="flex min-h-screen">
        <div class="w-64 bg-pink-100 text-gray-800 py-4 space-y-2">
            <a href="patientdashboard" class="block">
                <button class="w-full text-left px-4 py-3 flex items-center space-x-2 rounded-md hover:bg-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-400 tab-link" onclick="showTab(event, 'dashboard')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
                    </svg>
                    <span>Dashboard</span>
                </button>
            </a>
            <button class="w-full text-left px-4 py-3 flex items-center space-x-2 rounded-md hover:bg-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-400 tab-link" onclick="showTab(event, 'profile')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                </svg>
                <span>Patient Profile</span>
            </button>
            <button class="w-full text-left px-4 py-3 flex items-center space-x-2 rounded-md hover:bg-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-400 tab-link" onclick="showTab(event, 'scheduling')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-calendar-heart" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v11a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4zM1 14V4h14v10a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1m7-6.507c1.664-1.711 5.825 1.283 0 5.132-5.825-3.85-1.664-6.843 0-5.132"/>
                </svg>
                <span>Scheduling</span>
            </button>
            <button class="w-full text-left px-4 py-3 flex items-center space-x-2 rounded-md hover:bg-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-400 tab-link" onclick="showTab(event, 'transaction')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cash" viewBox="0 0 16 16">
                    <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                    <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z"/>
                </svg>
                <span>Transaction</span>
            </button>
            <button class="w-full text-left px-4 py-3 flex items-center space-x-2 rounded-md hover:bg-pink-300 focus:outline-none focus:ring-2 focus:ring-pink-400 tab-link" onclick="showTab(event, 'report')">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-filetype-doc" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14 4.5V14a2 2 0 0 1-2 2v-1a1 1 0 0 0 1-1V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v9H2V2a2 2 0 0 1 2-2h5.5zm-7.839 9.166v.522q0 .384-.117.641a.86.86 0 0 1-.322.387.9.9 0 0 1-.469.126.9.9 0 0 1-.471-.126.87.87 0 0 1-.32-.386 1.55 1.55 0 0 1-.117-.642v-.522q0-.386.117-.641a.87.87 0 0 1 .32-.387.87.87 0 0 1 .471-.129q.264 0 .469.13a.86.86 0 0 1 .322.386q.117.255.117.641m.803.519v-.513q0-.565-.205-.972a1.46 1.46 0 0 0-.589-.63q-.381-.22-.917-.22-.533 0-.92.22a1.44 1.44 0 0 0-.589.627q-.204.406-.205.975v.513q0 .563.205.973.205.406.59.627.386.216.92.216.535 0 .916-.216.383-.22.59-.627.204-.41.204-.973M0 11.926v4h1.459q.603 0 .999-.238a1.45 1.45 0 0 0 .595-.689q.196-.45.196-1.084 0-.63-.196-1.075a1.43 1.43 0 0 0-.59-.68q-.395-.234-1.004-.234zm.791.645h.563q.371 0 .609.152a.9.9 0 0 1 .354.454q.118.302.118.753a2.3 2.3 0 0 1-.068.592 1.1 1.1 0 0 1-.196.422.8.8 0 0 1-.334.252 1.3 1.3 0 0 1-.483.082H.79V12.57Zm7.422.483a1.7 1.7 0 0 0-.103.633v.495q0 .369.103.627a.83.83 0 0 0 .298.393.85.85 0 0 0 .478.131.9.9 0 0 0 .401-.088.7.7 0 0 0 .273-.248.8.8 0 0 0 .117-.364h.765v.076a1.27 1.27 0 0 1-.226.674q-.205.29-.55.454a1.8 1.8 0 0 1-.786.164q-.54 0-.914-.216a1.4 1.4 0 0 1-.571-.627q-.194-.408-.194-.976v-.498q0-.568.197-.978.195-.411.571-.633.378-.223.911-.223.328 0 .607.097.28.093.489.272a1.33 1.33 0 0 1 .466.964v.073H9.78a.85.85 0 0 0-.12-.38.7.7 0 0 0-.273-.261.8.8 0 0 0-.398-.097.8.8 0 0 0-.475.138.87.87 0 0 0-.301.398"/>
                </svg>
                <span>Report</span>
            </button>
            <a href="../login-system/logout.php" 
   class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition text-center block">
   Logout
</a>
        </div>

        <!-- Tab Content -->
        <div class="flex-grow p-6 bg-gray-50">
            <div id="dashboard" class="tab-content hidden">
                <h3 class="text-2xl font-semibold mb-4">Welcome to your Dashboard</h3>
                <p>Dashboard content goes here...</p>
            </div>
            <div id="profile" class="tab-content hidden">
                <h3 class="text-2xl font-semibold mb-4">Patient Profile</h3>
                <p>Profile content goes here...</p>
            </div>
            <div id="scheduling" class="tab-content hidden">
                <h3 class="text-2xl font-semibold mb-4">Scheduling</h3>
                <p>Scheduling content goes here...</p>
            </div>
            <div id="transaction" class="tab-content hidden">
                <h3 class="text-2xl font-semibold mb-4">Transaction</h3>
                <p>Transaction content goes here...</p>
            </div>
            <div id="report" class="tab-content hidden">
                <h3 class="text-2xl font-semibold mb-4">Reports</h3>
                <p>Report content goes here...</p>
            </div>
        </div>
    </div>

    

    <script>
        function showTab(evt, tabName) {
            var tabContents = document.querySelectorAll(".tab-content");
            tabContents.forEach(function(content) {
                content.classList.add("hidden");
            });

            var tabLinks = document.querySelectorAll(".tab-link");
            tabLinks.forEach(function(link) {
                link.classList.remove("bg-pink-300");
            });

            document.getElementById(tabName).classList.remove("hidden");
            evt.currentTarget.classList.add("bg-pink-300");
        }
    </script>
</body>
</html>
