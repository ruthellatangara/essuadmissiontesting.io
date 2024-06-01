<?php
session_start();
include 'includes/header.php';
require 'stu-archive.php';

if (isset($_SESSION['email'])) {
        $total_app_query = "SELECT * from account_tab where stat=1";
        $total_app_query_run = mysqli_query($con,$total_app_query);
        $total_app = mysqli_num_rows($total_app_query_run);

        $permitted_query = "SELECT * from account_tab where stat1=1";
        $permitted_query_run = mysqli_query($con,$permitted_query);
        $permitted = mysqli_num_rows($permitted_query_run);

        $result_query = "SELECT * from result_tab where stat=1";
        $result_query_run = mysqli_query($con,$result_query);
        $result = mysqli_num_rows($result_query_run);


    echo '
        <aside id="left-panel" class="left-panel bg-success">
                <nav class="navbar navbar-expand-sm navbar-default bg-success">

                    <div class="navbar-header">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand" href="#"><img src="img/essu-logo.png" alt="Logo" style="width: 65px;">
                        <div class="text-white font-weight-bold"><span style="font-size: 24px; font-family:"Segoe UI">ESSU</span></div>
                        <a class="navbar-brand hidden" href="#"><img src="img/essu-logo.png" alt="Logo" 
                        style="width: 100px;"></a>
                    </div>
                    <div id="main-menu" class="main-menu collapse navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active">
                                <a href="adm-dashboard.php" class="text-white"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                            </li>
                            <h3 class="menu-title text-white"><i class="menu-icon fa fa-folder"></i> APPLICANTS DETAILS</h3>
                            <li>
                                <a href="adm-all-app.php"> <i class="menu-icon fa fa-eye"></i>See all Applicants</a>
                            </li>
                            <li>
                                <a href="adm-permit-list.php" > <i class="menu-icon ti-pin2"></i>Permit Applicants</a>
                            </li>
                            <li>
                                <a href="adm-all-permitted.php" > <i class="menu-icon ti-check-box"></i>Permitted Applicants List</a>
                            </li>
                            <h3 class="menu-title text-white"><i class="menu-icon fa fa-folder"></i> ENTRANCE EXAM RESULT</h3>
                            <li >
                                <a href="adm-result.php"> <i class="menu-icon ti-pencil-alt"></i>Input Exam Result</a>
                            </li>
                            <li>
                                <a href="adm-all-result.php"> <i class="menu-icon ti-layers"></i>Exam Result List</a>
                            </li>
                            <li class="menu-title">
                                
                            </li>
                            <li class="menu-item-has-children dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Settings</a>
                                <ul class="sub-menu children dropdown-menu bg-success">
                                    <li><a href="adm-program-list.php"><i class="fa fa-tasks"></i> Program</a></li>
                                    <li><a href="adm-acadyear.php"><i class="fa fa-tasks"></i> Academic Year</a></li>
                                    <li><a href="adm-tsched.php"><i class="fa fa-calendar"></i> Testing Schedule</a></li>
                                    <li><a href="adm-tcenter.php"><i class="fa fa-map-marker"></i> Testing Center</a></li>
                                    <li><a href="db_backup.php"><i class="fa fa-suitcase"></i> Backup Data</a></li>
                                </ul>
                            </li>
                            <li class="menu-title"i>
                                
                            </li>
                            <li class="menu-item-has-children dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder"></i>Archives</a>
                                <ul class="sub-menu children dropdown-menu bg-success">
                                    <li><a href="#" data-toggle="modal" data-target="#application"><i class="fa fa-eye"></i> Application Form</a></li>
                                    <li><a href="#" data-toggle="modal" data-target="#exam"><i class="fa fa-eye"></i> Exam Result</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </aside>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Are you sure you want to logout?</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">No</button>
                        <a class="btn btn-primary" href="logout.php">Yes</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="application" tabindex="-1" role="dialog" aria-labelledby="application"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="applicationlbl">See archived application form</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="adm-archi-appli.php" method="POST">

                            <div class="modal-body">
                                <div class="form-group">
                                <label>Select Academic Year: </label>
                                    <input type="text" name="application" id="application">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="yes" class="btn btn-primary">Search</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="modal fade" id="exam" tabindex="-1" role="dialog" aria-labelledby="exam"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-center" id="examlbl">See archived exam result</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="adm-archi-result.php" method="POST">

                            <div class="modal-body">
                                <div class="form-group">
                                <label>Select Academic Year: </label>
                                    <input type="text" name="exam" id="exam">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" name="yes" class="btn btn-primary">Search</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
    <div id="right-panel" class="right-panel">
        <header id="header" class="header">
            <div class="header-menu">
                <div class="col-sm-7">
                    <div class="header-left">
                    <h1>Admission and Testing Office</h1>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bars"></i>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3" id="autodata">

                <div class="col-sm-12 mb-4">
                <div class="card-group">

                    <a href="adm-all-app.php" class="card col-lg-3 col-md-6 mr-2 bg-flat-color-1">
                        <div class="card-body">
                            <div class="h1 text-muted text-right mb-4">
                                <i class="fa fa-users text-light"></i>
                            </div>

                            <div class="h4 mb-0 text-light"><span class="h4 m-0">'.$total_app.'</span>
                        </div>
                        <small class="text-uppercase font-weight-bold text-light">Total Application</small>
                                            
                        <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                        </div>
                    </a>
                    <a href="adm-all-permitted.php" class="card col-lg-3 col-md-6 mr-2 no-padding no-shadow">
                        <div class="card-body bg-flat-color-5">
                            <div class="h1 text-right text-light mb-4">
                                <i class="fa fa-check-square-o"></i>
                            </div>
                            <div class="h4 mb-0 text-light"><span class="h4 m-0">'.$permitted.'</span>
                            </div>
                            <small class="text-uppercase font-weight-bold text-light">Permitted Applicants</small>
                            <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                        </div>
                    </a>
                    <a href="adm-all-result.php" class="card col-lg-3 col-md-6 no-padding no-shadow">
                            <div class="card-body bg-flat-color-3">
                            <div class="h1 text-right mb-4">
                                <i class="fa fa-upload text-light"></i>
                            </div>
                            <div class="h4 mb-0 text-light"><span class="h4 m-0">'.$result.'</span>
                            </div>
                            <small class="text-light text-uppercase font-weight-bold">Number of issued scores</small>
                            <div class="progress progress-xs mt-3 mb-0 bg-light" style="width: 40%; height: 5px;"></div>
                        </div>
                    </a>
                </div>
        </div>
    </div>
</div>
</body>
    ';
}
?>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>


</html>