<?php
session_start();
include 'includes/header.php';
?>
<body>
<table id="bootstrap-data-table-export" class="table table-hover">
    <?php
    if (isset($_SESSION['email'])) {
        echo '
        <thead>
            <tr class="text-center">
                <th>APP Ref. No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Testing Site</th>
                <th>Schedule of Examination </th>
                <th>Release of result</th>
            </tr>
        </thead>
        ';
    }
    ?>
    <tbody>

        <?php
        if (isset($_SESSION['email'])) {
            include 'connect.php';
            
                $query = "SELECT apprefno,
                CONCAT (fname, ' ', mname, ' ', lname) AS name,CONCAT(brgy,', ', mun, ', ', prov) AS address,
                email,contact,tsite from account_tab where stat=1 && stat1=0";
                $result = mysqli_query($con,$query);

            while($row=mysqli_fetch_assoc($result)):
                ?>
                    <tr>
                        <td id="apprefno"><?php echo $row['apprefno'] ?></td>
                        <td id="name"><?php echo $row['name'] ?></td>
                        <td id="email"><?php echo $row['email'] ?></td>
                        <!--<td id="contact"><?php echo $row['contact'] ?></td>-->
                        <td id="address"><?php echo $row['address'] ?></td>
                        <td id="t_site"><?php echo $row['tsite'] ?></td>
                        <td>
                        <select name="tsched" id="tsched" class="form-control selectpicker" data-live-search="true" style="width: 100%" required>
                            <option selected=""></option>
                            <?php 
                            include 'connect.php';
                                                
                                $year=date("Y");
                                $column1="sched";
                                $query="SELECT sched from tsched_tab where schedYear='$year' and stat=0";
                                $run=mysqli_query($con,$query);
                                                
                                if($run){
                                    while($row=mysqli_fetch_array($run)){
                                    echo"<option value='".$row["$column1"]."'>".$row["$column1"]." </option>";
                                        }
                                    }
                            ?>
                            </select>
                        </td>
                        <td><input type="date" name="d_result" id="d_result" min="<?php echo date('Y-m-d')?>" class="form-control"></td>
                    </tr>
        <?php endwhile; 
        }
            ?>
    </tbody>
</table>
</body>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    
<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.colVis.min.js"></script>
<script src="assets/js/init-scripts/data-table/datatables-init.js"></script>

</html>