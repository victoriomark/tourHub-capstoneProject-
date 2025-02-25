
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../css/card.css">
    <title>Attraction</title>
    <?php
    include '../../includes/links.php';
    ?>
    <style>
        h2{
            font-family: 'Ninja Naruto', sans-serif;
        }

        .hero{
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 60vh;
            display: flex;
            flex-direction: column;
            background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(16, 12, 12, 0.8)), url('../../assets/img/lighthouse.jpg')
        }



        .btn-group ul li {
            padding: 10px;
        }
        .btn-group ul li:hover {
            background-color: #000000;
            padding: 10px;
            color: white;
        }
        .btn-group ul {
            padding: 10px;
        }

        #box{
            width: 100px;
            height: 100px;
            border-radius: 20px 50px;
            /* From https://css.glass */
            background: rgba(255, 255, 255, 0.07);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(1.6px);
            -webkit-backdrop-filter: blur(1.6px);
            border: 1px solid rgba(255, 255, 255, 0.04);
        }

            #hero_{
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                height: 50vh;
                background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(16, 12, 12, 0.8)), url('../../assets/img/bg.jpg')
            }

        .hero_{
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            height: 50vh;
            background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.5), rgba(16, 12, 12, 0.8)), url('../../assets/img/188bce12-39ca-4f56-9ba5-65c2ed0fd634.jpg')
        }

        .text-overlay {
            font-size: 100px;
            font-weight: bold;
            text-transform: uppercase;
            background: url('../../assets/img/bg.jpg') no-repeat center;
            background-size: cover;
            -webkit-background-clip: text;
            color: transparent;
            display: inline-block;
        }

         .text-logo {
            font-weight: bold;
            text-transform: uppercase;
            background: url('../../assets/img/bg.jpg') no-repeat center;
            background-size: cover;
            -webkit-background-clip: text;
            color: transparent;
            display: inline-block;
        }

    </style>
</head>
<body>

<!-- Hero Page -->
<section class="hero">
    <nav class="navbar navbar-expand-lg navbar-dark p-3 sticky-top ">
        <div class="container">
            <a class="navbar-brand" href="#">
                <h5 class="text-logo">INFORMATION HUB</h5>
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
                </ul>


                <div class="d-flex gap-3">
                    <div class="btn-group">
                        <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                           Menu
                        </button>
                        <ul class="dropdown-menu">
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-danger" href="userViewAfterLogin.php">Places</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-danger" href="userFestivalView.php">Festivals</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link fw-bold text-danger" href="../../index.php">Home</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div style="height: 50vh" class="container d-flex flex-column justify-content-center align-items-center text-danger">
        <div class="text-light text-center">
            <?php
            $Title = $_POST['Title'];
            if (empty($Title)){// check if empty then if true back to home
                header('Location: userViewAfterLogin.php');
            }
            ?>
            <h2 class="text-overlay"><?= $Title ?></h2>
            <?php
            ?>

        </div>
    </div>
</section>

<section class="p-5">
    <div class="p-5 bg-gray-100 bg-opacity-75 text-center">
        <h1 class="text-3xl font-bold text-gray-800">ATTRACTION</h1>
        <p class="text-gray-600 text-lg">Discover the Atractions of Northern Samar</p>
    </div>


    <div class="container-fluid row gap-3 justify-content-center align-items-center p-3">
        <?php
        $Id = $_POST['Id'];
        if (empty($Id)){
            header('Location: userViewAfterLogin.php');
        }
        include '../controllers/touristController.php';
        use controllers\touristController;
        touristController::showTouristListBaseOnMunicipalityId($Id);
        ?>
    </div>
</section>

<section id=""  class="container-fluid hero_ bg-success row  justify-content-evenly gap-3 align-items-center">

    <div id="box" class="d-flex placeholder-wave flex-column justify-content-center align-items-center">
        <button style="background-color: #0D5C75" id="show_iterinary" data-file="" class="btn">
            <i class="fa-solid text-light fa-plane-departure"></i>
        </button>
        <span class="text-light fw-bold">Iterinary</span>
    </div>

    <div id="box" class="d-flex flex-column placeholder-wave justify-content-center align-items-center">
        <button  style="background-color: #0D5C75" data-bs-target="#showTest" data-bs-toggle="modal" class="btn">
            <i class="fa-solid fa-utensils text-light"></i>
        </button>
        <span  class="text-light fw-bold">
            Restaurant
        </span>
    </div>

    <div id="box" class="d-flex placeholder-wave flex-column justify-content-center align-items-center">
        <button style="background-color: #0D5C75" data-bs-target="#show_where_stay" data-bs-toggle="modal" class="btn">
            <i class="fa-solid fa-house-user text-light"></i>
        </button>
        <span  class="text-light fw-bold">
            Hotels
        </span>
    </div>

    <div id="box" class="d-flex placeholder-wave flex-column justify-content-center align-items-center">
        <a href="https://maps.app.goo.gl/Y16Nwn6UWteuj6vV9" style="background-color: #0D5C75"  class="btn">
            <i class="fa-solid fa-map-location-dot text-light"></i>
        </a>
        <span  class="text-light fw-bold">
           Location
        </span>
    </div>

</section>

<!-- Modal for where to eat -->
<div class="modal fade" id="showTest" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Nearest Restaurant</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Place</th>
                        <th scope="col">Category</th>
                        <th scope="col">Municipality</th>
                    </tr>
                    </thead>
                    <tbody id="Con_test">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for where to eat -->
<div class="modal fade" id="show_where_stay" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Nearest Hotel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Place</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">Municipality</th>
                    </tr>
                    </thead>
                    <tbody id="Con_stay">

                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="title_" value="<?= $Title ?>">
<!-- Footer -->
<div>
    <?php
    include '../../includes/footer.php';
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../JQUERY/tourist.js"></script>
</body>
</html>


<script>
    $(document).ready(function (){
      var municipality =  $('#title_').val()

        $.ajax({
            url: '../controllers/where_to_eatController.php',
            type: 'POST',
            data: {
                action: 'showByMunicipality_',
                municipality: municipality
            },
            success: function(data) {
                $('#Con_test').html(data)
            }
        })

         $.ajax({
            url: '../controllers/where_to_stayController.php',
            type: 'POST',
            data: {
                action: 'showByMunicipality_',
                municipality: municipality
            },
            success: function(data) {
                $('#Con_stay').html(data)
            }
        })

        $('#show_iterinary').click(function () {

            $.ajax({
                url: '../controllers/IterinaryController.php',
                type: 'POST',
                data: {
                    action: 'show_iterinary_',
                    municipality: municipality
                },
                success: function (data) {
                    console.log("PDF File:", data);

                    if (data.trim() !== "No Pdf Uploaded") {
                        $('#show_iterinary').attr("data-file", data);
                        window.open(data, '_blank'); // Open PDF in a new tab
                    } else {
                        alert("No PDF uploaded for this municipality.");
                    }
                }
            });
        });

        $('#show_iterinary').click(function () {
            let pdfFile = $(this).attr('data-file');
            if (pdfFile) {
                window.open(pdfFile, '_blank'); // Open PDF in new tab
            } else {
                alert("No PDF available.");
            }
        });
    })



</script>