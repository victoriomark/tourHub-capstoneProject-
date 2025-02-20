<!doctype html><html lang="en"><head>    <meta charset="UTF-8">    <meta name="viewport"          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">    <meta http-equiv="X-UA-Compatible" content="ie=edge">    <link href="https://fonts.cdnfonts.com/css/ninja-naruto" rel="stylesheet">    <link rel="stylesheet" href="../../css/card.css">    <title>Festival</title>    <?php    include '../../includes/links.php';    ?>    <style>        .hero{            background-position: center;            background-repeat: no-repeat;            background-size: cover;            height: 60vh;            display: flex;            flex-direction: column;            background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(16, 12, 12, 0.8)), url('../../assets/img/bg.jpg')        }        .btn-group ul li {            padding: 10px;        }        .btn-group ul li:hover {            background-color: #000000;            padding: 10px;            color: white;        }        .btn-group ul {            padding: 10px;        }        @media only screen and (min-width: 1200px) {            .card img{                object-fit: cover;                min-height: 100%;            }        }        .text-overlay {            font-size: 100px;            font-weight: bold;            text-transform: uppercase;            background: url('../../assets/img/bg.jpg') no-repeat center;            background-size: cover;            -webkit-background-clip: text;            color: transparent;            display: inline-block;        }        .text-logo {            font-weight: bold;            text-transform: uppercase;            background: url('../../assets/img/bg.jpg') no-repeat center;            background-size: cover;            -webkit-background-clip: text;            color: transparent;            display: inline-block;        }    </style></head><body><!-- Hero Page --><section class="hero">    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent p-3 sticky-top ">        <div class="container">            <a class="navbar-brand" href="#">                <h5 class="text-logo">INFORMATION HUB</h5>            </a>            <button                class="navbar-toggler"                type="button"                data-bs-toggle="collapse"                data-bs-target="#navbarNav"                aria-controls="navbarNav"                aria-expanded="false"                aria-label="Toggle navigation"            >                <span class="navbar-toggler-icon"></span>            </button>            <div class="collapse navbar-collapse" id="navbarNav">                <ul class="navbar-nav me-auto mb-2 mb-lg-0">                </ul>                <div class="d-flex gap-3">                    <div class="btn-group">                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">                          Menu                        </button>                        <ul class="dropdown-menu">                            <li class="nav-item">                                <a class="nav-link fw-bold text-danger" href="userViewAfterLogin.php">Places</a>                            </li>                            <li class="nav-item">                                <a class="nav-link fw-bold text-danger" href="../../index.php">Home</a>                            </li>                        </ul>                    </div>                </div>            </div>        </div>    </nav>    <div style="height: 50vh" class="container d-flex flex-column justify-content-center align-items-center text-danger">        <div class="text-light text-center">            <h2 class="text-overlay">PLAN YOUR TRIP WITH <span class=" fs-1">INFORMATION HUB</span></h2>            <p class="mt-3">Discover amazing places at exclusive deals. Join us to explore the world with ease and comfort.</p>        </div>    </div></section><section class="p-5">    <div class="p-5 bg-gray-100 bg-opacity-75 text-center">        <h1 class="text-3xl font-bold text-gray-800">FESTIVAL</h1>        <p class="text-gray-600 text-lg">Discover the festival of Northern Samar</p>    </div>    <div class="container-fluid row gap-3 justify-content-center align-items-center p-3">        <?php          include '../controllers/eventsController.php';          \controllers\eventsController::showAllCard();        ?>    </div></section><!-- Footer --><div>    <?php    include '../../includes/footer.php';    ?></div><script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script></body></html>