<?php
session_start();
if (isset($_SESSION['userId'])){
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Home</title>
    <style>

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
            max-width: 320px; /* Limit card width for better mobile fit */
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
                max-width: 600px; /* Adjust for tablets */
            }
        }

        @media (min-width: 1024px) {
            #card {
                max-width: 1000px; /* Adjust for larger screens */
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
            aria-label="Toggle navigation"
        >
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
    <section  style="background-color: #0D5C75; height: 50vh; "  class="container-fluid d-flex flex-column justify-content-center align-items-center">
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
            <h5  style="color: #0D5C75" class="card-title">Dress/What to Bring (For Tourist)</h5>
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
                <a href="#" class="text-light me-2"><i class="bi bi-twitter"></i></a>
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
<form class="modal fade" id="RegisterModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                <h1 class="modal-title fs-5" id="messageDis">Sign In</h1>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="./src/JQUERY/Auth.js"></script>
</body>
</html>
<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

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
    $(document).ready(function (){
        $.ajax({
            url: 'src/controllers/municipalityController.php',
            type: 'POST',
            data:{action: 'topPlaces'},
            success: function (data){
               $('#TopTreeContainer').html(data)
            }
        })

        $.ajax({
            url: 'src/controllers/reviewsController.php',
            type: 'POST',
            data:{action: 'showAll'},
            success: function (data){
                $('#reviewContainer').html(data)
            }
        })

    })

</script>
