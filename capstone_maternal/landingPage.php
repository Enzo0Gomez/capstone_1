<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <link rel="icon" type="image/x-icon" href="image/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Section Styles */
        section {
            padding: 5em 2em;
        }

        #services {
            background-color: #FDE6ED;
        }

        #clinic {
            background-color: #FDE6ED;
        }

        #about {
            background-color: #FDE6ED;
        }

        .services-section {
            background-color: #f8f9fa;
            padding: 5em;
        }


        .services-title,
        .clinic-title,
        .about-title {
            font-size: 3em;
            margin-bottom: 2em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
            color: #E88499;
        }

        .contact-info {
            text-align: center;
        }

        .container-about {
            background-color: #E88499;

        }

        .map {
            float: right;
        }
    </style>

    </style>
</head>

<body class="font-sans scroll-smooth bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-black/60 backdrop-blur-md fixed w-full z-50">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <a href="#" class="flex items-center text-white text-lg font-semibold">
                <img src="image/logo.png" alt="Logo" class="w-12 h-12 mr-3">
                Maternal and Neonatal Healthcare
            </a>
            <button class="lg:hidden text-white focus:outline-none" id="navbar-toggle">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
            <div class="hidden lg:flex lg:items-center" id="navbar-menu">
                <ul class="flex space-x-6">
                    <li><a href="#services" class="text-white text-sm hover:text-gray-300">Services Offered</a></li>
                    <li><a href="#clinic" class="text-white text-sm hover:text-gray-300">Clinic Branches</a></li>
                    <li><a href="#about" class="text-white text-sm hover:text-gray-300">About Us</a></li>
                    <li><a href="login-system/login.php"
                            class="px-4 py-2 text-sm border border-white text-white rounded hover:bg-white hover:text-black">Login</a>
                    </li>
                    <li><a href="login-system/register.php"
                            class="px-4 py-2 text-sm bg-white text-black rounded hover:bg-gray-300">Create
                            Account</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero h-[90vh] bg-cover bg-center flex flex-col justify-center items-center text-white text-center"
        style="background-image: url('image/front.png');">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">
                Motherhood is hard.<br><span class="text-pink-500">CARE</span> shouldn’t be.
            </h1>
            <p class="text-lg md:text-xl">
                Our women-centered care model supports and empowers you at every step of your wellness journey.
            </p>
        </div>
    </section>

    <section id="services" class="bg-light py-5">
        <div class="container">
            <h2 class="mb-5 text-center clinic-title">Services Offered</h2>

            <!-- Carousel -->
            <div id="servicesCarousel" class="carousel slide" data-bs-ride="carousel">
                <!-- Carousel Indicators -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#servicesCarousel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#servicesCarousel" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#servicesCarousel" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#servicesCarousel" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
                </div>

                <!-- Carousel Items -->
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <img src="image/childbbirth.png" class="d-block w-100 rounded" alt="Giving Birth">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="mb-5 text-center clinic-title">Giving Birth</h5>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <img src="image/pre natal.jpg" class="d-block w-100 rounded" alt="Pre Natal Check Up">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="mb-5 text-center clinic-title">Pre Natal Check Up</h5>
                        </div>
                    </div>
                    <!-- Slide 3 -->
                    <div class="carousel-item">
                        <img src="image/post.png" class="d-block w-100 rounded" alt="Post Natal Check Up">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="mb-5 text-center clinic-title">Post Natal Check Up</h5>
                        </div>
                    </div>
                    <!-- Slide 4 -->
                    <div class="carousel-item">
                        <img src="image/Papsmear.jpg" class="d-block w-100 rounded" alt="Papsmear">
                        <div class="carousel-caption d-none d-md-block">
                            <h5 class="mb-5 text-center clinic-title">Papsmear</h5>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <button class="carousel-control-prev" type="button" data-bs-target="#servicesCarousel"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#servicesCarousel"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </section>



    <section id="clinic" class="py-6 bg-light">
        <h2 class="mb-5 text-center clinic-title">Our Clinics</h2>
        <div class="container">
            <div class="row g-4">
                <!-- Clinic 1 -->
                <div class="col-md-4 col-lg-4">
                    <div class="border-0 shadow card h-100" style="background-color: #FDE6ED">
                        <div class="card-body">
                            <div class="mb-3 text-center clinic-info">
                                <a href="https://www.facebook.com/honeylethpateniapazmaternityclinic"
                                    class="clinic-link text-decoration-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#3b5998"
                                        class="bi bi-facebook me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                    </svg>
                                    <h5 class="card-title d-inline">Honeyleth Patenia Paz Maternity Clinic</h5>
                                </a>
                            </div>
                            <div class="contact-info">
                                <div class="mb-2 contact-item d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-telephone me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58z" />
                                    </svg>
                                    <span>09323234784</span>
                                </div>
                                <div class="mb-2 contact-item d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-envelope-open me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882zM15 7.383l-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765z" />
                                    </svg>
                                    <span>honeyleth@gmail.com</span>
                                </div>
                                <div class="contact-item">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3863.1054525889986!2d121.30905047457081!3d14.478633680052228!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397e97e33d55e61%3A0x8bda812f8265fac!2s220%20M.A.%20Roxas%20St%2C%20brgy.%20bagumbayan%2C%20Pililla%2C%201910%20Rizal!5e0!3m2!1sen!2sph!4v1734750223956!5m2!1sen!2sph"
                                        width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Clinic 2 -->
                <div class="col-md-4 mb-4col-lg-4">
                    <div class="border-0 shadow card h-100" style="background-color: #FDE6ED">
                        <div class="card-body">
                            <div class="mb-3 text-center clinic-info">
                                <a href="https://www.facebook.com/profile.php?id=61558854301464"
                                    class="clinic-link text-decoration-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#3b5998"
                                        class="bi bi-facebook me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                    </svg>
                                    <h5 class="card-title d-inline">Kasinay LYING IN Clinic</h5>
                                </a>
                            </div>
                            <div class="contact-info">
                                <div class="mb-2 contact-item d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-telephone me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58z" />
                                    </svg>
                                    <span>0998756784</span>
                                </div>
                                <div class="mb-2 contact-item d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-envelope-open me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882zM15 7.383l-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765z" />
                                    </svg>
                                    <span>Kasinay@gmail.com</span>
                                </div>
                                <div class="contact-item">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241.43416798309002!2d121.1858689974179!3d14.48774995020206!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c3e58758e1eb%3A0xc6a20e6a3d3e9307!2sKasinay%20Lying-In%20Clinic!5e0!3m2!1sen!2sph!4v1734750711055!5m2!1sen!2sph"
                                        width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Clinic 3 -->
                <div class="col-md-4 col-lg-4">
                    <div class="border-0 shadow card h-100" style="background-color: #FDE6ED">
                        <div class="card-body">
                            <div class="mb-3 text-center clinic-info">
                                <a href="https://www.facebook.com/vrvmmclinic/"
                                    class="clinic-link text-decoration-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="#3b5998"
                                        class="bi bi-facebook me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                                    </svg>
                                    <h5 class="card-title d-inline">VRVMM Maternity and General Clinic</h5>
                                </a>
                            </div>
                            <div class="contact-info">
                                <div class="mb-2 contact-item d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-telephone me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58z" />
                                    </svg>
                                    <span>09775654219</span>
                                </div>
                                <div class="mb-2 contact-item d-flex align-items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                        class="bi bi-envelope-open me-2" viewBox="0 0 16 16">
                                        <path
                                            d="M8.47 1.318a1 1 0 0 0-.94 0l-6 3.2A1 1 0 0 0 1 5.4v.817l5.75 3.45L8 8.917l1.25.75L15 6.217V5.4a1 1 0 0 0-.53-.882zM15 7.383l-4.778 2.867L15 13.117zm-.035 6.88L8 10.082l-6.965 4.18A1 1 0 0 0 2 15h12a1 1 0 0 0 .965-.738ZM1 13.116l4.778-2.867L1 7.383v5.734ZM7.059.435a2 2 0 0 1 1.882 0l6 3.2A2 2 0 0 1 16 5.4V14a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5.4a2 2 0 0 1 1.059-1.765z" />
                                    </svg>
                                    <span>vrvmmclinic@gmail.com</span>
                                </div>
                                <div class="contact-item">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3872.341943404715!2d121.30881577457407!3d14.486553050089038!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c56b5e7d83f5%3A0x6b0427a855b34f69!2sVRVMM%20Maternity%20and%20General%20Clinic!5e0!3m2!1sen!2sph!4v1734751274008!5m2!1sen!2sph"
                                        width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






    <!-- About Section -->
    <section id="about" class="py-7">
        <h2 class="mb-5 text-center about-title">About Us</h2>
        <div class="container">
            <div class="row justify-content-center">
                <!-- Empathic Care: Midwife -->
                <div class="mb-2 col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="shadow-sm card">
                        <div class="position-relative">
                            <img src="https://www.fillmurray.com/200/200"
                                class="rounded-circle w-50 position-absolute top-50 start-50 translate-middle"
                                alt="Midwife">
                        </div>
                        <div class="text-center card-body">
                            <h5 class="card-title fw-bold">Empathic Care</h5>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                            </p>
                            <h5 class="card-title fw-bold">Midwife</h5>
                        </div>
                    </div>
                </div>

                <!-- Empathic Care: OB-GYN -->
                <div class="mb-2 col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="shadow-sm card">
                        <div class="position-relative">
                            <img src="https://www.fillmurray.com/199/200"
                                class="rounded-circle w-50 position-absolute top-50 start-50 translate-middle"
                                alt="OB-GYN">
                        </div>
                        <div class="text-center card-body">
                            <h5 class="card-title fw-bold">Empathic Care</h5>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                            </p>
                            <h5 class="card-title fw-bold">Obstetrician-Gynecologist (OB-GYN)</h5>
                        </div>
                    </div>
                </div>

                <!-- Empathic Care: Nurse -->
                <div class="mb-2 col-12 col-sm-6 col-md-4 col-lg-4">
                    <div class="shadow-sm card">
                        <div class="position-relative">
                            <img src="https://www.fillmurray.com/200/198"
                                class="rounded-circle w-50 position-absolute top-50 start-50 translate-middle"
                                alt="Nurse">
                        </div>
                        <div class="text-center card-body">
                            <h5 class="card-title fw-bold">Empathic Care</h5>
                            <p class="card-text">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                incididunt ut labore et dolore magna aliqua.
                            </p>
                            <h5 class="card-title fw-bold">Nurse</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <footer class="py-4 text-center bg-light">
        <div class="container">
            <div class="mb-3 d-flex justify-content-center align-items-center">
                <img src="image/main.png" alt="Maternal Care Logo" class="me-2" style="width: 50px;">
                <span>© 2024 Maternal and Neonatal Healthcare</span>
            </div>
            <div>
                <a href="https://facebook.com" class="mx-2 text-dark" aria-label="Facebook">
                    <i class="bi bi-facebook" style="font-size: 1.5em;"></i>
                </a>
                <a href="https://twitter.com" class="mx-2 text-dark" aria-label="Twitter">
                    <i class="bi bi-twitter" style="font-size: 1.5em;"></i>
                </a>
                <a href="mailto:info@example.com" class="mx-2 text-dark" aria-label="Email">
                    <i class="bi bi-envelope" style="font-size: 1.5em;"></i>
                </a>
            </div>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>