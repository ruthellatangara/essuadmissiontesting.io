<?php
date_default_timezone_set("Etc/GMT+8");

require_once 'connect.php';

$query = mysqli_query($con, "SELECT account_tab.fname, account_tab.mname,account_tab.lname,account_tab.email, account_tab.contact,account_tab.sex,account_tab.dob,account_tab.pob,account_tab.civstat,account_tab.brgy,account_tab.mun,account_tab.prov,account_tab.apprefno,account_tab.sy,account_tab.campus,account_tab.tsite,account_tab.fchoice,account_tab.schoice,account_tab.tchoice,account_tab.lschool,account_tab.lsaddress,account_tab.lsy,account_tab.genave,account_tab.q1,account_tab.q1a,account_tab.q2,account_tab.q2a,account_tab.idPic,account_tab.rCard,account_tab.gMoral,account_tab.tsched,account_tab.relresult,account_tab.accYear,result_tab.stuID,result_tab.vcscore,result_tab.vrscore,result_tab.frscore,result_tab.qrscore,result_tab.scaledscore,result_tab.sai,result_tab.perrank,result_tab.stanine from account_tab INNER JOIN result_tab ON account_tab.apprefno = result_tab.stuID");



$date = date("Y");

//"SELECT * FROM academic_year where status=2"

while($fetch = mysqli_fetch_array($query)){
    if(strtotime($fetch['accYear']) < strtotime($date)){
        
        $school=$con->real_escape_string($fetch['lschool']);

        $sql_run = mysqli_query($con, "INSERT INTO student_archive (lname,fname,mname,email,contact,sex,dob,pob,civstat,brgy,mun,prov,apprefno,sy,campus,tsite,fchoice,schoice,tchoice,lschool,lsaddress,lsy,genave,q1,q1a,q2,q2a,idPic,rCard,gMoral,tsched,relresult,vcscore,vrscore,frscore,qrscore,scaledscr,sai,perrank,stanine,accYear) VALUES ('$fetch[lname]','$fetch[fname]','$fetch[mname]','$fetch[email]','$fetch[contact]','$fetch[sex]','$fetch[dob]','$fetch[pob]','$fetch[civstat]','$fetch[brgy]','$fetch[mun]','$fetch[prov]','$fetch[apprefno]','$fetch[sy]','$fetch[campus]','$fetch[tsite]','$fetch[fchoice]','$fetch[schoice]','$fetch[tchoice]','$fetch[lschool]','$fetch[lsaddress]','$fetch[lsy]','$fetch[genave]','$fetch[q1]','$fetch[q1a]','$fetch[q2]','$fetch[q2a]','$fetch[idPic]','$fetch[rCard]','$fetch[gMoral]','$fetch[tsched]','$fetch[relresult]','$fetch[vcscore]','$fetch[vrscore]','$fetch[frscore]','$fetch[qrscore]','$fetch[scaledscore]','$fetch[sai]','$fetch[perrank]','$fetch[stanine]',YEAR(NOW()))");


        mysqli_query($con,"DELETE FROM `account_tab` WHERE apprefno = '$fetch[apprefno]' and usertype='user'") or die(mysqli_error($con));
         
        
        $query = mysqli_query($con, "SELECT * from `account_tab`");
        $number = 1;
        while($row=mysqli_fetch_array($query)){
            $id = $row['accID'];
            $sqli = "UPDATE `account_tab` SET accID=$number WHERE accID=$id";
            $sqli_run = mysqli_query($con, $sqli);
            $number++;
        }
        mysqli_query($con, "ALTER TABLE `account_tab` AUTO_INCREMENT =1") or die(mysqli_error($con));


        mysqli_query($con,"DELETE FROM `result_tab` WHERE stuID = '$fetch[apprefno]'") or die(mysqli_error($con));
         
        
        $query1 = mysqli_query($con, "SELECT * from `result_tab`");
        $number = 1;
        while($row=mysqli_fetch_array($query1)){
            $id = $row['resultNo'];
            $sql = "UPDATE `result_tab` SET resultNo=$number WHERE resultNo=$id";
            $sql_run = mysqli_query($con, $sql);
            $number++;
        }
        mysqli_query($con, "ALTER TABLE `result_tab` AUTO_INCREMENT =1") or die(mysqli_error($con));

    }
}
?>