<?php
session_start();
include 'includes/header.php';
//require 'stu-archive.php';

include 'connect.php';
?>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel bg-success">
        <nav class="navbar navbar-expand-sm navbar-default bg-success">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#"><img src="img/essu-logo.png" alt="Logo" style="width: 65px;">
                <div class="text-white font-weight-bold"><span style="font-size: 24px; font-family:'Segoe UI'">ESSU</span></div>
                <a class="navbar-brand hidden" href="#"><img src="img/essu-logo.png" alt="Logo" style="width: 100px;"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php

                    if(isset($_SESSION['email'])){
                        echo '
                        <li>
                            <a href="adm-dashboard.php" class="text-white"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                        </li>
                        ';
                    }
                    ?>
                    
                    <?php

                    if(isset($_SESSION['email'])){
                        echo '
                        <h3 class="menu-title text-white"><i class="menu-icon fa fa-folder"></i> APPLICANTS DETAILS</h3>
                        <li>
                            <a href="adm-all-app.php"> <i class="menu-icon fa fa-eye"></i>See all Applicants</a>
                        </li>
                        ';
                    }
                    ?>
                    <?php

                    if(isset($_SESSION['email'])){
                        echo '
                        <li>
                            <a href="adm-permit-list.php" > <i class="menu-icon ti-pin2"></i>Permit Applicants</a>
                        </li>
                        ';
                    }
                    ?>
                    <?php

                    if(isset($_SESSION['email'])){
                        echo '
                        <li>
                            <a href="adm-all-permitted.php" > <i class="menu-icon ti-check-box"></i>Permitted Applicants List</a>
                        </li>
                        ';
                    }
                    ?>
                    <?php

                    if(isset($_SESSION['email'])){
                        echo '
                        <h3 class="menu-title text-white"><i class="menu-icon fa fa-folder"></i> ENTRANCE EXAM RESULT</h3>
                        <li >
                            <a href="adm-result.php"> <i class="menu-icon ti-pencil-alt"></i>Input Exam Result</a>
                        </li>
                        ';
                    }
                    ?>
                    <?php

                    if(isset($_SESSION['email'])){
                        echo '
                        <li>
                            <a href="adm-all-result.php"> <i class="menu-icon ti-layers"></i>Exam Result List</a>
                        </li>
                        ';
                    }
                    ?>
                    <?php

                    if(isset($_SESSION['email'])){
                        echo '
                        <li class="menu-title">
                        
                        </li>
                        <li class="menu-item-has-children dropdown active">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>Settings</a>
                            <ul class="sub-menu children dropdown-menu bg-success">
                                <li><a href="adm-program-list.php"><i class="fa fa-tasks"></i> Program</a></li>
                                <li><a href="adm-acadyear.php"><i class="fa fa-tasks"></i> Academic Year</a></li>
                                <li><a href="adm-tsched.php"><i class="fa fa-calendar"></i> Testing Schedule</a></li>
                                <li><a href="adm-tcenter.php"><i class="fa fa-map-marker"></i> Testing Center</a></li>
                                <li><a href="db_backup.php"><i class="fa fa-suitcase"></i> Backup Data</a></li>
                            </ul>
                        </li>
                        ';
                    }
                    ?>
                    <?php

                    if(isset($_SESSION['email'])){
                        echo '
                        <li class="menu-title">
                        
                        </li>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-folder"></i>Archives</a>
                            <ul class="sub-menu children dropdown-menu bg-success">
                                <li><a href="#" data-toggle="modal" data-target="#application"><i class="fa fa-eye"></i> Application Form</a></li>
                                <li><a href="#" data-toggle="modal" data-target="#exam"><i class="fa fa-eye"></i> Exam Result</a></li>
                            </ul>
                        </li>
                        ';
                    }
                    ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->
    <!-- Logout Modal-->
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
            <!-- Add Modal -->
            <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Data </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="adm-acadyear-add.php" method="POST">

                            <div class="modal-body">
                                <div class="form-group">
                                <label> Code </label>
                                    <input type="text" name="code" class="form-control" placeholder="Code" autocomplete="off" required>
                                </div>

                                <div class="form-group">
                                    <label> Academic Year </label>
                                    <input type="text" name="acad" class="form-control" placeholder="Academic Year" autocomplete="off" required>
                                </div>

                                <div class="form-group">
                                    <label>Semester </label>
                                    <input type="text" name="semester" class="form-control" placeholder="Semester" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                            </div>
                        </form>

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
            <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
            <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> Edit Data </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="adm-acadyear-upd.php" method="POST">
                        <div class="modal-body">

                            <input type="text" name="update_id" id="update_id">

                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" name="code" id="code" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Academic Year</label>
                                <input type="text" name="ay" id="ay" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label>Semester</label>
                                <input type="text" name="sem" id="sem" class="form-control">
                            </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" name="updatedata" class="btn btn-primary">Update</button>
                            </div>
                            </form>

                    </div>
                </div>
            </div>
    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <div class="header-left">

                    <h1>Academic Year List</h1>

                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                                if (isset($_SESSION['email'])) {
                                    echo '<i class="fa fa-bars"></i>';
                                }
                                ?>
                            
                        </a>
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="content mt-3">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <div class="col-sm-4">
                                        <div class="page-body float-left">
                                        <?php
                                        if (isset($_SESSION['email'])) {
                                            echo '<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#studentaddmodal" data-toggle="tooltip" data-placement="top" title="Add data">
                                        <i class="fa fa-plus"></i> Add data
                                        </button>';
                                        }
                                        ?>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="ay_list" class="table table-hover text-center">
                                    <thead class="text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Code</th>
                                            <th>Academic Year</th>
                                            <th>Semester</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
							        if (isset($_SESSION['email'])) {
							            include 'connect.php';
							            
							                $query = "SELECT ay_ID,code,acad_year,sem,status from academic_year";
							                $result = mysqli_query($con,$query);

							            while($row=mysqli_fetch_assoc($result)):
							                ?>
							                    <tr>
                                                    <td><?php echo $row['ay_ID'] ?></td>
							                        <td><?php echo $row['code'] ?></td>
							                        <td><?php echo $row['acad_year'] ?></td>
							                        <td><?php echo $row['sem'] ?></td>
							                        <td>
							                        <?php 
							                            if ($row['status'] == 0) {
							                            	echo '<span class="badge bg-secondary text-light">Disabled</span>';
							                            }if ($row['status'] == 1) {
                                                            echo '<span class="badge bg-success text-light">Enabled</span>';
                                                        }if ($row['status'] == 2) {
                                                            echo '<span class="badge bg-primary text-light">Completed</span>';
                                                        }
							                        ?>
							                        </td>
							                        <td>
                                                       <select onchange="status_update(this.options[this.selectedIndex].value, '<?php echo $row['code'] ?>')" class="btn btn-light">
                                                            <option selected="">---Select---</option>
                                                            <option value="0">Disabled</option>
                                                            <option value="1">Enabled</option>
                                                            <option value="2">Completed</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-secondary btn-sm editbtn" data-toggle="tooltip" data-placement="top" title="Edit academic year details"><i class="fa fa-edit (alias)"></i></button>
                                                    </td>
							                    </tr>
								        <?php endwhile; 
								        }
						            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->
    <script type="text/javascript">
        function status_update(value,id){
            //alert(id);
            let url = "http://localhost/essu-admission-system/adm-acadstatus.php";
            window.location.href = url+"?code="+id+"&status="+value;
        }
    </script>

    <script type="text/javascript" language="javascript">
        $(document).ready(function(){

            //$('#ay_list').DataTable();

            var ay_list = $('#ay_list').DataTable({
                stateSave: true
            });

            $('#ay_list').on('click','tbody td', function(){
                ay_list.cells(this).edit();

            });
          
        }); 
    </script>

    <script>
        $(document).ready(function () {

            $('#ay_list').on('click','.editbtn', function () {

                $('#editmodal').modal('show');

                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function () {
                    return $(this).text();
                }).get();

                console.log(data);

                $('#update_id').val(data[0]);
                $('#code').val(data[1]);
                $('#ay').val(data[2]);
                $('#sem').val(data[3]);
            });
        });
    </script>
    
</body>

</html>


