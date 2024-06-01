<?php 
include 'connect.php';
$export=$_GET['export'];
$sql = "SELECT apprefno, CONCAT (lname,', ',fname,' ',mname) as name, email,contact,date_format(dob, '%M %e %Y') as dob,pob,sex,civstat,brgy,mun,prov,lschool,lsaddress,lsy,genave,CONCAT (q1,'. ',q1a) as q1,CONCAT (q2,'. ',q2a) as q2,tsite,sy,campus,tsched,fchoice,schoice,tchoice FROM student_archive where sy='$export'";

$result=mysqli_query($con,$sql);


$html='<table>
<tr class="text-center">
    <th scope="col">APP Ref No.</th>
    <th scope="col">Name</th>
    <th scope="col">Email</th>
    <th scope="col">Contact</th>
    <th scope="col">Date of Birth</th>
    <th scope="col">Place of Birth</th>
    <th scope="col">Sex</th>
    <th scope="col">Civil Status</th>
    <th scope="col">Barangay</th>
    <th scope="col">Municipality</th>
    <th scope="col">Province</th>
    <th scope="col">Last School Attended</th>
    <th scope="col">Address</th>
    <th scope="col">Year</th>
    <th scope="col">General Average</th>
    <th scope="col">Q1</th>
    <th scope="col">Q2</th>
    <th scope="col">Testing Center</th>
    <th scope="col">Testing Schedule</th>
    <th scope="col">School Year</th>
    <th scope="col">Campus</th>
    <th scope="col">First Choice</th>
    <th scope="col">Second Choice</th>
    <th scope="col">Third Choice</th>
</tr>
';
while($row=mysqli_fetch_assoc($result)){
    $apprefno=$row['apprefno'];
    $name=$row['name'];
    $email = $row['email'];
    $contact = $row['contact'];
    $dob = $row['dob'];
    $pob = $row['pob'];
    $sex = $row['sex'];
    $civstat = $row['civstat'];
    $brgy = $row['brgy'];
    $mun = $row['mun'];
    $prov = $row['prov'];
    $lschool = $row['lschool'];
    $lsaddress = $row['lsaddress'];
    $lsy = $row['lsy'];
    $genave = $row['genave'];
    $q1 = $row['q1'];
    $q2 = $row['q2'];
    $tsite = $row['tsite'];
    $tsched = $row['tsched'];
    $sy = $row['sy'];
    $campus = $row['campus'];
    $fchoice = $row['fchoice'];
    $schoice = $row['schoice'];
    $tchoice = $row['tchoice'];

    $html.='<tr>
    <td>'.$apprefno.'</td>
    <td>'.$name.'</td>
    <td>'.$email.'</td>
    <td>'.$contact.'</td>
    <td>'.$dob.'</td>
    <td>'.$pob.'</td>
    <td>'.$sex.'</td>
    <td>'.$civstat.'</td>
    <td>'.$brgy.'</td>
    <td>'.$mun.'</td>
    <td>'.$prov.'</td>
    <td>'.$lschool.'</td>
    <td>'.$lsaddress.'</td>
    <td>'.$lsy.'</td>
    <td>'.$genave.'</td>
    <td>'.$q1.'</td>
    <td>'.$q2.'</td>
    <td>'.$tsite.'</td>
    <td>'.$tsched.'</td>
    <td>'.$sy.'</td>
    <td>'.$campus.'</td>
    <td>'.$fchoice.'</td>
    <td>'.$schoice.'</td>
    <td>'.$tchoice.'</td>
</tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=archived-applicants-list.xls');
echo $html;
?>