<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="apple-touch-icon" href="img/essu-logo.png">
    <link rel="shortcut icon" href="img/essu-logo.png">
    <title>Show</title>
    <style>
        body{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            min-height: 100vh;
        }
        .format{
            width: 90%;
            height: 90%;
            padding: 5px;
        }
        .format img{
            width: 100%;
            height: 100%;
        }
        a{
            text-decoration: none;
            color: #000;
        }
    </style>
</head>
<body>
        <!--display the img-->
        
    <?php
    session_start();
    include 'connect.php';
    if (isset($_SESSION['email'])) {
        $apprefno=$_GET['id'];
        $sql = mysqli_query($con, "SELECT idPic,rCard,gMoral FROM account_tab where apprefno='$apprefno'");
        $uploads = mysqli_fetch_array($sql);
        ?>
        <a href="adm-all-app.php" class="btn btn-primary btn-sm">&#8592;</a>
                <div class="format">
                    <table>
                        <tr class="text-center">
                            <td><label>ID Picture</label></td>
                            <td><label>Report Card</label></td>
                            <td><label>Good Moral</label></td>
                        </tr>
                        <tr>
                            <td>
                                <img src="<?php echo $uploads['idPic']?>" alt="">
                            </td>
                            <td>
                                <img src="<?php echo $uploads['rCard']?>" alt="">
                            </td>
                            <td>
                                <img src="<?php echo $uploads['gMoral']?>" alt="">
                            </td>
                        </tr>
                    </table>
                    
                </div>
        <?php
    }
    ?>
</body>
</html>