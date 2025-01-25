<?php
session_start();
if (isset($_SESSION['userId'])) {
    header('Location: ./views/userViewAfterLogin.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
     content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
    <link href="https://fonts.cdnfonts.com/css/ninja-naruto" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Home</title>
    <style>
        #map {
            height: 500px;
            width: 100%;
        }

        .custom-popup img {
            width: 200px;
            height: auto;
        }

        #card p {
            color: #ffffff;
        }

        /* Mobile-first styles */
        .swiper {
            width: 100%;
            height: auto;
        }

        .swiper-slide {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
        }

        #card {
            width: 100%;
            max-width: 320px;
            /* Limit card width for better mobile fit */
            margin: 0 auto;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        /* Responsive adjustments */
        @media (min-width: 768px) {
            .swiper-slide {
                flex-direction: row;
                justify-content: center;
            }

            .swiper-slide .card {
                max-width: 600px;
                /* Adjust for tablets */
            }
        }

        @media (min-width: 1024px) {
            #card {
                max-width: 1000px;
                /* Adjust for larger screens */
            }
        }
    </style>
</head>

<body>
    <nav style="background-color: #0D5C75" class="navbar navbar-expand-lg navbar-dark p-3 sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h5>TourHub</h5>
            </a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav"
                aria-controls="navbarNav"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#heroPage">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#About_Page">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#footer">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#TopTreeContainer">Reviews</a>
                    </li>

                    <li class="nav-item">
                        <a data-bs-target="#modal_WhereToStay" data-bs-toggle="modal" class="nav-link text-white" href="#">Where to Stay</a>
                    </li>

                    <li class="nav-item">
                        <a data-bs-target="#modal_WhereToEat" data-bs-toggle="modal" class="nav-link text-white" href="#">Where to Eat</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#TopTreeContainer"></a>
                    </li>
                    <li class="nav-item">
                        <a data-bs-target="#DisplayContactModal" data-bs-toggle="modal" class="nav-link text-white" href="#">Contact You Might Need</a>
                    </li>
                </ul>
                <div>
                    <a data-bs-target="#LoginModal" data-bs-toggle="modal" href="#" class="btn btn-light me-2">Login</a>
                    <a data-bs-toggle="modal" data-bs-target="#RegisterModal" href="#" class="btn btn-outline-light">Sign Up</a>
                </div>
            </div>
        </div>

    </nav>

    <!-- Hero Page -->
    <section id="heroPage" class="hero">
        <div class="text-light text-center">
            <h2>Plan Your Trip With <span style="color: #0D5C75 ">TourHab</span></h2>
            <p class="mt-3">Discover amazing places at exclusive deals. Join us to explore the world with ease and comfort.</p>
        </div>
    </section>

    <!-- Top 5 Place -->
    <h2 style="color: #0D5C75 " class="text-center my-4">Top Places</h2>
    <section id="TopTreeContainer" class="container-fluid row justify-content-center align-items-center gap-3 p-5">
    </section>

    <!-- Review List-->
    <section style="background-color: #0D5C75; height: 50vh; " class="container-fluid d-flex flex-column justify-content-center align-items-center">
        <h2 style="color: #ffffff" class="text-center p-5">REVIEWS</h2>
        <!-- Swiper -->
        <div class="swiper mySwiper">
            <div id="reviewContainer" class="swiper-wrapper">

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- About Us Section-->
    <section id="About_Page" style="min-height: 50vh; " class="container-fluid  d-lg-flex justify-content-between align-items-center  p-5">
        <div>
            <div class="col-lg-10">
                <h5 style="color: #0D5C75" class="card-title">Dress/What to Bring (For Tourist)</h5>
                <div class="card-body">
                    <p class="card-text text-muted">
                        Visitors are advised to wear lightweight clothing. Shorts, hat, sunglasses, bathing suit, flashlight, comfortable shoes for walking, outdoor sandals/hiking shoes
                        for trekking/spelunking, rubber slippers/reef shoes for the beach are a must when
                        visiting the different tourist sites. Propriety dictates that, shorts and scanty clothes are to be avoided when going to the church and other places of worship.
                    </p>
                </div>
            </div>
            <br>

            <div class=" col-lg-10">
                <h5 style="color: #0D5C75" class="card-title">Geography</h5>
                <div class="card-body">
                    <p class="card-text text-muted">
                        Northern Samar is one of the three provinces comprising Samar Island. It is bounded by the Pacific Ocean in the east; the San Bernadrdino Strait in the north; Samar Sea in the west;
                        and the provinces of Eastern and Western Samar in the south.
                    </p>
                    <br>
                    <p class="card-text text-muted">
                        Northern Samar is classified as 2nd class province having a total land area of 3,498 square kilometers or 349,800 hectares,
                        and about 52 percent of the are is covered by forest and 42 percent is classified as alienable and disposable. It is composed of 24 municipalities and 569 barangays.
                    </p>
                </div>
            </div>
        </div>
        <picture>
            <img class="img-thumbnail border-0 " src="./assets/img/lighthouse.jpg" alt="img">
        </picture>
    </section>

    <!-- for Travel Info -->
    <div style="background-color: #0D5C75;" class="container-fluid p-4">
        <div class="text-center text-light">
            <h1>GETTING THERE AND AROUND</h1>
                <h5>TRAVEL INFORMATION</h5>
                <p class="text-center">
                    The province of Northern Samar is accessible by land, sea, or air transport. <br>
                     Once there, different modes of transportation take one to different tourist attractions. Here are the different ways to get around:
                </p>
        </div>

        <div class="container-fluid p-3 row justify-content-center align-items-center gap-3">

            <!--  card start-->
            <div class="card col-lg-3">
            <div class="text-center">
               <svg  width="100" height="100"  enable-background="new 0 0 64 64" id="Layer_1"  version="1.1" viewBox="0 0 64 64" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" 
               xmlns:xlink="http://www.w3.org/1999/xlink"><polyline fill="#0D5C75" points="56,22 56,54.5 40,59.5 24,54.5 8,59.5 8,26.5 24,21.8 "/><polygon fill="#B7B7B7" points="24,21.8 24,54.5 40,59.5 40,21.9 "/><path d="M40,40.1c0,0,13.6-9.2,13.6-22.5C53.6,10.1,47.5,4,40,4s-13.6,6.1-13.6,13.6c0,10,6.9,16.7,10.9,20.2  L40,40.1z" fill="#FFD766"/><path d="M44.7,11.3c-0.6,0.4-1.6,1.1-2.7,2L33.4,12l-0.6,1.5l6.2,2.2c-1.8,1.5-4,3.3-4,3.3l-1.9-1.4l-0.9,0.8  l2.7,2.7c0,0,10.4-7,12.1-8.3C48.7,11.7,46.6,10.1,44.7,11.3z" fill="#4B687F"/><path d="  M44.7,11.3c-0.6,0.4-1.6,1.1-2.7,2L33.4,12l-0.6,1.5l6.2,2.2c-1.8,1.5-4,3.3-4,3.3l-1.9-1.4l-0.9,0.8l2.7,2.7c0,0,10.4-7,12.1-8.3  C48.7,11.7,46.6,10.1,44.7,11.3z" fill="none" stroke="#2C3E50" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/><line fill="none" stroke="#2C3E50" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="33" x2="43" y1="24" y2="24"/><line fill="none" stroke="#2C3E50" stroke-dasharray="0,3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="24" x2="24" y1="26" y2="51"/><line fill="none" stroke="#2C3E50" stroke-dasharray="0,3" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2" x1="40" x2="40" y1="56" y2="42"/><polyline fill="none" points="  56,22 56,54.5 40,59.5 24,54.5 8,59.5 8,26.5 24,21.8 " stroke="#2C3E50" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/><path d="  M24,22" fill="none" stroke="#2C3E50" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/><path d="  M40,40.1c0,0,13.6-9.2,13.6-22.5C53.6,10.1,47.5,4,40,4s-13.6,6.1-13.6,13.6c0,10,6.9,16.7,10.9,20.2L40,40.1z" fill="none" stroke="#2C3E50" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" stroke-width="2"/></svg>
             <h5 style="color:#0D5C75" class="text-center">TRAVELING BY AIR</h5>
            </div>
                <div class="card-body d-flex flex-column gap-2">
                   <p class="text-muted">
                        Catarman airport with its 30-meter wide and 1,520 m runway is served daily from Clark.
                        Calbayog City, Samar is located in the adjacent province of Samar, approximately 1-hour land trip to Catarman.
                   </p>

                   <div>
                   <svg  width="50" height="50" style="enable-background:new 0 0 48 48;" version="1.1" viewBox="0 0 48 48" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Icons"><ellipse cx="24" cy="38.97918" rx="2.97" ry="0.85673" style="fill:#4AA0EC;"/><g><path d="M23.99965,8.16195c-5.37,0-9.71002,4.35004-9.71002,9.71002c0,1.71002,0.44,3.31,1.23004,4.70001    l-0.01001,0.01001l7.76996,11.63c0.34003,0.51001,1.10004,0.51001,1.44,0l7.76001-11.63v-0.01001    c0.79004-1.39001,1.23004-2.98999,1.23004-4.70001C33.70967,12.51198,29.34962,8.16195,23.99965,8.16195z M24.32966,24.05196    c-2.84003,0.17999-5.29004-1.96997-5.47003-4.81c-0.17999-2.83002,1.98004-5.27997,4.82001-5.45996    c2.83002-0.18005,5.28003,1.97998,5.46002,4.81C29.31965,21.43197,27.15962,23.87197,24.32966,24.05196z" style="fill:#4AA0EC;"/><line style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="16.48186" x2="16.50631" y1="24.03164" y2="24.05609"/><path d="    M32.48301,22.58122l-7.76333,11.63006c-0.34316,0.51408-1.09871,0.51408-1.44187,0l-7.76333-11.63006l0.00163-0.0043    c-0.78238-1.39361-1.22246-2.99503-1.22246-4.70648c0-5.35438,4.33974-9.70635,9.70635-9.70635    c5.35439,0,9.70635,4.35197,9.70635,9.70635c0,1.71145-0.44009,3.31287-1.22247,4.70648L32.48301,22.58122z" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"/><path d="    M30.97119,15.14711c0.17787,0.62385,0.26063,1.28602,0.23215,1.96898" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"/><path d="    M25.22595,10.61856c2.09651,0.08741,3.91058,1.20312,4.9756,2.83991" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"/><ellipse cx="24" cy="18.91938" rx="5.14617" ry="5.14617" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" transform="matrix(0.998 -0.06316 0.06316 0.998 -1.14698 1.55354)"/></g><ellipse cx="24" cy="38.97918" rx="2.97" ry="0.85673" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"/></g></svg>
                   <p class="text-muted">
                        Catarman airport with its 30-meter wide and 1,520 m runway is served daily from Clark.
                        Calbayog City, Samar is located in the adjacent province of Samar, approximately 1-hour land trip to Catarman.
                   </p>
                   </div>
                </div>
           </div>
            <!--  card  end-->

            <!--  card start-->
            <div class="card col-lg-3">
                <div class="text-center">
                 <svg width="100" height="100" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><title/><g data-name="Day 23" id="65560156-bb18-44a0-80a1-df2ee73e9291"><rect data-name="&lt;Path&gt;" fill="#ab3535" height="5" id="3ca8cacb-1512-4e4f-b9cc-62d2141793e0" width="4" x="12" y="36"/><polygon data-name="&lt;Path&gt;" fill="#4fab35" id="a277caf0-9ea7-4510-89de-4d4e612a2fc7" points="40 46 40 47 29 47 29 43 40 43 40 46"/><polygon data-name="&lt;Path&gt;" fill="#799980" id="0c7a803c-a766-4599-a127-7e7028d2169b" points="29 41 29 47 8 47 10 41 29 41"/><polygon data-name="&lt;Path&gt;" fill="#87ab8f" id="4913c888-0f43-47ac-8fed-05abdabf4279" points="26 41 26 47 8 47 10 41 26 41"/><path d="M40,33v5H19c2.12-1.77,4-3.52,5.77-5.23L25,33Z" data-name="&lt;Path&gt;" fill="#71a3de" id="269c492a-2393-473b-907a-08bb4e9f9f07"/><path d="M40,28v5H25l-.23-.23c1.8-1.76,3.39-3.48,4.81-5.12L30,28Z" data-name="&lt;Path&gt;" fill="#8171de" id="4d04966b-610c-4ce7-8537-db01e2669631"/><path d="M40,11V23H34l-.47-.34C38.53,15.74,40,11,40,11Z" data-name="&lt;Path&gt;" fill="#8171de" id="b9c44f9e-eb86-4bcf-89bb-60d667659742"/><path d="M40,23v5H30l-.42-.35c1.52-1.76,2.82-3.43,4-5L34,23Z" data-name="&lt;Path&gt;" fill="#71a3de" id="62c2d1c0-eca4-4701-99e4-1de0711b3975"/><polygon data-name="&lt;Path&gt;" fill="#5197e8" id="62f66bd6-2b1b-4fde-911b-97d867722d98" points="57 38 41 44 40 43 40 10 57 38"/><polygon data-name="&lt;Path&gt;" fill="#71a3de" id="2e5a9874-c0e8-488c-a78d-3a0ca47bd5aa" points="55 35 40 40.63 40 10.29 55 35"/><circle cx="16.5" cy="50.5" data-name="&lt;Path&gt;" fill="#001c63" id="442a95f0-5597-42fc-b6cd-2111c5cad8ed" r="1.5"/><path d="M13,50.5A1.5,1.5,0,1,0,11.5,52,1.5,1.5,0,0,0,13,50.5ZM8,47H59l-7,8H7L5,47Zm8.5,5A1.5,1.5,0,1,0,15,50.5,1.5,1.5,0,0,0,16.5,52Z" data-name="&lt;Compound Path&gt;" fill="#35a9ab" id="9d9f3440-4558-4629-adb2-ba97be6cefe9"/><circle cx="11.5" cy="50.5" data-name="&lt;Path&gt;" fill="#001c63" id="df21d2fc-171a-4fb8-a36d-d58780cdf221" r="1.5"/><polyline data-name="&lt;Path&gt;" fill="none" id="e94752b6-95ea-42e8-acdd-fb86b248fd50" points="40 47 59 47 52 55 7 55 5 47 8 47" stroke="#001c63" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polyline data-name="&lt;Path&gt;" fill="none" id="014f8140-4ebc-4452-bff8-e46dfc0f535e" points="40 10 40 11 40 23 40 28 40 33 40 38 40 43" stroke="#001c63" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polyline data-name="&lt;Path&gt;" fill="none" id="56a9845b-bfbf-4937-b193-1a5d05134fe0" points="41 44 57 38 40 10" stroke="#001c63" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><path d="M40,11s-1.47,4.74-6.47,11.66c-1.13,1.56-2.43,3.23-4,5s-3,3.36-4.81,5.12S21.12,36.23,19,38H40" data-name="&lt;Path&gt;" fill="none" id="457fd5b6-2ad3-4d7f-a877-851eab760141" stroke="#001c63" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polygon data-name="&lt;Path&gt;" fill="#99de8a" id="cf279158-eb3d-4d86-aba7-5948a638b50d" points="40 5 40 4 48 4 46.55 7 48 10 40 10 40 5"/><polygon data-name="&lt;Path&gt;" fill="none" id="1849c745-a381-47a7-b646-df22d62aea9c" points="40 5 40 4 48 4 46.55 7 48 10 40 10 40 5" stroke="#001c63" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polyline data-name="&lt;Path&gt;" fill="none" id="e3e4909f-ae9c-424a-883f-208cf9f3c1de" points="16 41 29 41 29 43" stroke="#001c63" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polyline data-name="&lt;Path&gt;" fill="none" id="a6be86c7-662b-4d39-87ef-9604bdbadca9" points="29 47 8 47 10 41 12 41" stroke="#001c63" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><polygon data-name="&lt;Path&gt;" fill="none" id="20466da3-0e60-4209-b17c-5048756e8ea4" points="29 47 40 47 40 46 40 43 29 43 29 47" stroke="#001c63" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/><rect data-name="&lt;Path&gt;" fill="none" height="5" id="1f7c4c59-06f0-4a02-a219-78ec7c4a8672" stroke="#001c63" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" width="4" x="12" y="36"/><line data-name="&lt;Path&gt;" fill="none" id="14d81c41-ed26-4af5-9faf-c9277744b44f" stroke="#001c63" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="14" x2="18" y1="44" y2="44"/><line data-name="&lt;Path&gt;" fill="none" id="04294ee8-8686-40ac-90e6-d38ee3e94ed2" stroke="#001c63" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="25" x2="40" y1="33" y2="33"/><line data-name="&lt;Path&gt;" fill="none" id="eed5d46c-15bf-458e-a798-4ebc8e4a98a1" stroke="#001c63" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="30" x2="40" y1="28" y2="28"/><line data-name="&lt;Path&gt;" fill="none" id="4d572ca5-46ea-43a2-a64f-b41a66b8e96e" stroke="#001c63" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="34" x2="40" y1="23" y2="23"/><line data-name="&lt;Path&gt;" fill="none" id="d08ba41a-373e-4fe0-9cd2-c6a2060c83ce" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="51" x2="43" y1="50" y2="50"/><line data-name="&lt;Path&gt;" fill="#0D5C75" id="99be269a-af17-4491-8d9a-c0f8170225b5" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" x1="40" x2="40" y1="50" y2="50"/></g></svg>
                    <h5 style="color:#0D5C75" class="text-center">TRAVELING BY SEA</h5>
                </div>
                <div class="card-body d-flex flex-column gap-2">
                    <p class="text-muted">
                        Northern Samar Ports, particularly located in the municipalities of Allen and San Isidro are being serviced from 4-10 trips daily by shipping lines that have ferry boats or vessel that sail from Matnog Sorsogon, transporting passengers coming from luzon to the islands of Visayas and Mindanao all passing thru Northern Samar.
                        Northern Samar is also accessible by sea from Cebu taking the Cebu-Calbayog, SeaCat Ferries.
                    </p>

                    <div>
                        <svg  width="50" height="50" style="enable-background:new 0 0 48 48;" version="1.1" viewBox="0 0 48 48" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Icons"><ellipse cx="24" cy="38.97918" rx="2.97" ry="0.85673" style="fill:#4AA0EC;"/><g><path d="M23.99965,8.16195c-5.37,0-9.71002,4.35004-9.71002,9.71002c0,1.71002,0.44,3.31,1.23004,4.70001    l-0.01001,0.01001l7.76996,11.63c0.34003,0.51001,1.10004,0.51001,1.44,0l7.76001-11.63v-0.01001    c0.79004-1.39001,1.23004-2.98999,1.23004-4.70001C33.70967,12.51198,29.34962,8.16195,23.99965,8.16195z M24.32966,24.05196    c-2.84003,0.17999-5.29004-1.96997-5.47003-4.81c-0.17999-2.83002,1.98004-5.27997,4.82001-5.45996    c2.83002-0.18005,5.28003,1.97998,5.46002,4.81C29.31965,21.43197,27.15962,23.87197,24.32966,24.05196z" style="fill:#4AA0EC;"/><line style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="16.48186" x2="16.50631" y1="24.03164" y2="24.05609"/><path d="    M32.48301,22.58122l-7.76333,11.63006c-0.34316,0.51408-1.09871,0.51408-1.44187,0l-7.76333-11.63006l0.00163-0.0043    c-0.78238-1.39361-1.22246-2.99503-1.22246-4.70648c0-5.35438,4.33974-9.70635,9.70635-9.70635    c5.35439,0,9.70635,4.35197,9.70635,9.70635c0,1.71145-0.44009,3.31287-1.22247,4.70648L32.48301,22.58122z" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"/><path d="    M30.97119,15.14711c0.17787,0.62385,0.26063,1.28602,0.23215,1.96898" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"/><path d="    M25.22595,10.61856c2.09651,0.08741,3.91058,1.20312,4.9756,2.83991" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"/><ellipse cx="24" cy="18.91938" rx="5.14617" ry="5.14617" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" transform="matrix(0.998 -0.06316 0.06316 0.998 -1.14698 1.55354)"/></g><ellipse cx="24" cy="38.97918" rx="2.97" ry="0.85673" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"/></g></svg>
                        <div class="d-flex flex-column gap-3">
                            <h6 style="color:#0D5C75" class="text-muted">
                                FLIGHT ROUTE/FREQUENCY/SCHEDULE
                            </h6>
                            <p class="text-muted">
                                CATARMAN
                                Philippine Airlines:
                                4 flights every week, <strong >11:30 AM</strong> arrival
                                Tuesday, Wednesday, Friday, Saturday
                            </p>
                            <p class="text-muted">
                                AIRLINE DIRECTORY:
                                Philippine Airlines
                                Catarman N. Samar
                                <strong >  Tel: 0917 723 9886</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--  card  end-->


            <!--  card start-->
            <div class="card col-lg-3">
                <div class="text-center">
                   <svg  width="100" height="100"  id="Layer_1" style="enable-background:new 0 0 512 512;" version="1.1" viewBox="0 0 512 512"
                         xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                       <g><path d="M336.4,292.9c-21.2,1.5-49.7,2.4-80.2,2.4c-30.5,0-58.9-0.8-80.2-2.4c-17.3-1.2-27.3-2.7-33.3-4.5   c0.6,25.8,1.8,51.7,3.5,78c0,4.7,1.8,9.3,5.3,12.9c1.2,1.2,2.5,1.8,3.9,2.1v25.4c0,5.3,4.3,9.6,9.6,9.6h27c5.3,0,9.6-4.3,9.6-9.6   v-25.4h108.4v25.4c0,5.3,4.3,9.6,9.6,9.6h27c5.3,0,9.6-4.3,9.6-9.6v-25.4c1.4-0.3,2.7-0.9,3.9-2.1c3.5-3.6,5.3-8.2,5.3-12.9   c1.8-26.3,2.9-52.2,3.5-77.9C363.3,290.2,353.3,291.7,336.4,292.9z M213.7,345.5c-0.1,5.4-4.2,9.3-9.1,9   c-10.4-0.5-15.3-0.9-26.2-1.7c-5.1-0.4-10.3-3.8-10.9-9.3c-0.3-2.2-0.4-3.4-0.6-5.8c-0.4-5.8,4.2-9.9,9.6-9.6   c11.2,0.8,16.8,1.1,28.1,1.6c5.3,0.2,9.4,4.7,9.3,10.2C213.8,342.2,213.7,343.3,213.7,345.5z M345.4,342.4   c-0.3,5.3-5.7,10-10.9,10.4c-11,0.8-16.1,1.1-26.8,1.7c-5.1,0.3-9.2-3.9-9.3-9.2c0-2.2-0.1-3.3-0.1-5.5c-0.2-5.3,3.9-9.8,9.2-10   c11.2-0.5,16.9-0.8,28.1-1.6c5.3-0.4,10,3.6,10,8.9C345.6,339.2,345.6,340.3,345.4,342.4z"/><path d="M398.8,135.7h-7.1c-5,0-9.1,3.9-9.6,8.8h-15.5c-0.3-5.5-0.6-11-1-16.6v-1.6c-41.4-41.1-178.1-41.1-219.4,0v1.6   c-0.4,5.6-0.7,11.1-1,16.6h-15.5c-0.4-4.9-4.5-8.8-9.6-8.8h-7.1c-5.3,0-9.6,4.3-9.6,9.6v50.8c0,5.3,4.3,9.6,9.6,9.6h7.1   c5.3,0,9.6-4.3,9.6-9.6v-44.4h15c-2.3,41.9-3,83-2.3,124.4c0.6,0.4,1.2,0.9,1.5,1.5c18.2,9.2,206,9.2,224.2,0   c0.3-0.5,0.7-0.9,1.2-1.3c0.7-41.4-0.1-82.6-2.3-124.7h15v44.4c0,5.3,4.3,9.6,9.6,9.6h7.1c5.3,0,9.6-4.3,9.6-9.6v-50.8   C408.4,140.1,404.1,135.7,398.8,135.7z M251.6,262l-71,1.2l43.9-48.1v26c0,2,1.6,3.6,3.6,3.6s3.6-1.6,3.6-3.6v-70.3   c0-2-1.6-3.6-3.6-3.6s-3.6,1.6-3.6,3.6v38.9l-55.3,53.6l-14.9,0.2V145.4c0-5.3,4.3-9.6,9.6-9.6h87.7V262z M359.6,264l-8.5-1.8   c-4.8-4.5-11.9-7.7-20-9.8l-44-42.7v-38.9c0-2-1.6-3.6-3.6-3.6c-2,0-3.6,1.6-3.6,3.6v70.3c0,2,1.6,3.6,3.6,3.6c2,0,3.6-1.6,3.6-3.6   v-26l32.1,35.2c-19.5-2.1-41.2,1.6-52,11.5l-4.9,0.1V135.7H350c5.3,0,9.6,4.3,9.6,9.6V264z"/></g></svg>
                    <h5 style="color:#0D5C75" class="text-center">TRAVELING BY LAND</h5>
                </div>
                <div class="card-body d-flex flex-column gap-2">
                    <p class="text-muted">
                        From manila one can either hop on a bus that emanates from Cubao Bus Terminal or Pasay Bus Terminals or bring own's vehicle all the way to the provincial capital, Catarman. Several bus companies offer daily trips to Catarman via the Maharlika Highway, passing thru the scenic Bicol Region to Matnog, Sorsogon. Travel time is 14 hours including a 1 hour ferry ride crossing on the famous Bernardino Strait to either Allen or San Isidro ports in Northern Samar.
                    </p>

                    <div>
                        <svg  width="50" height="50" style="enable-background:new 0 0 48 48;" version="1.1" viewBox="0 0 48 48" xml:space="preserve" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g id="Icons"><ellipse cx="24" cy="38.97918" rx="2.97" ry="0.85673" style="fill:#4AA0EC;"/><g><path d="M23.99965,8.16195c-5.37,0-9.71002,4.35004-9.71002,9.71002c0,1.71002,0.44,3.31,1.23004,4.70001    l-0.01001,0.01001l7.76996,11.63c0.34003,0.51001,1.10004,0.51001,1.44,0l7.76001-11.63v-0.01001    c0.79004-1.39001,1.23004-2.98999,1.23004-4.70001C33.70967,12.51198,29.34962,8.16195,23.99965,8.16195z M24.32966,24.05196    c-2.84003,0.17999-5.29004-1.96997-5.47003-4.81c-0.17999-2.83002,1.98004-5.27997,4.82001-5.45996    c2.83002-0.18005,5.28003,1.97998,5.46002,4.81C29.31965,21.43197,27.15962,23.87197,24.32966,24.05196z" style="fill:#4AA0EC;"/><line style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="16.48186" x2="16.50631" y1="24.03164" y2="24.05609"/><path d="    M32.48301,22.58122l-7.76333,11.63006c-0.34316,0.51408-1.09871,0.51408-1.44187,0l-7.76333-11.63006l0.00163-0.0043    c-0.78238-1.39361-1.22246-2.99503-1.22246-4.70648c0-5.35438,4.33974-9.70635,9.70635-9.70635    c5.35439,0,9.70635,4.35197,9.70635,9.70635c0,1.71145-0.44009,3.31287-1.22247,4.70648L32.48301,22.58122z" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"/><path d="    M30.97119,15.14711c0.17787,0.62385,0.26063,1.28602,0.23215,1.96898" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"/><path d="    M25.22595,10.61856c2.09651,0.08741,3.91058,1.20312,4.9756,2.83991" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"/><ellipse cx="24" cy="18.91938" rx="5.14617" ry="5.14617" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" transform="matrix(0.998 -0.06316 0.06316 0.998 -1.14698 1.55354)"/></g><ellipse cx="24" cy="38.97918" rx="2.97" ry="0.85673" style="fill:none;stroke:#303030;stroke-width:0.7;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"/></g></svg>
                        <p class="text-muted">
                            The most popular modes of transport in and around Northern Samar, particularly within the capital town of Catarman are pedicabs and tricycles.
                            To reach the neighboring towns of Catarman, there are available
                            jeepneys at the Catarman terminal station. Tricycles can also be found at
                            the terminal if one wishes to go to places within10km radius from the capital town. Other neighboring towns can easily be reached by riding a jeepney.
                        </p>
                    </div>
                </div>
            </div>
            <!--  card  end-->
        </div>
    </div>

    <div class="container-fluid">
        <div class="card border-0 p-3">
            <h1 style="font-family: Roboto, sans-serif; color:#0D5C75" class="fw-bold text-center">
                THE MAP OF NORTHERN SAMAR
            </h1>
            <img src="./assets/img/mapa.png" alt="map">
        </div>
    </div>

    <footer id="footer" style="background-color: #0D5C75" class="text-light py-4">
        <div class="container">
            <div class="row">
                <!-- About Section -->
                <div class="col-md-4 mb-3">
                    <h5>About TourHub</h5>
                    <p>Discover amazing places with TourHub. We strive to provide the best travel experiences with reliability and exceptional customer service.</p>
                </div>
                <!-- Quick Links -->
                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-light text-decoration-none">Home</a></li>
                        <li><a href="#" class="text-light text-decoration-none">About Us</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Contact Us</a></li>
                        <li><a href="#" class="text-light text-decoration-none">Reviews</a></li>

                    </ul>
                </div>
                <!-- Contact Section -->
                <div class="col-md-4 mb-3">
                    <h5>Contact Us</h5>
                    <p><i class="bi bi-envelope"></i> support@tourhub.com</p>
                    <p><i class="bi bi-telephone"></i> +123 456 7890</p>
                    <p><i class="bi bi-geo-alt"></i> 123 Tour Street, Wanderlust City</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col text-center">
                    <a href="#" class="text-light me-2"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-light me-2"><i class="bi bi-t.witter"></i></a>
                    <a href="#" class="text-light me-2"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-light me-2"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col text-center">
                    <p class="mb-0">&copy; 2025 TourHub. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal for Register -->
    <form class="modal fade" id="RegisterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" ariimg-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div style="background-color: #0D5C75" class="modal-header text-light">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Sign Up</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" name="FirstName" class="form-control border-3" id="FirstName" placeholder="First Name">
                        <label for="FirstName">First Name</label>
                        <div class="invalid-feedback" id="FirstName_msg"></div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="LastName" class="form-control border-3" id="LastName" placeholder="Last Name">
                        <label for="LastName">Last Name</label>
                        <div class="invalid-feedback" id="LastName_msg"></div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" name="Username" class="form-control " id="Username" placeholder="Username">
                        <label for="Username">Username</label>
                        <div class="invalid-feedback" id="Username_msg"></div>
                    </div>

                    <div class="form-floating mb-3">
                        <input autocomplete="password" name="password" type="password" class="form-control  " id="password" placeholder="Password">
                        <label for="password">Password</label>
                        <div class="invalid-feedback" id="password_msg"></div>
                    </div>

                    <div class="form-floating mb-3">
                        <input name="email" type="email" class="form-control" id="email" placeholder="name@example.com">
                        <label for="email">Email address</label>
                        <div class="invalid-feedback" id="email_msg"></div>
                    </div>

                    <div class="form-floating mb-3">
                        <input name="Address" type="text" class="form-control border-3 " id="Address" placeholder="Address">
                        <label for="Address">Address</label>
                        <div class="invalid-feedback" id="Address_msg"></div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" name="phoneNumber" class="form-control" id="phoneNumber" placeholder="phoneNumber">
                        <label for="phoneNumber">PhoneNumber</label>
                        <div class="invalid-feedback" id="phoneNumber_msg"></div>
                    </div>

                    <div class="form-floating mb-3">
                        <input name="contactPerson" type="number" class="form-control" id="contactPerson" placeholder="ContactPerson">
                        <label for="contactPerson">Contact Person</label>
                        <div class="invalid-feedback" id="contactPerson_msg"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button style="background-color: #0D5C75" id="btn_register" type="submit" class="btn text-light">Register</button>
                </div>
            </div>
        </div>
    </form>


    <!-- Modal for login -->
    <form class="modal fade" id="LoginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-3"  style="color: #0D5C75" id="messageDis">Welcome Back</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input name="username" type="text" class="form-control" id="username" placeholder="username">
                        <label for="username">Username</label>
                        <div class="invalid-feedback" id="username_msg"></div>
                    </div>

                    <div class="form-floating mb-3">
                        <input name="Password" autocomplete="password" type="password" class="form-control" id="Password" placeholder="Password">
                        <label for="Password">Password</label>
                        <div class="invalid-feedback" id="Password_msg"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button style="background-color: #0D5C75" id="btn_login" type="submit" class="btn text-light">Login</button>
                </div>
            </div>
        </div>
    </form>
<section>
    <?php
    include 'includes/modal_where_ToStay.php';
    include 'includes/modal_where_ToEat.php';
    include 'includes/DisplayContactModal.php';
    ?>
</section>

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./src/JQUERY/Auth.js"></script>
</body>

</html>
<!-- Initialize Swiper -->
<script>
    const swiper = new Swiper('.mySwiper', {
        slidesPerView: 1,
        spaceBetween: 10,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 4,
                spaceBetween: 40,
            },
        },
    });
</script>

<script>
    $(document).ready(function() {
        $.ajax({
            url: 'src/controllers/municipalityController.php',
            type: 'POST',
            data: {
                action: 'topPlaces'
            },
            success: function(data) {
                $('#TopTreeContainer').html(data)
            }
        })

        $.ajax({
            url: 'src/controllers/reviewsController.php',
            type: 'POST',
            data: {
                action: 'showAll'
            },
            success: function(data) {
                $('#reviewContainer').html(data)
            }
        })

        $.ajax({
            url: 'src/controllers/where_to_stayController.php',
            type: 'POST',
            data: {
                action: 'show'
            },
            success: function(data) {
                $('#whereStayList').html(data);
            }
        })

   $.ajax({
            url: 'src/controllers/Contact_AndHotLinesController.php',
            type: 'POST',
            data: {
                action: 'Display'
            },
            success: function(data) {
                $('#listContact').html(data);
            }
        })



        $(document).on('change','#filterSelect',function (e){
            $.ajax({
                url: 'src/controllers/where_to_stayController.php',
                type: 'POST',
                data: {action: 'filter', municipality: e.target.value},
                success: function (data){
                   $('#whereStayList').html(data)
                }
            })
        })

        $.ajax({
            url: 'src/controllers/where_to_stayController.php',
            type: 'POST',
            data: {
                action: 'showToSelectMunicipality'
            },
            success: function(data) {
               $('#filterSelect').html(data)
            }
        })

         $.ajax({
            url: 'src/controllers/where_to_eatController.php',
            type: 'POST',
            data: {
                action: 'showCategoryAndMunicipality'
            },
            success: function(data) {
             $('#container_Selects').html(data)
            }
        })

        $.ajax({
            url: 'src/controllers/where_to_eatController.php',
            type: 'POST',
            data: {
                action: 'showAll'
            },
            success: function(data) {
                $('#whereEatList').html(data)
            }
        })

        $(document).on('submit','#container_Selects',function (event){
            event.preventDefault()
            const DataForm = new FormData (this)
            DataForm.append('action','Filter')
            $.ajax({
                url: 'src/controllers/where_to_eatController.php',
                type: 'POST',
                data: DataForm,
                contentType: false,
                processData: false,
                success: function (data){
                   $('#whereEatList').html(data)
                }
            })
        })

    })
</script>