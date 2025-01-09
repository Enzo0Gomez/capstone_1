<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <style>
        /* Vertical tabs styling */
        .vertical-tabs {
            display: flex;
            width: auto;
            min-height: 100vh;
        }

        .tab-link {
            display: flex;
            align-items: center;
            justify-content: start;
            gap: 15px;
            background-color: transparent;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease, color 0.3s ease;
        }


        .tab-link svg {
            flex-shrink: 0;
            /* Prevent the icon from shrinking */
        }

        .tab-menu {
            width: 14em;
            background-color: #FAD1E8;

        }

        .tab-menu button {
            color: #000;
            /* Light pink text */
            padding: 0.5em;
            transition: background 0.3s, color 0.3s;
        }




        @media (max-width: 768px) {
            .tab-menu {
                position: fixed;
                left: -17em;
                transition: left 0.3s ease;
            }

            .tab-menu.open {
                left: 0;
            }
        }

        .tab-content {
            flex-grow: 1;
            padding: 2rem;
            display: flex;
        }

        .tab-content>.content {
            flex-grow: 1;
            /* Makes the content stretch */
        }
    </style>


    <div class="vertical-tabs">
        <div class="tab-menu">
            <a class="link" href="dashboard.php"><button class="tab-link p-3" onclick="showTab('dashboard')">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                        width="25" height="25" viewBox="0 0 256 256" xml:space="preserve">
                        <defs>
                        </defs>
                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                            transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                            <path
                                d="M 36.231 55.648 H 6.354 C 2.851 55.648 0 52.798 0 49.294 V 6.354 C 0 2.851 2.851 0 6.354 0 h 29.876 c 3.504 0 6.354 2.851 6.354 6.354 v 42.939 C 42.585 52.798 39.735 55.648 36.231 55.648 z M 6.354 6 C 6.159 6 6 6.159 6 6.354 v 42.939 c 0 0.195 0.159 0.354 0.354 0.354 h 29.876 c 0.195 0 0.354 -0.159 0.354 -0.354 V 6.354 C 36.585 6.159 36.426 6 36.231 6 H 6.354 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 36.231 90 H 6.354 C 2.851 90 0 87.149 0 83.646 V 68.616 c 0 -3.504 2.851 -6.354 6.354 -6.354 h 29.876 c 3.504 0 6.354 2.851 6.354 6.354 v 15.029 C 42.585 87.149 39.735 90 36.231 90 z M 6.354 68.262 C 6.159 68.262 6 68.421 6 68.616 v 15.029 C 6 83.841 6.159 84 6.354 84 h 29.876 c 0.195 0 0.354 -0.159 0.354 -0.354 V 68.616 c 0 -0.195 -0.159 -0.354 -0.354 -0.354 H 6.354 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 83.646 90 H 53.769 c -3.504 0 -6.354 -2.851 -6.354 -6.354 V 40.706 c 0 -3.504 2.851 -6.354 6.354 -6.354 h 29.877 c 3.504 0 6.354 2.851 6.354 6.354 v 42.939 C 90 87.149 87.149 90 83.646 90 z M 53.769 40.352 c -0.195 0 -0.354 0.159 -0.354 0.354 v 42.939 c 0 0.195 0.159 0.354 0.354 0.354 h 29.877 C 83.841 84 84 83.841 84 83.646 V 40.706 c 0 -0.195 -0.159 -0.354 -0.354 -0.354 H 53.769 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                            <path
                                d="M 83.646 27.738 H 53.769 c -3.504 0 -6.354 -2.851 -6.354 -6.355 V 6.354 C 47.414 2.851 50.265 0 53.769 0 h 29.877 C 87.149 0 90 2.851 90 6.354 v 15.029 C 90 24.887 87.149 27.738 83.646 27.738 z M 53.769 6 c -0.195 0 -0.354 0.159 -0.354 0.354 v 15.029 c 0 0.196 0.159 0.355 0.354 0.355 h 29.877 c 0.195 0 0.354 -0.159 0.354 -0.355 V 6.354 C 84 6.159 83.841 6 83.646 6 H 53.769 z"
                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,0,0); fill-rule: nonzero; opacity: 1;"
                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                        </g>
                    </svg> Dashboard</button>
            </a>
            <a class="link" href="usermanagement.php"><button class="tab-link p-2" onclick="showTab('user-management')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-people" viewBox="0 0 16 16">
                        <path
                            d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                    </svg> User Management</button>
            </a>
            <a class="link" href="patientprofiling.php"><button class="tab-link p-3" onclick="showTab('patient-profiling')"><svg
                        width="25" height="25" viewBox="0 0 35 35" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.3122 30.625H8.16634C7.3496 30.625 6.94122 30.625 6.62927 30.466C6.35487 30.3262 6.13178 30.1032 5.99195 29.8287C5.83301 29.5168 5.83301 29.1085 5.83301 28.2917V25.7893C5.83301 24.8624 5.83301 24.3988 5.90298 24.0123C6.22803 22.2168 7.6332 20.8117 9.42865 20.4867C9.54082 20.4664 9.65924 20.452 9.79348 20.4417C10.1217 20.4167 10.2858 20.4041 10.5049 20.4205C10.7328 20.4375 10.8602 20.46 11.08 20.522C11.2916 20.5816 11.6726 20.7543 12.4346 21.0995C12.8884 21.3049 13.3628 21.4729 13.8538 21.5994M21.8747 10.2083C21.8747 13.43 19.2629 16.0417 16.0413 16.0417C12.8197 16.0417 10.208 13.43 10.208 10.2083C10.208 6.98667 12.8197 4.375 16.0413 4.375C19.2629 4.375 21.8747 6.98667 21.8747 10.2083ZM24.0587 23.6424C23.0381 22.5062 21.3364 22.2005 20.0577 23.241C18.7792 24.2814 18.5991 26.021 19.6033 27.2516C20.1702 27.9463 21.5171 29.1642 22.5825 30.0931C23.0879 30.5337 23.3404 30.7541 23.6461 30.8442C23.9067 30.921 24.2106 30.921 24.4712 30.8442C24.7769 30.7541 25.0295 30.5337 25.5348 30.0931C26.6003 29.1642 27.9472 27.9463 28.514 27.2516C29.5182 26.021 29.3602 24.2705 28.0596 23.241C26.7589 22.2114 25.0792 22.5062 24.0587 23.6424Z"
                            stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>Patient Profiling</button>
            </a>
            <a class="link" href="babyprofiling.php"><button class="tab-link p-3" onclick="showTab('baby-profiling')"><svg
                        xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-clipboard-heart" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M5 1.5A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5v1A1.5 1.5 0 0 1 9.5 4h-3A1.5 1.5 0 0 1 5 2.5zm5 0a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5z" />
                        <path
                            d="M3 1.5h1v1H3a1 1 0 0 0-1 1V14a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V3.5a1 1 0 0 0-1-1h-1v-1h1a2 2 0 0 1 2 2V14a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V3.5a2 2 0 0 1 2-2" />
                        <path d="M8 6.982C9.664 5.309 13.825 8.236 8 12 2.175 8.236 6.336 5.31 8 6.982" />
                    </svg>Baby Profiling</button>
            </a>
            <a class="link" href="appointments.php"><button class="tab-link p-3" onclick="showTab('appointments')"><svg
                        xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-journal-bookmark" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M6 8V1h1v6.117L8.743 6.07a.5.5 0 0 1 .514 0L11 7.117V1h1v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8" />
                        <path
                            d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2" />
                        <path
                            d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1z" />
                    </svg>Appointments</button>
            </a>
            <a class="link" href="admission.php"><button class="tab-link p-3" onclick="showTab('admission')"><svg width="25"
                        height="25" viewBox="0 0 51 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_1734_1462)">
                            <path
                                d="M0.5625 6.44769V3.3862C0.5625 2.69252 1.13659 2.17146 1.83027 2.17146H11.5866V1.25591C11.5866 0.562228 12.1488 0 12.8425 0C13.5362 0 14.0984 0.562228 14.0984 1.25591V2.17146H33.6347V1.25591C33.6347 0.562228 34.1969 0 34.8906 0C35.5843 0 36.1465 0.562228 36.1465 1.25591V2.17146H45.9524C46.646 2.17146 47.1706 2.69252 47.1706 3.3862V6.44769C47.1706 7.14137 46.6084 7.70359 45.9147 7.70359C45.221 7.70359 44.6588 7.14137 44.6588 6.44769V4.68328H36.1465V5.51594C36.1465 6.20962 35.5843 6.77185 34.8906 6.77185C34.1969 6.77185 33.6347 6.20962 33.6347 5.51594V4.68328H14.0984V5.51594C14.0984 6.20962 13.5362 6.77185 12.8425 6.77185C12.1488 6.77185 11.5866 6.20962 11.5866 5.51594V4.68328H3.07431V6.44769C3.07431 7.14137 2.51209 7.70359 1.81841 7.70359C1.12473 7.70359 0.5625 7.14137 0.5625 6.44769ZM50.438 39.6656C50.438 45.9157 45.3532 51 39.1031 51C32.8528 51 27.7681 45.9143 27.7681 39.6642C27.7681 34.8087 30.8372 30.6545 35.1371 29.0431C34.9741 28.8312 34.8769 28.562 34.8769 28.274C34.8769 27.5803 35.4392 27.0105 36.1328 27.0105H42.0733C42.767 27.0105 43.3292 27.5803 43.3292 28.274C43.3292 28.562 43.2322 28.8349 43.0691 29.0469C44.1136 29.4383 45.0856 29.9796 45.9586 30.6447L46.5789 30.0244C47.0694 29.5339 47.8647 29.5342 48.3551 30.0244C48.8456 30.5149 48.8454 31.31 48.3551 31.8005L47.7779 32.3776C49.4374 34.3496 50.438 36.8925 50.438 39.6656ZM47.9262 39.666C47.9262 34.8009 43.9682 30.8427 39.1031 30.8427C34.238 30.8427 30.2799 34.8008 30.2799 39.666C30.2799 44.5311 34.238 48.4892 39.1031 48.4892C43.9682 48.489 47.9262 44.5311 47.9262 39.666ZM40.8025 36.5632L40.3329 37.0198V35.0772C40.3329 34.3835 39.7707 33.8213 39.077 33.8213C38.3833 33.8213 37.8211 34.3835 37.8211 35.0772V40.052C37.8211 40.2229 37.8682 40.3858 37.9301 40.5343C37.9913 40.6819 38.0884 40.82 38.2084 40.94C38.3314 41.063 38.4768 41.1552 38.6285 41.2163C38.6288 41.2165 38.6306 41.2165 38.6308 41.2166C38.6314 41.2169 38.6328 41.1857 38.6335 41.1859C38.7659 41.2392 38.9104 41.2441 39.0606 41.2441C39.0615 41.2441 39.0622 41.2441 39.0633 41.2441C39.0766 41.2441 39.0898 41.2447 39.1032 41.2447C39.1166 41.2447 39.1297 41.2441 39.143 41.2441C39.1438 41.2441 39.1448 41.2441 39.1456 41.2441C39.2986 41.2441 39.4445 41.2381 39.5788 41.1831C39.7289 41.1219 39.8696 41.046 39.9914 40.9241L42.592 38.3314C43.0825 37.8409 43.0758 37.0497 42.5854 36.5592C42.0946 36.0687 41.293 36.0727 40.8025 36.5632ZM27.4256 32.3132C27.4256 33.0069 26.8634 33.5691 26.1697 33.5691H25.1225V42.7984C25.1225 43.4921 24.5725 44.0495 23.8788 44.0495C23.8365 44.0495 23.8071 44.0426 23.7659 44.0387C23.7248 44.0427 23.6829 44.0352 23.6408 44.0352H1.83027C1.13659 44.0352 0.5625 43.4921 0.5625 42.7985V11.2151V11.2148C0.5625 10.5211 1.13659 9.98599 1.83027 9.98599H45.9524C46.646 9.98599 47.1706 10.5211 47.1706 11.2148V24.8328C47.1706 25.5264 46.6084 26.0887 45.9147 26.0887C45.221 26.0887 44.6588 25.5264 44.6588 24.8328V22.9637H36.1465V23.071C36.1465 23.7647 35.5843 24.3269 34.8906 24.3269C34.1969 24.3269 33.6347 23.7647 33.6347 23.071V22.9637H25.1225V31.0573H26.1697C26.8634 31.0573 27.4256 31.6195 27.4256 32.3132ZM11.5866 33.5691H3.07431V41.5232H11.5866V33.5691ZM11.5866 22.9637H3.07431V31.0573H11.5866V22.9637ZM22.6106 33.5691H14.0984V41.5232H22.6106V33.5691ZM22.6106 22.9637H14.0984V31.0573H22.6106V22.9637ZM25.1225 15.2422V20.4519H33.6347V15.2422C33.6347 14.5486 34.1969 13.9863 34.8906 13.9863C35.5843 13.9863 36.1465 14.5486 36.1465 15.2422V20.4519H44.6588V12.4978H3.07431V20.4519H11.5866V15.2422C11.5866 14.5486 12.1488 13.9863 12.8425 13.9863C13.5362 13.9863 14.0984 14.5486 14.0984 15.2422V20.4519H22.6106V15.2422C22.6106 14.5486 23.1729 13.9863 23.8665 13.9863C24.5602 13.9863 25.1225 14.5486 25.1225 15.2422Z"
                                fill="black" />
                        </g>
                        <defs>
                            <clipPath id="clip0_1734_1462">
                                <rect width="51" height="51" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>Admission</button>
            </a>
            <a class="link" href="outpatient.php"><button class="tab-link p-3" onclick="showTab('outpatient')"><svg
                        xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-door-closed" viewBox="0 0 16 16">
                        <path
                            d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3zm1 13h8V2H4z" />
                        <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0" />
                    </svg>Outpatient</button>
            </a>
            <div class="btn-group dropend">
                <button type="button" onclick="showTab('report')" class="tab-link p-3 dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-file-earmark" viewBox="0 0 16 16">
                        <path
                            d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5z" />
                    </svg>Reports
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Inventory Reports</a></li>
                    <li><a class="dropdown-item" href="#">Patient Reports</a></li>
                    <li><a class="dropdown-item" href="#">User Management Report</a></li>
                    <li><a class="dropdown-item" href="#">Transaction Report</a></li>
                    <li><a class="dropdown-item" href="#">Baby Profiling Report</a></li>
                </ul>
            </div>

            <div class="btn-group dropend">
                <button type="button" onclick="showTab('setting')" class="tab-link p-3 dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                        class="bi bi-sliders" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3M2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3m-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1z" />
                    </svg>Setting
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">Customized System</a></li>
                    <li><a class="dropdown-item" href="#">Edit Services/Items/Med</a></li>
                    <li><a class="dropdown-item" href="#">Add Room</a></li>
                </ul>
            </div>
            <a href="../login-system/logout.php" 
   class="w-full bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition text-center block">
   Logout
</a>
        </div>
</body>
<script>
    function showTab(tabId) {
        // Hide all tab content
        const contents = document.querySelectorAll('.tab-content');
        contents.forEach(content => {
            content.style.display = 'none';
        });

        // Remove active class from all tab links
        const tabs = document.querySelectorAll('.tab-link');
        tabs.forEach(tab => {
            tab.classList.remove('active');
            tab.setAttribute('aria-selected', 'false');
        });

        // Show the selected tab content
        const selectedTabContent = document.getElementById(tabId);
        if (selectedTabContent) {
            selectedTabContent.style.display = 'block';
        }

        // Activate the selected tab link
        const selectedTabLink = document.querySelector(`.tab-link[onclick="showTab('${tabId}')"]`);
        if (selectedTabLink) {
            selectedTabLink.classList.add('active');
            selectedTabLink.setAttribute('aria-selected', 'true');
        }
    }
</script>

</html>