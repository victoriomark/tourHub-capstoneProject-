<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Events</title>
    <?php
    include '../../includes/links.php';
    ?>
</head>
<body>
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="Dashboard.php">TourHub</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
            <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="Dashboard.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <?php
                    include '../../includes/adminNav.php';
                    ?>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Admin
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="mt-4">Manage Events</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="Dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Events</li>
                        </ol>
                    </div>
                    <div>
                        <button data-bs-target="#modalCreateEvents" data-bs-toggle="modal" class="btn btn-primary">Create New Event</button>
                    </div>
                </div>
                <div class="card mb-4 p-3">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>image</th>
                                <th>Patron Name</th>
                                <th>Festival Date</th>
                                <th>Fiesta Date</th>
                                <th>Location</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            include '../controllers/eventsController.php';
                            use controllers\eventsController;
                            eventsController::showAll();
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>


<!-- Modal for creating event -->
<form class="modal fade" id="modalCreateEvents" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Event Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <textarea class="form-control" name="Description" placeholder="Description" id="Description" style="height: 100px"></textarea>
                    <label for="Description">Description</label>
                    <div id="Description_msg" class="invalid-feedback" ></div>
                </div>

                <select id="Location" name="Location" class="form-select form-select-lg mb-3" aria-label="Large select example">
                    <?php
                    include '../controllers/municipalityController.php';
                    \controllers\municipalityController::showTitle_Id();
                    ?>
                </select>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nameOfPatron" placeholder="nameOfPatron" name="nameOfPatron">
                    <label for="nameOfPatron">nameOfPatron</label>
                    <div id="nameOfPatron_msg" class="invalid-feedback" ></div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="FestivalName" placeholder="FestivalName" name="FestivalName">
                    <label for="FestivalName">FestivalName</label>
                    <div id="FestivalName_msg" class="invalid-feedback" ></div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="FiestaDate"  name="FiestaDate">
                    <label for="FiestaDate">FiestaDate</label>
                    <div id="FiestaDate_msg" class="invalid-feedback" ></div>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="FestivalDate"  name="FestivalDate">
                    <label for="FestivalDate">FestivalDate</label>
                    <div id="FestivalDate_msg" class="invalid-feedback" ></div>
                </div>

                <label for="image" class="border-1">
                    <input type="file" accept="image/jpeg,image/png" name="image">
                </label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="../../js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="../../js/datatables-simple-demo.js"></script>
<script src="../JQUERY/events.js"></script>
</body>
</html>
