
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Where to eat</title>
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
                        <h1 class="mt-4">Manage Where to Eat</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="Dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Where to Eat</li>
                        </ol>
                    </div>
                    <div>
                        <button data-bs-target="#modalToWhereToEat" data-bs-toggle="modal" class="btn btn-primary">Create</button>
                    </div>
                </div>
                <div class="card mb-4 p-3">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Place</th>
                                <th>Municipality</th>
                                <th>Municipality</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            require '../controllers/where_to_eatController.php';
                            \controllers\where_to_eatController::showAllToAdmin();
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


<form class="modal fade" id="modalToWhereToEat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h1 class="modal-title fs-5 text-light" id="staticBackdropLabel">Where To Stay</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="PlaceName" placeholder="PlaceName" name="PlaceName">
                    <label for="PlaceName">PlaceName</label>
                </div>

                <select id="municipality" name="municipality" class="form-select form-select-lg mb-3" aria-label="Large select example">
                    <?php
                    include '../controllers/municipalityController.php';
                    \controllers\municipalityController::showMunicipality();
                    ?>
                </select>

                <select name="category" class="form-select" aria-label="Default select example">
                    <option selected>Select Category</option>
                    <option value="Restaurant">Restaurant</option>
                    <option value="Coffee Shop">Coffee Shop</option>
                    <option value="Night Scene">Night Scene</option>
                </select>

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
<script src="../JQUERY/WhereToEat.js"></script>
</body>
</html>

